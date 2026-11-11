<label class="custom-switch mb-0 mt-1">
    <input type="checkbox" onchange="changeGroupStatus(this)" data-url="{{route('admin.toggleStatus', $coupon->id)}}"
        {{$coupon->is_valid == 1 ? 'checked' : ''}}>
    <span class="custom-slider"></span>
</label>


