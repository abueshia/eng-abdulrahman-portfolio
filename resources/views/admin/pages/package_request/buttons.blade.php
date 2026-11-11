{{--@can('packages.view_details')--}}
{{--<a href="{{route('admin.package.show',['package'=>$package->id])}}"--}}
{{--   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{\App\Helpers\TranslationHelper::translate('Show Details')}}">--}}
{{--    <img src="{{asset('dashboard/assets/img/show.png')}}" alt="show" style="width: 25px">--}}
{{--</a>--}}
{{--@endcan--}}
@can('package_requests.edit')
    @if($package_request->status == 'pending')
        <button type="button" data-url="{{route('admin.package_request.changeStatus',['package_request'=>$package_request->id])}}"
                data-item-id="{{ $package_request->id }}"
                data-status="approved"
                class="btn btn-sm btn-clean btn-icon btn-icon-md accept-button edit_btns_{{$package_request->id}}"
                data-toggle="modal"
                data-target="#accept_modal"
                onclick="acceptPackage(this)">
            <img src="{{asset('dashboard/assets/img/check-mark.png')}}" alt="Accept" style="width: 25px">
        </button>
        <button type="button" data-url="{{route('admin.package_request.changeStatus',['package_request'=>$package_request->id])}}"
                data-item-id="{{ $package_request->id }}"
                data-status="denied"
                class="btn btn-sm btn-clean btn-icon btn-icon-md accept-button edit_btns_{{$package_request->id}}"
                data-toggle="modal"
                data-target="#deny_modal"
                onclick="denyPackage(this)">
            <img src="{{asset('dashboard/assets/img/false.png')}}" alt="Accept" style="width: 25px">
        </button>
        @else
        --
        @endif
@endcan


<script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
