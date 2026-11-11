@extends('admin.layouts.app')

@if($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit News'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add News'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
    ['text'=> \App\Helpers\TranslationHelper::translate('News'),'link'=>route('admin.news.index')],
    ['text'=> __('methods.' . getLastKeyRoute(request()->route()->getName()))]
    ]" :button="['text'=>\App\Helpers\TranslationHelper::translate('Go to News'),'link'=>route('admin.news.index')]">
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
        <input type="hidden" name="id" value="{{ $news->id }}">
    @endif

    <div class="fv-row mb-10">
        <div class="row">
            <!-- رفع الصورة -->
            {{-- <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    {{ \App\Helpers\TranslationHelper::translate('News Image') }}:
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

                @if($news->getFirstMediaUrl('news'))
                    <div class="mt-4">
                        <h5>{{ \App\Helpers\TranslationHelper::translate('Existing Image') }}:</h5>
                        <div class="row">
                            <div class="col-6 mb-3" id="image-{{ $news->id }}">
                                <img src="{{ $news->getFirstMediaUrl('news') }}" alt="news image" width="100px" style="border-radius: 5px">
                            </div>
                        </div>
                    </div>
                @endif
            </div> --}}

            <!-- رفع الفيديو -->
            <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    {{ \App\Helpers\TranslationHelper::translate('News Video') }}:
                </label>

                <input type="file" class="form-control form-control-solid" name="news_video" accept="video/*"/>
                @error('news_video')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                @if($news->getFirstMediaUrl('news_video'))
                    <div class="mt-4">
                        <h5>{{ \App\Helpers\TranslationHelper::translate('Existing Video') }}:</h5>
                        <video width="100%" controls>
                            <source src="{{ $news->getFirstMediaUrl('news_video') }}" type="video/mp4">
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


{{--                             
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'PUT')
        @method('PUT')
        <input type="hidden" name="id" value="{{ $news->id }}">
    @endif

    <div class="fv-row mb-10">
        <div class="row">
            <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    {{ \App\Helpers\TranslationHelper::translate('News') }}:
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

                @if($news->getFirstMediaUrl('news'))
                    <div class="mt-4">
                        <h5>{{ \App\Helpers\TranslationHelper::translate('Existing Image') }}:</h5>
                        <div class="row">
                            <div class="col-6 mb-3" id="image-{{ $news->id }}">
                                <img src="{{ $news->getFirstMediaUrl('news') }}" alt="news image" width="100px" style="border-radius: 5px">
                                
                         
                            </div>
                        </div>
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
 --}}




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
                // url: '/admin/news/image/' + imageId,
                url: '{{ route('admin.news.image.delete', ':id') }}'.replace(':id', imageId),
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
