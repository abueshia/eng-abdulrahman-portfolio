@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Provider Details'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('Providers'),'link'=>route('admin.provider.index')],
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
                <div class="card d-none">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-0">

                        <!--begin::Card body-->

                        <div class="card-body py-4 px-0" dir="{{Config::get('app.locale') == 'en' ? 'ltr' : 'rtl'}}">

                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Provider Details')}}</h4>

                                </div>
                                {{--                                @if( auth()->user()->id == 1 || auth()->user()->can('Provider Edit'))--}}
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-end">
                                    <a class="btn btn-primary text-center" style="margin-left: 0"
                                       href="{{route('admin.provider.edit', $provider->id)}}">
                                        <span>{{\App\Helpers\TranslationHelper::translate('Edit')}}</span> &nbsp;
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                                {{--                                @endif--}}
                            </div>

                        </div>
                    </div>

                    <!--end::Card body-->
                </div>

                <div class="card mb-5 mb-xxl-8 ">
                    <div class="card-body py-9">
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <!--begin: Pic-->
                            <div class="me-7 mb-4">
                                <div
                                    class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img
                                        src="{{$provider->getFirstMediaUrl('users') != null ? $provider->getFirstMediaUrl('users') : asset('dashboard/assets/media/users/blank.png')}}"
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
                                                {{$provider->name}}
                                            </a>

                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">


                                            <a href="mailto:{{$provider->email}}"
                                               class="d-flex align-items-center text-gray-500 text-hover-primary mx-5 mb-2">
                                                <i class="ki-duotone ki-sms fs-4 me-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>{{$provider->email}}</a>
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
                                                : {{\Carbon\Carbon::parse($provider->created_at)->format('d M Y')}}
                                            </a>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Actions-->
                                    <div class="d-flex my-4">


                                        <!--begin::Menu-->
                                        <div class="me-0">
                                        {{--                                            <a class="btn btn-primary text-center" style="margin-left: 0"--}}
                                        {{--                                               href="{{route('admin.provider.edit', $provider->id)}}">--}}
                                        {{--                                                <span>{{\App\Helpers\TranslationHelper::translate('Edit')}}</span> &nbsp;--}}
                                        {{--                                                <i class="fas fa-pen"></i>--}}
                                        {{--                                            </a>--}}
                                        <!--begin::Menu 3-->
                                            <!--end::Menu 3-->
                                        </div>
                                        <!--end::Menu-->
                                    </div>
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
                                                         data-kt-countup-value="{{$provider->services->count()}}"
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

                                            <a href="tel:+{{$provider->providerInfo->country_code}}{{$provider->providerInfo->mobile_number}}"
                                               class="btn btn-sm btn-primary me-3">
                                                <i class="fa-solid fa-phone"></i>
                                                {{\App\Helpers\TranslationHelper::translate('Call')}}
                                                <span>+{{$provider->providerInfo->country_code}}{{$provider->providerInfo->mobile_number}}</span>
                                            </a>
                                            <a href="mailto:{{$provider->email}}" class="btn btn-sm btn-primary me-3">
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


                <div class="row px-0 my-5">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header py-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span
                                        class="card-label fw-bold text-gray-800">{{\App\Helpers\TranslationHelper::translate('Personal Details')}}</span>
                                </h3>
                                <!--end::Title-->

                            </div>
                            <div class="card-body pt-2">


                                <div class="row px-0 mt-3">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-12  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Description')}} :
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-12  text-left details_item ">
                                                {{$provider->providerInfo->description != '' ? $provider->providerInfo->description : '---'}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row px-0 mt-3">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-12  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Is Active')}} :
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-12  text-left details_item ">
                                                <div class="form-check form-switch text-start custom_form_switch p-0">
                                                    <input class="form-check-input status_switch custom_switch m-0"
                                                           onchange="changeStatus(this)"
                                                           type="checkbox"
                                                           data-url="{{route('admin.provider.changeActive', $provider->id)}}"
                                                           style="float: none" {{$provider->providerInfo?->status == 'active' ? 'checked' : ''}}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-0 mt-3">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-12  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Is Verified')}} :
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-12  text-left details_item ">
                                                <div class="form-check form-switch text-start custom_form_switch p-0">
                                                    <input class="form-check-input status_switch custom_switch m-0"
                                                           onchange="changeStatus(this)"
                                                           type="checkbox"
                                                           data-url="{{route('admin.provider.changeVerify', $provider->id)}}"
                                                           style="float: none" {{$provider->otp_verified == 1 ? 'checked' : ''}}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row px-0 mt-3">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-12  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Location')}} :
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-12  text-left details_item ">
                                                <a href="https://www.google.com/maps?q={{$provider->latitude}},{{$provider->longitude}}"
                                                   target="_blank">
                                                    {{\App\Helpers\TranslationHelper::translate('Location On Map')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row px-0 mt-3">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-12  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Rate Avg')}} :
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-12  text-left details_item ">
                                                <img
                                                    src="{{asset('dashboard/assets/img/star_'.($provider->avg_rate >= 1 ? '1' : '0').'.png')}}"
                                                    alt="star" width="20px">
                                                <img
                                                    src="{{asset('dashboard/assets/img/star_'.($provider->avg_rate >= 2 ? '1' : '0').'.png')}}"
                                                    alt="star" width="20px">
                                                <img
                                                    src="{{asset('dashboard/assets/img/star_'.($provider->avg_rate >= 3 ? '1' : '0').'.png')}}"
                                                    alt="star" width="20px">
                                                <img
                                                    src="{{asset('dashboard/assets/img/star_'.($provider->avg_rate >= 4 ? '1' : '0').'.png')}}"
                                                    alt="star" width="20px">
                                                <img
                                                    src="{{asset('dashboard/assets/img/star_'.($provider->avg_rate >= 5 ? '1' : '0').'.png')}}"
                                                    alt="star" width="20px">
                                                <span style="vertical-align: middle;">({{$provider->rate_count}})</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-0 mt-3">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-12  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Wallet')}} :
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-12  text-left details_item ">

                                                <span style="vertical-align: middle;">
                                                    {{$provider->providerInfo->wallet}} {{\App\Helpers\TranslationHelper::translate('Points')}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card h-xl-100">
                            <!--begin::Header-->
                            <div class="card-header py-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span
                                        class="card-label fw-bold text-gray-800">{{\App\Helpers\TranslationHelper::translate('Services')}}</span>
                                </h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-6" style="max-height: 338px;overflow-y: auto">
                                <!--begin::Table-->
                                @if($provider->userServices->count() > 0)
                                    <table
                                        class="table table-row-dashed table-responsive align-middle gs-0 gy-3 my-0">
                                        <!--begin::Table head-->
                                        <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Service Name')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Category')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Rate Avg')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Date')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Action')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($provider->userServices as $service)
                                            <tr>
                                                <td class="text-center">
                                                    {{$service->service->name}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-light-success">
                                                        {{$service->service->category->name}}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.($service->avg_rate >= 1 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.($service->avg_rate >= 2 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.($service->avg_rate >= 3 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.($service->avg_rate >= 4 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <img
                                                        src="{{asset('dashboard/assets/img/star_'.($service->avg_rate >= 5 ? '1' : '0').'.png')}}"
                                                        alt="star" width="20px">
                                                    <span
                                                        style="vertical-align: middle;">({{$service->rate_count}})</span>

                                                </td>
                                                <td class="text-center">
                                                    {{\Carbon\Carbon::parse($service->updated_at)->format('Y-m-d')}}
                                                </td>
                                                <td class="text-center">
                                                    @include('admin.pages.provider_service.buttons', ['provider_service' => $service])
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                        <!--end::Table body-->
                                    </table>
                                @else
                                    <div class="row">
                                        <div
                                            class=" col-lg-3 col-sm-3 col-md-3 col-3 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Service Name')}}
                                        </div>
                                        <div
                                            class=" col-lg-3 col-sm-3 col-md-3 col-3 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Category')}}
                                        </div>
                                        <div
                                            class=" col-lg-3 col-sm-3 col-md-3 col-3 p-0 pb-3 text-center details_item_custom bold">
                                            {{\App\Helpers\TranslationHelper::translate('Date')}}
                                        </div>
                                        <div
                                            class=" col-lg-3 col-sm-3 col-md-3 col-3 p-0 pb-3 text-center details_item_custom bold">
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

                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card h-xl-100">
                            <!--begin::Header-->
                            <div class="card-header py-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span
                                        class="card-label fw-bold text-gray-800">{{\App\Helpers\TranslationHelper::translate('Documents')}}</span>
                                </h3>
                                <!--end::Title-->

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-6" style="height: 375px;overflow-y: auto">
                                <!--begin::Table-->

                                <!--end::Table head-->
                                <!--begin::Table body-->

                                @if($documents->count() > 0)
                                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                        <!--begin::Table head-->
                                        <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('#')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Name')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Is Required')}}
                                            </th>
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
                                                {{\App\Helpers\TranslationHelper::translate('Document')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($documents as $document)
                                            <tr>
                                                <td class="text-center">
                                                    {{$document->id}}
                                                </td>
                                                <td class="text-center">
                                                    {{$document->name}}
                                                </td>
                                                <td class="text-center">
                                                    @if($document->is_required == 1)
                                                        <span class="badge badge-warning">
                                                            {{\App\Helpers\TranslationHelper::translate('Required')}}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-success">
                                                            {{\App\Helpers\TranslationHelper::translate('Optional')}}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @php($check = $provider->userDocuments->where('document_id', $document->id)->first())
                                                    @if($check && $check->getFirstMediaUrl('user_documents') != '')
                                                        <a href="{{$check->getFirstMediaUrl('user_documents')}}" target="_blank">
                                                            <img src="{{asset('dashboard/assets/img/doc.png')}}" alt="doc" style="width: 30px">
                                                        </a>
                                                    @else
                                                        {{\App\Helpers\TranslationHelper::translate('Empty Document')}}
                                                    @endif
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

                </div>


                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card h-xl-100">
                            <!--begin::Header-->
                            <div class="card-header py-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span
                                        class="card-label fw-bold text-gray-800">{{\App\Helpers\TranslationHelper::translate('Bookings')}}</span>
                                </h3>
                                <!--end::Title-->

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-6" style="height: 375px;overflow-y: auto">
                                <!--begin::Table-->

                                <!--end::Table head-->
                                <!--begin::Table body-->

                                @if($provider->orderProviderServices->count() > 0)
                                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                        <!--begin::Table head-->
                                        <thead>
                                        <tr class="fs-7 fw-bold text-gray-500">
                                            <th class="p-0 pb-3 text-center details_item_custom bold">
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
                                                {{\App\Helpers\TranslationHelper::translate('Action')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($provider->orderProviderServices as $order)
                                            <tr>
                                                <td class="text-center">
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

                </div>
                <div class="row px-0 mt-5">
                    <div class="col-lg-12 col-12">
                        <div class="card h-xl-100">
                            <!--begin::Header-->
                            <div class="card-header py-5">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span
                                        class="card-label fw-bold text-gray-800">{{\App\Helpers\TranslationHelper::translate('Ratings')}}</span>
                                </h3>
                                <!--end::Title-->

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-6" style="height: 500px;overflow-y: auto">
                                <!--begin::Table-->

                                <!--end::Table head-->
                                <!--begin::Table body-->

                                @if($provider->ratesFrom->count() > 0)
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
                                        @foreach($provider->ratesFrom as $rate)
                                            <tr>
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
                                                    @include('admin.pages.provider.rate_buttons', ['rate' => $rate])
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
    <!--end::Content-->
    @include('admin.layouts.delete-modal',['action_message' => \App\Helpers\TranslationHelper::translate('This Item')])

@stop
@push('admin_js')
    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>

@endpush

