@extends('admin.layouts.app')

@if ($method === 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Statistic'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Create Statistic'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Statistics'), 'link' => route('admin.stat.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Statistics'), 'link' => route('admin.stat.index')]">
    </x-bread-crumb>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-body pt-6">
                        <form action="{{ $action }}" method="POST">
                            @csrf
                            @if ($method === 'PUT')
                                @method('PUT')
                            @endif

                            <div class="row g-6 mb-8">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Label in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="label[{{ $key }}]"
                                               value="{{ old('label.' . $key, $stat->getTranslation('label', $key, false)) }}"
                                               required/>
                                        @error('label.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                <div class="col-md-3">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Prefix') }}</label>
                                    <input type="text" class="form-control form-control-solid" name="prefix"
                                           value="{{ old('prefix', $stat->prefix) }}" placeholder="+" dir="ltr"/>
                                    @error('prefix')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Value') }} *</label>
                                    <input type="text" class="form-control form-control-solid" name="value"
                                           value="{{ old('value', $stat->value) }}" placeholder="25" dir="ltr" required/>
                                    @error('value')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Suffix') }}</label>
                                    <input type="text" class="form-control form-control-solid" name="suffix"
                                           value="{{ old('suffix', $stat->suffix) }}" placeholder="+" dir="ltr"/>
                                    @error('suffix')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Icon Class') }}</label>
                                    <input type="text" class="form-control form-control-solid" name="icon"
                                           value="{{ old('icon', $stat->icon) }}" placeholder="fa-solid fa-code" dir="ltr"/>
                                    @error('icon')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               @checked((bool) old('is_active', $stat->exists ? $stat->is_active : true))/>
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

