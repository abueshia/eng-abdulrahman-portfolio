<?php $__env->startPush('admin_css'); ?>
    <link href="<?php echo e(asset('dashboard/assets/css/tags-input.min.css')); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

    <?php if(App::getLocale() == 'ar'): ?>

<?php endif; ?>

<?php $__env->stopPush(); ?>

<?php if($method == 'PUT'): ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Edit Blog')); ?>
<?php else: ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Add Blog')); ?>
<?php endif; ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text' => \App\Helpers\TranslationHelper::translate('Blogs'), 'link' => route('admin.blog.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ],'button' => ['text' => \App\Helpers\TranslationHelper::translate('Go to Blog'), 'link' => route('admin.blog.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                            <!--begin::Form-->
                            <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php if($method == 'PUT'): ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="id" value="<?php echo e($blog->id); ?>">
                            <?php endif; ?>
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        
                                        

                                                 <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    <?php echo e(\App\Helpers\TranslationHelper::translate('name in')); ?> <?php echo e(__('methods.' . $lang)); ?>

                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="<?php echo e(old('name.'.$key) ?? $blog->getTranslation('name',$key)); ?>"
                                                       placeholder="<?php echo e(\App\Helpers\TranslationHelper::translate('name in')); ?> <?php echo e(__('methods.' . $lang)); ?>"
                                                       name="name[<?php echo e($key); ?>]"/>
                                                <?php $__errorArgs = ['name.'.$key];
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
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                      <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12 mb-5">
        <label class="fs-5 fw-bold form-label mb-5">
            <?php echo e(\App\Helpers\TranslationHelper::translate('Description in')); ?> <?php echo e(__('methods.' . $lang)); ?>

        </label>
        <textarea class="form-control form-control-solid full-editor" name="description[<?php echo e($key); ?>]" rows="5" id="description<?php echo e($key); ?>"
                  style="height: 300px; direction: rtl;"><?php echo e(old('description.'.$key) ?? $blog->getTranslation('description', $key)); ?></textarea>
        <?php $__errorArgs = ['description.'.$key];
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
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        



                                   <div class="col-6  mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-5"><?php echo e(\App\Helpers\TranslationHelper::translate('Image')); ?>

                                                : <span class="text-danger">
                                                    <?php echo e(\App\Helpers\TranslationHelper::translate('Size')); ?> <span
                                                        dir="ltr">400 x 400</span></span></label>
                                            <input type="file" class="form-control form-control-solid" name="image"/>
                                            <?php $__errorArgs = ['image'];
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
                                            <?php if($blog->getFirstMediaUrl('blogs_image') != null): ?>
                                                <img src="<?php echo e($blog->getFirstMediaUrl('blogs_image')); ?>" alt="blogs"
                                                     width="100px" style="border-radius: 5px">
                                            <?php endif; ?>
                                        </div>





                                        

                          

                                        








                                        


                                        




                                    </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mb-5">
                                        <span
                                            class="indicator-label"><?php echo e(\App\Helpers\TranslationHelper::translate('Save')); ?></span>
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
    </div>
    <!--end::Content-->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('admin_js'); ?>

    <script src="<?php echo e(asset('dashboard/assets/js/tags-input.min.js')); ?>"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>








    <script>
        $(document).ready(function() {
            $('#meta_tags').select2({
                tags: true,
                placeholder: 'Select or create options',
                allowClear: true
            });
        });
    </script>








 
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\couronne\resources\views/admin/pages/blog/form.blade.php ENDPATH**/ ?>