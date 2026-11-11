@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('App Setting'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('App Setting'),'link'=>route('admin.setting.app.index')],
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
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">

                        <!--begin::Card body-->

                        <div class="card-body py-4 px-0">

                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('App Setting')}} </h4>

                                </div>
{{--                                @if( auth()->user()->id == 1 || auth()->user()->can('MainSetting Edit'))--}}
                             @if (auth()->guard('admin')->user()->can('aboutUs_Subscribeto_getSetting.edit', 'admin'))
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                        <a class="btn btn-primary text-center" style="margin-left: 25px"
                                           href="{{route('admin.setting.app.edit')}}">
                                            <span>{{\App\Helpers\TranslationHelper::translate('Edit')}}</span> &nbsp;
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                               @endif
                            </div>
                            <div class="row px-0 mt-3">

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Splash Title')}} (1)
                                                {{__('methods.' . 'In ' .$lang)}} :
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('splash_title_one', $key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Splash Title')}} (2)
                                                {{__('methods.' . 'In ' .$lang)}} :
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('splash_title_two', $key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach




                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('Status')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">

                                            <div class="form-check form-switch text-start custom_form_switch p-0">
                                                <input class="form-check-input status_switch custom_switch m-0" onchange="changeStatus(this)"
                                                       type="checkbox"
                                                       data-url="{{route('admin.setting.app.splashChangeStatus')}}"
                                                       style="float: none" {{setting('splash_status', 'en') == '1' ? 'checked' : ''}}>

                                            </div>
{{--                                            {{dd(sett   ing('splash_status'))}}--}}
                                        </div>
                                    </div>
                                </div>





                            </div>
                        </div>


                    </div>

                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->

@stop
@section('script')
    <script>

    </script>
@stop
