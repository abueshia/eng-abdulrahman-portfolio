<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\BannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use App\ViewModels\BannerViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\DataTables;

class BannerController extends Controller
{
    private $banner;

    public function __construct()
    {
        // $this->middleware('permission:payment_picture.view_all', ['only' => ['index']]);
        // $this->middleware('permission:payment_picture.view_details', ['only' => ['show']]);
        // $this->middleware('permission:payment_picture.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:payment_picture.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:payment_picture.delete', ['only' => ['destroy']]);
        // $this->middleware('permission:payment_picture.sort', ['only' => ['reorder', 'saveReorder']]);


        // $this->middleware(['auth:admin', 'permission:banner.view_all'], ['only' => ['index']]);
        // $this->middleware(['auth:admin', 'permission:banner.view_details'], ['only' => ['show']]);
        // $this->middleware(['auth:admin', 'permission:banner.create'], ['only' => ['create', 'store']]);
        // $this->middleware(['auth:admin', 'permission:banner.edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['auth:admin', 'permission:banner.delete'], ['only' => ['destroy']]);
        // $this->middleware(['auth:admin', 'permission:banner.sort'], ['only' => [
        //     'reorder',
        //     'saveReorder'
        // ]]);

        $this->banner = new BannerService();
    }

    /**
     * Display a listing of the banner.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.banner.index');
    }


    // public function table(DataTables $dataTables, Request $request)
    // {
    //     $model = Banner::ordered();

    //     return $dataTables->eloquent($model)->addIndexColumn()
    //         ->editColumn('id', function (Banner $banner) {
    //             return $banner->id ?? '-';
    //         })
    //         ->editColumn('name', function (Banner $banner) {
    //             return $banner->name;
    //         })
    //         ->editColumn('image', function (Banner $banner) {

    //             return "<img width='100' src='" . $banner->getFirstMediaUrl('banners') . "' />";
    //         })
    //         ->editColumn('created_at', function (Banner $banner) {
    //             return $banner->created_at ? $banner->created_at->format('d-m-Y h:i A') : '-';
    //         })
    //         ->addColumn('action', function (Banner $banner) {
    //             return view('admin.pages.banner.buttons', compact('banner'));
    //         })
    //         ->rawColumns(['image', 'action'])
    //         ->startsWithSearch()
    //         ->make(true);
    // }




    public function table(DataTables $dataTables, Request $request)
{
    $model = Banner::ordered();

    return $dataTables->eloquent($model)->addIndexColumn()
        ->editColumn('id', function (Banner $banner) {
            return $banner->id ?? '-';
        })
        ->editColumn('title', function (Banner $banner) {
            return $banner->title ?? '-';
        })
        ->editColumn('image', function (Banner $banner) {
            // عرض جميع الصور الخاصة بالـ Banner
            $imagesHtml = '';
            $images = $banner->getMedia('banners');
            
            if ($images->isNotEmpty()) {
                foreach ($images as $image) {
                    $imageUrl = $image->getUrl(); // Get image URL
                    $imagesHtml .= "<img width='50' height='50' src='" . $imageUrl . "' style='border-radius: 5px; margin: 5px;' />";
                }
            } else {
                $imagesHtml = '-';
            }
            return $imagesHtml;
        })
        ->editColumn('created_at', function (Banner $banner) {
            return $banner->created_at ? $banner->created_at->format('d-m-Y') : '-';
        })
        ->addColumn('action', function (Banner $banner) {
            return view('admin.pages.banner.buttons', compact('banner'));
        })
        ->rawColumns(['image', 'action']) // يسمح للعمود image بعرض HTML
        ->startsWithSearch()
        ->make(true);
}



    // public function deleteImage($id)
    // {
    //     $image = \Spatie\MediaLibrary\MediaCollections\Models\Media::findOrFail($id);
    //     // التحقق من أن الصورة تنتمي إلى Banner 
    //     if (
    //         $image->model_type === Banner::class
    //     ) {
    //         $image->delete();
    //         return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    //     }
    //     return response()->json(['success' => false, 'message' => 'Failed to delete image']);
    // }



    // حذف صورة واحدة مرتبطة بالبانر
    // public function deleteImage($id): JsonResponse
    // {
    //     try {
    //         $image = Media::findOrFail($id);

    //         // تحقق إذا كانت الصورة مرتبطة بنموذج Banner
    //         if ($image->model_type === Banner::class) {
    //             $image->delete();
    //             return response()->json(['success' => true, 'message' => 'تم حذف الصورة بنجاح']);
    //         }

    //         return response()->json(['success' => false, 'message' => 'الصورة غير مرتبطة بالبانر']);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء حذف الصورة', 'error' => $e->getMessage()], 500);
    //     }
    // }

    // // حذف كامل للـ Banner
    // public function deleteBanner($banner)
    // {
    //     try {
    //         $banner->delete();
    //     } catch (\Exception $e) {
    //         throw new \Exception('فشل حذف البانر');
    //     }
    // }


// }



    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $banner = Banner::find($id);
        return view('admin.pages.banner.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new banner.
     */
    public function create(): View
    {
        return view('admin.pages.banner.form',  new BannerViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        // return $request;
        $this->banner->createBanner($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner): View
    {
        return view('admin.pages.banner.form',  new BannerViewModel($banner));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, Banner $banner): RedirectResponse
    {
        //        return $request;
        $this->banner->updateBanner($banner, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner): JsonResponse
    {
        $this->banner->deleteBanner($banner);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }



    public function reorder(Banner $banner)
    {
        return $this->banner->reorder($banner, 'name', 'admin.pages.banner.reorder', 1);
    }

    public function saveReorder(Request $request, Banner $banner)
    {
        $all_entries = $request->input('tree');
        return $this->banner->saveReorder($all_entries, $banner);
    }
}
