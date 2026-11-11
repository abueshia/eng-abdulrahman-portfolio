<?php if(auth()->guard('admin')->user()->can('card.view_all', 'admin')): ?>
<a href="<?php echo e(route('admin.card.show',['card'=>$card->id])); ?>"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="<?php echo e(\App\Helpers\TranslationHelper::translate('Show Details')); ?>">
    <img src="<?php echo e(asset('dashboard/assets/img/show.png')); ?>" alt="show" style="width: 25px">
</a>
<?php endif; ?>

<?php if(auth()->guard('admin')->user()->can('card.edit', 'admin')): ?>
<a href="<?php echo e(route('admin.card.edit',['card'=>$card->id])); ?>"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="<?php echo e(\App\Helpers\TranslationHelper::translate('Edit')); ?>">
    <img src="<?php echo e(asset('dashboard/assets/img/edit.png')); ?>" alt="edit" style="width: 25px">
</a>
<?php endif; ?>
<?php if(auth()->guard('admin')->user()->can('card.delete', 'admin')): ?>

<button type="button" data-url="<?php echo e(route('admin.card.destroy',['card'=>$card->id])); ?>"
   data-item-id="<?php echo e($card->id); ?>"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="<?php echo e(asset('dashboard/assets/img/delete.png')); ?>" alt="edit" style="width: 25px">
</button>
<?php endif; ?>


<script src="<?php echo e(asset('dashboard/assets/js/delete-item.js')); ?>" type="text/javascript"></script>

<?php /**PATH D:\xampp\htdocs\couronne\resources\views/admin/pages/card/buttons.blade.php ENDPATH**/ ?>