@extends('admin.layouts.app')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{ @($tour_type != null)? 'Edit': 'Add'}} {{\App\Helpers\TranslationHelper::translate('Tour Type')}}
            </h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('admin.index')}}" class="text-muted text-hover-primary">{{\App\Helpers\TranslationHelper::translate('Home')}}</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">{{\App\Helpers\TranslationHelper::translate('Tour Type')}}</li>
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

                    @if (@($tour_type != null))
                    <form action="{{ route('admin.tour_type.update', $tour_type->id) }}" method="POST"
                        class="form-horizontal addStudentFRM" enctype="multipart/form-data">

                        @method('PUT')
                        @else
                        <form action="{{ route('admin.tour_type.store') }}" method="POST"
                            class="form-horizontal addStudentFRM" enctype="multipart/form-data">
                            @endif

                            @csrf
                            <div class="row">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-6 my-3">

                                    <div class="input__group mb-25">
                                        <label>
                                            {{\App\Helpers\TranslationHelper::translate('Name in')}} {{$lang}}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            value="{{ old('name',  isset($tour_type) ? $tour_type->getTranslation('name', $key) : '') }}"
                                            name="name_{{$key}}" autocomplete="name" placeholder="{{\App\Helpers\TranslationHelper::translate('Tour Type')}}"
                                            class="form-control" />
                                    </div>

                                        @error('name_[{{ $key }}]')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                </div>
                                    @endforeach
                            </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary" type="submit">
                                            {{\App\Helpers\TranslationHelper::translate('Save')}}
                                        </button>
                                    </div>
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

@endpush
