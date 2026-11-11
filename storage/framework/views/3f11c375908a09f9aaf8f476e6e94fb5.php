<?php $__env->startPush('admin_css'); ?>
    <link href="<?php echo e(asset('dashboard/assets/css/tags-input.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php if($method == 'PUT'): ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Edit Contact')); ?>
<?php else: ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Add Contact')); ?>
<?php endif; ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text' => \App\Helpers\TranslationHelper::translate('Contacts'), 'link' => route('admin.contact.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ],'button' => ['text' => \App\Helpers\TranslationHelper::translate('Go to Contact'), 'link' => route('admin.contact.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                            <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
                            <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php if($method == 'PUT'): ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="id" value="<?php echo e($contact->id); ?>">

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
                                                       value="<?php echo e(old('title.'.$key) ?? $contact->getTranslation('title',$key)); ?>"
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
                  style="height: 300px; direction: rtl;"><?php echo e(old('description.'.$key) ?? $contact->getTranslation('description', $key)); ?></textarea>
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

                                        



         <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-6 mb-5">
        <!--begin::Label-->
        <label class="fs-5 fw-bold form-label mb-5">
            <?php echo e(\App\Helpers\TranslationHelper::translate('address in')); ?> <?php echo e(__('methods.' . $lang)); ?>

        </label>
        <!--end::Label-->
        <input type="text" class="form-control form-control-solid" 
               name="address[<?php echo e($key); ?>]" 
               value="<?php echo e(old('address.' . $key) ?? $contact->getTranslation('address', $key)); ?>" 
               id="address<?php echo e($key); ?>" 
               style="direction: rtl;" />
        <?php $__errorArgs = ['address.' . $key];
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





                                        <div class="col-6 mb-5">
    <!--begin::Label-->
    <label class="fs-5 fw-bold form-label mb-5">
        <?php echo e(\App\Helpers\TranslationHelper::translate('facebook')); ?>:
    </label>
    <!--end::Label-->
    <input type="text" class="form-control form-control-solid" name="facebook"
           value="<?php echo e(old('facebook') ?? $contact->facebook); ?>" />
    <?php $__errorArgs = ['facebook'];
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

<div class="col-6 mb-5">
    <!--begin::Label-->
    <label class="fs-5 fw-bold form-label mb-5">
        <?php echo e(\App\Helpers\TranslationHelper::translate('instagram')); ?>:
    </label>
    <!--end::Label-->
    <input type="text" class="form-control form-control-solid" name="iniesta"
           value="<?php echo e(old('iniesta') ?? $contact->iniesta); ?>" />
    <?php $__errorArgs = ['iniesta'];
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

<div class="col-6 mb-5">
    <!--begin::Label-->
    <label class="fs-5 fw-bold form-label mb-5">
        <?php echo e(\App\Helpers\TranslationHelper::translate('whatsapp')); ?>:
    </label>
    <!--end::Label-->
    <input type="text" class="form-control form-control-solid" name="whatsapp"
           value="<?php echo e(old('whatsapp') ?? $contact->whatsapp); ?>" />
    <?php $__errorArgs = ['whatsapp'];
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

<div class="col-6 mb-5">
    <!--begin::Label-->
    <label class="fs-5 fw-bold form-label mb-5">
        <?php echo e(\App\Helpers\TranslationHelper::translate('phone')); ?>:
    </label>
    <!--end::Label-->
    <input type="text" class="form-control form-control-solid" name="phono"
           value="<?php echo e(old('phono') ?? $contact->phono); ?>" />
    <?php $__errorArgs = ['phono'];
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




<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        <?php echo e(\App\Helpers\TranslationHelper::translate('Youtube')); ?>:
    </label>
    <input type="text" class="form-control form-control-solid" name="tiktok"
           value="<?php echo e(old('tiktok') ?? $contact->tiktok); ?>" />
    <?php $__errorArgs = ['tiktok'];
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


<div class="col-6 mb-5">
    <!--begin::Label for X-->
    <label class="fs-5 fw-bold form-label mb-5">
        <?php echo e(\App\Helpers\TranslationHelper::translate('E-mail')); ?>:
    </label>
    <!--end::Label-->
    <input type="text" class="form-control form-control-solid" name="x"
           value="<?php echo e(old('x') ?? $contact->x); ?>" />
    <?php $__errorArgs = ['x'];
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
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/admin/pages/contact/form.blade.php ENDPATH**/ ?>