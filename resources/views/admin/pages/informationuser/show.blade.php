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
                                            {{\App\Helpers\TranslationHelper::translate('email')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{$booking->email}}
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->

                                <!--begin::Col-->
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('phone')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{$booking->phone}}
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('check in')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            {{$booking->check_in}}
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->
                                <div class="col-lg-12 mx-3 my-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            {{\App\Helpers\TranslationHelper::translate('Total reservations')}}
                                        </div>
                                        <div class="col-lg-9 col-9">
                                             {{ $booking->user?->programmebooking?->count() ?? 0 }}
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Col-->
                                
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
