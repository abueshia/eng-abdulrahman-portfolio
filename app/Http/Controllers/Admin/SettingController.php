<?php

/**
 * Admin SettingController
 *
 * Thin controller managing the tabbed Dynamic Portfolio Settings UI
 * (General, Hero & CV, About, Contact & Social, SEO, Sections Visibility, CTA).
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\SettingGroupEnum;
use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\UpdateSettingRequest;
use App\Services\SettingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(
        private readonly SettingService $settingService
    ) {
        $this->middleware(['auth:admin', 'permission:all_settings.view_all'], ['only' => ['all_settings']]);
        $this->middleware(['auth:admin', 'permission:mainSetting.edit|all_settings.view_all'], ['only' => ['update']]);
    }

    /**
     * Display the tabbed Dynamic Portfolio Settings page.
     */
    public function all_settings(Request $request): View
    {
        $tabs = $this->settingService->getDashboardTabsData();
        $requestedGroup = (string) $request->query('group', SettingGroupEnum::General->value);
        $activeGroup = array_key_exists($requestedGroup, $tabs)
            ? $requestedGroup
            : SettingGroupEnum::General->value;

        return view('admin.pages.setting.index', compact('tabs', 'activeGroup'));
    }

    /**
     * Update portfolio settings and uploaded media files.
     */
    public function update(UpdateSettingRequest $request): RedirectResponse
    {
        $dto = $request->toDto();
        $this->settingService->updateSettings($dto);

        session()->flash(
            'success',
            TranslationHelper::translate('Settings updated successfully')
        );

        return redirect()->route('admin.all_settings.index', [
            'group' => $dto->activeGroup ?? SettingGroupEnum::General->value,
        ]);
    }
}
