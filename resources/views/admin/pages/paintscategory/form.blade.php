@extends('admin.layouts.app')

@if($method == 'PUT')
@section('title', \App\Helpers\TranslationHelper::translate('Edit Paints category'))
@else
@section('title', \App\Helpers\TranslationHelper::translate('Add Paints category'))
@endif

@section('crumb')
<x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Paints category'),'link'=>route('admin.paintscategory.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]"
    :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to Paints category'),'link'=>route('admin.paintscategory.index')]">
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
                            @if($method == 'PUT')
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$paintscategory->id}}">

                            @endif
                            <!--begin::Input paintscategory-->
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
                                            value="{{ old('name.'.$key) ?? $paintscategory->getTranslation('name',$key)}}"
                                            placeholder="{{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}"
                                            name="name[{{ $key}}]" />
                                        @error('name.'.$key)
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @endforeach

                                </div>

   <div class="col-6 mb-5">
    <!-- Label -->
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Image') }}:
        <span class="text-danger">
            {{ \App\Helpers\TranslationHelper::translate('Size') }} <span dir="ltr">400 x 400</span>
        </span>
    </label>

    <!-- حقل رفع صورة واحدة -->
    <input type="file" class="form-control form-control-solid" name="image" />
    @error('image')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <!-- عرض الصورة الحالية إن وجدت -->
    @if($paintscategory->getFirstMediaUrl('paints_category'))
        <img src="{{ $paintscategory->getFirstMediaUrl('paints_category') }}" 
             alt="paints_category" 
             width="100px" 
             style="border-radius: 5px" />
    @endif
</div>



                                <!--begin::Label-->
                            </div>
                            <!--end::Input paintscategory-->

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