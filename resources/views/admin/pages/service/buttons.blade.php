@can('services.view_details')
<a href="{{route('admin.service.show',['service'=>$service->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endcan
@can('services.edit')
<a href="{{route('admin.service.edit',['service'=>$service->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endcan
@can('services.delete')
<button type="button" data-url="{{route('admin.service.destroy',['service'=>$service->id])}}"
   data-item-id="{{ $service->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endcan

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
