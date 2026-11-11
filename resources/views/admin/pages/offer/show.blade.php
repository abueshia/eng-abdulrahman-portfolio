@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Offer Details'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('offers'),'link'=>route('admin.offer.index')],
        ['text'=> \App\Helpers\TranslationHelper::translate('Details')]
        ]" :button="[]">
    </x-bread-crumb>
@endsection
@section('content')


    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-body py-4 px-0" dir="{{Config::get('app.locale') == 'en' ? 'ltr' : 'rtl'}}">

                            <div class="row px-0 mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Offer Details')}}</h4>

                                </div>
@if (auth()->guard('admin')->user()->can('offer.edit', 'admin'))
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                        <a class="btn btn-primary text-center" style="margin-left: 25px"
                                           href="{{route('admin.offer.edit', $offer->id)}}">
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
                                                {{\App\Helpers\TranslationHelper::translate('Name in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{$offer->getTranslation('name',$key)}}
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
                                                class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('description in')}}  {{__('methods.' . $lang)}}:
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{$offer->getTranslation('description',$key)}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                   

                            <div class="row px-0 mt-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('Products') }} :
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                @if($offer->products->count() > 0)
                    <ul>
                        @foreach($offer->products as $product)
                            <li>{{ $product->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ \App\Helpers\TranslationHelper::translate('No products available') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="row px-0 mt-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('Branches') }} :
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                @if($offer->branches->count() > 0)
                    <ul>
                        @foreach($offer->branches as $branch)
                            <li>{{ $branch->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ \App\Helpers\TranslationHelper::translate('No branches available') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>


                   {{-- <div class="row px-0 mt-3">
                                 <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('Discount %')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                        %{{$offer->discount}}
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                                     <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('Point')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            {{$offer->point}}
                                        </div>
                                    </div>
                                </div>
                            </div>


<div class="row px-0 mt-3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('Voucher code') }} :
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                {{ $offer->discount_number }}
            </div>
        </div>
    </div>
</div>

                            




                             <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('Image')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            <a href="{{ $offer->getFirstMediaUrl('offers') }}" target="_blank">
                                                <img src="{{ $offer->getFirstMediaUrl('offers') }}" class="w-100"
                                                     alt="test">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop
@section('script')
    <script>

    </script>
@stop
