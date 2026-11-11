<!--begin::Toolbar-->

<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
    <!--begin::Page title-->

    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1
            class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
            <?php if(isset($title) && $title != ''): ?>
                <?php echo e($title); ?>

            <?php else: ?>
                <?php echo e(\App\Helpers\TranslationHelper::translate('Dashboard')); ?>

            <?php endif; ?>
        </h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="<?php echo e(route('admin.index')); ?>"
                   class="text-muted text-hover-primary"> <?php echo e(\App\Helpers\TranslationHelper::translate('Dashboard')); ?> </a>
            </li>
            <!--end::Item-->
            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($bread != null): ?>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted <?php echo e($bread['active'] ?? ''); ?>">
                        <?php if(array_key_exists('link' , $bread)): ?>
                            <a href="<?php echo e($bread['link']); ?>"> <?php echo e($bread['text']); ?> </a>
                        <?php else: ?>
                            <?php echo e($bread['text']); ?>

                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>
        <!--end::Breadcrumb-->
    </div>
    <?php if(!empty($button)): ?>
        <div class="d-flex align-items-center py-1 mx-5">
            <a href="<?php echo e($button['link'] ?? '#'); ?>" class="btn btn-sm btn-primary"><?php echo e($button['text'] ?? '#'); ?></a>
        </div>
<?php endif; ?>
<!--end::Page title-->
</div>

<?php /**PATH D:\xampp\htdocs\couronne\resources\views/admin/components/bread-crumb.blade.php ENDPATH**/ ?>