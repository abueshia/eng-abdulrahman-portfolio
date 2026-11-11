@can('providers.view_details')
    @if($provider->providerInfo->wallet > 0)


        <button type="button"
                data-url="{{route('admin.provider.wallet.equation',['provider'=>$provider->id])}}"
                data-item-id="{{ $provider->id }}"
                class="btn btn-sm btn-clean btn-icon btn-icon-md equation-button equation_btn_{{$provider->id}}"
                data-toggle="modal"
                data-target="#equation_modal"
                onclick="walletEquation(this)">
            <img src="{{asset('dashboard/assets/img/zeroing.png')}}" alt="Zeroing" style="width: 25px">
        </button>

@endif
<a href="{{route('admin.provider.show',['provider'=>$provider->id])}}"
{{--<a href="#"--}}
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">
    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">
</a>
@endcan
{{--<a href="{{route('admin.provider.edit',['provider'=>$provider->id])}}"--}}
{{--<a href="#"--}}
{{--   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Language">--}}
{{--    <img src="{{asset('dashboard/assets/img/edit.png')}}" alt="edit" style="width: 25px">--}}
{{--</a>--}}
@can('providers.delete')
<button type="button" data-url="{{route('admin.provider.destroy',['provider'=>$provider->id])}}"
   data-item-id="{{ $provider->id }}"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="{{asset('dashboard/assets/img/delete.png')}}" alt="edit" style="width: 25px">
</button>
@endcan

<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
