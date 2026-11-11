@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush



@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ @($coupon != null)? 'Edit': 'Add'}} {{\App\Helpers\TranslationHelper::translate('Coupon')}}
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('dashboard.index')}}" class="text-muted text-hover-primary">{{\App\Helpers\TranslationHelper::translate('Home')}}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">{{\App\Helpers\TranslationHelper::translate('Coupon')}}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">{{\App\Helpers\TranslationHelper::translate('Add')}}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif


        <!--begin::Row-->
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <div class="card">
                    <div class="card-body">
                        <!--begin::Col-->

                        @if (@($coupon != null))
                            <form action="{{ route('dashboard.coupon.update', $coupon->id) }}" method="POST"
                                  class="form-horizontal addStudentFRM" enctype="multipart/form-data">

                                @method('PUT')
                                @else
                                    <form action="{{ route('dashboard.coupon.store') }}" method="POST"
                                          class="form-horizontal addStudentFRM" enctype="multipart/form-data">
                                        @endif

                                        @csrf
                                        <div class="row">
                                            <div class="col-6 col-md-6 my-3">

                                                <div class="input__group mb-25">
                                                    <label>
                                                        {{\App\Helpers\TranslationHelper::translate('Coupon')}}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                           value="{{ old('coupon',  isset($coupon) ? $coupon->coupon : '') }}"
                                                           name="coupon" autocomplete="coupon"
                                                           placeholder="{{\App\Helpers\TranslationHelper::translate('Enter Coupon')}}"
                                                           class="form-control"/>
                                                </div>

                                                @error('coupon')
                                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 my-3">
                                                <div class="input__group mb-25">
                                                    <label>{{\App\Helpers\TranslationHelper::translate('Hotel')}}</label>
                                                    <select name="hotel_id" id="hotel_id" class="form-select">
                                                        @foreach ($hotels as $hotel)
                                                            <option value="{{ $hotel->id }}"
                                                                {{ old('hotel_id', isset($coupon) ? ($coupon->hotel_id == $hotel->id ? 'selected' : '') : '') }}>
                                                                {{ $hotel->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6 col-md-6 my-3">

                                                <div class="input__group mb-25">
                                                    <label>
                                                        {{\App\Helpers\TranslationHelper::translate('Discount (%)')}}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" max="99" min="1"
                                                           value="{{ old('discount',  isset($coupon) ? $coupon->discount : '') }}"
                                                           name="discount" autocomplete="discount"
                                                           placeholder="{{\App\Helpers\TranslationHelper::translate('Enter Discount')}}"
                                                           class="form-control"/>
                                                </div>

                                                @error('discount')
                                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-6 col-md-6 my-3">

                                                <div class="input__group mb-25">
                                                    <label>
                                                        {{\App\Helpers\TranslationHelper::translate('Start Date')}}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="date"
                                                           value="{{ old('start_date',  isset($coupon) ? $coupon->start_date : '') }}"
                                                           name="start_date" autocomplete="start_date"
                                                           placeholder="{{\App\Helpers\TranslationHelper::translate('Enter start_date')}}"
                                                           class="form-control"/>
                                                </div>

                                                @error('start_date')
                                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-6 col-md-6 my-3">

                                                <div class="input__group mb-25">
                                                    <label>
                                                         {{\App\Helpers\TranslationHelper::translate('End Date')}}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="date"
                                                           value="{{ old('end_date',  isset($coupon) ? $coupon->end_date : '') }}"
                                                           name="end_date" autocomplete="end_date"
                                                           placeholder=" {{\App\Helpers\TranslationHelper::translate('Enter end_date')}}"
                                                           class="form-control"/>
                                                </div>

                                                @error('end_date')
                                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                                <div class="col-md-6 text-right" style="text-align: right;margin-top: 10px">
                                                    <button class="btn btn-primary" type="submit">
                                                         {{\App\Helpers\TranslationHelper::translate('Save')}}
                                                    </button>
                                                </div>
                                        </div>

                                        <div class="row mb-3">

                                        </div>
                                    </form>
                                    <!--end::Col-->
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection



@push('scripts')
    <script>
        $(document).ready(function () {
            let hotel_id = $("#hotel_id");
            hotel_id.select2();
        });
    </script>
@endpush
