@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('index Setting'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('index Setting'),'link'=>route('admin.setting.setting_index.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Edit')]
        ]" :button="[]">
    </x-bread-crumb>
@endsection
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">

                        <!--begin::Card body-->

                        <div class="card-body py-4 px-0">

                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Edit index Setting')}} </h4>
                                </div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.setting.setting_index.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                
                                {{-- <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Your gateway title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Your_gateway_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Your_gateway_title.'.$key) ?? setting('Your_gateway_title',$key)}}" />
                                                @error('Your_gateway_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div> --}}
                                                   <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-12 mb-5">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Your_gateway_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Your_gateway_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Your_gateway_title.'.$key) ?? setting('Your_gateway_title',$key)}}" />
                                                @error('Your_gateway_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                     {{-- <div class="row px-0 mt-3">
                                            @foreach (Config('language') as $key => $lang)
                                          <div class="col-12 my-5">
                                       <label class="fs-5 fw-bold form-label bold mb-2">
                                          {{\App\Helpers\TranslationHelper::translate('Your_gateway_title in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <input type="text" name="Your_gateway_title[{{ $key}}]"
                                                class="form-control form-control-solid" value="{{ old('Your_gateway_title.'.$key) ?? setting('Your_gateway_title',$key)}}" />
                                              @error('Your_gateway_title.'.$key)
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                           </span>
                                            @enderror
                                             </div>
                                            @endforeach
                                            </div> --}}

                                    
                                    
                                    
                                              <div class="row px-0 mt-3">
                                            @foreach (Config('language') as $key => $lang)
                                          <div class="col-12 my-5">
                                       <label class="fs-5 fw-bold form-label bold mb-2">
                                          {{\App\Helpers\TranslationHelper::translate('travel agency description in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <input type="text" name="travel_agency_description[{{ $key}}]"
                                                class="form-control form-control-solid" id="{{$key}}" value="{{ old('travel_agency_description.'.$key) ?? setting('travel_agency_description',$key) }}">
                                              @error('travel_agency_description.'.$key)
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                           </span>
                                            @enderror
                                             </div>
                                            @endforeach
                                            </div>

                                              <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('image_panarea')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="image_panarea" class="form-control form-control-solid" />
                                                @if (setting('image_panarea', 'en'))
                                                    <img src="{{ setting('image_panarea', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('image_panarea')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                     <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('image_panarea_tow')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="image_panarea_tow" class="form-control form-control-solid" />
                                                @if (setting('image_panarea_tow', 'en'))
                                                    <img src="{{ setting('image_panarea_tow', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('image_panarea_tow')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('image_panarea_three_footer')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="image_panarea_three" class="form-control form-control-solid" />
                                                @if (setting('image_panarea_three', 'en'))
                                                    <img src="{{ setting('image_panarea_three', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('image_panarea_three')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                            
                                               <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Find Popular Hotels title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Find_Popular_Hotels_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Find_Popular_Hotels_title.'.$key) ?? setting('Find_Popular_Hotels_title',$key)}}" />
                                                @error('Find_Popular_Hotels_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                     <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Find_Popular_Flights_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Find_Popular_Flights_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Find_Popular_Flights_title.'.$key) ?? setting('Find_Popular_Flights_title',$key)}}" />
                                                @error('Find_Popular_Flights_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                     <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Find_Popular_Tours_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Find_Popular_Tours_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Find_Popular_Tours_title.'.$key) ?? setting('Find_Popular_Tours_title',$key)}}" />
                                                @error('Find_Popular_Tours_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>


                                            
                                     <div class="row px-0 mt-3">
                                            @foreach (Config('language') as $key => $lang)
                                          <div class="col-12 my-5">
                                       <label class="fs-5 fw-bold form-label bold mb-2">
                                          {{\App\Helpers\TranslationHelper::translate('Whether you’re description in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <textarea name="Whether_you’re_description[{{ $key}}]"
                                                class="form-control form-control-solid content_textarea full-editor" id="Discover the World description_one_{{$key}}">{{ old('Whether_you’re_description.'.$key) ?? setting('Whether_you’re_description',$key)}}</textarea>
                                              @error('Whether_you’re_description.'.$key)
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                           </span>
                                            @enderror
                                             </div>
                                            @endforeach
                                            </div>


                                     <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Get up to title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Get_up_to_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Get_up_to_title.'.$key) ?? setting('Get_up_to_title',$key)}}" />
                                                @error('Get_up_to_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>



                                     
                                <div class="mt-5" style="text-align: right">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Update</span>
                                    </button>
                                </div>
                            </form>
                        </div>


                    </div>

                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@stop
@section('script')
    <script>

    </script>
@stop
