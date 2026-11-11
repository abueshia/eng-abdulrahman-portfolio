
 <?php if(auth()->guard('admin')->user()->can('contact.view_details', 'admin')): ?>
<a href="<?php echo e(route('admin.contact.show',['contact'=>$contact->id])); ?>"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="<?php echo e(\App\Helpers\TranslationHelper::translate('Show Details')); ?>">
    <img src="<?php echo e(asset('dashboard/assets/img/show.png')); ?>" alt="show" style="width: 25px">
</a>
<?php endif; ?>


 <?php if(auth()->guard('admin')->user()->can('contact.edit', 'admin')): ?>
<a href="<?php echo e(route('admin.contact.edit',['contact'=>$contact->id])); ?>"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="<?php echo e(\App\Helpers\TranslationHelper::translate('Edit')); ?>">
    <img src="<?php echo e(asset('dashboard/assets/img/edit.png')); ?>" alt="edit" style="width: 25px">
</a>

<?php endif; ?>


 

<script src="<?php echo e(asset('dashboard/assets/js/delete-item.js')); ?>" type="text/javascript"></script>
<?php /**PATH D:\xampp\htdocs\silverblue\resources\views/admin/pages/contact/buttons.blade.php ENDPATH**/ ?>