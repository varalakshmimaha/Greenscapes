@extends('frontend.layouts.app')

@section('title', $blog->title . ' - SR Greenscapes')
@section('meta_description', $blog->seo_description)
@section('meta_image', $blog->image ? \App\Helpers\ImageHelper::getImageUrl($blog->image) : asset('images/Home/1.5 Cover photo 5.jpg'))
@section('meta_type', 'article')
@section('canonical_url', route('blog.detail', $blog->slug))

@section('styles')
<style>
    .blog-banner {
        position: relative;
        min-height: 330px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .blog-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset('images/Home/1.5 Cover photo 5.jpg') }}') center/cover no-repeat;
        transform: scale(1.03);
    }
    .blog-banner::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(10, 28, 10, 0.9) 0%, rgba(22, 55, 22, 0.76) 55%, rgba(16, 42, 16, 0.88) 100%);
    }
    .blog-banner-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 130px 0 70px;
    }
    .blog-breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        font-size: 0.86rem;
    }
    .blog-breadcrumb a {
        color: rgba(255, 255, 255, 0.76);
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .blog-breadcrumb a:hover {
        color: var(--accent);
    }
    .blog-breadcrumb .sep {
        color: rgba(255, 255, 255, 0.35);
        font-size: 0.72rem;
    }
    .blog-breadcrumb .active {
        color: var(--accent);
        font-weight: 600;
    }

    .blog-detail-section {
        padding: 68px 0 76px;
        background: linear-gradient(180deg, #f8fbf7 0%, #ffffff 100%);
    }
    .blog-detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr);
        max-width: 920px;
        margin: 0 auto;
    }
    .blog-article-card {
        background: #fff;
        border-radius: 24px;
        border: 1px solid #edf3ea;
        box-shadow: 0 18px 45px rgba(22, 40, 22, 0.06);
        overflow: hidden;
    }
    .blog-featured-image {
        width: 100%;
        height: 460px;
        display: block;
        object-fit: cover;
        background: #eff5ed;
    }
    .blog-article-body {
        padding: 34px 36px 38px;
    }
    .blog-article-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        background: rgba(139, 195, 74, 0.12);
        border-radius: 999px;
        padding: 7px 16px;
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 18px;
    }
    .blog-article-title {
        font-size: 2.35rem;
        font-weight: 800;
        color: #1a2d19;
        line-height: 1.22;
        margin-bottom: 18px;
    }
    .blog-article-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        color: #6d7a6c;
        font-size: 0.9rem;
        margin-bottom: 26px;
    }
    .blog-article-meta i {
        color: var(--primary);
        margin-right: 7px;
    }
    .blog-excerpt {
        font-size: 1.02rem;
        line-height: 1.9;
        color: #516050;
        background: #f6faf4;
        border-left: 4px solid var(--primary);
        padding: 20px 22px;
        border-radius: 16px;
        margin-bottom: 28px;
    }
    .blog-content {
        color: #485647;
        font-size: 1rem;
        line-height: 1.95;
    }
    .blog-content p,
    .blog-content ul,
    .blog-content ol,
    .blog-content blockquote,
    .blog-content table {
        margin-bottom: 1.15rem;
    }
    .blog-content h2,
    .blog-content h3,
    .blog-content h4,
    .blog-content h5 {
        color: #1e301d;
        font-weight: 800;
        margin-top: 1.8rem;
        margin-bottom: 0.9rem;
        line-height: 1.35;
    }
    .blog-content a {
        color: var(--primary-dark);
        text-decoration: underline;
    }
    .blog-content ul,
    .blog-content ol {
        padding-left: 1.3rem;
    }
    .blog-content li {
        margin-bottom: 0.5rem;
    }
    .blog-content li::marker {
        color: var(--primary);
    }
    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 18px;
        margin: 1.4rem 0;
    }
    .blog-content blockquote {
        background: #fbfdf9;
        border-left: 4px solid var(--primary);
        border-radius: 16px;
        padding: 18px 22px;
        color: #3e4d3d;
    }

    .related-blogs-section {
        padding: 0 0 80px;
        background: #fff;
    }
    .related-blogs-wrap {
        padding-top: 10px;
    }
    .related-section-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-dark);
        background: rgba(139, 195, 74, 0.12);
        border-radius: 999px;
        padding: 7px 16px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 14px;
    }
    .related-blogs-wrap h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #1c2d1c;
        margin-bottom: 10px;
    }
    .related-blogs-wrap p {
        color: #70806f;
        font-size: 0.96rem;
        max-width: 640px;
        margin-bottom: 32px;
    }
    .related-blog-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #edf3ea;
        box-shadow: 0 10px 30px rgba(22, 40, 22, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none;
        display: block;
        height: 100%;
    }
    .related-blog-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 42px rgba(22, 40, 22, 0.1);
    }
    .related-blog-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }
    .related-blog-card .rbc-body {
        padding: 22px;
    }
    .related-blog-card .rbc-meta {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
        font-size: 0.78rem;
        color: #839081;
        margin-bottom: 12px;
    }
    .related-blog-card .rbc-meta i {
        color: var(--primary);
        margin-right: 5px;
    }
    .related-blog-card h6 {
        color: #1d2f1d;
        font-weight: 800;
        font-size: 1rem;
        line-height: 1.5;
        margin-bottom: 10px;
    }
    .related-blog-card p {
        color: #647162;
        font-size: 0.88rem;
        line-height: 1.7;
        margin-bottom: 0;
    }

    @media (max-width: 1199px) {
        .blog-article-title {
            font-size: 2.05rem;
        }
    }
    @media (max-width: 991px) {
        .blog-banner {
            min-height: 280px;
        }
        .blog-banner-inner {
            padding: 110px 0 56px;
        }
        .blog-featured-image {
            height: 360px;
        }
    }
    @media (max-width: 575px) {
        .blog-banner {
            min-height: 245px;
        }
        .blog-banner-inner {
            padding: 92px 0 40px;
        }
        .blog-detail-section {
            padding: 42px 0 50px;
        }
        .blog-featured-image {
            height: 240px;
        }
        .blog-article-body {
            padding: 24px 20px;
        }
        .blog-article-title {
            font-size: 1.55rem;
        }
        .blog-excerpt,
        .blog-content {
            font-size: 0.92rem;
        }
        .related-blogs-section {
            padding-bottom: 52px;
        }
        .related-blogs-wrap h2 {
            font-size: 1.55rem;
        }
        .related-blog-card img {
            height: 180px;
        }
    }
</style>
@endsection

@section('content')

<section class="blog-banner">
    <div class="blog-banner-inner">
        <div class="container">
            <div class="blog-breadcrumb" data-aos="fade-up">
                <a href="{{ url('/') }}">Home</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('blogs') }}">Blogs</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span class="active">{{ Str::limit($blog->title, 50) }}</span>
            </div>
        </div>
    </div>
</section>

<section class="blog-detail-section">
    <div class="container">
        <div class="blog-detail-layout">
            <div class="blog-article-card" data-aos="fade-up">
                <img
                    class="blog-featured-image"
                    loading="lazy"
                    src="{{ $blog->image ? \App\Helpers\ImageHelper::getImageUrl($blog->image) : asset('images/Home/1.5 Cover photo 5.jpg') }}"
                    alt="{{ $blog->title }}"
                >

                <div class="blog-article-body">
                    <div class="blog-article-label">
                        <i class="fas fa-feather-alt"></i> Featured Article
                    </div>

                    <h2 class="blog-article-title">{{ $blog->title }}</h2>

                    <div class="blog-article-meta">
                        @if($blog->published_at)
                            <span><i class="fas fa-calendar-alt"></i>{{ $blog->published_at->format('F d, Y') }}</span>
                        @endif
                        @if($blog->author)
                            <span><i class="fas fa-user"></i>{{ $blog->author }}</span>
                        @endif
                    </div>

                    @if($blog->excerpt)
                        <div class="blog-excerpt">
                            {{ $blog->excerpt }}
                        </div>
                    @endif

                    <div class="blog-content">
                        {!! $blog->formatted_content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($relatedBlogs->count())
<section class="related-blogs-section">
    <div class="container">
        <div class="related-blogs-wrap">
            <div class="related-section-label" data-aos="fade-up">
                <i class="fas fa-newspaper"></i> Related Blogs
            </div>
            <h2 data-aos="fade-up" data-aos-delay="80">More Insights You May Like</h2>
            <p data-aos="fade-up" data-aos-delay="120">Explore more articles, updates and ideas from the SR Greenscapes blog.</p>

            <div class="row g-4">
                @foreach($relatedBlogs as $rb)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="{{ route('blog.detail', $rb->slug) }}" class="related-blog-card">
                            <img loading="lazy" src="{{ $rb->image ? \App\Helpers\ImageHelper::getImageUrl($rb->image) : asset('images/Home/1.5 Cover photo 5.jpg') }}" alt="{{ $rb->title }}">

                            <div class="rbc-body">
                                <div class="rbc-meta">
                                    @if($rb->published_at)
                                        <span><i class="fas fa-calendar-alt"></i>{{ $rb->published_at->format('M d, Y') }}</span>
                                    @endif
                                    @if($rb->author)
                                        <span><i class="fas fa-user"></i>{{ $rb->author }}</span>
                                    @endif
                                </div>

                                <h6>{{ $rb->title }}</h6>
                                <p>{{ Str::limit($rb->excerpt ?: strip_tags($rb->content), 110) }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

@endsection
