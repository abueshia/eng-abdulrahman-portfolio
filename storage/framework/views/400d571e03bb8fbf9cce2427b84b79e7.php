<?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Dashboard')); ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [['text' => \App\Helpers\TranslationHelper::translate('Dashboard')]],'button' => [],'title' => \App\Helpers\TranslationHelper::translate('Dashboard')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

<?php $__env->startSection('content'); ?>
    <?php
        $kpi = $stats ?? [];
        $chartSeries = $messagesMonthlyChart['series'] ?? [];
        $maxChartCount = max(1, ...(array_column($chartSeries, 'count') ?: [1]));
    ?>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!--begin::Primary KPI Stat Cards-->
            <div class="row g-5 mb-7" data-testid="dashboard-kpi-cards">
                <!--begin::Projects Card-->
                <div class="col-xxl-3 col-xl-4 col-md-6">
                    <div class="cms-kpi-card">
                        <div>
                            <div class="cms-kpi-label"><?php echo e(\App\Helpers\TranslationHelper::translate('Projects')); ?></div>
                            <div class="cms-kpi-value" data-testid="kpi-projects-total"><?php echo e($kpi['projects_total'] ?? 0); ?></div>
                            <div class="cms-kpi-sub">
                                <span class="text-success fw-bold"><?php echo e($kpi['projects_published'] ?? 0); ?></span>
                                <?php echo e(\App\Helpers\TranslationHelper::translate('Published')); ?>

                            </div>
                        </div>
                        <div class="cms-kpi-icon" style="background: var(--portfolio-primary-soft); color: var(--portfolio-primary);">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                    </div>
                </div>
                <!--end::Projects Card-->

                <!--begin::Technologies Card-->
                <div class="col-xxl-2 col-xl-4 col-md-6">
                    <div class="cms-kpi-card">
                        <div>
                            <div class="cms-kpi-label"><?php echo e(\App\Helpers\TranslationHelper::translate('Technologies')); ?></div>
                            <div class="cms-kpi-value" data-testid="kpi-technologies-total"><?php echo e($kpi['technologies_total'] ?? 0); ?></div>
                            <div class="cms-kpi-sub"><?php echo e(\App\Helpers\TranslationHelper::translate('Technical Stack')); ?></div>
                        </div>
                        <div class="cms-kpi-icon" style="background: var(--portfolio-emerald-soft); color: var(--portfolio-emerald);">
                            <i class="fas fa-microchip"></i>
                        </div>
                    </div>
                </div>
                <!--end::Technologies Card-->

                <!--begin::Experiences Card-->
                <div class="col-xxl-2 col-xl-4 col-md-6">
                    <div class="cms-kpi-card">
                        <div>
                            <div class="cms-kpi-label"><?php echo e(\App\Helpers\TranslationHelper::translate('Experiences')); ?></div>
                            <div class="cms-kpi-value" data-testid="kpi-experiences-total"><?php echo e($kpi['experiences_total'] ?? 0); ?></div>
                            <div class="cms-kpi-sub"><?php echo e(\App\Helpers\TranslationHelper::translate('Career Timeline')); ?></div>
                        </div>
                        <div class="cms-kpi-icon" style="background: var(--portfolio-violet-soft); color: var(--portfolio-violet);">
                            <i class="fas fa-briefcase"></i>
                        </div>
                    </div>
                </div>
                <!--end::Experiences Card-->

                <!--begin::Blogs Card-->
                <div class="col-xxl-2 col-xl-6 col-md-6">
                    <div class="cms-kpi-card">
                        <div>
                            <div class="cms-kpi-label"><?php echo e(\App\Helpers\TranslationHelper::translate('Blogs')); ?></div>
                            <div class="cms-kpi-value" data-testid="kpi-blogs-total"><?php echo e($kpi['blogs_total'] ?? 0); ?></div>
                            <div class="cms-kpi-sub"><?php echo e(\App\Helpers\TranslationHelper::translate('Technical Articles')); ?></div>
                        </div>
                        <div class="cms-kpi-icon" style="background: var(--portfolio-amber-soft); color: var(--portfolio-amber);">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                </div>
                <!--end::Blogs Card-->

                <!--begin::Unread Contact Messages Card-->
                <div class="col-xxl-3 col-xl-6 col-md-12">
                    <div class="cms-kpi-card">
                        <div>
                            <div class="cms-kpi-label"><?php echo e(\App\Helpers\TranslationHelper::translate('Unread Messages')); ?></div>
                            <div class="cms-kpi-value" data-testid="kpi-unread-messages"><?php echo e($kpi['unread_messages'] ?? 0); ?></div>
                            <div class="cms-kpi-sub">
                                <?php echo e(\App\Helpers\TranslationHelper::translate('Total Messages')); ?>:
                                <span class="fw-bold text-gray-800"><?php echo e($kpi['total_messages'] ?? 0); ?></span>
                            </div>
                        </div>
                        <div class="cms-kpi-icon" style="background: var(--portfolio-rose-soft); color: var(--portfolio-rose);">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                    </div>
                </div>
                <!--end::Unread Contact Messages Card-->
            </div>
            <!--end::Primary KPI Stat Cards-->

            <!--begin::6-Month Messages Chart & Secondary Summary-->
            <div class="row g-5 mb-7">
                <!--begin::6-Month Contact Messages Chart-->
                <div class="col-xl-8">
                    <div class="card card-flush h-100 shadow-sm">
                        <div class="card-header pt-6">
                            <div class="card-title flex-column">
                                <h3 class="fw-bold mb-1 text-gray-900">
                                    <?php echo e(\App\Helpers\TranslationHelper::translate('Messages Over the Last 6 Months')); ?>

                                </h3>
                                <span class="fs-7 fw-semibold text-muted">
                                    <?php echo e(\App\Helpers\TranslationHelper::translate('Monthly breakdown of incoming contact messages and project inquiries')); ?>

                                </span>
                            </div>
                            <?php if(auth()->guard('admin')->user()?->can('messages.view_all', 'admin')): ?>
                                <div class="card-toolbar">
                                    <a href="<?php echo e(route('admin.message.index')); ?>" class="btn btn-sm btn-light-primary">
                                        <?php echo e(\App\Helpers\TranslationHelper::translate('View All Messages')); ?>

                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body pt-4">
                            <div class="cms-chart-wrapper" data-testid="messages-monthly-chart">
                                <?php $__currentLoopData = $chartSeries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $barCount = (int) ($point['count'] ?? 0);
                                        $heightPercent = $barCount > 0
                                            ? max(12, (int) round(($barCount / $maxChartCount) * 100))
                                            : 6;
                                    ?>
                                    <div class="cms-chart-col" data-month="<?php echo e($point['month'] ?? ''); ?>">
                                        <span class="cms-chart-count"><?php echo e($barCount); ?></span>
                                        <div class="cms-chart-bar-track">
                                            <div class="cms-chart-bar-fill" style="height: <?php echo e($heightPercent); ?>%;"></div>
                                        </div>
                                        <span class="cms-chart-label"><?php echo e($point['label'] ?? ''); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::6-Month Contact Messages Chart-->

                <!--begin::Portfolio Overview Summary-->
                <div class="col-xl-4">
                    <div class="card card-flush h-100 shadow-sm">
                        <div class="card-header pt-6">
                            <div class="card-title flex-column">
                                <h3 class="fw-bold mb-1 text-gray-900">
                                    <?php echo e(\App\Helpers\TranslationHelper::translate('Portfolio Overview')); ?>

                                </h3>
                                <span class="fs-7 fw-semibold text-muted">
                                    <?php echo e(\App\Helpers\TranslationHelper::translate('Additional modules summary')); ?>

                                </span>
                            </div>
                        </div>
                        <div class="card-body pt-4 d-flex flex-column justify-content-center gap-4">
                            <div class="d-flex align-items-center justify-content-between p-3 rounded bg-light">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="badge badge-light-primary p-3">
                                        <i class="fas fa-layer-group text-primary fs-5"></i>
                                    </span>
                                    <span class="fw-bold text-gray-800"><?php echo e(\App\Helpers\TranslationHelper::translate('Services')); ?></span>
                                </div>
                                <span class="badge badge-primary fs-6 fw-bolder"><?php echo e($kpi['services_total'] ?? 0); ?></span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between p-3 rounded bg-light">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="badge badge-light-success p-3">
                                        <i class="fas fa-graduation-cap text-success fs-5"></i>
                                    </span>
                                    <span class="fw-bold text-gray-800"><?php echo e(\App\Helpers\TranslationHelper::translate('Credentials')); ?></span>
                                </div>
                                <span class="badge badge-success fs-6 fw-bolder"><?php echo e($kpi['credentials_total'] ?? 0); ?></span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between p-3 rounded bg-light">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="badge badge-light-warning p-3">
                                        <i class="fas fa-star text-warning fs-5"></i>
                                    </span>
                                    <span class="fw-bold text-gray-800"><?php echo e(\App\Helpers\TranslationHelper::translate('Testimonials')); ?></span>
                                </div>
                                <span class="badge badge-warning fs-6 fw-bolder"><?php echo e($kpi['testimonials_total'] ?? 0); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portfolio Overview Summary-->
            </div>
            <!--end::6-Month Messages Chart & Secondary Summary-->

            <!--begin::Latest Projects & Latest Messages Tables-->
            <div class="row g-5">
                <!--begin::Latest Projects-->
                <div class="col-xl-6">
                    <div class="card card-flush h-100 shadow-sm">
                        <div class="card-header pt-6">
                            <div class="card-title">
                                <h3 class="fw-bold text-gray-900">
                                    <?php echo e(\App\Helpers\TranslationHelper::translate('Latest Projects')); ?>

                                </h3>
                            </div>
                            <?php if(auth()->guard('admin')->user()?->can('projects.view_all', 'admin')): ?>
                                <div class="card-toolbar">
                                    <a href="<?php echo e(route('admin.project.index')); ?>" class="btn btn-sm btn-light-primary">
                                        <?php echo e(\App\Helpers\TranslationHelper::translate('View All')); ?>

                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body pt-3">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-4" data-testid="latest-projects-table">
                                    <thead>
                                        <tr class="text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Title')); ?></th>
                                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Project Type')); ?></th>
                                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Status')); ?></th>
                                            <th class="text-end"><?php echo e(\App\Helpers\TranslationHelper::translate('Actions')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-700">
                                        <?php $__empty_1 = true; $__currentLoopData = $latestProjects ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-gray-900 fw-bold"><?php echo e($project->title); ?></span>
                                                        <?php if($project->category): ?>
                                                            <span class="text-muted fs-8"><?php echo e($project->category->name); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php if($project->project_type): ?>
                                                        <span class="badge badge-light-<?php echo e($project->project_type->color()); ?>">
                                                            <?php echo e($project->project_type->label()); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($project->status): ?>
                                                        <span class="badge badge-light-<?php echo e($project->status->color()); ?>">
                                                            <?php echo e($project->status->label()); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-end">
                                                    <?php if(auth()->guard('admin')->user()?->can('projects.view_details', 'admin')): ?>
                                                        <a href="<?php echo e(route('admin.project.show', $project->id)); ?>"
                                                           class="btn btn-sm btn-icon btn-light btn-active-light-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-6">
                                                    <?php echo e(\App\Helpers\TranslationHelper::translate('No projects found')); ?>

                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Latest Projects-->

                <!--begin::Latest Contact Messages-->
                <div class="col-xl-6">
                    <div class="card card-flush h-100 shadow-sm">
                        <div class="card-header pt-6">
                            <div class="card-title">
                                <h3 class="fw-bold text-gray-900">
                                    <?php echo e(\App\Helpers\TranslationHelper::translate('Latest Contact Messages')); ?>

                                </h3>
                            </div>
                            <?php if(auth()->guard('admin')->user()?->can('messages.view_all', 'admin')): ?>
                                <div class="card-toolbar">
                                    <a href="<?php echo e(route('admin.message.index')); ?>" class="btn btn-sm btn-light-primary">
                                        <?php echo e(\App\Helpers\TranslationHelper::translate('View All')); ?>

                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body pt-3">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-4" data-testid="latest-messages-table">
                                    <thead>
                                        <tr class="text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Sender')); ?></th>
                                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Type')); ?></th>
                                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Status')); ?></th>
                                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Date')); ?></th>
                                            <th class="text-end"><?php echo e(\App\Helpers\TranslationHelper::translate('Actions')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-700">
                                        <?php $__empty_1 = true; $__currentLoopData = $latestMessages ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-gray-900 fw-bold"><?php echo e($msg->name); ?></span>
                                                        <span class="text-muted fs-8" dir="ltr"><?php echo e($msg->email); ?></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php if($msg->type): ?>
                                                        <span class="badge badge-light-<?php echo e($msg->type->color()); ?>">
                                                            <?php echo e($msg->type->label()); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($msg->status): ?>
                                                        <span class="badge badge-light-<?php echo e($msg->status->color()); ?>">
                                                            <?php echo e($msg->status->label()); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="text-muted fs-7"><?php echo e($msg->created_at?->format('Y-m-d')); ?></span>
                                                </td>
                                                <td class="text-end">
                                                    <?php if(auth()->guard('admin')->user()?->can('messages.view_details', 'admin')): ?>
                                                        <a href="<?php echo e(route('admin.message.show', $msg->id)); ?>"
                                                           class="btn btn-sm btn-icon btn-light btn-active-light-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-6">
                                                    <?php echo e(\App\Helpers\TranslationHelper::translate('No contact messages found')); ?>

                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Latest Contact Messages-->
            </div>
            <!--end::Latest Projects & Latest Messages Tables-->

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/index.blade.php ENDPATH**/ ?>