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

    /* ===== CATEGORY CARDS ===== */
    .svc-categories {
        padding: 70px 0 90px;
        background: #f9fbf9;
    }
    .svc-categories .section-label {
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
    .svc-categories .section-heading {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1a3a1a;
        margin-bottom: 12px;
    }
    .svc-categories .section-heading span {
        color: var(--primary);
    }
    .svc-categories .section-sub {
        color: #777;
        font-size: 1rem;
        max-width: 550px;
        margin: 0 auto 50px;
    }

    .svc-cat-card {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        height: 420px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        text-decoration: none;
        transition: all 0.4s;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }
    .svc-cat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.18);
    }
    .svc-cat-card .cat-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        transition: transform 0.5s;
    }
    .svc-cat-card:hover .cat-bg {
        transform: scale(1.08);
    }
    .svc-cat-card .cat-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(10,25,10,0.92) 0%, rgba(10,25,10,0.4) 50%, rgba(10,25,10,0.15) 100%);
        transition: background 0.4s;
    }
    .svc-cat-card:hover .cat-overlay {
        background: linear-gradient(to top, rgba(10,25,10,0.95) 0%, rgba(10,25,10,0.5) 50%, rgba(10,25,10,0.2) 100%);
    }
    .svc-cat-card .cat-content {
        position: relative;
        z-index: 2;
        padding: 35px 30px;
    }
    .svc-cat-card .cat-icon {
        width: 60px;
        height: 60px;
        background: rgba(139,195,74,0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: all 0.3s;
    }
    .svc-cat-card:hover .cat-icon {
        background: var(--primary);
    }
    .svc-cat-card .cat-icon i {
        font-size: 1.5rem;
        color: var(--primary);
        transition: color 0.3s;
    }
    .svc-cat-card:hover .cat-icon i {
        color: #fff;
    }
    .svc-cat-card h3 {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 10px;
    }
    .svc-cat-card .cat-desc {
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
        line-height: 1.7;
        margin-bottom: 18px;
    }
    .svc-cat-card .cat-arrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        font-weight: 600;
        font-size: 0.9rem;
        transition: gap 0.3s;
    }
    .svc-cat-card:hover .cat-arrow {
        gap: 14px;
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
        background: #fff;
        border-radius: 20px;
        padding: 35px 28px;
        height: 100%;
        border: 1px solid #eee;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    .why-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 4px; height: 0;
        background: var(--primary);
        border-radius: 0 0 4px 4px;
        transition: height 0.4s;
    }
    .why-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        border-color: rgba(139,195,74,0.3);
    }
    .why-card:hover::before { height: 100%; }
    .why-card-icon {
        width: 60px; height: 60px;
        background: rgba(139,195,74,0.1);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: all 0.3s;
    }
    .why-card-icon i {
        font-size: 1.4rem;
        color: var(--primary);
        transition: all 0.3s;
    }
    .why-card:hover .why-card-icon { background: var(--primary); }
    .why-card:hover .why-card-icon i { color: #fff; }
    .why-card-title {
        font-weight: 700;
        color: #1a3a1a;
        font-size: 1.05rem;
        margin-bottom: 12px;
    }
    .why-card-desc {
        color: #666;
        font-size: 0.88rem;
        line-height: 1.7;
        margin: 0;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .svc-hero { height: 260px; }
        .svc-hero-content h1 { font-size: 2.2rem; }
        .svc-cat-card { height: 360px; }
        .svc-categories { padding: 50px 0 60px; }
        .svc-categories .section-heading { font-size: 1.8rem; }
        .why-choose-section { padding: 60px 0; }
        .why-choose-heading { font-size: 1.8rem; }
    }
    @media (max-width: 575px) {
        .svc-hero { height: 220px; }
        .svc-hero-content h1 { font-size: 1.6rem; }
        .svc-hero-content p { font-size: 0.9rem; }
        .svc-categories { padding: 35px 0 45px; }
        .svc-categories .section-heading { font-size: 1.4rem; }
        .svc-categories .section-sub { font-size: 0.88rem; margin-bottom: 30px; }
        .svc-cat-card { height: 320px; }
        .svc-cat-card .cat-content { padding: 25px 22px; }
        .svc-cat-card h3 { font-size: 1.25rem; }
        .svc-cat-card .cat-desc { font-size: 0.82rem; }
        .why-choose-section { padding: 40px 0; }
        .why-choose-heading { font-size: 1.4rem; }
        .why-choose-sub { font-size: 0.88rem; }
        .why-card { padding: 25px 20px; border-radius: 16px; }
        .why-card-icon { width: 50px; height: 50px; border-radius: 12px; }
        .why-card-icon i { font-size: 1.2rem; }
        .why-card-title { font-size: 0.95rem; }
        .why-card-desc { font-size: 0.82rem; }
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

<!-- Service Categories -->
<section class="svc-categories">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <span class="section-label">WHAT WE DO</span>
            <h2 class="section-heading">Explore Our <span>Service Areas</span></h2>
            <p class="section-sub">Choose a category to discover the specialized services we offer</p>
        </div>

        @php
            $catIcons = [
                'fas fa-drafting-compass',
                'fas fa-seedling',
                'fas fa-tools',
            ];
            $catDescriptions = [
                'Professional landscape design, hardscape & softscape development for residential and commercial spaces.',
                'Premium nursery plants, specialized gardens, and expert horticulture consultancy services.',
                'Comprehensive annual maintenance contracts and event styling to keep your spaces thriving.',
            ];
            $catImages = [
                'Home/1.16 Landscape Design  Execution.png',
                'Home/1.20 Nursery  Plant Supply.jpg',
                'Home/1.19 Landscape Maintenance.png',
            ];
        @endphp

        <div class="row g-4">
            @foreach($serviceCategories as $idx => $cat)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                    <a href="{{ route('services.category', $cat->slug) }}" class="svc-cat-card">
                        <div class="cat-bg" style="background-image: url('{{ $cat->image ? asset('storage/' . $cat->image) : asset('storage/' . ($catImages[$idx] ?? $catImages[0])) }}')"></div>
                        <div class="cat-overlay"></div>
                        <div class="cat-content">
                            <div class="cat-icon">
                                <i class="{{ $catIcons[$idx] ?? 'fas fa-leaf' }}"></i>
                            </div>
                            <h3>{{ $cat->name }}</h3>
                            <p class="cat-desc">{{ $catDescriptions[$idx] ?? 'Explore our range of professional services in this category.' }}</p>
                            <span class="cat-arrow">Explore Services <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
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
                        <div class="svc-cta-row">
                            <input type="text" name="subject" class="svc-cta-input" placeholder="City">
                            <select name="message" class="svc-cta-input" required>
                                <option value="">Select Service *</option>
                                <option>Landscape Design & Execution</option>
                                <option>Specialized Garden Services</option>
                                <option>Softscape & Hardscape Development</option>
                                <option>Nursery & Plant Supply</option>
                                <option>Landscape Maintenance</option>
                                <option>Horticulture Consultancy</option>
                                <option>Green Gifts</option>
                                <option>Event Styling</option>
                                <option>Others</option>
                            </select>
                        </div>
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
</style>
@endsection
