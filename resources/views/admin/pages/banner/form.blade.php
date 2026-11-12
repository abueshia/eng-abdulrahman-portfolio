@extends('admin.layouts.app')

@if($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Banner'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Banner'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('Banners'),'link'=>route('admin.banner.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]" :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to Banners'),'link'=>route('admin.banner.index')]">
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
        <input type="hidden" name="id" value="{{ $banner->id }}">
    @endif

    <div class="fv-row mb-10">
        <div class="row">
            <!-- Title -->
            <div class="col-12 mb-5">
                <label class="fs-5 fw-bold form-label mb-2">عنوان المشروع / العمل</label>
                <input type="text" class="form-control form-control-solid" name="title" value="{{ old('title', $banner->title ?? '') }}" required />
                @error('title')
                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <!-- Description -->
            <div class="col-12 mb-5">
                <label class="fs-5 fw-bold form-label mb-2">وصف المشروع والتقنيات المستخدمة</label>
                <textarea class="form-control form-control-solid" name="description" rows="3" required>{{ old('description', $banner->description ?? '') }}</textarea>
                @error('description')
                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <!-- Before Image -->
            <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    صورة المشروع الأولى (أو قبل التطوير):
                </label>
                <input type="file" class="form-control form-control-solid" name="before_image"/>
                @error('before_image')
                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

                @if($banner->getFirstMediaUrl('before_image'))
                    <div class="mt-4">
                        <img src="{{ $banner->getFirstMediaUrl('before_image') }}" alt="before image" width="150px" style="border-radius: 5px">
                    </div>
                @endif
            </div>

            <!-- After Image -->
            <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    صورة المشروع الثانية (أو بعد التطوير):
                </label>
                <input type="file" class="form-control form-control-solid" name="after_image"/>
                @error('after_image')
                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

                @if($banner->getFirstMediaUrl('after_image'))
                    <div class="mt-4">
                        <img src="{{ $banner->getFirstMediaUrl('after_image') }}" alt="after image" width="150px" style="border-radius: 5px">
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

    {{-- <script>
function deleteImage(imageId) {
    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: 'لن تتمكن من استعادة هذه الصورة بعد الحذف!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم، احذفها!',
        cancelButtonText: 'إلغاء'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                // url: '/admin/banner/image/' + imageId,
                url: '{{ route('admin.banner.image.delete', ':id') }}'.replace(':id', imageId),
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#image-' + imageId).remove();
                        Swal.fire(
                            'تم الحذف!',
                            'تم حذف الصورة بنجاح.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'خطأ!',
                            'فشل حذف الصورة، حاول مرة أخرى.',
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'خطأ!',
                        'حدث خطأ أثناء محاولة الحذف، حاول مرة أخرى.',
                        'error'
                    );
                }
            });
        }
    });
}
    </script> --}}

    <script src="{{ asset('dashboard/assets/js/delete-item.js') }}" type="text/javascript"></script>
@endpush
