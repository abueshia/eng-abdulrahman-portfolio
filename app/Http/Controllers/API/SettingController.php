<?php

/**
 * API SettingController
 *
 * Exposes public, read-only portfolio settings resolved for the active request locale
 * while respecting sections_visibility flags.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\SettingResource;
use App\Services\SettingService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly SettingService $settingService,
    ) {}

    /**
     * Retrieve public portfolio settings for the current locale.
     */
    public function index(): JsonResponse
    {
        $settings = $this->settingService->getPublicSettings(app()->getLocale());

        return $this->success_response(
            new SettingResource($settings),
            'Settings retrieved successfully'
        );
    }
}

