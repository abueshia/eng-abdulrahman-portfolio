@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit About'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add About'))
@endif



@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Abouts'), 'link' => route('admin.about.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to About'), 'link' => route('admin.about.index')]">
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
                                    <input type="hidden" name="id" value="{{$about->id}}">

                            @endif
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('title in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('title.'.$key) ?? $about->getTranslation('title',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('title in')}} {{__('methods.' . $lang)}}"
                                                       name="title[{{ $key}}]"/>
                                                @error('title.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach


                                 
            

               @foreach (Config('language') as $key => $lang)
    <div class="col-12 mb-5">
        <label class="fs-5 fw-bold form-label mb-5">
            {{ \App\Helpers\TranslationHelper::translate('Description in') }} {{ __('methods.' . $lang) }}
        </label>
        <textarea class="form-control form-control-solid full-editor" name="description[{{ $key }}]" rows="5" id="description{{$key}}"
                  style="height: 300px; direction: rtl;">{{ old('description.'.$key) ?? $about->getTranslation('description', $key) }}</textarea>
        @error('description.'.$key)
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endforeach



                                             
                                             <div class="col-6  mb-5">
                                                <!--begin::Label-->
                                                <label class="fs-5 fw-bold form-label mb-5">{{\App\Helpers\TranslationHelper::translate('Image')}} : <span
                                                        class="text-danger"> {{\App\Helpers\TranslationHelper::translate('Size')}} <span dir="ltr">400 x 400</span></span></label>
                                                <!--end::Label-->
                                                <input type="file" class="form-control form-control-solid" name="image"/>
                                                @error('image')
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                                @if($about->getFirstMediaUrl('abouts_image') != null)
                                                    <img src="{{ $about->getFirstMediaUrl('abouts_image') }}"
                                                         alt="abouts" width="100px"
                                                         style="border-radius: 5px">
                                                @endif
                                            </div>


            {{-- @foreach (Config('language') as $key => $lang)
    <div class="col-12 mb-5">
        <label class="fs-5 fw-bold form-label mb-5">
            {{ \App\Helpers\TranslationHelper::translate('description_story in') }} {{ __('methods.' . $lang) }}
        </label>
        <textarea class="form-control form-control-solid full-editor" name="description_story[{{ $key }}]" rows="5" id="description_story{{$key}}"
                  style="height: 300px; direction: rtl;">{{ old('description_story.'.$key) ?? $about->getTranslation('description_story', $key) }}</textarea>
        @error('description_story.'.$key)
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endforeach


            @foreach (Config('language') as $key => $lang)
    <div class="col-12 mb-5">
        <label class="fs-5 fw-bold form-label mb-5">
            {{ \App\Helpers\TranslationHelper::translate('description_see_us in') }} {{ __('methods.' . $lang) }}
        </label>
        <textarea class="form-control form-control-solid full-editor" name="description_see_us[{{ $key }}]" rows="5" id="description_see_us{{$key}}"
                  style="height: 300px; direction: rtl;">{{ old('description_see_us.'.$key) ?? $about->getTranslation('description_see_us', $key) }}</textarea>
        @error('description_see_us.'.$key)
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endforeach

            @foreach (Config('language') as $key => $lang)
    <div class="col-12 mb-5">
        <label class="fs-5 fw-bold form-label mb-5">
            {{ \App\Helpers\TranslationHelper::translate('description_our_mission in') }} {{ __('methods.' . $lang) }}
        </label>
        <textarea class="form-control form-control-solid full-editor" name="description_our_mission[{{ $key }}]" rows="5" id="description_our_mission{{$key}}"
                  style="height: 300px; direction: rtl;">{{ old('description_our_mission.'.$key) ?? $about->getTranslation('description_our_mission', $key) }}</textarea>
        @error('description_our_mission.'.$key)
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endforeach

            @foreach (Config('language') as $key => $lang)
    <div class="col-12 mb-5">
        <label class="fs-5 fw-bold form-label mb-5">
            {{ \App\Helpers\TranslationHelper::translate('description_about_the_plan in') }} {{ __('methods.' . $lang) }}
        </label>
        <textarea class="form-control form-control-solid full-editor" name="description_about_the_plan[{{ $key }}]" rows="5" id="description_about_the_plan{{$key}}"
                  style="height: 300px; direction: rtl;">{{ old('description_about_the_plan.'.$key) ?? $about->getTranslation('description_about_the_plan', $key) }}</textarea>
        @error('description_about_the_plan.'.$key)
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endforeach

                                 <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{\App\Helpers\TranslationHelper::translate('Image tow')}}
                                                : <span
                                                    class="text-danger"> {{\App\Helpers\TranslationHelper::translate('Size')}} <span
                                                        dir="ltr">400 x 400</span></span></label>
                                            <!--end::Label-->
                                            <input type="file" class="form-control form-control-solid" name="meta_image"/>
                                            @error('meta_image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            @if($about->getFirstMediaUrl('abouts_meta_image') != null)
                                                <img src="{{ $about->getFirstMediaUrl('abouts_meta_image') }}"
                                                     alt="abouts" width="100px"
                                                     style="border-radius: 5px">
                                            @endif
                                        </div> --}}


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






