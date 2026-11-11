@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Booking Details'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('Booking'),'link'=>route('admin.order.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Details')]
        ]" :button="[]">
    </x-bread-crumb>
@endsection
@section('content')


    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card mb-5 mb-xxl-8 ">
                            <div class="card-header pt-0 align-items-center">
                                <h3 class="bold mb-0">{{\App\Helpers\TranslationHelper::translate('Service Details')}}</h3>
                            </div>
                            <div class="card-body pb-9">
                                <!--begin::Details-->
                                <div class="d-flex flex-wrap flex-sm-nowrap">
                                    <!--begin: Pic-->
                                    <div class="me-7 mb-4">
                                        <div
                                            class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                            <img
                                                src="{{$order->userService->service->getFirstMediaUrl('services') != null ? $order->userService->service->getFirstMediaUrl('services') : asset('dashboard/assets/media/services/blank.png')}}"
                                                alt="image"/>
                                        </div>
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1">
                                        <!--begin::Title-->
                                        <div
                                            class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <!--begin::User-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Name-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <a href="javascript:void(0);"
                                                       class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                                        {{$order->userService->service->name}}
                                                    </a>
                                                </div>
                                            </div>
                                            <!--end::User-->
                                            <!--begin::Actions-->

                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Title-->

                                        <div class="d-flex flex-wrap flex-stack">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <!--begin::Stats-->
                                                <div class="d-flex flex-wrap">
                                                    <div class="text-gray-600 fs-4 fw-bold me-1 w-100 line_height_5">
                                                        <span class="bold">
                                                            {{\App\Helpers\TranslationHelper::translate('Category')}} :
                                                        </span>
                                                        <span>
                                                            {{$order->userService->service->category->name}}
                                                        </span>
                                                    </div>
                                                    <div class="text-gray-600 fs-4 fw-bold me-1 w-100 line_height_5">
                                                        <span class="bold">
                                                            {{\App\Helpers\TranslationHelper::translate('SubCategory')}} :
                                                        </span>
                                                        <span>
                                                            {{$order->userService->service->subCategory->name}}
                                                        </span>
                                                    </div>

                                                    <div class="text-gray-600 fs-4 fw-bold me-1 w-100 line_height_5">
                                                        <span class="bold">
                                                            {{\App\Helpers\TranslationHelper::translate('Has Calender')}} :
                                                        </span>
                                                        <img
                                                            src="{{asset('dashboard/assets/img/'.($order->userService->has_calender == 1 ? 'true' : 'false').'.png')}}"
                                                            alt="icon" width="30">

                                                    </div>
                                                    <div class="text-gray-600 fs-4 fw-bold me-1 w-100 line_height_5">
                                                        <span class="bold">
                                                            {{\App\Helpers\TranslationHelper::translate('Bookings Count')}} :
                                                        </span>
                                                        <span>
                                                            {{$order->userService->service->count()}}
                                                        </span>
                                                    </div>
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card mb-5 mb-xxl-8 ">
                            <div class="card-header pt-0 align-items-center">
                                <h3 class="bold mb-0">{{\App\Helpers\TranslationHelper::translate('Booking Summary')}}</h3>
                            </div>
                            <div class="card-body pb-9">
                                <!--begin::Details-->
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-5 text-gray-600 fs-4 fw-bold line_height_4">
                                        <span class="bold">
                                            {{\App\Helpers\TranslationHelper::translate('Status')}} :
                                        </span>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-7 text-gray-600 fs-4 fw-bold line_height_4">
                                        <span class="badge badge_{{$order->status}}">
                                            {{\App\Helpers\TranslationHelper::translate($order->status)}}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Details-->


                                <!--begin::Details-->
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-5 text-gray-600 fs-4 fw-bold line_height_4">
                                        <span class="bold">
                                            {{\App\Helpers\TranslationHelper::translate('Payment Status')}} :
                                        </span>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-7 text-gray-600 fs-4 fw-bold line_height_4">
                                        @if($order->payment_status == 'paid')
                                            <span class="badge badge-light-success">
                                                {{\App\Helpers\TranslationHelper::translate($order->payment_status)}}
                                            </span>
                                        @else
                                            <span class="badge badge-light-danger">
                                                {{\App\Helpers\TranslationHelper::translate($order->payment_status)}}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!--end::Details-->

                                <!--begin::Details-->
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-5 text-gray-600 fs-4 fw-bold line_height_4">
                                        <span class="bold">
                                            {{\App\Helpers\TranslationHelper::translate('Payment Method')}} :
                                        </span>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-7 text-gray-600 fs-4 fw-bold line_height_4">
                                        {{$order->payment_status == 'paid' ? $order->payment_method : '---'}}
                                    </div>
                                </div>
                                <!--end::Details-->

                                <!--begin::Details-->
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-5 text-gray-600 fs-4 fw-bold line_height_4">
                                        <span class="bold">
                                            {{\App\Helpers\TranslationHelper::translate('Price')}} :
                                        </span>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-7 text-gray-600 fs-4 fw-bold line_height_4">
                                        {{$order->price}}
                                    </div>
                                </div>
                                <!--end::Details-->
                                @if($order->userService->has_calender == 1)
                                <!--begin::Details-->
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-5 text-gray-600 fs-4 fw-bold line_height_4">
                                        <span class="bold">
                                            {{\App\Helpers\TranslationHelper::translate('From Date')}} :
                                        </span>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-7 text-gray-600 fs-4 fw-bold line_height_4">
                                        {{$order->date_from}}
                                    </div>
                                </div>
                                <!--end::Details-->
                                <!--begin::Details-->
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-5 text-gray-600 fs-4 fw-bold line_height_4">
                                        <span class="bold">
                                            {{\App\Helpers\TranslationHelper::translate('To Date')}} :
                                        </span>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-7 text-gray-600 fs-4 fw-bold line_height_4">
                                        {{$order->date_to}}
                                    </div>
                                </div>
                                <!--end::Details-->

                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card mb-5 mb-xxl-8 ">
                            <div class="card-header pt-0 align-items-center">
                                <h3 class="bold mb-0">{{\App\Helpers\TranslationHelper::translate('Client Details')}}</h3>
                            </div>
                            <div class="card-body pb-9">
                                <!--begin::Details-->
                                <div class="d-flex flex-wrap flex-sm-nowrap">
                                    <!--begin: Pic-->
                                    <div class="me-7 mb-4">
                                        <div
                                            class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                            <img
                                                src="{{$order->user->getFirstMediaUrl('users') != null ? $order->user->getFirstMediaUrl('users') : asset('dashboard/assets/media/users/blank.png')}}"
                                                alt="image"/>
                                            {{--                                    <div--}}
                                            {{--                                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">--}}
                                            {{--                                    </div>--}}
                                        </div>
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1">
                                        <!--begin::Title-->
                                        <div
                                            class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <!--begin::User-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Name-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <a href="javascript:void(0);"
                                                       class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                                        {{$order->user->name}}
                                                    </a>

                                                </div>
                                                <!--end::Name-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">


                                                    <a href="mailto:{{$order->user->email}}"
                                                       class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                        <i class="ki-duotone ki-sms fs-4 me-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>{{$order->user->email}}</a>
                                                    <a href="javascript:void(0);"
                                                       class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                                        <i class="ki-duotone ki-calendar-tick fs-4 me-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                            <span class="path6"></span>
                                                        </i>
                                                        {{\App\Helpers\TranslationHelper::translate('Registered at')}}
                                                        : {{\Carbon\Carbon::parse($order->user->created_at)->format('d M Y')}}
                                                    </a>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::User-->
                                            <!--begin::Actions-->

                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap flex-stack">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <!--begin::Stats-->
                                                <div class="d-flex flex-wrap">
                                                    <!--begin::Stat-->

                                                    <!--end::Stat-->
                                                    <!--begin::Stat-->
                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <i
                                                                class="ki-solid ki-delivery-3 fs-3 text-danger me-2">
                                                            </i>
                                                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                                                 data-kt-countup-value="{{$order->user->orderUserServices->count()}}">
                                                                0
                                                            </div>
                                                        </div>
                                                        <!--end::Number-->
                                                        <!--begin::Label-->
                                                        <div
                                                            class="fw-semibold fs-6 text-gray-500">{{\App\Helpers\TranslationHelper::translate('Total Bookings')}}
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Stat-->

                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Wrapper-->

                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap flex-stack">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <!--begin::Stats-->
                                                <div class="d-flex flex-wrap">

                                                    <a href="tel:+{{$order->user->clientInfo->country_code}}{{$order->user->clientInfo->mobile_number}}"
                                                       class="btn btn-sm btn-primary me-3">
                                                        <i class="fa-solid fa-phone"></i>
                                                        {{\App\Helpers\TranslationHelper::translate('Call')}}
                                                        <span>+{{$order->user->clientInfo->country_code}}{{$order->user->clientInfo->mobile_number}}</span>
                                                    </a>
                                                    <a href="mailto:{{$order->user->email}}"
                                                       class="btn btn-sm btn-primary me-3">
                                                        <i class="fa-solid fa-envelope"></i>
                                                        {{\App\Helpers\TranslationHelper::translate('Email')}}
                                                    </a>

                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Wrapper-->

                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card mb-5 mb-xxl-8 ">
                            <div class="card-header pt-0 align-items-center">
                                <h3 class="bold mb-0">{{\App\Helpers\TranslationHelper::translate('Provider Details')}}</h3>
                            </div>
                            <div class="card-body pb-9">
                                <!--begin::Details-->
                                <div class="d-flex flex-wrap flex-sm-nowrap">
                                    <!--begin: Pic-->
                                    <div class="me-7 mb-4">
                                        <div
                                            class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                            <img
                                                src="{{$order->provider->getFirstMediaUrl('users') != null ? $order->provider->getFirstMediaUrl('users') : asset('dashboard/assets/media/users/blank.png')}}"
                                                alt="image"/>
                                        </div>
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1">
                                        <!--begin::Title-->
                                        <div
                                            class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                            <!--begin::User-->
                                            <div class="d-flex flex-column">
                                                <!--begin::Name-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <a href="javascript:void(0);"
                                                       class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                                        {{$order->provider->name}}
                                                    </a>

                                                </div>
                                                <!--end::Name-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">


                                                    <a href="mailto:{{$order->provider->email}}"
                                                       class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                        <i class="ki-duotone ki-sms fs-4 me-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>{{$order->provider->email}}</a>
                                                    <a href="javascript:void(0);"
                                                       class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                                        <i class="ki-duotone ki-calendar-tick fs-4 me-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                            <span class="path6"></span>
                                                        </i>
                                                        {{\App\Helpers\TranslationHelper::translate('Registered at')}}
                                                        : {{\Carbon\Carbon::parse($order->provider->created_at)->format('d M Y')}}
                                                    </a>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::User-->
                                            <!--begin::Actions-->

                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap flex-stack">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <!--begin::Stats-->
                                                <div class="d-flex flex-wrap">
                                                    <!--begin::Stat-->

                                                    <!--end::Stat-->
                                                    <!--begin::Stat-->
                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <i
                                                                class="ki-solid ki-lots-shopping fs-3 text-success me-2">
                                                            </i>
                                                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                                                 data-kt-countup-value="{{$order->provider->services->count()}}"
                                                                 data-kt-countup-prefix="">0
                                                            </div>
                                                        </div>
                                                        <!--end::Number-->
                                                        <!--begin::Label-->
                                                        <div
                                                            class="fw-semibold fs-6 text-gray-500">{{\App\Helpers\TranslationHelper::translate('Total Services')}}
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Stat-->

                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Wrapper-->

                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap flex-stack">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <!--begin::Stats-->
                                                <div class="d-flex flex-wrap">

                                                    <a href="tel:+{{$order->provider->providerInfo->country_code}}{{$order->provider->providerInfo->mobile_number}}"
                                                       class="btn btn-sm btn-primary me-3">
                                                        <i class="fa-solid fa-phone"></i>
                                                        {{\App\Helpers\TranslationHelper::translate('Call')}}
                                                        <span>+{{$order->provider->providerInfo->country_code}}{{$order->provider->providerInfo->mobile_number}}</span>
                                                    </a>
                                                    <a href="mailto:{{$order->provider->email}}"
                                                       class="btn btn-sm btn-primary me-3">
                                                        <i class="fa-solid fa-envelope"></i>
                                                        {{\App\Helpers\TranslationHelper::translate('Email')}}
                                                    </a>

                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Wrapper-->

                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->

                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                        <div class="card h-xl-100">
                            <!--begin::Header-->
                            <div class="card-header py-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Custom Fields</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-6"
                                 style="max-height: 338px;overflow-y: auto">
                                <!--begin::Table-->
                                @if($order->orderUserServiceFields->count() > 0)
                                    <table
                                        class="table table-row-dashed table-hover table-responsive align-middle gs-0 gy-3 my-0">
                                        <!--begin::Table head-->
                                        <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            <th class="p-0 pb-3 text-start details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Title')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Type')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Is Required')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Value')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->orderUserServiceFields as $field)

                                            @if($field->type == 'dropdown')
                                                @php
                                                    $selected_options = explode(',', $field->val);
                                                    $selected_options = \App\Models\Option::whereIn('id', $selected_options)->pluck('name')->toArray();
                                                    $selected_options = implode(' , ', $selected_options);
                                                @endphp
                                                <tr>
                                                    <td>
                                                        {{$field->field->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{\App\Helpers\TranslationHelper::translate($field->field->type)}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($field->field->is_required == 1)
                                                            <span class="badge badge-light-success">
                                                                                            {{\App\Helpers\TranslationHelper::translate('Required')}}
                                                                                        </span>
                                                        @else
                                                            <span class="badge badge-light-danger">
                                                                                            {{\App\Helpers\TranslationHelper::translate('Optional')}}
                                                                                        </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{$selected_options ?? '---'}}
                                                    </td>
                                                </tr>
                                            @elseif($field->type == 'radio')
                                                @php
                                                    $selected_option = \App\Models\Option::where('id', $field->val)->first();
                                                @endphp
                                                <tr>
                                                    <td>
                                                        {{$field->field->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{\App\Helpers\TranslationHelper::translate($field->field->type)}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($field->field->is_required == 1)
                                                            <span class="badge badge-light-success">
                                                                {{\App\Helpers\TranslationHelper::translate('Required')}}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-light-danger">
                                                                {{\App\Helpers\TranslationHelper::translate('Optional')}}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{$selected_option ? $selected_option->name : '---'}}
                                                    </td>
                                                </tr>
                                            @elseif($field->type == 'image')
                                                @php
                                                    $images = \App\Models\OrderUserServiceField::find($field->id)->getMedia('order_user_service_fields');
                                                    $full_images = [];
                                                    foreach ($images as $image) {
                                                        $full_images[] = $image->getFullUrl();
                                                    }
                                                @endphp

                                                <tr>
                                                    <td>
                                                        {{$field->field->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{\App\Helpers\TranslationHelper::translate($field->field->type)}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($field->field->is_required == 1)
                                                            <span class="badge badge-light-success">
                                                                {{\App\Helpers\TranslationHelper::translate('Required')}}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-light-danger">
                                                                {{\App\Helpers\TranslationHelper::translate('Optional')}}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center" style="max-width: 300px;">
                                                        @if(count($full_images) > 0)
                                                            @foreach($full_images as $key => $full_image)
                                                                <a href="{{$full_image}}" target="_blank">
                                                                    <img src="{{$full_image}}" alt="full_image"
                                                                         width="100"
                                                                         style="border-radius: 5px;overflow: hidden"
                                                                         class="mb-2">
                                                                </a>
                                                                @if(($key + 1) % 3 == 0)
                                                                    <br>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            ---
                                                        @endif
                                                    </td>
                                                </tr>
                                            @elseif($field->type == 'link')

                                                <tr>
                                                    <td>
                                                        {{$field->field->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{\App\Helpers\TranslationHelper::translate($field->field->type)}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($field->field->is_required == 1)
                                                            <span class="badge badge-light-success">
                                                                {{\App\Helpers\TranslationHelper::translate('Required')}}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-light-danger">
                                                                {{\App\Helpers\TranslationHelper::translate('Optional')}}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center" style="max-width: 300px;">
                                                        <a href="{{$field->val}}" target="_blank">
                                                            {{$field->val ?? '---'}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @else

                                                <tr>
                                                    <td>
                                                        {{$field->field->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{\App\Helpers\TranslationHelper::translate($field->field->type)}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($field->field->is_required == 1)
                                                            <span class="badge badge-light-success">
                                                                {{\App\Helpers\TranslationHelper::translate('Required')}}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-light-danger">
                                                                {{\App\Helpers\TranslationHelper::translate('Optional')}}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center" style="max-width: 300px;">
                                                        {{$field->val ?? '---'}}
                                                    </td>
                                                </tr>
                                            @endif

                                        @endforeach
                                        </tbody>

                                        <!--end::Table body-->
                                    </table>
                                @else
                                    <div class="row">
                                        <div
                                            class=" col-lg-3 col-sm-3 col-md-3 col-3 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Title')}}
                                        </div>
                                        <div
                                            class=" col-lg-3 col-sm-3 col-md-3 col-3 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Type')}}
                                        </div>
                                        <div
                                            class=" col-lg-3 col-sm-3 col-md-3 col-3 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Is Required')}}
                                        </div>
                                        <div
                                            class=" col-lg-3 col-sm-3 col-md-3 col-3 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Value')}}
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-12 text-center"
                                             style="margin-top: 70px;">
                                            <img
                                                src="{{asset('dashboard/assets/img/no-results.png')}}"
                                                alt=""
                                                width="150px">

                                        </div>
                                    </div>
                            @endif
                            <!--end::Table-->
                            </div>
                            <!--end: Card Body-->
                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                        <div class="card h-xl-100">
                            <!--begin::Header-->
                            <div class="card-header py-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">{{\App\Helpers\TranslationHelper::translate('Client Rate')}}</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-6"
                                 style="max-height: 338px;overflow-y: auto">
                                @if($order->rate != null)
                                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                        <!--begin::Table head-->
                                        <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">

                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Client Name')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Rate')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Comment')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Created At')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Action')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>

                                            <td class="text-center">
                                                {{$order->rate->user->name}}
                                            </td>
                                            <td class="text-center">
                                                <img
                                                    src="{{asset('dashboard/assets/img/star_'.($order->rate->rate >= 1 ? '1' : '0').'.png')}}"
                                                    alt="star" width="20px">
                                                <img
                                                    src="{{asset('dashboard/assets/img/star_'.($order->rate->rate >= 2 ? '1' : '0').'.png')}}"
                                                    alt="star" width="20px">
                                                <img
                                                    src="{{asset('dashboard/assets/img/star_'.($order->rate->rate >= 3 ? '1' : '0').'.png')}}"
                                                    alt="star" width="20px">
                                                <img
                                                    src="{{asset('dashboard/assets/img/star_'.($order->rate->rate >= 4 ? '1' : '0').'.png')}}"
                                                    alt="star" width="20px">
                                                <img
                                                    src="{{asset('dashboard/assets/img/star_'.($order->rate->rate >= 5 ? '1' : '0').'.png')}}"
                                                    alt="star" width="20px">
                                            </td>
                                            <td class="text-center">
                                                {{$order->rate->comment}}
                                            </td>
                                            <td class="text-center">

                                                {{\Carbon\Carbon::parse($order->rate->created_at)->format('Y-m-d')}}
                                            </td>


                                            <td class="text-center">
                                                @include('admin.pages.order.rate_buttons', ['order_rate' => $order->rate])
                                            </td>
                                        </tr>
                                        </tbody>

                                        <!--end::Table body-->
                                    </table>
                                @else
                                    <div class="row">
                                        <div
                                            class=" col-lg-2 col-sm-2 col-md-2 col-2 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Client Name')}}
                                        </div>
                                        <div
                                            class=" col-lg-2 col-sm-2 col-md-2 col-2 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Rate')}}
                                        </div>
                                        <div
                                            class=" col-lg-2 col-sm-2 col-md-2 col-2 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Comment')}}
                                        </div>
                                        <div
                                            class=" col-lg-2 col-sm-2 col-md-2 col-2 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Created At')}}
                                        </div>
                                        <div
                                            class=" col-lg-2 col-sm-2 col-md-2 col-2 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Action')}}
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-12 text-center" style="margin-top: 70px;">
                                            <img src="{{asset('dashboard/assets/img/no-results.png')}}" alt=""
                                                 width="150px">

                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>


                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
    @include('admin.layouts.delete-modal',['action_message' => \App\Helpers\TranslationHelper::translate('This Item')])

@stop
@push('admin_js')
    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>

@endpush


