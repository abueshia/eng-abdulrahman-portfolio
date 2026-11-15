@extends('admin.layouts.app')

@if ($method === 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Project'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Create Project'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Projects'), 'link' => route('admin.project.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Projects'), 'link' => route('admin.project.index')]">
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
                                               value="{{ old('title.' . $key, $project->getTranslation('title', $key, false)) }}"
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
                                               value="{{ old('subtitle.' . $key, $project->getTranslation('subtitle', $key, false)) }}"/>
                                        @error('subtitle.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Category') }}</label>
                                    <select class="form-select form-select-solid" name="category_id">
                                        <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected((int) old('category_id', $project->category_id) === $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Project Type') }} *</label>
                                    @php($currentType = old('project_type', $project->project_type?->value ?? \App\Enums\ProjectTypeEnum::WebApp->value))
                                    <select class="form-select form-select-solid" name="project_type" required>
                                        @foreach ($projectTypes as $typeValue => $typeLabel)
                                            <option value="{{ $typeValue }}" @selected($currentType === $typeValue)>{{ $typeLabel }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_type')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Status') }} *</label>
                                    @php($currentStatus = old('status', $project->status?->value ?? \App\Enums\ProjectStatusEnum::Published->value))
                                    <select class="form-select form-select-solid" name="status" required>
                                        @foreach ($projectStatuses as $statusValue => $statusLabel)
                                            <option value="{{ $statusValue }}" @selected($currentStatus === $statusValue)>{{ $statusLabel }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Short Description in') }} {{ __('methods.' . $lang) }} *
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="short_description[{{ $key }}]"
                                                  rows="3"
                                                  required>{{ old('short_description.' . $key, $project->getTranslation('short_description', $key, false)) }}</textarea>
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
                                                  rows="5"
                                                  required>{{ old('description.' . $key, $project->getTranslation('description', $key, false)) }}</textarea>
                                        @error('description.' . $key)
                                            <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Challenge in') }} {{ __('methods.' . $lang) }}
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="challenge[{{ $key }}]"
                                                  rows="3">{{ old('challenge.' . $key, $project->getTranslation('challenge', $key, false)) }}</textarea>
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Solution in') }} {{ __('methods.' . $lang) }}
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="solution[{{ $key }}]"
                                                  rows="3">{{ old('solution.' . $key, $project->getTranslation('solution', $key, false)) }}</textarea>
                                    </div>
                                @endforeach

                                @foreach (Config('language') as $key => $lang)
                                    <div class="col-md-6">
                                        <label class="fs-6 fw-bold form-label mb-2">
                                            {{ \App\Helpers\TranslationHelper::translate('Results in') }} {{ __('methods.' . $lang) }}
                                        </label>
                                        <textarea class="form-control form-control-solid"
                                                  name="results[{{ $key }}]"
                                                  rows="3">{{ old('results.' . $key, $project->getTranslation('results', $key, false)) }}</textarea>
                                    </div>
                                @endforeach

                                <div class="col-md-12">
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

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Live Preview URL') }}</label>
                                    <input type="url" class="form-control form-control-solid" name="live_url" value="{{ old('live_url', $project->live_url) }}" dir="ltr"/>
                                    @error('live_url')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Repository URL') }}</label>
                                    <input type="url" class="form-control form-control-solid" name="repo_url" value="{{ old('repo_url', $project->repo_url) }}" dir="ltr"/>
                                    @error('repo_url')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Completed At') }}</label>
                                    <input type="date" class="form-control form-control-solid" name="completed_at" value="{{ old('completed_at', $project->completed_at?->format('Y-m-d')) }}"/>
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Cover Image') }}</label>
                                    <input type="file" class="form-control form-control-solid" name="image" accept="image/*"/>
                                    @error('image')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @if ($project->exists && $project->getFirstMediaUrl('projects'))
                                        <img src="{{ $project->getFirstMediaUrl('projects') }}" alt="cover" class="mt-3 rounded" width="120"/>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Gallery Screenshots') }}</label>
                                    <input type="file" class="form-control form-control-solid" name="gallery[]" multiple accept="image/*"/>
                                    @error('gallery.*')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_featured" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                                               @checked((bool) old('is_featured', $project->is_featured))/>
                                        <label class="form-check-label fw-bold ms-3" for="is_featured">
                                            {{ \App\Helpers\TranslationHelper::translate('Featured Project') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               @checked((bool) old('is_active', $project->exists ? $project->is_active : true))/>
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

