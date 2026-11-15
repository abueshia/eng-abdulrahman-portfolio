@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('Statistic Details'))

@section('crumb')
    <x-bread-crumb :breadcrumbs="[
        ['text' => \App\Helpers\TranslationHelper::translate('Statistics'), 'link' => route('admin.stat.index')],
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
                        <h4 class="mb-0">{{ $stat->label }}</h4>
                        @if (auth()->guard('admin')->user()?->can('stats.edit', 'admin'))
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.stat.edit', $stat->id) }}">
                                <i class="fas fa-pen me-1"></i>
                                {{ \App\Helpers\TranslationHelper::translate('Edit') }}
                            </a>
                        @endif
                    </div>
                    <div class="card-body py-6">
                        <div class="row g-5">
                            @foreach (Config('language') as $key => $lang)
                                <div class="col-md-6">
                                    <strong>{{ \App\Helpers\TranslationHelper::translate('Label in') }} {{ __('methods.' . $lang) }}:</strong>
                                    <p class="mt-1">{{ $stat->getTranslation('label', $key, false) }}</p>
                                </div>
                            @endforeach

                            <div class="col-md-4">
                                <strong>{{ \App\Helpers\TranslationHelper::translate('Value') }}:</strong>
                                <p class="mt-1">{{ ($stat->prefix ?? '') . $stat->value . ($stat->suffix ?? '') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

