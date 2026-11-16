<?php

/**
 * DashboardStatisticsService
 *
 * Aggregates portfolio KPIs, recent projects, recent contact messages,
 * and 6-month message trend chart data for the Admin Dashboard without
 * exposing any Eloquent queries to controllers or Blade templates.
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\ContactMessage;
use App\Models\Project;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use App\Repositories\Contracts\CredentialRepositoryInterface;
use App\Repositories\Contracts\ExperienceRepositoryInterface;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Repositories\Contracts\TechnologyRepositoryInterface;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DashboardStatisticsService
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly TechnologyRepositoryInterface $technologyRepository,
        private readonly BlogRepositoryInterface $blogRepository,
        private readonly ContactMessageRepositoryInterface $contactMessageRepository,
        private readonly ExperienceRepositoryInterface $experienceRepository,
        private readonly CredentialRepositoryInterface $credentialRepository,
        private readonly ServiceRepositoryInterface $serviceRepository,
        private readonly TestimonialRepositoryInterface $testimonialRepository,
    ) {}

    /**
     * Collect all KPI counters, recent records, and chart series for the Admin Dashboard.
     *
     * @return array{
     *     stats: array{
     *         projects_total: int,
     *         projects_published: int,
     *         technologies_total: int,
     *         blogs_total: int,
     *         unread_messages: int,
     *         total_messages: int,
     *         experiences_total: int,
     *         credentials_total: int,
     *         services_total: int,
     *         testimonials_total: int
     *     },
     *     latestMessages: Collection<int, ContactMessage>,
     *     latestProjects: Collection<int, Project>,
     *     messagesMonthlyChart: array{
     *         labels: array<int, string>,
     *         counts: array<int, int>,
     *         series: array<int, array{month: string, label: string, count: int}>
     *     },
     *     messagesByStatus: array<string, int>
     * }
     */
    public function getDashboardData(int $latestLimit = 5, int $chartMonths = 6): array
    {
        return [
            'stats' => [
                'projects_total' => $this->projectRepository->count(),
                'projects_published' => $this->projectRepository->getPublished()->count(),
                'technologies_total' => $this->technologyRepository->count(),
                'blogs_total' => $this->blogRepository->count(),
                'unread_messages' => $this->contactMessageRepository->countUnread(),
                'total_messages' => $this->contactMessageRepository->count(),
                'experiences_total' => $this->experienceRepository->count(),
                'credentials_total' => $this->credentialRepository->count(),
                'services_total' => $this->serviceRepository->count(),
                'testimonials_total' => $this->testimonialRepository->count(),
            ],
            'latestMessages' => $this->contactMessageRepository->getLatest($latestLimit),
            'latestProjects' => $this->projectRepository->getLatestForAdmin($latestLimit),
            'messagesMonthlyChart' => $this->contactMessageRepository->countByLastMonths($chartMonths),
            'messagesByStatus' => $this->contactMessageRepository->countByStatus(),
        ];
    }
}
