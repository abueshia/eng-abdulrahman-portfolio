@extends('admin.layouts.app')

@if ($method === 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Experience'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Create Experience'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Experiences'), 'link' => route('admin.experience.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Experiences'), 'link' => route('admin.experience.index')]">
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
                                            {{ \App\Helpers\TranslationHelper::translate('Company Name in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="company_name[{{ $key }}]"
                                               value="{{ old('company_name.' . $key, $experience->getTranslation('company_name', $key, false)) }}"
                                               required/>
                                        @error('company_name.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Role Title in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="role_title[{{ $key }}]"
                                               value="{{ old('role_title.' . $key, $experience->getTranslation('role_title', $key, false)) }}"
                                               required/>
                                        @error('role_title.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Location in') }} {{ __('methods.' . $lang) }}
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="location[{{ $key }}]"
                                               value="{{ old('location.' . $key, $experience->getTranslation('location', $key, false)) }}"/>
                                    </div>
                                @endforeach

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Employment Type') }} *</label>
                                    @php($currentEmploymentType = old('employment_type', $experience->employment_type?->value ?? \App\Enums\EmploymentTypeEnum::FullTime->value))
                                    <select class="form-select form-select-solid" name="employment_type" required>
                                        @foreach ($employmentTypes as $typeValue => $typeLabel)
                                            <option value="{{ $typeValue }}" @selected($currentEmploymentType === $typeValue)>{{ $typeLabel }}</option>
                                        @endforeach
                                    </select>
                                    @error('employment_type')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Start Date') }} *</label>
                                    <input type="date" class="form-control form-control-solid"
                                           name="start_date"
                                           value="{{ old('start_date', $experience->start_date?->format('Y-m-d')) }}"
                                           required/>
                                    @error('start_date')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('End Date') }}</label>
                                    <input type="date" class="form-control form-control-solid"
                                           name="end_date"
                                           value="{{ old('end_date', $experience->end_date?->format('Y-m-d')) }}"/>
                                    @error('end_date')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Summary in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="summary[{{ $key }}]"
                                                  rows="4"
                                                  required>{{ old('summary.' . $key, $experience->getTranslation('summary', $key, false)) }}</textarea>
                                        @error('summary.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Achievements in') }} {{ __('methods.' . $lang) }}
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="achievements[{{ $key }}]"
                                                  rows="4">{{ old('achievements.' . $key, $experience->getTranslation('achievements', $key, false)) }}</textarea>
                                    </div>
                                @endforeach

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Technologies Used') }}</label>
                                    @php($chosenTechs = (array) old('technologies', $selectedTechnologyIds))
                                    <select class="form-select form-select-solid" name="technologies[]" multiple data-control="select2">
                                        @foreach ($technologies as $tech)
                                            <option value="{{ $tech->id }}" @selected(in_array($tech->id, $chosenTechs, true))>
                                                {{ $tech->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Company Website URL') }}</label>
                                    <input type="url" class="form-control form-control-solid" name="company_url"
                                           value="{{ old('company_url', $experience->company_url) }}" dir="ltr"/>
                                    @error('company_url')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Company Logo') }}</label>
                                    <input type="file" class="form-control form-control-solid" name="image" accept="image/*"/>
                                    @error('image')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-3 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_current" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_current" value="1" id="is_current"
                                               @checked((bool) old('is_current', $experience->is_current))/>
                                        <label class="form-check-label fw-bold ms-3" for="is_current">
                                            {{ \App\Helpers\TranslationHelper::translate('Current Role') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-3 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               @checked((bool) old('is_active', $experience->exists ? $experience->is_active : true))/>
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

