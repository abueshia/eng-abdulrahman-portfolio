<?php

/**
 * MessageController
 *
 * Thin Admin Controller for viewing, filtering, updating status/admin notes,
 * and deleting incoming ContactMessages. Automatically marks unread messages
 * as read when viewed. No create/edit endpoints are exposed.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactMessage\UpdateContactMessageRequest;
use App\Models\ContactMessage;
use App\Services\ContactMessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class MessageController extends Controller
{
    public function __construct(
        private readonly ContactMessageService $contactMessageService,
    ) {
        $this->middleware(['auth:admin', 'permission:messages.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:messages.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:messages.edit'], ['only' => ['update']]);
        $this->middleware(['auth:admin', 'permission:messages.delete'], ['only' => ['destroy']]);
    }

    /**
     * Display the contact messages listing page with type and status filters.
     */
    public function index(): View
    {
        $this->authorize('viewAny', ContactMessage::class);

        $messageTypes = ContactMessageTypeEnum::options();
        $messageStatuses = ContactMessageStatusEnum::options();
        $unreadCount = $this->contactMessageService->countUnread();

        return view('admin.pages.message.index', compact('messageTypes', 'messageStatuses', 'unreadCount'));
    }

    /**
     * Return Yajra DataTables JSON payload for contact messages with type/status filters.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $this->authorize('viewAny', ContactMessage::class);

        $filters = [
            'type' => $request->input('type'),
            'status' => $request->input('status'),
            'search' => $request->input('search.value'),
        ];

        $query = $this->contactMessageService->getAdminDataTableQuery($filters);

        return $dataTables->eloquent($query)
            ->addIndexColumn()
            ->editColumn('id', static fn (ContactMessage $message): int => (int) $message->id)
            ->editColumn('name', static fn (ContactMessage $message): string => e((string) ($message->name ?? '-')))
            ->editColumn('email', static fn (ContactMessage $message): string => e((string) ($message->email ?? '-')))
            ->editColumn('phone', static fn (ContactMessage $message): string => e((string) ($message->phone ?? '-')))
            ->editColumn('type', static function (ContactMessage $message): string {
                $typeEnum = $message->type instanceof ContactMessageTypeEnum
                    ? $message->type
                    : ContactMessageTypeEnum::tryFrom((string) $message->getRawOriginal('type'));

                if ($typeEnum !== null) {
                    return '<span class="badge badge-light-'.$typeEnum->color().'">'.e($typeEnum->label()).'</span>';
                }

                return '<span class="badge badge-light-primary">'.e(TranslationHelper::translate('Contact')).'</span>';
            })
            ->editColumn('status', static function (ContactMessage $message): string {
                $statusEnum = $message->status instanceof ContactMessageStatusEnum
                    ? $message->status
                    : ContactMessageStatusEnum::tryFrom((string) $message->getRawOriginal('status'));

                if ($statusEnum !== null) {
                    return '<span class="badge badge-light-'.$statusEnum->color().'">'.e($statusEnum->label()).'</span>';
                }

                return '-';
            })
            ->editColumn('created_at', static fn (ContactMessage $message): string => $message->created_at?->format('Y-m-d H:i') ?? '-')
            ->addColumn('action', static fn (ContactMessage $message): string => view('admin.pages.message.buttons', compact('message'))->render())
            ->rawColumns(['type', 'status', 'action'])
            ->make(true);
    }

    /**
     * Display details of a single contact message and automatically mark it as read.
     */
    public function show(ContactMessage $message): View
    {
        $this->authorize('view', $message);

        $message = $this->contactMessageService->markAsRead($message);
        $messageStatuses = ContactMessageStatusEnum::options();
        $statuses = $messageStatuses;

        return view('admin.pages.message.show', compact('message', 'messageStatuses', 'statuses'));
    }

    /**
     * Update the status and/or admin notes of a contact message.
     */
    public function update(UpdateContactMessageRequest $request, ContactMessage $message): RedirectResponse
    {
        $this->authorize('update', $message);

        $validated = $request->validated();
        $status = ContactMessageStatusEnum::from((string) $validated['status']);
        $adminNotes = isset($validated['admin_notes']) ? (string) $validated['admin_notes'] : null;

        $this->contactMessageService->updateStatus($message, $status, $adminNotes);

        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return redirect()->route('admin.message.show', $message->id);
    }

    /**
     * Delete a contact message from storage.
     */
    public function destroy(ContactMessage $message): JsonResponse
    {
        $this->authorize('delete', $message);

        $this->contactMessageService->delete($message);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }
}
