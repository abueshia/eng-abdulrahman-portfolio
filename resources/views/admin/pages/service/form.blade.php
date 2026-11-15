@extends('admin.layouts.app')

@if ($method === 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Service'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Create Service'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Services'), 'link' => route('admin.service.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Services'), 'link' => route('admin.service.index')]">
    </x-bread-crumb>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-body pt-6">
                        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($method === 'PUT')
                                @method('PUT')
                            @endif

                            <div class="row g-6 mb-8">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Title in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="title[{{ $key }}]"
                                               value="{{ old('title.' . $key, $service->getTranslation('title', $key, false)) }}"
                                               required/>
                                        @error('title.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Subtitle in') }} {{ __('methods.' . $lang) }}
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="subtitle[{{ $key }}]"
                                               value="{{ old('subtitle.' . $key, $service->getTranslation('subtitle', $key, false)) }}"/>
                                        @error('subtitle.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Short Description in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="short_description[{{ $key }}]"
                                                  rows="3"
                                                  required>{{ old('short_description.' . $key, $service->getTranslation('short_description', $key, false)) }}</textarea>
                                        @error('short_description.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Description in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="description[{{ $key }}]"
                                                  rows="4"
                                                  required>{{ old('description.' . $key, $service->getTranslation('description', $key, false)) }}</textarea>
                                        @error('description.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Icon Class') }}</label>
                                    <input type="text" class="form-control form-control-solid" name="icon"
                                           value="{{ old('icon', $service->icon) }}" placeholder="fa-solid fa-layer-group" dir="ltr"/>
                                    @error('icon')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Image') }}</label>
                                    <input type="file" class="form-control form-control-solid" name="image" accept="image/*"/>
                                    @error('image')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @if ($service->exists && $service->getFirstMediaUrl('services'))
                                        <img src="{{ $service->getFirstMediaUrl('services') }}" alt="service" class="mt-3 rounded" width="100"/>
                                    @endif
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_featured" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                                               @checked((bool) old('is_featured', $service->is_featured))/>
                                        <label class="form-check-label fw-bold ms-3" for="is_featured">
                                            {{ \App\Helpers\TranslationHelper::translate('Featured') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               @checked((bool) old('is_active', $service->exists ? $service->is_active : true))/>
                                        <label class="form-check-label fw-bold ms-3" for="is_active">
                                            {{ \App\Helpers\TranslationHelper::translate('Active') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-8">
                                    {{ \App\Helpers\TranslationHelper::translate('Save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
