@extends('frontend.layouts.app')

@section('title', $category->name . ' - ' . $service->name . ' - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO BANNER ===== */
    .scd-hero {
        position: relative;
        width: 100%;
        min-height: 380px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .scd-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ $category->image ? asset("storage/" . $category->image) : ($service->image ? asset("storage/" . $service->image) : asset("storage/Home/1.2 Cover photo 2.jpg")) }}') center/cover no-repeat;
        transition: transform 8s ease;
    }
    .scd-hero:hover::before { transform: scale(1.03); }
    .scd-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(10,30,10,0.88) 0%, rgba(15,40,15,0.7) 50%, rgba(20,50,20,0.55) 100%);
    }
    .scd-hero-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 80px 0 55px;
    }
    .scd-hero .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.88rem;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    .scd-hero .breadcrumb-nav a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        transition: color 0.2s;
    }
    .scd-hero .breadcrumb-nav a:hover { color: var(--primary); }
    .scd-hero .breadcrumb-nav .sep { color: rgba(255,255,255,0.35); font-size: 0.75rem; }
    .scd-hero .breadcrumb-nav .active { color: var(--primary); font-weight: 600; }
    .scd-hero-title {
        font-size: 3rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: 16px;
        line-height: 1.15;
        text-shadow: 0 3px 12px rgba(0,0,0,0.3);
    }
    .scd-hero-badges {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .scd-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(139,195,74,0.15);
        border: 1px solid rgba(139,195,74,0.3);
        color: var(--primary);
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }
    .scd-hero-badge i { font-size: 0.75rem; }

    /* ===== CONTENT: Image + Description ===== */
    .scd-content {
        padding: 65px 0 60px;
        background: #fff;
    }
    .scd-content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: start;
    }
    .scd-content-left .scd-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(139,195,74,0.1);
        color: var(--primary-dark);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 14px;
    }
    .scd-content-left .scd-title {
        font-size: 2.1rem;
        font-weight: 800;
        color: #1a2a1a;
        margin-bottom: 24px;
        line-height: 1.25;
    }
    .scd-content-left .scd-title span { color: var(--primary); }
    .scd-content-img {
        width: 100%;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    }
    .scd-content-img img {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s;
    }
    .scd-content-img:hover img { transform: scale(1.03); }

    .scd-content-right {
        padding-top: 10px;
    }
    .scd-content-right .scd-sub {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 16px;
        border-left: 3px solid var(--primary);
        padding-left: 12px;
    }
    .scd-content-right .scd-short-desc {
        font-size: 1.05rem;
        color: #444;
        line-height: 1.85;
        margin-bottom: 22px;
        font-weight: 500;
    }
    .scd-content-right .scd-full-desc {
        color: #666;
        font-size: 0.93rem;
        line-height: 1.9;
    }
    .scd-content-right .scd-full-desc h2,
    .scd-content-right .scd-full-desc h3,
    .scd-content-right .scd-full-desc h4 {
        color: #1a2a1a;
        font-weight: 700;
        margin-top: 20px;
        margin-bottom: 8px;
    }
    .scd-content-right .scd-full-desc p { margin-bottom: 12px; }
    .scd-content-right .scd-full-desc ul,
    .scd-content-right .scd-full-desc ol { padding-left: 20px; margin-bottom: 14px; }
    .scd-content-right .scd-full-desc li { margin-bottom: 5px; line-height: 1.75; }
    .scd-content-right .scd-full-desc li::marker { color: var(--primary); }

    /* PDF Download */
    .scd-pdf-btn {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        background: #fff;
        border: 2px solid var(--primary);
        border-radius: 14px;
        padding: 14px 22px;
        text-decoration: none;
        color: #1a2a1a;
        font-weight: 600;
        font-size: 0.88rem;
        transition: all 0.3s;
        margin-top: 22px;
    }
    .scd-pdf-btn:hover { background: var(--primary); color: #fff; }
    .scd-pdf-btn .pdf-icon { font-size: 1.8rem; color: #e53935; transition: color 0.3s; }
    .scd-pdf-btn:hover .pdf-icon { color: #fff; }

    /* ===== SECTION COMMON ===== */
    .scd-section-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(139,195,74,0.1);
        color: var(--primary-dark);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 14px;
    }
    .scd-section-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a2a1a;
        margin-bottom: 20px;
    }
    .scd-section-title span { color: var(--primary); }

    /* ===== SUB CATEGORIES GRID ===== */
    .scd-subcategories {
        padding: 70px 0;
        background: #f8faf8;
    }
    .scd-subcat-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid #e7efe7;
        transition: all 0.4s;
        height: 100%;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        text-decoration: none;
    }
    .scd-subcat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 45px rgba(0,0,0,0.12);
        border-color: rgba(139,195,74,0.3);
    }
    .scd-subcat-img {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }
    .scd-subcat-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .scd-subcat-card:hover .scd-subcat-img img {
        transform: scale(1.05);
    }
    .scd-subcat-body {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .scd-subcat-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #1a2a1a;
        margin-bottom: 10px;
        line-height: 1.45;
    }
    .scd-subcat-desc {
        font-size: 0.9rem;
        color: #6b776b;
        line-height: 1.75;
        flex: 1;
        margin-bottom: 16px;
    }
    .scd-subcat-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-dark);
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: gap 0.3s ease;
    }
    .scd-subcat-card:hover .scd-subcat-link { gap: 12px; }

    /* ===== SIBLING CATEGORIES ===== */
    .scd-siblings { padding: 70px 0 80px; background: #fff; }
    .scd-sib-card {
        border-radius: 20px; overflow: hidden;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08); transition: all 0.4s; height: 100%;
        background: #eaf5ea;
        display: flex; flex-direction: column; align-items: center; text-align: center;
        padding: 35px 25px 28px; border: none; text-decoration: none;
    }
    .scd-sib-card:hover { transform: translateY(-8px); box-shadow: none; }
    .scd-sib-card .sib-img {
        width: 120px; height: 120px; border-radius: 50%; overflow: hidden;
        margin-bottom: 20px; border: 4px solid rgba(139,195,74,0.25); transition: border-color 0.3s; flex-shrink: 0;
    }
    .scd-sib-card:hover .sib-img { border-color: var(--primary); }
    .scd-sib-card .sib-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
    .scd-sib-card:hover .sib-img img { transform: scale(1.1); }
    .scd-sib-card .sib-name { font-weight: 700; font-size: 1.05rem; color: #2d3a2d; margin-bottom: 8px; }
    .scd-sib-card .sib-desc { font-size: 0.82rem; color: #555; line-height: 1.65; flex: 1; margin-bottom: 14px; }
    .scd-sib-card .sib-link { display: inline-flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 600; font-size: 0.85rem; transition: all 0.3s; }
    .scd-sib-card:hover .sib-link { gap: 12px; }
    .scd-sib-card .sib-link i { font-size: 0.7rem; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .scd-hero { min-height: 320px; }
        .scd-hero-title { font-size: 2.2rem; }
        .scd-content-grid { grid-template-columns: 1fr; gap: 30px; }
        .scd-content-img img { height: 320px; }
    }
    @media (max-width: 575px) {
        .scd-hero { min-height: 260px; }
        .scd-hero-inner { padding: 50px 0 40px; }
        .scd-hero-title { font-size: 1.7rem; }
        .scd-hero .breadcrumb-nav { font-size: 0.78rem; }
        .scd-hero-badges { gap: 8px; }
        .scd-hero-badge { padding: 6px 12px; font-size: 0.75rem; }
        .scd-content { padding: 40px 0 35px; }
        .scd-content-left .scd-title { font-size: 1.5rem; }
        .scd-content-img img { height: 250px; }
        .scd-section-title { font-size: 1.5rem; }
        .scd-subcategories { padding: 45px 0; }
        .scd-siblings { padding: 45px 0 55px; }
        .scd-sib-card { padding: 28px 20px 24px; }
        .scd-sib-card .sib-img { width: 100px; height: 100px; }
    }
</style>
@endsection

@section('content')

{{-- ===== 1. HERO BANNER ===== --}}
<section class="scd-hero">
    <div class="scd-hero-inner">
        <div class="container">
            <div class="breadcrumb-nav" data-aos="fade-down" data-aos-delay="100">
                <a href="/"><i class="fas fa-home"></i></a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <a href="/services">Services</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('service.detail', $service->slug) }}">{{ $service->name }}</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span class="active">{{ $category->name }}</span>
            </div>

            <h1 class="scd-hero-title" data-aos="fade-up">{{ $category->name }}</h1>

            <div class="scd-hero-badges" data-aos="fade-up" data-aos-delay="200">
                <span class="scd-hero-badge"><i class="fas fa-leaf"></i> {{ $service->name }}</span>
                @if($subCategories->count())
                    <span class="scd-hero-badge"><i class="fas fa-list"></i> {{ $subCategories->count() }} Sub Categories</span>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ===== 2. CONTENT: Image + Description ===== --}}
<section class="scd-content">
    <div class="container">
        <div class="scd-content-grid">
            {{-- Left: Image --}}
            <div class="scd-content-left" data-aos="fade-right">
                <span class="scd-label"><i class="fas fa-info-circle"></i> Category Details</span>
                <h2 class="scd-title">{{ $category->name }}</h2>

                <div class="scd-content-img">
                    @if($category->image)
                        <img loading="lazy" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                    @elseif($service->image)
                        <img loading="lazy" src="{{ asset('storage/' . $service->image) }}" alt="{{ $category->name }}">
                    @else
                        <img loading="lazy" src="{{ asset('storage/Home/1.1Cover photo 1.jpg') }}" alt="{{ $category->name }}">
                    @endif
                </div>

                @if($category->pdf)
                    <a href="{{ asset('storage/' . $category->pdf) }}" target="_blank" class="scd-pdf-btn">
                        <i class="fas fa-file-pdf pdf-icon"></i>
                        <div>
                            <div>Download Brochure</div>
                            <small style="font-weight:400;opacity:0.6;font-size:0.78rem;">PDF Document - Click to view</small>
                        </div>
                    </a>
                @endif
            </div>

            {{-- Right: Description --}}
            <div class="scd-content-right" data-aos="fade-left" data-aos-delay="100">
                <div class="scd-sub"><i class="fas fa-layer-group"></i> {{ $service->name }}</div>

                @if($category->description)
                    <p class="scd-short-desc">{{ Str::limit(strip_tags($category->description), 200) }}</p>
                    <div class="scd-full-desc">
                        {!! $category->description !!}
                    </div>
                @else
                    <p class="scd-short-desc">Explore the specialized services offered under {{ $category->name }} in our {{ $service->name }} division.</p>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ===== 3. SUB CATEGORIES ===== --}}
@if($subCategories->count())
<section class="scd-subcategories">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="scd-section-label"><i class="fas fa-th-large"></i> Sub Categories</span>
            <h2 class="scd-section-title">{{ $category->name }} <span>Sub Categories</span></h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($subCategories as $sub)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <a href="{{ route('service.subcategory.detail', [$service->slug, $category->slug, $sub->slug]) }}" class="scd-subcat-card">
                        <div class="scd-subcat-img">
                            @if($sub->image)
                                <img loading="lazy" src="{{ asset('storage/' . $sub->image) }}" alt="{{ $sub->name }}">
                            @elseif($category->image)
                                <img loading="lazy" src="{{ asset('storage/' . $category->image) }}" alt="{{ $sub->name }}">
                            @else
                                <img loading="lazy" src="{{ asset('storage/' . ($service->image ?? 'Home/1.1Cover photo 1.jpg')) }}" alt="{{ $sub->name }}">
                            @endif
                        </div>
                        <div class="scd-subcat-body">
                            <h5 class="scd-subcat-title">{{ $sub->name }}</h5>
                            <p class="scd-subcat-desc">
                                @if($sub->description)
                                    {{ Str::limit(strip_tags($sub->description), 120) }}
                                @else
                                    Specialized solutions under {{ $category->name }}.
                                @endif
                            </p>
                            <span class="scd-subcat-link">View Details <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== 4. OTHER CATEGORIES ===== --}}
@if($siblingCategories->count())
<section class="scd-siblings">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="scd-section-label"><i class="fas fa-star"></i> More Categories</span>
            <h2 class="scd-section-title">Other <span>{{ $service->name }} Categories</span></h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($siblingCategories as $sib)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <a href="{{ route('service.category.detail', [$service->slug, $sib->slug]) }}" class="scd-sib-card">
                        <div class="sib-img">
                            @if($sib->image)
                                <img loading="lazy" src="{{ asset('storage/' . $sib->image) }}" alt="{{ $sib->name }}">
                            @else
                                <div style="width:100%;height:100%;background:#2d3a2d;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-leaf" style="font-size:2rem;color:#4a6a4a;"></i>
                                </div>
                            @endif
                        </div>
                        <span class="sib-name">{{ $sib->name }}</span>
                        <span class="sib-desc">{{ Str::limit(strip_tags($sib->description), 90) }}</span>
                        <span class="sib-link">Explore Category <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
