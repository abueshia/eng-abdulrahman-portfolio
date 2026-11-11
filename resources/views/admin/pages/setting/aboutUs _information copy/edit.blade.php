@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('About us Setting'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('About us Setting'),'link'=>route('admin.setting.aboutUs_information.index')],
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
                            <form action="{{ route('admin.setting.aboutUs_information.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Explorer title in')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Explorer_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Explorer_title.'.$key) ?? setting('Explorer_title',$key)}}" />
                                                @error('Explorer_title.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('explorer number')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="number" name="explorer_number[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('explorer_number.'.$key) ?? setting('explorer_number',$key)}}" />
                                                @error('explorer_number.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('explorer image')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="explorer_image" class="form-control form-control-solid" />
                                                @if (setting('explorer_image', 'en'))
                                                    <img src="{{ setting('explorer_image', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('explorer_image')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                        
                                    {{-- ************************************* --}}
                                      <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Winning award title in')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Winning_award_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Winning_award_title.'.$key) ?? setting('Winning_award_title',$key)}}" />
                                                @error('Winning_award_title.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Winning award number')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="number" name="Winning_award_number[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Winning_award_number.'.$key) ?? setting('Winning_award_number',$key)}}" />
                                                @error('Winning_award_number.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Winning award image')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="Winning_award_image" class="form-control form-control-solid" />
                                                @if(setting('Winning_award_image', 'en'))
                                                    <img src="{{ setting('Winning_award_image', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('Winning_award_image')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                     {{-- ************************************* --}}

                                      <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Complete project title in')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Complete_project_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Complete_project_title.'.$key) ?? setting('Complete_project_title',$key)}}" />
                                                @error('Complete_project_title.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Complete project number')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="number" name="Complete_project_number[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Complete_project_number.'.$key) ?? setting('Complete_project_number',$key)}}" />
                                                @error('Complete_project_number.'.$key)
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
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Complete project image')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="file" name="Complete_project_image" class="form-control form-control-solid" />
                                            <img src="{{ setting('Complete_project_image', 'en') != null ? setting('Complete_project_image', 'en') : asset('assets/admin/img/placeholder.png') }}" width="100" class="mt-2" />
                                            @error('Complete_project_image')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                    {{-- ************************************* --}}
                                     
                                     <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Client review title in')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Client_review_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Client_review_title.'.$key) ?? setting('Client_review_title',$key)}}" />
                                                @error('Client_review_title.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Client review number')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="number" name="Client_review_number[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Client_review_number.'.$key) ?? setting('Client_review_number',$key)}}" />
                                                @error('Client_review_number.'.$key)
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
                                                    <label class="bold">{{\App\Helpers\TranslationHelper::translate('Client review image')}}
                                                        <span class="text-danger">*</span></label>
                                                    <input type="file" name="Client_review_image"
                                                           class="form-control form-control-solid {{$errors->has('Client_review_image')? 'is-invalid':''}}" />
                                                    @error('Client_review_image')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    @if (setting('Client_review_image'))
                                                        <img src="{{ url(setting('Client_review_image')) }}" class="img-fluid" style="width: 150px" alt="test">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                          <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Our_Latest_travel_articls_title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Our_Latest_travel_articls_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('section_one_title_one.'.$key) ?? setting('Our_Latest_travel_articls_title',$key)}}" />
                                                @error('Our_Latest_travel_articls_title.'.$key)
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
                                          {{\App\Helpers\TranslationHelper::translate('Our_Latest_travel_articls_description in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <textarea name="Our_Latest_travel_articls_description[{{ $key}}]"
                                                class="form-control form-control-solid content_textarea full-editor" id="{{$key}}">{{ old('Our_Latest_travel_articls_description.'.$key) ?? setting('Our_Latest_travel_articls_description',$key)}}</textarea>
                                              @error('Our_Latest_travel_articls_description.'.$key)
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                           </span>
                                            @enderror
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
