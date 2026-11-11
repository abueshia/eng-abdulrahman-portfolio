@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Trip Details Bestseller'))
@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text'=>\App\Helpers\TranslationHelper::translate('Trip Details Bestseller'),'link'=>route('admin.setting.trip_bestseller.index')],
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
                                    <h4 class="d-inline-block  py-3">{{\App\Helpers\TranslationHelper::translate('Edit Trip Details Bestseller')}} </h4>
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
                            <form action="{{ route('admin.setting.trip_bestseller.update') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                
                                <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('name_Bestseller')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="name_Bestseller[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('name_Bestseller.'.$key) ?? setting('name_Bestseller',$key)}}" />
                                                @error('name_Bestseller.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    {{--  --}}
                                       <div class="row px-0 mt-3">
                                    @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('name_Adults')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="name_Adults[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('name_Adults.'.$key) ?? setting('name_Adults',$key)}}" />
                                                @error('name_Adults.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('name_Children')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="name_Children[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('name_Children.'.$key) ?? setting('name_Children',$key)}}" />
                                                @error('name_Children.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('name_Infants')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="name_Infants[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('name_Infants.'.$key) ?? setting('name_Infants',$key)}}" />
                                                @error('name_Infants.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('name_Book_Now')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="name_Book_Now[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('name_Book_Now.'.$key) ?? setting('name_Book_Now',$key)}}" />
                                                @error('name_Book_Now.'.$key)
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
                                                <label class="bold">{{\App\Helpers\TranslationHelper::translate('name_Add_to_Wishlist')}}
                                                    <span class="text-danger">*</span> {{__('methods.' . $lang)}}</label>
                                                <input type="text" name="name_Add_to_Wishlist[{{ $key}}]"
                                                       class="form-control form-control-solid"
                                                       value="{{ old('name_Add_to_Wishlist.'.$key) ?? setting('name_Add_to_Wishlist',$key)}}" />
                                                @error('name_Add_to_Wishlist.'.$key)
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
