<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\NewsRequest;
use App\Models\News;
use App\Services\NewsService;
use App\ViewModels\NewsViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
    private $news;

    public function __construct()
    {
        $this->middleware(['auth:admin', 'permission:news.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:news.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:news.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:news.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:news.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:news.sort'], ['only' => ['reorder','saveReorder']]);
        $this->news = new NewsService();
    }

    /**
     * Display a listing of the news.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.news.index');
    }

    
    public function table(DataTables $dataTables, Request $request)
{
    $model = News::ordered();

    return $dataTables->eloquent($model)->addIndexColumn()
        ->editColumn('id', function (News $news) {
            return $news->id ?? '-';
        })
        ->editColumn('name', function (News $news) {
            return $news->name ?? '-';
        })
        // ->editColumn('image', function (News $news) {
        //         $imageUrl = $news->getFirstMediaUrl('news') ?: asset('path/to/default/image.jpg');
        //         return "<img width='100' src='{$imageUrl}' alt='News Image'/>";
        // })
            ->editColumn('newsnews_video', function (News $news) {
                $videoUrl = $news->getFirstMediaUrl('newsnews_video'); // تأكد من استخدام اسم المجموعة الصحيح
                if ($videoUrl) {
                    return "
            <video width='100' controls>
                <source src='{$videoUrl}' type='video/mp4'>
                Your browser does not support the video tag.
            </video>
        ";
                } else {
                    return "<span class='text-muted'>No Video</span>";
                }
            })


        ->editColumn('created_at', function (News $news) {
            return $news->created_at ? $news->created_at->format('d-m-Y') : '-';
        })
        ->addColumn('action', function (News $news) {
            return view('admin.pages.news.buttons', compact('news'));
        })
        ->rawColumns(['image', 'action' , 'newsnews_video']) 
        ->startsWithSearch()
        ->make(true);
}



    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $news = News::find($id);
        return view('admin.pages.news.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new news.
     */
    public function create(): View
    {
        return view('admin.pages.news.form',  new NewsViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        // return $request;
        $this->news->createNews($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news): View
    {
        return view('admin.pages.news.form',  new NewsViewModel($news));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, News $news): RedirectResponse
    {
        //        return $request;
        $this->news->updateNews($news, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): JsonResponse
    {
        $this->news->deleteNews($news);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }



    public function reorder(News $news)
    {
        return $this->news->reorder($news, 'name', 'admin.pages.news.reorder', 1);
    }

    public function saveReorder(Request $request, News $news)
    {
        $all_entries = $request->input('tree');
        return $this->news->saveReorder($all_entries, $news);
    }
}
