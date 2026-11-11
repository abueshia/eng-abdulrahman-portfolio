@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Edit Bottom Banner'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('Bottom Banner'),'link'=>route('admin.setting.bottomBanner.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Edit')]
        ]" :button="[]">
    </x-bread-crumb>
@endsection
@section('content')


    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container " class="container-xxl" style="">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-0">

                        <!--begin::Card body-->

                        <div class="card-body py-0 px-0">

                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Edit Bottom Banner')}}</h4>
                                </div>
                            </div>
                            <form action="{{ route('admin.setting.bottomBanner.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row px-0 mt-3">

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Bottom Banner')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="file" name="bottom_banner"
                                                   class="form-control {{$errors->has('bottom_banner')? 'is-invalid':''}}">
                                            <span
                                                class="form-text text-danger">{{$errors->has('bottom_banner')? $errors->first("bottom_banner"):''}}</span>
                                        </div>

                                        <div style="background: #ddd">
                                            <img src="{{asset(setting('bottom_banner', 'en'))}}" alt="bottom_banner" style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 mb-6" style="text-align: {{app()->getLocale() == 'ar' ? 'left' : 'right'}}">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">{{\App\Helpers\TranslationHelper::translate('Update')}}</span>
                                    </button>
                                </div>
                            </form>
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
