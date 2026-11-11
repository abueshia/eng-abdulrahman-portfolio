@extends('front.layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@500;600;700&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    :root {
        --dt-porcelain: #FBFAF7;
        --dt-ink: #211D16;
        --dt-teal: #3F3323;
        --dt-teal-deep: #1E1810;
        --dt-mint: #E9D9B0;
        --dt-coral: #B8863A;
        --dt-gold: #C9A455;
        --dt-line: #E8DFC9;
        --dt-font-head: 'El Messiri', serif;
        --dt-font-body: 'Tajawal', sans-serif;
    }

    .dt-cases-page {
        background: var(--dt-porcelain);
        font-family: var(--dt-font-body);
        color: var(--dt-ink);
        overflow-x: hidden;
    }

    /* ---------- HERO ---------- */
    .dt-cases-hero {
        position: relative;
        padding: 40px 0;
        background: linear-gradient(150deg, var(--dt-teal-deep) 0%, var(--dt-teal) 100%);
        color: #fff;
        text-align: center;
        overflow: hidden;
    }

    .dt-cases-hero::before {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: url('{{ asset('front/assets/img/rrr.jpeg') }}') center/cover;
        opacity: 0.15;
        mix-blend-mode: overlay;
    }

    .dt-cases-hero__inner {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
    }

    .dt-cases-hero .dt-eyebrow-free {
        font-size: 16px;
        margin-bottom: 12px;
        color: var(--dt-gold);
        background: rgba(201, 164, 85, 0.15);
        padding: 6px 16px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 700;
        border: 1px solid rgba(201, 164, 85, 0.3);
    }

    .dt-cases-hero .dt-h2 {
        font-family: var(--dt-font-head);
        font-size: clamp(40px, 5vw, 70px);
        margin-bottom: 24px;
        color: var(--dt-mint);
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .dt-cases-hero .dt-p {
        margin: 0 auto 30px;
        font-size: 20px;
        max-width: 650px;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.8;
    }

    /* ---------- GRID ---------- */
    .dt-cases-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 50px;
        padding: 60px 0 120px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .dt-case-card {
        background: #fff;
        border-radius: 24px;
        padding: 30px;
        border: 1px solid var(--dt-line);
        box-shadow: 0 20px 50px -20px rgba(30, 24, 16, 0.1);
        transition: transform 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
        position: relative;
    }

    .dt-case-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px -20px rgba(30, 24, 16, 0.15);
        border-color: var(--dt-gold);
    }

    .dt-case-title {
        font-family: var(--dt-font-head);
        font-size: 26px;
        color: var(--dt-teal-deep);
        margin-top: 25px;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .dt-case-desc {
        font-size: 16px;
        color: #555;
        line-height: 1.7;
        margin-bottom: 0;
    }

    /* ---------- SLIDER UI ---------- */
    .dt-ba__slider {
        position: relative;
        height: 300px;
        width: 100%;
        border-radius: 16px;
        overflow: hidden;
        cursor: ew-resize;
        user-select: none;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.2);
    }

    .dt-ba__img {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-size: cover;
        background-position: center;
    }

    .dt-ba__img--before {
        clip-path: polygon(0 0, 50% 0, 50% 100%, 0 100%);
        border-right: 2px solid #fff;
    }

    .dt-ba__tag {
        position: absolute;
        top: 15px;
        background: rgba(30, 24, 16, 0.7);
        color: var(--dt-mint);
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        z-index: 10;
        pointer-events: none;
    }
    .dt-ba__tag--start {
        right: 15px;
    }
    html[dir="ltr"] .dt-ba__tag--start {
        left: 15px;
        right: auto;
    }
    
    .dt-ba__tag--end {
        left: 15px;
    }
    html[dir="ltr"] .dt-ba__tag--end {
        right: 15px;
        left: auto;
    }
    .dt-ba__handle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 44px;
        height: 44px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 15px rgba(0,0,0,0.3);
        z-index: 10;
        pointer-events: none;
    }

    .dt-ba__handle i {
        color: var(--dt-gold);
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .dt-cases-grid {
            grid-template-columns: 1fr;
            padding: 40px 20px 80px;
        }
        .dt-cases-hero {
            padding: 80px 20px;
        }
    }
</style>

<div class="dt-cases-page">
    <div class="dt-cases-hero">
        <div class="dt-cases-hero__inner dt-container">
            <span class="dt-eyebrow-free">معرض الحالات</span>
            <h1 class="dt-h2">نتائج حقيقية، قبل وبعد</h1>
            <p class="dt-p">استكشف التغيير الحقيقي الذي نصنعه في عيادتنا. تصفح أحدث الحالات وشاهد كيف يمكننا تحويل ابتسامتك إلى الأفضل.</p>
        </div>
    </div>

    <div class="dt-container">
        <div class="dt-cases-grid">
            @forelse($cases as $case)
                <div class="dt-case-card">
                    <div class="dt-ba__slider">
                        @php
                            $afterImage = $case->getFirstMediaUrl('after_image') ?: asset('front/assets/img/after1.jpg');
                            $beforeImage = $case->getFirstMediaUrl('before_image') ?: asset('front/assets/img/before1.jpg');
                        @endphp
                        
                        <!-- After (Bottom Layer) -->
                        <div class="dt-ba__img dt-ba__img--after"
                            style="background-image: url('{{ $afterImage }}');">
                        </div>
                        
                        <!-- Before (Top Layer) -->
                        <div class="dt-ba__img dt-ba__img--before"
                            style="background-image: url('{{ $beforeImage }}');">
                        </div>

                        <span class="dt-ba__tag dt-ba__tag--start">{{ app()->getLocale() == 'ar' ? 'قبل' : 'Before' }}</span>
                        <span class="dt-ba__tag dt-ba__tag--end">{{ app()->getLocale() == 'ar' ? 'بعد' : 'After' }}</span>

                        <div class="dt-ba__handle">
                            <i class="fa-solid fa-arrows-left-right"></i>
                        </div>
                    </div>
                    
                    <h3 class="dt-case-title">{{ $case->title ?? 'حالة مميزة' }}</h3>
                    <p class="dt-case-desc">{{ $case->description ?? 'لا يوجد وصف متاح.' }}</p>
                </div>
            @empty
                <div style="text-align: center; width: 100%; grid-column: 1 / -1; padding: 50px 0;">
                    <h3 class="dt-h3" style="color: var(--dt-teal);">لا توجد حالات مضافة حالياً.</h3>
                </div>
            @endforelse
        </div>

        @if($cases->hasPages())
            <div class="d-flex justify-content-center mt-4 mb-5">
                {{ $cases->links() }}
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var baSliders = document.querySelectorAll('.dt-ba__slider');
    baSliders.forEach(function(slider) {
        var before = slider.querySelector('.dt-ba__img--before');
        var handle = slider.querySelector('.dt-ba__handle');
        var dragging = false;

        function setPos(clientX) {
            var rect = slider.getBoundingClientRect();
            var x = Math.min(Math.max(clientX - rect.left, 0), rect.width);
            var pct = (x / rect.width) * 100;
            var isRTL = getComputedStyle(slider).direction === 'rtl';

            if (isRTL) {
                before.style.clipPath = 'polygon(' + pct + '% 0, 100% 0, 100% 100%, ' + pct + '% 100%)';
            } else {
                before.style.clipPath = 'polygon(0 0, ' + pct + '% 0, ' + pct + '% 100%, 0 100%)';
            }

            handle.style.left = pct + '%';
            handle.style.right = 'auto';
        }

        // Initialize positions
        var isRTL = getComputedStyle(slider).direction === 'rtl';
        before.style.clipPath = isRTL ? 'polygon(50% 0, 100% 0, 100% 100%, 50% 100%)' :
            'polygon(0 0, 50% 0, 50% 100%, 0 100%)';
        handle.style.left = '50%';

        slider.addEventListener('mousedown', function(e) {
            dragging = true;
            setPos(e.clientX);
        });
        window.addEventListener('mouseup', function() {
            dragging = false;
        });
        window.addEventListener('mousemove', function(e) {
            if (dragging) setPos(e.clientX);
        });

        slider.addEventListener('touchstart', function(e) {
            dragging = true;
            setPos(e.touches[0].clientX);
        }, {
            passive: true
        });
        window.addEventListener('touchend', function() {
            dragging = false;
        });
        slider.addEventListener('touchmove', function(e) {
            if (dragging) setPos(e.touches[0].clientX);
        }, {
            passive: true
        });
    });
});
</script>

@endsection
