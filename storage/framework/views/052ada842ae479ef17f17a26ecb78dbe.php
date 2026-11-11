<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@500;600;700&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    :root{
        --dt-porcelain:#FBFAF7;
        --dt-ink:#000000;
        --dt-teal:#3F3323;
        --dt-teal-deep:#1E1810;
        --dt-mint:#E9D9B0;
        --dt-mint-soft:#F6EFDC;
        --dt-coral:#B8863A;
        --dt-coral-deep:#8F6526;
        --dt-gold:#C9A455;
        --dt-line:#E8DFC9;
        --dt-font-head:'El Messiri', serif;
        --dt-font-body:'Tajawal', sans-serif;
    }

    .dt-header{
        position:sticky; top:0; z-index:500;
        background:rgba(251,250,247,.86);
        backdrop-filter:blur(14px) saturate(140%);
        border-bottom:1px solid var(--dt-line);
        font-family:var(--dt-font-body);
        transition:box-shadow .3s ease;
    }
    .dt-header.is-scrolled{ box-shadow:0 8px 24px -18px rgba(16,36,43,.35); }

    .dt-header__inner{
        max-width:1280px; margin:0 auto; padding:14px 28px;
        display:flex; align-items:center; justify-content:space-between; gap:18px;
    }

    .dt-nav{ display:flex; align-items:center; gap:30px; flex:1; }
    .dt-nav--start{ justify-content:flex-start; }
    .dt-nav--end{ justify-content:flex-end; }

    .dt-nav{ display:flex; align-items:center; gap:30px; }

    .dt-nav__link{
        position:relative; color:var(--dt-ink); text-decoration:none;
        font-size:15px; font-weight:500; padding:8px 2px; letter-spacing:.2px;
    }
    .dt-nav__link::after{
        content:""; position:absolute; right:0; bottom:2px; width:0; height:2px;
        background:var(--dt-coral); transition:width .3s ease;
    }
    .dt-nav__link:hover::after, .dt-nav__link.is-active::after{ width:100%; }
    .dt-nav__link.is-active{ color:var(--dt-teal-deep); font-weight:700; }

    .dt-logo{ display:flex; align-items:center; gap:10px; text-decoration:none; flex-shrink:0; }
    .dt-logo__mark{
        width:42px; height:42px; border-radius:50%;
        background:linear-gradient(155deg, var(--dt-mint) 0%, var(--dt-teal) 100%);
        display:flex; align-items:center; justify-content:center; color:#fff;
    }
    .dt-logo__mark svg{ width:22px; height:22px; }
    .dt-logo__text{ display:flex; flex-direction:column; line-height:1.15; }
    
    /* New 3-line stacked logo text */
    .dt-logo-stacked {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        line-height: 1.1;
    }
    .dt-stack-top { font-size: 11px; color: var(--dt-teal-deep); font-weight: 700; }
    .dt-stack-mid { font-family: var(--dt-font-head); font-size: 19px; color: var(--dt-ink); font-weight: 700; margin: 1px 0; white-space: nowrap; }
    .dt-stack-bot { font-size: 12px; color: var(--dt-coral); font-weight: 700; }
    
    /* Responsive logo text adjustments */
    @media (max-width: 1150px) {
        .dt-stack-mid { font-size: 17px; }
        .dt-stack-top { font-size: 10px; }
        .dt-stack-bot { font-size: 11px; }
    }
    @media (max-width: 480px) {
        .dt-stack-mid { font-size: 16px; }
    }

    .dt-header__actions{ display:flex; align-items:center; gap:16px; flex-shrink:0; }
    .dt-phone{
        display:flex; align-items:center; gap:7px; color:var(--dt-teal-deep);
        text-decoration:none; font-weight:700; font-size:14px; direction:ltr;
    }

    .dt-cta{
        background:linear-gradient(120deg, var(--dt-coral) 0%, var(--dt-coral-deep) 100%); color:#fff; text-decoration:none;
        padding:11px 24px; border-radius:100px; font-weight:700; font-size:14.5px;
        box-shadow:0 10px 22px -10px rgba(15,94,76,.55);
        transition:transform .25s ease, box-shadow .25s ease, filter .25s ease;
        white-space:nowrap;
    }
    .dt-cta:hover{ transform:translateY(-2px); filter:brightness(1.06); box-shadow:0 14px 26px -10px rgba(15,94,76,.65); }

    .dt-burger{ display:none; flex-direction:column; gap:5px; background:none; border:0; cursor:pointer; padding:6px; }
    .dt-burger span{ width:22px; height:2px; background:#B8863A; border-radius:2px; transition:.3s; }

    .dt-mobile-panel{
        display:none; flex-direction:column; gap:2px; padding:10px 20px 22px;
        border-top:1px solid var(--dt-line); background:var(--dt-porcelain);
    }
    .dt-mobile-panel.is-open{ display:flex; }
    .dt-mobile-link{ color:var(--dt-ink); text-decoration:none; padding:12px 4px; font-weight:600; border-bottom:1px solid var(--dt-line); }
    .dt-cta--block{ text-align:center; margin-top:14px; }

    @media (max-width: 980px){
        .dt-nav--start, .dt-nav--end, .dt-phone{ display:none; }
        .dt-burger{ display:flex; }
        .dt-header__inner{ padding:12px 18px; }
    }

    /* ---------- SITE-WIDE SCROLLBAR THEME ---------- */
    html{ scrollbar-color: var(--dt-teal) var(--dt-porcelain); scrollbar-width: thin; }
    ::-webkit-scrollbar{ width:10px; height:10px; }
    ::-webkit-scrollbar-track{ background:var(--dt-porcelain); }
    ::-webkit-scrollbar-thumb{ background:linear-gradient(var(--dt-teal), var(--dt-teal-deep)); border-radius:10px; border:2px solid var(--dt-porcelain); }
    ::-webkit-scrollbar-thumb:hover{ background:var(--dt-teal-deep); }
</style>

<header class="dt-header" id="dtHeader">
    <div class="dt-header__inner">

        <button class="dt-burger" id="dtBurger" aria-label="فتح القائمة">
            <span></span><span></span><span></span>
        </button>

        <nav class="dt-nav dt-nav--start" id="dtNavStart">
            <a href="<?php echo e(route('site.home')); ?>" class="dt-nav__link is-active">الرئيسية</a>
            <a href="<?php echo e(route('site.home')); ?>#services" class="dt-nav__link">خدماتنا</a>
            <a href="<?php echo e(route('site.home')); ?>#before-after" class="dt-nav__link">قبل وبعد</a>
            <a href="<?php echo e(route('blogs.index')); ?>" class="dt-nav__link">المقالات</a>
        </nav>

        


         


         <a href="<?php echo e(route('site.home')); ?>" class="dt-logo">
            <span class="dt-logo__mark" style="background:#fff; border: 1px solid var(--dt-line); box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <img src="<?php echo e(asset('front/assets/img/logo/Silver-blue.png')); ?>" alt="د.محمد حمزة" style="width: 45px; height: 28px; object-fit: contain;">
            </span>
            <span class="dt-logo__text dt-logo-stacked">
                <span class="dt-stack-top">عيادة الدكتور</span>
                <strong class="dt-stack-mid">محمد حمزة</strong>
                <span class="dt-stack-bot">لطب الأسنان</span>
            </span>
        </a>

        <nav class="dt-nav dt-nav--end" id="dtNavEnd">
            <a href="<?php echo e(route('about')); ?>" class="dt-nav__link">من نحن</a>
            <a href="<?php echo e(route('site.home')); ?>#reviews" class="dt-nav__link">آراء العملاء</a>
            <a href="<?php echo e(route('message_contact')); ?>" class="dt-nav__link">تواصل معنا</a>
        </nav>

        <div class="dt-header__actions">
            <a href="tel:+201042917680" class="dt-phone">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .3 2 .7 3a2 2 0 0 1-.4 2.1L8 10.2a16 16 0 0 0 6 6l1.4-1.4a2 2 0 0 1 2.1-.4c1 .4 2 .6 3 .7a2 2 0 0 1 1.7 2z"/></svg>
                <span>0 10 42917680</span>
            </a>
            <a href="<?php echo e(route('site.home')); ?>#booking" class="dt-cta">احجز موعدك</a>
        </div>
    </div>

    <div class="dt-mobile-panel" id="dtMobilePanel">
        <a href="<?php echo e(route('site.home')); ?>" class="dt-mobile-link">الرئيسية</a>
        <a href="<?php echo e(route('site.home')); ?>#services" class="dt-mobile-link">خدماتنا</a>
        <a href="<?php echo e(route('site.home')); ?>#before-after" class="dt-mobile-link">قبل وبعد</a>
        <a href="<?php echo e(route('about')); ?>" class="dt-mobile-link">من نحن</a>
        <a href="<?php echo e(route('site.home')); ?>#reviews" class="dt-mobile-link">آراء العملاء</a>
        <a href="<?php echo e(route('blogs.index')); ?>" class="dt-mobile-link">المقالات</a>
        <a href="<?php echo e(route('message_contact')); ?>" class="dt-mobile-link">تواصل معنا</a>
        <a href="<?php echo e(route('site.home')); ?>#booking" class="dt-cta dt-cta--block">احجز موعدك</a>
    </div>
</header>

<?php $__env->startPush('js'); ?>
<script>
    (function(){
        var header = document.getElementById('dtHeader');
        window.addEventListener('scroll', function(){
            header.classList.toggle('is-scrolled', window.scrollY > 12);
        });
        var burger = document.getElementById('dtBurger');
        var panel = document.getElementById('dtMobilePanel');
        burger.addEventListener('click', function(){
            panel.classList.toggle('is-open');
        });
    })();
</script>
<?php $__env->stopPush(); ?><?php /**PATH D:\laragon\www\dr_mohamed_hamza_el_sheikh\resources\views/front/includes/header.blade.php ENDPATH**/ ?>