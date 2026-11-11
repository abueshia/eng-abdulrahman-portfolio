@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('index Setting'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('index Setting'),'link'=>route('admin.setting.setting_index.index')],
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('index Setting')}}</h4>
                                </div>
{{--                                @if( auth()->user()->id == 1 || auth()->user()->can('WhyUsSetting Edit'))--}}
                                {{-- @can('about_us.edit') --}}
                                @if (auth()->guard('admin')->user()->can('setting_index.edit', 'admin'))
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                    <a class="btn btn-primary text-center" style="margin-left: 25px"
                                       href="{{route('admin.setting.setting_index.edit')}}">
                                        <span>{{\App\Helpers\TranslationHelper::translate('Edit')}}</span> &nbsp;
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                                {{-- @endcan --}}
                               @endif
                            </div>
                                        
                            <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Your gateway title in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('Your_gateway_title',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('travel agency description in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{ setting('travel_agency_description',$key) }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                             <div class="row px-0 mt-3">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                       <div class="row">
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                               {{\App\Helpers\TranslationHelper::translate('image_panarea')}} :
                                           </div>
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                               @if (is_string(setting('image_panarea',app()->getLocale())))
                                                   <img src="{{ setting('image_one', 'en') }}" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                               </div>


                                <div class="row px-0 mt-3">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                       <div class="row">
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                               {{\App\Helpers\TranslationHelper::translate('image_panarea_tow')}} :
                                           </div>
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                               @if (is_string(setting('image_panarea_tow',app()->getLocale())))
                                                   <img src="{{ setting('image_one', 'en') }}" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                               </div>



                            <div class="row px-0 mt-3">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                       <div class="row">
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                               {{\App\Helpers\TranslationHelper::translate('image_panarea_three_footer')}} :
                                           </div>
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                               @if (is_string(setting('image_panarea_three',app()->getLocale())))
                                                   <img src="{{ url(setting('image_panarea_three',app()->getLocale())) }}" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                               </div>


                             <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Find Popular Hotels title in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('Find_Popular_Hotels_title',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                             <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Find_Popular_Flights_title in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('Find_Popular_Flights_title',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                             <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Find_Popular_Tours_title in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('Find_Popular_Tours_title',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                             <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Whether you’re description in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {!! setting('Whether_you’re_description',$key) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>



                             <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Get up to title in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('Get_up_to_title',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
    </div>

@stop
@section('script')
    <script>

    </script>
@stop
