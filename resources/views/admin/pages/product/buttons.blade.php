{{--@can('place_products.view_details')--}}
 @if (auth()->guard('admin')->user()->can('product.view_details', 'admin'))
<a href="{{route('admin.product.show',['product'=>$product->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('place_products.edit')--}}
 @if (auth()->guard('admin')->user()->can('product.edit', 'admin'))
<a href="{{route('admin.product.edit',['product'=>$product->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
{{--@endcan--}}
@endif
{{--@can('place_products.delete')--}}
 @if (auth()->guard('admin')->user()->can('product.delete', 'admin'))
<button type="button" data-url="{{route('admin.product.destroy',['product'=>$product->id])}}"
   data-item-id="{{ $product->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif
{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
