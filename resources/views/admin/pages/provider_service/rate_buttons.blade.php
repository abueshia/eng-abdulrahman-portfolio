
<button type="button" data-url="{{route('admin.order_rate.destroy',['order_rate'=>$order_rate->id])}}"
        data-item-id="{{ $order_rate->id }}"
        id="order_rate_{{ $order_rate->id }}"
        class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
        data-toggle="modal"
        data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
