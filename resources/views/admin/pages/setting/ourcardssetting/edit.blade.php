@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('setting ourcards setting'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('setting ourcards setting'),'link'=>route('admin.setting.ourcardssetting.index')],
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Edit ourcards setting')}} </h4>
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
                            <form action="{{ route('admin.setting.ourcardssetting.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                
                                <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('title_regular_user_cards')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="title_regular_user_cards[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('title_regular_user_cards.'.$key) ?? setting('title_regular_user_cards',$key)}}" />
                                                @error('title_regular_user_cards.'.$key)
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
                                          {{\App\Helpers\TranslationHelper::translate('description_regular_user_cards in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <textarea name="description_regular_user_cards[{{ $key}}]"
                                                class="form-control form-control-solid content_textarea full-editor" id="{{$key}}">{{ old('description_regular_user_cards.'.$key) ?? setting('description_regular_user_cards',$key)}}</textarea>
                                              @error('description_regular_user_cards.'.$key)
                                        <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                           </span>
                                            @enderror
                                             </div>
                                            @endforeach
                                            </div>

                                            
                                            {{--  --}}
                                            <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('title_royal_cards')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="title_royal_cards[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('title_royal_cards.'.$key) ?? setting('title_royal_cards',$key)}}" />
                                                @error('title_royal_cards.'.$key)
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
                                          {{\App\Helpers\TranslationHelper::translate('description_royal_cards in')}} {{__('methods.' . $lang)}}:
                                              </label>
                                            <textarea name="description_royal_cards[{{ $key}}]"
                                                class="form-control form-control-solid content_textarea full-editor" id="{{$key}}">{{ old('description_royal_cards.'.$key) ?? setting('description_royal_cards',$key)}}</textarea>
                                              @error('description_royal_cards.'.$key)
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
                {{\App\Helpers\TranslationHelper::translate('description_royal_cards in')}} {{__('methods.' . $lang)}}:
            </label>
            <textarea name="description_royal_cards[{{ $key }}]"
                class="form-control form-control-solid content_textarea full-editor editor-royal"
                id="royal_{{$key}}">
                {{ old('description_royal_cards.'.$key) ?? setting('description_royal_cards', $key) }}
            </textarea>
            @error('description_royal_cards.'.$key)
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endforeach
</div>


                                            {{--  --}}
                                            <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('title_imperial_cards')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="title_imperial_cards[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('title_imperial_cards.'.$key) ?? setting('title_imperial_cards',$key)}}" />
                                                @error('title_imperial_cards.'.$key)
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
                {{ \App\Helpers\TranslationHelper::translate('description_imperial_cards in') }} {{ __('methods.' . $lang) }}:
            </label>
            <textarea name="description_imperial_cards[{{ $key }}]"
                class="form-control form-control-solid content_textarea full-editor editor-imperial"
                id="imperial_{{ $key }}">
                {{ old('description_imperial_cards.' . $key) ?? setting('description_imperial_cards', $key) }}
            </textarea>
            @error('description_imperial_cards.' . $key)
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endforeach
</div>


{{--                                             
                                      <div class="row px-0 mt-3">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('image_one_home')}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file" name="image_one_home" class="form-control form-control-solid" />
                                                @if (setting('image_one_home', 'en'))
                                                    <img src="{{ setting('image_one_home', 'en') }}" width="100" class="mt-2" />
                                                @endif
                                                @error('image_one_home')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
 --}}

                                    
                                    
             

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
