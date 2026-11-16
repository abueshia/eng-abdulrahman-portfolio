<div id="kt_app_header" class="app-header" data-kt-sticky="true"
     data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize"
     data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
         id="kt_app_header_container">
        <!--begin::Sidebar mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="<?php echo e(\App\Helpers\TranslationHelper::translate('Toggle Menu')); ?>">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px"
                 id="kt_app_sidebar_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <!--end::Sidebar mobile toggle-->

        <!--begin::Mobile brand-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="<?php echo e(route('admin.index')); ?>" class="d-lg-none text-gray-900 fw-bolder fs-5 text-decoration-none">
                <?php echo e(\App\Helpers\TranslationHelper::translate('Eng. Abdelrahman')); ?>

            </a>
        </div>
        <!--end::Mobile brand-->

        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <!--begin::Header title-->
            <div class="d-none d-lg-flex align-items-center">
                <span class="text-gray-700 fw-semibold fs-6">
                    <?php echo e(\App\Helpers\TranslationHelper::translate('Eng. Abdelrahman Abu Aishah — Portfolio CMS')); ?>

                </span>
            </div>
            <!--end::Header title-->

            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0 d-flex align-items-center gap-2">
                <!--begin::View Portfolio Website-->
                <div class="app-navbar-item">
                    <a href="<?php echo e(url('/')); ?>" target="_blank" rel="noopener"
                       class="btn btn-sm btn-light-primary fw-semibold d-flex align-items-center gap-1">
                        <i class="fas fa-external-link-alt fs-7"></i>
                        <span class="d-none d-sm-inline"><?php echo e(\App\Helpers\TranslationHelper::translate('View Website')); ?></span>
                    </a>
                </div>
                <!--end::View Portfolio Website-->

                <!--begin::Language Switcher-->
                <div class="app-navbar-item">
                    <?php
                        $currentLocale = app()->getLocale();
                        $targetLocale = $currentLocale === 'ar' ? 'en' : 'ar';
                        $targetLabel = $currentLocale === 'ar' ? 'English' : 'العربية';
                    ?>
                    <a href="<?php echo e(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($targetLocale, null, [], true)); ?>"
                       hreflang="<?php echo e($targetLocale); ?>"
                       class="btn btn-sm btn-light fw-bold d-flex align-items-center gap-2">
                        <i class="fas fa-globe text-primary fs-6"></i>
                        <span><?php echo e($targetLabel); ?></span>
                    </a>
                </div>
                <!--end::Language Switcher-->

                <!--begin::User menu-->
                <?php
                    /** @var \App\Models\User|null $currentAdmin */
                    $currentAdmin = auth('admin')->user();
                ?>
                <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-35px"
                         data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                         data-kt-menu-attach="parent"
                         data-kt-menu-placement="bottom-end">
                        <img src="<?php echo e(asset('dashboard/assets/media/avatars/blank.png')); ?>"
                             class="rounded-3"
                             alt="<?php echo e($currentAdmin?->name ?? 'Admin'); ?>" />
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                         data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">
                                        <?php echo e($currentAdmin?->name ?? \App\Helpers\TranslationHelper::translate('Admin')); ?>

                                        <span class="badge badge-light-primary fw-bold fs-8 px-2 py-1 ms-2">
                                            <?php echo e(\App\Helpers\TranslationHelper::translate('Admin')); ?>

                                        </span>
                                    </div>
                                    <span class="fw-semibold text-muted fs-7"><?php echo e($currentAdmin?->email); ?></span>
                                </div>
                            </div>
                        </div>
                        <!--end::Menu item-->

                        <div class="separator my-2"></div>

                        <?php if($currentAdmin?->can('all_settings.view_all', 'admin')): ?>
                            <div class="menu-item px-5">
                                <a href="<?php echo e(route('admin.all_settings.index')); ?>" class="menu-link px-5">
                                    <?php echo e(\App\Helpers\TranslationHelper::translate('General Settings')); ?>

                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="menu-item px-5">
                            <a class="menu-link px-5 text-danger" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <?php echo e(\App\Helpers\TranslationHelper::translate('Sign Out')); ?>

                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end::User menu-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>
<?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/layouts/includes/header.blade.php ENDPATH**/ ?>