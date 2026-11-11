@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('trip title and image'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('trip title and image'),'link'=>route('admin.setting.trip_title_ad_image.index')],
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('trip title and image')}}</h4>
                                </div>
{{--                                @if( auth()->user()->id == 1 || auth()->user()->can('WhyUsSetting Edit'))--}}
                                {{-- @can('about_us.edit') --}}
                                 @if (auth()->guard('admin')->user()->can('trip_title_ad_image_index.edit', 'admin'))
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                    <a class="btn btn-primary text-center" style="margin-left: 25px"
                                       href="{{route('admin.setting.trip_title_ad_image.edit')}}">
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
                                                {{\App\Helpers\TranslationHelper::translate('title_create_memories in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('title_create_memories',$key)}}
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
                                                {{\App\Helpers\TranslationHelper::translate('title_Find_your_path in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('title_Find_your_path',$key)}}
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
                                                {{\App\Helpers\TranslationHelper::translate('title_Where_the_journey in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('title_Where_the_journey',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                          
                             <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('image_one')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                         <img src="{{ setting('image_one', 'en') }}" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                                     {{-- <div class="row px-0 mt-3">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                       <div class="row">
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                               {{\App\Helpers\TranslationHelper::translate('image_one')}} :
                                           </div>
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                               @if (is_string(setting('image_one',app()->getLocale())))
                                                   <img src="{{ url(setting('image_one',app()->getLocale())) }}" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                               </div> --}}



                                   <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('image_tow')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            <img src="{{ setting('image_one', 'en') }}" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                                    {{-- <div class="row px-0 mt-3">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                       <div class="row">
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                               {{\App\Helpers\TranslationHelper::translate('image_tow')}} :
                                           </div>
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                               @if (is_string(setting('image_tow',app()->getLocale())))
                                                   <img src="{{ url(setting('image_tow',app()->getLocale())) }}" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                               </div> --}}


{{-- {{ url(setting('image_tow')) }} --}}
                                    
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
