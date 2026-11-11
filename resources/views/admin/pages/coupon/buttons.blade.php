{{--@can('place_coupons.view_details')--}}
{{-- {{ route('admin.coupons.show', ['group_id' => $group_id]) }} --}}


@if (auth()->guard('admin')->user()->can('coupon.view_details', 'admin'))
    <a href="{{ route('admin.coupon.show', $model->id) }}"
       class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ \App\Helpers\TranslationHelper::translate('Show Details') }}">
        <img src="{{ asset('dashboard/assets/img/show.png') }}" alt="show" style="width: 25px">
    </a>
@endif



 {{-- @if (auth()->guard('admin')->user()->can('coupon.edit', 'admin'))
<a href="{{route('admin.coupon.edit',['coupon'=>$model->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif --}}

 @if (auth()->guard('admin')->user()->can('coupon.delete', 'admin'))
<button type="button" data-url="{{route('admin.coupon.destroy',['coupon'=>$model->id])}}"
   data-item-id="{{ $model->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endif

{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
