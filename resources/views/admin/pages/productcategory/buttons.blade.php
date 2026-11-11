{{--@can('place_productcategorys.view_details')--}}
   @if (auth()->guard('admin')->user()->can('productcategory.view_details', 'admin'))
<a href="{{route('admin.productcategory.show',['productcategory'=>$productcategory->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('place_productcategorys.edit')--}}
   @if (auth()->guard('admin')->user()->can('productcategory.edit', 'admin'))
<a href="{{route('admin.productcategory.edit',['productcategory'=>$productcategory->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif
{{--@endcan--}}

{{--@can('place_productcategorys.delete')--}}
   @if (auth()->guard('admin')->user()->can('productcategory.delete', 'admin'))
<button type="button" data-url="{{route('admin.productcategory.destroy',['productcategory'=>$productcategory->id])}}"
   data-item-id="{{ $productcategory->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif
{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
