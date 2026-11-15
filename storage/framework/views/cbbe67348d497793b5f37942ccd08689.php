<?php if($method === 'PUT'): ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Edit Project')); ?>
<?php else: ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Create Project')); ?>
<?php endif; ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text' => \App\Helpers\TranslationHelper::translate('Projects'), 'link' => route('admin.project.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ],'button' => ['text' => \App\Helpers\TranslationHelper::translate('Go to Projects'), 'link' => route('admin.project.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                                               value="<?php echo e(old('title.' . $key, $project->getTranslation('title', $key, false))); ?>"
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
                                               value="<?php echo e(old('subtitle.' . $key, $project->getTranslation('subtitle', $key, false))); ?>"/>
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

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Category')); ?></label>
                                    <select class="form-select form-select-solid" name="category_id">
                                        <option value=""><?php echo e(\App\Helpers\TranslationHelper::translate('Choose Category')); ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>" <?php if((int) old('category_id', $project->category_id) === $category->id): echo 'selected'; endif; ?>>
                                                <?php echo e($category->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['category_id'];
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
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Project Type')); ?> *</label>
                                    <?php ($currentType = old('project_type', $project->project_type?->value ?? \App\Enums\ProjectTypeEnum::WebApp->value)); ?>
                                    <select class="form-select form-select-solid" name="project_type" required>
                                        <?php $__currentLoopData = $projectTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeValue => $typeLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($typeValue); ?>" <?php if($currentType === $typeValue): echo 'selected'; endif; ?>><?php echo e($typeLabel); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['project_type'];
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
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Status')); ?> *</label>
                                    <?php ($currentStatus = old('status', $project->status?->value ?? \App\Enums\ProjectStatusEnum::Published->value)); ?>
                                    <select class="form-select form-select-solid" name="status" required>
                                        <?php $__currentLoopData = $projectStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusValue => $statusLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Short Description in')); ?> <?php echo e(__('methods.' . $lang)); ?> *
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="short_description[<?php echo e($key); ?>]"
                                                  rows="3"
                                                  required><?php echo e(old('short_description.' . $key, $project->getTranslation('short_description', $key, false))); ?></textarea>
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
                                                  rows="5"
                                                  required><?php echo e(old('description.' . $key, $project->getTranslation('description', $key, false))); ?></textarea>
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

                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Challenge in')); ?> <?php echo e(__('methods.' . $lang)); ?>

                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="challenge[<?php echo e($key); ?>]"
                                                  rows="3"><?php echo e(old('challenge.' . $key, $project->getTranslation('challenge', $key, false))); ?></textarea>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Solution in')); ?> <?php echo e(__('methods.' . $lang)); ?>

                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="solution[<?php echo e($key); ?>]"
                                                  rows="3"><?php echo e(old('solution.' . $key, $project->getTranslation('solution', $key, false))); ?></textarea>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Results in')); ?> <?php echo e(__('methods.' . $lang)); ?>

                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="results[<?php echo e($key); ?>]"
                                                  rows="3"><?php echo e(old('results.' . $key, $project->getTranslation('results', $key, false))); ?></textarea>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="col-md-12">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Technologies Used')); ?></label>
                                    <?php ($chosenTechs = (array) old('technologies', $selectedTechnologyIds)); ?>
                                    <select class="form-select form-select-solid" name="technologies[]" multiple data-control="select2">
                                        <?php $__currentLoopData = $technologies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tech->id); ?>" <?php if(in_array($tech->id, $chosenTechs, true)): echo 'selected'; endif; ?>>
                                                <?php echo e($tech->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Live Preview URL')); ?></label>
                                    <input type="url" class="form-control form-control-solid" name="live_url" value="<?php echo e(old('live_url', $project->live_url)); ?>" dir="ltr"/>
                                    <?php $__errorArgs = ['live_url'];
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
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Repository URL')); ?></label>
                                    <input type="url" class="form-control form-control-solid" name="repo_url" value="<?php echo e(old('repo_url', $project->repo_url)); ?>" dir="ltr"/>
                                    <?php $__errorArgs = ['repo_url'];
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
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Completed At')); ?></label>
                                    <input type="date" class="form-control form-control-solid" name="completed_at" value="<?php echo e(old('completed_at', $project->completed_at?->format('Y-m-d'))); ?>"/>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Cover Image')); ?></label>
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
                                    <?php if($project->exists && $project->getFirstMediaUrl('projects')): ?>
                                        <img src="<?php echo e($project->getFirstMediaUrl('projects')); ?>" alt="cover" class="mt-3 rounded" width="120"/>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Gallery Screenshots')); ?></label>
                                    <input type="file" class="form-control form-control-solid" name="gallery[]" multiple accept="image/*"/>
                                    <?php $__errorArgs = ['gallery.*'];
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
                                               <?php if((bool) old('is_featured', $project->is_featured)): echo 'checked'; endif; ?>/>
                                        <label class="form-check-label fw-bold ms-3" for="is_featured">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Featured Project')); ?>

                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               <?php if((bool) old('is_active', $project->exists ? $project->is_active : true)): echo 'checked'; endif; ?>/>
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


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/pages/project/form.blade.php ENDPATH**/ ?>