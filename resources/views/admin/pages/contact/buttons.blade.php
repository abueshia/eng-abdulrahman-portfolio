{{--@can('place_contacts.view_details')--}}
 @if (auth()->guard('admin')->user()->can('contact.view_details', 'admin'))
<a href="{{route('admin.contact.show',['contact'=>$contact->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('place_contacts.edit')--}}
 @if (auth()->guard('admin')->user()->can('contact.edit', 'admin'))
<a href="{{route('admin.contact.edit',['contact'=>$contact->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
{{--@endcan--}}
@endif
{{--@can('place_contacts.delete')--}}

 {{-- @if (auth()->guard('admin')->user()->can('contact.delete', 'admin'))
<button type="button" data-url="{{route('admin.contact.destroy',['contact'=>$contact->id])}}"
   data-item-id="{{ $contact->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif --}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
