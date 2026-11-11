@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Code'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Code'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Code'), 'link' => route('admin.coupon.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Code'), 'link' => route('admin.coupon.index')]">
    </x-bread-crumb>
@endsection

@section('content')


 <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-body pt-0">
                        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if($method == 'PUT')
                                @method('PUT')
                                <input type="hidden" name="id" value="{{$coupon->id}}">
                            @endif

                            <div class="fv-row mb-10">
                                <div class="row">
                                   
                                    

 <!-- Group Selection -->
 <div class="col-md-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5"> {{\App\Helpers\TranslationHelper::translate('Select Group')}}:</label>
    <div class="d-flex">
        <!-- Dropdown -->
        <select name="group_id" class="form-select form-control form-control-solid" id="group-select" style="width: 85%;">
            <option value="" disabled selected> {{\App\Helpers\TranslationHelper::translate('Select a Group')}}</option>
            @foreach ($groups as $group)
                <option value="{{ $group->id }}" {{ old('group_id', $coupon->group_id) == $group->id ? 'selected' : '' }}>
                    {{ $group->name }}
                </option>
            @endforeach
        </select>
        <!-- Add Group Button (next to the select) -->
        <button type="button" class="btn btn-primary ms-2" id="create-group-btn">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <!-- New Group Input (appears when creating new group) -->
    <div class="mt-3" id="new-group-input" style="display: none;">
        <div class="input-group">
            <input type="text" id="new-group-name" class="form-control" placeholder=" {{\App\Helpers\TranslationHelper::translate('Enter New Group Name')}}" style="height: 40px; font-size: 16px;">
        </div>
        <!-- Save Group Button (below the input field) -->
        <button type="button" class="btn btn-success mt-2" id="save-group-btn">{{\App\Helpers\TranslationHelper::translate('Save Group')}}</button>
    </div>

    @error('group_id')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>





                                    <!-- Product Selection -->
                                    <div class="col-md-6 mb-5">
                                        <label class="fs-5 fw-bold form-label mb-5"> {{\App\Helpers\TranslationHelper::translate('Select Product')}}:</label>
                                        <select name="product_id" class="form-select form-control form-control-solid">
                                            <option value="" disabled {{ is_null(old('product_id', $coupon->product_id)) ? 'selected' : '' }}>
                                                {{\App\Helpers\TranslationHelper::translate('Select a Product')}}
                                            </option>
                                            <option value="all" {{ old('product_id', $coupon->product_id) == 'all' ? 'selected' : '' }}>
                                                 {{\App\Helpers\TranslationHelper::translate('All Products')}}
                                            </option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" {{ old('product_id', $coupon->product_id) == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Number of Codes -->
                                    <div class="col-md-6 mb-5">
                                        <label class="fs-5 fw-bold form-label mb-5"> {{\App\Helpers\TranslationHelper::translate('Number of Codes')}}:</label>
                                        <input type="number" name="number" class="form-control form-control-solid" value="{{ old('number') }}" placeholder=" {{\App\Helpers\TranslationHelper::translate('Enter number of codes')}}">
                                        @error('number')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                     
                     
                                             
                                  </div>

                                    <div class="col-md-6 mb-5">
                                        <label class="fs-5 fw-bold form-label mb-5"> {{\App\Helpers\TranslationHelper::translate('points')}}:</label>
                                        <input type="number" name="points" class="form-control form-control-solid" value="{{ old('points') }}" placeholder=" {{\App\Helpers\TranslationHelper::translate('Enter points')}}">
                                        @error('points')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>  

                                    
  <div class="col-md-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('validate_to') }}:
    </label>
    <input type="date" name="validate_to" class="form-control form-control-solid" value="{{ old('validate_to') }}" placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter expiration date') }}">
    
    @error('validate_to')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

 


                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mb-5">
                                    <span class="indicator-label">{{ \App\Helpers\TranslationHelper::translate('Generate Codes') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('admin_js')

<script src="{{asset('dashboard/assets/js/tags-input.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script>



$(document).ready(function() {
    // تفعيل البحث في الـ select باستخدام Select2
    $('#group-select').select2({
        placeholder: "{{ __('Select a Group') }}",
        allowClear: true
    });

    // عند الضغط على زر إضافة جروب
    $('#create-group-btn').click(function() {
        $('#new-group-input').toggle(); // التبديل بين إظهار وإخفاء إدخال الجروب
    });

    // عند الضغط على زر الحفظ الخاص بالجروب الجديد
    $('#save-group-btn').click(function() {
        var groupName = $('#new-group-name').val().trim();

        if (groupName === '') {
            alert('{{ __("Please enter a group name") }}');
            return;
        }


    

        // إرسال اسم الجروب إلى السيرفر باستخدام AJAX
        $.ajax({
            url: '{{ route("admin.group.storeAjax") }}', // تأكد من أن هذا هو المسار الصحيح
            type: 'POST',
            data: {
                name: groupName,
                _token: '{{ csrf_token() }}' // حماية CSRF
            },
            success: function(response) {
                if (response.status === 1) {
                    // إضافة الجروب الجديد إلى القائمة
                    let data = response.data;
                    $('#group-select').append(
                        `<option value="${data.id}" selected>${data.name}</option>`
                    );

                    // إخفاء الحقل وتصفية القيمة
                    $('#new-group-name').val('');
                    $('#new-group-input').hide(); // إخفاء الحقل بعد الحفظ

                    // تحديث Select2 للقائمة
                    $('#group-select').trigger('change');

                    Swal.fire({
                        icon: 'success',
                        text: response.msg,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.msg,
                    });
                }
            },
            error: function(response) {
                console.error(response); // تصحيح السجل في حال حدوث خطأ
            }
        });
    });
});
</script> 



@endpush
