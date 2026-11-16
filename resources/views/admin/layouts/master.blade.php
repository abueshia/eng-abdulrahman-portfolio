<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ \App\Helpers\TranslationHelper::translate('Eng. Abdelrahman Abu Aishah') }} — {{ \App\Helpers\TranslationHelper::translate('Log In') }}</title>
    <meta name="description" content="Eng. Abdelrahman Abu Aishah Portfolio Administration Dashboard" />
    <link rel="shortcut icon" href="{{ asset('dashboard/assets/media/logos/user.png') }}" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle-->
    <link href="{{ asset('dashboard/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/assets/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/assets/css/dashboard-common.css') }}" rel="stylesheet" type="text/css" />
    @if (app()->getLocale() === 'ar')
        <link href="{{ asset('dashboard/assets/css/dashboard-rtl.css') }}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{ asset('dashboard/assets/css/dashboard-ltr.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <!--end::Global Stylesheets Bundle-->
    @stack('admin_css')
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body" class="app-blank">
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <style>
        body {
            background-image: url('{{ asset('dashboard/assets/media/auth/bg10.jpeg') }}');
        }
        [data-bs-theme="dark"] body {
            background-image: url('{{ asset('dashboard/assets/media/auth/bg10-dark.jpeg') }}');
        }
    </style>
    @yield('content')
</div>

<script src="{{ asset('dashboard/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/scripts.bundle.js') }}"></script>
@stack('admin_js')
</body>
<!--end::Body-->
</html>
