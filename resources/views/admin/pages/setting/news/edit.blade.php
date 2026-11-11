@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('setting news'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('setting news'),'link'=>route('admin.setting.news.index')],
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Edit news')}} </h4>
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
                            <form action="{{ route('admin.setting.news.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                
                                <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('title.'.$key) ?? setting('title',$key)}}" />
                                                @error('title.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('title_tow')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="title_tow[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('title_tow.'.$key) ?? setting('title_tow',$key)}}" />
                                                @error('title_tow.'.$key)
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
                                          {{\App\Helpers\TranslationHelper::translate('description in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <textarea name="description[{{ $key}}]"
                                                class="form-control form-control-solid content_textarea full-editor" id="{{$key}}">{{ old('description.'.$key) ?? setting('description',$key)}}</textarea>
                                              @error('description.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('image_one_news')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="image_one_news" class="form-control form-control-solid" />
                                                @if (setting('image_one_news', 'en'))
                                                    <img src="{{ setting('image_one_news', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('image_one_news')
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
            <label class="bold">{{ \App\Helpers\TranslationHelper::translate('image_one') }}
                <span class="text-danger">*</span>
            </label>
            <input type="file" name="image_one" class="form-control form-control-solid" />
            <img src="{{ setting('image_one', 'en') }}" width="100" class="mt-2" />
            @error('image_one')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div> --}}


                                     
                                     {{-- <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('image_tow')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="image_tow" class="form-control form-control-solid" />
                                                <img src="{{ setting('image_tow', 'en') }}" width="100" class="mt-2" />
                                                @error('image_tow')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}
                                    
                                          {{-- <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('image_tow')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="image_tow" class="form-control form-control-solid" />
                                                @if (setting('image_tow', 'en'))
                                                    <img src="{{ setting('image_tow', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('image_tow')
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
