{{--@can('place_informationflights.view_details')--}}
 @if (auth()->guard('admin')->user()->can('information_flights.view_details', 'admin'))
<a href="{{route('admin.informationflight.show',['informationflight'=>$informationflight->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif

{{--@endcan--}}
{{--@can('place_informationflights.edit')--}}
 @if (auth()->guard('admin')->user()->can('information_flights.edit', 'admin'))
<a href="{{route('admin.informationflight.edit',['informationflight'=>$informationflight->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif
{{--@endcan--}}

{{--@can('place_informationflights.delete')--}}
 @if (auth()->guard('admin')->user()->can('information_flights.delete', 'admin'))
<button type="button" data-url="{{route('admin.informationflight.destroy',['informationflight'=>$informationflight->id])}}"
   data-item-id="{{ $informationflight->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{--@endcan--}}
@endif

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
