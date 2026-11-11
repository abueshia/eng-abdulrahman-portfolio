<!--begin::Aside menu-->
<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
         data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
         data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div
            class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true">
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ activeSingleLink('admin.index') }}" href="{{ route('admin.index') }}">
	                    <span class="menu-icon">
	                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
	                        <span class="svg-icon svg-icon-2">
	                            <img src="{{ asset('dashboard/assets/img/house.png') }}" width="20" height="20" alt="">
	                        </span>
                            <!--end::Svg Icon-->
	                    </span>
                        <span class="menu-title"> {{\App\Helpers\TranslationHelper::translate('Dashboard')}} </span>
                    </a>
                </div>
            </div>



            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{
 hoverLink('admin.place') ||
 hoverLink('admin.category')
 ? 'here hover show' : '' }}">
        <span class="menu-link">
            <span class="menu-icon">
                <img src="{{asset('dashboard/assets/img/airplane.png')}}" width="20" height="20" alt="recruitment">
            </span>
            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('Places')}}</span>
            <span class="menu-arrow"></span>
        </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        {{--                        @if( auth()->user()->id == 1 || auth()->user()->can('Region List'))--}}
                        <a class="menu-link {{ activeLink('admin.category') }}"
                           href="{{route('admin.category.index')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('dashboard/assets/img/options.png')}}" width="20"
                                         height="20" alt="recruitment">
                                </span>
                            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('Categories')}}</span>
                        </a>
                        {{--                        @endif--}}
                        {{--                        @if( auth()->user()->id == 1 || auth()->user()->can('Region List'))--}}
                        <a class="menu-link {{ activeLink('admin.place') }}"
                           href="{{route('admin.place.index')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('dashboard/assets/img/my-location.png')}}" width="20"
                                         height="20" alt="recruitment">
                                </span>
                            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('Places')}}</span>
                        </a>
                        {{--                        @endif--}}
                    </div>
                </div>
            </div>


            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ activeSingleLink('admin.message.index') }}" href="{{ route('admin.message.index') }}">
	                    <span class="menu-icon">
	                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
	                        <span class="svg-icon svg-icon-2">
	                            <img src="{{ asset('dashboard/assets/img/new-email.png') }}" width="20" height="20" alt="">
	                        </span>
                            <!--end::Svg Icon-->
	                    </span>
                        <span class="menu-title"> {{\App\Helpers\TranslationHelper::translate('Messages')}} </span>
                    </a>
                </div>
            </div>


            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{
 hoverLink('admin.setting.main') ||
 hoverLink('admin.setting.bottomBanner') ||
 hoverLink('admin.country') ||
 hoverLink('admin.city') ||
 hoverLink('admin.banner') ||
 hoverLink('admin.region') ||
 hoverLink('admin.setting.aboutUs') ||
hoverLink('admin.setting.use_terms') ||
 hoverLink('admin.faq')
? 'here hover show' : '' }}">
        <span class="menu-link">
            <span class="menu-icon">
                <img src="{{asset('dashboard/assets/img/gear.png')}}" width="20" height="20" alt="recruitment">
            </span>
            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('Website & App')}}</span>
            <span class="menu-arrow"></span>
        </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">


                        {{--                        @if( auth()->user()->id == 1 || auth()->user()->can('MainSetting Show'))--}}
                        <a class="menu-link {{ activeLink('admin.setting.main') }}"
                           href="{{route('admin.setting.main.index')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('dashboard/assets/img/main-menu.png')}}" width="20"
                                         height="20" alt="recruitment">
                                </span>
                            <span
                                class="menu-title">{{\App\Helpers\TranslationHelper::translate('General Settings')}}</span>
                        </a>
                        {{--                        @endif--}}
                        <a class="menu-link {{ activeLink('admin.banner') }}"
                           href="{{route('admin.banner.index')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('dashboard/assets/img/banner.png')}}" width="20"
                                         height="20" alt="recruitment">
                                </span>
                            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('Banners')}}</span>
                        </a>
                        <a class="menu-link {{ activeLink('admin.setting.bottomBanner') }}"
                           href="{{route('admin.setting.bottomBanner.index')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('dashboard/assets/img/folded-ribbon.png')}}" width="20"
                                         height="20" alt="recruitment">
                                </span>
                            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('Bottom Banner')}}</span>
                        </a>
                        {{--                        @if( auth()->user()->id == 1 || auth()->user()->can('Region List'))--}}
                        <a class="menu-link {{ activeLink('admin.country') }}"
                           href="{{route('admin.country.index')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('dashboard/assets/img/region.png')}}" width="20"
                                         height="20" alt="recruitment">
                                </span>
                            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('Countries')}}</span>
                        </a>
                        {{--                        @endif--}}
                        {{--                        @if( auth()->user()->id == 1 || auth()->user()->can('Region List'))--}}
                        <a class="menu-link {{ activeLink('admin.city') }}"
                           href="{{route('admin.city.index')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('dashboard/assets/img/city.png')}}" width="20"
                                         height="20" alt="recruitment">
                                </span>
                            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('Cities')}}</span>
                        </a>
                        {{--                        @endif--}}

                        {{--                        @if( auth()->user()->id == 1 || auth()->user()->can('Region List'))--}}
                        <a class="menu-link {{ activeLink('admin.region') }}"
                           href="{{route('admin.region.index')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('dashboard/assets/img/map.png')}}" width="20"
                                         height="20" alt="recruitment">
                                </span>
                            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('Regions')}}</span>
                        </a>
                        {{--                        @endif--}}
                        {{--                        @if( auth()->user()->id == 1 || auth()->user()->can('WhyUsSetting Show'))--}}
                        <a class="menu-link {{ activeLink('admin.setting.aboutUs') }}"
                           href="{{route('admin.setting.aboutUs.index')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('dashboard/assets/img/answer.png')}}" width="20"
                                         height="20" alt="recruitment">
                                </span>
                            <span class="menu-title">{{\App\Helpers\TranslationHelper::translate('About us')}}</span>
                        </a>
                        {{--                        @endif--}}


                        {{--                        @if( auth()->user()->id == 1 || auth()->user()->can('PrivacyPolicySetting Show'))--}}
                        <a class="menu-link {{ activeLink('admin.setting.privacy_policy') }}"
                           href="{{route('admin.setting.privacy_policy.index')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('dashboard/assets/img/privacy-policy.png')}}" width="20"
                                         height="20" alt="recruitment">
                                </span>
                            <span
                                class="menu-title">{{\App\Helpers\TranslationHelper::translate('Privacy Policy')}}</span>
                        </a>
                        {{--                        @endif--}}
                        {{--                        @if( auth()->user()->id == 1 || auth()->user()->can('TermsOfUseSetting Show'))--}}
                        <a class="menu-link {{ activeLink('admin.setting.use_terms') }}"
                           href="{{route('admin.setting.use_terms.index')}}">
                                <span class="menu-icon">
                                    <img src="{{asset('dashboard/assets/img/assignment.png')}}" width="20"
                                         height="20" alt="recruitment">
                                </span>
                            <span
                                class="menu-title">{{\App\Helpers\TranslationHelper::translate('Terms Of Use')}}</span>
                        </a>
                        {{--                        @endif--}}

                        {{--                        @if( auth()->user()->id == 1 || auth()->user()->can('Banner List'))--}}
                        {{--                            <a class="menu-link {{ activeLink('admin.faqs') }}"--}}
                        {{--                               href="{{route('admin.faqs.index')}}">--}}
                        {{--                                <span class="menu-icon">--}}
                        {{--                                    <img src="{{asset('dashboard/assets/img/faq.png')}}" width="20"--}}
                        {{--                                         height="20" alt="recruitment">--}}
                        {{--                                </span>--}}
                        {{--                                <span class="menu-title">الأسئلة الشائعة</span>--}}
                        {{--                            </a>--}}
                        {{--                        @endif--}}


                    </div>
                </div>
            </div>


        </div>
        <!--end::Menu-->
    </div>
    <!--end::Aside Menu-->
</div>
<!--end::Aside menu-->
