<!--begin::Modal-->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('dashboard.delete')); ?></h5>


            </div>
            <div class="modal-body">
                <p style="font-size: 18px;font-weight: bold;">
                    <?php echo e(__('dashboard.deleteAction')); ?> <?php echo e(isset($action_message) ? $action_message : __('dashboard.this_item')); ?> ?
               </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><?php echo e(__('dashboard.close')); ?></button>
                <button type="button" class="btn btn-danger" id="delete-button"><?php echo e(__('dashboard.delete')); ?></button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
<?php /**PATH D:\xampp\htdocs\couronne\resources\views/admin/layouts/delete-modal.blade.php ENDPATH**/ ?>