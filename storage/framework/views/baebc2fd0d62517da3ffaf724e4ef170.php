<?php $__env->startSection('content'); ?>
    <main>
        <section class="section-tow">
            <div class="container" data-aos="fade-up" data-aos-duration="1000">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-about">
                            <br><br><br>
                            <h2><?php echo e($about->title); ?>

                            </h2>
                            <p>
                               <?php echo $about->description; ?>

                            </p>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="img-about">
                            <img src="<?php echo e($about->getFirstMediaUrl('abouts_image')); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div> 
        </section>
    </main>
     
       <?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/front/pages/about.blade.php ENDPATH**/ ?>