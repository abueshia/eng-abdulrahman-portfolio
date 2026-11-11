<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
     data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo" style="height: 45px">
        <!--begin::Logo image-->


   <a href="<?php echo e(route('admin.index')); ?>">

    <h1 style="color: rgb(241, 196, 15)"><?php echo e(\App\Helpers\TranslationHelper::translate('Couronne Royale')); ?></h1>

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
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
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
												<i class="ki-solid ki-element-11 fs-2">
												</i>
											</span>
                            <span class="menu-title"> <?php echo e(\App\Helpers\TranslationHelper::translate('Dashboard')); ?></span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="click"
    class="menu-item menu-accordion <?php echo e(hoverLink('admin.roles_admins') ? 'here hover show' : ''); ?>">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="ki-solid ki-lock fs-2"></i>
        </span>
        <span class="menu-title"> <?php echo e(\App\Helpers\TranslationHelper::translate('Roles & Admins')); ?></span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion">
        <!-- Roles -->
         <?php if(auth()->guard('admin')->user()->can('roles.view_all', 'admin')): ?>
            <div class="menu-item">
                <a class="menu-link <?php echo e(activeLink('admin.role.index')); ?>" href="<?php echo e(route('admin.role.index')); ?>">
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Roles')); ?></span>
                </a>
            </div>
        <?php endif; ?>

        <!-- Admins -->
        <?php if(auth()->guard('admin')->user()->can('admins.view_all', 'admin')): ?>
            <div class="menu-item">
                <a class="menu-link <?php echo e(activeLink('admin.admin.index')); ?>" href="<?php echo e(route('admin.admin.index')); ?>">
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Admins')); ?></span>
                </a>
            </div>
        <?php endif; ?>
       
    </div>
</div>

            <?php if(auth()->guard('admin')->user()->can('blog_categories.view_all', 'admin')): ?>
                    <div class="menu-item <?php echo e(activeLink('admin.category')); ?>">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="<?php echo e(route('admin.category.index')); ?>">
											<span class="menu-icon">
												<i class="fas fa-list-ol fs-2"></i>
											</span>
                            <span
                                class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Card Categories')); ?> </span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <?php endif; ?>


                          <?php if(auth()->guard('admin')->user()->can('categorycolid.view_all', 'admin')): ?>
                    <div class="menu-item <?php echo e(activeLink('admin.categorycolid')); ?>">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="<?php echo e(route('admin.categorycolid.index')); ?>">
											<span class="menu-icon">
												<i class="fas fa-list-ol fs-2"></i>
											</span>
                            <span
                                class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('category colid')); ?> </span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <?php endif; ?>
                    

  <div data-kt-menu-trigger="click"
    class="menu-item menu-accordion <?php echo e(hoverLink('admin.card') ? 'here hover show' : ''); ?>">
    <span class="menu-link">
        <span class="menu-icon">
<i class="fas fa-layer-group fs-2"></i>

        </span>
        <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('card')); ?></span>
        <span class="menu-arrow"></span>
    </span>

    <div class="menu-sub menu-sub-accordion">

                        <?php if(auth()->guard('admin')->user()->can('card.create', 'admin')): ?>
            <div class="menu-item">
                <a class="menu-link <?php echo e(activeLink('admin.card.create')); ?>"
                   href="<?php echo e(route('admin.card.create')); ?>">
                   
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Add card')); ?></span>
                </a>
            </div>
        <?php endif; ?>

        <?php if(auth()->guard('admin')->user()->can('card.view_all', 'admin')): ?>
            <div class="menu-item">
                <a class="menu-link <?php echo e(activeLink('admin.card.index')); ?>"
                   href="<?php echo e(route('admin.card.index')); ?>">
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('All card')); ?></span>
                </a>
            </div>
        <?php endif; ?>

    
        
    </div>
</div>


<div data-kt-menu-trigger="click"
    class="menu-item menu-accordion <?php echo e(hoverLink('admin.blogs') ? 'here hover show' : ''); ?>">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas fa-newspaper fs-2"></i>
        </span>
        <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Blogs')); ?></span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion">

        <!-- Blogs -->
        <?php if(auth()->guard('admin')->user()->can('blogs.view_all', 'admin')): ?>
            <div class="menu-item">
                <a class="menu-link <?php echo e(activeLink('admin.blog.index')); ?>"
                   href="<?php echo e(route('admin.blog.index')); ?>">
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('All Blogs')); ?></span>
                </a>
            </div>
        <?php endif; ?>

        <!-- Add Blog -->
        <?php if(auth()->guard('admin')->user()->can('blogs.create', 'admin')): ?>
            <div class="menu-item">
                <a class="menu-link <?php echo e(activeLink('admin.blog.create')); ?>"
                   href="<?php echo e(route('admin.blog.create')); ?>">
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Add Blog')); ?></span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>



                




                     

                     
                 
                         



                    



                    

 

                    




 

                    

                     

                     

                      



                

                  

                     



                    

                            
                    
                     
                     
                            



 




                   

                             

                     





                      


                         




                      
                         

                     


                     


<div data-kt-menu-trigger="click" class="menu-item menu-accordion <?php echo e(hoverLink('admin.website_settings') ? 'here hover show' : ''); ?>">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="bi bi-gear fs-2"></i>
        </span>
        <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('App Settings')); ?></span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion">




                       
                        

        
     
        <!-- Countries -->
        

        <!-- Cities -->
        

        <!-- Regions -->
        

        <!-- Payment Pictures -->
        
        

            <?php if(auth()->guard('admin')->user()->can('news.view_all', 'admin')): ?>
            <div class="menu-item">
                <a class="menu-link" href="<?php echo e(route('admin.news.index')); ?>">
                   
                    <span class="menu-icon">
                        <i class="fas fa-broadcast-tower fs-2"></i>
                    </span>
                    <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('news Video')); ?></span>
                </a>
            </div>
        <?php endif; ?>

        <!-- About Us -->
        <?php if(auth()->guard('admin')->user()->can('about_us.view_all', 'admin')): ?>
            <div class="menu-item">
                <a class="menu-link" href="<?php echo e(route('admin.about.index')); ?>">
                   
                    <span class="menu-icon">
                        <i class="fas fa-user-circle fs-2"></i>
                    </span>
                    <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('About us')); ?></span>
                </a>
            </div>
        <?php endif; ?>



        <!-- Contact -->
        <?php if(auth()->guard('admin')->user()->can('contact.view_all', 'admin')): ?>
            <div class="menu-item">
                <a class="menu-link" href="<?php echo e(route('admin.contact.index')); ?>">
                    
                    <span class="menu-icon">
                        <i class="fas fa-phone-volume fs-2"></i>
                    </span>
                    <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Contact')); ?></span>
                </a>
            </div>
        <?php endif; ?>

        

        <!-- Privacy Policy -->
        <?php if(auth()->guard('admin')->user()->can('privacypolicy.view_all', 'admin')): ?>
            <div class="menu-item">
                <a class="menu-link" href="<?php echo e(route('admin.privacypolicy.index')); ?>">
                    <span class="menu-icon">
                        <i class="fas fa-quote-left fs-2"></i>
                    </span>
                    <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Privacy Policy')); ?></span>
                </a>
            </div>
        <?php endif; ?>

        <!-- Terms and Conditions -->
        <div class="menu-item">
            <a class="menu-link" href="<?php echo e(route('admin.termsandcondition.index')); ?>">
                <span class="menu-icon">
                    <i class="fas fa-quote-left fs-2"></i>
                </span>
                <span class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Terms and Conditions')); ?></span>
            </a>
        </div>
    </div>
</div>


















                     


                  





                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    


                <!--end:Menu item-->


                    <!--begin:Menu item-->
                    

                    


                              



                          




                    
                    
                    <!--begin:Menu item-->
                        
                    


                    
                    
                    
                    

                <!--end:Menu item-->
                    <!--begin:Menu item-->
                    
                        
                        

                       









                    
                    
                    
                    
                    
                    


                    <div class="menu-item d-none <?php echo e(activeLink('admin.transaction')); ?>">
                        <!--begin:Menu link-->
                        
                        <a class="menu-link" href="javascript:void(0);">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-dollar fs-2">
                                 <span class="path1"></span>
                                 <span class="path2"></span>
                                 <span class="path3"></span>
                                </i>
                            </span>
                            <span
                                class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('Transactions')); ?> </span>
                        </a>
                        <!--end:Menu link-->
                    </div>


                    

                <!--end:Menu item-->
                    <!--begin:Menu item-->








                        
                        <!--begin:Menu item-->



                        
                    <!--end:Menu item-->
                    
                <!--begin:Menu item-->
                    

                <!--end:Menu item-->
                    <!--begin:Menu item-->

                    

                <!--begin:Menu item-->
                 
                    
                    <?php if(auth()->guard('admin')->user()->can('all_settings.view_all', 'admin')): ?>
                    <div class="menu-item <?php echo e(activeLink('admin.all_settings')); ?>">
                        <a class="menu-link" href="<?php echo e(route('admin.all_settings.index')); ?>">
                            
											<span class="menu-icon">
												<i class="ki-solid ki-gear fs-2"></i>
											</span>
                            <span
                                class="menu-title"><?php echo e(\App\Helpers\TranslationHelper::translate('General Settings')); ?></span>
                        </a>
                    </div>
                          <?php endif; ?>
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
<?php /**PATH D:\xampp\htdocs\couronne\resources\views/admin/layouts/includes/aside.blade.php ENDPATH**/ ?>