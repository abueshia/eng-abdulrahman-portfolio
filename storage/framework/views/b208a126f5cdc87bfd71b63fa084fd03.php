<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">
<!--begin::Head-->
<head>
    <base href="">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title><?php echo e(\App\Helpers\TranslationHelper::translate('Eng. Abdelrahman Abu Aishah')); ?> — <?php echo $__env->yieldContent('title', \App\Helpers\TranslationHelper::translate('Dashboard')); ?></title>
    <meta name="description" content="<?php echo e($title ?? \App\Helpers\TranslationHelper::translate('Portfolio Administration Dashboard')); ?>" />

    <link rel="shortcut icon" href="<?php echo e(asset('dashboard/assets/media/logos/user.png')); ?>" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&family=Almarai:wght@400;700;800&display=swap" />
    <!--end::Fonts-->

    <!--begin::Vendor Stylesheets-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo e(asset('dashboard/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('dashboard/assets/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('dashboard/assets/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('dashboard/assets/css/font-awesome.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('dashboard/assets/css/toastr.css')); ?>" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->

    <!--begin::Custom Dashboard Stylesheets-->
    <link href="<?php echo e(asset('dashboard/assets/css/dashboard-common.css')); ?>" rel="stylesheet" type="text/css" />
    <?php if(app()->getLocale() === 'ar'): ?>
        <link href="<?php echo e(asset('dashboard/assets/css/dashboard-rtl.css')); ?>" rel="stylesheet" type="text/css" />
    <?php else: ?>
        <link href="<?php echo e(asset('dashboard/assets/css/dashboard-ltr.css')); ?>" rel="stylesheet" type="text/css" />
    <?php endif; ?>
    <!--end::Custom Dashboard Stylesheets-->

    <?php echo $__env->yieldPushContent('admin_css'); ?>

    <script src="<?php echo e(asset('dashboard/assets/js/toastr.js')); ?>"></script>
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_app_body"
      data-kt-app-layout="dark-sidebar"
      data-kt-app-header-fixed="true"
      data-kt-app-sidebar-enabled="true"
      data-kt-app-sidebar-fixed="true"
      data-kt-app-sidebar-hoverable="true"
      data-kt-app-sidebar-push-header="true"
      data-kt-app-sidebar-push-toolbar="true"
      data-kt-app-sidebar-push-footer="true"
      data-kt-app-toolbar-enabled="true"
      class="app-default">
<!--begin::Theme mode setup on page load-->
<script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else if (localStorage.getItem("data-bs-theme") !== null) {
            themeMode = localStorage.getItem("data-bs-theme");
        } else {
            themeMode = defaultThemeMode;
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>
<!--end::Theme mode setup on page load-->

<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <!--begin::Header-->
        <?php echo $__env->make('admin.layouts.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--end::Header-->

        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::Sidebar-->
            <?php echo $__env->make('admin.layouts.includes.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--end::Sidebar-->

            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <!--begin::Toolbar-->
                    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                        <?php echo $__env->yieldContent('crumb'); ?>
                    </div>
                    <!--end::Toolbar-->

                    <!--begin::Content-->
                    <?php echo $__env->yieldContent('content'); ?>
                    <!--end::Content-->
                </div>
                <!--end::Content wrapper-->

                <!--begin::Footer-->
                <?php echo $__env->make('admin.layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!--end::Footer-->
            </div>
            <!--end::Main-->
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

<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle-->
<script src="<?php echo e(asset('dashboard/assets/plugins/global/plugins.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/assets/js/scripts.bundle.js')); ?>"></script>
<!--end::Global Javascript Bundle-->

<!--begin::Vendors Javascript-->
<script src="<?php echo e(asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<!--end::Vendors Javascript-->

<?php echo $__env->make('admin.layouts.toastr', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.vendor.ckeditor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldPushContent('admin_js'); ?>

<script>
    function changeStatus(statusSwitch) {
        let url = $(statusSwitch).attr('data-url');
        $.ajax({
            url: url,
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
            },
            type: 'POST',
            success: function (response) {
                if (typeof response !== 'object') {
                    response = $.parseJSON(response);
                }
                if (response.status === 1) {
                    Swal.fire({
                        icon: 'success',
                        title: "<?php echo e(\App\Helpers\TranslationHelper::translate('Success')); ?>",
                        text: response.msg,
                        confirmButtonColor: '#2563eb',
                        confirmButtonText: "<?php echo e(\App\Helpers\TranslationHelper::translate('OK')); ?>"
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: "<?php echo e(\App\Helpers\TranslationHelper::translate('Error')); ?>",
                        text: response.msg,
                        confirmButtonColor: '#e11d48',
                        confirmButtonText: "<?php echo e(\App\Helpers\TranslationHelper::translate('OK')); ?>"
                    });
                }
            }
        });
    }
</script>
</body>
<!--end::Body-->
</html>
<?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>