@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('index Setting'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('index Setting'),'link'=>route('admin.setting.Your_gateway_to_amazing_index.index')],
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
                            <form action="{{ route('admin.setting.Your_gateway_to_amazing_index.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                
                                <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Your_gateway_to_amazing_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Your_gateway_to_amazing_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Your_gateway_to_amazing_title.'.$key) ?? setting('Your_gateway_to_amazing_title',$key)}}" />
                                                @error('Your_gateway_to_amazing_title.'.$key)
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
                                          {{\App\Helpers\TranslationHelper::translate('We_have_been_operating_description_one in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <textarea name="We_have_been_operating_description_one[{{ $key}}]"
                                                class="form-control form-control-solid content_textarea full-editor" id="{{$key}}">{{ old('We_have_been_operating_description_one.'.$key) ?? setting('We_have_been_operating_description_one',$key)}}</textarea>
                                              @error('We_have_been_operating_description_one.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Food_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Food_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Food_title.'.$key) ?? setting('Food_title',$key)}}" />
                                                @error('Food_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('food_image_one')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="food_image_one" class="form-control form-control-solid" />
                                                @if (setting('food_image_one', 'en'))
                                                    <img src="{{ setting('food_image_one', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('food_image_one')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ******************* --}}

                                     <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Visa_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Visa_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Visa_title.'.$key) ?? setting('Visa_title',$key)}}" />
                                                @error('Visa_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('visa_image_two')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="visa_image_tow" class="form-control form-control-solid" />
                                                @if (setting('visa_image_tow', 'en'))
                                                    <img src="{{ setting('visa_image_tow', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('visa_image_tow')
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Historical_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Historical_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Historical_title.'.$key) ?? setting('Historical_title',$key)}}" />
                                                @error('Historical_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Historical_image_three')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="Historical_image_three" class="form-control form-control-solid" />
                                                @if (setting('Historical_image_three', 'en'))
                                                    <img src="{{ setting('Historical_image_three', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('Historical_image_three')
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Beach_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Beach_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Beach_title.'.$key) ?? setting('Beach_title',$key)}}" />
                                                @error('Beach_title.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Beach_image_four')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="Beach_image_four" class="form-control form-control-solid" />
                                                @if (setting('Beach_image_four', 'en'))
                                                    <img src="{{ setting('Beach_image_four', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('Beach_image_four')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
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
