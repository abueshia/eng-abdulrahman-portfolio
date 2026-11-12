<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
     data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo" style="height: 45px">
        <a href="<?php echo e(route('admin.index')); ?>">
            <h1 style="color: rgb(248, 248, 248); font-size: 18px; margin: 0;">Eng. Abdelrahman</h1>
        </a>

        <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-25px w-25px position-absolute top-50 start-100 translate-middle rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-1 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>

    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-0" data-kt-scroll="true"
                 data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                 data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                 data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                 data-kt-scroll-save-state="true">
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                     id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

                    <div class="menu-item <?php echo e(activeSingleLink('admin.index')); ?>">
                        <a class="menu-link" href="<?php echo e(route('admin.index')); ?>">
                            <span class="menu-icon">
                                <i class="ki-solid ki-element-11 fs-2"></i>
                            </span>
                            <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Dashboard')); ?></span>
                        </a>
                    </div>

                    <?php if(auth()->guard('admin')->user()?->can('messages.view_all', 'admin')): ?>
                        <div class="menu-item">
                            <a class="menu-link <?php echo e(activeLink('admin.message')); ?>" href="<?php echo e(route('admin.message.index')); ?>">
                                <span class="menu-icon">
                                    <i class="ki-solid ki-messages fs-2"></i>
                                </span>
                                <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Messages')); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if(auth()->guard('admin')->user()?->can('testimonial.view_all', 'admin')): ?>
                        <div class="menu-item">
                            <a class="menu-link <?php echo e(activeLink('admin.testimonial')); ?>" href="<?php echo e(route('admin.testimonial.index')); ?>">
                                <span class="menu-icon">
                                    <i class="fas fa-star fs-2"></i>
                                </span>
                                <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Testimonials')); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if(auth()->guard('admin')->user()?->can('blogs.view_all', 'admin')): ?>
                        <div class="menu-item">
                            <a class="menu-link <?php echo e(activeLink('admin.blog')); ?>" href="<?php echo e(route('admin.blog.index')); ?>">
                                <span class="menu-icon">
                                    <i class="fas fa-newspaper fs-2"></i>
                                </span>
                                <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Blogs')); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if(auth()->guard('admin')->user()?->can('all_settings.view_all', 'admin')): ?>
                        <div class="menu-item">
                            <a class="menu-link <?php echo e(activeLink('admin.all_settings')); ?>" href="<?php echo e(route('admin.all_settings.index')); ?>">
                                <span class="menu-icon">
                                    <i class="ki-solid ki-gear fs-2"></i>
                                </span>
                                <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('General Settings')); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/layouts/includes/aside.blade.php ENDPATH**/ ?>