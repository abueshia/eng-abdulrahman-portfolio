{{--@can('place_gallerys.view_details')--}}

{{--@can('place_gallerys.add_more_images')--}}
{{-- <a href="{{route('admin.aff_gallery.create',['gallery'=>$gallery->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Add More Images')}}">
    <i class="fas fa-camera-retro text-primary fs-2"></i>
</a> --}}
{{--@endcan--}}

{{-- <a href="{{route('admin.aff_gallery.show',['aff_gallery'=>$aff_gallery->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a> --}}

{{--@endcan--}}
{{--@can('place_gallerys.edit')--}}

<a href="{{route('admin.aff_gallery.edit', ['gallery_id' => $gallery_id, 'aff_gallery' => $affgallery->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>

{{--@endcan--}}

{{--@can('place_gallerys.delete')--}}
<button type="button" data-url="{{route('admin.aff_gallery.destroy' , ['gallery_id' => $gallery_id, 'aff_gallery' => $affgallery->id])}}"
   data-item-id="{{ $affgallery->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
