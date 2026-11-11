
<?php if(auth()->guard('admin')->user()->can('messages.view_details', 'admin')): ?>
<a href="<?php echo e(route('admin.message.show',['message'=>$message->id])); ?>"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="<?php echo e(\App\Helpers\TranslationHelper::translate('Show Details')); ?>">
    <img src="<?php echo e(asset('dashboard/assets/img/show.png')); ?>" alt="show" style="width: 25px">
</a>
<?php endif; ?>






<?php if(auth()->guard('admin')->user()->can('messages.delete', 'admin')): ?>
<button type="button" data-url="<?php echo e(route('admin.message.destroy',['message'=>$message->id])); ?>"
   data-item-id="<?php echo e($message->id); ?>"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="<?php echo e(asset('dashboard/assets/img/delete.png')); ?>" alt="edit" style="width: 25px">
</button>

<?php endif; ?>

<script src="<?php echo e(asset('dashboard/assets/js/delete-item.js')); ?>" type="text/javascript"></script>
<?php /**PATH D:\laragon\www\dr_mohamed_hamza_el_sheikh\resources\views/admin/pages/message/buttons.blade.php ENDPATH**/ ?>