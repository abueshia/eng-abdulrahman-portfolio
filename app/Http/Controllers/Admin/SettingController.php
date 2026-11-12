<?php

/**
 * Admin SettingController
 *
 * Handles portfolio configuration and dynamic settings in the admin dashboard.
 * Full SettingService and tabbed dynamic settings will be wired in Phase 3.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class SettingController extends Controller
{
    /**
     * Display the main settings overview page.
     */
    public function all_settings(): View
    {
        return view('admin.pages.setting.all_settings');
    }
}
