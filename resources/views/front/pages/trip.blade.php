@extends('front.layouts.app')

@section('content')

    <!-- breadcurmb-area-start -->
      <div class="tr-breadcurmb-area tr-breadcurmb-bg"  
        style="background-image: url({{ (setting('image_panarea_tow', 'en'))}}); background-size: cover; background-position: center; height: 200px;"
      >
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xl-8">
                  <div class="tr-breadcurmb-content text-center z-index-3">
                     <div class="tr-breadcurmb-title-box">
                        <h3 class="tr-breadcurmb-title">{{ \App\Helpers\TranslationHelper::translate('All Programmes') }}</h3>
                     </div>
                     <div class="tr-breadcurmb-list-wrap">
                        <div class="tr-breadcurmb-list">
                           <span><a href="{{route('site.home')}}">{{ \App\Helpers\TranslationHelper::translate('Home') }}</a></span> 
                           <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                           <i>{{ \App\Helpers\TranslationHelper::translate('All Programmes') }}</i>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- breadcurmb-area-end -->

      <!-- trip-area-start -->
      <div class="tr-trip-area pt-110 pb-50">
         <div class="container">
            <div class="row">

                 @if (isset($programmes) && $programmes->count() > 0)
                      @foreach($programmes as $programme)
               <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                  <div class="tr-trip-item trip-element mb-30">
                     <div class="tr-trip-thumb fix">
                        <a href="{{ route('user.trip_details', $programme->id) }}">
                        <img src="{{ $programme->getFirstMediaUrl('programmes') }}" style="width: 100%; height: 250px; object-fit: cover;" alt="">
                         </a>
                     </div>
                     <div class="tr-trip-content">
                        <a href="#" class="tr-trip-location">
                           <i class="fa-sharp fa-solid fa-location-dot"></i>
                          {{$programme->city->name}}
                        </a>
                      <a href="{{ route('user.trip_details', $programme->id) }}">
                        <h5 class="tr-trip-title"><a class="border-line-black" href="{{route('user.trip_details' , $programme->id)}}">{{ $programme->name }}</a></h5>
                        </a>
                        <div class="rating d-flex align-items-center gap-1">
                            <i class="{{$programme->avg_rate > 0 ? 'fas' : 'far'}} fa-star text-warning"></i>
                             <i class="{{$programme->avg_rate > 1 ? 'fas' : 'far'}} fa-star text-warning"></i>
                            <i class="{{$programme->avg_rate > 2 ? 'fas' : 'far'}} fa-star text-warning"></i>
                            <i class="{{$programme->avg_rate > 3 ? 'fas' : 'far'}} fa-star text-warning"></i>
                            <i class="{{$programme->avg_rate > 4 ? 'fas' : 'far'}} fa-star text-warning"></i>
                            <span class="ms-2">{{$programme->rates->where('status', 1)->count()}} {{ \App\Helpers\TranslationHelper::translate('reviews') }}</span>
                        </div>
                        {{-- <div class="tr-trip-duration d-flex align-items-center">
                           <span>
                              <i class="fa-sharp fa-light fa-clock"></i>
                              Time period:
                           </span>
                           <p>{{ $programme->programmeItinerary->count() }} days</p>
                        </div> --}}
                           <div class="tr-price-text">
                            <p>
                                 {!! Str::words(strip_tags($programme->description), 15) !!}
                            </p>
                        </div>
                        <div class="tr-trip-price d-flex align-items-center justify-content-between">
                           <a class="tr-trip-link" href="{{ route('user.trip_details', $programme->id) }}">{{ \App\Helpers\TranslationHelper::translate('See Details') }}<i class="fa-sharp fa-regular fa-arrow-right-long"></i></a>
                           @if($programme->discount > 0)
                               <div class="d-flex">
                                   <del class="me-2">{{$programme->price}}</del>
                                   <span>{{getProgrammePriceIfDiscount($programme)}}</span>
                               </div>
                           @else
                               <span>${{$programme->price}}</span>
                           @endif
                     </div>
                  </div>
               </div>
                     </div>
                  @endforeach
                    @endif

{{-- 
               <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                  <div class="tr-trip-item trip-element mb-30">
                     <div class="tr-trip-thumb fix">
                        <img src="assets/img/trip-2.jpg" alt="">
                     </div>
                     <div class="tr-trip-content">
                        <a href="#" class="tr-trip-location">
                           <i class="fa-sharp fa-solid fa-location-dot"></i>
                           New York City, USA
                        </a>
                        <h5 class="tr-trip-title"><a class="border-line-black" href="trip-details.html">Statue of Liberty</a></h5>
                        <div class="tr-trip-ratting">
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <i>4.8 (500+)</i>
                        </div>
                        <div class="tr-trip-duration d-flex align-items-center">
                           <span>
                              <i class="fa-sharp fa-light fa-clock"></i>
                              Time period:
                           </span>
                           <p>4 days</p>
                        </div>
                        <div class="tr-trip-price d-flex align-items-center justify-content-between">
                           <a class="tr-trip-link" href="trip-details.html">See Details<i class="fa-sharp fa-regular fa-arrow-right-long"></i></a>
                           <span>From<i>$5,200</i></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                  <div class="tr-trip-item trip-element mb-30">
                     <div class="tr-trip-thumb fix">
                        <img src="assets/img/trip-3.jpg" alt="">
                     </div>
                     <div class="tr-trip-content">
                        <a href="#" class="tr-trip-location">
                           <i class="fa-sharp fa-solid fa-location-dot"></i>
                           Agra, India
                        </a>
                        <h5 class="tr-trip-title"><a class="border-line-black" href="trip-details.html">Taj Mahal</a></h5>
                        <div class="tr-trip-ratting">
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <i>4.8 (500+)</i>
                        </div>
                        <div class="tr-trip-duration d-flex align-items-center">
                           <span>
                              <i class="fa-sharp fa-light fa-clock"></i>
                              Time period:
                           </span>
                           <p>4 days</p>
                        </div>
                        <div class="tr-trip-price d-flex align-items-center justify-content-between">
                           <a class="tr-trip-link" href="trip-details.html">See Details<i class="fa-sharp fa-regular fa-arrow-right-long"></i></a>
                           <span>From<i>$5,200</i></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                  <div class="tr-trip-item trip-element mb-30">
                     <div class="tr-trip-thumb fix">
                        <img src="assets/img/trip-4.jpg" alt="">
                     </div>
                     <div class="tr-trip-content">
                        <a href="#" class="tr-trip-location">
                           <i class="fa-sharp fa-solid fa-location-dot"></i>
                           Paris, France
                        </a>
                        <h5 class="tr-trip-title"><a class="border-line-black" href="trip-details.html">Eiffel Tower</a></h5>
                        <div class="tr-trip-ratting">
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <i>4.8 (500+)</i>
                        </div>
                        <div class="tr-trip-duration d-flex align-items-center">
                           <span>
                              <i class="fa-sharp fa-light fa-clock"></i>
                              Time period:
                           </span>
                           <p>4 days</p>
                        </div>
                        <div class="tr-trip-price d-flex align-items-center justify-content-between">
                           <a class="tr-trip-link" href="trip-details.html">See Details<i class="fa-sharp fa-regular fa-arrow-right-long"></i></a>
                           <span>From<i>$5,200</i></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                  <div class="tr-trip-item trip-element mb-30">
                     <div class="tr-trip-thumb fix">
                        <img src="assets/img/trip-5.jpg" alt="">
                     </div>
                     <div class="tr-trip-content">
                        <a href="#" class="tr-trip-location">
                           <i class="fa-sharp fa-solid fa-location-dot"></i>
                           New York City, USA
                        </a>
                        <h5 class="tr-trip-title"><a class="border-line-black" href="trip-details.html">Statue of Liberty</a></h5>
                        <div class="tr-trip-ratting">
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <i>4.8 (500+)</i>
                        </div>
                        <div class="tr-trip-duration d-flex align-items-center">
                           <span>
                              <i class="fa-sharp fa-light fa-clock"></i>
                              Time period:
                           </span>
                           <p>4 days</p>
                        </div>
                        <div class="tr-trip-price d-flex align-items-center justify-content-between">
                           <a class="tr-trip-link" href="trip-details.html">See Details<i class="fa-sharp fa-regular fa-arrow-right-long"></i></a>
                           <span>From<i>$5,200</i></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                  <div class="tr-trip-item trip-element mb-30">
                     <div class="tr-trip-thumb fix">
                        <img src="assets/img/trip-6.jpg" alt="">
                     </div>
                     <div class="tr-trip-content">
                        <a href="#" class="tr-trip-location">
                           <i class="fa-sharp fa-solid fa-location-dot"></i>
                           Agra, India
                        </a>
                        <h5 class="tr-trip-title"><a class="border-line-black" href="trip-details.html">Taj Mahal</a></h5>
                        <div class="tr-trip-ratting">
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <span>
                              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M8.47897 0.900089L9.74116 3.38377L12.5747 3.78365C13.9021 3.97092 14.5089 5.609 13.4856 6.577L11.4503 8.50064L11.9293 11.2112C12.1746 12.5997 10.7009 13.5322 9.5404 12.941L6.99987 11.6451L4.4601 12.9406C3.29789 13.5338 1.82538 12.5981 2.0704 11.2112L2.54941 8.50064L0.514427 6.57727C-0.509589 5.60856 0.099321 3.97084 1.42491 3.78367L4.25869 3.38376L5.5215 0.900089C6.1314 -0.299977 7.86916 -0.300082 8.47897 0.900089Z" fill="currentcolor" />
                              </svg>
                           </span>
                           <i>4.8 (500+)</i>
                        </div>
                        <div class="tr-trip-duration d-flex align-items-center">
                           <span>
                              <i class="fa-sharp fa-light fa-clock"></i>
                              Time period:
                           </span>
                           <p>4 days</p>
                        </div>
                        <div class="tr-trip-price d-flex align-items-center justify-content-between">
                           <a class="tr-trip-link" href="trip-details.html">See Details<i class="fa-sharp fa-regular fa-arrow-right-long"></i></a>
                           <span>From<i>$5,200</i></span>
                        </div>
                     </div>
                  </div>
               </div> --}}


      
         </div>
      </div>
      <!-- trip-area-end -->

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
  