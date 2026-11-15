<?php if($method === 'PUT'): ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Edit Credential')); ?>
<?php else: ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Create Credential')); ?>
<?php endif; ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text' => \App\Helpers\TranslationHelper::translate('Credentials'), 'link' => route('admin.credential.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ],'button' => ['text' => \App\Helpers\TranslationHelper::translate('Go to Credentials'), 'link' => route('admin.credential.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                                               value="<?php echo e(old('title.' . $key, $credential->getTranslation('title', $key, false))); ?>"
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
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Issuer in')); ?> <?php echo e(__('methods.' . $lang)); ?> *
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="organization[<?php echo e($key); ?>]"
                                               value="<?php echo e(old('organization.' . $key, $credential->getTranslation('organization', $key, false))); ?>"
                                               required/>
                                        <?php $__errorArgs = ['organization.' . $key];
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
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Description in')); ?> <?php echo e(__('methods.' . $lang)); ?>

                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="description[<?php echo e($key); ?>]"
                                                  rows="3"><?php echo e(old('description.' . $key, $credential->getTranslation('description', $key, false))); ?></textarea>
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

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Type')); ?> *</label>
                                    <?php ($currentType = old('type', $credential->type?->value ?? \App\Enums\CredentialTypeEnum::ProfessionalCertificate->value)); ?>
                                    <select class="form-select form-select-solid" name="type" required>
                                        <?php $__currentLoopData = $credentialTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeValue => $typeLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($typeValue); ?>" <?php if($currentType === $typeValue): echo 'selected'; endif; ?>><?php echo e($typeLabel); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['type'];
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
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Issued At')); ?> *</label>
                                    <input type="date" class="form-control form-control-solid" name="issued_at"
                                           value="<?php echo e(old('issued_at', $credential->issued_at?->format('Y-m-d'))); ?>" required/>
                                    <?php $__errorArgs = ['issued_at'];
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
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Expires At')); ?></label>
                                    <input type="date" class="form-control form-control-solid" name="expires_at"
                                           value="<?php echo e(old('expires_at', $credential->expires_at?->format('Y-m-d'))); ?>"/>
                                    <?php $__errorArgs = ['expires_at'];
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
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Credential ID')); ?></label>
                                    <input type="text" class="form-control form-control-solid" name="credential_id"
                                           value="<?php echo e(old('credential_id', $credential->credential_id)); ?>" dir="ltr"/>
                                    <?php $__errorArgs = ['credential_id'];
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
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Credential URL')); ?></label>
                                    <input type="url" class="form-control form-control-solid" name="credential_url"
                                           value="<?php echo e(old('credential_url', $credential->credential_url)); ?>" dir="ltr"/>
                                    <?php $__errorArgs = ['credential_url'];
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
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Certificate Image')); ?></label>
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
                                    <?php if($credential->exists && $credential->getFirstMediaUrl('credentials')): ?>
                                        <img src="<?php echo e($credential->getFirstMediaUrl('credentials')); ?>" alt="certificate" class="mt-3 rounded" width="100"/>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               <?php if((bool) old('is_active', $credential->exists ? $credential->is_active : true)): echo 'checked'; endif; ?>/>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/pages/credential/form.blade.php ENDPATH**/ ?>