@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">

@endpush

@if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Product'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Product'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Products'), 'link' => route('admin.product.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Product'), 'link' => route('admin.product.index')]">
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
                            <!--begin::Form-->
                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($method == 'PUT')
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$product->id}}">

                            @endif
                            <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('name.'.$key) ?? $product->getTranslation('name',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('Name in')}} {{__('methods.' . $lang)}}"
                                                       name="name[{{ $key}}]"/>
                                                @error('name.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                              @endforeach




 


                                @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('Description in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                    
                                                <textarea class="form-control form-control-solid" rows="4"
                                                          placeholder="{{\App\Helpers\TranslationHelper::translate('Description in')}} {{__('methods.' . $lang)}}"
                                                          name="description[{{ $key}}]">{{ old('description.'.$key) ?? $product->getTranslation('description',$key)}}</textarea>
                                                @error('description.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach

          

                                         <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Choose Category') }} :
        <span class="text-danger">*</span>
    </label>
    <select name="productcategory_id" id="productcategory_id" class="form-control form-control-solid">
        <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Category') }}</option>
        @foreach($productcategories as $category)  
            <option value="{{ $category->id }}" 
                    {{ old('productcategory_id', isset($product->productcategory_id) ? $product->productcategory_id : null) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('productcategory_id')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

                                        

                                        {{-- <div class="col-6  mb-5">
                                            <!--begin::Label-->
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{\App\Helpers\TranslationHelper::translate('Image')}}
                                                : <span
                                                    class="text-danger"> {{\App\Helpers\TranslationHelper::translate('Size')}} <span
                                                        dir="ltr">400 x 400</span></span></label>
                                            <!--end::Label-->
                                            <input type="file" class="form-control form-control-solid" name="image"/>
                                            @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            @if($product->getFirstMediaUrl('products') != null)
                                                <img src="{{ $product->getFirstMediaUrl('products') }}"
                                                     alt="products" width="100px"
                                                     style="border-radius: 5px">
                                            @endif
                                        </div> --}}

   
 {{-- <div class="col-6 mb-5">
    <!--begin::Label-->
    <label class="fs-5 fw-bold form-label mb-5">
        {{\App\Helpers\TranslationHelper::translate('Image')}}:
        <span class="text-danger">
            {{\App\Helpers\TranslationHelper::translate('Size')}} <span dir="ltr">400 x 400</span>
        </span>
    </label>
    <!--end::Label-->
    <input type="file" class="form-control form-control-solid" name="images[]" multiple/>
    @error('images')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    @foreach($product->getMedia('products') as $media)
        <img src="{{ $media->getUrl() }}" alt="products" width="100px" style="border-radius: 5px"/>
    @endforeach
</div> --}}

<div class="col-6 mb-5">
    <!-- Label -->
    <label class="fs-5 fw-bold form-label mb-5">
        {{\App\Helpers\TranslationHelper::translate('Image')}}:
        <span class="text-danger">
            {{\App\Helpers\TranslationHelper::translate('Size')}} <span dir="ltr">400 x 400</span>
        </span>
    </label>

    <!-- رفع صور جديدة -->
    <input type="file" class="form-control form-control-solid" name="images[]" multiple />
    @error('images')
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ \App\Helpers\TranslationHelper::translate("Error") }}',
                text: '{{ $message }}',
            });
        </script>
    @enderror

    <!-- عرض الصور -->
    <div class="mt-3">
        <label class="fs-6 fw-bold">
            {{\App\Helpers\TranslationHelper::translate('Uploaded Images')}}:
        </label>
        <div class="row mt-2">
            @foreach($product->getMedia('products') as $media)
                <div class="col-md-3 col-sm-4 col-6 mb-3 text-center">
                    <a href="{{ $media->getUrl() }}" target="_blank">
                        <img src="{{ $media->getUrl() }}" 
                             alt="product" 
                             class="img-fluid img-thumbnail" 
                             style="width: 150px; height: 150px; object-fit: contain;">
                    </a>
                    <!-- زر حذف الصورة -->
                    <button type="button" class="btn btn-danger btn-sm mt-2 delete-image-btn" data-url="{{ route('admin.product.media.delete', $media->id) }}">
                        {{ \App\Helpers\TranslationHelper::translate('Delete') }}
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>
                                    
                                                                            </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mb-5">
                                        <span
                                            class="indicator-label">{{ \App\Helpers\TranslationHelper::translate('Save') }}</span>
                                    </button>
                                </div>
                                <!--end::Actions-->
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


<script src="{{asset('dashboard/assets/js/tags-input.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


<script>
$(document).ready(function() {
    console.log("Document is ready");
    $('#productcategory_id').select2({
        placeholder: "{{ \App\Helpers\TranslationHelper::translate('Choose Category') }}",
        allowClear: true
    });
});

</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-image-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault(); // منع إعادة تحميل الصفحة

                const url = this.dataset.url;

                // إظهار نافذة التأكيد
                Swal.fire({
                    title: '{{ \App\Helpers\TranslationHelper::translate("Are you sure?") }}',
                    text: '{{ \App\Helpers\TranslationHelper::translate("This action cannot be undone.") }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '{{ \App\Helpers\TranslationHelper::translate("Yes, delete it!") }}',
                    cancelButtonText: '{{ \App\Helpers\TranslationHelper::translate("Cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // تنفيذ طلب الحذف باستخدام fetch API
                        fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        }).then(response => {
                            if (response.ok) {
                                // إظهار رسالة نجاح
                                Swal.fire(
                                    '{{ \App\Helpers\TranslationHelper::translate("Deleted!") }}',
                                    '{{ \App\Helpers\TranslationHelper::translate("Your image has been deleted.") }}',
                                    'success'
                                ).then(() => {
                                    location.reload(); // تحديث الصفحة بعد الحذف
                                });
                            } else {
                                Swal.fire(
                                    '{{ \App\Helpers\TranslationHelper::translate("Error!") }}',
                                    '{{ \App\Helpers\TranslationHelper::translate("Unable to delete the image.") }}',
                                    'error'
                                );
                            }
                        }).catch(error => {
                            Swal.fire(
                                '{{ \App\Helpers\TranslationHelper::translate("Error!") }}',
                                '{{ \App\Helpers\TranslationHelper::translate("Something went wrong.") }}',
                                'error'
                            );
                        });
                    }
                });
            });
        });
    });
</script>
@endpush

