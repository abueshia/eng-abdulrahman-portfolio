{{--@can('update_provider_service')--}}
<a href="{{route('admin.provider_service.show',['provider_service'=>$service->id])}}"
{{--<a href="#"--}}
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Show Details">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
{{--<a href="{{route('admin.provider_service.edit',['provider_service'=>$provider_service->id])}}"--}}
{{--<a href="#"--}}
{{--   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Language">--}}
{{--    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">--}}
{{--</a>--}}
{{--@endcan--}}
{{--@can('delete_provider_service')--}}
<button type="button" data-url="{{route('admin.provider_service.destroy',['provider_service'=>$service->id])}}"
   data-item-id="{{ $service->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>

{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
