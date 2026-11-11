@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush


@if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Own Brands'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Own Brands'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Own Brands'), 'link' => route('admin.gallery.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ]"
                   :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Own Brands'), 'link' => route('admin.gallery.index')]">
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if ($method == 'PUT')
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $gallery->id }}">
                            @endif
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        {{-- @foreach (Config('language') as $key => $lang) --}}
                                        {{-- <div class="col-6 mb-5">
                                            <label class="fs-5 fw-bold form-label mb-5">
                                                {{ \App\Helpers\TranslationHelper::translate('Name') }}
                                                :
                                            </label>
                                            <input type="text" class="form-control form-control-solid"
                                                   value="{{ old('name') ?? $gallery->name }}"
                                                   placeholder="{{ \App\Helpers\TranslationHelper::translate('Name') }}"
                                                   name="name"/>
                                            @error('name')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}

                                        {{-- <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bold form-label mb-5">
                                                {{ \App\Helpers\TranslationHelper::translate('Categorygallery') }}
                                                :
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select form-select-solid" name="categorygallery_id">
                                                <option
                                                    value="">{{ \App\Helpers\TranslationHelper::translate('Choose Categorygallery') }}</option>
                                                @foreach ($categories as $categorygallery)
                                                    <option
                                                        value="{{ $categorygallery->id }}" {{ $gallery->categorygallery_id == $categorygallery->id ? 'selected' : '' }}>
                                                        {{ $categorygallery->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('categorygallery_id')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}

                                        {{-- @endforeach --}}

                                        <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('Image') }}
                                                : <span class="text-danger">
                                                    {{ \App\Helpers\TranslationHelper::translate('Size') }} <span
                                                        dir="ltr">400 x 400</span></span></label>
                                            <!--end::Label-->
                                            <input type="file" class="form-control form-control-solid" name="image"/>
                                            @error('image')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            @if ($gallery->getFirstMediaUrl('galleries_image') != null)
                                                <img src="{{ $gallery->getFirstMediaUrl('galleries_image') }}" alt="galleries"
                                                     width="100px" style="border-radius: 5px">
                                            @endif
                                        </div>


                                       

                                    </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mb-5">
                                        <span
                                            class="indicator-label">{{ \App\Helpers\TranslationHelper::translate('Save') }}</span>
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

    <script src="{{asset('dashboard/assets/js/tags-input.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#meta_tags').select2({
                tags: true,
                placeholder: 'Select or create options',
                allowClear: true
            });
        });
    </script>
@endpush

