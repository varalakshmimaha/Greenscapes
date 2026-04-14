@extends('frontend.layouts.app')

@section('title', $service->name . ' - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO BANNER ===== */
    .sd-hero {
        position: relative;
        width: 100%;
        min-height: 380px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .sd-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ $service->image ? asset("storage/" . $service->image) : asset("storage/Home/1.2 Cover photo 2.jpg") }}') center/cover no-repeat;
        transition: transform 8s ease;
    }
    .sd-hero:hover::before { transform: scale(1.03); }
    .sd-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(10,30,10,0.88) 0%, rgba(15,40,15,0.7) 50%, rgba(20,50,20,0.55) 100%);
    }
    .sd-hero-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 80px 0 55px;
    }
    .sd-hero .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.88rem;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    .sd-hero .breadcrumb-nav a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        transition: color 0.2s;
    }
    .sd-hero .breadcrumb-nav a:hover { color: var(--primary); }
    .sd-hero .breadcrumb-nav .sep { color: rgba(255,255,255,0.35); font-size: 0.75rem; }
    .sd-hero .breadcrumb-nav .active { color: var(--primary); font-weight: 600; }
    .sd-hero-title {
        font-size: 3rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: 16px;
        line-height: 1.15;
        text-shadow: 0 3px 12px rgba(0,0,0,0.3);
    }
    .sd-hero-sub {
        font-size: 1.1rem;
        color: rgba(255,255,255,0.85);
        max-width: 700px;
        line-height: 1.75;
        margin-bottom: 28px;
    }
    .sd-hero-badges {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .sd-hero-badge {
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
    .sd-hero-badge i { font-size: 0.75rem; }

    /* ===== SERVICE CONTENT: Image Left + Description Right ===== */
    .sd-content {
        padding: 65px 0 60px;
        background: #fff;
    }
    .sd-content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: start;
    }
    .sd-content-left .sd-label {
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
    .sd-content-left .sd-title {
        font-size: 2.1rem;
        font-weight: 800;
        color: #1a2a1a;
        margin-bottom: 24px;
        line-height: 1.25;
    }
    .sd-content-left .sd-title span { color: var(--primary); }
    .sd-content-img {
        width: 100%;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    }
    .sd-content-img img {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s;
    }
    .sd-content-img:hover img { transform: scale(1.03); }

    /* Right: Description */
    .sd-content-right {
        padding-top: 10px;
    }
    .sd-content-right .sd-sub {
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
    .sd-content-right .sd-short-desc {
        font-size: 1.05rem;
        color: #444;
        line-height: 1.85;
        margin-bottom: 22px;
        font-weight: 500;
    }
    .sd-content-right .sd-full-desc {
        color: #666;
        font-size: 0.93rem;
        line-height: 1.9;
    }
    .sd-content-right .sd-full-desc h2,
    .sd-content-right .sd-full-desc h3,
    .sd-content-right .sd-full-desc h4 {
        color: #1a2a1a;
        font-weight: 700;
        margin-top: 20px;
        margin-bottom: 8px;
    }
    .sd-content-right .sd-full-desc p {
        margin-bottom: 12px;
    }
    .sd-content-right .sd-full-desc ul,
    .sd-content-right .sd-full-desc ol {
        padding-left: 20px;
        margin-bottom: 14px;
    }
    .sd-content-right .sd-full-desc li {
        margin-bottom: 5px;
        line-height: 1.75;
    }
    .sd-content-right .sd-full-desc li::marker { color: var(--primary); }

    /* PDF Download */
    .sd-pdf-btn {
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
    .sd-pdf-btn:hover { background: var(--primary); color: #fff; }
    .sd-pdf-btn .pdf-icon { font-size: 1.8rem; color: #e53935; transition: color 0.3s; }
    .sd-pdf-btn:hover .pdf-icon { color: #fff; }

    /* ===== SECTION COMMON ===== */
    .sd-section-label {
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
    .sd-section-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a2a1a;
        margin-bottom: 20px;
    }
    .sd-section-title span { color: var(--primary); }

    /* ===== SERVICE CATEGORIES ===== */
    .sd-siblings {
        padding: 70px 0;
        background: #f8faf8;
    }
    .sd-category-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid #e7efe7;
        transition: all 0.4s;
        height: 100%;
        padding: 26px 24px;
        position: relative;
    }
    .sd-category-card.sd-category-card-link {
        display: block;
        text-decoration: none;
    }
    .sd-category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 45px rgba(0,0,0,0.12);
        border-color: rgba(139,195,74,0.3);
    }
    .sd-category-img {
        width: 100%;
        height: 160px;
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 18px;
    }
    .sd-category-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .sd-category-card:hover .sd-category-img img {
        transform: scale(1.05);
    }
    .sd-category-title {
        font-weight: 700;
        font-size: 1.08rem;
        color: #1a2a1a;
        margin-bottom: 12px;
        line-height: 1.45;
    }
    .sd-category-desc {
        font-size: 0.9rem;
        color: #6b776b;
        margin-bottom: 0;
        line-height: 1.75;
    }
    .sd-category-list {
        margin: 0;
        padding-left: 18px;
    }
    .sd-category-list li {
        color: #5d685d;
        font-size: 0.88rem;
        line-height: 1.75;
        margin-bottom: 6px;
    }
    .sd-category-list li:last-child {
        margin-bottom: 0;
    }
    .sd-category-list li::marker {
        color: var(--primary);
    }
    .sd-category-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 16px;
        color: var(--primary-dark);
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: gap 0.3s ease;
    }
    .sd-category-card:hover .sd-category-link { gap: 12px; }

    /* ===== RELATED SERVICES ===== */
    .sd-related { padding: 70px 0 80px; background: #fff; }
    .sd-rel-card {
        border-radius: 20px; overflow: hidden;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08); transition: all 0.4s; height: 100%;
        background: #eaf5ea;
        display: flex; flex-direction: column; align-items: center; text-align: center;
        padding: 35px 25px 28px; border: none; text-decoration: none;
    }
    .sd-rel-card:hover { transform: translateY(-8px); box-shadow: none; }
    .sd-rel-card .rel-img {
        width: 120px; height: 120px; border-radius: 50%; overflow: hidden;
        margin-bottom: 20px; border: 4px solid rgba(139,195,74,0.25); transition: border-color 0.3s; flex-shrink: 0;
    }
    .sd-rel-card:hover .rel-img { border-color: var(--primary); }
    .sd-rel-card .rel-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
    .sd-rel-card:hover .rel-img img { transform: scale(1.1); }
    .sd-rel-card .rel-name { font-weight: 700; font-size: 1.05rem; color: #2d3a2d; margin-bottom: 8px; }
    .sd-rel-card .rel-desc { font-size: 0.82rem; color: #555; line-height: 1.65; flex: 1; margin-bottom: 14px; }
    .sd-rel-card .rel-link { display: inline-flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 600; font-size: 0.85rem; transition: all 0.3s; }
    .sd-rel-card:hover .rel-link { gap: 12px; }
    .sd-rel-card .rel-link i { font-size: 0.7rem; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .sd-hero { min-height: 320px; }
        .sd-hero-title { font-size: 2.2rem; }
        .sd-content-grid { grid-template-columns: 1fr; gap: 30px; }
        .sd-content-img img { height: 320px; }
    }
    @media (max-width: 575px) {
        .sd-hero { min-height: 260px; }
        .sd-hero-inner { padding: 50px 0 40px; }
        .sd-hero-title { font-size: 1.7rem; }
        .sd-hero-sub { font-size: 0.9rem; }
        .sd-hero .breadcrumb-nav { font-size: 0.78rem; }
        .sd-hero-badges { gap: 8px; }
        .sd-hero-badge { padding: 6px 12px; font-size: 0.75rem; }
        .sd-content { padding: 40px 0 35px; }
        .sd-content-left .sd-title { font-size: 1.5rem; }
        .sd-content-img img { height: 250px; border-radius: 14px; }
        .sd-content-right .sd-short-desc { font-size: 0.95rem; }
        .sd-section-title { font-size: 1.5rem; }
        .sd-siblings { padding: 45px 0; }
        .sd-category-card { padding: 22px 20px; }
        .sd-related { padding: 45px 0 55px; }
        .sd-rel-card { padding: 28px 20px 24px; }
        .sd-rel-card .rel-img { width: 100px; height: 100px; }
    }
    @media (max-width: 480px) {
        .sd-hero { height: 220px; }
        .sd-hero h1 { font-size: 1.3rem; }
        .sd-content-grid { gap: 20px; }
        .sd-content-img img { height: 220px; border-radius: 12px; }
        .sd-content-body { padding: 0 10px; }
        .sd-content-body h2 { font-size: 1.2rem; }
        .sd-content-body p { font-size: 0.85rem; }
        .sd-rel-card .rel-img { width: 90px; height: 90px; }
        .sd-rel-card h4 { font-size: 0.9rem; }
        .sd-rel-section h3 { font-size: 1.2rem; }
    }
</style>
@endsection

@section('content')

{{-- ===== 1. HERO BANNER ===== --}}
<section class="sd-hero">
    <div class="sd-hero-inner">
        <div class="container">
            <div class="breadcrumb-nav" data-aos="fade-down" data-aos-delay="100">
                <a href="/"><i class="fas fa-home"></i></a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <a href="/services">Services</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span class="active">{{ $service->name }}</span>
            </div>

            <h1 class="sd-hero-title" data-aos="fade-up">{{ $service->name }}</h1>

            <div class="sd-hero-badges" data-aos="fade-up" data-aos-delay="200">
                <span class="sd-hero-badge"><i class="fas fa-leaf"></i> SR Greenscapes</span>
            </div>
        </div>
    </div>
</section>

{{-- ===== 2. SERVICE CONTENT: Image Left + Description Right ===== --}}
<section class="sd-content">
    <div class="container">
        <div class="sd-content-grid">
            {{-- Left: Heading + Image --}}
            <div class="sd-content-left" data-aos="fade-right">
                <span class="sd-label"><i class="fas fa-info-circle"></i> Service Details</span>
                <h2 class="sd-title">{{ $service->name }}</h2>

                <div class="sd-content-img">
                    @if($service->image)
                        <img loading="lazy" src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                    @else
                        <img loading="lazy" src="{{ asset('storage/Home/1.1Cover photo 1.jpg') }}" alt="{{ $service->name }}">
                    @endif
                </div>

                @if($service->pdf)
                    <a href="{{ asset('storage/' . $service->pdf) }}" target="_blank" class="sd-pdf-btn">
                        <i class="fas fa-file-pdf pdf-icon"></i>
                        <div>
                            <div>Download Service Brochure</div>
                            <small style="font-weight:400;opacity:0.6;font-size:0.78rem;">PDF Document - Click to view</small>
                        </div>
                    </a>
                @endif
            </div>

            {{-- Right: Description --}}
            <div class="sd-content-right" data-aos="fade-left" data-aos-delay="100">
                @if($service->description)
                    <p class="sd-short-desc">{{ Str::limit(strip_tags($service->description), 200) }}</p>
                @endif

                <div class="sd-full-desc">
                    {!! $service->description !!}
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== 3. SERVICE CATEGORIES ===== --}}
@if($serviceCategories->count())
<section class="sd-siblings">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="sd-section-label"><i class="fas fa-list-ul"></i> Service Categories</span>
            <h2 class="sd-section-title">{{ $service->name }} <span>Categories</span></h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($serviceCategories as $cat)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <a href="{{ route('service.category.detail', [$service->slug, $cat->slug]) }}" class="sd-category-card sd-category-card-link">
                        <div class="sd-category-img">
                            @if($cat->image)
                                <img loading="lazy" src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}">
                            @else
                                <img loading="lazy" src="{{ asset('storage/' . ($service->image ?? 'Home/1.1Cover photo 1.jpg')) }}" alt="{{ $cat->name }}">
                            @endif
                        </div>
                        <h5 class="sd-category-title">{{ $cat->name }}</h5>

                        @if($cat->description)
                            <p class="sd-category-desc">{{ Str::limit(strip_tags($cat->description), 120) }}</p>
                        @else
                            <p class="sd-category-desc">Focused solutions offered under {{ $service->name }}.</p>
                        @endif

                        @if($cat->subCategories->count())
                            <ul class="sd-category-list">
                                @foreach($cat->subCategories as $sub)
                                    <li>{{ $sub->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <span class="sd-category-link">Learn More <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== 4. RELATED SERVICES ===== --}}
@if($relatedServices->count())
<section class="sd-related">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="sd-section-label"><i class="fas fa-star"></i> You May Also Like</span>
            <h2 class="sd-section-title">Related <span>Services</span></h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($relatedServices as $related)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <a href="{{ route('service.detail', $related->slug) }}" class="sd-rel-card">
                        <div class="rel-img">
                            @if($related->image)
                                <img loading="lazy" src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}">
                            @else
                                <div style="width:100%;height:100%;background:#2d3a2d;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-leaf" style="font-size:2rem;color:#4a6a4a;"></i>
                                </div>
                            @endif
                        </div>
                        <span class="rel-name">{{ $related->name }}</span>
                        <span class="rel-desc">{{ Str::limit(strip_tags($related->description), 90) }}</span>
                        <span class="rel-link">Explore Service <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
