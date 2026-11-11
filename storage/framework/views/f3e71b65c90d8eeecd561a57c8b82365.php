<?php $__env->startSection('content'); ?>
   
    <main>

        <section class="hero-slider">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <div class="swiper-slide">
                        <div class="img-main-hero">
                            <img src="<?php echo e($banner->getFirstMediaUrl('banners')); ?>" alt="Slide 1">
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        
        <section class="section-tow">
            <div class="container" data-aos="fade-up" data-aos-duration="1000">
                <div class="row">
                    <div class="col-md-6">
                        <div class="img-about">
                            <img src="<?php echo e($about->getFirstMediaUrl('abouts_image')); ?>" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-about">
                            <h2><?php echo e($about->title); ?>

                            </h2>
                            <p>
                                <?php echo $about->description; ?>

                            </p>
                            <a href="<?php echo e(route('about')); ?>" class="btn btn-primary"><?php echo e(\App\Helpers\TranslationHelper::translate('Read More')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="products">
            <div class="container" data-aos="fade-up" data-aos-duration="1000">
                <h2 data-aos="fade-down" data-aos-duration="1000"><?php echo e(\App\Helpers\TranslationHelper::translate('Our Products')); ?></h2>
                <div class="row">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="col-md-3 pt-3">
                        
                            <a>
                            <div class="product-card" data-aos="zoom-in" data-aos-duration="1000">
                                <img src="<?php echo e($product->getFirstMediaUrl('products')); ?>" alt="Cake">
                                <div class="title-product">
                                    <a>
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





        <section class="reviews theme-BG">
            <div class="theme-BG-ultra-blur">
                <div class="container" data-aos="fade-up" data-aos-duration="1000">
                    <h2 class="pb-4 text-center"><?php echo e(\App\Helpers\TranslationHelper::translate('Our Brands')); ?> 
                    </h2>

                    <div class="reviewsSliderContainer">
                        <div class="reviewsSlider swiper" dir="ltr">
                            <div class="swiper-wrapper">
                                 <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <div class="review">
                                        <div class="header">
                                            <div class="icon">
                                                <img src="<?php echo e($brand->getFirstMediaUrl('galleries_image')); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<?php $__env->stopPush(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/front/index.blade.php ENDPATH**/ ?>