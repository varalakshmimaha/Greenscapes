@extends('frontend.layouts.app')

@section('title', ($project->title ?? 'Project Details') . ' - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO BANNER ===== */
    .pd-hero {
        position: relative;
        width: 100%;
        min-height: 380px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .pd-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset("storage/Home/1.1Cover photo 1.jpg") }}') center/cover no-repeat;
        transition: transform 8s ease;
    }
    .pd-hero:hover::before { transform: scale(1.03); }
    .pd-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(10,30,10,0.88) 0%, rgba(15,40,15,0.7) 50%, rgba(20,50,20,0.55) 100%);
    }
    .pd-hero-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 80px 0 55px;
    }
    .pd-hero .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.88rem;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    .pd-hero .breadcrumb-nav a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        transition: color 0.2s;
    }
    .pd-hero .breadcrumb-nav a:hover { color: var(--primary); }
    .pd-hero .breadcrumb-nav .sep { color: rgba(255,255,255,0.35); font-size: 0.75rem; }
    .pd-hero .breadcrumb-nav .active { color: var(--primary); font-weight: 600; }
    .pd-hero-title {
        font-size: 3rem;
        font-weight: 900;
        color: #fff;
        margin-bottom: 16px;
        line-height: 1.15;
        text-shadow: 0 3px 12px rgba(0,0,0,0.3);
    }
    .pd-hero-badges {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .pd-hero-badge {
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
    .pd-hero-badge i { font-size: 0.75rem; }

    /* ===== TOP SECTION: Featured Image (left) + Details Card (right) ===== */
    .pd-top {
        padding: 60px 0;
        background: #fff;
    }
    .pd-top-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 35px;
        align-items: start;
    }
    .pd-featured-img {
        width: 100%;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    }
    .pd-featured-img img {
        width: 100%;
        height: 100%;
        min-height: 420px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s;
    }
    .pd-featured-img:hover img { transform: scale(1.02); }

    /* Details Card */
    .pd-details-card {
        background: #f8faf8;
        border-radius: 18px;
        border: 1px solid #e7efe7;
        padding: 25px 22px;
    }
    .pd-details-card h5 {
        font-size: 1.1rem;
        font-weight: 800;
        color: #1a2a1a;
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 2px solid var(--primary);
    }
    .pd-detail-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }
    .pd-detail-item:last-child { border-bottom: none; }
    .pd-detail-label {
        font-size: 0.88rem;
        color: #777;
        font-weight: 500;
    }
    .pd-detail-value {
        font-size: 0.88rem;
        font-weight: 700;
        color: #1a2a1a;
        text-align: right;
    }
    .pd-enquiry-btn {
        display: block;
        width: 100%;
        text-align: center;
        background: var(--primary);
        color: #fff;
        padding: 13px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        text-decoration: none;
        transition: all 0.3s;
        margin-top: 24px;
    }
    .pd-enquiry-btn:hover {
        background: var(--primary-dark);
        color: #fff;
        transform: translateY(-2px);
    }

    /* ===== BOTTOM SECTION: Description + Gallery ===== */
    .pd-content {
        padding: 0 0 70px;
        background: #fff;
    }
    .pd-main-content .pd-label {
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
    .pd-main-content .pd-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a2a1a;
        margin-bottom: 24px;
        line-height: 1.3;
    }
    .pd-main-content .pd-title span { color: var(--primary); }
    .pd-description {
        color: #555;
        font-size: 0.95rem;
        line-height: 1.9;
    }
    .pd-description h2, .pd-description h3, .pd-description h4 {
        color: #1a2a1a;
        font-weight: 700;
        margin-top: 20px;
        margin-bottom: 8px;
    }
    .pd-description p { margin-bottom: 12px; }
    .pd-description ul, .pd-description ol { padding-left: 20px; margin-bottom: 14px; }
    .pd-description li { margin-bottom: 5px; line-height: 1.75; }
    .pd-description li::marker { color: var(--primary); }

    /* Gallery */
    .pd-gallery {
        margin-top: 45px;
        padding-top: 45px;
        border-top: 1px solid #e7efe7;
    }
    .pd-gallery-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: #1a2a1a;
        margin-bottom: 20px;
    }
    .pd-gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    .pd-gallery-item {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .pd-gallery-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
        transition: transform 0.4s;
    }
    .pd-gallery-item:hover img {
        transform: scale(1.08);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .pd-hero { min-height: 320px; }
        .pd-hero-title { font-size: 2.2rem; }
        .pd-top-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        .pd-featured-img img { min-height: 320px; }
        .pd-gallery-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 575px) {
        .pd-hero { min-height: 260px; }
        .pd-hero-inner { padding: 50px 0 40px; }
        .pd-hero-title { font-size: 1.7rem; }
        .pd-hero .breadcrumb-nav { font-size: 0.78rem; }
        .pd-top { padding: 35px 0; }
        .pd-featured-img img { min-height: 250px; }
        .pd-content { padding: 0 0 50px; }
        .pd-main-content .pd-title { font-size: 1.5rem; }
        .pd-gallery-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .pd-gallery-item img { height: 150px; }
        .pd-details-card { padding: 22px; }
    }
    @media (max-width: 480px) {
        .pd-featured-img img { min-height: 220px; }
        .pd-gallery-item img { height: 140px; }
    }
</style>
@endsection

@section('content')

{{-- ===== 1. HERO BANNER ===== --}}
<section class="pd-hero">
    <div class="pd-hero-inner">
        <div class="container">
            <div class="breadcrumb-nav" data-aos="fade-down" data-aos-delay="100">
                <a href="/"><i class="fas fa-home"></i></a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <a href="/projects">Projects</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span class="active">{{ $project->title }}</span>
            </div>

            <h1 class="pd-hero-title" data-aos="fade-up">{{ $project->title }}</h1>

            <div class="pd-hero-badges" data-aos="fade-up" data-aos-delay="200">
                @if($project->category)
                    <span class="pd-hero-badge"><i class="fas fa-tag"></i> {{ $project->category }}</span>
                @endif
                @if($project->location)
                    <span class="pd-hero-badge"><i class="fas fa-map-marker-alt"></i> {{ $project->location }}</span>
                @endif
                <span class="pd-hero-badge"><i class="fas fa-circle{{ $project->status === 'completed' ? '-check' : '' }}"></i> {{ ucfirst($project->status) }}</span>
            </div>
        </div>
    </div>
</section>

{{-- ===== 2. FEATURED IMAGE (Left) + PROJECT DETAILS (Right) ===== --}}
<section class="pd-top">
    <div class="container">
        <div class="pd-top-grid">

            {{-- Left: Featured Image --}}
            <div data-aos="fade-right">
                <div class="pd-featured-img">
                    @if($project->featured_image)
                        <img loading="lazy" src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->title }}">
                    @else
                        <img loading="lazy" src="{{ asset('storage/Home/1.1Cover photo 1.jpg') }}" alt="{{ $project->title }}">
                    @endif
                </div>
            </div>

            {{-- Right: Project Details Card --}}
            <div data-aos="fade-left">
                <div class="pd-details-card">
                    <h5>Project Details</h5>

                    @if($project->category)
                    <div class="pd-detail-item">
                        <span class="pd-detail-label">Category</span>
                        <span class="pd-detail-value">{{ $project->category }}</span>
                    </div>
                    @endif

                    @if($project->location)
                    <div class="pd-detail-item">
                        <span class="pd-detail-label">Location</span>
                        <span class="pd-detail-value">{{ $project->location }}</span>
                    </div>
                    @endif

                    @if($project->area)
                    <div class="pd-detail-item">
                        <span class="pd-detail-label">Area</span>
                        <span class="pd-detail-value">{{ $project->area }}</span>
                    </div>
                    @endif

                    @if($project->completion_date)
                    <div class="pd-detail-item">
                        <span class="pd-detail-label">Completion</span>
                        <span class="pd-detail-value">{{ $project->completion_date }}</span>
                    </div>
                    @endif

                    @if($project->project_manager)
                    <div class="pd-detail-item">
                        <span class="pd-detail-label">Project Manager</span>
                        <span class="pd-detail-value">{{ $project->project_manager }}</span>
                    </div>
                    @endif

                    @if($project->client_name)
                    <div class="pd-detail-item">
                        <span class="pd-detail-label">Client</span>
                        <span class="pd-detail-value">{{ $project->client_name }}</span>
                    </div>
                    @endif

                    <div class="pd-detail-item">
                        <span class="pd-detail-label">Status</span>
                        <span class="pd-detail-value">{{ ucfirst($project->status) }}</span>
                    </div>

                    <a href="/contact" class="pd-enquiry-btn">Enquire About This Service</a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===== 3. DESCRIPTION + GALLERY (Full Width Below) ===== --}}
<section class="pd-content">
    <div class="container">
        <div class="pd-main-content" data-aos="fade-up">
            <h2 class="pd-title">{{ $project->title }}</h2>

            <div class="pd-description">
                {!! $project->description !!}
            </div>

            {{-- Gallery --}}
            @if($project->gallery_images && count($project->gallery_images))
            <div class="pd-gallery">
                <h4 class="pd-gallery-title"><i class="fas fa-images me-2" style="color:var(--primary);"></i> Project Gallery</h4>
                <div class="pd-gallery-grid">
                    @foreach($project->gallery_images as $pic)
                        <a href="{{ asset('storage/'.$pic) }}" target="_blank" class="pd-gallery-item">
                            <img loading="lazy" src="{{ asset('storage/'.$pic) }}" alt="Gallery">
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

@endsection
