<?php if($method === 'PUT'): ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Edit Technology')); ?>
<?php else: ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Create Technology')); ?>
<?php endif; ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text' => \App\Helpers\TranslationHelper::translate('Technologies'), 'link' => route('admin.technology.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ],'button' => ['text' => \App\Helpers\TranslationHelper::translate('Go to Technologies'), 'link' => route('admin.technology.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Name in')); ?> <?php echo e(__('methods.' . $lang)); ?> *
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="name[<?php echo e($key); ?>]"
                                               value="<?php echo e(old('name.' . $key, $technology->getTranslation('name', $key, false))); ?>"
                                               required/>
                                        <?php $__errorArgs = ['name.' . $key];
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

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Category')); ?> *</label>
                                    <?php ($currentCategory = old('category', $technology->category?->value ?? \App\Enums\TechnologyCategoryEnum::Backend->value)); ?>
                                    <select class="form-select form-select-solid" name="category" required>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catValue => $catLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($catValue); ?>" <?php if($currentCategory === $catValue): echo 'selected'; endif; ?>><?php echo e($catLabel); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['category'];
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

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Proficiency (%)')); ?> *</label>
                                    <input type="number" min="1" max="100" class="form-control form-control-solid"
                                           name="proficiency_percent"
                                           value="<?php echo e(old('proficiency_percent', $technology->proficiency_percent ?? 90)); ?>"
                                           required/>
                                    <?php $__errorArgs = ['proficiency_percent'];
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

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Years of Experience')); ?></label>
                                    <input type="number" step="0.5" min="0" max="50" class="form-control form-control-solid"
                                           name="years_of_experience"
                                           value="<?php echo e(old('years_of_experience', $technology->years_of_experience ?? 4)); ?>"/>
                                    <?php $__errorArgs = ['years_of_experience'];
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

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Icon Class')); ?></label>
                                    <input type="text" class="form-control form-control-solid" name="icon"
                                           value="<?php echo e(old('icon', $technology->icon)); ?>" placeholder="fa-brands fa-laravel" dir="ltr"/>
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Badge Color')); ?></label>
                                    <input type="text" class="form-control form-control-solid" name="badge_color"
                                           value="<?php echo e(old('badge_color', $technology->badge_color)); ?>" placeholder="#FF2D20" dir="ltr"/>
                                </div>

                                <div class="col-md-4">
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
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_featured" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                                               <?php if((bool) old('is_featured', $technology->is_featured)): echo 'checked'; endif; ?>/>
                                        <label class="form-check-label fw-bold ms-3" for="is_featured">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Featured')); ?>

                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               <?php if((bool) old('is_active', $technology->exists ? $technology->is_active : true)): echo 'checked'; endif; ?>/>
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


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/pages/technology/form.blade.php ENDPATH**/ ?>