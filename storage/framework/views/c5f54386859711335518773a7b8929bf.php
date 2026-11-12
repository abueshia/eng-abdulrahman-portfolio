<?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('General Settings')); ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [['text' => \App\Helpers\TranslationHelper::translate('General Settings')]],'button' => [],'title' => \App\Helpers\TranslationHelper::translate('General Settings')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bread-crumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\BreadCrumb::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2072a121b282e859e8bdea9c58b76d8)): ?>
<?php $attributes = $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8; ?>
<?php unset($__attributesOriginalc2072a121b282e859e8bdea9c58b76d8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2072a121b282e859e8bdea9c58b76d8)): ?>
<?php $component = $__componentOriginalc2072a121b282e859e8bdea9c58b76d8; ?>
<?php unset($__componentOriginalc2072a121b282e859e8bdea9c58b76d8); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('admin_css'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">

        <?php if(session('success')): ?>
            <div class="alert alert-success d-flex align-items-center p-4 mb-6 rounded-3">
                <i class="fa-solid fa-circle-check fs-2hx text-success me-3"></i>
                <div class="fw-semibold"><?php echo e(session('success')); ?></div>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger p-4 mb-6 rounded-3">
                <div class="fw-bold mb-2"><?php echo e(\App\Helpers\TranslationHelper::translate('Please check the submitted fields:')); ?></div>
                <ul class="mb-0 ps-4">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card portfolio-settings-card">
            <div class="card-header border-0 pt-6 pb-2 px-6">
                <ul class="nav nav-pills portfolio-settings-tabs w-100" id="portfolioSettingsTabs" role="tablist">
                    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupKey => $tabData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            /** @var \App\Enums\SettingGroupEnum $groupEnum */
                            $groupEnum = $tabData['group'];
                            $isActive = $activeGroup === $groupKey;
                        ?>
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link <?php echo e($isActive ? 'active' : ''); ?>"
                                id="tab-btn-<?php echo e($groupKey); ?>"
                                data-bs-toggle="pill"
                                data-bs-target="#tab-pane-<?php echo e($groupKey); ?>"
                                data-group-key="<?php echo e($groupKey); ?>"
                                type="button"
                                role="tab"
                                aria-controls="tab-pane-<?php echo e($groupKey); ?>"
                                aria-selected="<?php echo e($isActive ? 'true' : 'false'); ?>"
                            >
                                <i class="<?php echo e($groupEnum->icon()); ?>"></i>
                                <span><?php echo e($groupEnum->label()); ?></span>
                            </button>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <form action="<?php echo e(route('admin.all_settings.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="active_group" id="activeGroupInput" value="<?php echo e($activeGroup); ?>">

                <div class="card-body px-6 py-6">
                    <div class="tab-content" id="portfolioSettingsTabContent">
                        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupKey => $tabData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                /** @var \App\Enums\SettingGroupEnum $groupEnum */
                                $groupEnum = $tabData['group'];
                                $isActive = $activeGroup === $groupKey;
                            ?>
                            <div
                                class="tab-pane fade <?php echo e($isActive ? 'show active' : ''); ?>"
                                id="tab-pane-<?php echo e($groupKey); ?>"
                                role="tabpanel"
                                aria-labelledby="tab-btn-<?php echo e($groupKey); ?>"
                            >
                                <div class="d-flex flex-wrap align-items-center justify-content-between mb-6 pb-3 border-bottom">
                                    <div>
                                        <h3 class="fw-bold text-gray-900 mb-1">
                                            <i class="<?php echo e($groupEnum->icon()); ?> text-primary me-2"></i>
                                            <?php echo e($groupEnum->label()); ?>

                                        </h3>
                                        <span class="text-muted fs-7">
                                            <?php echo e(app()->getLocale() === 'ar'
                                                ? 'إدارة إعدادات البورتفوليو باللغتين العربية والإنجليزية مع تحديث تلقائي للكاش.'
                                                : 'Manage bilingual portfolio settings with automatic cache invalidation.'); ?>

                                        </span>
                                    </div>
                                </div>

                                <div class="row g-5">
                                    <?php $__currentLoopData = $tabData['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $settingKey => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            /** @var \App\Enums\SettingKeyEnum $keyEnum */
                                            $keyEnum = $item['enum'];
                                            $typeEnum = $keyEnum->type();
                                            $rawValue = $item['value'];
                                            $mediaUrl = $item['media_url'];
                                            $isTranslatable = $keyEnum->isTranslatable();
                                            $isFullWidth = in_array($typeEnum, [\App\Enums\SettingTypeEnum::Textarea, \App\Enums\SettingTypeEnum::RichText, \App\Enums\SettingTypeEnum::Json], true) || $isTranslatable;
                                        ?>

                                        <div class="<?php echo e($isFullWidth ? 'col-12' : 'col-12 col-md-6'); ?>">
                                            <div class="setting-item-box">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <label class="form-label fw-bold text-gray-800 mb-0">
                                                        <?php echo e($keyEnum->label()); ?>

                                                    </label>
                                                    <code class="text-muted fs-8"><?php echo e($settingKey); ?></code>
                                                </div>

                                                <?php if($isTranslatable): ?>
                                                    <?php
                                                        $arVal = is_array($rawValue) ? ($rawValue['ar'] ?? '') : (string) $rawValue;
                                                        $enVal = is_array($rawValue) ? ($rawValue['en'] ?? '') : (string) $rawValue;
                                                    ?>
                                                    <div class="row g-4">
                                                        <div class="col-12 col-lg-6">
                                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                                <span class="setting-lang-badge bg-light-primary text-primary">العربية (AR)</span>
                                                            </div>
                                                            <?php if($typeEnum === \App\Enums\SettingTypeEnum::Textarea || $typeEnum === \App\Enums\SettingTypeEnum::RichText): ?>
                                                                <textarea
                                                                    name="settings[<?php echo e($settingKey); ?>][ar]"
                                                                    rows="3"
                                                                    dir="rtl"
                                                                    class="form-control form-control-solid"
                                                                ><?php echo e(old("settings.{$settingKey}.ar", $arVal)); ?></textarea>
                                                            <?php else: ?>
                                                                <input
                                                                    type="text"
                                                                    name="settings[<?php echo e($settingKey); ?>][ar]"
                                                                    dir="rtl"
                                                                    value="<?php echo e(old("settings.{$settingKey}.ar", $arVal)); ?>"
                                                                    class="form-control form-control-solid"
                                                                >
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="col-12 col-lg-6">
                                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                                <span class="setting-lang-badge bg-light-info text-info">English (EN)</span>
                                                            </div>
                                                            <?php if($typeEnum === \App\Enums\SettingTypeEnum::Textarea || $typeEnum === \App\Enums\SettingTypeEnum::RichText): ?>
                                                                <textarea
                                                                    name="settings[<?php echo e($settingKey); ?>][en]"
                                                                    rows="3"
                                                                    dir="ltr"
                                                                    class="form-control form-control-solid"
                                                                ><?php echo e(old("settings.{$settingKey}.en", $enVal)); ?></textarea>
                                                            <?php else: ?>
                                                                <input
                                                                    type="text"
                                                                    name="settings[<?php echo e($settingKey); ?>][en]"
                                                                    dir="ltr"
                                                                    value="<?php echo e(old("settings.{$settingKey}.en", $enVal)); ?>"
                                                                    class="form-control form-control-solid"
                                                                >
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                <?php elseif($typeEnum === \App\Enums\SettingTypeEnum::Boolean): ?>
                                                    <?php
                                                        $boolChecked = filter_var(
                                                            is_array($rawValue) ? ($rawValue['value'] ?? false) : $rawValue,
                                                            FILTER_VALIDATE_BOOLEAN
                                                        );
                                                    ?>
                                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                                        <input type="hidden" name="settings[<?php echo e($settingKey); ?>]" value="0">
                                                        <input
                                                            class="form-check-input h-25px w-45px"
                                                            type="checkbox"
                                                            name="settings[<?php echo e($settingKey); ?>]"
                                                            id="switch_<?php echo e($settingKey); ?>"
                                                            value="1"
                                                            <?php echo e($boolChecked ? 'checked' : ''); ?>

                                                        >
                                                        <label class="form-check-label fw-semibold text-gray-700 ms-3" for="switch_<?php echo e($settingKey); ?>">
                                                            <?php echo e(app()->getLocale() === 'ar' ? 'مفعّل / معروض في الموقع' : 'Enabled / Visible on Portfolio'); ?>

                                                        </label>
                                                    </div>

                                                <?php elseif($typeEnum === \App\Enums\SettingTypeEnum::Image): ?>
                                                    <?php
                                                        $currentImageUrl = $mediaUrl ?? (is_array($rawValue) ? ($rawValue['value'] ?? null) : $rawValue);
                                                    ?>
                                                    <div class="d-flex flex-wrap align-items-center gap-4">
                                                        <div class="flex-grow-1">
                                                            <input
                                                                type="file"
                                                                name="files[<?php echo e($settingKey); ?>]"
                                                                accept="image/*"
                                                                class="form-control form-control-solid"
                                                            >
                                                        </div>
                                                        <?php if(!empty($currentImageUrl)): ?>
                                                            <img src="<?php echo e($currentImageUrl); ?>" alt="<?php echo e($settingKey); ?>" class="media-preview-thumb">
                                                        <?php endif; ?>
                                                    </div>

                                                <?php elseif($typeEnum === \App\Enums\SettingTypeEnum::File): ?>
                                                    <?php
                                                        $currentFileUrl = $mediaUrl ?? (is_array($rawValue) ? ($rawValue['value'] ?? null) : $rawValue);
                                                    ?>
                                                    <div class="d-flex flex-wrap align-items-center gap-4">
                                                        <div class="flex-grow-1">
                                                            <input
                                                                type="file"
                                                                name="files[<?php echo e($settingKey); ?>]"
                                                                accept=".pdf"
                                                                class="form-control form-control-solid"
                                                            >
                                                        </div>
                                                        <?php if(!empty($currentFileUrl)): ?>
                                                            <a href="<?php echo e($currentFileUrl); ?>" target="_blank" class="btn btn-sm btn-light-primary">
                                                                <i class="fa-solid fa-file-pdf me-1"></i>
                                                                <?php echo e(app()->getLocale() === 'ar' ? 'عرض الملف الحالي' : 'View Current PDF'); ?>

                                                            </a>
                                                        <?php endif; ?>
                                                    </div>

                                                <?php elseif($typeEnum === \App\Enums\SettingTypeEnum::Json): ?>
                                                    <?php
                                                        $jsonString = is_array($rawValue)
                                                            ? json_encode($rawValue, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
                                                            : (string) $rawValue;
                                                    ?>
                                                    <textarea
                                                        name="settings[<?php echo e($settingKey); ?>]"
                                                        rows="6"
                                                        dir="ltr"
                                                        class="form-control form-control-solid font-monospace fs-7"
                                                    ><?php echo e(old("settings.{$settingKey}", $jsonString)); ?></textarea>

                                                <?php else: ?>
                                                    <?php
                                                        $scalarValue = is_array($rawValue) ? ($rawValue['value'] ?? '') : (string) $rawValue;
                                                        $inputType = match ($typeEnum) {
                                                            \App\Enums\SettingTypeEnum::Email => 'email',
                                                            \App\Enums\SettingTypeEnum::Url => 'url',
                                                            default => 'text',
                                                        };
                                                    ?>
                                                    <input
                                                        type="<?php echo e($inputType); ?>"
                                                        name="settings[<?php echo e($settingKey); ?>]"
                                                        dir="ltr"
                                                        value="<?php echo e(old("settings.{$settingKey}", $scalarValue)); ?>"
                                                        class="form-control form-control-solid"
                                                    >
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end py-5 px-6 border-top">
                    <button type="submit" class="btn btn-primary px-8">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        <?php echo e(app()->getLocale() === 'ar' ? 'حفظ جميع الإعدادات' : 'Save Portfolio Settings'); ?>

                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('admin_js'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/pages/setting/index.blade.php ENDPATH**/ ?>