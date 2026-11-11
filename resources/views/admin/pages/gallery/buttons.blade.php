{{--@can('place_gallerys.view_details')--}}
 @if (auth()->guard('admin')->user()->can('gallery.view_details', 'admin'))
<a href="{{route('admin.gallery.show',['gallery'=>$gallery->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('place_gallerys.edit')--}}
 @if (auth()->guard('admin')->user()->can('gallery.edit', 'admin'))
<a href="{{route('admin.gallery.edit',['gallery'=>$gallery->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif
{{--@endcan--}}

{{--@can('place_gallerys.delete')--}}
 @if (auth()->guard('admin')->user()->can('gallery.delete', 'admin'))
<button type="button" data-url="{{route('admin.gallery.destroy',['gallery'=>$gallery->id])}}"
   data-item-id="{{ $gallery->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif
{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
