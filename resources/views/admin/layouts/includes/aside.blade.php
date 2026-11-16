@php
    /** @var \App\Models\User|null $sidebarAdmin */
    $sidebarAdmin = auth()->guard('admin')->user();
    $unreadBadgeCount = (int) ($sidebarUnreadMessagesCount ?? 0);

    $canViewPortfolioSection = $sidebarAdmin !== null && (
        $sidebarAdmin->can('projects.view_all', 'admin')
        || $sidebarAdmin->can('technologies.view_all', 'admin')
        || $sidebarAdmin->can('experiences.view_all', 'admin')
        || $sidebarAdmin->can('credentials.view_all', 'admin')
        || $sidebarAdmin->can('services.view_all', 'admin')
    );

    $canViewContentSection = $sidebarAdmin !== null && (
        $sidebarAdmin->can('categories.view_all', 'admin')
        || $sidebarAdmin->can('blogs.view_all', 'admin')
        || $sidebarAdmin->can('testimonial.view_all', 'admin')
        || $sidebarAdmin->can('faqs.view_all', 'admin')
        || $sidebarAdmin->can('stats.view_all', 'admin')
    );

    $canViewInboxSection = $sidebarAdmin !== null && $sidebarAdmin->can('messages.view_all', 'admin');
    $canViewSettingsSection = $sidebarAdmin !== null && $sidebarAdmin->can('all_settings.view_all', 'admin');
    $canViewAdministrationSection = $sidebarAdmin !== null && (
        $sidebarAdmin->can('admins.view_all', 'admin')
        || $sidebarAdmin->can('roles.view_all', 'admin')
    );
@endphp

<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
     data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true" data-kt-drawer-width="240px"
     data-kt-drawer-direction="{{ app()->getLocale() === 'ar' ? 'end' : 'start' }}"
     data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6 d-flex align-items-center justify-content-between" id="kt_app_sidebar_logo" style="height: 60px;">
        <a href="{{ route('admin.index') }}" class="d-flex align-items-center gap-2 text-decoration-none">
            <span class="badge badge-primary fw-bolder fs-6 px-2 py-2">EA</span>
            <span class="text-white fw-bolder fs-5 app-sidebar-logo-default">
                {{ \App\Helpers\TranslationHelper::translate('Eng. Abdelrahman') }}
            </span>
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
    <!--end::Logo-->

    <!--begin::Sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-4 mx-3" data-kt-scroll="true"
                 data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                 data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                 data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                 data-kt-scroll-save-state="true">

                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                     id="kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

                    <!--begin::Dashboard-->
                    <div class="menu-item">
                        <a class="menu-link {{ activeSingleLink('admin.index') }}" href="{{ route('admin.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-chart-pie fs-4"></i>
                            </span>
                            <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Dashboard') }}</span>
                        </a>
                    </div>
                    <!--end::Dashboard-->

                    <!--begin::Portfolio Group-->
                    @if ($canViewPortfolioSection)
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">
                                    {{ \App\Helpers\TranslationHelper::translate('Portfolio') }}
                                </span>
                            </div>
                        </div>

                        @if ($sidebarAdmin->can('projects.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.project') }}" href="{{ route('admin.project.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-laptop-code fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Projects') }}</span>
                                </a>
                            </div>
                        @endif

                        @if ($sidebarAdmin->can('technologies.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.technology') }}" href="{{ route('admin.technology.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-microchip fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Technologies') }}</span>
                                </a>
                            </div>
                        @endif

                        @if ($sidebarAdmin->can('experiences.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.experience') }}" href="{{ route('admin.experience.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-briefcase fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Experiences') }}</span>
                                </a>
                            </div>
                        @endif

                        @if ($sidebarAdmin->can('credentials.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.credential') }}" href="{{ route('admin.credential.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-graduation-cap fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Credentials') }}</span>
                                </a>
                            </div>
                        @endif

                        @if ($sidebarAdmin->can('services.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.service') }}" href="{{ route('admin.service.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-layer-group fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Services') }}</span>
                                </a>
                            </div>
                        @endif
                    @endif
                    <!--end::Portfolio Group-->

                    <!--begin::Content Group-->
                    @if ($canViewContentSection)
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">
                                    {{ \App\Helpers\TranslationHelper::translate('Content') }}
                                </span>
                            </div>
                        </div>

                        @if ($sidebarAdmin->can('categories.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.category') }}" href="{{ route('admin.category.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-folder-open fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Categories') }}</span>
                                </a>
                            </div>
                        @endif

                        @if ($sidebarAdmin->can('blogs.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.blog') }}" href="{{ route('admin.blog.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-newspaper fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Blogs') }}</span>
                                </a>
                            </div>
                        @endif

                        @if ($sidebarAdmin->can('testimonial.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.testimonial') }}" href="{{ route('admin.testimonial.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-star fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Testimonials') }}</span>
                                </a>
                            </div>
                        @endif

                        @if ($sidebarAdmin->can('faqs.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.faq') }}" href="{{ route('admin.faq.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-question-circle fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('FAQs') }}</span>
                                </a>
                            </div>
                        @endif

                        @if ($sidebarAdmin->can('stats.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.stat') }}" href="{{ route('admin.stat.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-chart-bar fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Stats') }}</span>
                                </a>
                            </div>
                        @endif
                    @endif
                    <!--end::Content Group-->

                    <!--begin::Inbox Group-->
                    @if ($canViewInboxSection)
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">
                                    {{ \App\Helpers\TranslationHelper::translate('Inbox') }}
                                </span>
                            </div>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ activeLink('admin.message') }}" href="{{ route('admin.message.index') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-envelope-open-text fs-4"></i>
                                </span>
                                <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Contact Messages') }}</span>
                                @if ($unreadBadgeCount > 0)
                                    <span class="badge badge-sm badge-circle badge-danger ms-2" data-testid="sidebar-unread-messages-badge">
                                        {{ $unreadBadgeCount }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    @endif
                    <!--end::Inbox Group-->

                    <!--begin::Settings Group-->
                    @if ($canViewSettingsSection)
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">
                                    {{ \App\Helpers\TranslationHelper::translate('Settings') }}
                                </span>
                            </div>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ activeLink('admin.all_settings') }}" href="{{ route('admin.all_settings.index') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-sliders-h fs-4"></i>
                                </span>
                                <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('General Settings') }}</span>
                            </a>
                        </div>
                    @endif
                    <!--end::Settings Group-->

                    <!--begin::Administration Group-->
                    @if ($canViewAdministrationSection)
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">
                                    {{ \App\Helpers\TranslationHelper::translate('Administration') }}
                                </span>
                            </div>
                        </div>

                        @if ($sidebarAdmin->can('admins.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.admin') }}" href="{{ route('admin.admin.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-user-shield fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Admins') }}</span>
                                </a>
                            </div>
                        @endif

                        @if ($sidebarAdmin->can('roles.view_all', 'admin'))
                            <div class="menu-item">
                                <a class="menu-link {{ activeLink('admin.role') }}" href="{{ route('admin.role.index') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-key fs-4"></i>
                                    </span>
                                    <span class="menu-title">{{ \App\Helpers\TranslationHelper::translate('Roles & Permissions') }}</span>
                                </a>
                            </div>
                        @endif
                    @endif
                    <!--end::Administration Group-->

                </div>
            </div>
        </div>
    </div>
    <!--end::Sidebar menu-->
</div>
