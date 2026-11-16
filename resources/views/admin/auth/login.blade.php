@extends('admin.layouts.master')

@section('content')
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid">
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <div class="symbol symbol-100px mb-8">
                    <div class="symbol-label bg-light-primary text-primary fw-bolder fs-1 rounded-4">
                        <i class="fas fa-laptop-code text-primary fs-2hx"></i>
                    </div>
                </div>

                <h1 class="text-gray-900 fs-2qx fw-bold text-center mb-4">
                    {{ \App\Helpers\TranslationHelper::translate('Eng. Abdelrahman Abu Aishah') }}
                </h1>
                <div class="text-gray-600 fs-4 text-center fw-semibold mw-450px">
                    {{ \App\Helpers\TranslationHelper::translate('Full-Stack Software Engineer (PHP Laravel & React.js)') }}
                </div>
            </div>
        </div>
        <!--end::Aside-->

        <!--begin::Body-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-550px p-10 shadow-sm">
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px w-100">
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-10">
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                              action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="text-center mb-10">
                                <h1 class="text-gray-900 fw-bolder mb-3">
                                    {{ \App\Helpers\TranslationHelper::translate('Log In') }}
                                </h1>
                                <div class="text-gray-500 fw-semibold fs-6">
                                    {{ \App\Helpers\TranslationHelper::translate('Portfolio Administration Dashboard') }}
                                </div>
                            </div>

                            <div class="fv-row mb-6">
                                <label class="form-label fw-bold text-gray-800 mb-2">
                                    {{ __('dashboard.email') }}
                                </label>
                                <input class="form-control bg-transparent {{ $errors->has('email') || $errors->has('credentials') ? 'is-invalid' : '' }}"
                                       type="email" name="email" value="{{ old('email') }}" autocomplete="email" dir="ltr" required />
                                @if ($errors->has('email'))
                                    <span class="text-danger fs-7 d-block mt-1">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="fv-row mb-6">
                                <label class="form-label fw-bold text-gray-800 mb-2">
                                    {{ __('dashboard.password') }}
                                </label>
                                <input class="form-control bg-transparent {{ $errors->has('password') || $errors->has('credentials') ? 'is-invalid' : '' }}"
                                       type="password" name="password" autocomplete="current-password" dir="ltr" required />
                                @if ($errors->has('password'))
                                    <span class="text-danger fs-7 d-block mt-1">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('credentials'))
                                    <span class="text-danger fs-7 d-block mt-1">
                                        <strong>{{ $errors->first('credentials') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="d-grid mb-6">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ \App\Helpers\TranslationHelper::translate('Log In') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
@endsection
