
    <footer class="theme-BG">
        <div class="theme-BG-ultra-blur">
            <div class="container">
                <div class="footerInner container">
                    <div class="main">
                        <div class="logo">
                            <img width="250px" src="<?php echo e(setting('image_logo', 'en')); ?>" alt="Logo">
                            
                        </div>

                            <?php echo setting('description_footer', app()->getLocale()); ?>


                        <div class="social">
                            <?php
    $contact = \App\Models\Contact::first();
?>
    <?php if($contact): ?>
        <?php if($contact->facebook): ?>
            <a href="<?php echo e($contact->facebook); ?>" target="_blank">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
        <?php endif; ?>

        

    <?php if($contact->iniesta): ?>
    <a href="<?php echo e($contact->iniesta); ?>" target="_blank">
        <i class="fab fa-instagram"></i>
    </a>
<?php endif; ?>

<?php if($contact->tiktok): ?>
    <a href="<?php echo e($contact->tiktok); ?>" target="_blank">
        <i class="fab fa-youtube"></i>
    </a>
<?php endif; ?>



        
    <?php else: ?>
        <p><?php echo e(\App\Helpers\TranslationHelper::translate('Social links are not available')); ?></p>
    <?php endif; ?>
</div>

                    </div>

                    <div class="links important pt-5">
                        <h4><?php echo e(\App\Helpers\TranslationHelper::translate('Important Links')); ?></h4>
                        <div class="line"></div>

                        <ul>
                            <li><a href="<?php echo e(route('site.home')); ?>"><?php echo e(\App\Helpers\TranslationHelper::translate('Home')); ?></a></li>
                            <li><a href="<?php echo e(route('brands')); ?>"><?php echo e(\App\Helpers\TranslationHelper::translate('Our Brands')); ?></a></li>
                            <li><a href="<?php echo e(route('message_contact')); ?>"><?php echo e(\App\Helpers\TranslationHelper::translate('Contact Us')); ?></a></li>
                            <li><a href="<?php echo e(route('about')); ?>"><?php echo e(\App\Helpers\TranslationHelper::translate('About us')); ?></a></li>
                            
                        </ul>
                    </div>

                    <div class="contact pt-5">
                         <h4><?php echo e(\App\Helpers\TranslationHelper::translate('Contact Us')); ?></h4>
                        <div class="line"></div>


                        <ul>
                            <?php if($contact): ?>
                            <li>
                                <a href="#">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>
                                       <?php echo e($contact->address); ?>

                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa-solid fa-phone"></i>
                                    <span><?php echo e($contact->phono); ?></span>
                                </a>
                            </li>


                            <li>
                                <a href="#">
                                    <i class="fa-solid fa-envelope"></i>
                                    <span><?php echo e($contact->x); ?></span>
                                </a>
                            </li>
                           <?php else: ?>
                           <li><?php echo e(\App\Helpers\TranslationHelper::translate('Contact information not available')); ?></li>
                           <?php endif; ?>
                        </ul>

                    </div>
                </div>

                <div class="lowerFooter container">
                    <div class="copy">
                        <?php echo e(\App\Helpers\TranslationHelper::translate('all rights are reversed for SilverBlue 2025')); ?> &copy;
                        <?php echo e(\App\Helpers\TranslationHelper::translate('Programmed by')); ?>

                        <a href="#"><?php echo e(\App\Helpers\TranslationHelper::translate('Matrix Clouds')); ?></a>
                    </div>
                    <ul>
                        <li><a href="<?php echo e(route('about')); ?>"><?php echo e(\App\Helpers\TranslationHelper::translate('About us')); ?></a></li>
                        <li><a href="<?php echo e(route('brands')); ?>"><?php echo e(\App\Helpers\TranslationHelper::translate('Our Brands')); ?></a></li>
                        <li><a href="<?php echo e(route('message_contact')); ?>"><?php echo e(\App\Helpers\TranslationHelper::translate('Contact us')); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>


<?php /**PATH D:\xampp\htdocs\silverblue\resources\views/front/includes/footer.blade.php ENDPATH**/ ?>