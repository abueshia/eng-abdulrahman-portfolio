@extends('admin.layouts.app')

@if($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Offer'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Offer'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Offer'),'link'=>route('admin.offer.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]" :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to Offer'),'link'=>route('admin.offer.index')]">
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
                                    <input type="hidden" name="id" value="{{$offer->id}}">

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
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('name.'.$key) ?? $offer->getTranslation('name',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}"
                                                       name="name[{{ $key}}]"/>
                                                @error('name.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach

                                        
                                              {{-- @foreach (Config('language') as $key => $lang) --}}

               @foreach (Config('language') as $key => $lang)
    <div class="col-6 mb-5">
        <label class="fs-5 fw-bold form-label mb-5">
            {{ \App\Helpers\TranslationHelper::translate('description in') }} {{ __('methods.' . $lang) }} :
        </label>
        <textarea class="form-control form-control-solid"
                  placeholder="{{ \App\Helpers\TranslationHelper::translate('description in') }} {{ __('methods.' . $lang) }}"
                  name="description[{{ $key }}]"
                  rows="3">{{ old('description.' . $key) ?? $offer->getTranslation('description', $key) }}</textarea>
        @error('description.' . $key)
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endforeach


                                            {{-- <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">{{\App\Helpers\TranslationHelper::translate('Choose Country')}} :
                                                    <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <select name="country_id" id="country_id"
                                                        class="form-control form-control-solid">
                                                    <option value="">{{\App\Helpers\TranslationHelper::translate('Choose Country')}}</option>
                                                    @if($method == 'PUT')
                                                        @foreach($countries as $country)
                                                            <option
                                                                value="{{$country->id}}" {{  $offer->country_id == $country->id ? 'selected' : ''}}>
                                                                {{$country->name}}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        @foreach($countries as $country)
                                                            <option
                                                                value="{{$country->id}}" {{  old('country_id') == $country->id ? 'selected' : ''}}>
                                                                {{$country->name}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('country_id')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div> --}}

{{-- <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Choose Products') }} :
        <span class="text-danger">*</span>
    </label>
    <select name="products[]" id="products" class="form-control form-control-solid" multiple="multiple">
        <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Products') }}</option>
        @if($method == 'PUT')
            @foreach($products as $product)
                <option value="{{ $product->id }}" 
                        {{ in_array($product->id, old('products', $offer->products->pluck('id')->toArray())) ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        @else
            @foreach($products as $product)
                <option value="{{ $product->id }}" 
                        {{ in_array($product->id, old('products', [])) ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        @endif
    </select>
    @error('products')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div> --}}

{{-- <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Choose Product') }} :
        <span class="text-danger">*</span>
    </label>
    <select name="products[]" id="products" class="form-control form-control-solid">
        <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Product') }}</option>
        @if($method == 'PUT')
            @foreach($products as $product)
                <option value="{{ $product->id }}" 
                        {{ (old('products') && in_array($product->id, old('products', []))) ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        @else
            @foreach($products as $product)
                <option value="{{ $product->id }}" 
                        {{ (old('products') && old('products')[0] == $product->id) ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        @endif
    </select>
    @error('products')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div> --}}






<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Choose Branches') }} :
        <span class="text-danger">*</span>
    </label>
    <select name="branches[]" id="branches" class="form-control form-control-solid" multiple="multiple">
        <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Branches') }}</option>
        @if($method == 'PUT')
            @foreach($branches as $branch)
                <option value="{{ $branch->id }}" 
                        {{ in_array($branch->id, old('branches', $offer->branches->pluck('id')->toArray())) ? 'selected' : '' }}>
                    {{ $branch->name }}
                </option>
            @endforeach
        @else
            @foreach($branches as $branch)
                <option value="{{ $branch->id }}" 
                        {{ in_array($branch->id, old('branches', [])) ? 'selected' : '' }}>
                    {{ $branch->name }}
                </option>
            @endforeach
        @endif
    </select>
    @error('branches')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Choose Product') }} :
        <span class="text-danger">*</span>
    </label>
    <select name="products[]" id="products" class="form-control form-control-solid">
        <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Product') }}</option>
        
        @foreach($products as $product)
            <option value="{{ $product->id }}" 
                    {{ (old('products') && old('products')[0] == $product->id) || (isset($offer) && $offer->products->pluck('id')->first() == $product->id) ? 'selected' : '' }}>
                {{ $product->name }}
            </option>
        @endforeach
    </select>
    @error('products')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>



{{-- <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Discount %') }} :
    </label>
    <input type="number" class="form-control form-control-solid"
           value="{{ old('discount') ?? $offer->discount }}"
           placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Discount %') }}"
           name="discount"/>
    @error('discount')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div> --}}


<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Points') }} :
    </label>
    <input type="number" class="form-control form-control-solid"
           value="{{ old('point') ?? $offer->point }}"
           placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Points') }}"
           name="point"/>
    @error('point')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Voucher code') }} :
    </label>

    <div class="input-group">
        <!-- حقل إدخال الكود -->
        <input type="number" id="discount_number" class="form-control form-control-solid"
               value="{{ old('discount_number') ?? $offer->discount_number }}"
               placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Discount Number') }}"
               name="discount_number" readonly/>

        <!-- زر لتوليد كود عشوائي -->
        <button type="button" class="btn btn-outline-secondary" id="generate_discount_code">
            {{ \App\Helpers\TranslationHelper::translate('Generate Code') }}
        </button>
    </div>

    @error('discount_number')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

{{-- <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Voucher code') }} :
    </label>
    <input type="number" class="form-control form-control-solid"
           value="{{ old('discount_number') ?? $offer->discount_number }}"
           placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Discount Number') }}"
           name="discount_number"/>
    @error('discount_number')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div> --}}


{{-- <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('discount number') }} :
    </label>
    <input type="number" class="form-control form-control-solid"
           value="{{ old('discount_number') ?? $offer->discount_number }}"
           placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter discount number') }}"
           name="discount_number"/>
    @error('discount_number')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div> --}}


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
                                                @if($offer->getFirstMediaUrl('offers') != null)
                                                    <img src="{{ $offer->getFirstMediaUrl('offers') }}"
                                                         alt="offer" width="100px"
                                                         style="border-radius: 5px">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            let country_id = $("#country_id");
            country_id.select2();
        });
    </script>


  <script>
    $(document).ready(function() {
    // تطبيق select2 على حقل المنتجات
    $('#products').select2({
        placeholder: "{{ \App\Helpers\TranslationHelper::translate('Choose Products') }}",
        allowClear: true
    });
});


$(document).ready(function() {
    // تطبيق select2 على حقل الفروع
    $('#branches').select2({
        placeholder: "{{ \App\Helpers\TranslationHelper::translate('Choose Branches') }}",
        allowClear: true
    });
});

  </script>

  <script>
    document.getElementById('generate_discount_code').addEventListener('click', function() {
    // توليد 8 أرقام عشوائية
    const randomCode = Math.floor(10000000 + Math.random() * 90000000);

    // وضع الكود العشوائي في حقل الإدخال
    document.getElementById('discount_number').value = randomCode;
});

  </script>
@endpush
