<style>
    :root {
        --dt-porcelain: #FBFAF7;
        --dt-ink: #211D16;
        --dt-teal: #3F3323;
        --dt-teal-deep: #1E1810;
        --dt-mint: #E9D9B0;
        --dt-coral: #B8863A;
        --dt-coral-deep: #8F6526;
        --dt-gold: #C9A455;
        --dt-line: #E8DFC9;
        --dt-font-head: 'El Messiri', serif;
        --dt-font-body: 'Tajawal', sans-serif;
    }

    .dt-footer {
        position: relative;
        overflow: hidden;
        background: radial-gradient(120% 140% at 15% 0%, var(--dt-teal-deep) 0%, #082A2A 55%, #071F1F 100%);
        color: #EAF3EF;
        font-family: var(--dt-font-body);
        padding-top: 70px;
    }

    .dt-footer__glow {
        position: absolute;
        inset: -40% -10% auto auto;
        width: 520px;
        height: 520px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(169, 223, 201, .18), transparent 70%);
        pointer-events: none;
    }

    .dt-footer__cta {
        position: relative;
        max-width: 1180px;
        margin: 0 auto 60px;
        padding: 0 28px;
    }

    .dt-footer__cta-inner {
        background: linear-gradient(120deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .02));
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 22px;
        padding: 36px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }

    .dt-footer__cta-inner h3 {
        font-family: var(--dt-font-head);
        font-size: 26px;
        margin: 0 0 6px;
        color: #fff;
    }

    .dt-footer__cta-inner p {
        margin: 0;
        color: #C7DCD4;
        font-size: 15px;
        max-width: 420px;
    }

    .dt-cta {
        background: linear-gradient(120deg, var(--dt-coral) 0%, var(--dt-coral-deep) 100%);
        color: #fff;
        text-decoration: none;
        padding: 14px 30px;
        border-radius: 100px;
        font-weight: 700;
        font-size: 15px;
        white-space: nowrap;
        box-shadow: 0 12px 26px -12px rgba(15, 94, 76, .55);
        transition: .25s;
    }

    .dt-cta:hover {
        filter: brightness(1.06);
        transform: translateY(-2px);
    }

    .dt-footer__main {
        position: relative;
        max-width: 1180px;
        margin: 0 auto;
        padding: 0 28px 40px;
        display: grid;
        grid-template-columns: 1.6fr 1fr 1fr 1.2fr;
        gap: 40px;
        border-top: 1px solid rgba(255, 255, 255, .08);
        padding-top: 48px;
    }

    .dt-footer__col h4 {
        font-family: var(--dt-font-head);
        font-size: 17px;
        color: #fff;
        margin: 0 0 18px;
    }

    .dt-footer__col ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .dt-footer__col a {
        color: #C7DCD4;
        text-decoration: none;
        font-size: 14.5px;
        transition: color .2s;
    }

    .dt-footer__col a:hover {
        color: var(--dt-mint);
    }

    .dt-logo__img{
        max-height: 80px; /* Slightly larger in the footer if preferred, or just 65px */
        width: auto;
        object-fit: contain;
        transition: transform 0.3s ease;
    }
    .dt-logo:hover .dt-logo__img { transform: scale(1.03); }

    .dt-footer__about {
        color: #B7CEC5;
        font-size: 14px;
        line-height: 1.9;
        margin: 16px 0 20px;
        max-width: 320px;
    }

    .dt-footer__social {
        display: flex;
        gap: 10px;
    }

    .dt-footer__social a {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, .08);
        color: #fff;
        text-decoration: none;
        transition: .25s;
    }

    .dt-footer__social a:hover {
        background: var(--dt-coral);
        transform: translateY(-3px);
    }

    .dt-footer__hours li {
        display: flex;
        justify-content: space-between;
        color: #B7CEC5;
        font-size: 14px;
    }

    .dt-footer__hours b {
        color: #fff;
        font-weight: 600;
    }

    .dt-footer__contact li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: #C7DCD4;
        font-size: 14px;
        line-height: 1.7;
    }

    .dt-footer__contact i {
        color: var(--dt-mint);
        margin-top: 3px;
    }

    .dt-footer__bottom {
        position: relative;
        max-width: 1180px;
        margin: 0 auto;
        padding: 24px 28px;
        border-top: 1px solid rgba(255, 255, 255, .08);
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        color: #8FA9A0;
        font-size: 13px;
    }

    .dt-footer__bottom a {
        color: #C7DCD4;
        text-decoration: none;
    }

    @media (max-width: 900px) {
        .dt-footer__main {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 560px) {
        .dt-footer__main {
            grid-template-columns: 1fr;
        }

        .dt-footer__cta-inner {
            padding: 28px 22px;
        }
    }
</style>

<footer class="dt-footer">
    <div class="dt-footer__glow"></div>

    <div class="dt-footer__cta">
        <div class="dt-footer__cta-inner">
            <div>
                <h3>جاهز تبتسم بثقة؟</h3>
                <p>احجز استشارتك الأولى مجانًا، وخلي فريقنا يرسملك خطة العلاج المناسبة.</p>
            </div>
            <a href="#booking" class="dt-cta">احجز موعدك الآن</a>
        </div>
    </div>

    <div class="dt-footer__main">
        <div class="dt-footer__col dt-footer__col--brand">
            <a href="<?php echo e(route('site.home')); ?>" class="dt-logo dt-logo--light">
                <img src="<?php echo e(asset('front/assets/img/logo/Silver-blue.png')); ?>" alt="Dr Mohamed Hamza Dental Clinic" class="dt-logo__img">
            </a>
            <p class="dt-footer__about">
                عيادة متخصصة في طب وتجميل الأسنان، بخبرة تمتد لأكثر من 5 عامًا في رعاية ابتسامتك بأحدث التقنيات وأيدٍ
                خبيرة.
            </p>
            <div class="dt-footer__social">
                <a href="https://www.facebook.com/share/1K38YMq8sL/" target="_blank" aria-label="فيسبوك"><i
                        class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/dt.mhamza61?stkn=dW12N3ZxNWR5cXlv" target="_blank"
                    aria-label="انستغرام"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://wa.me/201042917680" target="_blank" aria-label="واتساب"><i
                        class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>

        <div class="dt-footer__col">
            <h4>روابط سريعة</h4>
            <ul>
                <li><a href="<?php echo e(route('site.home')); ?>">الرئيسية</a></li>
                <li><a href="<?php echo e(route('services')); ?>">خدماتنا</a></li>
                <li><a href="<?php echo e(route('site.home')); ?>#before-after">قبل وبعد</a></li>
                <li><a href="<?php echo e(route('site.home')); ?>#reviews">آراء العملاء</a></li>
                <li><a href="<?php echo e(route('about')); ?>">من نحن</a></li>
                <li><a href="<?php echo e(route('message_contact')); ?>">تواصل معنا</a></li>
            </ul>
        </div>

        <div class="dt-footer__col">
            <h4>مواعيد العمل</h4>
            <ul class="dt-footer__hours">
                <li><span>السبت - الخميس</span><b>10ص - 10م</b></li>
                <li><span>الجمعة</span><b>مغلق</b></li>
            </ul>
        </div>

        <div class="dt-footer__col">
            <h4>تواصل معنا</h4>
            <ul class="dt-footer__contact">
                <li><i class="fa-solid fa-location-dot"></i> 
                الاسكندرية ـ  عيادات بايو كلينك التخصصية ـ أول كوبري راغب بجوار مستشفى الجمهورية العام ـ أعلى صيدلية د سحر على محور المحمودية مباشرة
                    </li>
                <li><i class="fa-solid fa-phone"></i> <span dir="ltr">0 10 42917680</span></li>
                <li><i class="fa-solid fa-envelope"></i> info.dr.mohamed.hamza@gmail.com</li>
            </ul>
        </div>
    </div>

    <div class="dt-footer__bottom">
        <span>جميع الحقوق محفوظة لعيادة د.محمد حمزة لطب الاسنان © 2026</span>
        <span>تصميم وبرمجة شركة <a href="https://icodetech7.com/" target="_blank" rel="noopener noreferrer">iCode Tech</a></span>
    </div>
</footer>
<?php /**PATH D:\laragon\www\dr_mohamed_hamza_el_sheikh\resources\views/front/includes/footer.blade.php ENDPATH**/ ?>