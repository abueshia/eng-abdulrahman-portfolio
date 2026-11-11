
<?php $__env->startSection('content'); ?>


    <main>
        <section class="products">
            <div class="container" data-aos="fade-up" data-aos-duration="1000">
                <h2 data-aos="fade-down" data-aos-duration="1000">~ <?php echo e(\App\Helpers\TranslationHelper::translate('Our Products')); ?> ~</h2>
 <h3 class="text-center" data-aos="fade-down" data-aos-duration="1000">
    ~ <?php echo e($category->name); ?> ~
</h3>

                <div class="row">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <div class="col-md-3 pt-3">
                        <a href="#">
                            
                            <div class="product-card" data-aos="zoom-in" data-aos-duration="1000">
                                <img src="<?php echo e($product->getFirstMediaUrl('products')); ?>" alt="Cake">
                                <div class="title-product">
                                    <a href="#">
                                        <h3><?php echo e($product->name); ?></h3>
                                    </a>
                                    <p><?php echo e($product->description); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 



   
                </div>
            </div>
        </section>
        
      
    </main>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/front/pages/products.blade.php ENDPATH**/ ?>