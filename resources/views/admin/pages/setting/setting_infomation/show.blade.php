@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('setting_infomation'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('setting_infomation'),'link'=>route('admin.setting.setting_infomation.index')],
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('setting_infomation')}}</h4>
                                </div>
{{--                                @if( auth()->user()->id == 1 || auth()->user()->can('WhyUsSetting Edit'))--}}
                                {{-- @can('about_us.edit') --}}
                                 @if (auth()->guard('admin')->user()->can('setting_infomation_index.edit', 'admin'))
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                    <a class="btn btn-primary text-center" style="margin-left: 25px"
                                       href="{{route('admin.setting.setting_infomation.edit')}}">
                                        <span>{{\App\Helpers\TranslationHelper::translate('Edit')}}</span> &nbsp;
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                                {{-- @endcan --}}
                               @endif
                            </div>

                                        
                            <div class="form-group">
                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Select information to show in home page')}}
                                </label>
                                <select name="information_type" class="form-control form-control-solid" disabled>
                                    <option value="">Select</option>
                                    <option value="information_flight" {{ setting('information_type') == 'information_flight' ? 'selected' : '' }}>
                                        information_flight
                                    </option>
                                    <option value="information_hotel" {{ setting('information_type') == 'information_hotel' ? 'selected' : '' }}>
                                        information_hotel
                                    </option>
                                    <option value="information_tour" {{ setting('information_type') == 'information_tour' ? 'selected' : '' }}>
                                        information_tour
                                    </option>
                                </select>
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
