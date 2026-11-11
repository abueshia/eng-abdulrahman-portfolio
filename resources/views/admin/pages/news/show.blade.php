@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('News Details'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('news'),'link'=>route('admin.news.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Details')]
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

                        <div class="card-body py-4 px-0" dir="{{Config::get('app.locale') == 'en' ? 'ltr' : 'rtl'}}">

                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('News Details')}}</h4>

                                </div>
{{--                                @if( auth()->user()->id == 1 || auth()->user()->can('Region Edit'))--}}
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                        <a class="btn btn-primary text-center" style="margin-left: 25px"
                                           href="{{route('admin.news.edit', $news->id)}}">
                                            <span>{{\App\Helpers\TranslationHelper::translate('Edit')}}</span> &nbsp;
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
{{--                                @endif--}}
                            </div>


{{-- 
<div class="row px-0 mt-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('Images') }} :
            </div>


            <div class="col-lg-9 col-md-9 col-sm-9 col-12 text-left details_item">
    <div class="row">
        @if($news->getFirstMediaUrl('news'))
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <a href="{{ $news->getFirstMediaUrl('news') }}" target="_blank">
                    <img src="{{ $news->getFirstMediaUrl('news') }}" 
                         alt="news image" 
                         style="width: 100%; height: 150px; object-fit: contain; border-radius: 5px;">
                </a>
            </div>
        @else
            <div class="col-12">
                <p class="text-muted">{{ \App\Helpers\TranslationHelper::translate('No Image Available') }}</p>
            </div>
        @endif
    </div>
</div>

        </div>
    </div>
</div> --}}




<div class="row px-0 mt-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('news Video') }} :
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-12 text-left details_item">
    <div class="row">
       @if($news->getFirstMediaUrl('newsnews_video'))
    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
        <video width="100%" height="150" controls>
            <source src="{{ $news->getFirstMediaUrl('newsnews_video') }}" type="video/mp4">
            {{ \App\Helpers\TranslationHelper::translate('Your browser does not support the video tag.') }}
        </video>
    </div>
@else
    <div class="col-12">
        <p class="text-muted">{{ \App\Helpers\TranslationHelper::translate('No Video Available') }}</p>
    </div>
@endif

    </div>
</div>

        </div>
    </div>
</div>






                            {{-- <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Name in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{$news->getTranslation('name',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div> --}}

        


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
