@extends('admin.layouts.app')
@section('title', \App\Helpers\TranslationHelper::translate('General Settings'))

@section('crumb')
    <x-bread-crumb
        :breadcrumbs="[['text' => \App\Helpers\TranslationHelper::translate('General Settings')]]"
        :button="[]"
        :title="\App\Helpers\TranslationHelper::translate('General Settings')"
    />
@endsection

@push('admin_css')
<style>
    .portfolio-settings-card {
        border: 1px solid #e4e6ef;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.04);
    }
    .portfolio-settings-tabs {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 8px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eff2f5;
        -webkit-overflow-scrolling: touch;
    }
    .portfolio-settings-tabs .nav-link {
        white-space: nowrap;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
        color: #5e6278;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }
    .portfolio-settings-tabs .nav-link:hover {
        background: #f5f8fa;
        color: #009ef7;
    }
    .portfolio-settings-tabs .nav-link.active {
        background: #009ef7;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 158, 247, 0.25);
    }
    .setting-item-box {
        background: #f9fafb;
        border: 1px solid #eff2f5;
        border-radius: 12px;
        padding: 18px;
        height: 100%;
    }
    .setting-lang-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 6px;
        text-transform: uppercase;
    }
    .media-preview-thumb {
        max-height: 64px;
        max-width: 140px;
        object-fit: contain;
        border-radius: 8px;
        border: 1px solid #e4e6ef;
        background: #fff;
        padding: 4px;
    }
    @media (max-width: 767.98px) {
        .setting-item-box {
            padding: 14px;
        }
        .portfolio-settings-tabs .nav-link {
            padding: 8px 14px;
            font-size: 13px;
        }
    }
</style>
@endpush

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">

        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center p-4 mb-6 rounded-3">
                <i class="fa-solid fa-circle-check fs-2hx text-success me-3"></i>
                <div class="fw-semibold">{{ session('success') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger p-4 mb-6 rounded-3">
                <div class="fw-bold mb-2">{{ \App\Helpers\TranslationHelper::translate('Please check the submitted fields:') }}</div>
                <ul class="mb-0 ps-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card portfolio-settings-card">
            <div class="card-header border-0 pt-6 pb-2 px-6">
                <ul class="nav nav-pills portfolio-settings-tabs w-100" id="portfolioSettingsTabs" role="tablist">
                    @foreach ($tabs as $groupKey => $tabData)
                        @php
                            /** @var \App\Enums\SettingGroupEnum $groupEnum */
                            $groupEnum = $tabData['group'];
                            $isActive = $activeGroup === $groupKey;
                        @endphp
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link {{ $isActive ? 'active' : '' }}"
                                id="tab-btn-{{ $groupKey }}"
                                data-bs-toggle="pill"
                                data-bs-target="#tab-pane-{{ $groupKey }}"
                                data-group-key="{{ $groupKey }}"
                                type="button"
                                role="tab"
                                aria-controls="tab-pane-{{ $groupKey }}"
                                aria-selected="{{ $isActive ? 'true' : 'false' }}"
                            >
                                <i class="{{ $groupEnum->icon() }}"></i>
                                <span>{{ $groupEnum->label() }}</span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <form action="{{ route('admin.all_settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="active_group" id="activeGroupInput" value="{{ $activeGroup }}">

                <div class="card-body px-6 py-6">
                    <div class="tab-content" id="portfolioSettingsTabContent">
                        @foreach ($tabs as $groupKey => $tabData)
                            @php
                                /** @var \App\Enums\SettingGroupEnum $groupEnum */
                                $groupEnum = $tabData['group'];
                                $isActive = $activeGroup === $groupKey;
                            @endphp
                            <div
                                class="tab-pane fade {{ $isActive ? 'show active' : '' }}"
                                id="tab-pane-{{ $groupKey }}"
                                role="tabpanel"
                                aria-labelledby="tab-btn-{{ $groupKey }}"
                            >
                                <div class="d-flex flex-wrap align-items-center justify-content-between mb-6 pb-3 border-bottom">
                                    <div>
                                        <h3 class="fw-bold text-gray-900 mb-1">
                                            <i class="{{ $groupEnum->icon() }} text-primary me-2"></i>
                                            {{ $groupEnum->label() }}
                                        </h3>
                                        <span class="text-muted fs-7">
                                            {{ app()->getLocale() === 'ar'
                                                ? 'إدارة إعدادات البورتفوليو باللغتين العربية والإنجليزية مع تحديث تلقائي للكاش.'
                                                : 'Manage bilingual portfolio settings with automatic cache invalidation.' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row g-5">
                                    @foreach ($tabData['items'] as $settingKey => $item)
                                        @php
                                            /** @var \App\Enums\SettingKeyEnum $keyEnum */
                                            $keyEnum = $item['enum'];
                                            $typeEnum = $keyEnum->type();
                                            $rawValue = $item['value'];
                                            $mediaUrl = $item['media_url'];
                                            $isTranslatable = $keyEnum->isTranslatable();
                                            $isFullWidth = in_array($typeEnum, [\App\Enums\SettingTypeEnum::Textarea, \App\Enums\SettingTypeEnum::RichText, \App\Enums\SettingTypeEnum::Json], true) || $isTranslatable;
                                        @endphp

                                        <div class="{{ $isFullWidth ? 'col-12' : 'col-12 col-md-6' }}">
                                            <div class="setting-item-box">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <label class="form-label fw-bold text-gray-800 mb-0">
                                                        {{ $keyEnum->label() }}
                                                    </label>
                                                    <code class="text-muted fs-8">{{ $settingKey }}</code>
                                                </div>

                                                @if ($isTranslatable)
                                                    @php
                                                        $arVal = is_array($rawValue) ? ($rawValue['ar'] ?? '') : (string) $rawValue;
                                                        $enVal = is_array($rawValue) ? ($rawValue['en'] ?? '') : (string) $rawValue;
                                                    @endphp
                                                    <div class="row g-4">
                                                        <div class="col-12 col-lg-6">
                                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                                <span class="setting-lang-badge bg-light-primary text-primary">العربية (AR)</span>
                                                            </div>
                                                            @if ($typeEnum === \App\Enums\SettingTypeEnum::Textarea || $typeEnum === \App\Enums\SettingTypeEnum::RichText)
                                                                <textarea
                                                                    name="settings[{{ $settingKey }}][ar]"
                                                                    rows="3"
                                                                    dir="rtl"
                                                                    class="form-control form-control-solid"
                                                                >{{ old("settings.{$settingKey}.ar", $arVal) }}</textarea>
                                                            @else
                                                                <input
                                                                    type="text"
                                                                    name="settings[{{ $settingKey }}][ar]"
                                                                    dir="rtl"
                                                                    value="{{ old("settings.{$settingKey}.ar", $arVal) }}"
                                                                    class="form-control form-control-solid"
                                                                >
                                                            @endif
                                                        </div>

                                                        <div class="col-12 col-lg-6">
                                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                                <span class="setting-lang-badge bg-light-info text-info">English (EN)</span>
                                                            </div>
                                                            @if ($typeEnum === \App\Enums\SettingTypeEnum::Textarea || $typeEnum === \App\Enums\SettingTypeEnum::RichText)
                                                                <textarea
                                                                    name="settings[{{ $settingKey }}][en]"
                                                                    rows="3"
                                                                    dir="ltr"
                                                                    class="form-control form-control-solid"
                                                                >{{ old("settings.{$settingKey}.en", $enVal) }}</textarea>
                                                            @else
                                                                <input
                                                                    type="text"
                                                                    name="settings[{{ $settingKey }}][en]"
                                                                    dir="ltr"
                                                                    value="{{ old("settings.{$settingKey}.en", $enVal) }}"
                                                                    class="form-control form-control-solid"
                                                                >
                                                            @endif
                                                        </div>
                                                    </div>

                                                @elseif ($typeEnum === \App\Enums\SettingTypeEnum::Boolean)
                                                    @php
                                                        $boolChecked = filter_var(
                                                            is_array($rawValue) ? ($rawValue['value'] ?? false) : $rawValue,
                                                            FILTER_VALIDATE_BOOLEAN
                                                        );
                                                    @endphp
                                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                                        <input type="hidden" name="settings[{{ $settingKey }}]" value="0">
                                                        <input
                                                            class="form-check-input h-25px w-45px"
                                                            type="checkbox"
                                                            name="settings[{{ $settingKey }}]"
                                                            id="switch_{{ $settingKey }}"
                                                            value="1"
                                                            {{ $boolChecked ? 'checked' : '' }}
                                                        >
                                                        <label class="form-check-label fw-semibold text-gray-700 ms-3" for="switch_{{ $settingKey }}">
                                                            {{ app()->getLocale() === 'ar' ? 'مفعّل / معروض في الموقع' : 'Enabled / Visible on Portfolio' }}
                                                        </label>
                                                    </div>

                                                @elseif ($typeEnum === \App\Enums\SettingTypeEnum::Image)
                                                    @php
                                                        $currentImageUrl = $mediaUrl ?? (is_array($rawValue) ? ($rawValue['value'] ?? null) : $rawValue);
                                                    @endphp
                                                    <div class="d-flex flex-wrap align-items-center gap-4">
                                                        <div class="flex-grow-1">
                                                            <input
                                                                type="file"
                                                                name="files[{{ $settingKey }}]"
                                                                accept="image/*"
                                                                class="form-control form-control-solid"
                                                            >
                                                        </div>
                                                        @if (!empty($currentImageUrl))
                                                            <img src="{{ $currentImageUrl }}" alt="{{ $settingKey }}" class="media-preview-thumb">
                                                        @endif
                                                    </div>

                                                @elseif ($typeEnum === \App\Enums\SettingTypeEnum::File)
                                                    @php
                                                        $currentFileUrl = $mediaUrl ?? (is_array($rawValue) ? ($rawValue['value'] ?? null) : $rawValue);
                                                    @endphp
                                                    <div class="d-flex flex-wrap align-items-center gap-4">
                                                        <div class="flex-grow-1">
                                                            <input
                                                                type="file"
                                                                name="files[{{ $settingKey }}]"
                                                                accept=".pdf"
                                                                class="form-control form-control-solid"
                                                            >
                                                        </div>
                                                        @if (!empty($currentFileUrl))
                                                            <a href="{{ $currentFileUrl }}" target="_blank" class="btn btn-sm btn-light-primary">
                                                                <i class="fa-solid fa-file-pdf me-1"></i>
                                                                {{ app()->getLocale() === 'ar' ? 'عرض الملف الحالي' : 'View Current PDF' }}
                                                            </a>
                                                        @endif
                                                    </div>

                                                @elseif ($typeEnum === \App\Enums\SettingTypeEnum::Json)
                                                    @php
                                                        $jsonString = is_array($rawValue)
                                                            ? json_encode($rawValue, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                                                            : (string) $rawValue;
                                                    @endphp
                                                    <textarea
                                                        name="settings[{{ $settingKey }}]"
                                                        rows="6"
                                                        dir="ltr"
                                                        class="form-control form-control-solid font-monospace fs-7"
                                                    >{{ old("settings.{$settingKey}", $jsonString) }}</textarea>

                                                @else
                                                    @php
                                                        $scalarValue = is_array($rawValue) ? ($rawValue['value'] ?? '') : (string) $rawValue;
                                                        $inputType = match ($typeEnum) {
                                                            \App\Enums\SettingTypeEnum::Email => 'email',
                                                            \App\Enums\SettingTypeEnum::Url => 'url',
                                                            default => 'text',
                                                        };
                                                    @endphp
                                                    <input
                                                        type="{{ $inputType }}"
                                                        name="settings[{{ $settingKey }}]"
                                                        dir="ltr"
                                                        value="{{ old("settings.{$settingKey}", $scalarValue) }}"
                                                        class="form-control form-control-solid"
                                                    >
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end py-5 px-6 border-top">
                    <button type="submit" class="btn btn-primary px-8">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        {{ app()->getLocale() === 'ar' ? 'حفظ جميع الإعدادات' : 'Save Portfolio Settings' }}
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@push('admin_js')
<script>
    document.querySelectorAll('#portfolioSettingsTabs button[data-group-key]').forEach(function (tabButton) {
        tabButton.addEventListener('shown.bs.tab', function (event) {
            var groupKey = event.target.getAttribute('data-group-key');
            var activeInput = document.getElementById('activeGroupInput');
            if (activeInput && groupKey) {
                activeInput.value = groupKey;
            }
        });
    });
</script>
@endpush
