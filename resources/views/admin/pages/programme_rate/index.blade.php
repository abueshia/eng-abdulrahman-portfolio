@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush


@section('content')

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{\App\Helpers\TranslationHelper::translate('All Rates')}}
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.index')}}" class="text-muted text-hover-primary">{{\App\Helpers\TranslationHelper::translate('Home')}}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">{{\App\Helpers\TranslationHelper::translate('Rates')}}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::search bar-->

                <!--end::search bar-->
                <!--begin::Primary button-->
{{--                <a href="{{ route('dashboard.coupon.create') }}" class="btn btn-sm fw-bold btn-primary">Add Coupon</a>--}}
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <div class="card">
        <div class="card-body">
            <form action="" method="get">
                <div class="row align-items-end">

                    <div class="col-lg-3 col-12">
                        <div class="input__group mb-25 w-100">
                            <label for="programme_id" class="form-label mb-3">{{\App\Helpers\TranslationHelper::translate('Choose Programme')}}</label>
                            <select name="programme_id" id="programme_id" class="form-select">
                                <option value=""> All</option>
                                @foreach ($programmes as $programme)
                                    <option
                                        value="{{ $programme->id }}" {{request()->has('programme_id') && request()->programme_id == $programme->id ? 'selected' : ''}}> {{ $programme->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-12">
                        <div class="input__group mb-25 w-100">
                            <label for="status" class="form-label mb-3">{{\App\Helpers\TranslationHelper::translate('Status')}}</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">{{\App\Helpers\TranslationHelper::translate('All')}}</option>
                                <option value="1" {{request()->status == '1' ? 'selected' : ''}}>|</option>
                                <option value="0" {{request()->status == '0' ? 'selected' : ''}}>{{\App\Helpers\TranslationHelper::translate('Inactive')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-12">
                        <div class="w-100">
                            <button type="submit" class="btn btn-warning w-100">
                                {{\App\Helpers\TranslationHelper::translate('Filter')}}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <div class="card">
                    <div class="card-body">
                        <!--begin::Col-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 text-center" id="kt_table_users">
                            <thead>
                            <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th>{{\App\Helpers\TranslationHelper::translate('ID')}}</th>
                                <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Programme')}}</th>
                                <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Order')}}</th>
                                <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Rate')}}</th>
                                <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Comment')}}</th>
                                <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Status')}}</th>
                                <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Created At')}}</th>
                                <th class="min-w-125px">{{\App\Helpers\TranslationHelper::translate('Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">


                            @foreach ($rates as $rate)
                                <tr>
                                    <td>{{$rate->id}}</td>
                                    <td>
                                        {{$rate->programme?->name}}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.programme_booking.show', $rate->booking?->id)}}">
                                            #{{$rate->booking?->serial}}
                                        </a>
                                    </td>
                                    <td>{{$rate->rate}}</td>
                                    <td>{{$rate->comment ?? '---'}}</td>

                                    <td class="text-center">
                                        <div class="form-check form-switch text-center custom_form_switch">
                                            <input class="form-check-input status_check custom_switch"
                                                   type="checkbox"
                                                   data-value="{{$rate->id}}"
                                                   style="float: none" {{$rate->status == 1 ? 'checked' : ''}}>
                                        </div>
                                    </td>
                                    <td>{{$rate->created_at}}</td>


                                    <td class="text-center">
                                        <a href="#"
                                           class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                           data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{\App\Helpers\TranslationHelper::translate('Actions')}}
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <!--begin::Menu-->
                                        <div
                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                             @if (auth()->guard('admin')->user()->can('programme_rates.delete', 'admin'))
                                            <div class="menu-item px-3">
                                                <a href="{{route('admin.programme_rate.destroy', $rate->id) }}"
                                                   class="menu-link px-3" data-kt-users-table-filter="delete_row">
                                                    {{\App\Helpers\TranslationHelper::translate('Delete')}}
                                                </a>
                                            </div>
                                            @endif
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    {{ $rates->links() }}
                    <!--end::Col-->
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

@endsection


@push('scripts')
    <script>
        $(document).ready(function () {
            let programme_id = $("#programme_id");
            programme_id.select2();
            let status = $("#status");
            status.select2();

            let status_check = $(".status_check");
            status_check.on('change', function () {
                let id = $(this).attr('data-value');
                if (id !== '') {
                    $.ajax({
                        url: "{{route('admin.programme_rate.change-status')}}",
                        data: {
                            _token: "{{csrf_token()}}",
                            id: id
                        },
                        type: 'POST',

                        success: function (response) {
                            if (typeof (response) != 'object') {
                                response = $.parseJSON(response)
                            }
                            let msg = response.msg;
                            let status = response.status;
                            console.log(response);
                            if (status === 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Action Success!!',
                                    text: msg,
                                    confirmButtonColor: '#1597ac',
                                    confirmButtonText: 'Fine!'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!!',
                                    text: msg,
                                    confirmButtonColor: '#ed4c78',
                                    confirmButtonText: 'Fine!'
                                });
                            }
                        }

                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ!!',
                        text: 'حدث خطأ ما !!',
                        confirmButtonColor: '#ed4c78',
                        confirmButtonText: 'حسنا!'
                    });
                }
            });

        });
    </script>
@endpush
