<?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Contact Message Details')); ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text' => \App\Helpers\TranslationHelper::translate('Contact Messages'), 'link' => route('admin.message.index')],
        ['text' => \App\Helpers\TranslationHelper::translate('Details')],
    ],'button' => ['text' => \App\Helpers\TranslationHelper::translate('Go to Messages'), 'link' => route('admin.message.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                <div class="card mb-7">
                    <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?php echo e($message->subject ?: \App\Helpers\TranslationHelper::translate('Contact Message Details')); ?></h4>
                        <span class="badge badge-light-<?php echo e($message->status?->color() ?? 'primary'); ?>">
                            <?php echo e($message->status?->label() ?? '-'); ?>

                        </span>
                    </div>
                    <div class="card-body py-6">
                        <div class="row g-5">
                            <div class="col-md-4">
                                <strong><?php echo e(\App\Helpers\TranslationHelper::translate('Name')); ?>:</strong>
                                <p class="mt-1"><?php echo e($message->name); ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong><?php echo e(\App\Helpers\TranslationHelper::translate('Email')); ?>:</strong>
                                <p class="mt-1" dir="ltr"><?php echo e($message->email); ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong><?php echo e(\App\Helpers\TranslationHelper::translate('Phone')); ?>:</strong>
                                <p class="mt-1" dir="ltr"><?php echo e($message->phone ?: '-'); ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong><?php echo e(\App\Helpers\TranslationHelper::translate('Type')); ?>:</strong>
                                <p class="mt-1"><?php echo e($message->type?->label() ?? '-'); ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong><?php echo e(\App\Helpers\TranslationHelper::translate('Project Budget')); ?>:</strong>
                                <p class="mt-1"><?php echo e($message->budget_range ?: '-'); ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong><?php echo e(\App\Helpers\TranslationHelper::translate('Received At')); ?>:</strong>
                                <p class="mt-1"><?php echo e($message->created_at?->format('Y-m-d H:i') ?? '-'); ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong><?php echo e(\App\Helpers\TranslationHelper::translate('Read At')); ?>:</strong>
                                <p class="mt-1"><?php echo e($message->read_at?->format('Y-m-d H:i') ?? '-'); ?></p>
                            </div>
                            <div class="col-md-12">
                                <strong><?php echo e(\App\Helpers\TranslationHelper::translate('Message')); ?>:</strong>
                                <div class="p-4 bg-light rounded mt-2">
                                    <?php echo e($message->message); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if(auth()->guard('admin')->user()?->can('messages.edit', 'admin')): ?>
                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <h4 class="mb-0"><?php echo e(\App\Helpers\TranslationHelper::translate('Update Status & Admin Notes')); ?></h4>
                        </div>
                        <div class="card-body py-6">
                            <form action="<?php echo e(route('admin.message.update', $message->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <div class="row g-6 mb-6">
                                    <div class="col-md-4">
                                        <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Status')); ?> *</label>
                                        <?php ($currentStatus = old('status', $message->status?->value)); ?>
                                        <select class="form-select form-select-solid" name="status" required>
                                            <?php $__currentLoopData = $messageStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusValue => $statusLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($statusValue); ?>" <?php if($currentStatus === $statusValue): echo 'selected'; endif; ?>><?php echo e($statusLabel); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['status'];
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

                                    <div class="col-md-8">
                                        <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Admin Notes')); ?></label>
                                        <textarea class="form-control form-control-solid" name="admin_notes" rows="3"><?php echo e(old('admin_notes', $message->admin_notes)); ?></textarea>
                                        <?php $__errorArgs = ['admin_notes'];
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
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary px-8">
                                        <?php echo e(\App\Helpers\TranslationHelper::translate('Save')); ?>

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/pages/message/show.blade.php ENDPATH**/ ?>