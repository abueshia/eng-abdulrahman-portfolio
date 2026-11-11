@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @if(App::getLocale() == 'ar')
{{-- <style>
    .arabic-numbers {
        font-family: 'Tajawal', 'Cairo', sans-serif;
        direction: rtl;
        unicode-bidi: bidi-override;
        font-feature-settings: 'tnum' 0, 'lnum' 0;
        font-variant-numeric: traditional;
    }
</style> --}}
<style>
    .arabic-numbers {
    direction: rtl;
    unicode-bidi: bidi-override;
    font-family: 'Tajawal', Arial, sans-serif; /* اختر خط يدعم الأرقام العربية */
}
</style>
@endif

@endpush

@if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Client'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Client'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Clients'), 'link' => route('admin.client.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ]"
                   :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Client'), 'link' => route('admin.client.index')]">
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
                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @if ($method == 'PUT')
        @method('PUT')
        <input type="hidden" name="id" value="{{ $client->id }}">
    @endif
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <div class="row">

     <input type="text" name="fake_username" style="display: none;" autocomplete="off">
    <input type="password" name="fake_password" style="display: none;" autocomplete="new-password">
            <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    {{ \App\Helpers\TranslationHelper::translate('Name') }}
                    :
                </label>
                <input type="text" class="form-control form-control-solid"
                       value="{{ old('name') ?? $client->name }}"
                       placeholder="{{ \App\Helpers\TranslationHelper::translate('Name') }}"
                       name="name"/>
                @error('name')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


               <!-- حقل اسم المستخدم -->
    <div class="col-6 mb-5">
        <label class="fs-5 fw-bold form-label mb-5">
            {{ \App\Helpers\TranslationHelper::translate('Username') }}:
        </label>
        <input type="text" class="form-control form-control-solid"
               value="{{ old('username') ?? $client->username }}" 
               placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Username') }}"
               name="username"
               autocomplete="new-username" />
        @error('username')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

       {{-- <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Username') }}:
    </label>
    <input type="text" class="form-control form-control-solid"
           value="{{ old('username') ?? $client->username }}" 
           placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Username') }}"
           name="user_name_temp"
           autocomplete="off" />
    @error('username')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div> --}}



<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Choose Country') }} :
        <span class="text-danger">*</span>
    </label>
    <select name="country_id" id="country_id" class="form-control form-control-solid select2">
        <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Country') }}</option>
        @foreach($countries as $country)
            <option value="{{ $country->id }}" 
                    {{ old('country_id', isset($client->country_id) ? $client->country_id : null) == $country->id ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
    @error('country_id')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- 
<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('City') }} :
    </label>
    <select class="form-control form-control-solid select2" name="city_id" id="city_id">
        <option value="" disabled {{ old('city_id', $client->city_id) ? '' : 'selected' }}>
            {{ \App\Helpers\TranslationHelper::translate('Select City') }}
        </option>
        @foreach($cities as $city)
            <option value="{{ $city->id }}" {{ old('city_id', $client->city_id) == $city->id ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
        @endforeach
    </select>
    @error('city_id')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Region') }} :
    </label>
    <select class="form-control form-control-solid select2" name="region_id" id="region_id">
        <option value="" disabled {{ old('region_id', $client->region_id) ? '' : 'selected' }}>
            {{ \App\Helpers\TranslationHelper::translate('Select Region') }}
        </option>
        @foreach($regions as $region)
            <option value="{{ $region->id }}" {{ old('region_id', $client->region_id) == $region->id ? 'selected' : '' }}>
                {{ $region->name }}
            </option>
        @endforeach
    </select>
    @error('region_id')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div> --}}

<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('City') }} :
    </label>
    <select class="form-control form-control-solid select2" name="city_id" id="city_id">
        <option value="" disabled {{ old('city_id', $client->city_id) ? '' : 'selected' }}>
            {{ \App\Helpers\TranslationHelper::translate('Select City') }}
        </option>
        @foreach($cities as $city)
            <option value="{{ $city->id }}" {{ old('city_id', $client->city_id) == $city->id ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
        @endforeach
    </select>
    @error('city_id')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Region') }} :
    </label>
    <select class="form-control form-control-solid select2" name="region_id" id="region_id">
        <option value="" disabled {{ old('region_id', $client->region_id) ? '' : 'selected' }}>
            {{ \App\Helpers\TranslationHelper::translate('Select Region') }}
        </option>
        <!-- الخيارات سيتم ملؤها ديناميكيًا -->
    </select>
    @error('region_id')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>










            {{--  --}}
         @if ($method == 'POST') <!-- يظهر فقط في حالة الإضافة -->
<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('ID Number') }}:
    </label>
    <input type="number" class="form-control form-control-solid"
           value="{{ old('card') }}" 
           placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter ID Number') }}"
           name="card"/>
    @error('card')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('ID Card') }}:
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
</div>
@endif




            {{-- <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    {{ \App\Helpers\TranslationHelper::translate('Password') }}
                    :
                </label>
                <input type="password" class="form-control form-control-solid"
                       value="{{ old('password') ?? $client->password }}" 
                       placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Password') }}"
                       name="password"/>
                @error('password')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> --}}

                <!-- حقل كلمة المرور -->
    <div class="col-6 mb-5"> 
        <label class="fs-5 fw-bold form-label mb-5">
            {{ \App\Helpers\TranslationHelper::translate('Password') }}:
        </label>
        <input id="passwordField" type="password" class="form-control form-control-solid"
               value="{{ old('password') }}" 
               placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Password') }}"
               name="password"
               autocomplete="new-password"/>
        <button type="button" id="togglePassword" class="btn btn-sm btn-link">{{ \App\Helpers\TranslationHelper::translate('Show password') }}</button>
        @error('password')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
            {{-- <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Password') }}
        :
    </label>
    <input id="passwordField" type="password" class="form-control form-control-solid"
           value="{{ old('password') }}" 
           placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Password') }}"
           name="user_password_temp"/>
    <button type="button" id="togglePassword" class="btn btn-sm btn-link">{{ \App\Helpers\TranslationHelper::translate('Show password') }}</button>
    @error('password')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div> --}}


            <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    {{ \App\Helpers\TranslationHelper::translate('Customer rating') }}
                    :
                </label>
                <select class="form-control form-control-solid" name="category">
                    <option value="gold" {{ old('category', $client->category) == 'gold' ? 'selected' : '' }}>
                        {{ \App\Helpers\TranslationHelper::translate('Gold') }}
                    </option>
                    <option value="silver" {{ old('category', $client->category) == 'silver' ? 'selected' : '' }}>
                        {{ \App\Helpers\TranslationHelper::translate('Silver') }}
                    </option>
                    <option value="bronze" {{ old('category', $client->category) == 'bronze' ? 'selected' : '' }}>
                        {{ \App\Helpers\TranslationHelper::translate('Bronze') }}
                    </option>
                </select>
                @error('category')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    {{ \App\Helpers\TranslationHelper::translate('Phone Number') }}
                    :
                </label>
                <input type="tel" class="form-control form-control-solid"
                       value="{{ old('phone') ?? $client->phone }}" 
                       placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter Phone Number') }}"
                       name="phone"/>
                @error('phone')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            @if ($method == 'PUT')
               <div class="col-6 mb-5">
                <label class="fs-5 fw-bold form-label mb-5">
                    {{ \App\Helpers\TranslationHelper::translate('Points') }}
                    :
                </label>
                <input type="number" class="form-control form-control-solid"
                       value="{{ old('points') ?? $client->points }}" 
                       placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter points Number') }}"
                       name="points"/>
                @error('points')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            @endif



            

            {{-- عرض الحقل فقط في صفحة التعديل --}}
            {{-- @if (isset($client)) --}}
            {{-- @if(isset($model)) --}}
            
      {{-- <div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Is Banned') }} :
    </label>
    <input type="checkbox" class="form-check-input" name="is_banned" value="1" 
        {{ old('is_banned', optional($client)->is_banned) ? 'checked' : '' }} />
    <label class="form-check-label" for="is_banned">
        {{ \App\Helpers\TranslationHelper::translate('Ban this client') }}
    </label>
    @error('is_banned')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div> --}}


{{-- @if ($method == 'PUT')  
<div class="col-6 mb-5">
    <label class="fs-5 fw-bold form-label mb-5">
        {{ \App\Helpers\TranslationHelper::translate('Is Banned') }} :
    </label>
    <input type="checkbox" class="form-check-input" name="is_banned" value="1" 
        {{ old('is_banned', optional($client)->is_banned) ? 'checked' : '' }} />
    <label class="form-check-label" for="is_banned">
        {{ \App\Helpers\TranslationHelper::translate('Ban this client') }}
    </label>
    @error('is_banned')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@endif --}}


            {{-- @endif --}}

        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->

    <!--begin::Actions-->
    <div class="text-center">
        <button type="submit" class="btn btn-primary mb-5">
            <span class="indicator-label">{{ \App\Helpers\TranslationHelper::translate('Save') }}</span>
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
{{-- <script src="/path-to-your-js-file/custom.js"></script> --}}
    <script src="{{asset('dashboard/assets/js/tags-input.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const citySelect = document.getElementById('city_id');
        const regionSelect = document.getElementById('region_id');
        
        citySelect.addEventListener('change', function () {
            const cityId = this.value;

            regionSelect.innerHTML = `<option value="" disabled selected>{{ \App\Helpers\TranslationHelper::translate('Select Region') }}</option>`;

            if (cityId) {
                fetch(`{{ url('admin/client/get-regions') }}/${cityId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.regions && data.regions.length > 0) {
                            data.regions.forEach(region => {
                                const option = document.createElement('option');

                                // اختيار الاسم بناءً على اللغة الحالية
                                const lang = '{{ app()->getLocale() }}'; 
                                option.value = region.id;
                                option.textContent = region.name[lang]; 
                                regionSelect.appendChild(option);
                            });

                            $(regionSelect).trigger('change');
                        } else {
                            const option = document.createElement('option');
                            option.value = "";
                            option.textContent = "{{ \App\Helpers\TranslationHelper::translate('No regions found') }}";
                            regionSelect.appendChild(option);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching regions:', error);
                        const option = document.createElement('option');
                        option.value = "";
                        option.textContent = "{{ \App\Helpers\TranslationHelper::translate('Error loading regions') }}";
                        regionSelect.appendChild(option);
                    });
            }
        });
    });
</script>




    <script>
        // Initialize Select2 for the country dropdown
$(document).ready(function() {
    $('#country_id').select2({
        placeholder: "{{ \App\Helpers\TranslationHelper::translate('Choose Country') }}",
        allowClear: true,
        width: '100%' // Adjust width to match the form control
    });
});


// Initialize Select2 for the city dropdown
$(document).ready(function() {
    $('#city_id').select2({
        placeholder: "{{ \App\Helpers\TranslationHelper::translate('Select City') }}",
        allowClear: true,
        width: '100%' // Adjust width to match the form control
    });
});


// Initialize Select2 for the region dropdown
$(document).ready(function() {
    $('#region_id').select2({
        placeholder: "{{ \App\Helpers\TranslationHelper::translate('Select Region') }}",
        allowClear: true,
        width: '100%' // Adjust width to match the form control
    });
});

    </script>

    <script>
        CKEDITOR.replace('editor', {
    language: 'ar', // تعيين اللغة الافتراضية إلى العربية
    contentsLangDirection: 'rtl', // جعل اتجاه النص من اليمين إلى اليسار
    on: {
        instanceReady: function() {
            // جعل الأرقام المستخدمة افتراضيًا أرقامًا عربية
            this.document.getBody().setStyle('direction', 'rtl');
            this.document.getBody().setStyle('unicode-bidi', 'embed');
        }
    }
});
    </script>


<script>
    tinymce.init({
        selector: '.full-editor',
        directionality: 'rtl',
        content_style: "body { font-family: 'Tajawal', 'Cairo', sans-serif; direction: rtl; unicode-bidi: bidi-override; font-feature-settings: 'tnum' 0, 'lnum' 0; font-variant-numeric: traditional; }",
        language: 'ar'
    });
</script>


    <script>
        $(document).ready(function() {
            $('#meta_tags').select2({
                tags: true,
                placeholder: 'Select or create options',
                allowClear: true
            });
        });
    </script>


  <script>
    tinymce.init({
    selector: '#description1',
    plugins: 'lists',
    toolbar: 'numlist bullist bold italic underline',
    directionality: 'rtl',
    content_style: `
        body { direction: rtl; text-align: right; }
        ol { list-style-type: arabic-indic; }
    `
});
  </script>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordField = document.getElementById('passwordField');
        var passwordType = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = passwordType;
        this.textContent = passwordType === 'password' ? '{{ \App\Helpers\TranslationHelper::translate('Show password') }}' : '{{ \App\Helpers\TranslationHelper::translate('Hide password') }}';
    });
</script>

 
@endpush

