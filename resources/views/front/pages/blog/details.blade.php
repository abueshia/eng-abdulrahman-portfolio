@extends('front.layouts.app')

@section('title', $blog->getTranslation('name', 'ar') . ' - بايو كلينك')
@section('meta')
    <meta name="description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->getTranslation('description', 'ar')), 150) }}">
    <meta name="keywords" content="{{ $blog->meta_tags ?? 'أسنان, صحة الفم' }}">
@endsection

@section('content')
<style>
    .dt-article-header {
        position: relative;
        padding: 160px 0 100px;
        background: linear-gradient(120deg, var(--dt-teal) 0%, var(--dt-teal-deep) 100%);
        color: #fff;
        text-align: center;
        overflow: hidden;
    }
    .dt-article-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top, rgba(201, 164, 85, 0.15) 0%, transparent 70%);
    }
    .dt-article-header__container {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .dt-article-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        font-size: 14.5px;
        color: var(--dt-mint);
        margin-bottom: 24px;
        font-weight: 700;
    }
    .dt-article-meta span {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .dt-article-meta span i {
        font-size: 13px;
    }
    .dt-article-title {
        font-family: var(--dt-font-head);
        font-size: 46px;
        line-height: 1.3;
        margin: 0 0 24px;
    }

    .dt-article-body {
        padding: 60px 0 100px;
        background: var(--dt-porcelain);
    }
    .dt-article-content {
        max-width: 840px;
        margin: -120px auto 0;
        background: #fff;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 30px 60px -20px rgba(0,0,0,0.08);
        position: relative;
        z-index: 10;
    }
    .dt-article-image {
        width: 100%;
        height: 450px;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
    }
    .dt-article-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .dt-prose {
        font-family: var(--dt-font-body);
        font-size: 17.5px;
        line-height: 2;
        color: var(--dt-ink);
    }
    .dt-prose h2, .dt-prose h3 {
        font-family: var(--dt-font-head);
        color: var(--dt-teal-deep);
        margin: 40px 0 20px;
    }
    .dt-prose p {
        margin-bottom: 24px;
    }
    .dt-prose ul, .dt-prose ol {
        margin-bottom: 24px;
        padding-right: 24px;
    }
    .dt-prose li {
        margin-bottom: 12px;
    }
    .dt-prose strong {
        color: var(--dt-coral-deep);
    }

    .dt-related {
        margin-top: 80px;
        border-top: 1px solid var(--dt-line);
        padding-top: 60px;
    }
    .dt-related-title {
        font-family: var(--dt-font-head);
        font-size: 28px;
        color: var(--dt-teal-deep);
        text-align: center;
        margin-bottom: 40px;
    }
    .dt-related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 24px;
    }

    /* Reuse blog card styles for related */
    .dt-blog-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--dt-line);
        transition: transform .3s, box-shadow .3s;
        display: flex;
        flex-direction: column;
        height: 100%;
        text-decoration: none;
        color: var(--dt-ink);
    }
    .dt-blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -15px rgba(33, 29, 22, 0.1);
    }
    .dt-blog-card__img {
        position: relative;
        width: 100%;
        padding-top: 60%;
        background: #eee;
        overflow: hidden;
    }
    .dt-blog-card__img img {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s;
    }
    .dt-blog-card:hover .dt-blog-card__img img {
        transform: scale(1.05);
    }
    .dt-blog-card__body {
        padding: 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .dt-blog-card__title {
        font-family: var(--dt-font-head);
        font-size: 20px;
        line-height: 1.4;
        margin: 0 0 12px;
        color: var(--dt-teal-deep);
        transition: color .2s;
    }
    .dt-blog-card:hover .dt-blog-card__title {
        color: var(--dt-coral-deep);
    }
    .dt-blog-card__footer {
        border-top: 1px solid var(--dt-line);
        padding-top: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13.5px;
        color: #777;
    }
    .dt-blog-card__readmore {
        color: var(--dt-coral);
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    @media (max-width: 768px) {
        .dt-article-header { padding: 120px 0 140px; }
        .dt-article-title { font-size: 32px; }
        .dt-article-content { padding: 24px; margin-top: -100px; }
        .dt-article-image { height: 250px; margin-bottom: 24px; }
        .dt-prose { font-size: 16px; }
    }
</style>

<div class="dt-article-header">
    <div class="dt-article-header__container">
        <div class="dt-article-meta" data-aos="fade-down">
            <span><i class="fa-solid fa-folder"></i> {{ $blog->categories ? $blog->categories->getTranslation('name', 'ar') : 'العناية بالأسنان' }}</span>
            <span><i class="fa-solid fa-calendar"></i> {{ $blog->created_at->format('Y-m-d') }}</span>
        </div>
        <h1 class="dt-article-title" data-aos="fade-up" data-aos-delay="100">{{ $blog->getTranslation('name', 'ar') }}</h1>
    </div>
</div>

<section class="dt-article-body">
    <div class="dt-container">
        <div class="dt-article-content">
            <div class="dt-article-image" data-aos="zoom-in">
                @php
                    $fallbackImages = [
                        'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?q=80&w=1200&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1598256989800-fea5ce590924?q=80&w=1200&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?q=80&w=1200&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?q=80&w=1200&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1555243896-771a81254bf7?q=80&w=1200&auto=format&fit=crop'
                    ];
                    $imageIndex = $blog->id % count($fallbackImages);
                    $imgSrc = $blog->getFirstMediaUrl('images') ?: $fallbackImages[$imageIndex];
                @endphp
                <img src="{{ $imgSrc }}" alt="{{ $blog->getTranslation('name', 'ar') }}">
            </div>
            
            <div class="dt-prose">
                {!! $blog->getTranslation('description', 'ar') !!}
            </div>
            
            @if(isset($blogs) && $blogs->count() > 0)
                <div class="dt-related">
                    <h3 class="dt-related-title">مقالات ذات صلة قد تهمك</h3>
                    <div class="dt-related-grid">
                        @foreach($blogs->take(3) as $related)
                            <a href="{{ route('blogs.details', $related->slug) }}" class="dt-blog-card">
                                <div class="dt-blog-card__img">
                                    @php
                                        $relIndex = $related->id % count($fallbackImages);
                                        $relImg = $related->getFirstMediaUrl('images') ?: $fallbackImages[$relIndex];
                                    @endphp
                                    <img src="{{ $relImg }}" alt="{{ $related->getTranslation('name', 'ar') }}">
                                </div>
                                <div class="dt-blog-card__body">
                                    <h3 class="dt-blog-card__title" style="font-size:18px;">{{ $related->getTranslation('name', 'ar') }}</h3>
                                    <div class="dt-blog-card__footer">
                                        <span class="dt-blog-card__readmore">اقرأ المزيد <i class="fa-solid fa-arrow-left"></i></span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
