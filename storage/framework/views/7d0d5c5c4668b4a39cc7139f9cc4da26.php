

<?php $__env->startSection('content'); ?>

 <main>
        <section class="products-ourownbrands">
            <div class="container pt-5">
                <h2 data-aos="fade-down" data-aos-duration="1000">~ <?php echo e(\App\Helpers\TranslationHelper::translate('Our Brands')); ?> ~</h2>
                <div class="row">
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <div class="col-md-4 pt-3">
                        <div class="logo-our-praneds" data-aos="zoom-in" data-aos-duration="1000">
                            <img width="100%" height="250px" src="<?php echo e($brand->getFirstMediaUrl('galleries_image')); ?>" alt="Logo Our Praneds">
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        
    </main>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/front/pages/brands.blade.php ENDPATH**/ ?>