<!DOCTYPE html>

<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">

<!--begin::Head-->
<head>
    <base href="">
   
    <title>Dr-Mohamed Hamza - @yield('title') </title>
{{-- {{__('dashboard.CGI')}} --}}
    <meta name="description" content="{{ $title ?? '' }}"/>
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta property="og:locale" content=""/>
    <meta property="og:type" content=""/>
    <meta property="og:title" content=""/>
    <meta property="og:url" content=""/>

    

    <meta property="og:site_name" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
 <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    
    <script src="{{asset('dashboard/assets/js/toastr.js')}}"></script>
    <link rel="stylesheet" href="{{asset('dashboard/assets/css/toastr.css')}}">

    {{-- <link rel="shortcut icon" href="{{setting('logo', 'en')}}"/> --}}
    @if(is_array(setting('logo', 'en')) && isset(setting('logo', 'en')['url']))
    <link rel="shortcut icon" href="{{ setting('logo', 'en')['url'] }}"/>
@else
    <link rel="shortcut icon" href="/default-icon.png"/> 
@endif
    <!--begin::Fonts-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="{{asset('dashboard/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('dashboard/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard/assets/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('dashboard/assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>

    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Tajawal&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

        {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> --}}

    
    <style>
    .editor-content {
        font-family: 'Amiri', serif;
    }
   </style>


<style>
    /* Style for dropdown items */
.menu-item {
    position: relative;
}

.menu-link {
    display: flex;
    align-items: center;
    padding: 10px;
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.menu-icon {
    margin-right: 10px;
}

.menu-title {
    font-weight: bold;
}

/* Dropdown content */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 200px;
    z-index: 1000;
}

/* Show the dropdown on hover or when clicked */
.menu-item:hover .dropdown-menu,
.menu-item.open .dropdown-menu {
    display: block;
}

/* Menu item style */
.dropdown-menu .menu-item {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.dropdown-menu .menu-item:last-child {
    border-bottom: none;
}

.dropdown-menu .menu-item a {
    text-decoration: none;
    color: #333;
    display: flex;
    align-items: center;
}

.dropdown-menu .menu-item a:hover {
    background-color: #f1f1f1;
}

</style>


  
 

    @if(app()->getLocale() == 'ar')
        <link href="{{ asset('dashboard/assets/css/custom_ar.css') }}" rel="stylesheet" type="text/css"/>
    @endif

    @stack('admin_css')
    <style>
        body {
            font-family: Poppins, 'Almarai', Helvetica, "sans-serif";
        }

        /*.card .card-body {padding:0 1rem!important;}*/
        /*.container, .container-xxl, .container-fluid, .container-sm, .container-md, .container-lg, .container-xl {padding: 10px !important;}*/
        /*label {margin-bottom: 9px}*/
        /*.form-group {margin-bottom: 10px}*/
        /*.card {padding:0 1rem!important;}*/

        
    </style>

 <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
      data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
      data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
      data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
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

<script>
    // JavaScript to handle dropdown toggle
document.querySelectorAll('.menu-item.dropdown').forEach(function (item) {
    item.addEventListener('click', function () {
        // Close all dropdowns
        document.querySelectorAll('.menu-item.dropdown').forEach(function (dropdown) {
            if (dropdown !== item) {
                dropdown.classList.remove('open');
            }
        });

        // Toggle the current dropdown
        item.classList.toggle('open');
    });
});

</script>

<!--begin::Main-->

<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <!--begin::Header-->
    @include('admin.layouts.includes.header')
    <!--end::Header-->
        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::Sidebar-->
        @include('admin.layouts.includes.aside')
        <!--end::Sidebar-->
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <!--begin::Toolbar-->
                    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                        <!--begin::Toolbar container-->
                    @yield('crumb')
                    <!--end::Toolbar container-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Content-->
                @yield('content')
                <!--end::Content wrapper-->
                    <!--begin::Footer-->
                @include('admin.layouts.includes.footer')
                <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->
    <!--begin::Modals-->
    <!--begin::Modal - Users Search-->
    <div class="modal fade" id="kt_modal_users_search" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Content-->
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Search Users</h1>
                        <div class="text-muted fw-semibold fs-5">Invite Collaborators To
                            Your Project
                        </div>
                    </div>
                    <!--end::Content-->
                    <!--begin::Search-->
                    <div id="kt_modal_users_search_handler" data-kt-search-keypress="true"
                         data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="inline">
                        <!--begin::Form-->
                        <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">
                            <!--begin::Hidden input(Added to disable form autocomplete)-->
                            <input type="hidden"/>
                            <!--end::Hidden input-->
                            <!--begin::Icon-->
                            <i
                                class="ki-duotone ki-magnifier fs-2 fs-lg-1 text-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <!--end::Icon-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-lg form-control-solid px-15"
                                   name="search" value="" placeholder="Search by username, full name or email..."
                                   data-kt-search-element="input"/>
                            <!--end::Input-->
                            <!--begin::Spinner-->
                            <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5"
                                  data-kt-search-element="spinner">
									<span class="spinner-border h-15px w-15px align-middle text-muted"></span>
								</span>
                            <!--end::Spinner-->
                            <!--begin::Reset-->
                            <span
                                class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none"
                                data-kt-search-element="clear">
									<i class="ki-duotone ki-cross fs-2 fs-lg-1 me-0">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</span>
                            <!--end::Reset-->
                        </form>
                        <!--end::Form-->
                        <!--begin::Wrapper-->
                        <div class="py-5">
                            <!--begin::Suggestions-->
                            <div data-kt-search-element="suggestions">
                                <!--begin::Heading-->
                                <h3 class="fw-semibold mb-5">Recently searched:</h3>
                                <!--end::Heading-->
                                <!--begin::Users-->
                                <div class="mh-375px scroll-y me-n7 pe-7">
                                    <!--begin::User-->
                                    <a href="#"
                                       class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">

                                        <!--begin::Info-->
                                        <div class="fw-semibold">
												<span class="fs-6 text-gray-800 me-2">Emma
													Smith</span>
                                        </div>
                                        <!--end::Info-->
                                    </a>
                                    <!--end::User-->
                                    <!--begin::User-->
                                    <a href="#"
                                       class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">

                                        <!--begin::Info-->
                                        <div class="fw-semibold">
												<span class="fs-6 text-gray-800 me-2">Melody
													Macy</span>
                                        </div>
                                        <!--end::Info-->
                                    </a>
                                    <!--end::User-->
                                    <!--begin::User-->
                                    <a href="#"
                                       class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                        <!--begin::Info-->
                                        <div class="fw-semibold">
												<span class="fs-6 text-gray-800 me-2">Max
													Smith</span>
                                        </div>
                                        <!--end::Info-->
                                    </a>
                                    <!--end::User-->
                                    <!--begin::User-->
                                    <a href="#"
                                       class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                        <!--begin::Info-->
                                        <div class="fw-semibold">
												<span class="fs-6 text-gray-800 me-2">Sean
													Bean</span>
                                        </div>
                                        <!--end::Info-->
                                    </a>
                                    <!--end::User-->
                                    <!--begin::User-->
                                    <a href="#"
                                       class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                        <!--begin::Info-->
                                        <div class="fw-semibold">
												<span class="fs-6 text-gray-800 me-2">Brian
													Cox</span>
                                        </div>
                                        <!--end::Info-->
                                    </a>
                                    <!--end::User-->
                                </div>
                                <!--end::Users-->
                            </div>
                            <!--end::Suggestions-->
                            <!--begin::Results(add d-none to below element to hide the users list by default)-->
                            <div data-kt-search-element="results" class="d-none">
                                <!--begin::Users-->
                                <div class="mh-375px scroll-y me-n7 pe-7">
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="0">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='0']"
                                                       value="0"/>
                                            </label>
                                            <!--end::Checkbox-->
                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma
                                                    Smith</a>
                                                <div class="fw-semibold text-muted">
                                                    smith@kpmg.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->

                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="1">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='1']"
                                                       value="1"/>
                                            </label>
                                            <!--end::Checkbox-->
                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Melody
                                                    Macy</a>
                                                <div class="fw-semibold text-muted">
                                                    melody@altbox.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="2">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='2']"
                                                       value="2"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Max
                                                    Smith</a>
                                                <div class="fw-semibold text-muted">
                                                    max@kt.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="3">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='3']"
                                                       value="3"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Sean
                                                    Bean</a>
                                                <div class="fw-semibold text-muted">
                                                    sean@dellito.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="4">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='4']"
                                                       value="4"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Brian
                                                    Cox</a>
                                                <div class="fw-semibold text-muted">
                                                    brian@exchange.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="5">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='5']"
                                                       value="5"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Mikaela
                                                    Collins</a>
                                                <div class="fw-semibold text-muted">
                                                    mik@pex.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="6">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='6']"
                                                       value="6"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Francis
                                                    Mitcham</a>
                                                <div class="fw-semibold text-muted">
                                                    f.mit@kpmg.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="7">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='7']"
                                                       value="7"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Olivia
                                                    Wild</a>
                                                <div class="fw-semibold text-muted">
                                                    olivia@corpmail.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="8">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='8']"
                                                       value="8"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Neil
                                                    Owen</a>
                                                <div class="fw-semibold text-muted">
                                                    owen.neil@gmail.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="9">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='9']"
                                                       value="9"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Dan
                                                    Wilson</a>
                                                <div class="fw-semibold text-muted">
                                                    dam@consilting.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="10">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='10']"
                                                       value="10"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Emma
                                                    Bold</a>
                                                <div class="fw-semibold text-muted">
                                                    emma@intenso.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="11">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='11']"
                                                       value="11"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ana
                                                    Crown</a>
                                                <div class="fw-semibold text-muted">
                                                    ana.cf@limtel.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="12">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='12']"
                                                       value="12"/>
                                            </label>
                                            <!--end::Checkbox-->
                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Robert
                                                    Doe</a>
                                                <div class="fw-semibold text-muted">
                                                    robert@benko.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="13">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='13']"
                                                       value="13"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">John
                                                    Miller</a>
                                                <div class="fw-semibold text-muted">
                                                    miller@mapple.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="14">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='14']"
                                                       value="14"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Lucy
                                                    Kunic</a>
                                                <div class="fw-semibold text-muted">
                                                    lucy.m@fentech.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="15">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='15']"
                                                       value="15"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Ethan
                                                    Wilder</a>
                                                <div class="fw-semibold text-muted">
                                                    ethan@loop.com.au
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->

                                    </div>
                                    <!--end::User-->
                                    <!--begin::Separator-->
                                    <div class="border-bottom border-gray-300 border-bottom-dashed">
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::User-->
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="16">
                                        <!--begin::Details-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" name="users"
                                                       data-kt-check="true" data-kt-check-target="[data-user-id='16']"
                                                       value="16"/>
                                            </label>
                                            <!--end::Checkbox-->

                                            <!--begin::Details-->
                                            <div class="ms-5">
                                                <a href="#"
                                                   class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">Robert
                                                    Doe</a>
                                                <div class="fw-semibold text-muted">
                                                    robert@benko.com
                                                </div>
                                            </div>
                                            <!--end::Details-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Users-->
                                <!--begin::Actions-->
                                <div class="d-flex flex-center mt-15">
                                    <button type="reset" id="kt_modal_users_search_reset" data-bs-dismiss="modal"
                                            class="btn btn-active-light me-3">Cancel
                                    </button>
                                    <button type="submit" id="kt_modal_users_search_submit"
                                            class="btn btn-primary">Add
                                        Selected Users
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Results-->
                            <!--begin::Empty-->
                            <div data-kt-search-element="empty" class="text-center d-none">
                                <!--begin::Message-->
                                <div class="fw-semibold py-10">
                                    <div class="text-gray-600 fs-3 mb-2">No users found
                                    </div>
                                    <div class="text-muted fs-6">Try to search by username,
                                        full name or email...
                                    </div>
                                </div>
                                <!--end::Message-->
                                <!--begin::Illustration-->
                                <div class="text-center px-5">
                                    <img src="{{asset('dashboard/assets/media/illustrations/sketchy-1/1.png')}}" alt=""
                                         class="w-100 h-200px h-sm-325px"/>
                                </div>
                                <!--end::Illustration-->
                            </div>
                            <!--end::Empty-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
</div>


<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{asset('dashboard/assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('dashboard/assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{asset('dashboard/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{asset('dashboard/assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('dashboard/assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('dashboard/assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('dashboard/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('dashboard/assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('dashboard/assets/js/custom/utilities/modals/new-target.js')}}"></script>
<script src="{{asset('dashboard/assets/js/custom/utilities/modals/users-search.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>


@include('admin.layouts.toastr')
@include('admin.vendor.ckeditor')
@stack('admin_js')
{{-- @yield('admin_js') --}}

{{--@include('firebase.firebasescript')--}}


<script>

    function changeStatus(status_switch) {
        let url = $(status_switch).attr('data-url');
        $.ajax({
            url: url,
            data: {
                _token: "{{csrf_token()}}",
            },
            type: 'POST',

            success: function (response) {
                if (typeof (response) != 'object') {
                    response = $.parseJSON(response)
                }
                let msg = response.msg;
                let status = response.status;
                console.log(response);
                if (status === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!!',
                        text: msg,
                        confirmButtonColor: '#1597ac',
                        confirmButtonText: 'Fine!'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!!',
                        text: msg,
                        confirmButtonColor: '#ed4c78',
                        confirmButtonText: 'Fine!'
                    });
                }
            }

        });
    }


    function walletEquation(provider) {

        let data_route = $(provider).data('url');
        let item_id = $(provider).data('item-id');
        let equation_button = $("#equation-button");


        equation_button.attr('data-url', data_route);
        equation_button.attr('data-item-id', item_id);

        $('#equation_modal').modal('show');
    }

    $(document).on('click', '#equation-button', function () {
        let data_route = $(this).attr('data-url');
        let item_id = $(this).attr('data-item-id');

        $.ajax({
            url: data_route,
            data: {
                _token: "{{csrf_token()}}",
            },
            type: 'POST',

            success: function (response) {
                if (typeof (response) != 'object') {
                    response = $.parseJSON(response)
                }
                let msg = response.msg;
                let status = response.status;
                console.log(response);
                if (status === 1) {
                    $('#equation_modal').modal('toggle');

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!!',
                        text: msg,
                        confirmButtonColor: '#1597ac',
                        confirmButtonText: 'Fine!'
                    });
                    // let equation_btn = $('.equation_btn_' + item_id);
                    table1.ajax.reload(null, false);
                    // equation_btn.remove();
                } else {
                    $('#equation_modal').modal('toggle');

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!!',
                        text: msg,
                        confirmButtonColor: '#ed4c78',
                        confirmButtonText: 'Fine!'
                    });
                }
            }

        });
    });

    function acceptPackage(package_request) {

        let data_route = $(package_request).data('url');
        let item_id = $(package_request).data('item-id');
        let accept_button = $("#accept-button");


        accept_button.attr('data-url', data_route);
        accept_button.attr('data-item-id', item_id);

        $('#accept_modal').modal('show');
    }

    $(document).on('click', '#accept-button', function () {
        let current_status = $(this).data('status');
        let data_route = $(this).data('url');
        let item_id = $(this).data('item-id');

        $.ajax({
            url: data_route,
            data: {
                _token: "{{csrf_token()}}",
                status: current_status
            },
            type: 'POST',

            success: function (response) {
                if (typeof (response) != 'object') {
                    response = $.parseJSON(response)
                }
                let msg = response.msg;
                let status = response.status;
                console.log(response);
                if (status === 1) {
                    $('#accept_modal').modal('toggle');

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!!',
                        text: msg,
                        confirmButtonColor: '#1597ac',
                        confirmButtonText: 'Fine!'
                    });
                    let actions = $('.edit_btns_' + item_id).parent();
                    actions.find('.edit_btns_' + item_id).remove();
                    actions.append('<span>--</span>');
                    $("#status_" + item_id).text(response.data)

                } else {
                    $('#accept_modal').modal('toggle');

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!!',
                        text: msg,
                        confirmButtonColor: '#ed4c78',
                        confirmButtonText: 'Fine!'
                    });
                }
            }

        });
    });


    function denyPackage(package_request) {

        let data_route = $(package_request).data('url');
        let item_id = $(package_request).data('item-id');
        let deny_button = $("#deny-button");


        deny_button.attr('data-url', data_route);
        deny_button.attr('data-item-id', item_id);

        $('#deny_modal').modal('show');
    }

    $(document).on('click', '#deny-button', function () {
        let current_status = $(this).data('status');
        let data_route = $(this).data('url');
        let item_id = $(this).data('item-id');

        $.ajax({
            url: data_route,
            data: {
                _token: "{{csrf_token()}}",
                status: current_status
            },
            type: 'POST',

            success: function (response) {
                if (typeof (response) != 'object') {
                    response = $.parseJSON(response)
                }
                let msg = response.msg;
                let status = response.status;
                console.log(response);
                if (status === 1) {
                    $('#deny_modal').modal('toggle');

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!!',
                        text: msg,
                        confirmButtonColor: '#1597ac',
                        confirmButtonText: 'Fine!'
                    });
                    let actions = $('.edit_btns_' + item_id).parent();
                    actions.find('.edit_btns_' + item_id).remove();
                    // actions.find('img').fadeOut();
                    actions.append('<span>--</span>');
                    $("#status_" + item_id).text(response.data)

                } else {
                    $('#deny_modal').modal('toggle');

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!!',
                        text: msg,
                        confirmButtonColor: '#ed4c78',
                        confirmButtonText: 'Fine!'
                    });
                }
            }

        });
    });


    function changeGroupStatus(status_switch) {
        let url = $(status_switch).attr('data-url');
        $.ajax({
            url: url,
            data: {
                _token: "{{csrf_token()}}",
            },
            type: 'POST',

            success: function (response) {
                if (typeof (response) != 'object') {
                    response = $.parseJSON(response)
                }
                let msg = response.msg;
                let status = response.status;
                console.log(response);
                if (status === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'عملية ناجحة',
                        text: msg,
                        confirmButtonColor: '#1597ac',
                        confirmButtonText: 'حسنا!'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'فشلت العملية',
                        text: msg,
                        confirmButtonColor: '#ed4c78',
                        confirmButtonText: 'حسنا!'
                    });
                    $(status_switch).prop('checked', false);
                }
            }

        });
    }

</script>

<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
