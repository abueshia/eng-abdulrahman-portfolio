<?php $__env->startSection('content'); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@500;600;700&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <style>
        :root {
            --dt-porcelain: #FBFAF7;
            --dt-porcelain-2: #F4F1E9;
            --dt-ink: #211D16;
            --dt-teal: #3F3323;
            --dt-teal-deep: #1E1810;
            --dt-mint: #E9D9B0;
            --dt-mint-soft: #F6EFDC;
            --dt-coral: #B8863A;
            --dt-coral-deep: #8F6526;
            --dt-gold: #C9A455;
            --dt-line: #E8DFC9;
            --dt-font-head: 'El Messiri', serif;
            --dt-font-body: 'Tajawal', sans-serif;
        }

        .dt-about-page {
            font-family: var(--dt-font-body);
            color: var(--dt-ink);
            background: var(--dt-porcelain);
            overflow-x: hidden;
        }

        .dt-container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 28px;
        }

        .dt-h2 {
            font-family: var(--dt-font-head);
            font-size: clamp(28px, 3.4vw, 42px);
            line-height: 1.25;
            margin: 10px 0 18px;
            font-weight: 700;
        }

        .dt-p {
            font-size: 16px;
            line-height: 2;
            color: #3E5A55;
        }

        .dt-eyebrow-free {
            display: inline-block;
            color: var(--dt-coral);
            font-weight: 700;
            font-size: 14px;
            position: relative;
            padding-right: 22px;
        }

        .dt-eyebrow-free::before {
            content: "";
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 2px;
            background: var(--dt-coral);
        }

        /* ---------- HERO ---------- */
        .dt-about-hero {
            position: relative;
            padding: 40px 0;
            background: linear-gradient(150deg, var(--dt-teal-deep) 0%, var(--dt-teal) 100%);
            color: #fff;
            text-align: center;
            overflow: hidden;
        }

        .dt-about-hero::before {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            background: url('<?php echo e(asset('front/assets/img/rrr.jpeg')); ?>') center/cover;
            opacity: 0.15;
            mix-blend-mode: overlay;
        }

        .dt-about-hero__inner {
            position: relative;
            z-index: 2;
            max-width: 700px;
            margin: 0 auto;
        }

        .dt-about-hero__title {
            font-family: var(--dt-font-head);
            font-size: clamp(36px, 5vw, 64px);
            margin-bottom: 20px;
            color: var(--dt-mint);
        }

        .dt-about-hero__desc {
            font-size: 18px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.85);
        }

        /* ---------- VIDEO SECTION ---------- */
        .dt-about-dr {
            padding: 100px 0;
        }

        .dt-about-dr__grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .dt-about-dr__visual {
            position: relative;
        }

        .dt-video-card {
            display: block;
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            aspect-ratio: 16/10;
            box-shadow: 0 30px 60px -20px rgba(16, 36, 43, .4);
            text-decoration: none;
            transition: transform .4s ease, box-shadow .4s ease;
        }

        .dt-video-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 40px 70px -15px rgba(16, 36, 43, .5);
        }

        .dt-video-card__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .6s ease;
        }

        .dt-video-card:hover .dt-video-card__img {
            transform: scale(1.05);
        }

        .dt-video-card__overlay {
            position: absolute;
            inset: 0;
            background: rgba(30,24,16,0.3);
            z-index: 1;
        }

        .dt-video-card__play {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90px;
            height: 90px;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: var(--dt-coral);
            z-index: 2;
            box-shadow: 0 0 0 0 rgba(255,255,255,0.7);
            animation: pulse-white 2s infinite;
        }

        @keyframes pulse-white {
            0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7); }
            70% { box-shadow: 0 0 0 20px rgba(255, 255, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
        }

        .dt-stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 30px;
        }
        
        .dt-stat-box {
            background: #fff;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid var(--dt-line);
            text-align: center;
        }

        .dt-stat-box b {
            display: block;
            font-family: var(--dt-font-head);
            font-size: 32px;
            color: var(--dt-teal-deep);
            margin-bottom: 4px;
        }

        .dt-stat-box span {
            font-size: 14px;
            color: #5E7B74;
            font-weight: 500;
        }

        /* ---------- VISION & MISSION ---------- */
        .dt-vision {
            padding: 100px 0;
            background: var(--dt-porcelain-2);
        }

        .dt-vision__grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }

        .dt-vision-card {
            background: #fff;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px -20px rgba(16, 36, 43, .1);
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid var(--dt-coral);
        }
        
        .dt-vision-card__icon {
            width: 70px;
            height: 70px;
            background: var(--dt-mint-soft);
            color: var(--dt-teal);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-bottom: 24px;
        }

        .dt-vision-card h3 {
            font-family: var(--dt-font-head);
            font-size: 26px;
            margin-bottom: 16px;
            color: var(--dt-ink);
        }

        /* ---------- MASONRY GALLERY ---------- */
        .dt-masonry-section {
            padding: 100px 0;
        }

        .dt-masonry-head {
            text-align: center;
            margin-bottom: 50px;
        }

        .dt-masonry {
            column-count: 3;
            column-gap: 20px;
        }

        .dt-masonry__item {
            display: block;
            margin-bottom: 20px;
            break-inside: avoid;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            transform: translateZ(0);
        }

        .dt-masonry__item img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }
        
        .dt-masonry__item:hover img {
            transform: scale(1.08);
        }

        .dt-masonry__overlay {
            position: absolute;
            inset: 0;
            background: rgba(30,24,16,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .dt-masonry__item:hover .dt-masonry__overlay {
            opacity: 1;
        }

        .dt-masonry__overlay i {
            color: #fff;
            font-size: 32px;
            transform: scale(0.5);
            transition: transform 0.3s ease;
        }
        
        .dt-masonry__item:hover .dt-masonry__overlay i {
            transform: scale(1);
        }

        @media (max-width: 900px) {
            .dt-about-dr__grid, .dt-vision__grid {
                grid-template-columns: 1fr;
            }
            .dt-about-dr__grid {
                grid-template-areas: "copy" "visual";
            }
            .dt-about-dr__visual {
                grid-area: visual;
            }
            .dt-about-dr__copy {
                grid-area: copy;
            }
            .dt-masonry {
                column-count: 2;
            }
        }

        @media (max-width: 600px) {
            .dt-masonry {
                column-count: 1;
            }
            .dt-about-hero {
                padding: 60px 0;
            }
        }
    </style>

    <main class="dt-about-page">
        
        <section class="dt-about-hero">
            <div class="dt-container">
                <div class="dt-about-hero__inner">
                    <h1 class="dt-about-hero__title">صناعة الابتسامة المشرقة</h1>
                    <p class="dt-about-hero__desc">
                        في بايو كلينك، نحن لا نقدم فقط خدمات علاجية، بل نصنع تجربة طبية فريدة تجمع بين الراحة النفسية وأعلى مستويات الدقة الطبية.
                    </p>
                </div>
            </div>
        </section>

        
        <section class="dt-about-dr">
            <div class="dt-container dt-about-dr__grid">
               <div class="dt-about-dr__visual">
    <a href="<?php echo e(asset('front/assets/img/vid.mp4')); ?>" data-fancybox data-type="html5video" class="dt-video-card">
        <img src="<?php echo e(asset('front/assets/img/blog4.jpg')); ?>" alt="Dr. Mohamed Hamza" class="dt-video-card__img" onerror="this.src='<?php echo e(asset('front/assets/img/dr.jpg')); ?>'">
        <div class="dt-video-card__overlay"></div>
        <span class="dt-video-card__play">
            <i class="fa-solid fa-play"></i>
        </span>
    </a>
</div>
                <div class="dt-about-dr__copy">
                    <span class="dt-eyebrow-free">المدير الطبي والمؤسس</span>
                    <h2 class="dt-h2">د. محمد حمزة الشيخ</h2>
                    <p class="dt-p">
                        كرّس د. محمد حمزة مسيرته المهنية لتطوير معايير طب وتجميل الأسنان، معتمداً على أحدث الأبحاث العلمية والتقنيات الرقمية. يتميز بنظرته الفنية الدقيقة التي تضمن لك ابتسامة طبيعية متناسقة مع ملامح وجهك.
                    </p>
                    <p class="dt-p">
                        يؤمن دكتور محمد بأن زيارة طبيب الأسنان يجب أن تكون تجربة إيجابية وخالية من التوتر، ولذلك قام بتصميم عيادة بايو كلينك لتكون واحة للرعاية الصحية الهادئة.
                    </p>
                    
                    <div class="dt-stats-grid">
                        <div class="dt-stat-box">
                            <b>+5</b>
                            <span>سنة خبرة مهنية</span>
                        </div>
                        <div class="dt-stat-box">
                            <b>+1500</b>
                            <span>حالة تجميل ناجحة</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="dt-vision">
            <div class="dt-container dt-vision__grid">
                <div class="dt-vision-card">
                    <div class="dt-vision-card__icon">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3>رؤيتنا</h3>
                    <p class="dt-p">
                        أن نكون الوجهة الأولى والموثوقة في مجال طب وتجميل الأسنان، من خلال تقديم رعاية صحية متكاملة تتجاوز توقعات مرضانا، باستخدام أحدث التقنيات الرقمية المتاحة عالمياً.
                    </p>
                </div>
                
                <div class="dt-vision-card" style="border-color: var(--dt-teal);">
                    <div class="dt-vision-card__icon" style="background: #E8F0EE; color: var(--dt-teal-deep);">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3>مهمتنا</h3>
                    <p class="dt-p">
                        توفير بيئة علاجية آمنة ومريحة، حيث نستمع بعناية لاحتياجات كل مريض ونقدم له خطة علاجية مخصصة تضمن له صحة فموية مستدامة وابتسامة تعزز من ثقته بنفسه.
                    </p>
                </div>
            </div>
        </section>

        
     <?php
    $clinicGallery = [
        ['file' => 'gallery1.jpeg',  'title' => 'منطقة الاستقبال والانتظار'],
        ['file' => 'gallery2.jpeg',  'title' => 'غرفة الكشف والمتابعة'],
        ['file' => 'gallery3.jpeg',  'title' => 'وحدة التعقيم المتطورة'],
        ['file' => 'gallery4.jpeg',  'title' => 'أجهزة التشخيص والفحص'],
        ['file' => 'gallery5.jpeg',  'title' => 'تصميم العيادة الداخلي'],
        ['file' => 'gallery6.jpeg',  'title' => 'كرسي العلاج وتجهيزاته'],
        ['file' => 'gallery7.jpeg',  'title' => 'ركن الراحة للمرضى'],
        ['file' => 'gallery8.jpeg',  'title' => 'المعدات والأدوات الطبية'],
        ['file' => 'gallery9.jpeg',  'title' => 'إضاءة ومساحة العيادة'],
        ['file' => 'gallery10.jpeg', 'title' => 'تفاصيل التعقيم والسلامة'],
    ];
?>

<section class="dt-masonry-section">
    <div class="dt-container">
        <div class="dt-masonry-head">
            <span class="dt-eyebrow-free">جولة مصورة</span>
            <h2 class="dt-h2">نظرة من داخل العيادة</h2>
            <p class="dt-p" style="text-align: center;">مساحات مصممة خصيصاً لراحتك النفسية ولضمان أعلى معايير التعقيم</p>
        </div>

        <div class="dt-masonry">
            <?php $__currentLoopData = $clinicGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $imagePath = asset('front/assets/img/' . $item['file']); ?>

                <a href="<?php echo e($imagePath); ?>" 
                   data-fancybox="clinic-gallery" 
                   data-caption="<?php echo e($item['title']); ?>" 
                   class="dt-masonry__item">
                    
                    <img src="<?php echo e($imagePath); ?>" 
                         alt="<?php echo e($item['title']); ?>" 
                         loading="lazy">

                    <div class="dt-masonry__overlay">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                        <span><?php echo e($item['title']); ?></span>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

       



    </main>

    <?php $__env->startPush('js'); ?>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
        <script>
            Fancybox.bind("[data-fancybox]", {
                Hash: false
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\dr_mohamed_hamza_el_sheikh\resources\views/front/pages/about.blade.php ENDPATH**/ ?>