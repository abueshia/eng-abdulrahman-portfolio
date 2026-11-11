@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('About us Setting'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('About us Setting'),'link'=>route('admin.setting.aboutUs_information.index')],
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('About us Setting')}}</h4>
                                </div>
{{--                                @if( auth()->user()->id == 1 || auth()->user()->can('WhyUsSetting Edit'))--}}
                                {{-- @can('about_us.edit') --}}
                                 @if (auth()->guard('admin')->user()->can('aboutUs_information.edit', 'admin'))
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                    <a class="btn btn-primary text-center" style="margin-left: 25px"
                                       href="{{route('admin.setting.aboutUs_information.edit')}}">
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
                                                {{\App\Helpers\TranslationHelper::translate('Explorer title in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('Explorer_title',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                             <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('explorer number')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            {{ setting('explorer_number',app()->getLocale()) }}
                                        </div>
                                    </div>
                                </div>
                            </div>


                                <div class="row px-0 mt-3">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                       <div class="row">
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                               {{\App\Helpers\TranslationHelper::translate('What Clients Say image')}} :
                                           </div>
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                               @if (is_string(setting('explorer_image',app()->getLocale())))
                                                   <img src="{{ url(setting('explorer_image',app()->getLocale())) }}" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               {{-- ************************************* --}}

                               <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang) 
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Winning award title in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('Winning_award_title',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                             <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('Winning award number')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            {{ setting('Winning_award_number',app()->getLocale()) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div class="row px-0 mt-3">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                       <div class="row">
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                               {{\App\Helpers\TranslationHelper::translate('What Clients Say image')}} :
                                           </div>
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                               @if (is_string(setting('Winning_award_image')))
                                                   <img src="{{ url(setting('Winning_award_image')) }}" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               {{-- ************************************* --}}

                               <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang) 
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Complete project title in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('Complete_project_title',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                             <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('Complete project number')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                             {{ setting('Complete_project_number',app()->getLocale()) }}
                                        </div>
                                    </div>
                                </div>
                            </div>


                                <div class="row px-0 mt-3">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                       <div class="row">
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                               {{\App\Helpers\TranslationHelper::translate('Complete project image')}} :
                                           </div>
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                               @if (is_string(setting('Complete_project_image')))
                                                   <img src="{{ url(setting('Complete_project_image')) }}" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               {{-- ******************************************** --}}

                               <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang) 
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Client review title in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('Client_review_title',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                             <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('Client review number')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            {{ setting('Client_review_number',app()->getLocale()) }}
                                        </div>
                                    </div>
                                </div>
                            </div>


                                <div class="row px-0 mt-3">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                       <div class="row">
                                           <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                               {{\App\Helpers\TranslationHelper::translate('Client review image')}} :
                                           </div>
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                               @if (is_string(setting('Client_review_image')))
                                                   <img src="{{ url(setting('Client_review_image')) }}" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
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
                                                {{\App\Helpers\TranslationHelper::translate('Our_Latest_travel_articls_titlein')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{setting('Our_Latest_travel_articls_title',$key)}}
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
                                                {{\App\Helpers\TranslationHelper::translate('Our_Latest_travel_articls_descriptionin')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {!! setting('Our_Latest_travel_articls_description',$key) !!}
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
