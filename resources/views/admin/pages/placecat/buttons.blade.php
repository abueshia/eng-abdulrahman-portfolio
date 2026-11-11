{{--@can('place_placecats.view_details')--}}
<a href="{{route('admin.placecat.show',['placecat'=>$placecat->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
{{--@endcan--}}
{{--@can('place_placecats.edit')--}}
<a href="{{route('admin.placecat.edit',['placecat'=>$placecat->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
{{--@endcan--}}

{{--@can('place_placecats.delete')--}}
<button type="button" data-url="{{route('admin.placecat.destroy',['placecat'=>$placecat->id])}}"
   data-item-id="{{ $placecat->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
