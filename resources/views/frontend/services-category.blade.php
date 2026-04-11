@extends('frontend.layouts.app')

@section('title', $category->name . ' - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO ===== */
    .svc-hero {
        position: relative;
        width: 100%;
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .svc-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ $category->image ? asset("storage/" . $category->image) : asset("storage/Home/1.2 Cover photo 2.jpg") }}') center/cover no-repeat;
    }
    .svc-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(20, 45, 25, 0.75);
    }
    .svc-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .svc-hero-content h1 {
        color: #fff;
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 12px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .svc-hero-content .breadcrumb {
        justify-content: center;
        margin: 0;
    }
    .svc-hero-content .breadcrumb a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }
    .svc-hero-content .breadcrumb-item.active {
        color: rgba(255,255,255,0.7);
    }
    .svc-hero-content .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.5);
    }

    /* ===== SUBCATEGORY CARDS ===== */
    .subcat-section {
        padding: 70px 0 90px;
        background: #f9fbf9;
    }
    .subcat-section .section-label {
        display: inline-block;
        background: rgba(139,195,74,0.12);
        color: var(--primary);
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }
    .subcat-section .section-heading {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1a3a1a;
        margin-bottom: 12px;
    }
    .subcat-section .section-heading span {
        color: var(--primary);
    }
    .subcat-section .section-sub {
        color: #777;
        font-size: 1rem;
        max-width: 550px;
        margin: 0 auto 50px;
    }

    .subcat-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0,0,0,0.06);
        transition: all 0.4s;
        height: 100%;
        border: 1px solid #eee;
        text-decoration: none;
        display: block;
    }
    .subcat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.12);
        border-color: rgba(139,195,74,0.3);
    }
    .subcat-card-img {
        height: 240px;
        overflow: hidden;
        position: relative;
    }
    .subcat-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .subcat-card:hover .subcat-card-img img {
        transform: scale(1.08);
    }
    .subcat-card-img .service-count {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--primary);
        color: #fff;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .subcat-card-img .icon-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        color: var(--primary);
        background: linear-gradient(135deg, #f0f7f0 0%, #c8e6c9 100%);
    }
    .subcat-card-body {
        padding: 28px 25px;
    }
    .subcat-card-body h4 {
        font-weight: 700;
        color: #1a3a1a;
        font-size: 1.2rem;
        margin-bottom: 10px;
    }
    .subcat-card:hover .subcat-card-body h4 {
        color: var(--primary);
    }
    .subcat-card-body p {
        color: #777;
        font-size: 0.88rem;
        line-height: 1.7;
        margin-bottom: 16px;
    }
    .subcat-card-body .view-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        font-weight: 600;
        font-size: 0.9rem;
        transition: gap 0.3s;
    }
    .subcat-card:hover .view-link {
        gap: 14px;
    }

    /* ===== BACK LINK ===== */
    .back-link-wrap {
        padding: 30px 0 0;
        background: #f9fbf9;
    }
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: gap 0.3s;
    }
    .back-link:hover { gap: 12px; color: var(--primary-dark); }

    /* ===== EMPTY ===== */
    .subcat-empty {
        text-align: center;
        padding: 60px 20px;
    }
    .subcat-empty i { font-size: 3rem; color: #ccc; margin-bottom: 16px; }
    .subcat-empty p { color: #999; font-size: 1rem; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .svc-hero { height: 260px; }
        .svc-hero-content h1 { font-size: 2.2rem; }
        .subcat-section { padding: 50px 0 60px; }
        .subcat-section .section-heading { font-size: 1.8rem; }
        .subcat-card-img { height: 200px; }
    }
    @media (max-width: 575px) {
        .svc-hero { height: 220px; }
        .svc-hero-content h1 { font-size: 1.6rem; }
        .subcat-section { padding: 35px 0 45px; }
        .subcat-section .section-heading { font-size: 1.4rem; }
        .subcat-section .section-sub { font-size: 0.88rem; margin-bottom: 30px; }
        .subcat-card-img { height: 180px; }
        .subcat-card-body { padding: 20px 18px; }
        .subcat-card-body h4 { font-size: 1.05rem; }
    }
</style>
@endsection

@section('content')

<!-- Hero Banner -->
<div class="svc-hero">
    <div class="svc-hero-content" data-aos="fade-up">
        <h1>{{ $category->name }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services') }}">Services</a></li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Subcategories -->
<section class="subcat-section">
    <div class="container">
        <!-- Back Link -->
        <div class="mb-4" data-aos="fade-right">
            <a href="{{ route('services') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> All Services
            </a>
        </div>

        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-label">{{ strtoupper($category->name) }}</span>
            <h2 class="section-heading">Choose a <span>Specialization</span></h2>
            <p class="section-sub">Select a subcategory to view specific services we offer</p>
        </div>

        @if($subCategories->count())
            @php
                $subCatImages = [
                    'Home/1.16 Landscape Design  Execution.png',
                    'Home/1.18 Hardscape  Softscape Development.jpg',
                    'Home/1.20 Nursery  Plant Supply.jpg',
                    'Home/1.17 Specialized Garden Services.jpg',
                    'Home/1.19 Landscape Maintenance.png',
                ];
            @endphp
            <div class="row g-4 justify-content-center">
                @foreach($subCategories as $idx => $sub)
                    @php
                        $serviceCount = \App\Models\Service::where('is_active', true)->where('service_sub_category_id', $sub->id)->count();
                    @endphp
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                        <a href="{{ route('services.subcategory', [$category->slug, $sub->slug]) }}" class="subcat-card">
                            <div class="subcat-card-img">
                                @if($sub->image ?? false)
                                    <img loading="lazy" src="{{ asset('storage/' . $sub->image) }}" alt="{{ $sub->name }}">
                                @else
                                    <img loading="lazy" src="{{ asset('storage/' . ($subCatImages[$idx] ?? $subCatImages[0])) }}" alt="{{ $sub->name }}">
                                @endif
                                <span class="service-count">{{ $serviceCount }} {{ Str::plural('Service', $serviceCount) }}</span>
                            </div>
                            <div class="subcat-card-body">
                                <h4>{{ $sub->name }}</h4>
                                <p>Explore our {{ strtolower($sub->name) }} services tailored to your specific needs.</p>
                                <span class="view-link">View Services <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="subcat-empty">
                <i class="fas fa-folder-open"></i>
                <p>No subcategories found in this service area.</p>
            </div>
        @endif
    </div>
</section>

@endsection
