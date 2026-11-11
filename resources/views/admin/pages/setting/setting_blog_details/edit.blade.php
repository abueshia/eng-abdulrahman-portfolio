@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('About us Setting'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('About us Setting'),'link'=>route('admin.setting.setting_blog_details.index')],
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
                            <form action="{{ route('admin.setting.setting_blog_details.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                
                                <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Leave Comment title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Leave_Comment_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Leave_Comment_title.'.$key) ?? setting('Leave_Comment_title',$key)}}" />
                                                @error('Leave_Comment_title.'.$key)
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
                                          {{\App\Helpers\TranslationHelper::translate('Why Choose Us description in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <textarea name="Your_email_address_description[{{ $key}}]"
                                                class="form-control form-control-solid content_textarea full-editor" id="{{$key}}">{{ old('Your_email_address_description.'.$key) ?? setting('Your_email_address_description',$key)}}</textarea>
                                              @error('Your_email_address_description.'.$key)
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                           </span>
                                            @enderror
                                             </div>
                                            @endforeach
                                            </div>
                                            {{-- ******************* --}}
                                              <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Search Here title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Search_Here_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Search_Here_title.'.$key) ?? setting('Search_Here_title',$key)}}" />
                                                @error('Search_Here_title.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Category title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Category_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Category_title.'.$key) ?? setting('Category_title',$key)}}" />
                                                @error('Category_title.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Recent blog title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Recent_blog_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Recent_blog_title.'.$key) ?? setting('Recent_blog_title',$key)}}" />
                                                @error('Recent_blog_title.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Popular Tag title')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="Popular_Tag_title[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('Popular_Tag_title.'.$key) ?? setting('Popular_Tag_title',$key)}}" />
                                                @error('Popular_Tag_title.'.$key)
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
