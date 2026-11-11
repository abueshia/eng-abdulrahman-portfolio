<?php if($method == 'PUT'): ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Edit News')); ?>
<?php else: ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Add News')); ?>
<?php endif; ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
    ['text'=> \App\Helpers\TranslationHelper::translate('News'),'link'=>route('admin.news.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ],'button' => ['text'=>\App\Helpers\TranslationHelper::translate('Go to News'),'link'=>route('admin.news.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bread-crumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\BreadCrumb::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2072a121b282e859e8bdea9c58b76d8)): ?>
<?php $attributes = $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8; ?>
<?php unset($__attributesOriginalc2072a121b282e859e8bdea9c58b76d8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2072a121b282e859e8bdea9c58b76d8)): ?>
<?php $component = $__componentOriginalc2072a121b282e859e8bdea9c58b76d8; ?>
<?php unset($__componentOriginalc2072a121b282e859e8bdea9c58b76d8); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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
                           

                            <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($method == 'PUT'): ?>
        <?php echo method_field('PUT'); ?>
        <input type="hidden" name="id" value="<?php echo e($news->id); ?>">
    <?php endif; ?>

    <div class="fv-row mb-10">
        <div class="row">
            <!-- رفع الصورة -->
            

            <!-- رفع الفيديو -->
            <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    <?php echo e(\App\Helpers\TranslationHelper::translate('News Video')); ?>:
                </label>

                <input type="file" class="form-control form-control-solid" name="news_video" accept="video/*"/>
                <?php $__errorArgs = ['news_video'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <?php if($news->getFirstMediaUrl('news_video')): ?>
                    <div class="mt-4">
                        <h5><?php echo e(\App\Helpers\TranslationHelper::translate('Existing Video')); ?>:</h5>
                        <video width="100%" controls>
                            <source src="<?php echo e($news->getFirstMediaUrl('news_video')); ?>" type="video/mp4">
                            <?php echo e(\App\Helpers\TranslationHelper::translate('Your browser does not support the video tag.')); ?>

                        </video>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary mb-5">
            <span class="indicator-label"><?php echo e(\App\Helpers\TranslationHelper::translate('Save')); ?></span>
        </button>
    </div>
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
    </div>
    <!--end::Content-->

<?php $__env->stopSection(); ?>



<?php $__env->startPush('admin_js'); ?>
    <script src="<?php echo e(asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')); ?>"></script>

    

    <script src="<?php echo e(asset('dashboard/assets/js/delete-item.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\couronne\resources\views/admin/pages/news/form.blade.php ENDPATH**/ ?>