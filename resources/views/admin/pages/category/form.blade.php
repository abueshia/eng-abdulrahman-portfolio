@extends('admin.layouts.app')

@if($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Category'))

@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Category'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Categories'),'link'=>route('admin.category.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]"
                   :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to Category'),'link'=>route('admin.category.index')]">
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
                                    <input type="hidden" name="id" value="{{ $category->id }}">
                                @endif
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        {{-- @foreach (Config('language') as $key => $lang)
                                        <div class="col-6 mb-5">
                                            <label class="fs-5 fw-bold form-label mb-5">
                                                {{ \App\Helpers\TranslationHelper::translate('Name') }}
                                                :
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                value="{{ old('name') ?? $category->name }}"
                                                placeholder="{{ \App\Helpers\TranslationHelper::translate('Name') }}"
                                                name="name" />
                                            @error('name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                         @endforeach --}}

                                          @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('name in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('name.'.$key) ?? $category->getTranslation('name',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('name in')}} {{__('methods.' . $lang)}}"
                                                       name="name[{{ $key}}]"/>
                                                @error('name.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach

                                           

                                        {{-- <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{\App\Helpers\TranslationHelper::translate('Image')}}
                                                : <span
                                                    class="text-danger"> {{\App\Helpers\TranslationHelper::translate('Size')}} <span
                                                        dir="ltr">400 x 400</span></span></label>
                                            <!--end::Label-->
                                            <input type="file" class="form-control form-control-solid" name="image"/>
                                            @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            @if($category->getFirstMediaUrl('categories') != null)
                                                <img src="{{ $category->getFirstMediaUrl('categories') }}"
                                                     alt="categories" width="100px"
                                                     style="border-radius: 5px">
                                            @endif
                                        </div>

                                           <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('meta_Title') }}
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid" name="meta_title"
                                                value="{{ old('meta_title') ?? $category->meta_title }}" />
                                            @error('meta_title')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                    </div>

                                     <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('meta_Image') }}
                                                : <span class="text-danger">
                                                    {{ \App\Helpers\TranslationHelper::translate('Size') }} <span
                                                        dir="ltr">400 x 400</span></span></label>
                                            <!--end::Label-->
                                            <input type="file" class="form-control form-control-solid" name="meta_image" />
                                            @error('meta_image')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            @if ($category->getFirstMediaUrl('categories_meta_image') != null)
                                                <img src="{{ $category->getFirstMediaUrl('categories_meta_image') }}" alt="categorys"
                                                    width="100px" style="border-radius: 5px">
                                            @endif
                                        </div> --}}

                                          {{-- <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('alt_text') }}
                                            </label>
                                            <!--end::Label-->
                                            <input type="text" class="form-control form-control-solid" name="alt_text"
                                                value="{{ old('alt_text') ?? $category->alt_text }}" />
                                            @error('alt_text')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}

                                   
{{-- 
                                        <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('meta_tags') }}</label>
    <input type="text" class="form-control" name="meta_tags" data-role="tagsinput"
           value="{{ old('meta_tags') ?? $category->meta_tags }}" id="meta-tags">
    @error('meta_tags')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

 --}}

{{-- 
                                            <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('meta_Description') }}
                                            </label>
                                            <!--end::Label-->
                                            <textarea class="form-control form-control-solid" name="meta_description" rows="5"
                                                      style="">{{ old('meta_description') ?? $category->meta_description }}</textarea>
                                            @error('meta_description')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}


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
