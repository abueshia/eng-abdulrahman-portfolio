@extends('admin.layouts.app') 

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Informationhotel'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Informationhotel'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Information flights'), 'link' => route('admin.informationhotel.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Informationhotel'), 'link' => route('admin.informationhotel.index')]">
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
                                    <input type="hidden" name="id" value="{{$informationhotel->id}}">

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
                                                       value="{{ old('name.'.$key) ?? $informationhotel->getTranslation('name',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}"
                                                       name="name[{{ $key}}]"/>
                                                @error('name.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach


                                                  @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('meta_title in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('meta_title.'.$key) ?? $informationhotel->getTranslation('meta_title',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('meta_title in')}} {{__('methods.' . $lang)}}"
                                                       name="meta_title[{{ $key}}]"/>
                                                @error('meta_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach


                                        <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{\App\Helpers\TranslationHelper::translate('linke')}}
                                                : 
                                             </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="url" class="form-control form-control-solid"
                                                value="{{ old('linke') ?? $informationhotel->linke }}"
                                                placeholder="{{\App\Helpers\TranslationHelper::translate('linke')}}"
                                                name="linke"/>
                                            @error('linke')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                       

                                        <div class="col-6  mb-5">
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
                                            @if($informationhotel->getFirstMediaUrl('information_hotels') != null)
                                                <img src="{{ $informationhotel->getFirstMediaUrl('information_hotels') }}"
                                                     alt="information_hotels" width="100px"
                                                     style="border-radius: 5px">
                                            @endif
                                        </div>

{{-- 
                                          <div class="col-6 mb-5">
                                            <label class="fs-5 fw-bold form-label mb-5">
                                                {{ \App\Helpers\TranslationHelper::translate('Name') }}
                                                :
                                            </label>
                                            
                                            <input type="text" class="form-control form-control-solid"
                                                value="{{ old('name_job') ?? $informationhotel->name_job }}"
                                                placeholder="{{ \App\Helpers\TranslationHelper::translate('name_job') }}"
                                                name="name_job" />
                                            @error('name_job')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                         --}}

                                        {{-- @endforeach --}}
{{-- 
                                        <div class="col-6  mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('Image') }}
                                                : <span class="text-danger">
                                                    {{ \App\Helpers\TranslationHelper::translate('Size') }} <span
                                                        dir="ltr">400 x 400</span></span></label>
                                            <input type="file" class="form-control form-control-solid" name="image"
                                                value="{{ old('image') ?? $informationhotel->getFirstMediaUrl('informationhotels') }}" />
                                            @error('image')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            @if ($informationhotel->getFirstMediaUrl('informationhotels_image') != null)
                                                <img src="{{ $informationhotel->getFirstMediaUrl('informationhotels') }}" alt="informationhotels"
                                                    width="100px" style="border-radius: 5px">
                                            @endif
                                        </div>

                                        <div class="col-12  mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('Description') }}
                                            </label>
                                            <textarea class="form-control form-control-solid " name="description" rows="5" id="description1"
                                                      style="height: 300px; direction: rtl;">{{ old('description') ?? $informationhotel->description }}</textarea>
                                            @error('description')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}

                                    
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
@endpush

