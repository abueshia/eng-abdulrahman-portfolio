<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Card\CardRequest;
use App\Models\Card;
use App\Models\Category;
use App\Models\Categorycolid;
use App\Services\CardService;
use App\ViewModels\CardViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\DataTables;

class CardController extends Controller
{
    private $card;

    public function __construct()
    {
        $this->middleware(['auth:admin', 'permission:card.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:card.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:card.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:card.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:card.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:card.sort'], ['only' => ['reorder','saveReorder']]);
        $this->card = new CardService();
    }

    /**
     * Display a listing of the card.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.card.index');
    }

    
    public function table(DataTables $dataTables, Request $request)
{
    $model = Card::ordered();

    return $dataTables->eloquent($model)->addIndexColumn()
        ->editColumn('id', function (Card $card) {
            return $card->id ?? '-';
        })
            // ->editColumn('title', function (Card $card) {
            //     return $card->title ?? '-';
            // })
            ->editColumn('title', function (Card $card) {
                $title = $card->title ?? '-';
                $words = explode(' ', $title);
                $shortTitle = implode(' ', array_slice($words, 0, 3));
                return $shortTitle;
            })
          ->editColumn('category', function (Card $card) {
                return $card->categories->name ?? '-';
        })

            ->editColumn('categorycolid_id', function (Card $card) {
                return $card->categorycolid->name ?? '-';
            })

        
        ->editColumn('image', function (Card $card) {

                $imageUrl = $card->getFirstMediaUrl('cards') ?: asset('path/to/default/image.jpg');
                return "<img width='100' src='{$imageUrl}' alt='Card Image'/>";
        })
        //     ->editColumn('cardcard_video', function (Card $card) {
        //         $videoUrl = $card->getFirstMediaUrl('cardcard_video'); 
        //         if ($videoUrl) {
        //             return "
        //     <video width='100' controls>
        //         <source src='{$videoUrl}' type='video/mp4'>
        //         Your browser does not support the video tag.
        //     </video>
        // ";
        //         } else {
        //             return "<span class='text-muted'>No Video</span>";
        //         }
        //     })

        ->editColumn('created_at', function (Card $card) {
            return $card->created_at ? $card->created_at->format('d-m-Y') : '-';
        })
        ->addColumn('action', function (Card $card) {
            return view('admin.pages.card.buttons', compact('card'));
        })
        ->rawColumns(['image', 'action' , 'cardcard_video']) 
        ->startsWithSearch()
        ->make(true);
}



    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $card = Card::find($id);
        return view('admin.pages.card.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new card.
     */
    public function create(): View
    {
        $categories = Category::all();
        $categorycolid = Categorycolid::all();
        return view('admin.pages.card.form',   new CardViewModel(), get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CardRequest $request)
    {
        // return $request;
        $this->card->createCard($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    // public function getCategoryColid($categoryId)
    // {
    //     $categoryColid = Categorycolid::where('category_id', $categoryId)->get();
    //     return response()->json($categoryColid);
    // }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card): View
    {

        return view('admin.pages.card.form',  new CardViewModel($card));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CardRequest $request, Card $card): RedirectResponse
    {
        //        return $request;
        $this->card->updateCard($card, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card): JsonResponse
    {
        $this->card->deleteCard($card);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }



    public function reorder(Card $card)
    {
        return $this->card->reorder($card, 'name', 'admin.pages.card.reorder', 1);
    }

    public function saveReorder(Request $request, Card $card)
    {
        $all_entries = $request->input('tree');
        return $this->card->saveReorder($all_entries, $card);
    }
}
