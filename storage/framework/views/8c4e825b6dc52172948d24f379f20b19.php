<?php $__env->startSection('content'); ?>
    <main>

        <div class="container contact-info pt-5">
            <div class="main-contact-tiop mt-5 pt-5">
                <h2 class="text-center"><?php echo e(\App\Helpers\TranslationHelper::translate('Contact Us')); ?></h2>
                <div class="row g-4">
                    <div class="col-md-4 pt-3">
                        <div class="info-box">
                            <div class="icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <h3><?php echo e(\App\Helpers\TranslationHelper::translate('address')); ?>:</h3>
                            <p>
                                <?php echo $contact->address; ?>

                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 pt-3">
                        <div class="info-box">
                            <div class="icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <h3><?php echo e(\App\Helpers\TranslationHelper::translate('phone number')); ?>:</h3>
                            <p><?php echo e($contact->phono); ?></p>
                        </div>
                    </div>
                    <div class="col-md-4 pt-3">
                        <div class="info-box">
                            <div class="icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <h3><?php echo e(\App\Helpers\TranslationHelper::translate('mail address')); ?>:</h3>
                            <p><?php echo e($contact->x); ?></p>
                        </div>
                    </div>
                </div>


                <div class="dev-contact pt-5 pb-5">
                    <section class="contact-section">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success" id="success-message">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('create_message')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="name"><?php echo e(\App\Helpers\TranslationHelper::translate('Full Name')); ?></label>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger mb-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="text" id="name" name="name" placeholder="<?php echo e(\App\Helpers\TranslationHelper::translate('Enter your full name')); ?>"
                                    value="<?php echo e(old('name')); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email"><?php echo e(\App\Helpers\TranslationHelper::translate('Email Address')); ?></label>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger mb-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <input type="email" id="email" name="email" placeholder="<?php echo e(\App\Helpers\TranslationHelper::translate('Enter your email address')); ?>"
                                    value="<?php echo e(old('email')); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="message"><?php echo e(\App\Helpers\TranslationHelper::translate('Your Message')); ?></label>
                                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger mb-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <textarea id="message" name="message" placeholder="<?php echo e(\App\Helpers\TranslationHelper::translate('Write your message here')); ?>" required><?php echo e(old('message')); ?></textarea>
                            </div>
                            <button type="submit" class="btn-submit"><?php echo e(\App\Helpers\TranslationHelper::translate('Send')); ?></button>
                        </form>

                    </section>
                </div>


            </div>
        </div>

    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        setTimeout(function() {
            var message = document.getElementById('success-message');
            if (message) {
                message.style.transition = "opacity 0.5s ease";
                message.style.opacity = 0;
                setTimeout(function() {
                    message.remove();
                }, 500);
            }
        }, 5000);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\silverblue\resources\views/front/pages/message.blade.php ENDPATH**/ ?>