@can('bookings.view_details')
<a href="{{route('admin.order.show',['order'=>$order->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endcan
{{--<a href="{{route('admin.order.edit',['order'=>$order->id])}}"--}}
{{--   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Language">--}}
{{--    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">--}}
{{--</a>--}}
@can('bookings.delete')
<button type="button" data-url="{{route('admin.order.destroy',['order'=>$order->id])}}"
   id="order_{{ $order->id }}"
   data-item-id="{{ $order->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endcan

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
