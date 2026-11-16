<?php

/**
 * API TechnologyController
 *
 * Read-only REST API controller for technical stack and skills, grouped by category.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Enums\TechnologyCategoryEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\TechnologyResource;
use App\Services\TechnologyService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly TechnologyService $technologyService,
    ) {}

    /**
     * List active technologies grouped by TechnologyCategoryEnum (or filtered by category).
     */
    public function index(Request $request): JsonResponse
    {
        $categoryFilter = $request->query('category');
        if (is_string($categoryFilter) && $categoryFilter !== '') {
            $categoryEnum = TechnologyCategoryEnum::tryFrom($categoryFilter);
            if ($categoryEnum === null) {
                return $this->success_response([], 'Technologies retrieved successfully');
            }

            $items = $this->technologyService->getActive($categoryEnum);

            return $this->success_response([
                $categoryEnum->value => [
                    'category' => $categoryEnum->value,
                    'label' => $categoryEnum->label(),
                    'items' => TechnologyResource::collection($items)->resolve($request),
                ],
            ], 'Technologies retrieved successfully');
        }

        $grouped = [];
        foreach ($this->technologyService->getGroupedByCategory() as $categoryKey => $items) {
            $categoryEnum = TechnologyCategoryEnum::tryFrom((string) $categoryKey);
            $grouped[(string) $categoryKey] = [
                'category' => (string) $categoryKey,
                'label' => $categoryEnum?->label() ?? (string) $categoryKey,
                'items' => TechnologyResource::collection($items)->resolve($request),
            ];
        }

        return $this->success_response($grouped, 'Technologies retrieved successfully');
    }
}

