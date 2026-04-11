@extends('frontend.layouts.app')

@section('title', $blog->title . ' - SR Greenscapes')

@section('styles')
<style>
    .blog-detail-hero {
        position: relative;
        width: 100%;
        height: 380px;
        display: flex;
        align-items: flex-end;
    }
    .blog-detail-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ $blog->image ? asset("storage/" . $blog->image) : asset("storage/Home/1.5 Cover photo 5.jpg") }}') center/cover no-repeat;
    }
    .blog-detail-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(transparent 30%, rgba(0,0,0,0.8));
    }
    .blog-detail-hero-content {
        position: relative;
        z-index: 2;
        padding: 40px;
        width: 100%;
        max-width: 900px;
    }
    .blog-detail-hero-content h1 {
        color: #fff;
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.3;
        margin-bottom: 15px;
    }
    .blog-detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        color: rgba(255,255,255,0.7);
        font-size: 0.85rem;
    }
    .blog-detail-meta i {
        color: var(--primary);
        margin-right: 6px;
    }

    .blog-detail-body {
        max-width: 850px;
        margin: 0 auto;
        padding: 50px 20px;
    }
    .blog-detail-body .blog-content {
        font-size: 1.05rem;
        line-height: 2;
        color: #444;
    }
    .blog-detail-body .blog-content p {
        margin-bottom: 1.5rem;
    }
    .blog-detail-body .blog-content img {
        max-width: 100%;
        border-radius: 12px;
        margin: 20px 0;
    }

    .related-blogs h3 {
        font-weight: 700;
        color: #1a3a1a;
        margin-bottom: 30px;
    }
    .related-blog-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        transition: all 0.3s;
        text-decoration: none;
        display: block;
    }
    .related-blog-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .related-blog-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    .related-blog-card .rbc-body {
        padding: 20px;
    }
    .related-blog-card .rbc-body h6 {
        color: #1a3a1a;
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 8px;
    }
    .related-blog-card .rbc-body small {
        color: #999;
        font-size: 0.78rem;
    }

    @media (max-width: 575px) {
        .blog-detail-hero { height: 280px; }
        .blog-detail-hero-content { padding: 20px; }
        .blog-detail-hero-content h1 { font-size: 1.5rem; }
        .blog-detail-meta { font-size: 0.75rem; gap: 12px; }
        .blog-detail-body { padding: 30px 15px; }
        .blog-detail-body .blog-content { font-size: 0.92rem; line-height: 1.8; }
        .related-blog-card img { height: 140px; }
    }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="blog-detail-hero">
    <div class="blog-detail-hero-content" data-aos="fade-up">
        @if($blog->category)
            <span style="display:inline-block;background:var(--primary);color:#fff;padding:5px 16px;border-radius:50px;font-size:0.75rem;font-weight:600;letter-spacing:0.5px;text-transform:uppercase;margin-bottom:15px;">{{ $blog->category }}</span>
        @endif
        <h1>{{ $blog->title }}</h1>
        <div class="blog-detail-meta">
            @if($blog->published_at)
                <span><i class="fas fa-calendar-alt"></i> {{ $blog->published_at->format('F d, Y') }}</span>
            @endif
            @if($blog->author)
                <span><i class="fas fa-user"></i> {{ $blog->author }}</span>
            @endif
        </div>
    </div>
</div>

<!-- Blog Content -->
<section style="background: #f9fbf9;">
    <div class="blog-detail-body">
        @if($blog->excerpt)
            <p style="font-size:1.15rem; color:#555; font-style:italic; border-left:4px solid var(--primary); padding-left:20px; margin-bottom:35px;">
                {{ $blog->excerpt }}
            </p>
        @endif

        <div class="blog-content">
            {!! $blog->content !!}
        </div>
    </div>
</section>

<!-- Related Blogs -->
@if($relatedBlogs->count())
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="related-blogs">
            <h3>Related Posts</h3>
            <div class="row g-4">
                @foreach($relatedBlogs as $rb)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up">
                        <a href="{{ route('blog.detail', $rb->slug) }}" class="related-blog-card">
                            <img src="{{ $rb->image ? asset('storage/' . $rb->image) : asset('storage/Home/1.5 Cover photo 5.jpg') }}" alt="{{ $rb->title }}">
                            <div class="rbc-body">
                                <h6>{{ $rb->title }}</h6>
                                <small><i class="fas fa-calendar-alt me-1" style="color:var(--primary);"></i> {{ $rb->published_at ? $rb->published_at->format('M d, Y') : '' }}</small>
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
