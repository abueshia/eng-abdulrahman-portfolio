@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Points setting'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Points setting'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Points settings'), 'link' => route('admin.pointssetting.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Points setting'), 'link' => route('admin.pointssetting.index')]">
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
                                    <input type="hidden" name="id" value="{{$pointssetting->id}}">

                            @endif
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        {{-- @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('title in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('title.'.$key) ?? $pointssetting->getTranslation('title',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('title in')}} {{__('methods.' . $lang)}}"
                                                       name="title[{{ $key}}]"/>
                                                @error('title.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach --}}


                                                 {{-- <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ __('Number of invite_friend') }}:
    </label>
    <input type="number" name="invite_friend" class="form-control form-control-solid" 
           value="{{ old('invite_friend') }}" placeholder="{{ __('Enter number of invite_friend') }}">
    @error('invite_friend')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div> --}}


<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ __('Number of invite_friend') }}:
    </label>
    <input type="number" name="invite_friend" class="form-control form-control-solid" 
           value="{{ old('invite_friend', $pointssetting->invite_friend ?? '') }}" 
           placeholder="{{ __('Enter number of invite_friend') }}">
    @error('invite_friend')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


         <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ __('Number of product_code') }}:
    </label>
    <input type="number" name="product_code" class="form-control form-control-solid" 
           value="{{ old('product_code', $pointssetting->product_code ?? '') }}" placeholder="{{ __('Enter number of product_code') }}">
    @error('product_code')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


        <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ __('Number of new_registration') }}:
    </label>
    <input type="number" name="new_registration" class="form-control form-control-solid" 
           value="{{ old('new_registration', $pointssetting->new_registration ?? '') }}" placeholder="{{ __('Enter number of new_registration') }}">
    @error('new_registration')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


                                     
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
<script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
@endpush

@push('admin_js')
<script>
    // استهداف كل textarea بعلامة full-editor
    document.querySelectorAll('.full-editor').forEach((editor) => {
        CKEDITOR.replace(editor.id, {
            // إضافة الخطوط المطلوبة
            font_names: 'Arial/Arial, Helvetica, sans-serif;' +
                'Courier New/Courier New, Courier, monospace;' +
                'Advertising/Advertising, sans-serif;' +
                'Amiri/Amiri, serif;' +
                'Tajawal/Tajawal, sans-serif;' +
                'Traditional Arabic/Traditional Arabic, serif;',
            contentsLangDirection: 'rtl', // تفعيل الكتابة من اليمين لليسار للعربية
            height: 300 // ارتفاع المحرر
        });
    });
</script>
@endpush
@push('admin_js')
<script src="{{asset('dashboard/assets/js/tags-input.min.js')}}"></script>
@endpush

