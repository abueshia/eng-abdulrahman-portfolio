

<?php $__env->startSection('content'); ?>

<main>
    <section class="prodect-deteles" style="padding: 60px 0;">
        <div class="container">
            <div class="row align-items-center" style="margin-top: 50px;">
                <div class="col-md-6">
                    <img src="<?php echo e($product->getFirstMediaUrl('products')); ?>" alt="<?php echo e($product->name); ?>" class="product-image">
                </div>
                <div class="col-md-6">
                    <div class="product-info">
                        <h2><?php echo e($product->name); ?></h2>
                        
                        <p class="category">
                            <strong>Category:</strong>
                            <?php echo e($product->productcategory?->name ?? 'Not specified'); ?>

                        </p>

                        <p class="description">
                            <?php echo e($product->description); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/front/pages/detailsProducts.blade.php ENDPATH**/ ?>