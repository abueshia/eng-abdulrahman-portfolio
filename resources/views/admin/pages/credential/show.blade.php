@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Credential Details'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Credentials'), 'link' => route('admin.credential.index')],
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
                        <h4 class="mb-0">{{ $credential->title }}</h4>
                        @if (auth()->guard('admin')->user()?->can('credentials.edit', 'admin'))
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.credential.edit', $credential->id) }}">
                                <i class="fas fa-pen me-1"></i>
                                {{ \App\Helpers\TranslationHelper::translate('Edit') }}
                            </a>
                        @endif
                    </div>
                    <div class="card-body py-6">
                        <div class="row g-5">
                            @foreach (Config('language') as $key => $lang)
                                <div class="col-md-6">
                                    <strong>{{ \App\Helpers\TranslationHelper::translate('Title in') }} {{ __('methods.' . $lang) }}:</strong>
                                    <p class="mt-1">{{ $credential->getTranslation('title', $key, false) }}</p>
                                </div>
                            @endforeach

                            @foreach (Config('language') as $key => $lang)
                                <div class="col-md-6">
                                    <strong>{{ \App\Helpers\TranslationHelper::translate('Issuer in') }} {{ __('methods.' . $lang) }}:</strong>
                                    <p class="mt-1">{{ $credential->getTranslation('organization', $key, false) }}</p>
                                </div>
                            @endforeach

                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Type') }}:</strong>
                                <p class="mt-1">{{ $credential->type?->label() ?? '-' }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Issued At') }}:</strong>
                                <p class="mt-1">{{ $credential->issued_at?->format('Y-m-d') ?? '-' }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Credential ID') }}:</strong>
                                <p class="mt-1">{{ $credential->credential_id ?: '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
