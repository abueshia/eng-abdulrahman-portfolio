
<a href="<?php echo e(route('admin.banner.show',['banner'=>$banner->id])); ?>"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="<?php echo e(\App\Helpers\TranslationHelper::translate('Show Details')); ?>">
    <img src="<?php echo e(asset('dashboard/assets/img/show.png')); ?>" alt="show" style="width: 25px">
</a>




<a href="<?php echo e(route('admin.banner.edit',['banner'=>$banner->id])); ?>"
   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="<?php echo e(\App\Helpers\TranslationHelper::translate('Edit')); ?>">
    <img src="<?php echo e(asset('dashboard/assets/img/edit.png')); ?>" alt="edit" style="width: 25px">
</a>


<button type="button" data-url="<?php echo e(route('admin.banner.destroy',['banner'=>$banner->id])); ?>"
   data-item-id="<?php echo e($banner->id); ?>"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="<?php echo e(asset('dashboard/assets/img/delete.png')); ?>" alt="edit" style="width: 25px">
</button>


<script src="<?php echo e(asset('dashboard/assets/js/delete-item.js')); ?>" type="text/javascript"></script>

<?php /**PATH D:\xampp\htdocs\silverblue\resources\views/admin/pages/banner/buttons.blade.php ENDPATH**/ ?>