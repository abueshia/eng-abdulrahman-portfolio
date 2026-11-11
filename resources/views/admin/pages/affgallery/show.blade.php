@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Gallery Details'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('Gallerys'),'link'=>route('admin.aff_gallery.index')],
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

                        <div class="card-body py-4 px-0" dir="{{Config::get('app.locale') == 'en' ? 'ltr' : 'rtl'}}">

                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Gallery Details')}}</h4>

                                </div>
{{--                                @if( auth()->user()->id == 1 || auth()->user()->can('Region Edit'))--}}
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                        <a class="btn btn-primary text-center" style="margin-left: 25px"
                                           href="{{route('admin.aff_gallery.edit', $affgallery->id)}}">
                                            <span>{{\App\Helpers\TranslationHelper::translate('Edit')}}</span> &nbsp;
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
{{--                                @endif--}}
                            </div>
 

                            <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('add Image')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            <a href="{{ $gallery->getFirstMediaUrl('aff_galleries') }}" target="_blank">
                                                <img src="{{ $gallery->getFirstMediaUrl('aff_galleries') }}" class="w-100"
                                                     alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                            </a>
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
    </div>

@stop
@section('script')
    <script>

    </script>
@stop
