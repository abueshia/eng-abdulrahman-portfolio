@extends('admin.layouts.app')

@if ($method === 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Testimonial'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Create Testimonial'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Testimonials'), 'link' => route('admin.testimonial.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Testimonials'), 'link' => route('admin.testimonial.index')]">
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
                                            {{ \App\Helpers\TranslationHelper::translate('Client Name in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="name[{{ $key }}]"
                                               value="{{ old('name.' . $key, $testimonial->getTranslation('name', $key, false)) }}"
                                               required/>
                                        @error('name.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Client Role in') }} {{ __('methods.' . $lang) }}
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="name_job[{{ $key }}]"
                                               value="{{ old('name_job.' . $key, $testimonial->getTranslation('name_job', $key, false)) }}"/>
                                        @error('name_job.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Company in') }} {{ __('methods.' . $lang) }}
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-solid"
                                               name="company_name[{{ $key }}]"
                                               value="{{ old('company_name.' . $key, $testimonial->getTranslation('company_name', $key, false)) }}"/>
                                        @error('company_name.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Comment in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="description[{{ $key }}]"
                                                  rows="4"
                                                  required>{{ old('description.' . $key, $testimonial->getTranslation('description', $key, false)) }}</textarea>
                                        @error('description.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Linked Project (Optional)') }}</label>
                                    <select class="form-select form-select-solid" name="project_id">
                                        <option value="">{{ \App\Helpers\TranslationHelper::translate('No Linked Project') }}</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}" @selected((int) old('project_id', $testimonial->project_id) === $project->id)>
                                                {{ $project->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Rating (1-5)') }} *</label>
                                    @php($currentRating = (int) old('rating', $testimonial->rating ?? 5))
                                    <select class="form-select form-select-solid" name="rating" required>
                                        @foreach ([5, 4, 3, 2, 1] as $star)
                                            <option value="{{ $star }}" @selected($currentRating === $star)>{{ $star }} / 5</option>
                                        @endforeach
                                    </select>
                                    @error('rating')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Client Avatar') }}</label>
                                    <input type="file" class="form-control form-control-solid" name="image" accept="image/*"/>
                                    @error('image')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @if ($testimonial->exists && $testimonial->getFirstMediaUrl('testimonials'))
                                        <img src="{{ $testimonial->getFirstMediaUrl('testimonials') }}" alt="avatar" class="mt-3 rounded" width="80"/>
                                    @endif
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_featured" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                                               @checked((bool) old('is_featured', $testimonial->is_featured))/>
                                        <label class="form-check-label fw-bold ms-3" for="is_featured">
                                            {{ \App\Helpers\TranslationHelper::translate('Featured') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               @checked((bool) old('is_active', $testimonial->exists ? $testimonial->is_active : true))/>
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
