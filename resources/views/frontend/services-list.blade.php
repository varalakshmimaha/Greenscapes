@extends('frontend.layouts.app')

@section('title', $subCategory->name . ' - SR Greenscapes')

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
        background: url('{{ asset('storage/Home/1.2 Cover photo 2.jpg') }}') center/cover no-repeat;
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

    /* ===== SERVICES GRID ===== */
    .services-section {
        padding: 70px 0 90px;
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

    .svc-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0,0,0,0.06);
        transition: all 0.3s;
        height: 100%;
        border: 1px solid #eee;
        display: flex;
        flex-direction: column;
    }
    .svc-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 45px rgba(0,0,0,0.12);
        border-color: rgba(139,195,74,0.3);
    }
    .svc-card-img {
        height: 220px;
        overflow: hidden;
    }
    .svc-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .svc-card:hover .svc-card-img img {
        transform: scale(1.06);
    }
    .svc-card-img .icon-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        color: var(--primary);
        background: linear-gradient(135deg, #f0f7f0 0%, #c8e6c9 100%);
    }
    .svc-card-body {
        padding: 25px 22px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    a.text-decoration-none .svc-card { color: inherit; }
    .svc-card-body h5 {
        font-weight: 700;
        color: #1a3a1a;
        font-size: 1.1rem;
        margin-bottom: 10px;
    }
    .svc-card:hover h5 { color: var(--primary-dark); }
    .svc-card-body p {
        font-size: 0.85rem;
        color: #666;
        line-height: 1.7;
        flex: 1;
    }
    .svc-card .svc-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--primary);
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        margin-top: 12px;
        transition: gap 0.3s;
    }
    .svc-card:hover .svc-link { gap: 10px; }

    /* ===== EMPTY ===== */
    .svc-empty {
        text-align: center;
        padding: 60px 20px;
    }
    .svc-empty i { font-size: 3rem; color: #ccc; margin-bottom: 16px; }
    .svc-empty p { color: #999; font-size: 1rem; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .svc-hero { height: 260px; }
        .svc-hero-content h1 { font-size: 2.2rem; }
        .services-section { padding: 50px 0 60px; }
        .svc-card-img { height: 190px; }
    }
    @media (max-width: 575px) {
        .svc-hero { height: 220px; }
        .svc-hero-content h1 { font-size: 1.6rem; }
        .services-section { padding: 35px 0 45px; }
        .svc-card-img { height: 170px; }
        .svc-card-body { padding: 18px 16px; }
        .svc-card-body h5 { font-size: 0.95rem; }
        .svc-card-body p { font-size: 0.8rem; }
    }
    @media (max-width: 480px) {
        .svc-hero { height: 180px; }
        .svc-hero-content h1 { font-size: 1.3rem; }
        .svc-hero-content .breadcrumb { font-size: 0.8rem; }
        .svc-card-img { height: 180px; }
        .svc-card-body h5 { font-size: 1rem; }
        .svc-card-body p { font-size: 0.82rem; }
    }
</style>
@endsection

@section('content')

<!-- Hero Banner -->
<div class="svc-hero">
    <div class="svc-hero-content" data-aos="fade-up">
        <h1>{{ $subCategory->name }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services') }}">Services</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services.category', $category->slug) }}">{{ $category->name }}</a></li>
                <li class="breadcrumb-item active">{{ $subCategory->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Services List -->
<section class="services-section">
    <div class="container">
        <!-- Back Link -->
        <div class="mb-4" data-aos="fade-right">
            <a href="{{ route('services.category', $category->slug) }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to {{ $category->name }}
            </a>
        </div>

        @if($services->count())
            <div class="row g-4">
                @foreach($services as $idx => $service)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $idx * 80 }}">
                        <a href="{{ route('service.detail', $service->slug) }}" class="text-decoration-none">
                            <div class="svc-card">
                                <div class="svc-card-img">
                                    @php
                                        $fallbackImages = [
                                            'Home/1.16 Landscape Design  Execution.png',
                                            'Home/1.17 Specialized Garden Services.jpg',
                                            'Home/1.18 Hardscape  Softscape Development.jpg',
                                            'Home/1.19 Landscape Maintenance.png',
                                            'Home/1.20 Nursery  Plant Supply.jpg',
                                            'Home/1.21 Horticulture Consultancy.png',
                                        ];
                                    @endphp
                                    @if($service->image)
                                        <img loading="lazy" src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                                    @else
                                        <img loading="lazy" src="{{ asset('storage/' . $fallbackImages[$idx % count($fallbackImages)]) }}" alt="{{ $service->name }}">
                                    @endif
                                </div>
                                <div class="svc-card-body">
                                    <h5>{{ $service->name }}</h5>
                                    <p>{!! Str::limit(strip_tags($service->description), 120) !!}</p>
                                    <span class="svc-link">Learn More <i class="fas fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="svc-empty">
                <i class="fas fa-concierge-bell"></i>
                <p>No services found in this subcategory yet.</p>
            </div>
        @endif
    </div>
</section>

@endsection
