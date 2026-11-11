@extends('admin.layouts.app')

@if($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Card'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Card'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Card'),'link'=>route('admin.card.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]" :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to Card'),'link'=>route('admin.card.index')]">
    </x-bread-crumb>
@endsection

@section('content')

    <!--begin::Content-->
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
                        <div class="card-body pt-0">
                           

                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'PUT')
        @method('PUT')
        <input type="hidden" name="id" value="{{ $card->id }}">
    @endif

    <div class="fv-row mb-10">
        <div class="row">

                     @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('title in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('title.'.$key) ?? $card->getTranslation('title',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('title in')}} {{__('methods.' . $lang)}}"
                                                       name="title[{{ $key}}]"/>
                                                @error('title.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach

                                                 <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bold form-label mb-5">
                                                {{ \App\Helpers\TranslationHelper::translate('Category') }}
                                                :
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select form-select-solid" name="category_id">
                                                <option
                                                    value="">{{ \App\Helpers\TranslationHelper::translate('Choose Category') }}</option>
                                                @foreach ($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}" {{ $card->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                                           <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bold form-label mb-5">
                                                {{ \App\Helpers\TranslationHelper::translate('category colid') }}
                                                :
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select form-select-solid" name="categorycolid_id">
                                                <option
                                                    value="">{{ \App\Helpers\TranslationHelper::translate('Choose category colid') }}</option>
                                                @foreach ($categorycolid as $categorycolid)
                                                    <option
                                                        value="{{ $categorycolid->id }}" {{ $card->categorycolid_id == $categorycolid->id ? 'selected' : '' }}>
                                                        {{ $categorycolid->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('categorycolid_id')
                                            <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


{{-- <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Category') }}:
    </label>
    <select class="form-select form-select-solid" name="category_id" id="category_id">
        <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Category') }}</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $card->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Category Colid') }}:
    </label>
    <select class="form-select form-select-solid" name="categorycolid_id" id="categorycolid_id">
        <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Category Colid') }}</option>
    </select>
    @error('categorycolid_id')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div> --}}


                                                       @foreach (Config('language') as $key => $lang)
    <div class="col-12 mb-5">
        <label class="fs-5 fw-bold form-label mb-5">
            {{ \App\Helpers\TranslationHelper::translate('Description in') }} {{ __('methods.' . $lang) }}
        </label>
        <textarea class="form-control form-control-solid full-editor" name="des[{{ $key }}]" rows="5" id="des{{$key}}"
                  style="height: 300px; direction: rtl;">{{ old('des.'.$key) ?? $card->getTranslation('des', $key) }}</textarea>
        @error('des.'.$key)
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
@endforeach


            <!-- رفع الصورة -->
            <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    {{ \App\Helpers\TranslationHelper::translate('Card Image') }}:
                    <span class="text-danger">
                        {{ \App\Helpers\TranslationHelper::translate('Size') }} <span dir="ltr">400 x 400</span>
                    </span>
                </label>

                <input type="file" class="form-control form-control-solid" name="image"/>
                @error('image')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                @if($card->getFirstMediaUrl('card'))
                    <div class="mt-4">
                        <h5>{{ \App\Helpers\TranslationHelper::translate('Existing Image') }}:</h5>
                        <div class="row">
                            <div class="col-6 mb-3" id="image-{{ $card->id }}">
                                <img src="{{ $card->getFirstMediaUrl('card') }}" alt="card image" width="100px" style="border-radius: 5px">
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- رفع الفيديو -->
            <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    {{ \App\Helpers\TranslationHelper::translate('Card Video') }}:
                </label>

                <input type="file" class="form-control form-control-solid" name="card_video" accept="video/*"/>
                @error('card_video')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                @if($card->getFirstMediaUrl('card_video'))
                    <div class="mt-4">
                        <h5>{{ \App\Helpers\TranslationHelper::translate('Existing Video') }}:</h5>
                        <video width="100%" controls>
                            <source src="{{ $card->getFirstMediaUrl('card_video') }}" type="video/mp4">
                            {{ \App\Helpers\TranslationHelper::translate('Your browser does not support the video tag.') }}
                        </video>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary mb-5">
            <span class="indicator-label">{{ \App\Helpers\TranslationHelper::translate('Save') }}</span>
        </button>
    </div>
</form>





                            <!--end::Form-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    </div>
    <!--end::Content-->

@endsection



@push('admin_js')
    <script src="{{asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    
    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>

    {{-- <script>
    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const categoryColidSelect = document.getElementById('categorycolid_id');

        // مسح الخيارات الحالية
        categoryColidSelect.innerHTML = '<option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Category Colid') }}</option>';

        if (categoryId) {
            // طلب AJAX للحصول على البيانات
             fetch(`/get-categorycolid/${categoryId}`)
                 .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.name;
                        categoryColidSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching category colid:', error);
                });
        }
    });
</script> --}}

@endpush
