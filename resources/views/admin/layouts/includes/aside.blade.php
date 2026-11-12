<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
     data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo" style="height: 45px">
        <!--begin::Logo image-->


   <a href="{{ route('admin.index') }}">

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
        <!--end::Sidebar toggle-->
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


                    <div class="menu-item {{ activeSingleLink('admin.index') }}">
                        <a class="menu-link" href="{{route('admin.index')}}">
											<span class="menu-icon">
												<i class="ki-solid ki-element-11 fs-2">
												</i>
											</span>
                            <span class="menu-title"> {{\App\Helpers\TranslationHelper::translate('Dashboard')}}</span>
                        </a>
                    </div>

                    {{-- <div data-kt-menu-trigger="click"
    class="menu-item menu-accordion {{ hoverLink('admin.roles_admins') ? 'here hover show' : '' }}">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="ki-solid ki-lock fs-2"></i>
        </span>
        <span class="menu-title"> {{ \App\Helpers\TranslationHelper::translate('Roles & Admins') }}</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion">
         @if (auth()->guard('admin')->user()->can('roles.view_all', 'admin'))
            <div class="menu-item">
                <a class="menu-link {{ activeLink('admin.role.index') }}" href="{{ route('admin.role.index') }}">
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Roles') }}</span>
                </a>
            </div>
        @endif

        @if (auth()->guard('admin')->user()->can('admins.view_all', 'admin'))
            <div class="menu-item">
                <a class="menu-link {{ activeLink('admin.admin.index') }}" href="{{ route('admin.admin.index') }}">
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Admins') }}</span>
                </a>
            </div>
        @endif
       
    </div>
</div> --}}

            

                     
                 
                          {{-- <div data-kt-menu-trigger="click"
    class="menu-item menu-accordion {{ hoverLink('admin.productcategory') ? 'here hover show' : '' }}">
    <span class="menu-link">
        <span class="menu-icon">
        		<i class="fas fa-list-ol fs-2"></i>
        </span>
        <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('products category') }}</span>
        <span class="menu-arrow"></span>
    </span>

    <div class="menu-sub menu-sub-accordion">
        @if (auth()->guard('admin')->user()->can('productcategory.view_all', 'admin'))
            <div class="menu-item">
                <a class="menu-link {{ activeLink('admin.productcategory.index') }}"
                   href="{{ route('admin.productcategory.index') }}">
                   
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('All products category') }}</span>
                </a>
            </div>
        @endif

        @if (auth()->guard('admin')->user()->can('productcategory.create', 'admin'))
            <div class="menu-item">
                <a class="menu-link {{ activeLink('admin.productcategory.create') }}"
                   href="{{ route('admin.productcategory.create') }}">
                   
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Add products category') }}</span>
                </a>
            </div>
        @endif
    </div>
</div> 



                     <div data-kt-menu-trigger="click"
    class="menu-item menu-accordion {{ hoverLink('admin.product') ? 'here hover show' : '' }}">
    <span class="menu-link">
        <span class="menu-icon">
           <i class="fas fa-shopping-bag fs-2"></i>
        </span>
        <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('products') }}</span>
        <span class="menu-arrow"></span>
    </span>

    <div class="menu-sub menu-sub-accordion">
        @if (auth()->guard('admin')->user()->can('product.view_all', 'admin'))
            <div class="menu-item">
                <a class="menu-link {{ activeLink('admin.product.index') }}"
                   href="{{ route('admin.product.index') }}">
                   
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('All products') }}</span>
                </a>
            </div>
        @endif

        @if (auth()->guard('admin')->user()->can('product.create', 'admin'))
            <div class="menu-item">
                <a class="menu-link {{ activeLink('admin.product.create') }}"
                   href="{{ route('admin.product.create') }}">
                   
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Add products') }}</span>
                </a>
            </div>
        @endif
    </div>
</div> 

 --}}



                        
          <div data-kt-menu-trigger="click"
    class="menu-item menu-accordion {{ hoverLink('admin.banner') ? 'here hover show' : '' }}">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="fas fa-images fs-2"></i>
        </span>
        <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('banner') }}</span>
        <span class="menu-arrow"></span>
    </span>

    <div class="menu-sub menu-sub-accordion">
        @if (auth()->guard('admin')->user()->can('banner.view_all', 'admin'))
            <div class="menu-item">
                <a class="menu-link {{ activeLink('admin.banner.index') }}"
                   href="{{ route('admin.banner.index') }}">
                   
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('All banner') }}</span>
                </a>
            </div>
        @endif

        @if (auth()->guard('admin')->user()->can('banner.create', 'admin'))
            <div class="menu-item">
                <a class="menu-link {{ activeLink('admin.banner.create') }}"
                   href="{{ route('admin.banner.create') }}">
                   
                    <span class="menu-icon">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Add banner') }}</span>
                </a>
            </div>
        @endif
    </div>
</div>


 @if (auth()->guard('admin')->user()->can('messages.view_all', 'admin'))
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('admin.message.index')}}">
											<span class="menu-icon">
												  <i class="ki-solid ki-messages fs-2"></i>
											</span>
                            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('Messages')}}</span>
                        </a>
                    </div>
                     @endif 



                     @if (auth()->guard('admin')->user()->can('testimonial.view_all', 'admin'))
    <div class="menu-item">
        <a class="menu-link" href="{{ route('admin.testimonial.index') }}">
            <span class="menu-icon">
                <i class="fas fa-star fs-2"></i>
            </span>
            <span class="menu-title">Testimonial</span>
        </a>
    </div>
@endif

                     



{{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ hoverLink('admin.website_settings') ? 'here hover show' : '' }}">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="bi bi-gear fs-2"></i>
        </span>
        <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('App Settings') }}</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion">

                     

      @if (auth()->guard('admin')->user()->can('gallery.view_all', 'admin'))
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('admin.gallery.index')}}">
											<span class="menu-icon">
												  <i class="bi bi-image fs-2"></i>
											</span>
                            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('Own Brands')}}</span>
                        </a>
                    </div>
                     @endif 


                      
        @if (auth()->guard('admin')->user()->can('about_us.view_all', 'admin'))
            <div class="menu-item">
                <a class="menu-link" href="{{ route('admin.about.index') }}">
                   
                    <span class="menu-icon">
                        <i class="fas fa-user-circle fs-2"></i>
                    </span>
                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('About us') }}</span>
                </a>
            </div>
        @endif



        @if (auth()->guard('admin')->user()->can('contact.view_all', 'admin'))
            <div class="menu-item">
                <a class="menu-link" href="{{ route('admin.contact.index') }}">
                    
                    <span class="menu-icon">
                        <i class="fas fa-phone-volume fs-2"></i>
                    </span>
                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Contact') }}</span>
                </a>
            </div>
        @endif

       
    </div>
</div> --}}

















{{-- 
                    <div class="menu-item d-none {{ activeLink('admin.transaction') }}">
                        <a class="menu-link" href="javascript:void(0);">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-dollar fs-2">
                                 <span class="path1"></span>
                                 <span class="path2"></span>
                                 <span class="path3"></span>
                                </i>
                            </span>
                            <span
                                class="menu-title">{{\App\Helpers\TranslationHelper::translate('Transactions')}} </span>
                        </a>
                    </div>
 --}}

                   
                    {{-- @if (auth()->guard('admin')->user()->can('all_settings.view_all', 'admin'))
                    <div class="menu-item {{ activeLink('admin.all_settings') }}">
                        <a class="menu-link" href="{{route('admin.all_settings.index')}}">
                            
											<span class="menu-icon">
												<i class="ki-solid ki-gear fs-2"></i>
											</span>
                            <span
                                class="menu-title">{{\App\Helpers\TranslationHelper::translate('General Settings')}}</span>
                        </a>
                    </div>
                          @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
