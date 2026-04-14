@extends('frontend.layouts.app')

@section('title', $blog->title . ' - SR Greenscapes')

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
        background: url('{{ asset('storage/Home/1.5 Cover photo 5.jpg') }}') center/cover no-repeat;
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
        grid-template-columns: minmax(0, 1.7fr) minmax(300px, 0.9fr);
        gap: 34px;
        align-items: start;
    }
    .blog-article-card,
    .blog-contact-card {
        background: #fff;
        border-radius: 24px;
        border: 1px solid #edf3ea;
        box-shadow: 0 18px 45px rgba(22, 40, 22, 0.06);
    }
    .blog-article-card {
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

    .blog-sidebar {
        position: sticky;
        top: 110px;
    }
    .blog-contact-card {
        padding: 30px 28px;
        position: relative;
        overflow: hidden;
    }
    .blog-contact-card::before {
        content: '';
        position: absolute;
        inset: 0 0 auto 0;
        height: 5px;
        background: linear-gradient(90deg, var(--primary), var(--accent));
    }
    .blog-contact-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 12px;
    }
    .blog-contact-card h3 {
        font-size: 1.55rem;
        font-weight: 800;
        color: #1c2d1c;
        margin-bottom: 10px;
    }
    .blog-contact-card p {
        color: #70806f;
        font-size: 0.92rem;
        line-height: 1.75;
        margin-bottom: 20px;
    }
    .blog-contact-points {
        display: grid;
        gap: 10px;
        margin-bottom: 20px;
    }
    .blog-contact-point {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #495847;
        font-size: 0.86rem;
    }
    .blog-contact-point i {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #eef7e8;
        color: var(--primary-dark);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .blog-contact-card .form-control,
    .blog-contact-card .form-select,
    .blog-contact-card textarea {
        border: 1px solid #dde7d7;
        border-radius: 14px;
        padding: 13px 15px;
        font-size: 0.9rem;
        background: #fbfdf9;
        box-shadow: none;
    }
    .blog-contact-card .form-control:focus,
    .blog-contact-card .form-select:focus,
    .blog-contact-card textarea:focus {
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.08);
    }
    .blog-contact-card textarea {
        min-height: 120px;
        resize: vertical;
    }
    .blog-contact-submit {
        width: 100%;
        border: 0;
        border-radius: 14px;
        padding: 15px 18px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: #fff;
        font-size: 0.88rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .blog-contact-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(76, 175, 80, 0.24);
        color: #fff;
    }
    .blog-form-note {
        margin-top: 12px;
        font-size: 0.76rem;
        color: #879486;
        text-align: center;
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
        .blog-detail-layout {
            grid-template-columns: 1fr;
        }
        .blog-sidebar {
            position: static;
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
        .blog-article-body,
        .blog-contact-card {
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
                    src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('storage/Home/1.5 Cover photo 5.jpg') }}"
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
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>

            <aside class="blog-sidebar" data-aos="fade-up" data-aos-delay="100">
                <div class="blog-contact-card">
                    <div class="blog-contact-badge">
                        <i class="fas fa-paper-plane"></i> Contact Us
                    </div>
                    <h3>Need help with a landscaping project?</h3>
                    <p>Share your requirement with our team and we will get back to you with the right solution for your space.</p>

                    <div class="blog-contact-points">
                        <div class="blog-contact-point">
                            <i class="fas fa-leaf"></i>
                            <span>Consultation for residential, commercial and institutional landscapes</span>
                        </div>
                        <div class="blog-contact-point">
                            <i class="fas fa-clock"></i>
                            <span>Quick response from the SR Greenscapes team</span>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" style="border-radius: 14px; border: 0; background: #e8f5e9; color: var(--primary-dark);">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger mb-3" style="border-radius: 14px; border: 0; background: #fdeaea; color: #b42318;">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="blog-detail:{{ $blog->slug }}">

                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}" required>
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject', 'Blog Enquiry') }}">
                        </div>

                        <div class="mb-3">
                            <textarea name="message" class="form-control" placeholder="Tell us what you need...">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="blog-contact-submit">Send Enquiry</button>
                        <div class="blog-form-note">Your details are safe with us.</div>
                    </form>
                </div>
            </aside>
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
                            <img loading="lazy" src="{{ $rb->image ? asset('storage/' . $rb->image) : asset('storage/Home/1.5 Cover photo 5.jpg') }}" alt="{{ $rb->title }}">

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
