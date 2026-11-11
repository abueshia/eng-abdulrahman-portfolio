{{--@can('place_informationtours.view_details')--}}
 @if (auth()->guard('admin')->user()->can('information_tours.view_details', 'admin'))
<a href="{{route('admin.informationtour.show',['informationtour'=>$informationtour->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('place_informationtours.edit')--}}
 @if (auth()->guard('admin')->user()->can('information_tours.edit', 'admin'))
<a href="{{route('admin.informationtour.edit',['informationtour'=>$informationtour->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
{{--@endcan--}}
@endif

{{--@can('place_informationtours.delete')--}}
 @if (auth()->guard('admin')->user()->can('information_tours.delete', 'admin'))
<button type="button" data-url="{{route('admin.informationtour.destroy',['informationtour'=>$informationtour->id])}}"
   data-item-id="{{ $informationtour->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{--@endcan--}}
@endif

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
