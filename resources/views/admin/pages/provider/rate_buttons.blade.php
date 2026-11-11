
<button type="button" data-url="{{route('admin.rate.destroy',['rate'=>$rate->id])}}"
        data-item-id="{{ $rate->id }}"
        id="rate_{{ $rate->id }}"
        class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
        data-toggle="modal"
        data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{--@endcan--}}

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
