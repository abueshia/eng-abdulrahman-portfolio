@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Provider Service Details'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('Provider Service'),'link'=>route('admin.provider_service.index')],
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
                                                src="{{$provider_service->user->getFirstMediaUrl('users') != null ? $provider_service->user->getFirstMediaUrl('users') : asset('dashboard/assets/media/users/blank.png')}}"
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
                                                        {{$provider_service->user->name}}
                                                    </a>

                                                </div>
                                                <!--end::Name-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">


                                                    <a href="mailto:{{$provider_service->user->email}}"
                                                       class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                        <i class="ki-duotone ki-sms fs-4 me-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>{{$provider_service->user->email}}</a>
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
                                                        : {{\Carbon\Carbon::parse($provider_service->user->created_at)->format('d M Y')}}
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
                                                    <div
                                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <i
                                                                class="ki-solid ki-lots-shopping fs-3 text-success me-2">
                                                            </i>
                                                            <div class="fs-2 fw-bold" data-kt-countup="true"
                                                                 data-kt-countup-value="{{$provider_service->user->services->count()}}"
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
                                                    <!--begin::Stat-->

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

                                                    <a href="tel:+{{$provider_service->user->providerInfo->country_code}}{{$provider_service->user->providerInfo->mobile_number}}"
                                                       class="btn btn-sm btn-primary me-3">
                                                        <i class="fa-solid fa-phone"></i>
                                                        {{\App\Helpers\TranslationHelper::translate('Call')}}
                                                        <span>+{{$provider_service->user->providerInfo->country_code}}{{$provider_service->user->providerInfo->mobile_number}}</span>
                                                    </a>
                                                    <a href="mailto:{{$provider_service->user->email}}"
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
                                                src="{{$provider_service->service->getFirstMediaUrl('services') != null ? $provider_service->service->getFirstMediaUrl('services') : asset('dashboard/assets/media/services/blank.png')}}"
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
                                                        {{$provider_service->service->name}}
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
                                                            {{$provider_service->service->category->name}}
                                                        </span>
                                                    </div>
                                                    <div class="text-gray-600 fs-4 fw-bold me-1 w-100 line_height_5">
                                                        <span class="bold">
                                                            {{\App\Helpers\TranslationHelper::translate('SubCategory')}} :
                                                        </span>
                                                        <span>
                                                            {{$provider_service->service->subCategory->name}}
                                                        </span>
                                                    </div>

                                                    <div class="text-gray-600 fs-4 fw-bold me-1 w-100 line_height_5">
                                                        <span class="bold">
                                                            {{\App\Helpers\TranslationHelper::translate('Has Calender')}} :
                                                        </span>
                                                        <img
                                                            src="{{asset('dashboard/assets/img/'.($provider_service->has_calender == 1 ? 'true' : 'false').'.png')}}"
                                                            alt="icon" width="30">

                                                    </div>
                                                    <div class="text-gray-600 fs-4 fw-bold me-1 w-100 line_height_5">
                                                        <span class="bold">
                                                            {{\App\Helpers\TranslationHelper::translate('Bookings Count')}} :
                                                        </span>
                                                        <span>
                                                            {{$provider_service->orders->count()}}
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
                                @if($provider_service->userServiceFields->count() > 0)
                                    <table class="table table-row-dashed table-hover table-responsive align-middle gs-0 gy-3 my-0">
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
                                        @foreach($provider_service->userServiceFields as $field)

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
                                                        {{$selected_options}}
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
                                                        {{$selected_option?->name}}
                                                    </td>
                                                </tr>
                                            @elseif($field->type == 'image')
                                                @php
                                                    $images = \App\Models\UserServiceField::find($field->id)->getMedia('user_service_fields');
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
                                                        @foreach($full_images as $key => $full_image)
                                                            <a href="{{$full_image}}" target="_blank">
                                                                <img src="{{$full_image}}" alt="full_image" width="100" style="border-radius: 5px;overflow: hidden" class="mb-2">
                                                            </a>
                                                            @if(($key + 1) % 3 == 0)
                                                                <br>
                                                            @endif
                                                        @endforeach
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
                                                            {{$field->val}}
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
                                                        {{$field->val}}
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


                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card h-xl-100">
                            <!--begin::Header-->
                            <div class="card-header py-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">{{\App\Helpers\TranslationHelper::translate('Bookings')}}</span>
                                </h3>
                                <!--end::Title-->

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-6" style="height: 375px;overflow-y: auto">
                                <!--begin::Table-->

                                <!--end::Table head-->
                                <!--begin::Table body-->

                                @if($provider_service->orders->count() > 0)
                                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                        <!--begin::Table head-->
                                        <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            <th class="p-0 pb-3 text-start details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Service')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Client')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Price')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Status')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Payment')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Rate')}}
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
                                        @foreach($provider_service->orders as $order)
                                            <tr>
                                                <td>
                                                    {{$order->userService->service->name}}
                                                </td>
                                                <td class="text-center">
                                                    {{$order->user->name}}
                                                </td>
                                                <td class="text-center">
                                                    {{$order->price}}
                                                </td>
                                                <td class="text-center">

                                                            <span class="badge badge_{{$order->status}}">
                                                                {{\App\Helpers\TranslationHelper::translate($order->status)}}
                                                            </span>
                                                </td>
                                                <td class="text-center">
                                                    @if($order->payment_status == 'paid')
                                                        <span class="badge badge-light-success">
                                                                    {{\App\Helpers\TranslationHelper::translate($order->payment_status)}}
                                                                </span>
                                                    @else
                                                        <span class="badge badge-light-danger">
                                                                    {{\App\Helpers\TranslationHelper::translate($order->payment_status)}}
                                                                </span>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.(($order->rate->rate ?? 0) >= 1 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.(($order->rate->rate ?? 0) >= 2 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.(($order->rate->rate ?? 0) >= 3 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.(($order->rate->rate ?? 0) >= 4 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.(($order->rate->rate ?? 0) >= 5 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                </td>
                                                <td class="text-center">
                                                    {{\Carbon\Carbon::parse($order->created_at)->format('d-m-Y h:i A')}}
                                                </td>
                                                <td class="text-center">
                                                    @include('admin.pages.order.buttons', ['order' => $order])
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                @else
                                    <div class="row">
                                        <div
                                            class=" col-lg-2 col-sm-2 col-md-2 col-2 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Service')}}
                                        </div>
                                        <div
                                            class=" col-lg-2 col-sm-2 col-md-2 col-2 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Client')}}
                                        </div>
                                        <div
                                            class=" col-lg-2 col-sm-2 col-md-2 col-2 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Price')}}
                                        </div>
                                        <div
                                            class=" col-lg-2 col-sm-2 col-md-2 col-2 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Status')}}
                                        </div>
                                        <div
                                            class=" col-lg-2 col-sm-2 col-md-2 col-2 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Payment')}}
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


                            <!--end::Table-->
                            </div>
                            <!--end: Card Body-->
                        </div>
                    </div>

                    <div class="col-lg-12 col-12 mt-5">
                        <div class="card h-xl-100">
                            <!--begin::Header-->
                            <div class="card-header py-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">{{\App\Helpers\TranslationHelper::translate('Ratings')}}</span>
                                </h3>
                                <!--end::Title-->

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-6" style="height: 500px;overflow-y: auto">
                                <!--begin::Table-->

                                <!--end::Table head-->
                                <!--begin::Table body-->

                                @if($provider_service->rates->count() > 0)
                                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                        <!--begin::Table head-->
                                        <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Order Number')}}
                                            </th>
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
                                        @foreach($provider_service->rates as $rate)
                                            <tr>
                                                <td class="text-center">
                                                    <a href="{{route('admin.order.show', $rate->order->id)}}">
                                                        #{{$rate->order->id}}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    {{$rate->user->name}}
                                                </td>
                                                <td class="text-center">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.($rate->rate >= 1 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.($rate->rate >= 2 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.($rate->rate >= 3 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.($rate->rate >= 4 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.($rate->rate >= 5 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                </td>
                                                <td class="text-center">
                                                    {{$rate->comment}}
                                                </td>
                                                <td class="text-center">

                                                    {{\Carbon\Carbon::parse($rate->created_at)->format('Y-m-d')}}
                                                </td>


                                                <td class="text-center">
                                                    @include('admin.pages.provider_service.rate_buttons', ['order_rate' => $rate])
                                                </td>
                                            </tr>
                                        @endforeach
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


                            <!--end::Table-->
                            </div>
                            <!--end: Card Body-->
                        </div>
                    </div>



                </div>

                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    @include('admin.layouts.delete-modal',['action_message' => \App\Helpers\TranslationHelper::translate('This Item')])

@stop
@push('admin_js')
    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>

@endpush
