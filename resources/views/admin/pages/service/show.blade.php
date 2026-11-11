@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Service Details'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('Service'),'link'=>route('admin.service.index')],
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
                    <div class="card-header border-0 pt-0">

                        <!--begin::Card body-->

                        <div class="card-body py-4 px-0" dir="{{Config::get('app.locale') == 'en' ? 'ltr' : 'rtl'}}">

                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Service Details')}}</h4>

                                </div>
                                {{--                                @if( auth()->user()->id == 1 || auth()->user()->can('Region Edit'))--}}
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-end">
                                    <a class="btn btn-primary text-center" style="margin-left: 25px"
                                       href="{{route('admin.service.edit', $service->id)}}">
                                        <span>{{\App\Helpers\TranslationHelper::translate('Edit')}}</span> &nbsp;
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                                {{--                                @endif--}}
                            </div>
                        </div>


                    </div>

                    <!--end::Card body-->
                </div>
                <!--begin::Card-->
                <div class="row mt-6">
                    <div class="col-lg-6 col-12">
                        <div class="row">
                            <div class="col-lg-12 col-12 mb-5">
                                <div class="card">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0 pt-0">

                                        <!--begin::Card body-->

                                        <div class="card-body py-4 px-0" dir="{{Config::get('app.locale') == 'en' ? 'ltr' : 'rtl'}}">


                                            <div class="row px-0 mt-3">

                                                @foreach (Config('language') as $key => $lang)
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-4 col-md-4 col-sm-4 col-6  text-left details_item bold">
                                                                {{\App\Helpers\TranslationHelper::translate('Name in')}}  {{__('methods.' . $lang)}}
                                                                :
                                                            </div>
                                                            <div
                                                                class="col-lg-8 col-md-8 col-sm-8 col-6  text-left details_item ">
                                                                {{$service->getTranslation('name',$key)}}
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            </div>
                                            <div class="row px-0 mt-3">

                                                @foreach (Config('language') as $key => $lang)
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-4 col-md-4 col-sm-4 col-6  text-left details_item bold">
                                                                {{\App\Helpers\TranslationHelper::translate('Description in')}}  {{__('methods.' . $lang)}}
                                                                :
                                                            </div>
                                                            <div
                                                                class="col-lg-8 col-md-8 col-sm-8 col-6  text-left details_item ">
                                                                {{$service->getTranslation('description',$key)}}
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            </div>
                                            <div class="row px-0 mt-3">

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-4 col-md-4 col-sm-4 col-6  text-left details_item bold">
                                                            {{\App\Helpers\TranslationHelper::translate('Main Category')}}
                                                            :
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-6  text-left details_item ">
                                                            {{$service->category->name}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-4 col-md-4 col-sm-4 col-6  text-left details_item bold">
                                                            {{\App\Helpers\TranslationHelper::translate('Sub Category')}}
                                                            :
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-6  text-left details_item ">
                                                            {{$service->subCategory->name}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row px-0 mt-3">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-4 col-md-4 col-sm-4 col-6  text-left details_item bold">
                                                            {{\App\Helpers\TranslationHelper::translate('Image')}} :
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-6  text-left details_item ">
                                                            <a href="{{ $service->getFirstMediaUrl('services') }}"
                                                               target="_blank">
                                                                <img src="{{ $service->getFirstMediaUrl('services') }}" class=""
                                                                     style="width: 80px"
                                                                     alt="test">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <!--end::Card body-->
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 mb-5">

                                <div class="card">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0 pt-10 pb-5 align-items-center" style="min-height: auto">
                                        <h4>
                                            {{\App\Helpers\TranslationHelper::translate('Client')}} {{\App\Helpers\TranslationHelper::translate('Custom Fields')}}
                                        </h4>
                                    </div>

                                    <!--begin::Card body-->

                                    <div class="card-body py-0 px-10" dir="{{Config::get('app.locale') == 'en' ? 'ltr' : 'rtl'}}">
                                        @if($service->client_group_id == null)
                                            @if($service->clientFields->count() > 0)
                                                <div class="row px-0 mt-3">
                                                    @foreach($service->clientFields as $k => $field)
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                            <div class="row">
                                                                <div
                                                                    class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                                    {{\App\Helpers\TranslationHelper::translate('Field')}}
                                                                    ({{$k + 1}})
                                                                    :
                                                                </div>
                                                                <div
                                                                    class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                                    @foreach (Config('language') as $key => $lang)
                                                                        {{$field->getTranslation('name',$key)}} {{$key == 'en' ? '-' : ''}}
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @else
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                        {{\App\Helpers\TranslationHelper::translate('Group')}}
                                                        :
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                        {{$service->group->name}}
                                                    </div>
                                                </div>
                                            </div>
                                            @if($service->client_full_group == 1)
                                                <div class="row px-0 mt-3">
                                                    @foreach($service->clientGroup->fields as $k => $field)
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                            <div class="row">
                                                                <div
                                                                    class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                                    {{\App\Helpers\TranslationHelper::translate('Field')}}
                                                                    ({{$k + 1}})
                                                                    :
                                                                </div>
                                                                <div
                                                                    class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                                    @foreach (Config('language') as $key => $lang)
                                                                        {{$field->getTranslation('name',$key)}} {{$key == 'en' ? '-' : ''}}
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="row px-0 mt-3">
                                                    @foreach($service->clientFields as $k => $field)
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                            <div class="row">
                                                                <div
                                                                    class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                                    {{\App\Helpers\TranslationHelper::translate('Field')}}
                                                                    ({{$k + 1}})
                                                                    :
                                                                </div>
                                                                <div
                                                                    class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                                    @foreach (Config('language') as $key => $lang)
                                                                        {{$field->getTranslation('name',$key)}} {{$key == 'en' ? '-' : ''}}
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endif
                                    </div>


                                    <!--end::Card body-->
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">

                        <div class="card">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-10 pb-5 align-items-center" style="min-height: auto">
                                <h4>
                                    {{\App\Helpers\TranslationHelper::translate('Provider')}} {{\App\Helpers\TranslationHelper::translate('Custom Fields')}}
                                </h4>
                            </div>

                            <!--begin::Card body-->

                            <div class="card-body py-0 px-10" dir="{{Config::get('app.locale') == 'en' ? 'ltr' : 'rtl'}}">
                                @if($service->group_id == null)
                                    @if($service->fields->count() > 0)
                                        <div class="row px-0 mt-3">
                                            @foreach($service->fields as $k => $field)
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                            {{\App\Helpers\TranslationHelper::translate('Field')}}
                                                            ({{$k + 1}})
                                                            :
                                                        </div>
                                                        <div
                                                            class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                            @foreach (Config('language') as $key => $lang)
                                                                {{$field->getTranslation('name',$key)}} {{$key == 'en' ? '-' : ''}}
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Group')}}
                                                :
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{$service->group->name}}
                                            </div>
                                        </div>
                                    </div>
                                    @if($service->full_group == 1)
                                        <div class="row px-0 mt-3">
                                            @foreach($service->group->fields as $k => $field)
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                            {{\App\Helpers\TranslationHelper::translate('Field')}}
                                                            ({{$k + 1}})
                                                            :
                                                        </div>
                                                        <div
                                                            class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                            @foreach (Config('language') as $key => $lang)
                                                                {{$field->getTranslation('name',$key)}} {{$key == 'en' ? '-' : ''}}
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="row px-0 mt-3">
                                            @foreach($service->fields as $k => $field)
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                            {{\App\Helpers\TranslationHelper::translate('Field')}}
                                                            ({{$k + 1}})
                                                            :
                                                        </div>
                                                        <div
                                                            class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                            @foreach (Config('language') as $key => $lang)
                                                                {{$field->getTranslation('name',$key)}} {{$key == 'en' ? '-' : ''}}
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                            </div>


                            <!--end::Card body-->
                        </div>

                    </div>

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
