<?php $__env->startPush('admin_css'); ?>
    <link href="<?php echo e(asset('dashboard/assets/css/tags-input.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php if($method == 'PUT'): ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Edit About')); ?>
<?php else: ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Add About')); ?>
<?php endif; ?>



<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text' => \App\Helpers\TranslationHelper::translate('Abouts'), 'link' => route('admin.about.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ],'button' => ['text' => \App\Helpers\TranslationHelper::translate('Go to About'), 'link' => route('admin.about.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                                    <input type="hidden" name="id" value="<?php echo e($about->id); ?>">

                            <?php endif; ?>
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    <?php echo e(\App\Helpers\TranslationHelper::translate('title in')); ?> <?php echo e(__('methods.' . $lang)); ?>

                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="<?php echo e(old('title.'.$key) ?? $about->getTranslation('title',$key)); ?>"
                                                       placeholder="<?php echo e(\App\Helpers\TranslationHelper::translate('title in')); ?> <?php echo e(__('methods.' . $lang)); ?>"
                                                       name="title[<?php echo e($key); ?>]"/>
                                                <?php $__errorArgs = ['title.'.$key];
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
                  style="height: 300px; direction: rtl;"><?php echo e(old('description.'.$key) ?? $about->getTranslation('description', $key)); ?></textarea>
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
                                                <!--begin::Label-->
                                                <label class="fs-5 fw-bold form-label mb-5"><?php echo e(\App\Helpers\TranslationHelper::translate('Image')); ?> : <span
                                                        class="text-danger"> <?php echo e(\App\Helpers\TranslationHelper::translate('Size')); ?> <span dir="ltr">400 x 400</span></span></label>
                                                <!--end::Label-->
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
                                                <?php if($about->getFirstMediaUrl('abouts_image') != null): ?>
                                                    <img src="<?php echo e($about->getFirstMediaUrl('abouts_image')); ?>"
                                                         alt="abouts" width="100px"
                                                         style="border-radius: 5px">
                                                <?php endif; ?>
                                            </div>



            <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12 mb-5">
        <label class="fs-5 fw-bold form-label mb-5">
            <?php echo e(\App\Helpers\TranslationHelper::translate('description_story in')); ?> <?php echo e(__('methods.' . $lang)); ?>

        </label>
        <textarea class="form-control form-control-solid full-editor" name="description_story[<?php echo e($key); ?>]" rows="5" id="description_story<?php echo e($key); ?>"
                  style="height: 300px; direction: rtl;"><?php echo e(old('description_story.'.$key) ?? $about->getTranslation('description_story', $key)); ?></textarea>
        <?php $__errorArgs = ['description_story.'.$key];
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
            <?php echo e(\App\Helpers\TranslationHelper::translate('description_see_us in')); ?> <?php echo e(__('methods.' . $lang)); ?>

        </label>
        <textarea class="form-control form-control-solid full-editor" name="description_see_us[<?php echo e($key); ?>]" rows="5" id="description_see_us<?php echo e($key); ?>"
                  style="height: 300px; direction: rtl;"><?php echo e(old('description_see_us.'.$key) ?? $about->getTranslation('description_see_us', $key)); ?></textarea>
        <?php $__errorArgs = ['description_see_us.'.$key];
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
            <?php echo e(\App\Helpers\TranslationHelper::translate('description_our_mission in')); ?> <?php echo e(__('methods.' . $lang)); ?>

        </label>
        <textarea class="form-control form-control-solid full-editor" name="description_our_mission[<?php echo e($key); ?>]" rows="5" id="description_our_mission<?php echo e($key); ?>"
                  style="height: 300px; direction: rtl;"><?php echo e(old('description_our_mission.'.$key) ?? $about->getTranslation('description_our_mission', $key)); ?></textarea>
        <?php $__errorArgs = ['description_our_mission.'.$key];
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
            <?php echo e(\App\Helpers\TranslationHelper::translate('description_about_the_plan in')); ?> <?php echo e(__('methods.' . $lang)); ?>

        </label>
        <textarea class="form-control form-control-solid full-editor" name="description_about_the_plan[<?php echo e($key); ?>]" rows="5" id="description_about_the_plan<?php echo e($key); ?>"
                  style="height: 300px; direction: rtl;"><?php echo e(old('description_about_the_plan.'.$key) ?? $about->getTranslation('description_about_the_plan', $key)); ?></textarea>
        <?php $__errorArgs = ['description_about_the_plan.'.$key];
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
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5"><?php echo e(\App\Helpers\TranslationHelper::translate('Image tow')); ?>

                                                : <span
                                                    class="text-danger"> <?php echo e(\App\Helpers\TranslationHelper::translate('Size')); ?> <span
                                                        dir="ltr">400 x 400</span></span></label>
                                            <!--end::Label-->
                                            <input type="file" class="form-control form-control-solid" name="meta_image"/>
                                            <?php $__errorArgs = ['meta_image'];
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
                                            <?php if($about->getFirstMediaUrl('abouts_meta_image') != null): ?>
                                                <img src="<?php echo e($about->getFirstMediaUrl('abouts_meta_image')); ?>"
                                                     alt="abouts" width="100px"
                                                     style="border-radius: 5px">
                                            <?php endif; ?>
                                        </div>


                                          

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
<script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('admin_js'); ?>
<script>
    // استهداف كل textarea بعلامة full-editor
    document.querySelectorAll('.full-editor').forEach((editor) => {
        CKEDITOR.replace(editor.id, {
            // إضافة الخطوط المطلوبة
            font_names: 'Arial/Arial, Helvetica, sans-serif;' +
                'Courier New/Courier New, Courier, monospace;' +
                'Advertising/Advertising, sans-serif;' +
                'Amiri/Amiri, serif;' +
                'Tajawal/Tajawal, sans-serif;' +
                'Traditional Arabic/Traditional Arabic, serif;',
            contentsLangDirection: 'rtl', // تفعيل الكتابة من اليمين لليسار للعربية
            height: 300 // ارتفاع المحرر
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('admin_js'); ?>
<script src="<?php echo e(asset('dashboard/assets/js/tags-input.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>







<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\couronne\resources\views/admin/pages/about/form.blade.php ENDPATH**/ ?>