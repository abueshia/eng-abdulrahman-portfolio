 <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(route('site.home')); ?>">
                    <img width="160px;" src="<?php echo e(asset('front/assets/img/logo/Silver-blue.png')); ?>" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3">
                        <li class="nav-item">
                            <a class="nav-link text-dark fw-semibold" href="<?php echo e(route('site.home')); ?>">
                                <i class="fas fa-home me-2"></i>
                                 <?php echo e(\App\Helpers\TranslationHelper::translate('Home')); ?>

                            </a>
                        </li>
                     
                <li class="nav-item dropdown">
    <?php
        $productcategorys = \App\Models\Productcategory::get();
    ?>
    <a class="nav-link dropdown-toggle custom-dropdown-toggle" href="#" role="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-box-open me-2"></i>
         <?php echo e(\App\Helpers\TranslationHelper::translate('Products')); ?>

        <i class="fas fa-chevron-down ms-2 custom-icon"></i>
    </a>
<ul class="dropdown-menu custom-dropdown-direction">
        <?php $__currentLoopData = $productcategorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a class="dropdown-item" href="<?php echo e(route('products.byCategory', $productcategory->id)); ?>">
                    <?php echo e($productcategory->name); ?>

                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</li>




                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle custom-dropdown-toggle" href="<?php echo e(route('brands')); ?>"
                               >
                                <i class="fas fa-tags me-2"></i>  <?php echo e(\App\Helpers\TranslationHelper::translate('brands')); ?>

                                
                            </a>

                                                    </li>

                    </ul>

                    <div class="d-flex align-items-center gap-5">
                         <a class="main-link" href="<?php echo e(route('about')); ?>">
                            <i class="fas fa-handshake"></i>
                            <?php echo e(\App\Helpers\TranslationHelper::translate('About Us')); ?>

                        </a>
                        <a class="main-link" href="<?php echo e(route('message_contact')); ?>">
                            <i class="fas fa-envelope me-2"></i>
                            <?php echo e(\App\Helpers\TranslationHelper::translate('Contact Us')); ?>

                        </a>

                     <div class="tr-header-right-lang lang-sellector d-none d-md-block me-3 custom-lang-select lang-class" style="display: flex; align-items: center; justify-content: center; position: relative;">
    <a href="#" class="lang-selector" style="display: flex; align-items: center; color: #87CEEB;">
        <i class="fas fa-globe me-2"></i>
        <span>
            <?php if(app()->getLocale() == 'ar'): ?>
                 العربية
            <?php else: ?>
                English
            <?php endif; ?>
        </span>
    </a>
    <ul class="lang-dropdown" style="display: none; position: absolute; top: 100%; left: 0; background-color: #fff; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 0px 0; width: 100%; z-index: 999;">
        <li>
            <a href="<?php echo e(LaravelLocalization::getLocalizedURL('ar')); ?>" style="display: block; padding: 5px 10px; text-decoration: none; color: #333;">
                العربية
            </a>
        </li>
        <li>
            <a href="<?php echo e(LaravelLocalization::getLocalizedURL('en')); ?>" style="display: block; padding: 5px 10px; text-decoration: none; color: #333;">
                English
            </a>
        </li>
    </ul>
</div>



                    </div>
                </div>

            </div>
        </nav>
    </header>

   <?php
    $contact = \App\Models\Contact::first();
?>
<?php if($contact && $contact->whatsapp): ?>
    <a 
        href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $contact->whatsapp)); ?>" 
        target="_blank" 
        class="whatsapp-float"
        title="تحدث معنا على واتساب"
    >
        <i class="fab fa-whatsapp"></i>
    </a>
<?php endif; ?>




   

    <script>

   document.addEventListener('DOMContentLoaded', function() {
    const langSelector = document.querySelector('.lang-selector');
    const langDropdown = document.querySelector('.lang-dropdown');

    langSelector.addEventListener('click', function(e) {
        e.stopPropagation(); 
        langDropdown.style.display = langDropdown.style.display === 'none' || langDropdown.style.display === '' ? 'block' : 'none';
    });

    document.addEventListener('click', function(e) {
        if (!langSelector.contains(e.target)) {
            langDropdown.style.display = 'none';
        }
    });
});

</script>

<?php /**PATH D:\xampp\htdocs\silverblue\resources\views/front/includes/header.blade.php ENDPATH**/ ?>