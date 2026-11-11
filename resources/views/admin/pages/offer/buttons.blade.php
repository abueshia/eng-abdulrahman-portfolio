{{--@can('offer.view_details')--}}
@if (auth()->guard('admin')->user()->can('offer.view_details', 'admin'))
<a href="{{route('admin.offer.show',['offer'=>$offer->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('offer.edit')--}}
@if (auth()->guard('admin')->user()->can('offer.edit', 'admin'))
<a href="{{route('admin.offer.edit',['offer'=>$offer->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('offer.delete')--}}
@if (auth()->guard('admin')->user()->can('offer.delete', 'admin'))
<button type="button" data-url="{{route('admin.offer.destroy',['offer'=>$offer->id])}}"
   data-item-id="{{ $offer->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{--@endcan--}}
@endif

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
