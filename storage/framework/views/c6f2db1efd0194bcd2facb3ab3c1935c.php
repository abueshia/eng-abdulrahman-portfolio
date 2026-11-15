<?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Reorder Statistics')); ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text' => \App\Helpers\TranslationHelper::translate('Statistics'), 'link' => route('admin.stat.index')],
        ['text' => \App\Helpers\TranslationHelper::translate('Sort Items')],
    ],'button' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?php echo e(\App\Helpers\TranslationHelper::translate('Sort Items')); ?></h4>
                        <a class="btn btn-light-primary btn-sm" href="<?php echo e(route('admin.stat.index')); ?>">
                            <?php echo e(\App\Helpers\TranslationHelper::translate('Go to Statistics')); ?>

                        </a>
                    </div>
                    <div class="card-body py-6">
                        <ul id="sortable-list" class="list-group mb-5">
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-4 cursor-move"
                                    data-id="<?php echo e($item->id); ?>">
                                    <span><i class="ki-solid ki-abstract-14 me-3"></i> <?php echo e($item->label); ?> (<?php echo e(($item->prefix ?? '') . $item->value . ($item->suffix ?? '')); ?>)</span>
                                    <span class="badge badge-light"><?php echo e($item->sort_order); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <button type="button" id="save-reorder-btn" class="btn btn-success">
                            <?php echo e(\App\Helpers\TranslationHelper::translate('Save')); ?>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('admin_js'); ?>
    <script src="<?php echo e(asset('dashboard/assets/js/jquery-ui-dist/jquery-ui.min.js')); ?>"></script>
    <script>
        $(function () {
            $('#sortable-list').sortable();
            $('#save-reorder-btn').on('click', function () {
                const items = [];
                $('#sortable-list li').each(function () {
                    items.push($(this).data('id'));
                });
                $.post('<?php echo e(route('admin.stat.reorder.save')); ?>', {
                    _token: '<?php echo e(csrf_token()); ?>',
                    items: items
                }).done(function (response) {
                    Swal.fire({
                        title: '<?php echo e(\App\Helpers\TranslationHelper::translate('Done')); ?>',
                        icon: 'success',
                        text: response.message
                    });
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/pages/stat/reorder.blade.php ENDPATH**/ ?>