@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
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

{{-- @if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Client'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Client'))
@endif --}}

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
                            @if ($errors->any())
    <div class="alert alert-danger">
        <strong>هناك بعض الأخطاء!</strong> يرجى تصحيح الأخطاء التالية:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li> <!-- كل خطأ في سطر منفصل -->
            @endforeach
        </ul>
    </div>
@endif
                            <!--begin::Form-->
    <form action="{{ route('admin.client.store.points', ['client' => $client->id]) }}" method="POST">
    @csrf
    {{-- @if ($method == 'PUT')
        @method('PUT')
        <input type="hidden" name="id" value="{{ $client->id }}">
    @endif --}}
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <div class="row">


            {{-- @if ($method == 'PUT') --}}
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
            {{-- @endif --}}

        </div>
    </div>

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

{{-- <script>
    tinymce.init({
    selector: '#description1',
    directionality: 'rtl',
    content_css: '//fonts.googleapis.com/css?family=Tajawal',
    plugins: 'directionality',
    toolbar: 'ltr rtl',
    setup: function (editor) {
        editor.on('init', function () {
            if (document.documentElement.lang === 'ar') {
                editor.getBody().style.direction = 'rtl';
                editor.getBody().style.fontFamily = "'Tajawal', Arial, sans-serif";
            }
        });
    }
});
</script> --}}


<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordField = document.getElementById('passwordField');
        var passwordType = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = passwordType;
        this.textContent = passwordType === 'password' ? '{{ \App\Helpers\TranslationHelper::translate('Show password') }}' : '{{ \App\Helpers\TranslationHelper::translate('Hide password') }}';
    });
</script>

 
@endpush

