@extends('frontend.layouts.app')

@section('title', 'Blogs - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO ===== */
    .blogs-hero {
        position: relative;
        width: 100%;
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .blogs-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset('storage/Home/1.5 Cover photo 5.jpg') }}') center/cover no-repeat;
    }
    .blogs-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(20, 45, 25, 0.70);
    }
    .blogs-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .blogs-hero-content h1 {
        color: #fff;
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .blogs-hero-content p {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.15rem;
        max-width: 650px;
        margin: 0 auto;
    }

    /* ===== BLOG CARD ===== */
    .blog-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #eee;
    }
    .blog-card:hover {
        box-shadow: 0 12px 40px rgba(0,0,0,0.12);
        transform: translateY(-5px);
    }
    .blog-card-img {
        height: 220px;
        overflow: hidden;
    }
    .blog-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .blog-card:hover .blog-card-img img {
        transform: scale(1.05);
    }
    .blog-card-body {
        padding: 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .blog-card-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 12px;
        font-size: 0.8rem;
        color: #999;
    }
    .blog-card-meta i {
        color: var(--primary);
        margin-right: 4px;
    }
    .blog-card-category {
        display: inline-block;
        background: rgba(139,195,74,0.1);
        color: var(--primary);
        padding: 3px 12px;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .blog-card-body h5 {
        font-weight: 700;
        color: #1a3a1a;
        font-size: 1.1rem;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    .blog-card-body h5 a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s;
    }
    .blog-card-body h5 a:hover {
        color: var(--primary);
    }
    .blog-card-excerpt {
        color: #777;
        font-size: 0.9rem;
        line-height: 1.7;
        flex: 1;
        margin-bottom: 20px;
    }
    .blog-card-link {
        color: var(--primary);
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: gap 0.3s;
    }
    .blog-card-link:hover {
        gap: 10px;
        color: var(--primary-dark);
    }

    @media (max-width: 575px) {
        .blog-card-img { height: 180px; }
        .blog-card-body { padding: 18px; }
        .blog-card-body h5 { font-size: 0.95rem; }
        .blog-card-excerpt { font-size: 0.82rem; }
        .blog-card-meta { font-size: 0.72rem; gap: 8px; }
        .blog-card-link { font-size: 0.78rem; }
    }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="blogs-hero">
    <div class="blogs-hero-content" data-aos="fade-up">
        <h1>Our Blog</h1>
        <p>Insights, tips, and stories from the world of sustainable landscaping and green design.</p>
    </div>
</div>

<!-- Blog Grid -->
<section class="py-5" style="background: #f9fbf9;">
    <div class="container py-4">
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <div class="blog-card">
                        <div class="blog-card-img">
                            @if($blog->image)
                                <img loading="lazy" src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                            @else
                                <img loading="lazy" src="{{ asset('storage/Home/1.5 Cover photo 5.jpg') }}" alt="{{ $blog->title }}">
                            @endif
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-card-meta">
                                @if($blog->category)
                                    <span class="blog-card-category">{{ $blog->category }}</span>
                                @endif
                                <span><i class="fas fa-calendar-alt"></i> {{ $blog->published_at ? $blog->published_at->format('M d, Y') : '' }}</span>
                                @if($blog->author)
                                    <span><i class="fas fa-user"></i> {{ $blog->author }}</span>
                                @endif
                            </div>
                            <h5><a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a></h5>
                            <p class="blog-card-excerpt">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 120) }}</p>
                            <a href="{{ route('blog.detail', $blog->slug) }}" class="blog-card-link">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No blog posts available yet.</p>
                </div>
            @endforelse
        </div>

        @if($blogs->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
