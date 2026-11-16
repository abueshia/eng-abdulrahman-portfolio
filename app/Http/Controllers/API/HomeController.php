<?php

/**
 * API HomeController
 *
 * Aggregated read-only endpoint for the standalone React portfolio landing page.
 * Respects dynamic section visibility settings and leverages PortfolioCache.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Enums\SettingKeyEnum;
use App\Enums\TechnologyCategoryEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\BlogResource;
use App\Http\Resources\UserApp\CredentialResource;
use App\Http\Resources\UserApp\ExperienceResource;
use App\Http\Resources\UserApp\FaqResource;
use App\Http\Resources\UserApp\ProjectResource;
use App\Http\Resources\UserApp\ServiceResource;
use App\Http\Resources\UserApp\SettingResource;
use App\Http\Resources\UserApp\StatResource;
use App\Http\Resources\UserApp\TechnologyResource;
use App\Http\Resources\UserApp\TestimonialResource;
use App\Services\BlogService;
use App\Services\CredentialService;
use App\Services\ExperienceService;
use App\Services\FaqService;
use App\Services\ProjectService;
use App\Services\ServiceCatalogService;
use App\Services\SettingService;
use App\Services\StatService;
use App\Services\TechnologyService;
use App\Services\TestimonialService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly SettingService $settingService,
        private readonly StatService $statService,
        private readonly ServiceCatalogService $serviceCatalogService,
        private readonly ProjectService $projectService,
        private readonly TechnologyService $technologyService,
        private readonly ExperienceService $experienceService,
        private readonly CredentialService $credentialService,
        private readonly TestimonialService $testimonialService,
        private readonly BlogService $blogService,
        private readonly FaqService $faqService,
    ) {}

    /**
     * Return the aggregated home page payload for the active locale.
     */
    public function index(Request $request): JsonResponse
    {
        $locale = app()->getLocale();
        $publicSettings = $this->settingService->getPublicSettings($locale);

        $groupedTech = [];
        if ($this->settingService->isSectionVisible(SettingKeyEnum::ShowTechnologiesSection)) {
            foreach ($this->technologyService->getGroupedByCategory() as $categoryKey => $items) {
                $catEnum = TechnologyCategoryEnum::tryFrom((string) $categoryKey);
                $groupedTech[(string) $categoryKey] = [
                    'category' => (string) $categoryKey,
                    'label' => $catEnum?->label() ?? (string) $categoryKey,
                    'items' => TechnologyResource::collection($items)->resolve($request),
                ];
            }
        }

        $payload = [
            'settings' => (new SettingResource($publicSettings))->resolve($request),
            'stats' => $this->settingService->isSectionVisible(SettingKeyEnum::ShowStatsSection)
                ? StatResource::collection($this->statService->getActive())->resolve($request)
                : [],
            'services' => $this->settingService->isSectionVisible(SettingKeyEnum::ShowServicesSection)
                ? ServiceResource::collection($this->serviceCatalogService->getActive())->resolve($request)
                : [],
            'featured_projects' => $this->settingService->isSectionVisible(SettingKeyEnum::ShowProjectsSection)
                ? ProjectResource::collection($this->projectService->getFeatured(6))->resolve($request)
                : [],
            'technologies' => $groupedTech,
            'experiences' => $this->settingService->isSectionVisible(SettingKeyEnum::ShowExperiencesSection)
                ? ExperienceResource::collection($this->experienceService->getActiveTimeline())->resolve($request)
                : [],
            'credentials' => $this->settingService->isSectionVisible(SettingKeyEnum::ShowCredentialsSection)
                ? CredentialResource::collection($this->credentialService->getActive())->resolve($request)
                : [],
            'testimonials' => $this->settingService->isSectionVisible(SettingKeyEnum::ShowTestimonialsSection)
                ? TestimonialResource::collection($this->testimonialService->getActive(6))->resolve($request)
                : [],
            'latest_blogs' => $this->settingService->isSectionVisible(SettingKeyEnum::ShowBlogsSection)
                ? BlogResource::collection($this->blogService->getFeatured(3))->resolve($request)
                : [],
            'faqs' => $this->settingService->isSectionVisible(SettingKeyEnum::ShowFaqsSection)
                ? FaqResource::collection($this->faqService->getActive())->resolve($request)
                : [],
        ];

        return $this->success_response($payload, 'Home portfolio data retrieved successfully');
    }
}

