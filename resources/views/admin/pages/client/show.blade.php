@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Client Details'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('Clients'),'link'=>route('admin.client.index')],
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Client Details')}}</h4>

                                </div>
{{--                                @if( auth()->user()->id == 1 || auth()->user()->can('Region Edit'))--}}
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-right">
                                        <a class="btn btn-primary text-center" style="margin-left: 25px"
                                           href="{{route('admin.client.edit', $client->id)}}">
                                            <span>{{\App\Helpers\TranslationHelper::translate('Edit')}}</span> &nbsp;
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
{{--                                @endif--}}
                            </div>



                            <div class="row px-0 mt-3">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('Name')}}
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{ $client->name }}
                                            </div>
                                        </div>
                                    </div>
                            </div>

                                  <div class="row px-0 mt-3">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                                {{\App\Helpers\TranslationHelper::translate('code for client')}}
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                                {{ $client->code_for_client }}
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            

                               <!-- Phone Section -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('Phone') }}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                {{ $client->phone }}
            </div>
        </div>
    </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('Points') }}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                {{-- {{ $client->points }} --}}
                {{ $client->points ?? 'null' }} 
            </div>
        </div>
    </div>

    
      <!-- Card Section -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                 {{ \App\Helpers\TranslationHelper::translate('ID Number') }}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                {{ $client->card }}
            </div>
        </div>
    </div> 


    <!-- Username Section -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('Username') }}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                {{ $client->username }}
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
    <div class="row">
        <!-- عرض المدينة -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
            {{ \App\Helpers\TranslationHelper::translate('City') }}
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
            {{ $client->city->name ?? '-' }} 
        </div>
    </div>

    <div class="row">
        <!-- عرض المنطقة -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
            {{ \App\Helpers\TranslationHelper::translate('Region') }}
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
            {{ $client->region->name ?? '-'  }} 
        </div>
    </div>

      <div class="row">
        <!-- عرض المنطقة -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
            {{ \App\Helpers\TranslationHelper::translate('country') }}
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
            {{ $client->country->name ?? '-'  }} 
        </div>
    </div>
</div>



        <!-- Password Section -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('Password') }}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                {{ '********' }} <!-- Displaying password as masked for security -->
            </div>
        </div>
    </div>

       <!-- Category Section -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('Customer rating') }}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                {{ ucfirst($client->category) }} <!-- Displaying the category (gold, silver, bronze) -->
            </div>
        </div>
    </div>


        <!-- Is Banned Section -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('Is Banned') }}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                {{ $client->is_banned ? \App\Helpers\TranslationHelper::translate('Yes') : \App\Helpers\TranslationHelper::translate('No') }}
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-6 text-left details_item bold">
                {{ \App\Helpers\TranslationHelper::translate('is_active') }}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left details_item">
                {{ $client->is_active ? \App\Helpers\TranslationHelper::translate('Yes') : \App\Helpers\TranslationHelper::translate('No') }}
            </div>
        </div>
    </div>


                         <div class="row px-0 mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto text-left ">
                                    <div class="row">
                                        <div
                                            class="col-lg-3 col-md-3 col-sm-3 col-6  text-left details_item bold">
                                            {{\App\Helpers\TranslationHelper::translate('ID Card ')}} :
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6  text-left details_item ">
                                            <a href="{{ $client->getFirstMediaUrl('clients_image') }}" target="_blank">
                                                <img src="{{ $client->getFirstMediaUrl('clients_image') }}" class="w-100"
                                                     alt="test">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

</div>

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
