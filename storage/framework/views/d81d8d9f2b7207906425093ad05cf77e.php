<?php if(auth()->guard('admin')->user()?->can('technologies.view_details', 'admin')): ?>
    <a href="<?php echo e(route('admin.technology.show', ['technology' => $technology->id])); ?>"
       class="btn btn-sm btn-clean btn-icon btn-icon-md"
       title="<?php echo e(\App\Helpers\TranslationHelper::translate('Show Details')); ?>">
        <img src="<?php echo e(asset('dashboard/assets/img/show.png')); ?>" alt="show" style="width: 25px">
    </a>
<?php endif; ?>

<?php if(auth()->guard('admin')->user()?->can('technologies.edit', 'admin')): ?>
    <a href="<?php echo e(route('admin.technology.edit', ['technology' => $technology->id])); ?>"
       class="btn btn-sm btn-clean btn-icon btn-icon-md"
       title="<?php echo e(\App\Helpers\TranslationHelper::translate('Edit')); ?>">
        <img src="<?php echo e(asset('dashboard/assets/img/edit.png')); ?>" alt="edit" style="width: 25px">
    </a>
<?php endif; ?>

<?php if(auth()->guard('admin')->user()?->can('technologies.delete', 'admin')): ?>
    <button type="button"
            data-url="<?php echo e(route('admin.technology.destroy', ['technology' => $technology->id])); ?>"
            data-item-id="<?php echo e($technology->id); ?>"
            class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
            data-toggle="modal"
            data-target="#delete_modal">
        <img src="<?php echo e(asset('dashboard/assets/img/delete.png')); ?>" alt="delete" style="width: 25px">
    </button>
<?php endif; ?>

<script src="<?php echo e(asset('dashboard/assets/js/delete-item.js')); ?>" type="text/javascript"></script>

<?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/pages/technology/buttons.blade.php ENDPATH**/ ?>