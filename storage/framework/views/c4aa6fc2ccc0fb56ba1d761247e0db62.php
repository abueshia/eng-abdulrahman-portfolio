<?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('General Settings')); ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [['text' => \App\Helpers\TranslationHelper::translate('General Settings')]],'button' => [],'title' => \App\Helpers\TranslationHelper::translate('General Settings')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

<?php $__env->startPush('admin_css'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->

                 

                
                <!--end::Col-->
                 
                <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="<?php echo e(url('admin/translations/view/all')); ?>">
                                <div class="mb-3">
                                    <i class="ki-solid ki-book fs-3x icon-color"></i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('General Translations')); ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--end::Col-->
                

                
                         

              <?php if(auth()->guard('admin')->user()->can('home_couronne_setting.view_details', 'admin')): ?>
                  <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <div class="card-body align-items-end mb-0 p-0">
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.homecouronnesetting.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('setting home Silver Blue')); ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                        


                


                <!--end::Col-->
                

                 <?php if(auth()->guard('admin')->user()->can('aboutUsSetting.view_details', 'admin')): ?>
                  <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <div class="card-body align-items-end mb-0 p-0">
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.aboutUs.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('AbouteUs_Why Choose Us')); ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>


                 <?php if(auth()->guard('admin')->user()->can('aboutUs_ClientsSaySetting.view_details', 'admin')): ?>
                         <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.aboutUs_ClientsSay.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('AbouteUs_What Clients Say')); ?></span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                <?php endif; ?>

                 <?php if(auth()->guard('admin')->user()->can('aboutUs_Popular_DestinationsSetting.view_details', 'admin')): ?>
                      <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.aboutUs_Popular_Destinations.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('Popular Destinations for trip')); ?></span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                <?php endif; ?>

                 <?php if(auth()->guard('admin')->user()->can('aboutUs_Subscribeto_getSetting.view_details', 'admin')): ?>
                    <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.aboutUs_Subscribeto_get.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('Subscribe to get')); ?></span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                <?php endif; ?>

                 <?php if(auth()->guard('admin')->user()->can('aboutUs_information.view_details', 'admin')): ?>
                   <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.aboutUs_information.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('about Us information')); ?></span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                <?php endif; ?>
            
            
                 <?php if(auth()->guard('admin')->user()->can('setting_blog_details.view_details', 'admin')): ?>
                 <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.setting_blog_details.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('setting blog details')); ?></span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                <?php endif; ?>




                 <?php if(auth()->guard('admin')->user()->can('setting_index.view_details', 'admin')): ?>
                 <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.setting_index.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('setting index-1')); ?></span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                <?php endif; ?>


                 <?php if(auth()->guard('admin')->user()->can('Why_Choose_index.view_details', 'admin')): ?>
                 <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.Why_Choose_index.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('Why Choose index_2')); ?></span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                <?php endif; ?>

                 <?php if(auth()->guard('admin')->user()->can('Find_best_places_index.view_details', 'admin')): ?>
                  <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.Find_best_places_index.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('Find best places index_3')); ?></span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                <?php endif; ?>



                 <?php if(auth()->guard('admin')->user()->can('Your_gateway_to_amazing_index.view_details', 'admin')): ?>
                 <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->


                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.Your_gateway_to_amazing_index.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('Your_gateway_to_amazing_index_4')); ?></span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                <?php endif; ?>


                  



                 <?php if(auth()->guard('admin')->user()->can('trip_title_ad_image_index.view_details', 'admin')): ?>
                  <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.trip_title_ad_image.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('Trip Details Title and Image')); ?></span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                <?php endif; ?>


                 <?php if(auth()->guard('admin')->user()->can('setting_infomation_index.view_details', 'admin')): ?>
                 <div class="col-md-6 col-lg-6 col-xl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 17-->
                    <div
                        class="card no-shadow card-flush bgi-no-repeat bgi-size-contain py-7 bgi-position-x-end h-xl-100">
                        <!--begin::Card body-->
                        <div class="card-body align-items-end mb-0 p-0">
                            <!--begin::Info-->
                            <a class="d-block text-center" href="<?php echo e(route('admin.setting.setting_infomation.index')); ?>">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill fs-3x icon-color">
                                    </i>
                                </div>
                                <div class="fw-bold px-3 pt-0 text-gray-800">
                                    <span class="fs-2  fw-bold "><?php echo e(\App\Helpers\TranslationHelper::translate('setting infomation')); ?></span>
                                </div>
                            </a>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 17-->
                </div>
                <?php endif; ?>




                

                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('admin_js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/admin/pages/setting/index.blade.php ENDPATH**/ ?>