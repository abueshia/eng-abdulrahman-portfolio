@can('bottom_banners.edit')

<a href="{{route('admin.bottom_banner.edit',['bottom_banner'=>$bottom_banner->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endcan
@can('bottom_banners.delete')
<button type="button" data-url="{{route('admin.bottom_banner.destroy',['bottom_banner'=>$bottom_banner->id])}}"
   data-item-id="{{ $bottom_banner->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endcan

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>

