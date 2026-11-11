@extends('admin.layouts.app')

@if($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Category colid'))

@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Category colid'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('category colid'),'link'=>route('admin.categorycolid.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]"
                   :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to Category colid'),'link'=>route('admin.categorycolid.index')]">
    </x-bread-crumb>
@endsection
@push('admin_css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/tags-input.min.css') }}">
@endpush

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
                                @if ($method == 'PUT')
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $categorycolid->id }}">
                                @endif
                                <div class="fv-row mb-10">
                                    <div class="row">

                                          @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('name in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('name.'.$key) ?? $categorycolid->getTranslation('name',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('name in')}} {{__('methods.' . $lang)}}"
                                                       name="name[{{ $key}}]"/>
                                                @error('name.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach


                                                        <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bold form-label mb-5">
                                                 {{ \App\Helpers\TranslationHelper::translate('Category') }}
                                                :
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select form-select-solid" name="category_id">
                                                <option
                                                    value="">{{ \App\Helpers\TranslationHelper::translate('Choose Category') }}</option>
                                                @foreach ($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}" {{ $categorycolid->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
    <script src="{{ asset('dashboard/assets/js/tags-input.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#meta-tags').tagsinput();
        });
    </script>
@endpush
