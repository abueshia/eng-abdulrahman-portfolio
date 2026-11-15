<?php if($method === 'PUT'): ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Edit Service')); ?>
<?php else: ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Create Service')); ?>
<?php endif; ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text' => \App\Helpers\TranslationHelper::translate('Services'), 'link' => route('admin.service.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ],'button' => ['text' => \App\Helpers\TranslationHelper::translate('Go to Services'), 'link' => route('admin.service.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-body pt-6">
                        <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if($method === 'PUT'): ?>
                                <?php echo method_field('PUT'); ?>
                            <?php endif; ?>

                            <div class="row g-6 mb-8">
                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Title in')); ?> <?php echo e(__('methods.' . $lang)); ?> *
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="title[<?php echo e($key); ?>]"
                                               value="<?php echo e(old('title.' . $key, $service->getTranslation('title', $key, false))); ?>"
                                               required/>
                                        <?php $__errorArgs = ['title.' . $key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger d-block mt-1"><strong><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Subtitle in')); ?> <?php echo e(__('methods.' . $lang)); ?>

                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="subtitle[<?php echo e($key); ?>]"
                                               value="<?php echo e(old('subtitle.' . $key, $service->getTranslation('subtitle', $key, false))); ?>"/>
                                        <?php $__errorArgs = ['subtitle.' . $key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger d-block mt-1"><strong><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Short Description in')); ?> <?php echo e(__('methods.' . $lang)); ?> *
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="short_description[<?php echo e($key); ?>]"
                                                  rows="3"
                                                  required><?php echo e(old('short_description.' . $key, $service->getTranslation('short_description', $key, false))); ?></textarea>
                                        <?php $__errorArgs = ['short_description.' . $key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger d-block mt-1"><strong><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Description in')); ?> <?php echo e(__('methods.' . $lang)); ?> *
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="description[<?php echo e($key); ?>]"
                                                  rows="4"
                                                  required><?php echo e(old('description.' . $key, $service->getTranslation('description', $key, false))); ?></textarea>
                                        <?php $__errorArgs = ['description.' . $key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger d-block mt-1"><strong><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Icon Class')); ?></label>
                                    <input type="text" class="form-control form-control-solid" name="icon"
                                           value="<?php echo e(old('icon', $service->icon)); ?>" placeholder="fa-solid fa-layer-group" dir="ltr"/>
                                    <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger d-block mt-1"><strong><?php echo e($message); ?></strong></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Image')); ?></label>
                                    <input type="file" class="form-control form-control-solid" name="image" accept="image/*"/>
                                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger d-block mt-1"><strong><?php echo e($message); ?></strong></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php if($service->exists && $service->getFirstMediaUrl('services')): ?>
                                        <img src="<?php echo e($service->getFirstMediaUrl('services')); ?>" alt="service" class="mt-3 rounded" width="100"/>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_featured" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                                               <?php if((bool) old('is_featured', $service->is_featured)): echo 'checked'; endif; ?>/>
                                        <label class="form-check-label fw-bold ms-3" for="is_featured">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Featured')); ?>

                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               <?php if((bool) old('is_active', $service->exists ? $service->is_active : true)): echo 'checked'; endif; ?>/>
                                        <label class="form-check-label fw-bold ms-3" for="is_active">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Active')); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-8">
                                    <?php echo e(\App\Helpers\TranslationHelper::translate('Save')); ?>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/pages/service/form.blade.php ENDPATH**/ ?>