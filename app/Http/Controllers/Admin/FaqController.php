<?php

/**
 * FaqController
 *
 * Thin Admin Controller for managing bilingual Frequently Asked Questions.
 * Delegates all business logic and cache invalidation to FaqService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Faq\StoreFaqRequest;
use App\Http\Requests\Admin\Faq\UpdateFaqRequest;
use App\Models\Faq;
use App\Services\FaqService;
use App\ViewModels\FaqViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class FaqController extends Controller
{
    public function __construct(
        private readonly FaqService $faqService,
    ) {
        $this->middleware(['auth:admin', 'permission:faqs.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:faqs.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:faqs.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:faqs.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:faqs.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:faqs.sort'], ['only' => ['reorder', 'saveReorder']]);
    }

    /**
     * Display the FAQs listing page.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Faq::class);

        return view('admin.pages.faq.index');
    }

    /**
     * Return Yajra DataTables JSON payload for the FAQs table.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $this->authorize('viewAny', Faq::class);

        $query = $this->faqService->getAdminDataTableQuery();

        if ($request->filled('search.value')) {
            $search = (string) $request->input('search.value');
            $query->where(static function ($builder) use ($search): void {
                $builder->where('question->ar', 'like', "%{$search}%")
                    ->orWhere('question->en', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        return $dataTables->eloquent($query)
            ->addIndexColumn()
            ->editColumn('question', static fn (Faq $faq): string => e((string) $faq->question))
            ->editColumn('category', static fn (Faq $faq): string => e((string) ($faq->category ?? 'general')))
            ->editColumn('is_active', static fn (Faq $faq): string => $faq->is_active
                ? '<span class="badge badge-light-success">'.e(TranslationHelper::translate('Active')).'</span>'
                : '<span class="badge badge-light-danger">'.e(TranslationHelper::translate('Inactive')).'</span>')
            ->addColumn('action', static fn (Faq $faq): string => view('admin.pages.faq.buttons', compact('faq'))->render())
            ->rawColumns(['is_active', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function create(): View
    {
        $this->authorize('create', Faq::class);

        return view('admin.pages.faq.form', new FaqViewModel);
    }

    /**
     * Store a newly created FAQ in storage.
     */
    public function store(StoreFaqRequest $request): RedirectResponse
    {
        $this->authorize('create', Faq::class);

        $this->faqService->create($request->validated());

        session()->flash('success', TranslationHelper::translate('Operation Success'));

        return redirect()->route('admin.faq.index');
    }

    /**
     * Display the specified FAQ details.
     */
    public function show(Faq $faq): View
    {
        $this->authorize('view', $faq);

        return view('admin.pages.faq.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function edit(Faq $faq): View
    {
        $this->authorize('update', $faq);

        return view('admin.pages.faq.form', new FaqViewModel($faq));
    }

    /**
     * Update the specified FAQ in storage.
     */
    public function update(UpdateFaqRequest $request, Faq $faq): RedirectResponse
    {
        $this->authorize('update', $faq);

        $this->faqService->update($faq, $request->validated());

        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return redirect()->route('admin.faq.index');
    }

    /**
     * Remove the specified FAQ from storage.
     */
    public function destroy(Faq $faq): JsonResponse
    {
        $this->authorize('delete', $faq);

        $this->faqService->delete($faq);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }

    /**
     * Display the drag-and-drop reorder page for FAQs.
     */
    public function reorder(): View
    {
        $this->authorize('reorder', Faq::class);

        $items = $this->faqService->getAllForReorder();

        return view('admin.pages.faq.reorder', compact('items'));
    }

    /**
     * Persist the new sort order of FAQs.
     */
    public function saveReorder(Request $request): JsonResponse
    {
        $this->authorize('reorder', Faq::class);

        $items = (array) ($request->input('items') ?? $request->input('tree') ?? []);
        $this->faqService->reorder($items);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Done, Sorting Has Been Saved'),
        ]);
    }
}
