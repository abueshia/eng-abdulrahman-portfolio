@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Edit App Setting'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('App Setting'),'link'=>route('admin.setting.app.index')],
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Edit App Setting')}}</h4>
                                </div>
                            </div>
                            <form action="{{ route('admin.setting.app.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                        <div class="col-6 mb-5">
                                            <label class="fs-5 fw-bold form-label mb-5" for="splash_title_one_{{$key}}">
                                                {{\App\Helpers\TranslationHelper::translate('Splash Title')}} (1)
                                                {{__('methods.' . 'In ' . $lang)}} :
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea  class="form-control form-control-solid"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('Splash Title')}} (1) {{__('methods.' . 'In ' . $lang)}}"
                                                      name="splash_title_one[{{$key}}]">{{ old('splash_title_one.'.$key) ?? setting('splash_title_one', $key)}}</textarea>
                                            @error('splash_title_one.'.$key)
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    @endforeach
                                    @foreach (Config('language') as $key => $lang)
                                        <div class="col-6 mb-5">
                                            <label class="fs-5 fw-bold form-label mb-5" for="splash_title_one_{{$key}}">
                                                {{\App\Helpers\TranslationHelper::translate('Splash Title')}} (2)
                                                {{__('methods.' . 'In ' . $lang)}} :
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea  class="form-control form-control-solid"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('Splash Title')}} (2) {{__('methods.' . 'In ' . $lang)}}"
                                                      name="splash_title_two[{{$key}}]">{{ old('splash_title_two.'.$key) ?? setting('splash_title_two', $key)}}</textarea>
                                            @error('splash_title_two.'.$key)
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    @endforeach


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
