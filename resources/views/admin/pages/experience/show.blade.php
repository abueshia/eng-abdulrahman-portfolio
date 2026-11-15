@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Experience Details'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Experiences'), 'link' => route('admin.experience.index')],
        ['text' => \App\Helpers\TranslationHelper::translate('Details')],
    ]" :button="[]">
    </x-bread-crumb>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $experience->role_title }} — {{ $experience->company_name }}</h4>
                        @if (auth()->guard('admin')->user()?->can('experiences.edit', 'admin'))
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.experience.edit', $experience->id) }}">
                                <i class="fas fa-pen me-1"></i>
                                {{ \App\Helpers\TranslationHelper::translate('Edit') }}
                            </a>
                        @endif
                    </div>
                    <div class="card-body py-6">
                        <div class="row g-5">
                            @foreach (Config('language') as $key => $lang)
                                <div class="col-md-6">
                                    <strong>{{ \App\Helpers\TranslationHelper::translate('Company Name in') }} {{ __('methods.' . $lang) }}:</strong>
                                    <p class="mt-1">{{ $experience->getTranslation('company_name', $key, false) }}</p>
                                </div>
                            @endforeach

                            @foreach (Config('language') as $key => $lang)
                                <div class="col-md-6">
                                    <strong>{{ \App\Helpers\TranslationHelper::translate('Role Title in') }} {{ __('methods.' . $lang) }}:</strong>
                                    <p class="mt-1">{{ $experience->getTranslation('role_title', $key, false) }}</p>
                                </div>
                            @endforeach

                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Employment Type') }}:</strong>
                                <p class="mt-1">{{ $experience->employment_type?->label() ?? '-' }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Start Date') }}:</strong>
                                <p class="mt-1">{{ $experience->start_date?->format('Y-m-d') ?? '-' }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('End Date') }}:</strong>
                                <p class="mt-1">{{ $experience->is_current ? \App\Helpers\TranslationHelper::translate('Present') : ($experience->end_date?->format('Y-m-d') ?? '-') }}</p>
                            </div>

                            <div class="col-md-12">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Technologies') }}:</strong>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @forelse ($experience->technologies as $tech)
                                        <span class="badge badge-light-primary">{{ $tech->name }}</span>
                                    @empty
                                        <span>-</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

