<label class="custom-switch mb-0 mt-1">
    <input type="checkbox" onchange="changeGroupStatus(this)" data-url="{{route('admin.coupon.changeStatus', $row->id)}}"
        {{$row->is_banned == 1 ? 'checked' : ''}}>
    <span class="custom-slider"></span>
</label>


