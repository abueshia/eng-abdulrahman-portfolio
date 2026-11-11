@extends('admin.layouts.app')

@push('admin_css')
    <link href="{{asset('dashboard/assets/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@if ($method == 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Notification'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Add Notification'))
@endif

{{-- @section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Notifications'), 'link' => route('admin.notification.index')],
        ['text' => __('methods.' . getLastKeyRoute(request()->route()->getName()))],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Notification'), 'link' => route('admin.notification.index')]">
    </x-bread-crumb>
@endsection --}}

@section('content')



{{-- <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-header border-0 pt-6">

                        <div class="card-body pt-0">
                            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($method == 'PUT')
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$notification->id}}">

                            @endif
                                <div class="fv-row mb-10">
                                    <div class="row">

                                        @foreach (Config('language') as $key => $lang)
                                            <div class="col-6 mb-5">
                                                <label class="fs-5 fw-bold form-label mb-5">
                                                    {{\App\Helpers\TranslationHelper::translate('title in')}} {{__('methods.' . $lang)}}
                                                    :
                                                </label>
                                                <input type="text" class="form-control form-control-solid"
                                                       value="{{ old('name.'.$key) ?? $notification->getTranslation('name',$key)}}"
                                                       placeholder="{{\App\Helpers\TranslationHelper::translate('title in')}} {{__('methods.' . $lang)}}"
                                                       name="name[{{ $key}}]"/>
                                                @error('name.'.$key)
                                                <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach


                                                   @foreach (Config('language') as $key => $lang)
                                                   <div class="col-12  mb-5">
                                            <label
                                                class="fs-5 fw-bold form-label mb-5">{{ \App\Helpers\TranslationHelper::translate('message in')}} {{__('methods.' . $lang)}}
                                            </label>
                                            <textarea class="form-control form-control-solid full-editor" name="message[{{ $key}}]" rows="5" id="message{{$key}}"
                                                      style="height: 300px; direction: rtl;">{{ old('message.'.$key) ?? $notification->getTranslation('message',$key)}}</textarea>
                                            @error('message.'.$key)
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        @endforeach



                                                                            <div class="col-md-6 mb-5">
                                        <label class="fs-5 fw-bold form-label mb-5">{{ __('Select user') }}:</label>
                                        <select name="user_id" class="form-select form-control form-control-solid">
                                            <option value="" disabled {{ is_null(old('user_id', $notification->user_id)) ? 'selected' : '' }}>
                                                {{ __('Select a Product') }}
                                            </option>
                                            <option value="all" {{ old('user_id', $notification->user_id) == 'all' ? 'selected' : '' }}>
                                                {{ __('All Products') }}
                                            </option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user_id', $notification->user_id) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div> 
                                </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mb-5">
                                        <span
                                            class="indicator-label">{{ \App\Helpers\TranslationHelper::translate('Save') }}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <h3 class="card-title fw-bold">{{ \App\Helpers\TranslationHelper::translate('Notification Form') }}</h3>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($method == 'PUT')
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$notification->id}}">
                        @endif

                        <div class="fv-row mb-10">
                            <label class="fs-4 fw-bold form-label mb-3">
                                {{ \App\Helpers\TranslationHelper::translate('Title') }}
                            </label>
                            <input type="text" 
                                   class="form-control form-control-solid fs-5 py-3" 
                                   value="{{ old('name') ?? $notification->name }}" 
                                   placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter title here') }}" 
                                   name="name"/>
                            @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="fv-row mb-10">
                            <label class="fs-4 fw-bold form-label mb-3">
                                {{ \App\Helpers\TranslationHelper::translate('Message') }}
                            </label>
                            <textarea class="form-control form-control-solid fs-5 py-4" 
                                      name="message" 
                                      rows="6" 
                                      placeholder="{{ \App\Helpers\TranslationHelper::translate('Enter your message here') }}">{{ old('message') ?? $notification->message }}</textarea>
                            @error('message')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="fv-row mb-10">
                            <label class="fs-4 fw-bold form-label mb-3">
                                {{ \App\Helpers\TranslationHelper::translate('Select User') }}
                            </label>
                            <select name="user_id" 
                                    class="form-select form-control form-control-solid fs-5" 
                                    data-control="select2" 
                                    data-placeholder="{{ \App\Helpers\TranslationHelper::translate('Search or select a user') }}">
                                <option value="all" {{ old('user_id', $notification->user_id) == 'all' ? 'selected' : '' }}>
                                    {{ \App\Helpers\TranslationHelper::translate('All Users') }}
                                </option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $notification->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary py-3 px-5">
                                <span class="indicator-label fs-6">{{ \App\Helpers\TranslationHelper::translate('Save') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
@push('admin_js')
<script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
@endpush

@push('admin_js')
<script>
    // استهداف كل textarea بعلامة full-editor
    document.querySelectorAll('.full-editor').forEach((editor) => {
        CKEDITOR.replace(editor.id, {
            // إضافة الخطوط المطلوبة
            font_names: 'Arial/Arial, Helvetica, sans-serif;' +
                'Courier New/Courier New, Courier, monospace;' +
                'Advertising/Advertising, sans-serif;' +
                'Amiri/Amiri, serif;' +
                'Tajawal/Tajawal, sans-serif;' +
                'Traditional Arabic/Traditional Arabic, serif;',
            contentsLangDirection: 'rtl', // تفعيل الكتابة من اليمين لليسار للعربية
            height: 300 // ارتفاع المحرر
        });
    });
</script>
@endpush
@push('admin_js')
<script src="{{asset('dashboard/assets/js/tags-input.min.js')}}"></script>
@endpush

