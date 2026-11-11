<?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('setting home silver blue setting')); ?>
<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text'=>\App\Helpers\TranslationHelper::translate('setting home silver blue setting'),'link'=>route('admin.setting.homecouronnesetting.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Edit')]
        ],'button' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">

                        <!--begin::Card body-->

                        <div class="card-body py-4 px-0">

                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3"><?php echo e(\App\Helpers\TranslationHelper::translate('Edit home silver blue setting')); ?> </h4>
                                </div>
                            </div>
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <form action="<?php echo e(route('admin.setting.homecouronnesetting.update')); ?>" method="POST"
                                  enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                
                                

                                    
                                                                    



                                            
                                      

                                    
                                               <div class="row px-0 mt-3">
                                            <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <div class="col-12 my-5">
                                       <label class="fs-5 fw-bold form-label bold mb-2">
                                          <?php echo e(\App\Helpers\TranslationHelper::translate('description_footer in')); ?> <?php echo e(__('methods.' . $lang)); ?>:
                                              </label>
                                            <textarea name="description_footer[<?php echo e($key); ?>]"
                                                class="form-control form-control-solid content_textarea full-editor" id="<?php echo e($key); ?>"><?php echo e(old('description_footer.'.$key) ?? setting('description_footer',$key)); ?></textarea>
                                              <?php $__errorArgs = ['description_footer.'.$key];
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
                                            </div>


          <div class="row px-0 mt-3">
    <div class="col-md-6 mb-4">
        <div class="form-group">
            <label class="bold"><?php echo e(\App\Helpers\TranslationHelper::translate('file_one_home_catalogue')); ?>

                <span class="text-danger">*</span></label>
            <input type="file" name="file_one_home" class="form-control form-control-solid" />
            <?php if(setting('file_one_home', 'en')): ?>
                <a href="<?php echo e(setting('file_one_home', 'en')); ?>" target="_blank" class="d-block mt-2 text-primary">
                    <?php echo e(basename(setting('file_one_home', 'en'))); ?> <i class="fa fa-download ms-1"></i>
                </a>
            <?php endif; ?>
            <?php $__errorArgs = ['file_one_home'];
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


                                              <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold"><?php echo e(\App\Helpers\TranslationHelper::translate('image_logo')); ?>

                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="image_logo" class="form-control form-control-solid" />
                                                <?php if(setting('image_logo', 'en')): ?>
                                                    <img src="<?php echo e(setting('image_logo', 'en')); ?>" width="100" class="mt-2" />
                                                <?php endif; ?>
                                                <?php $__errorArgs = ['image_logo'];
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


                                    
                                    
                                             



                                     
                                     
                                    
                                          



                                <div class="mt-5" style="text-align: right">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Update</span>
                                    </button>
                                </div>
                            </form>
                        </div>


                    </div>

                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/admin/pages/setting/homecouronnesetting/edit.blade.php ENDPATH**/ ?>