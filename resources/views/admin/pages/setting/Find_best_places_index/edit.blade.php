@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('index Setting'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('index Setting'),'link'=>route('admin.setting.Find_best_places_index.index')],
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
                            <form action="{{ route('admin.setting.Find_best_places_index.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                
                                <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Find_best_places_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Find_best_places_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Find_best_places_title.'.$key) ?? setting('Find_best_places_title',$key)}}" />
                                                @error('Find_best_places_title.'.$key)
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
                                          {{\App\Helpers\TranslationHelper::translate('Whether_you’re_looking_description in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <textarea name="Whether_you’re_looking_description[{{ $key}}]"
                                                class="form-control form-control-solid content_textarea full-editor" id="{{$key}}">{{ old('Whether_you’re_looking_description.'.$key) ?? setting('Whether_you’re_looking_description',$key)}}</textarea>
                                              @error('Whether_you’re_looking_description.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('ourney_Beyond_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="ourney_Beyond_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('ourney_Beyond_title.'.$key) ?? setting('ourney_Beyond_title',$key)}}" />
                                                @error('ourney_Beyond_title.'.$key)
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
                                          {{\App\Helpers\TranslationHelper::translate('We_have_been_operating_description in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <textarea name="We_have_been_operating_description[{{ $key}}]"
                                                class="form-control form-control-solid content_textarea full-editor" id="Discover the World description_one_{{$key}}">{{ old('We_have_been_operating_description.'.$key) ?? setting('We_have_been_operating_description',$key)}}</textarea>
                                              @error('We_have_been_operating_description.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('ourney_Beyond_image')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="ourney_Beyond_image" class="form-control form-control-solid" />
                                                @if (setting('ourney_Beyond_image', 'en'))
                                                    <img src="{{ setting('ourney_Beyond_image', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('ourney_Beyond_image')
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
