<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contact\ContactRequest;
use App\Models\Contact;
use App\Services\ContactService;
use App\ViewModels\ContactViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    private $contact;

    public function __construct()
    {
        // contact
        // $this->middleware('permission:contact.view_all', ['only' => ['index']]);
        // $this->middleware('permission:contact.view_details', ['only' => ['show']]);
        // $this->middleware('permission:contact.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:contact.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:contact.delete', ['only' => ['destroy']]);

        $this->middleware(['auth:admin', 'permission:contact.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:contact.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:contact.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:contact.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:contact.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:contact.sort'], ['only' => ['reorder', 'saveReorder']]);


        $this->contact = new ContactService();
    }

    /**
     * Display a listing of the contact.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.contact.index');
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Contact::ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Contact $contact) {
                return $contact->id ?? '-';
            })->editColumn('image', function (Contact $contact) {
                return "<img width='100' src=' " . $contact->getFirstMediaUrl('contacts') . " '/>";
            })->editColumn('title', function (Contact $contact) {
                return $contact->title;

          })->editColumn('whatsapp', function (Contact $contact) {
            return $contact->whatsapp;

        })->editColumn('facebook', function (Contact $contact) {
            return $contact->facebook;
     

            })->editColumn('created_at', function (Contact $contact) {
                return $contact->created_at->format('d-m-Y') ?? '-';
            })->addColumn('action', function (Contact $contact) {
                return view('admin.pages.contact.buttons', compact('contact'));
            })
            ->rawColumns(['image', 'action'])
            ->startsWithSearch()
            ->make(true);
    }

    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $contact = Contact::find($id);
        return view('admin.pages.contact.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new contact.
     */
    public function create(): View
    {
        return view('admin.pages.contact.form',  new ContactViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        // return $request;
        $this->contact->createContact($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact): View
    {
        return view('admin.pages.contact.form',  new ContactViewModel($contact));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact): RedirectResponse
    {
        //        return $request;
        $this->contact->updateContact($contact, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): JsonResponse
    {
        $this->contact->deleteContact($contact);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Contact $contact)
    {
        return $this->contact->reorder($contact, 'name', 'admin.pages.contact.reorder', 1);
    }

    public function saveReorder(Request $request, Contact $contact)
    {
        $all_entries = $request->input('tree');
        return $this->contact->saveReorder($all_entries, $contact);
    }
}
