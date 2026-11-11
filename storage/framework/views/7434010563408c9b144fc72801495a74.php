<?php $__env->startSection('content'); ?>

<div class="container" style="max-width: 900px; margin: 0 auto; padding: 130px 20px; text-align: center;">
    <h2 class="tr-company-title" style="font-size: 40px; color: #222; margin-bottom: 35px;">
        <?php echo e(\App\Helpers\TranslationHelper::translate('Terms and Condition')); ?>

    </h2>

    <?php if($termsandcondition && $termsandcondition->description): ?>
        <div class="tr-company-description" style="font-size: 20px; color: #555; line-height: 1.8; text-align: justify;">
            <?php echo $termsandcondition->description; ?>

        </div>
    <?php else: ?>
        <p style="font-size: 20px; color: #888; margin-top: 20px;">
            <?php echo e(\App\Helpers\TranslationHelper::translate('No terms and conditions available at the moment.')); ?>

        </p>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/front/pages/termsandcondition.blade.php ENDPATH**/ ?>