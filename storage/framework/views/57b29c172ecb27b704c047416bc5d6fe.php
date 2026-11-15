<?php if(auth()->guard('admin')->user()?->can('testimonial.view_details', 'admin')): ?>
    <a href="<?php echo e(route('admin.testimonial.show', ['testimonial' => $testimonial->id])); ?>"
       class="btn btn-sm btn-clean btn-icon btn-icon-md"
       title="<?php echo e(\App\Helpers\TranslationHelper::translate('Show Details')); ?>">
        <img src="<?php echo e(asset('dashboard/assets/img/show.png')); ?>" alt="show" style="width: 25px">
    </a>
<?php endif; ?>

<?php if(auth()->guard('admin')->user()?->can('testimonial.edit', 'admin')): ?>
    <a href="<?php echo e(route('admin.testimonial.edit', ['testimonial' => $testimonial->id])); ?>"
       class="btn btn-sm btn-clean btn-icon btn-icon-md"
       title="<?php echo e(\App\Helpers\TranslationHelper::translate('Edit')); ?>">
        <img src="<?php echo e(asset('dashboard/assets/img/edit.png')); ?>" alt="edit" style="width: 25px">
    </a>
<?php endif; ?>

<?php if(auth()->guard('admin')->user()?->can('testimonial.delete', 'admin')): ?>
    <button type="button"
            data-url="<?php echo e(route('admin.testimonial.destroy', ['testimonial' => $testimonial->id])); ?>"
            data-item-id="<?php echo e($testimonial->id); ?>"
            class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
            data-toggle="modal"
            data-target="#delete_modal">
        <img src="<?php echo e(asset('dashboard/assets/img/delete.png')); ?>" alt="delete" style="width: 25px">
    </button>
<?php endif; ?>

<script src="<?php echo e(asset('dashboard/assets/js/delete-item.js')); ?>" type="text/javascript"></script>
<?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/pages/testimonial/buttons.blade.php ENDPATH**/ ?>