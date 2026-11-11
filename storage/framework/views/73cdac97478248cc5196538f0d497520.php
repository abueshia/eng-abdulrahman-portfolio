<?php if($method == 'PUT'): ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Edit Role')); ?>
<?php else: ?>
    <?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Add Role')); ?>
<?php endif; ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
    ['text'=> \App\Helpers\TranslationHelper::translate('Roles'),'link'=>route('admin.role.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ],'button' => ['text'=>\App\Helpers\TranslationHelper::translate('Go to Roles'),'link'=>route('admin.role.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                <div class="p-5">
                            <!--begin::Form-->
                            <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php if($method == 'PUT'): ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="id" value="<?php echo e($role->id); ?>">

                            <?php endif; ?>
                            <!--begin::Input group-->


                                



                                
                                


<div class="fv-row mb-10">
    <div class="row">
        <div class="col-6 mb-5">
            <label class="fs-5 fw-bold form-label mb-5">
                <?php echo e(\App\Helpers\TranslationHelper::translate('Name')); ?>:
            </label>
            <!-- Input Field -->
            <input type="text" class="form-control form-control-solid"
                   value="<?php echo e(old('name') ?? $role->name); ?>"
                   placeholder="<?php echo e(\App\Helpers\TranslationHelper::translate('Name')); ?>" name="name"/>
            <?php $__errorArgs = ['name'];
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

    <div class="row">
        <h3 class="mb-5">
            <?php echo e(\App\Helpers\TranslationHelper::translate('Choose Permissions')); ?>

            <input type="checkbox" name="all_perm" id="all_perm"
                   class="form-check-input ms-5 me-3"
                   onchange="changeAllPerm(this)">
            <label for="all_perm"><?php echo e(\App\Helpers\TranslationHelper::translate('Check All')); ?></label>
        </h3>

        <?php if($method == 'PUT'): ?>
            <?php $__currentLoopData = $permissions_grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-12 d-flex"> <!-- إضافة d-flex هنا لجعل العناصر متساوية الطول -->
                    <div class="card p-5 mb-5 flex-fill"> <!-- flex-fill لضمان أن العناصر تملأ الفراغ بالتساوي -->
                        <div class="card-header p-3 pb-0" style="min-height: 35px; border: 0;">
                            <h3><?php echo e(\App\Helpers\TranslationHelper::translate($group)); ?></h3>
                        </div>
                        <div class="row p-3">
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <input type="checkbox" class="form-check-input perm_inp cursor-pointer" style="vertical-align: bottom;"
                                           value="<?php echo e($group.'.'.$permission['name']); ?>"
                                           name="permissions[]"
                                           id="<?php echo e($group . '_' . $permission['name']); ?>" <?php echo e(isset($selected_roles) ? (in_array(($group.'.'.$permission['name']), $selected_roles) ? 'checked' : '') : ''); ?>>
                                    <label class="fs-5 mx-4 form-check-label cursor-pointer"
                                           style="vertical-align: middle; font-weight: 600;"
                                           for="<?php echo e($group . '_' . $permission['name']); ?>"><?php echo e(\App\Helpers\TranslationHelper::translate($permission['name'])); ?></label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php $__currentLoopData = $permissions_grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-12 d-flex"> <!-- إضافة d-flex هنا لجعل العناصر متساوية الطول -->
                    <div class="card p-5 mb-5 flex-fill"> <!-- flex-fill لضمان أن العناصر تملأ الفراغ بالتساوي -->
                        <div class="card-header p-3 pb-0" style="min-height: 35px; border: 0;">
                            <h3><?php echo e(\App\Helpers\TranslationHelper::translate($group)); ?></h3>
                        </div>
                        <div class="row p-3">
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <input type="checkbox" class="form-check-input perm_inp cursor-pointer" style="vertical-align: bottom;"
                                           value="<?php echo e($group.'.'.$permission['name']); ?>"
                                           name="permissions[]"
                                           id="<?php echo e($group . '_' . $permission['name']); ?>" <?php echo e(old('permissions') ? (in_array($permission['id'], old('permissions')) ? 'checked' : '') : ''); ?>>
                                    <label class="fs-5 mx-4 form-check-label cursor-pointer"
                                           style="vertical-align: middle; font-weight: 600;"
                                           for="<?php echo e($group . '_' . $permission['name']); ?>"><?php echo e(\App\Helpers\TranslationHelper::translate($permission['name'])); ?></label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
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
                </div>

    <!--end::Content-->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('admin_js'); ?>
    <script>
        let perm_inp = $('.perm_inp');

        function changeAllPerm(check) {
            if ($(check).is(':checked')) {
                perm_inp.prop('checked', true);
            } else {
                perm_inp.prop('checked', false);

            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/admin/pages/role/form.blade.php ENDPATH**/ ?>