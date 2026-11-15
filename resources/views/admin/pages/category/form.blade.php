@extends('admin.layouts.app')

@if ($method === 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Category'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Create Category'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Categories'), 'link' => route('admin.category.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Categories'), 'link' => route('admin.category.index')]">
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
                                            {{ \App\Helpers\TranslationHelper::translate('Name in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="name[{{ $key }}]"
                                               value="{{ old('name.' . $key, $category->getTranslation('name', $key, false)) }}"
                                               required/>
                                        @error('name.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Description in') }} {{ __('methods.' . $lang) }}
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="description[{{ $key }}]"
                                                  rows="3">{{ old('description.' . $key, $category->getTranslation('description', $key, false)) }}</textarea>
                                        @error('description.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Image') }}</label>
                                    <input type="file" class="form-control form-control-solid" name="image" accept="image/*"/>
                                    @error('image')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               @checked((bool) old('is_active', $category->exists ? $category->is_active : true))/>
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
