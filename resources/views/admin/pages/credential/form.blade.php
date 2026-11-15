@extends('admin.layouts.app')

@if ($method === 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Credential'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Create Credential'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Credentials'), 'link' => route('admin.credential.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Credentials'), 'link' => route('admin.credential.index')]">
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
                                               value="{{ old('title.' . $key, $credential->getTranslation('title', $key, false)) }}"
                                               required/>
                                        @error('title.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Issuer in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="organization[{{ $key }}]"
                                               value="{{ old('organization.' . $key, $credential->getTranslation('organization', $key, false)) }}"
                                               required/>
                                        @error('organization.' . $key)
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
                                                  rows="3">{{ old('description.' . $key, $credential->getTranslation('description', $key, false)) }}</textarea>
                                        @error('description.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Type') }} *</label>
                                    @php($currentType = old('type', $credential->type?->value ?? \App\Enums\CredentialTypeEnum::ProfessionalCertificate->value))
                                    <select class="form-select form-select-solid" name="type" required>
                                        @foreach ($credentialTypes as $typeValue => $typeLabel)
                                            <option value="{{ $typeValue }}" @selected($currentType === $typeValue)>{{ $typeLabel }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Issued At') }} *</label>
                                    <input type="date" class="form-control form-control-solid" name="issued_at"
                                           value="{{ old('issued_at', $credential->issued_at?->format('Y-m-d')) }}" required/>
                                    @error('issued_at')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Expires At') }}</label>
                                    <input type="date" class="form-control form-control-solid" name="expires_at"
                                           value="{{ old('expires_at', $credential->expires_at?->format('Y-m-d')) }}"/>
                                    @error('expires_at')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Credential ID') }}</label>
                                    <input type="text" class="form-control form-control-solid" name="credential_id"
                                           value="{{ old('credential_id', $credential->credential_id) }}" dir="ltr"/>
                                    @error('credential_id')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Credential URL') }}</label>
                                    <input type="url" class="form-control form-control-solid" name="credential_url"
                                           value="{{ old('credential_url', $credential->credential_url) }}" dir="ltr"/>
                                    @error('credential_url')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Certificate Image') }}</label>
                                    <input type="file" class="form-control form-control-solid" name="image" accept="image/*"/>
                                    @error('image')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @if ($credential->exists && $credential->getFirstMediaUrl('credentials'))
                                        <img src="{{ $credential->getFirstMediaUrl('credentials') }}" alt="certificate" class="mt-3 rounded" width="100"/>
                                    @endif
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               @checked((bool) old('is_active', $credential->exists ? $credential->is_active : true))/>
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
