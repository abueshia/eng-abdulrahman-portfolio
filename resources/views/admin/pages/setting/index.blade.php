@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('General Settings'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[['text' => \App\Helpers\TranslationHelper::translate('General Settings')]]" :button="[]" :title="\App\Helpers\TranslationHelper::translate('General Settings')">
    </x-bread-crumb>
@endsection

@push('admin_css')

@endpush

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->

                 {{-- @if (auth()->guard('admin')->user()->can('mainSetting.view_details', 'admin'))
                <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <div class="card-body align-items-end mb-0 p-0">
                            <a class="d-block text-center" href="{{route('admin.setting.main.index')}}">
                                <div class="mb-3">
                                    <i class="ki-solid ki-setting-3 fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('General Settings')}}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                 @endif
                 --}}

                
                <!--end::Col-->
                 {{-- @if (auth()->guard('admin')->user()->can('roles.view_all', 'admin')) --}}
                <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{ url('admin/translations/view/all') }}">
                                <div class="mb-3">
                                    <i class="ki-solid ki-book fs-3x icon-color"></i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('General Translations')}}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--end::Col-->
                {{-- @endif --}}

                
                         {{-- @if (auth()->guard('admin')->user()->can('newsSetting.view_details', 'admin'))
                  <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <div class="card-body align-items-end mb-0 p-0">
                            <a class="d-block text-center" href="{{route('admin.setting.news.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('setting news')}}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif --}}

              @if (auth()->guard('admin')->user()->can('home_couronne_setting.view_details', 'admin'))
                  <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <div class="card-body align-items-end mb-0 p-0">
                            <a class="d-block text-center" href="{{route('admin.setting.homecouronnesetting.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('setting home Silver Blue')}}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                        {{-- @if (auth()->guard('admin')->user()->can('ourcardssetting.view_details', 'admin'))
                  <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <div class="card-body align-items-end mb-0 p-0">
                            <a class="d-block text-center" href="{{route('admin.setting.ourcardssetting.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('setting ourcards setting')}}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif --}}


                {{-- <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <div class="card-body align-items-end mb-0 p-0">
                            <a class="d-block text-center" href="{{ url('admin/translations/view/api') }}">
                                <div class="mb-3">
                                    <i class="ki-solid ki-book fs-3x icon-color"></i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('Api Translations')}}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> --}}


                <!--end::Col-->
                {{-- <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{ route('admin.setting.app.index') }}">
                                <div class="mb-3">
                                    <i class="ki-solid ki-gear fs-3x icon-color"></i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('App Setting')}}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> --}}

                 @if (auth()->guard('admin')->user()->can('aboutUsSetting.view_details', 'admin'))
                  <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <div class="card-body align-items-end mb-0 p-0">
                            <a class="d-block text-center" href="{{route('admin.setting.aboutUs.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('AbouteUs_Why Choose Us')}}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif


                 @if (auth()->guard('admin')->user()->can('aboutUs_ClientsSaySetting.view_details', 'admin'))
                         <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{route('admin.setting.aboutUs_ClientsSay.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('AbouteUs_What Clients Say')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                @endif

                 @if (auth()->guard('admin')->user()->can('aboutUs_Popular_DestinationsSetting.view_details', 'admin'))
                      <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{route('admin.setting.aboutUs_Popular_Destinations.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('Popular Destinations for trip')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                @endif

                 @if (auth()->guard('admin')->user()->can('aboutUs_Subscribeto_getSetting.view_details', 'admin'))
                    <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{route('admin.setting.aboutUs_Subscribeto_get.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('Subscribe to get')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                @endif

                 @if (auth()->guard('admin')->user()->can('aboutUs_information.view_details', 'admin'))
                   <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{route('admin.setting.aboutUs_information.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('about Us information')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                @endif
            
            
                 @if (auth()->guard('admin')->user()->can('setting_blog_details.view_details', 'admin'))
                 <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{route('admin.setting.setting_blog_details.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('setting blog details')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                @endif




                 @if (auth()->guard('admin')->user()->can('setting_index.view_details', 'admin'))
                 <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{route('admin.setting.setting_index.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('setting index-1')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                @endif


                 @if (auth()->guard('admin')->user()->can('Why_Choose_index.view_details', 'admin'))
                 <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{route('admin.setting.Why_Choose_index.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('Why Choose index_2')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                @endif

                 @if (auth()->guard('admin')->user()->can('Find_best_places_index.view_details', 'admin'))
                  <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{route('admin.setting.Find_best_places_index.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('Find best places index_3')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                @endif



                 @if (auth()->guard('admin')->user()->can('Your_gateway_to_amazing_index.view_details', 'admin'))
                 <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->


                            <a class="d-block text-center" href="{{route('admin.setting.Your_gateway_to_amazing_index.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('Your_gateway_to_amazing_index_4')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                @endif


                  {{-- <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{route('admin.setting.trip_bestseller.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('Trip Details Bestseller')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div> --}}



                 @if (auth()->guard('admin')->user()->can('trip_title_ad_image_index.view_details', 'admin'))
                  <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{route('admin.setting.trip_title_ad_image.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('Trip Details Title and Image')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                @endif


                 @if (auth()->guard('admin')->user()->can('setting_infomation_index.view_details', 'admin'))
                 <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="{{route('admin.setting.setting_infomation.index')}}">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold ">{{\App\Helpers\TranslationHelper::translate('setting infomation')}}</span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                @endif




                

                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

@endsection

@push('admin_js')

@endpush
