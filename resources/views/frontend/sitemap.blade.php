@extends('frontend.layouts.app')

@section('title', 'Sitemap — SR Greenscapes')

@section('styles')
<style>
    .sitemap-hero {
        position: relative;
        width: 100%;
        height: 280px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover no-repeat;
    }
    .sitemap-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(15, 35, 15, 0.72);
    }
    .sitemap-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .sitemap-hero-content h1 {
        font-size: 2.6rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 10px;
    }
    .sitemap-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: rgba(255,255,255,0.55);
        font-size: 0.82rem;
        margin-top: 10px;
    }
    .sitemap-breadcrumb a { color: var(--accent); text-decoration: none; }
    .sitemap-breadcrumb span { color: rgba(255,255,255,0.3); }

    .sitemap-body {
        padding: 70px 0 80px;
        background: #f9fdf5;
    }
    .sitemap-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }
    .sitemap-group {
        background: #fff;
        border-radius: 16px;
        padding: 28px 28px 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .sitemap-group-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: var(--primary-dark);
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e8f5d8;
    }
    .sitemap-group-title i {
        width: 30px; height: 30px;
        background: rgba(139,195,74,0.15);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: var(--primary);
        font-size: 12px;
        flex-shrink: 0;
    }
    .sitemap-links {
        list-style: none;
        padding: 0; margin: 0;
    }
    .sitemap-links li { margin-bottom: 9px; }
    .sitemap-links li a {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.88rem;
        color: #555;
        text-decoration: none;
        transition: all 0.2s;
    }
    .sitemap-links li a i {
        color: var(--accent);
        font-size: 9px;
        flex-shrink: 0;
    }
    .sitemap-links li a:hover {
        color: var(--primary);
        padding-left: 4px;
    }
    @media (max-width: 991px) {
        .sitemap-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 575px) {
        .sitemap-hero { height: 220px; }
        .sitemap-hero-content h1 { font-size: 1.8rem; }
        .sitemap-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

<!-- Hero -->
<section class="sitemap-hero">
    <div class="sitemap-hero-content">
        <h1>Sitemap</h1>
        <div class="sitemap-breadcrumb">
            <a href="/">Home</a>
            <span>›</span>
            <span>Sitemap</span>
        </div>
    </div>
</section>

<!-- Content -->
<section class="sitemap-body">
    <div class="container">
        <div class="sitemap-grid">

            <!-- Main Pages -->
            <div class="sitemap-group">
                <div class="sitemap-group-title">
                    <i class="fas fa-home"></i> Main Pages
                </div>
                <ul class="sitemap-links">
                    <li><a href="/"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="/about"><i class="fas fa-chevron-right"></i> About Us</a></li>
                    <li><a href="/process"><i class="fas fa-chevron-right"></i> Our Process</a></li>
                    <li><a href="/projects"><i class="fas fa-chevron-right"></i> Projects</a></li>
                    <li><a href="/gallery"><i class="fas fa-chevron-right"></i> Gallery</a></li>
                    <li><a href="/contact"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="sitemap-group">
                <div class="sitemap-group-title">
                    <i class="fas fa-leaf"></i> Services
                </div>
                <ul class="sitemap-links">
                    <li><a href="/services"><i class="fas fa-chevron-right"></i> All Services</a></li>
                    @foreach($services as $service)
                        <li><a href="/services/{{ $service->slug }}"><i class="fas fa-chevron-right"></i> {{ $service->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Resources -->
            <div class="sitemap-group">
                <div class="sitemap-group-title">
                    <i class="fas fa-book-open"></i> Resources
                </div>
                <ul class="sitemap-links">
                    <li><a href="/blogs"><i class="fas fa-chevron-right"></i> Blogs</a></li>
                    <li><a href="/videos"><i class="fas fa-chevron-right"></i> Videos</a></li>
                    <li><a href="/testimonials"><i class="fas fa-chevron-right"></i> Testimonials</a></li>
                    <li><a href="/faqs"><i class="fas fa-chevron-right"></i> FAQs</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div class="sitemap-group">
                <div class="sitemap-group-title">
                    <i class="fas fa-shield-alt"></i> Legal
                </div>
                <ul class="sitemap-links">
                    <li><a href="/privacy-policy"><i class="fas fa-chevron-right"></i> Privacy Policy</a></li>
                    <li><a href="/terms"><i class="fas fa-chevron-right"></i> Terms of Use</a></li>
                    <li><a href="/sitemap"><i class="fas fa-chevron-right"></i> Sitemap</a></li>
                </ul>
            </div>

        </div>
    </div>
</section>

@endsection
