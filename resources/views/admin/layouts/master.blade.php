<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic
Product Version: 8.2.3
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <title>{{ \App\Helpers\TranslationHelper::translate('Eng. Abdelrahman Abu Aishah') }}</title>
    {{-- {{setting('title_one')}}  --}}
    <meta charset="utf-8"/>
    <meta name="description"
          content="Eng. Abdelrahman Abu Aishah Portfolio Dashboard"/>
    <meta name="keywords"
          content="Eng. Abdelrahman Abu Aishah, Software Engineer, Portfolio Dashboard"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="Eng. Abdelrahman Abu Aishah Portfolio Dashboard"/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content="Eng. Abdelrahman Abu Aishah"/>
    <link rel="canonical" href=""/>
    <link rel="shortcut icon" href="{{asset('dashboard/assets/media/logos/user.png')}}"/>
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{asset('dashboard/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{asset('dashboard/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.8/build/css/intlTelInput.css">

    <link href="{{asset('dashboard/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>
<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
    <style>
        body {
            background-image: url('{{asset('dashboard/assets/media/auth/bg10.jpeg')}}');
        }

        [data-bs-theme="dark"] body {
            background-image: url('{{asset('dashboard/assets/media/auth/bg10-dark.jpeg')}}');
        }
    </style>
    <!--end::Page bg image-->
    <!--begin::Authentication - Sign-in -->
@yield('content')
<!--end::Authentication - Sign-in-->
</div>
<!--end::Authentication - Multi-steps-->
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{asset('dashboard/assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('dashboard/assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.8/build/js/intlTelInput.min.js"></script>

<script src="{{asset('dashboard/assets/js/custom/utilities/modals/create-account.js')}}"></script>
<!--end::Custom Javascript-->
<script>
    const input = document.querySelector("#phone");
    window.intlTelInput(input, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.8/build/js/utils.js",
    });
</script>
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>
