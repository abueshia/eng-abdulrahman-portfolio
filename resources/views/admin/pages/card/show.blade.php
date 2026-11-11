@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Card Details'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('card'),'link'=>route('admin.card.index')],
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Card Details')}}</h4>

                                </div>
@if (auth()->guard('admin')->user()->can('card.edit', 'admin'))
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                        <a class="btn btn-primary text-center" style="margin-left: 25px"
                                           href="{{route('admin.card.edit', $card->id)}}">
                                            <span>{{\App\Helpers\TranslationHelper::translate('Edit')}}</span> &nbsp;
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                               @endif
                            </div>


              <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('title in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{$card->getTranslation('title',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('Category')}}
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            {{ $card->categories->name ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('category colid')}}
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            {{ $card->categorycolid->name ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                            
                            <div class="row px-0 mt-3">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('card in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {!! $card->getTranslation('des',$key) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


<div class="row px-0 mt-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('Images') }} :
            </div>


            <div class="col-lg-9 col-md-9 col-sm-9 col-12 text-left details_item">
    <div class="row">
        @if($card->getFirstMediaUrl('cards'))
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <a href="{{ $card->getFirstMediaUrl('cards') }}" target="_blank">
                    <img src="{{ $card->getFirstMediaUrl('cards') }}" 
                         alt="card image" 
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
</div> 

<div class="row px-0 mt-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('card Video') }} :
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-12 text-left details_item">
    <div class="row">
       @if($card->getFirstMediaUrl('cardscard_video'))
    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
        <video width="100%" height="150" controls>
            <source src="{{ $card->getFirstMediaUrl('cardscard_video') }}" type="video/mp4">
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
                                                {{$card->getTranslation('name',$key)}}
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
