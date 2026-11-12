<?php

/**
 * Admin MessageController
 *
 * Manages incoming ContactMessages (project inquiries, job offers, and general messages)
 * in the admin dashboard.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\ContactMessageTypeEnum;
use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'permission:messages.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:messages.view_details'], ['only' => ['show', 'Show']]);
        $this->middleware(['auth:admin', 'permission:messages.delete'], ['only' => ['destroy']]);
    }

    /**
     * Display the contact messages listing page.
     */
    public function index(): View
    {
        return view('admin.pages.message.index');
    }

    /**
     * Return DataTables JSON payload for contact messages.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $model = ContactMessage::query()->ordered();

        if ($request->has('search') && ! empty($request->search['value'])) {
            $search = (string) $request->search['value'];

            $model->where(static function ($query) use ($search): void {
                $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('phone', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%');
            });
        }

        if ($request->filled('type')) {
            $model->where('type', (string) $request->type);
        }

        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('id', static fn (ContactMessage $message): int => (int) $message->id)
            ->editColumn('name', static fn (ContactMessage $message): string => $message->name ?? '-')
            ->editColumn('email', static fn (ContactMessage $message): string => $message->email ?? '-')
            ->editColumn('phone', static fn (ContactMessage $message): string => $message->phone ?? '-')
            ->editColumn('type', static function (ContactMessage $message): string {
                $typeEnum = $message->type instanceof ContactMessageTypeEnum
                    ? $message->type
                    : ContactMessageTypeEnum::tryFrom((string) $message->getRawOriginal('type'));

                if ($typeEnum !== null) {
                    return '<span class="badge badge-light-'.$typeEnum->color().'">'.e($typeEnum->label()).'</span>';
                }

                return '<span class="badge badge-light-primary">'.e(TranslationHelper::translate('Contact')).'</span>';
            })
            ->editColumn('service', static fn (ContactMessage $message): string => $message->service ?? '-')
            ->editColumn('created_at', static fn (ContactMessage $message): string => $message->created_at ? $message->created_at->format('d-m-Y') : '-')
            ->addColumn('action', static fn (ContactMessage $message): View => view('admin.pages.message.buttons', compact('message')))
            ->rawColumns(['action', 'type'])
            ->make(true);
    }

    /**
     * Display details of a single contact message.
     */
    public function show(int|string $id): View
    {
        $message = ContactMessage::query()->findOrFail((int) $id);

        return view('admin.pages.message.show', compact('message'));
    }

    /**
     * Delete a contact message from storage.
     */
    public function destroy(ContactMessage $message): JsonResponse
    {
        $message->delete();

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }
}
