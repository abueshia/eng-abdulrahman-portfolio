@extends('front.layouts.app')

@section('content')
<style>
    .dt-services-page {
        background: var(--dt-porcelain);
        font-family: var(--dt-font-body);
        color: var(--dt-ink);
        overflow-x: hidden;
    }

    .dt-services-hero {
        padding: 30px 0 60px;
        text-align: center;
        background: linear-gradient(180deg, var(--dt-mint-soft) 0%, var(--dt-porcelain) 100%);
        position: relative;
    }

    .dt-services-hero::before {
        content: '';
        position: absolute;
        top: -100px;
        left: -100px;
        width: 300px;
        height: 300px;
        background: var(--dt-mint);
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.5;
        z-index: 0;
    }

    .dt-services-hero::after {
        content: '';
        position: absolute;
        bottom: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: var(--dt-coral);
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.15;
        z-index: 0;
    }

    .dt-services-hero__inner {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
    }

    .dt-services-hero .dt-eyebrow-free {
        font-size: 16px;
        margin-bottom: 12px;
    }

    .dt-services-hero .dt-h2 {
        font-size: clamp(36px, 4.5vw, 56px);
        margin-bottom: 24px;
        color: var(--dt-teal-deep);
    }

    .dt-services-hero .dt-p {
        margin: 0 auto 30px;
        font-size: 18px;
        max-width: 600px;
    }

    .dt-services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        padding: 10px 0 100px;
        max-width: 1180px;
        margin: 0 auto;
    }

    .dt-service-card {
        background: #fff;
        border-radius: 24px;
        padding: 40px 30px;
        text-align: center;
        border: 1px solid var(--dt-line);
        box-shadow: 0 10px 30px -15px rgba(16, 36, 43, 0.05);
        transition: transform 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
    }

    .dt-service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--dt-mint), var(--dt-teal));
        transform: scaleX(0);
        transition: transform 0.4s ease;
        transform-origin: right;
    }

    .dt-service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px -15px rgba(16, 36, 43, 0.15);
        border-color: var(--dt-mint);
    }

    .dt-service-card:hover::before {
        transform: scaleX(1);
        transform-origin: left;
    }

    .dt-service-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: var(--dt-mint-soft);
        color: var(--dt-teal-deep);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-bottom: 24px;
        transition: background 0.4s ease, color 0.4s ease, transform 0.4s ease;
    }

    .dt-service-card:hover .dt-service-icon {
        background: var(--dt-teal-deep);
        color: var(--dt-mint);
        transform: scale(1.1) rotate(-5deg);
    }

    .dt-service-title {
        font-family: var(--dt-font-head);
        font-size: 24px;
        font-weight: 700;
        color: var(--dt-ink);
        margin-bottom: 16px;
    }

    .dt-service-desc {
        font-size: 15px;
        color: #5E7B74;
        line-height: 1.8;
        margin-bottom: 30px;
        flex-grow: 1;
    }

    .dt-service-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: transparent;
        color: var(--dt-coral-deep);
        font-weight: 700;
        font-size: 15px;
        border: 2px solid var(--dt-line);
        border-radius: 100px;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: auto;
    }

    .dt-service-btn i {
        font-size: 12px;
        transition: transform 0.3s ease;
    }

    .dt-service-card:hover .dt-service-btn {
        background: var(--dt-coral);
        border-color: var(--dt-coral);
        color: #fff;
    }

    .dt-service-card:hover .dt-service-btn i {
        transform: translateX(-4px);
    }

    /* ---------- FAQ ---------- */
    .dt-services-faq {
        padding: 100px 0;
        background: var(--dt-porcelain-2);
    }
    .dt-services-faq .dt-section-head {
        text-align: center;
        margin-bottom: 50px;
    }
    .dt-services-faq .dt-h2 {
        color: var(--dt-teal-deep);
        margin-bottom: 16px;
    }
    .dt-faq__grid {
        max-width: 900px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .dt-faq__item {
        background: #fff;
        border: 1px solid var(--dt-line);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 36, 43, 0.02);
    }
    .dt-faq__item:hover {
        border-color: var(--dt-mint);
        box-shadow: 0 8px 25px rgba(16, 36, 43, 0.06);
    }
    .dt-faq__toggle {
        display: none;
    }
    .dt-faq__title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px 30px;
        font-family: var(--dt-font-body);
        font-weight: 700;
        font-size: 17px;
        color: var(--dt-ink);
        cursor: pointer;
        transition: color 0.3s ease, background 0.3s ease;
        user-select: none;
    }
    .dt-faq__title i {
        color: var(--dt-coral);
        transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        background: var(--dt-mint-soft);
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 14px;
    }
    .dt-faq__content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease, padding 0.5s ease;
        background: #fff;
    }
    .dt-faq__content p {
        margin: 0;
        padding: 0 30px;
        font-size: 15.5px;
        color: #5E7B74;
        line-height: 1.8;
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.4s ease, transform 0.4s ease;
    }
    .dt-faq__toggle:checked + .dt-faq__title {
        color: var(--dt-teal);
        background: rgba(233, 217, 176, 0.1);
    }
    .dt-faq__toggle:checked + .dt-faq__title i {
        transform: rotate(180deg);
        background: var(--dt-coral);
        color: #fff;
    }
    .dt-faq__toggle:checked ~ .dt-faq__content {
        max-height: 300px;
        padding-bottom: 24px;
    }
    .dt-faq__toggle:checked ~ .dt-faq__content p {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.1s;
    }
    @media (max-width: 768px) {
        .dt-services-hero {
            padding: 60px 0 40px;
        }
        .dt-services-grid {
            grid-template-columns: 1fr;
            padding: 40px 20px 80px;
        }
        .dt-services-faq {
            padding: 60px 20px;
        }
        .dt-faq__title {
            padding: 20px;
            font-size: 15px;
        }
        .dt-faq__content p {
            padding: 0 20px;
        }
    }
</style>

<main class="dt-services-page">
    <section class="dt-services-hero">
        <div class="dt-container dt-services-hero__inner">
            <span class="dt-eyebrow-free">خدماتنا الطبية</span>
            <h1 class="dt-h2">رعاية متكاملة<br>لصحة وجمال أسنانك</h1>
            <p class="dt-p">في عياداتنا، نقدم لك مجموعة شاملة من الخدمات الطبية والتجميلية باستخدام أحدث التقنيات وأفضل المواد لضمان ابتسامة صحية تدوم طويلاً.</p>
        </div>
    </section>

    <div class="dt-container">
        <div class="dt-services-grid">
            
            <!-- Service 1 -->
            <div class="dt-service-card">
                <div class="dt-service-icon"><i class="fa-solid fa-stethoscope"></i></div>
                <h3 class="dt-service-title">كشف واستشارة عامة</h3>
                <p class="dt-service-desc">تقييم شامل لحالة الفم والأسنان مع وضع خطة علاج دقيقة تناسب احتياجاتك للحفاظ على صحة فمك.</p>
                <a href="{{ route('site.home') }}#booking" class="dt-service-btn">احجز الآن <i class="fa-solid fa-arrow-left"></i></a>
            </div>

            <!-- Service 2 -->
            <div class="dt-service-card">
                <div class="dt-service-icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                <h3 class="dt-service-title">حشوات تجميلية وليزر</h3>
                <p class="dt-service-desc">استعادة شكل الأسنان الطبيعي ووظيفتها بحشوات تدوم طويلاً ومطابقة للون أسنانك الطبيعية.</p>
                <a href="{{ route('site.home') }}#booking" class="dt-service-btn">احجز الآن <i class="fa-solid fa-arrow-left"></i></a>
            </div>

            <!-- Service 3 -->
            <div class="dt-service-card">
                <div class="dt-service-icon"><i class="fa-solid fa-tooth"></i></div>
                <h3 class="dt-service-title">خلع وجراحة ضرس العقل</h3>
                <p class="dt-service-desc">جراحات دقيقة وآمنة لخلع الأسنان المتضررة أو أضراس العقل المطمورة بدون ألم وفي بيئة معقمة.</p>
                <a href="{{ route('site.home') }}#booking" class="dt-service-btn">احجز الآن <i class="fa-solid fa-arrow-left"></i></a>
            </div>

            <!-- Service 4 -->
            <div class="dt-service-card">
                <div class="dt-service-icon"><i class="fa-solid fa-disease"></i></div>
                <h3 class="dt-service-title">علاج أمراض وجراحة اللثة</h3>
                <p class="dt-service-desc">أحدث طرق علاج التهابات وتراجع اللثة للحصول على دعامة قوية للأسنان وابتسامة صحية ومشرقة.</p>
                <a href="{{ route('site.home') }}#booking" class="dt-service-btn">احجز الآن <i class="fa-solid fa-arrow-left"></i></a>
            </div>

            <!-- Service 5 -->
            <div class="dt-service-card">
                <div class="dt-service-icon"><i class="fa-solid fa-sun"></i></div>
                <h3 class="dt-service-title">تبييض وتنظيف جير الأسنان</h3>
                <p class="dt-service-desc">إزالة الجير والتصبغات بجلسات تبييض احترافية تضمن لك أسنان ناصعة البياض وابتسامة جذابة.</p>
                <a href="{{ route('site.home') }}#booking" class="dt-service-btn">احجز الآن <i class="fa-solid fa-arrow-left"></i></a>
            </div>

            <!-- Service 6 -->
            <div class="dt-service-card">
                <div class="dt-service-icon"><i class="fa-solid fa-child"></i></div>
                <h3 class="dt-service-title">طب أسنان الأطفال</h3>
                <p class="dt-service-desc">رعاية خاصة وممتعة للأطفال لعلاج أسنانهم وتوجيههم للعادات الصحية بطرق تحببهم في زيارة طبيب الأسنان.</p>
                <a href="{{ route('site.home') }}#booking" class="dt-service-btn">احجز الآن <i class="fa-solid fa-arrow-left"></i></a>
            </div>

            <!-- Service 7 -->
            <div class="dt-service-card">
                <div class="dt-service-icon"><i class="fa-solid fa-align-center"></i></div>
                <h3 class="dt-service-title">تقويم أسنان</h3>
                <p class="dt-service-desc">تقويم شفاف ومعدني لتصحيح اصطفاف الأسنان ومعالجة مشاكل الإطباق بأحدث التقنيات للحصول على نتائج مبهرة.</p>
                <a href="{{ route('site.home') }}#booking" class="dt-service-btn">احجز الآن <i class="fa-solid fa-arrow-left"></i></a>
            </div>

            <!-- Service 8 -->
            <div class="dt-service-card">
                <div class="dt-service-icon"><i class="fa-solid fa-screw"></i></div>
                <h3 class="dt-service-title">زراعة أسنان</h3>
                <p class="dt-service-desc">استبدال الأسنان المفقودة بزراعات آمنة وقوية تدوم مدى الحياة وتعيد لك قدرتك على المضغ والابتسام بثقة.</p>
                <a href="{{ route('site.home') }}#booking" class="dt-service-btn">احجز الآن <i class="fa-solid fa-arrow-left"></i></a>
            </div>

            <!-- Service 9 -->
            <div class="dt-service-card">
                <div class="dt-service-icon"><i class="fa-solid fa-face-smile-beam"></i></div>
                <h3 class="dt-service-title">ابتسامة هوليود وفينير</h3>
                <p class="dt-service-desc">قشور خزفية رقيقة (فينير) وابتسامة هوليود المتكاملة لتغيير جذري ومثالي في شكل ولون الأسنان.</p>
                <a href="{{ route('site.home') }}#booking" class="dt-service-btn">احجز الآن <i class="fa-solid fa-arrow-left"></i></a>
            </div>

            <!-- Service 10 -->
            <div class="dt-service-card">
                <div class="dt-service-icon"><i class="fa-solid fa-bolt"></i></div>
                <h3 class="dt-service-title">علاج جذور وسحب عصب</h3>
                <p class="dt-service-desc">علاج آمن وبدون ألم لالتهابات العصب للحفاظ على السن الطبيعي من التلف بفضل التقنيات الحديثة والميكروسكوب.</p>
                <a href="{{ route('site.home') }}#booking" class="dt-service-btn">احجز الآن <i class="fa-solid fa-arrow-left"></i></a>
            </div>

        </div>
    </div>

    {{-- ================= FAQ SECTION ================= --}}
    <section class="dt-services-faq">
        <div class="dt-container">
            <div class="dt-section-head">
                <span class="dt-eyebrow-free">الأسئلة الشائعة</span>
                <h2 class="dt-h2">أهم الاستفسارات حول خدماتنا</h2>
            </div>
            <div class="dt-faq__grid">
                
                <div class="dt-faq__item">
                    <input type="checkbox" id="faq1" class="dt-faq__toggle">
                    <label for="faq1" class="dt-faq__title">1. هل الكشف مجاني فعلاً؟ <i class="fa-solid fa-chevron-down"></i></label>
                    <div class="dt-faq__content">
                        <p>نعم، الكشف والتشخيص المبدئي مجاني تماماً. نهدف إلى تقديم خطة علاج واضحة ومناسبة لميزانيتك بدون أي التزامات مسبقة.</p>
                    </div>
                </div>

                <div class="dt-faq__item">
                    <input type="checkbox" id="faq2" class="dt-faq__toggle">
                    <label for="faq2" class="dt-faq__title">2. هل العلاج مؤلم؟ <i class="fa-solid fa-chevron-down"></i></label>
                    <div class="dt-faq__content">
                        <p>نستخدم أحدث تقنيات التخدير الموضعي وأجهزة الليزر لضمان تجربة مريحة وخالية من الألم قدر الإمكان أثناء جميع الإجراءات العلاجية والتجميلية.</p>
                    </div>
                </div>

                <div class="dt-faq__item">
                    <input type="checkbox" id="faq3" class="dt-faq__toggle">
                    <label for="faq3" class="dt-faq__title">3. كم تستغرق زراعة الأسنان؟ <i class="fa-solid fa-chevron-down"></i></label>
                    <div class="dt-faq__content">
                        <p>تختلف المدة حسب كل حالة، ولكن مع التقنيات الحديثة والتشخيص الدقيق 3D، يمكننا إتمام بعض حالات الزراعة الفورية في نفس اليوم، أو خلال بضعة أسابيع للزراعة التقليدية كحد أقصى.</p>
                    </div>
                </div>

                <div class="dt-faq__item">
                    <input type="checkbox" id="faq4" class="dt-faq__toggle">
                    <label for="faq4" class="dt-faq__title">4. هل توفرون خطط تقسيط؟ <i class="fa-solid fa-chevron-down"></i></label>
                    <div class="dt-faq__content">
                        <p>نعم، نوفر خطط دفع مرنة وميسرة تناسب ميزانيتك لتسهيل الحصول على الابتسامة التي تحلم بها دون أي أعباء مالية إضافية.</p>
                    </div>
                </div>

                <div class="dt-faq__item">
                    <input type="checkbox" id="faq5" class="dt-faq__toggle">
                    <label for="faq5" class="dt-faq__title">5. هل تبييض الأسنان يضر بطبقة المينا؟ <i class="fa-solid fa-chevron-down"></i></label>
                    <div class="dt-faq__content">
                        <p>لا، عند إجراء التبييض تحت إشراف طبي متخصص باستخدام مواد معتمدة وآمنة، فإنه لا يسبب أي ضرر لطبقة المينا، بل يمنحك بياضاً طبيعياً وبطريقة آمنة تماماً.</p>
                    </div>
                </div>

                <div class="dt-faq__item">
                    <input type="checkbox" id="faq6" class="dt-faq__toggle">
                    <label for="faq6" class="dt-faq__title">6. ما هو الفرق بين الفينير واللومينير؟ <i class="fa-solid fa-chevron-down"></i></label>
                    <div class="dt-faq__content">
                        <p>الفينير يتطلب تحضيراً أو برداً بسيطاً للأسنان لتركيب القشور، بينما اللومينير عبارة عن قشور رقيقة جداً لا تتطلب عادةً أي برد للأسنان. الطبيب يحدد الخيار الأنسب لك بعد الفحص الشامل.</p>
                    </div>
                </div>

                <div class="dt-faq__item">
                    <input type="checkbox" id="faq7" class="dt-faq__toggle">
                    <label for="faq7" class="dt-faq__title">7. متى يجب خلع ضرس العقل؟ <i class="fa-solid fa-chevron-down"></i></label>
                    <div class="dt-faq__content">
                        <p>يتم خلعه جراحياً إذا كان ينمو بشكل خاطئ، مسبباً ألماً مستمراً، أو إذا كان يؤثر على الأسنان المجاورة أو يسبب التهابات في اللثة. ويتم اتخاذ القرار بناءً على صورة الأشعة الدقيقة.</p>
                    </div>
                </div>

                <div class="dt-faq__item">
                    <input type="checkbox" id="faq8" class="dt-faq__toggle">
                    <label for="faq8" class="dt-faq__title">8. متى يمكنني الأكل بعد حشو الأسنان؟ <i class="fa-solid fa-chevron-down"></i></label>
                    <div class="dt-faq__content">
                        <p>في حالة الحشوات التجميلية (الضوئية)، يمكنك الأكل والشرب مباشرة بعد الجلسة، ولكن يُنصح بالانتظار حتى زوال تأثير المخدر لتجنب عض الشفة أو اللسان عن طريق الخطأ.</p>
                    </div>
                </div>

                <div class="dt-faq__item">
                    <input type="checkbox" id="faq9" class="dt-faq__toggle">
                    <label for="faq9" class="dt-faq__title">9. هل تقويم الأسنان مخصص للأطفال فقط؟ <i class="fa-solid fa-chevron-down"></i></label>
                    <div class="dt-faq__content">
                        <p>إطلاقاً، التقويم متاح ومناسب لجميع الأعمار (الشباب والبالغين) طالما أن اللثة وعظام الفك بحالة صحية جيدة. هناك خيارات مثل التقويم الشفاف التي تناسب الكبار بشكل رائع.</p>
                    </div>
                </div>

                <div class="dt-faq__item">
                    <input type="checkbox" id="faq10" class="dt-faq__toggle">
                    <label for="faq10" class="dt-faq__title">10. كيف أعتني بأسنان طفلي لتجنب التسوس؟ <i class="fa-solid fa-chevron-down"></i></label>
                    <div class="dt-faq__content">
                        <p>يجب تقليل الحلويات والسكريات، وتعويد الطفل على غسل أسنانه بمعجون يحتوي على الفلورايد مرتين يومياً، مع ضرورة البدء بزيارة طبيب الأسنان بانتظام منذ ظهور السن الأول لكسر حاجز الخوف.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
@endsection
