<?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Contact Messages')); ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
        ['text' => \App\Helpers\TranslationHelper::translate('Contact Messages'), 'link' => route('admin.message.index')],
        ['text' => \App\Helpers\TranslationHelper::translate('List')],
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
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card mb-6">
                <div class="card-body py-5">
                    <div class="row g-4 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-bold"><?php echo e(\App\Helpers\TranslationHelper::translate('Filter by Type')); ?></label>
                            <select id="filter_message_type" class="form-select form-select-solid">
                                <option value=""><?php echo e(\App\Helpers\TranslationHelper::translate('All Types')); ?></option>
                                <?php $__currentLoopData = $messageTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeValue => $typeLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($typeValue); ?>"><?php echo e($typeLabel); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold"><?php echo e(\App\Helpers\TranslationHelper::translate('Filter by Status')); ?></label>
                            <select id="filter_message_status" class="form-select form-select-solid">
                                <option value=""><?php echo e(\App\Helpers\TranslationHelper::translate('All Statuses')); ?></option>
                                <?php $__currentLoopData = $messageStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusValue => $statusLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($statusValue); ?>"><?php echo e($statusLabel); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-rounded align-middle table-striped border gy-5 gs-7 dataTable no-footer"
                           id="kt_table_messages">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Name')); ?></th>
                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Email')); ?></th>
                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Phone')); ?></th>
                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Type')); ?></th>
                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Subject')); ?></th>
                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Status')); ?></th>
                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Date')); ?></th>
                            <th><?php echo e(\App\Helpers\TranslationHelper::translate('Actions')); ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('admin.layouts.delete-modal', ['action_message' => \App\Helpers\TranslationHelper::translate('This Item')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('admin_js'); ?>
    <script src="<?php echo e(asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')); ?>"></script>
    <script>
        const messagesTable = $('#kt_table_messages').DataTable({
            serverSide: true,
            processing: true,
            fixedHeader: true,
            orderCellsTop: true,
            language: {
                <?php if(App::getLocale() === 'ar'): ?>
                url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",
                <?php else: ?>
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
                <?php endif; ?>
            },
            dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-end'B>>
                  <'row'<'col-sm-12'tr>>
                  <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            order: [[0, "desc"]],
            ajax: {
                url: '<?php echo e(route('admin.message.table')); ?>',
                data: function (d) {
                    d.type = $('#filter_message_type').val();
                    d.status = $('#filter_message_status').val();
                }
            },
            columns: [
                {data: 'id', name: 'id', defaultContent: '-'},
                {data: 'name', name: 'name', defaultContent: '-'},
                {data: 'email', name: 'email', defaultContent: '-'},
                {data: 'phone', name: 'phone', defaultContent: '-'},
                {data: 'type', name: 'type', defaultContent: '-'},
                {data: 'subject', name: 'subject', defaultContent: '-'},
                {data: 'status', name: 'status', defaultContent: '-'},
                {data: 'created_at', name: 'created_at', defaultContent: '-'},
                {data: 'action', orderable: false, searchable: false, className: 'text-center'}
            ],
            createdRow: function (row, data) {
                $(row).attr('id', 'row-' + data['id']);
            }
        });

        $('#filter_message_type, #filter_message_status').on('change', function () {
            messagesTable.ajax.reload();
        });
    </script>
    <script src="<?php echo e(asset('dashboard/assets/js/delete-item.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/pages/message/index.blade.php ENDPATH**/ ?>