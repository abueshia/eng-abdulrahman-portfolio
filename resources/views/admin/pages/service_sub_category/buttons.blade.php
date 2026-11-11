@can('service_subCategories.view_details')
    <a href="{{route('admin.service_sub_category.show',['service_sub_category'=>$service_sub_category->id])}}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md"
       title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
        <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
    </a>
@endcan
@can('service_subCategories.edit')
    <a href="{{route('admin.service_sub_category.edit',['service_sub_category'=>$service_sub_category->id])}}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
        <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
    </a>
@endcan
@can('service_subCategories.delete')
    <button type="button"
            data-url="{{route('admin.service_sub_category.destroy',['service_sub_category'=>$service_sub_category->id])}}"
            data-item-id="{{ $service_sub_category->id }}"
            class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
            data-toggle="modal"
            data-target="#delete_modal">
        <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
    </button>
@endcan

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
