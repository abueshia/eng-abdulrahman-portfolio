<?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('setting home silverblue setting')); ?>
<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text'=>\App\Helpers\TranslationHelper::translate('setting home silverblue setting'),'link'=>route('admin.setting.homecouronnesetting.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Details')]
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
                                    <h4 class="d-inline-block  py-3"><?php echo e(\App\Helpers\TranslationHelper::translate('setting home silverblue setting')); ?></h4>
                                </div>
                                 <?php if(auth()->guard('admin')->user()->can('home_couronne_setting.edit', 'admin')): ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                    <a class="btn btn-primary text-center" style="margin-left: 25px"
                                       href="<?php echo e(route('admin.setting.homecouronnesetting.edit')); ?>">
                                        <span><?php echo e(\App\Helpers\TranslationHelper::translate('Edit')); ?></span> &nbsp;
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                               <?php endif; ?>
                            </div>
                                        
                            

                      

                                          
            
                          
                             

                            

                                          <div class="row px-0 mt-3">
                                <?php $__currentLoopData = Config('language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                <?php echo e(\App\Helpers\TranslationHelper::translate('description_footer in')); ?>  <?php echo e(__('methods.' . $lang)); ?>:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                <?php echo setting('description_footer',$key); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                                        
                                        <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('image_logo')); ?> :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                         <img src="<?php echo e(setting('image_logo', 'en')); ?>" class="img-fluid" alt="test" style="width: 150px; height: 150px; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            
                            <div class="row px-0 mt-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                <?php echo e(\App\Helpers\TranslationHelper::translate('file_one_home_catalogue')); ?> :
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                <?php if(setting('file_one_home', 'en')): ?>
                    <a href="<?php echo e(setting('file_one_home', 'en')); ?>" target="_blank" class="text-primary">
                        <?php echo e(basename(setting('file_one_home', 'en'))); ?> <i class="fa fa-download ms-1"></i>
                    </a>
                <?php else: ?>
                    <span class="text-muted">No file uploaded</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>



           


                                   

                                    



                                    
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
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/admin/pages/setting/homecouronnesetting/show.blade.php ENDPATH**/ ?>