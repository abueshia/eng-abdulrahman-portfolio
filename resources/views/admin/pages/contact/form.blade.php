@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Contact'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Contact'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Contacts'), 'link' => route('admin.contact.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Contact'), 'link' => route('admin.contact.index')]">
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
                            @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($method == 'PUT')
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$contact->id}}">

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
                                                       value="{{ old('title.'.$key) ?? $contact->getTranslation('title',$key)}}"
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
                  style="height: 300px; direction: rtl;">{{ old('description.'.$key) ?? $contact->getTranslation('description', $key) }}</textarea>
        @error('description.'.$key)
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endforeach

                                        

{{-- 
                                @foreach (Config('language') as $key => $lang)
                                                   <div class="col-12  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('address in')}} {{__('methods.' . $lang)}}
                                            </label>
                                            <!--end::Label-->
                                            <textarea class="form-control form-control-solid full-editor" name="address[{{ $key}}]" rows="5" id="address{{$key}}"
                                                      style="height: 300px; direction: rtl;">{{ old('address.'.$key) ?? $contact->getTranslation('address',$key)}}</textarea>
                                            @error('address.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        @endforeach --}}

         @foreach (Config('language') as $key => $lang)
    <div class="col-6 mb-5">
        <!--begin::Label-->
        <label class="fs-5 fw-bold form-label mb-5">
            {{ \App\Helpers\TranslationHelper::translate('address in') }} {{ __('methods.' . $lang) }}
        </label>
        <!--end::Label-->
        <input type="text" class="form-control form-control-solid" 
               name="address[{{ $key }}]" 
               value="{{ old('address.' . $key) ?? $contact->getTranslation('address', $key) }}" 
               id="address{{ $key }}" 
               style="direction: rtl;" />
        @error('address.' . $key)
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    @endforeach





                                        <div class="col-6 mb-5">
    <!--begin::Label-->
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('facebook') }}:
    </label>
    <!--end::Label-->
    <input type="text" class="form-control form-control-solid" name="facebook"
           value="{{ old('facebook') ?? $contact->facebook }}" />
    @error('facebook')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="col-6 mb-5">
    <!--begin::Label-->
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('instagram') }}:
    </label>
    <!--end::Label-->
    <input type="text" class="form-control form-control-solid" name="iniesta"
           value="{{ old('iniesta') ?? $contact->iniesta }}" />
    @error('iniesta')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="col-6 mb-5">
    <!--begin::Label-->
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('whatsapp') }}:
    </label>
    <!--end::Label-->
    <input type="text" class="form-control form-control-solid" name="whatsapp"
           value="{{ old('whatsapp') ?? $contact->whatsapp }}" />
    @error('whatsapp')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="col-6 mb-5">
    <!--begin::Label-->
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('phone') }}:
    </label>
    <!--end::Label-->
    <input type="text" class="form-control form-control-solid" name="phono"
           value="{{ old('phono') ?? $contact->phono }}" />
    @error('phono')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>




<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Youtube') }}:
    </label>
    <input type="text" class="form-control form-control-solid" name="tiktok"
           value="{{ old('tiktok') ?? $contact->tiktok }}" />
    @error('tiktok')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="col-6 mb-5">
    <!--begin::Label for X-->
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('E-mail') }}:
    </label>
    <!--end::Label-->
    <input type="text" class="form-control form-control-solid" name="x"
           value="{{ old('x') ?? $contact->x }}" />
    @error('x')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

              




              

                                          {{-- @foreach (Config('language') as $key => $lang)
                                            <div class="col-6  mb-5">
                                                <!--begin::Label-->
                                                <label
                                                    class="fs-5 fw-bold form-label mb-5">{{\App\Helpers\TranslationHelper::translate('meta_Title')}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <input type="text" class="form-control form-control-solid" name="meta_title[{{ $key}}]"
                                                       value="{{ old('meta_title.'.$key) ?? $contact->getTranslation('meta_title',$key)}}" />
                                                @error('meta_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        @endforeach

                                          @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('alt_text in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('alt_text.'.$key) ?? $contact->getTranslation('alt_text',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('alt_text in')}} {{__('methods.' . $lang)}}"
                                                       name="alt_text[{{ $key}}]"/>
                                                @error('alt_text.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach

                                          @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('meta_tags in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('meta_tags.'.$key) ?? $contact->getTranslation('meta_tags',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('meta_tags in')}} {{__('methods.' . $lang)}}"
                                                       name="meta_tags[{{ $key}}]"/>
                                                @error('meta_tags.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach

                                        @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('meta_description in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea class="form-control form-control-solid" rows="5"
                                                          placeholder="{{\App\Helpers\TranslationHelper::translate('meta_description in')}} {{__('methods.' . $lang)}}"
                                                          name="meta_description[{{ $key}}]">{{ old('meta_description.'.$key) ?? $contact->getTranslation('meta_description',$key)}}</textarea>
                                                @error('meta_description.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach



                                        <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{\App\Helpers\TranslationHelper::translate('meta_Image')}}
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
                                            @if($contact->getFirstMediaUrl('contacts_meta_image') != null)
                                                <img src="{{ $contact->getFirstMediaUrl('contacts_meta_image') }}"
                                                     alt="contacts" width="100px"
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

<script src="{{asset('dashboard/assets/js/tags-input.min.js')}}"></script>
@endpush

