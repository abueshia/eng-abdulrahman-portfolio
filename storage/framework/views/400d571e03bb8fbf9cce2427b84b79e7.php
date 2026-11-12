<?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Dashboard')); ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [['text' => \App\Helpers\TranslationHelper::translate('Statics')]],'button' => [],'title' => \App\Helpers\TranslationHelper::translate('Dashboard')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
    .dt-stat-card {
        background: linear-gradient(135deg, #ffffff 0%, #fcfbf8 100%);
        border: 1px solid #E8DFC9;
        border-radius: 16px;
        padding: 24px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .dt-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px -10px rgba(201, 164, 85, 0.2);
    }
    .dt-stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: rgba(201, 164, 85, 0.1);
        color: #C9A455;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }
    .dt-stat-info h3 {
        font-size: 28px;
        font-weight: 700;
        color: #1E1810;
        margin: 0;
    }
    .dt-stat-info p {
        font-size: 15px;
        color: #8F6526;
        margin: 5px 0 0;
        font-weight: 500;
    }
    .dt-table-card {
        background: #ffffff;
        border: 1px solid #E8DFC9;
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        box-shadow: 0 4px 12px -5px rgba(0,0,0,0.05);
    }
    .dt-table-title {
        font-family: 'El Messiri', serif;
        color: #1E1810;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #E8DFC9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .dt-badge-booking { background: rgba(201, 164, 85, 0.15); color: #8F6526; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; }
    .dt-badge-contact { background: rgba(62, 90, 85, 0.15); color: #3E5A55; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div id="kt_app_content" class="app-content flex-column-fluid" style="font-family: 'Tajawal', sans-serif;">
    <div class="container-fluid">
        <!-- Stats Row -->
        <div class="row g-5 mb-8">
            <div class="col-xl-4 col-md-6">
                <div class="dt-stat-card">
                    <div class="dt-stat-icon"><i class="fas fa-laptop-code"></i></div>
                    <div class="dt-stat-info">
                        <h3><?php echo e($totalBookings ?? 0); ?></h3>
                        <p>إجمالي طلبات المشاريع</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="dt-stat-card">
                    <div class="dt-stat-icon" style="color: #3E5A55; background: rgba(62, 90, 85, 0.1);"><i class="fas fa-envelope-open-text"></i></div>
                    <div class="dt-stat-info">
                        <h3><?php echo e($totalMessages ?? 0); ?></h3>
                        <p>رسائل التواصل</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="dt-stat-card">
                    <div class="dt-stat-icon" style="color: #ffb822; background: rgba(255, 184, 34, 0.1);"><i class="fas fa-star"></i></div>
                    <div class="dt-stat-info">
                        <h3><?php echo e($totalTestimonials ?? 0); ?></h3>
                        <p>آراء وتقييمات العملاء</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tables Row -->
        <div class="row g-5">
            <!-- Latest Bookings -->
            <div class="col-xl-6">
                <div class="dt-table-card">
                    <div class="dt-table-title">
                        أحدث طلبات المشاريع
                        <a href="<?php echo e(route('admin.message.index')); ?>" class="btn btn-sm btn-light-primary">الكل</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="ps-4 min-w-150px rounded-start">الاسم</th>
                                    <th class="min-w-120px">رقم الهاتف</th>
                                    <th class="min-w-120px">نوع المشروع / الخدمة</th>
                                    <th class="min-w-120px rounded-end">التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $latestBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="ps-4"><span class="text-dark fw-bold mb-1 fs-6"><?php echo e($booking->name); ?></span></td>
                                    <td><span class="text-muted fw-semibold d-block fs-7" dir="ltr"><?php echo e($booking->phone); ?></span></td>
                                    <td><span class="dt-badge-booking"><?php echo e($booking->service ?? 'غير محدد'); ?></span></td>
                                    <td><span class="text-muted fw-semibold d-block fs-7"><?php echo e($booking->created_at->format('Y-m-d')); ?></span></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="4" class="text-center text-muted py-4">لا توجد طلبات مشاريع حالياً</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Latest Messages -->
            <div class="col-xl-6">
                <div class="dt-table-card">
                    <div class="dt-table-title">
                        أحدث رسائل التواصل
                        <a href="<?php echo e(route('admin.message.index')); ?>" class="btn btn-sm btn-light-primary">الكل</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="ps-4 min-w-150px rounded-start">الاسم</th>
                                    <th class="min-w-120px">رقم الهاتف</th>
                                    <th class="min-w-200px">الرسالة</th>
                                    <th class="min-w-120px rounded-end">التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $latestMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="ps-4"><span class="text-dark fw-bold mb-1 fs-6"><?php echo e($msg->name); ?></span></td>
                                    <td><span class="text-muted fw-semibold d-block fs-7" dir="ltr"><?php echo e($msg->phone); ?></span></td>
                                    <td><span class="text-muted fw-semibold d-block fs-7 text-truncate" style="max-width: 200px;"><?php echo e($msg->message); ?></span></td>
                                    <td><span class="text-muted fw-semibold d-block fs-7"><?php echo e($msg->created_at->format('Y-m-d')); ?></span></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="4" class="text-center text-muted py-4">لا توجد رسائل تواصل حالياً</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Latest Testimonials -->
            <div class="col-xl-12 mt-8">
                <div class="dt-table-card">
                    <div class="dt-table-title">
                        أحدث آراء العملاء
                        <a href="<?php echo e(route('admin.testimonial.index')); ?>" class="btn btn-sm btn-light-primary">الكل</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="ps-4 min-w-150px rounded-start">اسم العميل</th>
                                    <th class="min-w-120px">التقييم</th>
                                    <th class="min-w-300px">رأيه</th>
                                    <th class="min-w-120px rounded-end">التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $latestTestimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="ps-4"><span class="text-dark fw-bold mb-1 fs-6"><?php echo e($testi->name); ?></span></td>
                                    <td>
                                        <div class="d-flex text-warning fs-7">
                                            <?php for($i=1; $i<=5; $i++): ?>
                                                <i class="fas fa-star <?php echo e($i <= $testi->rating ? 'text-warning' : 'text-muted'); ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </td>
                                    <td><span class="text-muted fw-semibold d-block fs-7 text-truncate" style="max-width: 300px;"><?php echo e($testi->description); ?></span></td>
                                    <td><span class="text-muted fw-semibold d-block fs-7"><?php echo e($testi->created_at->format('Y-m-d')); ?></span></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="4" class="text-center text-muted py-4">لا توجد آراء عملاء حالياً</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('admin_js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/index.blade.php ENDPATH**/ ?>