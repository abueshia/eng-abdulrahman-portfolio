@extends('admin.layouts.app')

@if($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Admin'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Admin'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Admins'),'link'=>route('admin.admin.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]" :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to Admins'),'link'=>route('admin.admin.index')]">
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
                                    <input type="hidden" name="id" value="{{$admin->id}}">

                            @endif
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        <div class="col-6 mb-5">
                                            <label class="fs-5 fw-bold form-label mb-5" for="name">
                                                {{\App\Helpers\TranslationHelper::translate('Name')}}:
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                   value="{{ old('name') ?? $admin->name}}" id="name"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('Name')}}"
                                                   name="name"/>
                                            @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-6 mb-5">
                                            <label class="fs-5 fw-bold form-label mb-5" for="email">
                                                {{\App\Helpers\TranslationHelper::translate('Email')}}:
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" class="form-control form-control-solid"
                                                   value="{{ old('email') ?? $admin->email}}" id="email"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('Email')}}"
                                                   name="email"/>
                                            @error('email')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 mb-5">
                                            <label class="fs-5 fw-bold form-label mb-5" for="password">
                                                {{\App\Helpers\TranslationHelper::translate('Password')}}:
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" class="form-control form-control-solid"
                                                   value="" id="password"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('Password')}}"
                                                   name="password"/>
                                            @error('password')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-6 mb-5">
                                            <label class="fs-5 fw-bold form-label mb-5" for="role_id">
                                                {{\App\Helpers\TranslationHelper::translate('Choose Role')}}:
                                            </label>

                                            <select name="role_id" id="role_id"
                                                    class="form-control form-control-solid">
                                                <option value="">{{\App\Helpers\TranslationHelper::translate('Choose Role')}}</option>
                                                @if($method == 'PUT')
                                                    @foreach($roles as $role)
                                                        <option
                                                            value="{{$role->id}}" {{  $admin->roles?->first()?->id == $role->id ? 'selected' : ''}}>
                                                            {{$role->name}}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach($roles as $role)
                                                        <option
                                                            value="{{$role->id}}" {{  old('role_id') == $role->id ? 'selected' : ''}}>
                                                            {{$role->name}}
                                                        </option>
                                                    @endforeach

                                                @endif
                                            </select>
                                            @error('role_id')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5" for="branche_id">
        {{\App\Helpers\TranslationHelper::translate('Choose Branch')}}:
    </label>

    <select name="branche_id" id="branche_id" class="form-control form-control-solid">
        <option value="">{{\App\Helpers\TranslationHelper::translate('Choose Branch')}}</option>
        @if($method == 'PUT')
            @foreach($branches as $branch)
                <option value="{{$branch->id}}" {{  $admin->branches?->first()?->id == $branch->id ? 'selected' : ''}}>
                    {{$branch->name}}
                </option>
            @endforeach
        @else
            @foreach($branches as $branch)
                <option value="{{$branch->id}}" {{  old('branche_id') == $branch->id ? 'selected' : ''}}>
                    {{$branch->name}}
                </option>
            @endforeach
        @endif
    </select>
    @error('branche_id')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
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
        <!--end::Content-->

@endsection
