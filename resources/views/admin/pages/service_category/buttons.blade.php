@can('service_categories.view_details')
<a href="{{route('admin.service_category.show',['service_category'=>$service_category->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endcan
@can('service_categories.edit')
<a href="{{route('admin.service_category.edit',['service_category'=>$service_category->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endcan
@can('service_categories.delete')
<button type="button" data-url="{{route('admin.service_category.destroy',['service_category'=>$service_category->id])}}"
   data-item-id="{{ $service_category->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endcan

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
