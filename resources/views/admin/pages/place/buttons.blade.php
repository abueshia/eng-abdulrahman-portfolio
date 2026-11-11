{{--@can('place_places.view_details')--}}
<a href="{{route('admin.place.show',['place'=>$place->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
{{--@endcan--}}
{{--@can('place_places.edit')--}}
<a href="{{route('admin.place.edit',['place'=>$place->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
{{--@endcan--}}

{{--@can('place_places.delete')--}}
<button type="button" data-url="{{route('admin.place.destroy',['place'=>$place->id])}}"
   data-item-id="{{ $place->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
