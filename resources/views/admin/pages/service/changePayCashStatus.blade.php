
    <div class="form-check form-switch text-start custom_form_switch p-0">
        <input class="form-check-input status_switch custom_switch m-0" onchange="changeStatus(this)"
               type="checkbox"
               data-url="{{route('admin.service.changePayCashStatus', $service->id)}}"
               style="float: none" {{$service->pay_cash == 1 ? 'checked' : ''}}>
    </div>


