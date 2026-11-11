@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Edit General Settings'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('General Settings'),'link'=>route('admin.setting.main.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Edit')]
        ]" :button="[]">
    </x-bread-crumb>
@endsection
@section('content')


    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container " class="container-xxl" style="">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-0">

                        <!--begin::Card body-->

                        <div class="card-body py-0 px-0">

                           
                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Edit General Settings')}}</h4>
                                </div>
                            </div>
                          

                            <form action="{{ route('admin.setting.main.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row px-0 mt-3">

                                    @foreach (Config('language') as $key => $lang)
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Title')}} (1) - {{$lang}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" name="title_one[{{$key}}]"
                                                       value="{{setting('title_one', $key)??old('title_one_'.$key)}}"
                                                       class="form-control {{$errors->has('title_one_'.$key)? 'is-invalid':''}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Title')}}(1) - {{$lang}}"/>
                                                <span
                                                    class="form-text text-danger">{{$errors->has('title_one_'.$key) ? $errors->first("title_one_".$key):''}}</span>
                                            </div>
                                        </div>
                                    @endforeach


                                    @foreach (Config('language') as $key => $lang)
                                        <div class="col-md-12 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Address')}} (1) - {{$lang}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" name="Address[{{$key}}]"
                                                       value="{{setting('Address', $key)??old('Address_'.$key)}}"
                                                       class="form-control {{$errors->has('Address_'.$key)? 'is-invalid':''}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Address')}}(1) - {{$lang}}"/>
                                                <span
                                                    class="form-text text-danger">{{$errors->has('Address_'.$key) ? $errors->first("Address_".$key):''}}</span>
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach (Config('language') as $key => $lang)
                                        <div class="col-md-12 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('It is long established')}} (1) - {{$lang}}
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" name="long_established[{{$key}}]"
                                                       value="{{setting('long_established', $key)??old('long_established_'.$key)}}"
                                                       class="form-control {{$errors->has('long_established_'.$key)? 'is-invalid':''}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('long_established')}}(1) - {{$lang}}"/>
                                                <span
                                                    class="form-text text-danger">{{$errors->has('long_established_'.$key) ? $errors->first("long_established_".$key):''}}</span>
                                            </div>
                                        </div>
                                    @endforeach


                                 

{{-- 
                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Title')}} (2)
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="title_two[en]"
                                                   value="{{setting('title_two', 'en')??old('title_two')}}"
                                                   class="form-control {{$errors->has('title_two')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Title')}}(2)"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('title_two') ? $errors->first("title_two"):''}}</span>
                                        </div>
                                    </div> --}}
                                    
                                    {{-- <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Title')}} (3)
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="title_three[en]"
                                                   value="{{setting('title_three', 'en')??old('title_three')}}"
                                                   class="form-control {{$errors->has('title_three')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Title')}}(3)"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('title_three') ? $errors->first("title_three"):''}}</span>
                                        </div>
                                    </div> --}}
                                    @foreach (Config('language') as $key => $lang)
                                        <div class="col-md-12 mb-4">
                                            <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('Short Description')}} - {{$lang}}
                                                    <span class="text-danger">*</span></label>
                                                <textarea name="short_desc[{{$key}}]"
                                                          class="form-control {{$errors->has('short_desc_'.$key)? 'is-invalid':''}}"
                                                          placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Short Description')}} - {{$lang}}">{{setting('short_desc', $key)??old('short_desc_'.$key)}}</textarea>
                                                <span
                                                    class="form-text text-danger">{{$errors->has('short_desc_'.$key) ? $errors->first("short_desc_".$key):''}}</span>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Video')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="file" name="video" class="form-control {{$errors->has('video')? 'is-invalid':''}}">
                                            @if (setting('video', 'en'))
                                                <video width="640" height="360" controls>
                                                    <source src="{{setting('video', 'en')}}" type="video/mp4">
                                                    {{\App\Helpers\TranslationHelper::translate('Your browser does not support the video tag.')}}
                                                </video>
                                            @endif
                                            <span
                                                class="form-text text-danger">{{$errors->has('video') ? $errors->first("video"):''}}</span>
                                        </div>
                                    </div> 

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('image Icon')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="file" name="image[en]" class="form-control {{$errors->has('image')? 'is-invalid':''}}">
                                            <span class="form-text text-danger">{{$errors->has('image') ? $errors->first("image"):''}}</span>
                                            @if(setting('image', 'en'))
                                                <img src="{{asset(setting('image', 'en'))}}" width="100px" style="border-radius: 5px">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Phone')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="number" name="phone[en]" id="phone"
                                                   value="{{setting('phone', 'en')??old('phone')}}"
                                                   class="form-control {{$errors->has('phone')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Phone')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('phone')? $errors->first("phone"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Whatsapp')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="number" name="whatsapp[en]"  id="whatsapp"
                                                   value="{{setting('whatsapp', 'en')??old('whatsapp')}}"
                                                   class="form-control {{$errors->has('whatsapp')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Whatsapp')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('whatsapp')? $errors->first("whatsapp                     "):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Email')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="email" name="email[en]"
                                                   value="{{setting('email', 'en')??old('email')}}"
                                                   class="form-control {{$errors->has('email')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Email')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('email')? $errors->first("email"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Facebook Url')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="url" name="facebook[en]"
                                                   value="{{setting('facebook', 'en')??old('facebook')}}"
                                                   class="form-control {{$errors->has('facebook')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Facebook Url')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('facebook')? $errors->first("facebook"):''}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Twitter Url')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="url" name="twitter[en]"
                                                   value="{{setting('twitter', 'en')??old('twitter')}}"
                                                   class="form-control {{$errors->has('twitter')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Twitter Url')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('twitter')? $errors->first("twitter"):''}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Linkedin Url')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="url" name="linkedin[en]"
                                                   value="{{setting('linkedin', 'en')??old('linkedin')}}"
                                                   class="form-control {{$errors->has('linkedin')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Linkedin Url')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('linkedin')? $errors->first("linkedin"):''}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Pinterest Url')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="url" name="pinterest[en]"
                                                   value="{{setting('pinterest', 'en')??old('pinterest')}}"
                                                   class="form-control {{$errors->has('pinterest')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Pinterest Url')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('pinterest')? $errors->first("pinterest"):''}}</span>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Instagram Url')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="url" name="instagram[en]"
                                                   value="{{setting('facebook', 'en')??old('instagram')}}"
                                                   class="form-control {{$errors->has('instagram')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Instagram Url')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('instagram')? $errors->first("instagram"):''}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Tiktok Url')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="url" name="tiktok[en]"
                                                   value="{{setting('tiktok', 'en')??old('tiktok')}}"
                                                   class="form-control {{$errors->has('tiktok')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Tiktok Url')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('tiktok')? $errors->first("tiktok"):''}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('Snapchat Url')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="url" name="snapchat[en]"
                                                   value="{{setting('snapchat', 'en')??old('snapchat')}}"
                                                   class="form-control {{$errors->has('snapchat')? 'is-invalid':''}}"
                                                   placeholder="{{\App\Helpers\TranslationHelper::translate('enter').' '.\App\Helpers\TranslationHelper::translate('Snapchat Url')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('snapchat')? $errors->first("snapchat"):''}}</span>
                                        </div>
                                    </div>



                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="bold">{{\App\Helpers\TranslationHelper::translate('logo')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="file" name="logo"
                                                   class="form-control {{$errors->has('logo')? 'is-invalid':''}}">
                                            <span
                                                class="form-text text-danger">{{$errors->has('logo')? $errors->first("logo"):''}}</span>
                                        </div>
                                        {{-- <div style="background: #1e1e2d">
                                            <img src="{{asset(setting('logo', 'en'))}}" alt="logo" style="width: 130px">
                                        </div> --}}
                                    </div>


                                </div>
                                <div class="mt-5 mb-6" style="text-align: {{app()->getLocale() == 'ar' ? 'left' : 'right'}}">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">{{\App\Helpers\TranslationHelper::translate('Update')}}</span>
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
    </div>

@stop
@section('script')
    <script>

    </script>
@stop
