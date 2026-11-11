@extends('front.layouts.app')

@section('content')

      <!-- photo-gallery-area-start -->
      <div class="tr-photo-gallery-area">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="tr-section-title text-center mb-40">
                <h3>{{ \App\Helpers\TranslationHelper::translate('Gallery') }}</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="tr-photo-gallery">
                <div class="row">
                  @foreach ($galleries as $gallery)
                  <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="tr-photo-gallery-item mb-30">
                      @if($gallery->getFirstMediaUrl('galleries_image'))
                        <img src="{{ $gallery->getFirstMediaUrl('galleries_image') }}" style="width: 100%; height: 250px; object-fit: cover;" alt="" />
                      @endif
                    </div>
                  </div> 
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
                   <br />
                    {{ setting('section_five_title_one', app()->getLocale()) }}
                  </h3>
                  <p>
                    {!! setting('section_five_description_one', app()->getLocale()) !!}
                  </p>
                </div>
                <div class="tr-subscribe-form">
                  <form action="#">
                    <div class="tr-subscribe-input p-relative">
                      <input type="text" placeholder="{{ \App\Helpers\TranslationHelper::translate('Your email...') }}" />
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
      </div>
      <!-- subdcribe-area-end -->
     @endsection