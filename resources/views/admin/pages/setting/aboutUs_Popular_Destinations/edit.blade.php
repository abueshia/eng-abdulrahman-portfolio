@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('About us Setting'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('About us Setting'),'link'=>route('admin.setting.aboutUs_Popular_Destinations.index')],
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Edit About us Setting')}} </h4>
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
                            <form action="{{ route('admin.setting.aboutUs_Popular_Destinations.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Popular Destinations for trip_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="section_four_title_one[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('section_four_title_one.'.$key) ?? setting('section_four_title_one',$key)}}" />
                                                @error('section_four_title_one.'.$key)
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
                                          {{\App\Helpers\TranslationHelper::translate('Popular Destinations for trip_title_description in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <textarea name="section_four_description_one[{{ $key}}]"
                                                class="form-control form-control-solid content_textarea full-editor" id="{{$key}}">{{ old('section_four_description_one.'.$key) ?? setting('section_four_description_one',$key)}}</textarea>
                                              @error('section_four_description_one.'.$key)
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                           </span>
                                            @enderror
                                             </div>
                                            @endforeach
                                            </div>
                                            {{-- stare --}}

                                             <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Weekend_Wonders_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Weekend_Wonders_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Weekend_Wonders_title.'.$key) ?? setting('Weekend_Wonders_title',$key)}}" />
                                                @error('Weekend_Wonders_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Weekend_Wonders_nember in')}} English
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" name="Weekend_Wonders_nember[en]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Weekend_Wonders_nember.en') ?? setting('Weekend_Wonders_nember','en')}}" />
                                                @error('Weekend_Wonders_nember.en')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                     <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Weekend_Wonders_image in')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="Weekend_Wonders_image" class="form-control form-control-solid" />
                                                <img src="{{ setting('Weekend_Wonders_image', 'en') }}" width="100" class="mt-2" />
                                                @error('Weekend_Wonders_image.en')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                              {{-- <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Weekend_Wonders_image')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="Weekend_Wonders_image" class="form-control form-control-solid" />
                                                @if (setting('Weekend_Wonders_image'))
                                                    <img src="{{ setting('Weekend_Wonders_image') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('Weekend_Wonders_image')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}

                                        {{-- --}}
                                         <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Eco_Tours_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Eco_Tours_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Eco_Tours_title.'.$key) ?? setting('Eco_Tours_title',$key)}}" />
                                                @error('Eco_Tours_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
 

                                                 
                                    

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Eco_Tours_nember in')}} English
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" name="Eco_Tours_nember[en]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Eco_Tours_nember.en') ?? setting('Eco_Tours_nember','en')}}" />
                                                @error('Eco_Tours_nember.en')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                            
                                    
                                              {{-- <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Eco_Tours_image')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="Eco_Tours_image" class="form-control form-control-solid" />
                                                @if (setting('Eco_Tours_image', 'en'))
                                                    <img src="{{ setting('Eco_Tours_image', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('Eco_Tours_image')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{--  --}}
                                     <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Beach_Tour_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Beach_Tour_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Beach_Tour_title.'.$key) ?? setting('Beach_Tour_title',$key)}}" />
                                                @error('Beach_Tour_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                     <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Beach_Tour_nember in')}} English
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" name="Beach_Tour_nember[en]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Beach_Tour_nember.en') ?? setting('Beach_Tour_nember','en')}}" />
                                                @error('Beach_Tour_nember.en')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    

                                   
                                            
{{--                                     
                                              <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Beach_Tour_image')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="Beach_Tour_image" class="form-control form-control-solid" />
                                                @if (setting('Beach_Tour_image', 'en'))
                                                    <img src="{{ setting('Beach_Tour_image', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('Beach_Tour_image')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{--  --}}
                                     <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Heritage_Tours_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Heritage_Tours_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Heritage_Tours_title.'.$key) ?? setting('Heritage_Tours_title',$key)}}" />
                                                @error('Heritage_Tours_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                     <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Heritage_Tours_nember in')}} English
                                                    <span class="text-danger">*</span></label>
                                                <input type="number" name="Heritage_Tours_nember[en]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Heritage_Tours_nember.en') ?? setting('Heritage_Tours_nember','en')}}" />
                                                @error('Heritage_Tours_nember.en')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                   
                                            
                                    
                                              {{-- <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Heritage_Tours_image')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="Heritage_Tours_image" class="form-control form-control-solid" />
                                                @if (setting('Heritage_Tours_image', 'en'))
                                                    <img src="{{ setting('Heritage_Tours_image', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('Heritage_Tours_image')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}

                                   

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
