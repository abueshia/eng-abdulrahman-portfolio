<?php $__env->startSection('content'); ?>
<style>
    .dt-contact-page {
        background: var(--dt-porcelain);
        font-family: var(--dt-font-body);
        color: var(--dt-ink);
        overflow-x: hidden;
    }

    .dt-contact-hero {
        position: relative;
        padding: 140px 0 100px;
        background-color: var(--dt-teal-deep);
        color: #fff;
        text-align: center;
        overflow: hidden;
    }

    /* Abstract glowing shapes for a distinct premium look */
    .dt-contact-hero::before,
    .dt-contact-hero::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        z-index: 1;
    }

    .dt-contact-hero::before {
        width: 400px;
        height: 400px;
        background: var(--dt-coral);
        top: -100px;
        right: -100px;
        opacity: 0.3;
        animation: floatShape 8s infinite alternate;
    }

    .dt-contact-hero::after {
        width: 300px;
        height: 300px;
        background: var(--dt-mint);
        bottom: -50px;
        left: -50px;
        opacity: 0.2;
        animation: floatShape 10s infinite alternate-reverse;
    }

    /* A subtle dotted grid overlay */
    .dt-hero-pattern {
        position: absolute;
        inset: 0;
        z-index: 1;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.6;
    }

    @keyframes floatShape {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(-30px, 30px) scale(1.1); }
    }

    .dt-contact-hero__inner {
        position: relative;
        z-index: 2;
        max-width: 700px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .dt-contact-hero__title {
        font-family: var(--dt-font-head);
        font-size: clamp(36px, 5vw, 64px);
        margin-bottom: 20px;
        color: var(--dt-mint);
    }

    .dt-contact-hero__desc {
        font-size: 18px;
        line-height: 1.8;
        color: rgba(255, 255, 255, 0.85);
    }

    .dt-contact-section {
        padding: 80px 0;
        max-width: 1180px;
        margin: 0 auto;
    }

    .dt-contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.3fr;
        gap: 60px;
        align-items: start;
    }

    /* Contact Info Side */
    .dt-contact-info-card {
        background: #fff;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 20px 40px -15px rgba(16, 36, 43, 0.08);
        border: 1px solid var(--dt-line);
    }

    .dt-contact-info-card h3 {
        font-family: var(--dt-font-head);
        font-size: 26px;
        color: var(--dt-teal-deep);
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 12px;
    }

    .dt-contact-info-card h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0; /* Assuming RTL */
        width: 60px;
        height: 3px;
        background: var(--dt-coral);
        border-radius: 2px;
    }

    .dt-contact-list {
        list-style: none;
        padding: 0;
        margin: 0 0 40px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .dt-contact-list li {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .dt-contact-list__icon {
        width: 44px;
        height: 44px;
        background: var(--dt-mint-soft);
        color: var(--dt-teal-deep);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .dt-contact-list__text {
        font-size: 15px;
        color: #5E7B74;
        line-height: 1.6;
    }

    .dt-contact-list__text strong {
        display: block;
        color: var(--dt-ink);
        font-size: 16px;
        margin-bottom: 4px;
    }

    .dt-contact-hours {
        background: var(--dt-porcelain-2);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 40px;
    }

    .dt-contact-hours h4 {
        font-family: var(--dt-font-head);
        font-size: 20px;
        color: var(--dt-teal-deep);
        margin: 0 0 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .dt-contact-hours h4 i {
        color: var(--dt-coral);
    }

    .dt-contact-hours ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .dt-contact-hours li {
        display: flex;
        justify-content: space-between;
        font-size: 15px;
        color: var(--dt-ink);
    }

    .dt-contact-hours li b {
        color: var(--dt-coral-deep);
    }

    .dt-contact-social {
        display: flex;
        gap: 12px;
    }

    .dt-contact-social a {
        width: 46px;
        height: 46px;
        background: var(--dt-teal-deep);
        color: var(--dt-mint);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        text-decoration: none;
        transition: 0.3s;
    }

    .dt-contact-social a:hover {
        background: var(--dt-coral);
        color: #fff;
        transform: translateY(-4px);
    }

    /* Contact Form Side */
    .dt-contact-form-wrapper {
        background: #fff;
        border-radius: 24px;
        padding: 50px;
        box-shadow: 0 30px 60px -20px rgba(16, 36, 43, 0.1);
        border: 1px solid var(--dt-line);
    }

    .dt-contact-form-wrapper h3 {
        font-family: var(--dt-font-head);
        font-size: 32px;
        color: var(--dt-teal-deep);
        margin-bottom: 10px;
    }

    .dt-contact-form-wrapper p {
        color: #5E7B74;
        font-size: 16px;
        margin-bottom: 30px;
    }

    .dt-form-group {
        margin-bottom: 24px;
    }

    .dt-form-group label {
        display: block;
        font-weight: 700;
        color: var(--dt-ink);
        margin-bottom: 8px;
        font-size: 15px;
    }

    .dt-form-control {
        width: 100%;
        padding: 16px 20px;
        border: 1px solid var(--dt-line);
        border-radius: 12px;
        font-family: var(--dt-font-body);
        font-size: 15px;
        color: var(--dt-ink);
        background: var(--dt-porcelain);
        transition: 0.3s;
    }

    .dt-form-control:focus {
        outline: none;
        border-color: var(--dt-coral);
        background: #fff;
        box-shadow: 0 0 0 4px rgba(184, 134, 58, 0.1);
    }

    textarea.dt-form-control {
        min-height: 150px;
        resize: vertical;
    }

    .dt-form-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 18px;
        background: linear-gradient(120deg, var(--dt-coral) 0%, var(--dt-coral-deep) 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-family: var(--dt-font-body);
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 10px 20px -10px rgba(184, 134, 58, 0.5);
    }

    .dt-form-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 25px -10px rgba(184, 134, 58, 0.7);
    }

    /* Map Section */
    .dt-map-section {
        padding-bottom: 100px;
        max-width: 1180px;
        margin: 0 auto;
    }

    .dt-map-wrapper {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px -15px rgba(16, 36, 43, 0.1);
        border: 4px solid #fff;
        height: 450px;
        background: #eee;
        position: relative;
    }
    
    .dt-map-wrapper iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .dt-map-placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #7C9691;
        background: var(--dt-porcelain-2);
        font-size: 20px;
        font-weight: 700;
        gap: 12px;
    }
    
    .dt-map-placeholder i {
        font-size: 40px;
        color: var(--dt-coral);
    }

    @media (max-width: 991px) {
        .dt-contact-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .dt-contact-form-wrapper {
            padding: 30px 20px;
        }
        .dt-contact-info-card {
            padding: 30px 20px;
        }
    }

</style>

<main class="dt-contact-page">
    
    
    <section class="dt-contact-hero">
        <div class="dt-hero-pattern"></div>
        <div class="dt-contact-hero__inner">
            <h1 class="dt-contact-hero__title">تواصل معنا</h1>
            <p class="dt-contact-hero__desc">يسعدنا دائماً الاستماع إليك والرد على كافة استفساراتك. فريقنا الطبي متاح لمساعدتك في كل خطوة نحو ابتسامتك المثالية.</p>
        </div>
    </section>

    
    <section class="dt-contact-section">
        <div class="dt-container">
            <div class="dt-contact-grid">
                
                
                <div class="dt-contact-info-card" data-aos="fade-left">
                    <h3>معلومات الاتصال</h3>
                    
                    <ul class="dt-contact-list">
                        <li>
                            <div class="dt-contact-list__icon"><i class="fa-solid fa-location-dot"></i></div>
                            <div class="dt-contact-list__text">
                                <strong>العنوان</strong>
الاسكندرية ـ عيادات بايو كلينك التخصصية  ـ أول كوبري راغب بجوار مستشفى الجمهورية العام ـ أعلى صيدلية د سحر على محور المحمودية مباشرة                            </div>
                        </li>
                        <li>
                            <div class="dt-contact-list__icon"><i class="fa-solid fa-phone"></i></div>
                            <div class="dt-contact-list__text">
                                <strong>رقم الهاتف</strong>
                                <span dir="ltr">0 10 42917680</span>
                            </div>
                        </li>
                        <li>
                            <div class="dt-contact-list__icon"><i class="fa-solid fa-envelope"></i></div>
                            <div class="dt-contact-list__text">
                                <strong>البريد الإلكتروني</strong>
                              info.dr.mohamed.hamza@gmail.com
                            </div>
                        </li>
                        <li>
                            <div class="dt-contact-list__icon" style="background: var(--dt-mint-soft); color: var(--dt-teal-deep);"><i class="fa-solid fa-money-bill-transfer"></i></div>
                            <div class="dt-contact-list__text">
                                <strong>الدفع عبر انستاباي (InstaPay)</strong>
                                <a href="https://ipn.eg/S/hamzawy25/instapay/3gbii5" target="_blank" style="color: var(--dt-coral); text-decoration: none; font-weight: 700; display: inline-block; margin-bottom: 8px; transition: 0.3s;">اضغط هنا لإرسال الدفعة</a>
                                <div style="display: flex; align-items: center; gap: 12px; margin-top: 4px;">
                                    <span dir="ltr" style="font-size: 14px; background: var(--dt-porcelain-2); padding: 4px 10px; border-radius: 6px; border: 1px solid var(--dt-line);">hamzawy25@instapay</span>
                                    <a href="<?php echo e(asset('front/assets/img/PM.jpeg')); ?>" target="_blank" title="عرض رمز الدفع (QR Code)" style="display: block; border-radius: 6px; overflow: hidden; border: 2px solid var(--dt-line); transition: transform 0.3s; width: 35px; height: 35px; flex-shrink: 0; background: #fff;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                        <img src="<?php echo e(asset('front/assets/img/PM.jpeg')); ?>" alt="QR Code" style="width: 100%; height: 100%; object-fit: contain;">
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="dt-contact-hours">
                        <h4><i class="fa-regular fa-clock"></i> مواعيد العمل</h4>
                        <ul>
                            <li><span>السبت - الخميس</span> <b>10:00 صباحاً - 10:00 مساءً</b></li>
                            <li><span>الجمعة</span> <b>مغلق</b></li>
                        </ul>
                    </div>

                    <div class="dt-contact-social">
                        <a href="https://www.facebook.com/share/1K38YMq8sL/" target="_blank" aria-label="فيسبوك"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/dt.mhamza61?stkn=dW12N3ZxNWR5cXlv" target="_blank" aria-label="انستغرام"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/201028546190" target="_blank" aria-label="واتساب"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                
                <div class="dt-contact-form-wrapper" data-aos="fade-right">
                    <h3>أرسل لنا رسالة</h3>
                    <p>املأ النموذج التالي وسيقوم فريقنا بالتواصل معك في أقرب وقت ممكن.</p>

                    <form action="<?php echo e(route('create_message')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="dt-form-group">
                            <label for="name">الاسم بالكامل</label>
                            <input type="text" id="name" name="name" class="dt-form-control" placeholder="أدخل اسمك بالكامل" value="<?php echo e(old('name')); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger" style="color: #c62828; font-size: 13px; margin-top: 5px;"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="dt-form-group">
                            <label for="email">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email" class="dt-form-control" placeholder="أدخل بريدك الإلكتروني" value="<?php echo e(old('email')); ?>" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger" style="color: #c62828; font-size: 13px; margin-top: 5px;"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="dt-form-group">
                            <label for="phone">رقم الهاتف</label>
                            <input type="text" id="phone" name="phone" class="dt-form-control" placeholder="أدخل رقم هاتفك" value="<?php echo e(old('phone')); ?>" required>
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger" style="color: #c62828; font-size: 13px; margin-top: 5px;"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="dt-form-group">
                            <label for="message">رسالتك</label>
                            <textarea id="message" name="message" class="dt-form-control" placeholder="اكتب استفسارك أو رسالتك هنا..." required><?php echo e(old('message')); ?></textarea>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger" style="color: #c62828; font-size: 13px; margin-top: 5px;"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit" class="dt-form-submit">
                            إرسال الرسالة <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    
    <section class="dt-map-section">
        <div class="dt-container">
            <div class="dt-map-wrapper" data-aos="zoom-in">
                <iframe 
                    src="https://maps.google.com/maps?q=%D8%B9%D9%8A%D8%A7%D8%AF%D8%A9+%D8%A7%D9%84%D8%AF%D9%83%D8%AA%D9%88%D8%B1+%D9%85%D8%AD%D9%85%D8%AF+%D8%AD%D9%85%D8%B2%D8%A9+%D9%84%D8%B7%D8%A8+%D8%A7%D9%84%D8%A3%D8%B3%D9%86%D8%A7%D9%86%D8%8C+138+El-Mahmoudeya+Canal%D8%8C+%D8%B1%D8%A7%D8%BA%D8%A8+%D8%A8%D8%A7%D8%B4%D8%A7%D8%8C+%D9%85%D8%AD%D8%B1%D9%85+%D8%A8%D9%83%D8%8C+%D9%85%D8%AD%D8%A7%D9%81%D8%B8%D8%A9+%D8%A7%D9%84%D8%A5%D8%B3%D9%83%D9%86%D8%AF%D8%B1%D9%8A%D8%A9&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\dr_mohamed_hamza_el_sheikh\resources\views/front/pages/message.blade.php ENDPATH**/ ?>