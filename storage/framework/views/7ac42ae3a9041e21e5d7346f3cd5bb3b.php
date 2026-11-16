<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo e(\App\Helpers\TranslationHelper::translate('Eng. Abdelrahman Abu Aishah')); ?> — <?php echo e(\App\Helpers\TranslationHelper::translate('Log In')); ?></title>
    <meta name="description" content="Eng. Abdelrahman Abu Aishah Portfolio Administration Dashboard" />
    <link rel="shortcut icon" href="<?php echo e(asset('dashboard/assets/media/logos/user.png')); ?>" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle-->
    <link href="<?php echo e(asset('dashboard/assets/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('dashboard/assets/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('dashboard/assets/css/font-awesome.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('dashboard/assets/css/dashboard-common.css')); ?>" rel="stylesheet" type="text/css" />
    <?php if(app()->getLocale() === 'ar'): ?>
        <link href="<?php echo e(asset('dashboard/assets/css/dashboard-rtl.css')); ?>" rel="stylesheet" type="text/css" />
    <?php else: ?>
        <link href="<?php echo e(asset('dashboard/assets/css/dashboard-ltr.css')); ?>" rel="stylesheet" type="text/css" />
    <?php endif; ?>
    <!--end::Global Stylesheets Bundle-->
    <?php echo $__env->yieldPushContent('admin_css'); ?>
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body" class="app-blank">
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <style>
        body {
            background-image: url('<?php echo e(asset('dashboard/assets/media/auth/bg10.jpeg')); ?>');
        }
        [data-bs-theme="dark"] body {
            background-image: url('<?php echo e(asset('dashboard/assets/media/auth/bg10-dark.jpeg')); ?>');
        }
    </style>
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="<?php echo e(asset('dashboard/assets/plugins/global/plugins.bundle.js')); ?>"></script>
<script src="<?php echo e(asset('dashboard/assets/js/scripts.bundle.js')); ?>"></script>
<?php echo $__env->yieldPushContent('admin_js'); ?>
</body>
<!--end::Body-->
</html>
<?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>