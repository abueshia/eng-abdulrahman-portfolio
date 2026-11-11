@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('setting_infomation'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('setting_infomation'),'link'=>route('admin.setting.setting_infomation.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Edit')]
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Edit setting_infomation')}} </h4>
                                </div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.setting.setting_infomation.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row px-0 mt-3">

                                    {{-- @foreach (Config('language') as $key => $lang) --}}
                                    <div class="col-md-6 mb-4">

                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Select information to show in home page')}}
                                                <span class="text-danger">*</span></label>
                                            <select name="information_type" class="form-control form-control-solid" required>
                                                <option value="">Select</option>
                                                <option value="information_flight" {{ old('information_type') == 'information_flight' ? 'selected' : (setting('information_type') == 'information_flight' ? 'selected' : '') }}>information_flight</option>
                                                <option value="information_hotel" {{ old('information_type') == 'information_hotel' ? 'selected' : (setting('information_type') == 'information_hotel' ? 'selected' : '') }}>information_hotel</option>
                                                <option value="information_tour"  {{ old('information_type') == 'information_tour' ? 'selected' : (setting('information_type') == 'information_tour' ? 'selected' : '') }}>information_tour</option>
                                            </select>
                                            @error('information_type')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                              </div>

                                </div>
                                      
                                              
                                <div class="mt-5" style="text-align: right">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Update</span>
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
@stop
@section('script')
    <script>

    </script>
@stop
