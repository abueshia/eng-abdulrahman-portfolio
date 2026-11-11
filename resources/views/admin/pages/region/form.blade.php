@extends('admin.layouts.app')

@if($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Region'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Region'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Cities'),'link'=>route('admin.region.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]" :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to Region'),'link'=>route('admin.region.index')]">
    </x-bread-crumb>
@endsection

@section('content')

    <!--begin::Content-->
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

                        <div class="card-body pt-0">
                            <!--begin::Form-->
                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($method == 'PUT')
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$region->id}}">

                            @endif
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('name.'.$key) ?? $region->getTranslation('name',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}"
                                                       name="name[{{ $key}}]"/>
                                                @error('name.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach

                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">{{\App\Helpers\TranslationHelper::translate('Choose City')}} :
                                                    <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <select name="city_id" id="city_id"
                                                        class="form-control form-control-solid">
                                                    <option value="">{{\App\Helpers\TranslationHelper::translate('Choose City')}}</option>
                                                    @if($method == 'PUT')
                                                        @foreach($cities as $city)
                                                            <option
                                                                value="{{$city->id}}" {{  $region->city_id == $city->id ? 'selected' : ''}}>
                                                                {{$city->name}}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        @foreach($cities as $city)
                                                            <option
                                                                value="{{$city->id}}" {{  old('city_id') == $city->id ? 'selected' : ''}}>
                                                                {{$city->name}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('city_id')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>


{{-- 
                                                                                    @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('meta_title in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('meta_title.'.$key) ?? $region->getTranslation('meta_title',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('meta_title in')}} {{__('methods.' . $lang)}}"
                                                       name="meta_title[{{ $key}}]"/>
                                                @error('meta_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach --}}


                                    </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mb-5">
                                        <span
                                            class="indicator-label">{{\App\Helpers\TranslationHelper::translate('Save')}}</span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    </div>
    <!--end::Content-->

@endsection

@push('admin_js')
    <script>
        $(document).ready(function () {
            let city_id = $("#city_id");
            city_id.select2();
        });
    </script>
@endpush
