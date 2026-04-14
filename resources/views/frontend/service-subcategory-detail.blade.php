@extends('frontend.layouts.app')

@section('title', $subCategory->name . ' - ' . $category->name . ' - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO BANNER ===== */
    .sscd-hero {
        position: relative;
        width: 100%;
        min-height: 380px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .sscd-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ $subCategory->image ? asset("storage/" . $subCategory->image) : ($category->image ? asset("storage/" . $category->image) : ($service->image ? asset("storage/" . $service->image) : asset("storage/Home/1.2 Cover photo 2.jpg"))) }}') center/cover no-repeat;
        transition: transform 8s ease;
    }
    .sscd-hero:hover::before { transform: scale(1.03); }
    .sscd-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(10,30,10,0.88) 0%, rgba(15,40,15,0.7) 50%, rgba(20,50,20,0.55) 100%);
    }
    .sscd-hero-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 80px 0 55px;
    }
    .sscd-hero .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.88rem;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    .sscd-hero .breadcrumb-nav a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        transition: color 0.2s;
    }
    .sscd-hero .breadcrumb-nav a:hover { color: var(--primary); }
    .sscd-hero .breadcrumb-nav .sep { color: rgba(255,255,255,0.35); font-size: 0.75rem; }
    .sscd-hero .breadcrumb-nav .active { color: var(--primary); font-weight: 600; }
    .sscd-hero-title {
        font-size: 3rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: 16px;
        line-height: 1.15;
        text-shadow: 0 3px 12px rgba(0,0,0,0.3);
    }
    .sscd-hero-badges {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .sscd-hero-badge {
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
    .sscd-hero-badge i { font-size: 0.75rem; }

    /* ===== CONTENT: Image + Description ===== */
    .sscd-content {
        padding: 65px 0 60px;
        background: #fff;
    }
    .sscd-content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: start;
    }
    .sscd-content-left .sscd-label {
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
    .sscd-content-left .sscd-title {
        font-size: 2.1rem;
        font-weight: 800;
        color: #1a2a1a;
        margin-bottom: 24px;
        line-height: 1.25;
    }
    .sscd-content-left .sscd-title span { color: var(--primary); }
    .sscd-content-img {
        width: 100%;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    }
    .sscd-content-img img {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s;
    }
    .sscd-content-img:hover img { transform: scale(1.03); }

    .sscd-content-right {
        padding-top: 10px;
    }
    .sscd-content-right .sscd-sub {
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
    .sscd-content-right .sscd-short-desc {
        font-size: 1.05rem;
        color: #444;
        line-height: 1.85;
        margin-bottom: 22px;
        font-weight: 500;
    }
    .sscd-content-right .sscd-full-desc {
        color: #666;
        font-size: 0.93rem;
        line-height: 1.9;
    }
    .sscd-content-right .sscd-full-desc h2,
    .sscd-content-right .sscd-full-desc h3,
    .sscd-content-right .sscd-full-desc h4 {
        color: #1a2a1a;
        font-weight: 700;
        margin-top: 20px;
        margin-bottom: 8px;
    }
    .sscd-content-right .sscd-full-desc p { margin-bottom: 12px; }
    .sscd-content-right .sscd-full-desc ul,
    .sscd-content-right .sscd-full-desc ol { padding-left: 20px; margin-bottom: 14px; }
    .sscd-content-right .sscd-full-desc li { margin-bottom: 5px; line-height: 1.75; }
    .sscd-content-right .sscd-full-desc li::marker { color: var(--primary); }

    /* PDF Download */
    .sscd-pdf-btn {
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
    .sscd-pdf-btn:hover { background: var(--primary); color: #fff; }
    .sscd-pdf-btn .pdf-icon { font-size: 1.8rem; color: #e53935; transition: color 0.3s; }
    .sscd-pdf-btn:hover .pdf-icon { color: #fff; }

    /* ===== SECTION COMMON ===== */
    .sscd-section-label {
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
    .sscd-section-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a2a1a;
        margin-bottom: 20px;
    }
    .sscd-section-title span { color: var(--primary); }

    /* ===== CTA SECTION ===== */
    .sscd-cta {
        padding: 70px 0;
        background: #f8faf8;
    }
    .sscd-cta-box {
        background: linear-gradient(135deg, #1a2a1a 0%, #2d4a2d 100%);
        border-radius: 24px;
        padding: 55px 50px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .sscd-cta-box::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: rgba(139,195,74,0.08);
    }
    .sscd-cta-box h3 {
        color: #fff;
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 16px;
        position: relative;
    }
    .sscd-cta-box h3 span { color: var(--primary); }
    .sscd-cta-box p {
        color: rgba(255,255,255,0.75);
        font-size: 1.05rem;
        max-width: 600px;
        margin: 0 auto 30px;
        line-height: 1.75;
        position: relative;
    }
    .sscd-cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--primary);
        color: #fff;
        padding: 14px 36px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s;
        position: relative;
    }
    .sscd-cta-btn:hover {
        background: #fff;
        color: #1a2a1a;
        transform: translateY(-3px);
    }

    /* ===== SIBLING SUB CATEGORIES ===== */
    .sscd-siblings { padding: 70px 0 80px; background: #fff; }
    .sscd-sib-card {
        border-radius: 20px; overflow: hidden;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08); transition: all 0.4s; height: 100%;
        background: #eaf5ea;
        display: flex; flex-direction: column; align-items: center; text-align: center;
        padding: 35px 25px 28px; border: none; text-decoration: none;
    }
    .sscd-sib-card:hover { transform: translateY(-8px); box-shadow: none; }
    .sscd-sib-card .sib-img {
        width: 120px; height: 120px; border-radius: 50%; overflow: hidden;
        margin-bottom: 20px; border: 4px solid rgba(139,195,74,0.25); transition: border-color 0.3s; flex-shrink: 0;
    }
    .sscd-sib-card:hover .sib-img { border-color: var(--primary); }
    .sscd-sib-card .sib-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
    .sscd-sib-card:hover .sib-img img { transform: scale(1.1); }
    .sscd-sib-card .sib-name { font-weight: 700; font-size: 1.05rem; color: #2d3a2d; margin-bottom: 8px; }
    .sscd-sib-card .sib-desc { font-size: 0.82rem; color: #555; line-height: 1.65; flex: 1; margin-bottom: 14px; }
    .sscd-sib-card .sib-link { display: inline-flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 600; font-size: 0.85rem; transition: all 0.3s; }
    .sscd-sib-card:hover .sib-link { gap: 12px; }
    .sscd-sib-card .sib-link i { font-size: 0.7rem; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .sscd-hero { min-height: 320px; }
        .sscd-hero-title { font-size: 2.2rem; }
        .sscd-content-grid { grid-template-columns: 1fr; gap: 30px; }
        .sscd-content-img img { height: 320px; }
        .sscd-cta-box { padding: 40px 30px; }
        .sscd-cta-box h3 { font-size: 1.6rem; }
    }
    @media (max-width: 575px) {
        .sscd-hero { min-height: 260px; }
        .sscd-hero-inner { padding: 50px 0 40px; }
        .sscd-hero-title { font-size: 1.7rem; }
        .sscd-hero .breadcrumb-nav { font-size: 0.78rem; }
        .sscd-hero-badges { gap: 8px; }
        .sscd-hero-badge { padding: 6px 12px; font-size: 0.75rem; }
        .sscd-content { padding: 40px 0 35px; }
        .sscd-content-left .sscd-title { font-size: 1.5rem; }
        .sscd-content-img img { height: 250px; }
        .sscd-section-title { font-size: 1.5rem; }
        .sscd-cta { padding: 45px 0; }
        .sscd-cta-box { padding: 35px 22px; }
        .sscd-cta-box h3 { font-size: 1.4rem; }
        .sscd-siblings { padding: 45px 0 55px; }
        .sscd-sib-card { padding: 28px 20px 24px; }
        .sscd-sib-card .sib-img { width: 100px; height: 100px; }
    }
</style>
@endsection

@section('content')

{{-- ===== 1. HERO BANNER ===== --}}
<section class="sscd-hero">
    <div class="sscd-hero-inner">
        <div class="container">
            <div class="breadcrumb-nav" data-aos="fade-down" data-aos-delay="100">
                <a href="/"><i class="fas fa-home"></i></a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <a href="/services">Services</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('service.detail', $service->slug) }}">{{ $service->name }}</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('service.category.detail', [$service->slug, $category->slug]) }}">{{ $category->name }}</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span class="active">{{ $subCategory->name }}</span>
            </div>

            <h1 class="sscd-hero-title" data-aos="fade-up">{{ $subCategory->name }}</h1>

            <div class="sscd-hero-badges" data-aos="fade-up" data-aos-delay="200">
                <span class="sscd-hero-badge"><i class="fas fa-leaf"></i> {{ $service->name }}</span>
                <span class="sscd-hero-badge"><i class="fas fa-layer-group"></i> {{ $category->name }}</span>
            </div>
        </div>
    </div>
</section>

{{-- ===== 2. CONTENT: Image + Description ===== --}}
<section class="sscd-content">
    <div class="container">
        <div class="sscd-content-grid">
            {{-- Left: Image --}}
            <div class="sscd-content-left" data-aos="fade-right">
                <span class="sscd-label"><i class="fas fa-info-circle"></i> Sub Category Details</span>
                <h2 class="sscd-title">{{ $subCategory->name }}</h2>

                <div class="sscd-content-img">
                    @if($subCategory->image)
                        <img loading="lazy" src="{{ asset('storage/' . $subCategory->image) }}" alt="{{ $subCategory->name }}">
                    @elseif($category->image)
                        <img loading="lazy" src="{{ asset('storage/' . $category->image) }}" alt="{{ $subCategory->name }}">
                    @elseif($service->image)
                        <img loading="lazy" src="{{ asset('storage/' . $service->image) }}" alt="{{ $subCategory->name }}">
                    @else
                        <img loading="lazy" src="{{ asset('storage/Home/1.1Cover photo 1.jpg') }}" alt="{{ $subCategory->name }}">
                    @endif
                </div>

                @if($subCategory->pdf)
                    <a href="{{ asset('storage/' . $subCategory->pdf) }}" target="_blank" class="sscd-pdf-btn">
                        <i class="fas fa-file-pdf pdf-icon"></i>
                        <div>
                            <div>Download Brochure</div>
                            <small style="font-weight:400;opacity:0.6;font-size:0.78rem;">PDF Document - Click to view</small>
                        </div>
                    </a>
                @endif
            </div>

            {{-- Right: Description --}}
            <div class="sscd-content-right" data-aos="fade-left" data-aos-delay="100">
                <div class="sscd-sub"><i class="fas fa-layer-group"></i> {{ $category->name }}</div>

                @if($subCategory->description)
                    <p class="sscd-short-desc">{{ Str::limit(strip_tags($subCategory->description), 200) }}</p>
                    <div class="sscd-full-desc">
                        {!! $subCategory->description !!}
                    </div>
                @else
                    <p class="sscd-short-desc">Discover our specialized {{ $subCategory->name }} services under {{ $category->name }}. We deliver professional solutions tailored to your needs.</p>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ===== 3. CTA SECTION ===== --}}
<section class="sscd-cta">
    <div class="container">
        <div class="sscd-cta-box" data-aos="fade-up">
            <h3>Interested in <span>{{ $subCategory->name }}</span>?</h3>
            <p>Get in touch with our experts to discuss your requirements and get a customized solution.</p>
            <a href="/contact" class="sscd-cta-btn">
                <i class="fas fa-envelope"></i> Contact Us Today
            </a>
        </div>
    </div>
</section>

{{-- ===== 4. OTHER SUB CATEGORIES ===== --}}
@if($siblingSubCategories->count())
<section class="sscd-siblings">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="sscd-section-label"><i class="fas fa-star"></i> More Sub Categories</span>
            <h2 class="sscd-section-title">Other <span>{{ $category->name }} Sub Categories</span></h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($siblingSubCategories as $sib)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <a href="{{ route('service.subcategory.detail', [$service->slug, $category->slug, $sib->slug]) }}" class="sscd-sib-card">
                        <div class="sib-img">
                            @if($sib->image)
                                <img loading="lazy" src="{{ asset('storage/' . $sib->image) }}" alt="{{ $sib->name }}">
                            @elseif($category->image)
                                <img loading="lazy" src="{{ asset('storage/' . $category->image) }}" alt="{{ $sib->name }}">
                            @else
                                <div style="width:100%;height:100%;background:#2d3a2d;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-leaf" style="font-size:2rem;color:#4a6a4a;"></i>
                                </div>
                            @endif
                        </div>
                        <span class="sib-name">{{ $sib->name }}</span>
                        <span class="sib-desc">{{ Str::limit(strip_tags($sib->description), 90) }}</span>
                        <span class="sib-link">View Details <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
