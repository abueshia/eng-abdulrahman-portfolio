
 


 

 <?php if(auth()->guard('admin')->user()->can('testimonial.delete', 'admin')): ?>
<button type="button" data-url="<?php echo e(route('admin.testimonial.destroy',['testimonial'=>$testimonial->id])); ?>"
   data-item-id="<?php echo e($testimonial->id); ?>"
   class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button"
   data-toggle="modal"
   data-target="#delete_modal">
    <img src="<?php echo e(asset('dashboard/assets/img/delete.png')); ?>" alt="edit" style="width: 25px">
</button>
<?php endif; ?>


<script src="<?php echo e(asset('dashboard/assets/js/delete-item.js')); ?>" type="text/javascript"></script>
<?php /**PATH D:\laragon\www\eng-abdulrahman-portfolio\resources\views/admin/pages/testimonial/buttons.blade.php ENDPATH**/ ?>