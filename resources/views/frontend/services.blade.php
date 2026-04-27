@extends('frontend.layouts.app')

@section('title', 'Our Services - SR Greenscapes')

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
    .svc-hero-content p {
        color: rgba(255,255,255,0.9);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* ===== CATEGORY SECTION ===== */
    .cat-section {
        padding: 70px 0 30px;
        background: #f8faf8;
    }
    .cat-section:nth-child(even) {
        background: #fff;
    }

    /* Category Header */
    .cat-header {
        margin-bottom: 40px;
    }
    .cat-header-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(139,195,74,0.12);
        color: var(--primary-dark);
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 14px;
    }
    .cat-header h2 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1a3a1a;
        margin-bottom: 10px;
    }
    .cat-header h2 span { color: var(--primary); }
    .cat-header p {
        color: #777;
        font-size: 0.95rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .cat-view-all {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        margin-top: 8px;
        transition: gap 0.3s;
    }
    .cat-view-all:hover { gap: 12px; color: var(--primary-dark); }
    .cat-view-all i { font-size: 0.75rem; }

    /* ===== SUB-CATEGORY PILLS ===== */
    .subcat-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-bottom: 40px;
    }
    .subcat-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fff;
        border: 1px solid #e0edd8;
        color: #1a3a1a;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    .subcat-pill:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(139,195,74,0.3);
    }
    .subcat-pill .pill-count {
        background: rgba(139,195,74,0.15);
        color: var(--primary-dark);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 50px;
        transition: all 0.3s;
    }
    .subcat-pill:hover .pill-count {
        background: rgba(255,255,255,0.25);
        color: #fff;
    }

    /* ===== SERVICE CARDS (dark card with circular image) ===== */
    .service-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.3s;
        height: 100%;
        border: 1px solid #eee;
        display: flex;
        flex-direction: column;
    }
    .service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.1);
        border-color: rgba(139,195,74,0.3);
    }
    .service-card .svc-img-wrap {
        aspect-ratio: 4/3;
        overflow: hidden;
        background: #fff;
    }
    .service-card .svc-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
        transition: transform 0.4s;
    }
    .service-card:hover .svc-img-wrap img {
        transform: scale(1.05);
    }
    .service-card .svc-img-wrap .svc-icon-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
    }
    .service-card .svc-img-wrap .svc-icon-placeholder i {
        font-size: 2.5rem;
        color: var(--primary);
    }
    .service-card .svc-body {
        padding: 20px;
        text-align: center;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    .service-card .svc-body h5 {
        font-weight: 700;
        color: var(--dark);
        font-size: 1.1rem;
        margin: 0;
        line-height: 1.4;
    }
    .service-card .svc-body .svc-desc {
        font-size: 0.9rem;
        color: #777;
        margin: 0;
        line-height: 1.75;
        flex: 1;
        text-align: justify;
    }
    .service-card .svc-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        font-weight: 600;
        font-size: 0.88rem;
        text-decoration: none;
        transition: all 0.3s;
    }
    .service-card .svc-link:hover {
        color: #a4d65e;
        gap: 12px;
    }
    .service-card .svc-link i {
        font-size: 0.75rem;
        transition: transform 0.3s;
    }
    .service-card .svc-link:hover i {
        transform: translateX(3px);
    }

    /* ===== CATEGORY DIVIDER ===== */
    .cat-divider {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 0 0 10px;
    }
    .cat-divider::before,
    .cat-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(to right, transparent, #c6dfc2, transparent);
    }
    .cat-divider-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(139,195,74,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1rem;
    }

    /* ===== WHY CHOOSE ===== */
    .why-choose-section {
        padding: 80px 0;
        background: linear-gradient(180deg, #f9fbf9 0%, #eef5e8 100%);
    }
    .why-choose-label {
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
    .why-choose-heading {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1a3a1a;
        margin-bottom: 12px;
    }
    .why-choose-heading span { color: var(--primary); }
    .why-choose-sub {
        color: #777;
        font-size: 1rem;
        max-width: 550px;
        margin: 0 auto;
    }
    .why-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 45px 30px;
        height: 100%;
        border: 1px solid rgba(139, 195, 74, 0.1);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        z-index: 1;
    }
    .why-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), #8BC34A);
        transform: scaleX(0);
        transform-origin: center;
        transition: transform 0.4s ease;
        z-index: 2;
    }
    .why-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 45px rgba(139, 195, 74, 0.12);
        border-color: rgba(139, 195, 74, 0.25);
    }
    .why-card:hover::before { transform: scaleX(1); }
    .why-card-icon {
        width: 80px; height: 80px;
        background: #f4fbf4;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(139, 195, 74, 0.15);
    }
    .why-card-icon i {
        font-size: 1.8rem;
        color: var(--primary);
        transition: all 0.3s;
    }
    .why-card:hover .why-card-icon { 
        background: var(--primary); 
        transform: translateY(-5px) scale(1.05);
        border-color: var(--primary);
        box-shadow: 0 12px 20px rgba(139, 195, 74, 0.3);
    }
    .why-card:hover .why-card-icon i { color: #fff; }
    .why-card-title {
        font-weight: 800;
        color: #1a3a1a;
        font-size: 1.2rem;
        margin-bottom: 15px;
        transition: color 0.3s;
    }
    .why-card:hover .why-card-title {
        color: var(--primary);
    }
    .why-card-desc {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.75;
        margin: 0;
        text-align: justify;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .svc-hero { height: 260px; }

        .svc-hero-content h1 { font-size: 2.2rem; }
        .cat-header h2 { font-size: 1.8rem; }
        .service-card { padding: 30px 20px 25px; }
        .service-card .svc-img-wrap { width: 110px; height: 110px; }
        .why-choose-section { padding: 60px 0; }
        .why-choose-heading { font-size: 1.8rem; }
    }
    @media (max-width: 575px) {
        .svc-hero { height: 220px; }
        .svc-hero-content h1 { font-size: 1.6rem; }
        .svc-hero-content p { font-size: 0.9rem; }
        .cat-section { padding: 45px 0 20px; }
        .cat-header h2 { font-size: 1.4rem; }
        .cat-header p { font-size: 0.88rem; }
        .subcat-pill { padding: 6px 14px; font-size: 0.78rem; }
        .service-card .svc-body { padding: 16px; }
        .service-card .svc-body h5 { font-size: 0.95rem; }
        .service-card .svc-body .svc-desc { font-size: 0.8rem; }
        .service-card .svc-link { font-size: 0.82rem; }
        .why-choose-section { padding: 40px 0; }
        .why-choose-heading { font-size: 1.4rem; }
        .why-choose-sub { font-size: 0.88rem; }
        .why-card { padding: 25px 20px; border-radius: 16px; }
        .why-card-icon { width: 50px; height: 50px; border-radius: 12px; }
        .why-card-icon i { font-size: 1.2rem; }
        .why-card-title { font-size: 0.95rem; }
        .why-card-desc { font-size: 0.82rem; }
    }
    @media (max-width: 480px) {
        .svc-hero { height: 180px; }
        .svc-hero-content h1 { font-size: 1.4rem; }
        .svc-hero-content p { font-size: 0.8rem; }
        .service-card .svc-body { padding: 14px; }
        .svc-cat-header h2 { font-size: 1.3rem; }
        .why-card { padding: 25px 18px; }
        .why-card h4 { font-size: 1rem; }
    }
</style>
@endsection

@section('content')

<!-- Hero Banner -->
<div class="svc-hero">
    <div class="svc-hero-content" data-aos="fade-up">
        <h1>Our Services</h1>
        <p>Comprehensive landscaping solutions from design to maintenance</p>
    </div>
</div>

<!-- ===== ALL 9 SERVICES GRID ===== -->
<section class="cat-section">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach($services as $service)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                    <div class="service-card">
                        @if($service->image)
                        <div class="svc-img-wrap">
                            <img loading="lazy" src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                        </div>
                        @endif
                        <div class="svc-body">
                            <h5>{{ $service->name }}</h5>
                            <p class="svc-desc">{{ Str::limit(strip_tags($service->description), 120) }}</p>
                            <a href="{{ route('service.detail', $service->slug) }}" class="svc-link">Explore Services <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- Why Choose SR Greenscapes -->
<section class="why-choose-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="why-choose-label">WHY US</span>
            <h2 class="why-choose-heading">Why Choose <span>SR Greenscapes</span> Pvt Ltd</h2>
            <p class="why-choose-sub">Science-driven landscaping with sustainable, long-lasting results</p>
        </div>

        <div class="row g-4">
            @php
                $whyItems = [
                    ['icon' => 'fas fa-flask', 'title' => 'Science-Driven Approach', 'desc' => 'Every project is guided by scientific assessment, including soil analysis, plant selection, and climate-responsive planning.'],
                    ['icon' => 'fas fa-seedling', 'title' => 'Sustainability at the Core', 'desc' => 'We design eco-friendly landscapes that conserve water, enhance soil health, and support biodiversity.'],
                    ['icon' => 'fas fa-chart-bar', 'title' => 'Research-Integrated Planning', 'desc' => 'Our work is backed by academic expertise, field trials, and data-driven insights.'],
                    ['icon' => 'fas fa-globe-americas', 'title' => 'Climate-Resilient Design', 'desc' => 'We create adaptive landscapes that withstand heat, irregular rainfall, and urban stress.'],
                    ['icon' => 'fas fa-hard-hat', 'title' => 'End-to-End Execution', 'desc' => 'From design and plant supply to installation and maintenance, complete solutions under one roof.'],
                    ['icon' => 'fas fa-users', 'title' => 'Expert Leadership', 'desc' => 'Led by horticulture professionals and supported by a strong scientific network.'],
                ];
            @endphp

            @foreach($whyItems as $idx => $item)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $idx * 80 }}">
                    <div class="why-card">
                        <div class="why-card-icon">
                            <i class="{{ $item['icon'] }}"></i>
                        </div>
                        <h5 class="why-card-title">{{ $item['title'] }}</h5>
                        <p class="why-card-desc">{{ $item['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@section('cta')
<!-- CTA — Book Consultation -->
<section class="svc-cta-wrapper">
    <div class="container">
        <div class="svc-cta-section">
            <div class="svc-cta-overlay"></div>
            <div class="svc-cta-inner">
                <div class="svc-cta-left">
                    <h2 class="svc-cta-company">SR GREENSCAPES PVT LTD</h2>
                    <p class="svc-cta-tagline"><i class="fas fa-leaf"></i> Sowing Science, Growing Beauty</p>
                    <p class="svc-cta-desc">
                        Reach out to discuss your ideas and outdoor needs.<br>
                        We're here to help your garden thrive beautifully.
                    </p>
                </div>
                <div class="svc-cta-card">
                    <h4 class="svc-cta-card-title">Book Consultation</h4>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="services-cta">
                        <div class="svc-cta-row">
                            <input type="text" name="name" class="svc-cta-input" placeholder="Name *" required>
                            <input type="text" name="phone" class="svc-cta-input" placeholder="Phone *" required>
                        </div>
                        <select name="message" class="svc-cta-input" style="margin-bottom:10px;" required>
                            <option value="">Select Service *</option>
                            <option>Landscape Design & Execution</option>
                            <option>Specialized Garden Services</option>
                            <option>Hardscape & Softscape Development</option>
                            <option>Nursery & Plant Supply</option>
                            <option>Landscape Maintenance</option>
                            <option>Horticulture Consultancy</option>
                            <option>Garden Supplies</option>
                            <option>Green Gifts</option>
                            <option>Event Styling</option>
                            <option>Others</option>
                        </select>
                        <textarea name="details" class="svc-cta-input svc-cta-textarea" placeholder="Message"></textarea>
                        <button type="submit" class="svc-cta-submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .svc-cta-wrapper { padding: 60px 0 80px; background: #f9fbf7; }
    .svc-cta-section {
        position: relative;
        background: url('{{ asset('storage/banners/UzLsmhyoocKjP5FDbGYxHVVSVkxrJaVqcw3hrUIB.jpg') }}') center/cover no-repeat;
        padding: 60px 50px; overflow: hidden; border-radius: 30px;
        box-shadow: 0 20px 60px rgba(26,58,26,0.25);
    }
    .svc-cta-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to right, rgba(15,30,15,0.85) 0%, rgba(15,30,15,0.55) 55%, rgba(15,30,15,0.3) 100%);
        border-radius: 30px;
    }
    .svc-cta-inner {
        position: relative; z-index: 2;
        display: flex; align-items: center; justify-content: space-between; gap: 40px;
    }
    .svc-cta-left { flex: 1; max-width: 460px; }
    .svc-cta-company { color: #fff; font-size: 1.8rem; font-weight: 900; letter-spacing: 1px; margin-bottom: 12px; }
    .svc-cta-tagline { color: var(--primary); font-size: 1rem; font-weight: 500; font-style: italic; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
    .svc-cta-desc { color: rgba(255,255,255,0.6); font-size: 0.95rem; line-height: 1.75; }
    .svc-cta-card { width: 420px; flex-shrink: 0; background: rgba(255,255,255,0.97); border-radius: 12px; padding: 30px 25px; box-shadow: 0 15px 40px rgba(0,0,0,0.2); }
    .svc-cta-card-title { font-weight: 800; color: #1a3a1a; margin-bottom: 20px; font-size: 1.3rem; }
    .svc-cta-row { display: flex; gap: 10px; margin-bottom: 10px; }
    .svc-cta-input { flex: 1; border: 1px solid #e0e0e0; border-radius: 8px; padding: 11px 14px; font-size: 13px; background: #fafafa; width: 100%; transition: border-color 0.2s; color: #333; }
    .svc-cta-input::placeholder { color: #999; }
    .svc-cta-input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(76,175,80,0.1); }
    .svc-cta-textarea { display: block; width: 100%; height: 80px; resize: vertical; margin-bottom: 12px; }
    .svc-cta-submit { display: block; width: 100%; background: var(--primary); color: #fff; border: none; border-radius: 8px; padding: 13px; font-weight: 800; font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; transition: all 0.3s; }
    .svc-cta-submit:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(139,195,74,0.3); }
    @media (max-width: 991px) {
        .svc-cta-wrapper { padding: 40px 0 60px; }
        .svc-cta-section { padding: 40px 24px; border-radius: 24px; }
        .svc-cta-overlay { border-radius: 24px; }
        .svc-cta-inner { flex-direction: column; }
        .svc-cta-card { width: 100%; }
        .svc-cta-company { font-size: 1.4rem; }
    }
    @media (max-width: 575px) {
        .svc-cta-wrapper { padding: 25px 0 40px; }
        .svc-cta-section { padding: 25px 16px; border-radius: 18px; }
        .svc-cta-overlay { border-radius: 18px; }
        .svc-cta-company { font-size: 1.1rem; }
        .svc-cta-card { padding: 20px 16px; }
        .svc-cta-card-title { font-size: 1.1rem; }
        .svc-cta-row { flex-direction: column; gap: 8px; }
    }
    @media (max-width: 480px) {
        .svc-cta-left { max-width: 100%; }
        .svc-cta-card { width: 100%; min-width: unset; }
        .svc-cta-section { padding: 30px 15px; }
        .svc-cta-wrapper { flex-direction: column; }
    }
</style>
@endsection
