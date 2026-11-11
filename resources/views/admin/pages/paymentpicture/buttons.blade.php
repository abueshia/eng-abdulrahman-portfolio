{{--@can('place_paymentpictures.view_details')--}}
@if (auth()->guard('admin')->user()->can('payment_picture.view_details', 'admin'))
<a href="{{route('admin.paymentpicture.show',['paymentpicture'=>$paymentpicture->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endif
{{--@endcan--}}
{{--@can('place_paymentpictures.edit')--}}
@if (auth()->guard('admin')->user()->can('payment_picture.edit', 'admin'))
<a href="{{route('admin.paymentpicture.edit',['paymentpicture'=>$paymentpicture->id])}}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Edit')}}">
    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">
</a>
@endif
{{--@endcan--}}
@if (auth()->guard('admin')->user()->can('payment_picture.delete', 'admin'))
{{--@can('place_paymentpictures.delete')--}}
<button type="button" data-url="{{route('admin.paymentpicture.destroy',['paymentpicture'=>$paymentpicture->id])}}"
   data-item-id="{{ $paymentpicture->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
{{--@endcan--}}
@endif

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
