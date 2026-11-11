@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Reorder Countries'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('Countries'),'link'=>route('admin.placecat.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Reorder Countries')]
        ]" :button="[]">
    </x-bread-crumb>
@endsection
@push('admin_css')
    @include('admin.layouts.reorder.css')
@endpush
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

                        <div class="card-body py-4 px-0" >

                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Reorder Countries')}}</h4>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-end">
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.placecat.index')}}">{{\App\Helpers\TranslationHelper::translate('Go to Countries')}}</a>

                                </div>
                            </div>
                            {{--                            Here Go Reorder--}}
                            {{--                            <input type="hidden" id="route_inp" value="{{}}">--}}
                            {{--                            <input type="hidden" id="max_inp" value="{{  }}">--}}
                            @include('admin.layouts.reorder.view', ['data' => $data, 'label' => $label])


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
@push('admin_js')
    @include('admin.layouts.reorder.js', ['max' => $max_num ?? 3, 'route' => route('admin.placecat.reorder.save')] )
@endpush
