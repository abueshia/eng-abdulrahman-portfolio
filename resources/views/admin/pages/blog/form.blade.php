@extends('admin.layouts.app')

@if ($method === 'PUT')
    @section('title', \App\Helpers\TranslationHelper::translate('Edit Blog'))
@else
    @section('title', \App\Helpers\TranslationHelper::translate('Create Blog'))
@endif

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Blogs'), 'link' => route('admin.blog.index')],
        ['text' => $method === 'PUT' ? \App\Helpers\TranslationHelper::translate('Edit') : \App\Helpers\TranslationHelper::translate('Create')],
    ]" :button="['text' => \App\Helpers\TranslationHelper::translate('Go to Blogs'), 'link' => route('admin.blog.index')]">
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

                            <!-- Bilingual Content Tabs (ar / en) -->
                            <ul class="nav nav-tabs nav-line-tabs mb-6 fs-6" role="tablist">
                                @foreach (Config('language') as $key => $lang)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link fw-bold @if ($loop->first) active @endif"
                                           data-bs-toggle="tab"
                                           href="#kt_blog_tab_{{ $key }}"
                                           role="tab">
                                            {{ __('methods.' . $lang) }} ({{ strtoupper($key) }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content mb-8" id="kt_blog_tabs_content">
                                @foreach (Config('language') as $key => $lang)
                                    <div class="tab-pane fade @if ($loop->first) show active @endif"
                                         id="kt_blog_tab_{{ $key }}"
                                         role="tabpanel">
                                        <div class="row g-6">
                                            <div class="col-md-12">
                                                <label class="fs-6 fw-bold form-label mb-2">
                                                    {{ \App\Helpers\TranslationHelper::translate('Title in') }} {{ __('methods.' . $lang) }} *
                                                </label>
                                                <input type="text"
                                                       class="form-control form-control-solid"
                                                       name="name[{{ $key }}]"
                                                       value="{{ old('name.' . $key, $blog->getTranslation('name', $key, false)) }}"
                                                       required/>
                                                @error('name.' . $key)
                                                    <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12">
                                                <label class="fs-6 fw-bold form-label mb-2">
                                                    {{ \App\Helpers\TranslationHelper::translate('Short Description in') }} {{ __('methods.' . $lang) }}
                                                </label>
                                                <textarea class="form-control form-control-solid"
                                                          name="short_description[{{ $key }}]"
                                                          rows="3">{{ old('short_description.' . $key, $blog->getTranslation('short_description', $key, false)) }}</textarea>
                                                @error('short_description.' . $key)
                                                    <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12">
                                                <label class="fs-6 fw-bold form-label mb-2">
                                                    {{ \App\Helpers\TranslationHelper::translate('Description in') }} {{ __('methods.' . $lang) }} *
                                                </label>
                                                <textarea class="form-control form-control-solid"
                                                          name="description[{{ $key }}]"
                                                          rows="6"
                                                          required>{{ old('description.' . $key, $blog->getTranslation('description', $key, false)) }}</textarea>
                                                @error('description.' . $key)
                                                    <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="my-6"/>

                            <div class="row g-6 mb-8">
                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Category') }}</label>
                                    <select class="form-select form-select-solid" name="category_id">
                                        <option value="">{{ \App\Helpers\TranslationHelper::translate('Choose Category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected((int) old('category_id', $blog->category_id) === $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Status') }} *</label>
                                    @php($currentStatus = old('status', $blog->status?->value ?? \App\Enums\BlogStatusEnum::Published->value))
                                    <select class="form-select form-select-solid" name="status" required>
                                        @foreach ($blogStatuses as $statusValue => $statusLabel)
                                            <option value="{{ $statusValue }}" @selected($currentStatus === $statusValue)>{{ $statusLabel }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Published At') }}</label>
                                    <input type="date" class="form-control form-control-solid" name="published_at"
                                           value="{{ old('published_at', $blog->published_at?->format('Y-m-d')) }}"/>
                                    @error('published_at')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Reading Time (Minutes)') }}</label>
                                    <input type="number" min="1" max="240" class="form-control form-control-solid"
                                           name="reading_time_minutes"
                                           value="{{ old('reading_time_minutes', $blog->reading_time_minutes ?? 5) }}"/>
                                    @error('reading_time_minutes')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-8">
                                    <label class="fs-6 fw-bold form-label mb-2">{{ \App\Helpers\TranslationHelper::translate('Cover Image') }}</label>
                                    <input type="file" class="form-control form-control-solid" name="image" accept="image/*"/>
                                    @error('image')
                                        <span class="text-danger d-block mt-1"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @if ($blog->exists && $blog->getFirstMediaUrl('blogs'))
                                        <img src="{{ $blog->getFirstMediaUrl('blogs') }}" alt="cover" class="mt-3 rounded" width="120"/>
                                    @endif
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_featured" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                                               @checked((bool) old('is_featured', $blog->is_featured))/>
                                        <label class="form-check-label fw-bold ms-3" for="is_featured">
                                            {{ \App\Helpers\TranslationHelper::translate('Featured') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex align-items-center mt-4">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input type="hidden" name="is_active" value="0"/>
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                               @checked((bool) old('is_active', $blog->exists ? $blog->is_active : true))/>
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
