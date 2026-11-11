<?php $__env->startSection('title', \App\Helpers\TranslationHelper::translate('Admins')); ?>

<?php $__env->startSection('crumb'); ?>
    <?php if (isset($component)) { $__componentOriginalc2072a121b282e859e8bdea9c58b76d8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2072a121b282e859e8bdea9c58b76d8 = $attributes; } ?>
<?php $component = App\View\Components\BreadCrumb::resolve(['breadcrumbs' => [
    ['text'=> \App\Helpers\TranslationHelper::translate('Admins'),'link'=>route('admin.admin.index')],
    ['text'=> \App\Helpers\TranslationHelper::translate('List')]
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

<?php $__env->startPush('admin_css'); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>



    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card-toolbar w-100 mb-7">
                <div class="d-flex justify-content-between w-100 data-kt-Customer-table-toolbar">
                    <div class="left-part">
                          <?php if(auth()->guard('admin')->user()->can('admins.create', 'admin')): ?>
                        <a href="<?php echo e(route('admin.admin.create')); ?>" class="btn btn-primary text-gray-800">
                            <i class="ki-duotone ki-plus fs-2  text-gray-800"></i>
                            <?php echo e(\App\Helpers\TranslationHelper::translate('Create Admin')); ?>

                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <table class="table table-rounded align-middle table-striped border gy-5 gs-7 dataTable no-footer"
                   id="kt_table_users">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(\App\Helpers\TranslationHelper::translate('Name')); ?></th>
                    <th><?php echo e(\App\Helpers\TranslationHelper::translate('Email')); ?></th>
                    <th><?php echo e(\App\Helpers\TranslationHelper::translate('Role')); ?></th>
                     <th><?php echo e(\App\Helpers\TranslationHelper::translate('Branch')); ?></th>
                    <th><?php echo e(\App\Helpers\TranslationHelper::translate('Created_at')); ?></th>
                    <th><?php echo e(\App\Helpers\TranslationHelper::translate('Actions')); ?></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <?php echo $__env->make('admin.layouts.delete-modal',['action_message' => \App\Helpers\TranslationHelper::translate('This Item')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('admin_js'); ?>
     <script src="<?php echo e(asset('dashboard/assets/plugins/custom/datatables/datatables.bundle.js')); ?>"></script>

    <script>
        
     var table1 = $('#kt_table_users').DataTable({
    serverSide: true,
    orderCellsTop: true,
    fixedHeader: true,
    language: {
        <?php if(App::getLocale()=='ar'): ?>
        url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json",
        <?php else: ?>
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
        <?php endif; ?>
    },
    processing: true,
    dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-end ' B>>
          <'row'<'col-sm-12'tr>>
          <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
    buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    order: [[0, "desc"]],
    ajax: {
        url: '<?php echo e(route('admin.admin.table')); ?>',
        data: function (d) {
            d.name = $('#name').val(); 
            d.role_name = $('#role_name').val(); 
            d.branche_name = $('#branche_name').val();
        }
    },
    columns: [
        {data: 'id', name: 'id', defaultContent: '-'},
        {data: 'name', name: 'name', defaultContent: '-'},
        {data: 'email', name: 'email', defaultContent: '-'},
        {data: 'role_name', name: 'role_name', defaultContent: '-'},
        {data: 'branche_name', name: 'branche_name', defaultContent: '-'},
        {data: 'created_at', name: 'created_at', defaultContent: '-'},
        {data: 'action', orderable: false, searchable: false, className: 'text-center'}
    ],
    createdRow: function (row, data, index) {
        $(row).attr('id', 'row-' + data['id']);
    },
});

    </script>

    <script src="<?php echo e(asset('dashboard/assets/js/delete-item.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/admin/pages/admin/index.blade.php ENDPATH**/ ?>