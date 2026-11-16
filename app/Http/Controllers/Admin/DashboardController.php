<?php

/**
 * Admin DashboardController
 *
 * Thin Admin Controller that renders the main Portfolio CMS dashboard.
 * Delegates all KPI aggregation, recent item lookups, and chart series
 * computation to DashboardStatisticsService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardStatisticsService;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private readonly DashboardStatisticsService $dashboardStatisticsService,
    ) {
        $this->middleware('auth:admin');
    }

    /**
     * Render the main admin dashboard with portfolio statistics, recent items, and 6-month chart.
     */
    public function index(): View
    {
        $dashboardData = $this->dashboardStatisticsService->getDashboardData();

        return view('admin.index', $dashboardData);
    }
}
