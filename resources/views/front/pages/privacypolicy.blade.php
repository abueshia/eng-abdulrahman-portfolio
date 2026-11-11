@extends('front.layouts.app')

@section('content')

      <!-- breadcurmb-area-start -->
      <div
        class="tr-breadcurmb-area tr-breadcurmb-bg"
        style="background-image: url({{(setting('image_panarea_tow', 'en'))}}); background-size: cover; background-position: center; height: 200px;"
      >
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-8">
              <div class="tr-breadcurmb-content text-center z-index-3">
                <div class="tr-breadcurmb-title-box">
                  <h3 class="tr-breadcurmb-title">{{ \App\Helpers\TranslationHelper::translate('Privacy Policy') }}</h3>
                </div>
                <div class="tr-breadcurmb-list-wrap">
                  <div class="tr-breadcurmb-list">
                    <span><a href="{{route('site.home')}}"></a>{{ \App\Helpers\TranslationHelper::translate('Home') }}</span>
                    <span class="dvdr"
                      ><i class="fa-regular fa-angle-right"></i
                    ></span>
                    <i>{{ \App\Helpers\TranslationHelper::translate('Privacy Policy') }}</i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- breadcurmb-area-end -->

<!-- company-info-area-start -->
{{-- <div class="tr-company-info-area" style="background-color: #f9f9f9; padding: 70px 0; margin-top: 50px; margin-bottom: 50px;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-6 col-lg-6">
        <div class="tr-company-info-content">
          <h2 class="tr-company-title" style="font-size: 40px; color: #222;">
            {{ \App\Helpers\TranslationHelper::translate('Privacy Policy') }}
          </h2>
          <p class="tr-company-description" style="font-size: 20px; color: #555; margin-top: 30px; line-height: 1.6;">
            {!! $privacypolicy->description !!}
          </p>
        </div>
      </div>
    </div>
  </div>
</div> --}}
<div class="tr-company-info-area" style="background-color: #f9f9f9; padding: 70px 0; margin-top: 50px; margin-bottom: 50px; text-align: center;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-xl-6 col-lg-6">
        <div class="tr-company-info-content">
          <h2 class="tr-company-title" style="font-size: 40px; color: #222;">
            {{ \App\Helpers\TranslationHelper::translate('Privacy Policy') }}
          </h2>
          <p class="tr-company-description" style="font-size: 20px; color: #555; margin-top: 30px; line-height: 1.6;">
           @if($privacypolicy && $privacypolicy->description)
    {!! $privacypolicy->description !!}
@else
    <p>{{ \App\Helpers\TranslationHelper::translate('Privacy policy content is not available at the moment.') }}</p>
@endif

          </p>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- company-info-area-end -->

      <!-- subdcribe-area-start -->
       <div class="tr-subscribe-area z-index-2">
        <div class="container">
            <div class="tr-subscribe-bg p-relative fix">
                <div class="tr-subscribe-img d-none d-lg-block">
                    <img src="{{(setting('Subscribe_image', 'en'))}}" alt=""/>
                </div>
                <div class="tr-subscribe-circle d-none d-lg-block">
                    <span></span>
                </div>
                <div class="row">
                    <div class="offset-xl-5 offset-lg-5 col-xl-7 col-lg-7">
                        <div class="tr-subscribe-tittle-box mb-35">
                            <h3 class="tr-section-title mb-20 text-white">
                                <br/>
                                {{ setting('section_five_title_one', app()->getLocale()) }}
                            </h3>
                            <p>
                                {!! setting('section_five_description_one', app()->getLocale()) !!}
                            </p>
                        </div>
                        <div class="tr-subscribe-form">
                            <form action="#">
                                <div class="tr-subscribe-input p-relative">
                                    <input type="text" placeholder="{{ \App\Helpers\TranslationHelper::translate('Your email...') }}"/>
                                    <button
                                        class="tr-subscribe-button tr-btn-green light-green"
                                        type="submit"
                                    >
                                        {{ \App\Helpers\TranslationHelper::translate('Subscribe ') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- subdcribe-area-end -->
       @endsection