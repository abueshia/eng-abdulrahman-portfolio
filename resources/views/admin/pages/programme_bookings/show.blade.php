@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush


@push('styles')
    <style>
        .toggle-checkbox {
            display: none;
        }

        .toggle-label {
            display: inline-block;
            width: 60px;
            height: 30px;
            background-color: #ccc;
            border-radius: 15px;
            position: relative;
            cursor: pointer;
        }

        .toggle-inner {
            position: absolute;
            left: 2px;
            top: 2px;
            width: 26px;
            height: 26px;
            background-color: #fff;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .toggle-switch {
            position: absolute;
            left: 2px;
            top: 2px;
            width: 26px;
            height: 26px;
            background-color: #999;
            border-radius: 50%;
            transition: left 0.3s ease;
        }

        .toggle-checkbox:checked + .toggle-label .toggle-inner {
            transform: translateX(30px);
        }

        .toggle-checkbox:checked + .toggle-label .toggle-switch {
            left: 32px;
            background-color: #4CAF50;
            /* Change the color here */
        }

        .toggle-checkbox:checked + .toggle-label {

            background-color: #88d28b;
            /* Change the color here */
        }
    </style>
@endpush
@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-2 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{\App\Helpers\TranslationHelper::translate('All Programme Bookings')}}
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
                    <li class="breadcrumb-item text-muted">{{\App\Helpers\TranslationHelper::translate('Programme Bookings')}}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <div class="card">
                    <div class="card-body">
                        <!--begin::Col-->
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('User')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{$booking->user->name}}
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('Programme')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{$booking->programme->name}}
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->

                                <!--begin::Col-->
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('Adults')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{$booking->adults}}
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('Children')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{$booking->children}}
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('Infants')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{$booking->infants}}
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('Check in')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{$booking->check_in}}
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->

                                <!--begin::Col-->
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('Payment Method')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{$booking->payment_method}}
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('Payment Status')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            <span class="btn btn-sm btn-{{$booking->payment_status == 'paid' ? 'success' : 'danger'}}">
                                                {{$booking->payment_status == 'paid' ? 'Paid' : 'Unpaid'}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('Date')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{\Carbon\Carbon::parse($booking->created_at)->format('Y-m-d')}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('Note')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{$booking->note}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="mb-4">Booking Summary{{\App\Helpers\TranslationHelper::translate('Phone')}}</h4>
                                                <div class="row py-2 px-4">
                                                    <div class="col-lg-6" style="text-align: left">
                                                        {{\App\Helpers\TranslationHelper::translate('Check in')}}
                                                    </div>
                                                    <div class="col-lg-6" style="text-align: right">
                                                        {{$booking->check_in}}
                                                    </div>
                                                </div>

                                                <div class="row py-2 px-4">
                                                    <div class="col-lg-6" style="text-align: left">
                                                        {{\App\Helpers\TranslationHelper::translate('Persons')}}
                                                    </div>
                                                    <div class="col-lg-6" style="text-align: right">
                                                        {{$booking->persons}}
                                                    </div>
                                                </div>

                                                <div class="row py-2 px-4">
                                                    <div class="col-lg-6" style="text-align: left">
                                                        {{\App\Helpers\TranslationHelper::translate('Base Price')}}
                                                    </div>
                                                    <div class="col-lg-6" style="text-align: right">
                                                        {{\App\Helpers\TranslationHelper::translate('SAR')}}{{$booking->price_before_discount}}
                                                    </div>
                                                </div>
                                                @if($booking->discount > 0)
                                                    {{--                                            <tr>--}}
                                                    {{--                                                <td>Discount <span class="text-danger bold">({{$data['discount']}})</span></td>--}}
                                                    {{--                                                <td>- ${{$data['discount_value']}}</td>--}}
                                                    {{--                                            </tr>--}}
                                                    {{--                                        <tr>--}}
                                                    {{--                                            <td>Price After Discount /Night</td>--}}
                                                    {{--                                            <td>${{$data['price_after_discount']}}</td>--}}
                                                    {{--                                        </tr>--}}

                                                    <div class="row py-2 px-4">
                                                        <div class="col-lg-6" style="text-align: left">
                                                            {{\App\Helpers\TranslationHelper::translate('Discount')}} <span class="text-danger bold">({{$booking->discount . ($booking->discount_type == 'percent' ? '%' : '')}})</span>
                                                        </div>
                                                        <div class="col-lg-6" style="text-align: right">
                                                            - ${{$booking->discount_value}}
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="row py-2 px-4">
                                                    <div class="col-lg-6" style="text-align: left">
                                                        {{\App\Helpers\TranslationHelper::translate('Tax & Service Fees')}} <span class="text-danger bold">({{$booking->tax}}%)</span>
                                                    </div>
                                                    <div class="col-lg-6" style="text-align: right">
                                                        + ${{$booking->tax_value}}
                                                    </div>
                                                </div>

                                                <div class="row py-2 px-4">
                                                    <div class="col-lg-6" style="text-align: left">
                                                        {{\App\Helpers\TranslationHelper::translate('Total')}}
                                                    </div>
                                                    <div class="col-lg-6" style="text-align: right">
                                                <span class="text-danger">
                                                    {{\App\Helpers\TranslationHelper::translate('SAR')}}{{$booking->total}}
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="mb-4">{{\App\Helpers\TranslationHelper::translate('Booking Personal Information')}}</h4>
                                                <div class="row py-2 px-4">
                                                    <div class="col-lg-6" style="text-align: left">
                                                       {{\App\Helpers\TranslationHelper::translate('First Name')}}
                                                    </div>
                                                    <div class="col-lg-6" style="text-align: right">
                                                        {{$booking->f_name}}
                                                    </div>
                                                </div>
                                                <div class="row py-2 px-4">
                                                    <div class="col-lg-6" style="text-align: left">
                                                        {{\App\Helpers\TranslationHelper::translate('Last Name')}}
                                                    </div>
                                                    <div class="col-lg-6" style="text-align: right">
                                                        {{$booking->l_name}}
                                                    </div>
                                                </div>
                                                <div class="row py-2 px-4">
                                                    <div class="col-lg-6" style="text-align: left">
                                                        {{\App\Helpers\TranslationHelper::translate('Email')}}
                                                    </div>
                                                    <div class="col-lg-6" style="text-align: right">
                                                        {{$booking->email}}
                                                    </div>
                                                </div>
                                                <div class="row py-2 px-4">
                                                    <div class="col-lg-6" style="text-align: left">
                                                        {{\App\Helpers\TranslationHelper::translate('Phone')}}
                                                    </div>
                                                    <div class="col-lg-6" style="text-align: right">
                                                        {{$booking->phone}}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    </script>
@endpush
