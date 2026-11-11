<?php $__env->startPush('admin_css'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <!--begin::Image-->
                <img style="width: 100%; height: 400px; object-fit: contain;" class="theme-light-show mx-auto mw-100 mb-10 mb-lg-20 custom_logo_light"
                    src="<?php echo e(asset('front/assets/img/drr.jpg')); ?>" alt=""/>
                 <img style="width: 100%; height: 300px;  object-fit: contain;" class="theme-dark-show mx-auto mw-100 mb-10 mb-lg-20"
                     src="<?php echo e(asset('front/assets/img/drr.jpg')); ?>" alt=""/>
 

                <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
                    Login To your Dashboard <br/>
                    <small class="text-gray-600 fs-3">
                        Fast, Efficient and Productive
                    </small>
                </h1>
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <!--begin::Wrapper-->
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                              action="<?php echo e(route('login')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 fw-bolder mb-3"><?php echo e(\App\Helpers\TranslationHelper::translate('Log In')); ?></h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6"><?php echo e(\App\Helpers\TranslationHelper::translate('Your Dashboard')); ?></div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Login options-->

                            <!--end::Separator-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <label
                                    class="font-size-h6 font-weight-bolder text-dark mb-2"><?php echo e(__('dashboard.email')); ?></label>
                                <input class="form-control bg-transparent
                                              <?php echo e($errors->has('email')||$errors->has('credentials') ? 'is-invalid' : ''); ?>"
                                       type="email" name="email" autocomplete="off"/>
                                <span class="m-form__help text-danger">
                                        <strong><?php echo e($errors->has('email')?$errors->first('email'):null); ?></strong>
                                    </span>                                <!--end::Email-->
                            </div>
                            <!--end::Input group=-->
                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                    <label
                                        class="font-size-h6 font-weight-bolder text-dark  mb-2"><?php echo e(__('dashboard.password')); ?></label>
                                <input class="form-control bg-transparent
                                     <?php echo e($errors->has('password')||$errors->has('credentials') ? 'is-invalid' : ''); ?>"
                                       type="password" name="password" autocomplete="off"/>
                                <span class="m-form__help text-danger">
                                        <strong><?php echo e($errors->has('password')?$errors->first('password'):null); ?></strong>
                                    </span> <span class="m-form__help text-danger">
                                        <strong><?php echo e($errors->has('credentials')?$errors->first('credentials'):null); ?></strong>
                                    </span>
                                <!--end::Password-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Wrapper-->

                            <!--end::Wrapper-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary mt-4">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Log In</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
											<span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Footer-->

                    <!--end::Footer-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Body-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('admin_js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\dr_mohamed_hamza_el_sheikh\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>