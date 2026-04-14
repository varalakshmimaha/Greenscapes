@extends('frontend.layouts.app')

@section('styles')
<style>
    /* ===== HERO SECTION ===== */
    .about-hero {
        position: relative;
        height: 380px;
        background: url('{{ asset('storage/About Us/2.1  Science-Driven Approach.jpg') }}') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .about-hero::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(rgba(26,42,26,0.7), rgba(26,42,26,0.85));
    }
    .hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .hero-content h1 {
        font-size: 2.2rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 10px;
    }
    .breadcrumb-custom {
        display: flex;
        justify-content: center;
        gap: 10px;
        font-size: 0.9rem;
        font-weight: 500;
        opacity: 0.9;
    }
    .breadcrumb-custom a { color: var(--accent); text-decoration: none; }
    .breadcrumb-custom span { color: #fff; }

    /* ===== STORY SECTION ===== */
    .story-section {
        padding: 100px 0;
        background: #fff;
    }
    .story-label {
        font-size: 14px;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 12px;
        display: inline-block;
    }
    .story-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--dark);
        line-height: 1.3;
        margin-bottom: 25px;
    }
    .story-title span { color: inherit; }
    .story-text {
        font-size: 1.05rem;
        line-height: 1.9;
        color: #555;
        margin-bottom: 30px;
    }
    .story-img-wrap {
        position: relative;
        padding-left: 20px;
        padding-top: 20px;
    }
    .story-img-wrap::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 150px;
        height: 150px;
        border-top: 5px solid var(--primary);
        border-left: 5px solid var(--primary);
        z-index: 0;
    }
    .story-img {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 20px 20px 60px rgba(0,0,0,0.1);
        position: relative;
        z-index: 1;
    }

    /* ===== MISSION & VISION ===== */
    .vision-section {
        padding: 80px 0;
        background: #fdfdfd;
        position: relative;
    }
    .vision-card {
        background: #fff;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.04);
        border: 1px solid #f0f0f0;
        height: 100%;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
    }
    .vision-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 5px;
        background: linear-gradient(90deg, #4CAF50, #8BC34A);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }
    .vision-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(76, 175, 80, 0.08);
        border-color: rgba(76, 175, 80, 0.2);
    }
    .vision-card:hover::before {
        transform: scaleX(1);
    }
    .vision-icon {
        width: 70px;
        height: 70px;
        background: var(--light-green);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--primary-dark);
        margin-bottom: 25px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .vision-card:hover .vision-icon {
        background: var(--primary);
        color: #fff;
        transform: scale(1.1);
        box-shadow: 0 10px 20px rgba(76, 175, 80, 0.3);
    }
    .vision-card h3 {
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 15px;
        font-size: 1.5rem;
        transition: color 0.3s;
    }
    .vision-card:hover h3 {
        color: var(--primary);
    }
    .vision-card p {
        color: #666;
        line-height: 1.7;
        margin-bottom: 0;
        transition: color 0.3s;
    }
    .vision-card:hover p {
        color: #444;
    }

    /* ===== CORE VALUES ===== */
    .values-section {
        padding: 100px 0;
        background: var(--dark-bg);
        color: #fff;
    }
    .value-card {
        padding: 30px;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        transition: all 0.3s;
        text-align: center;
    }
    .value-card:hover {
        background: rgba(255,255,255,0.05);
        border-color: var(--primary);
    }
    .value-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 20px;
    }
    .value-card h5 {
        font-weight: 700;
        color: #fff;
        margin-bottom: 15px;
    }
    .value-card p {
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
        line-height: 1.6;
    }

    /* ===== TEAM SECTION ===== */
    .team-section {
        padding: 100px 0;
        background: #fff;
    }
    .team-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        transition: transform 0.3s;
    }
    .team-card:hover { transform: translateY(-5px); }
    .team-img-wrap {
        height: 320px;
        overflow: hidden;
        position: relative;
    }
    .team-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .team-card:hover .team-img-wrap img { transform: scale(1.1); }
    .team-info {
        padding: 25px;
        text-align: center;
    }
    .team-info h5 {
        font-weight: 700;
        margin-bottom: 5px;
        color: var(--dark);
    }
    .team-info span {
        color: var(--primary);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .team-social {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 15px;
    }
    .team-social a {
        color: #ccc;
        font-size: 1.1rem;
        transition: color 0.3s;
    }
    .team-social a:hover { color: var(--primary); }

    /* ===== EXPERTISE SECTION ===== */
    .expertise-wrap {
        padding: 80px 0;
        background: #f8faf8;
    }
    .expertise-card {
        display: flex;
        align-items: center;
        gap: 25px;
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.03);
        margin-bottom: 20px;
    }
    .exp-icon {
        width: 60px;
        height: 60px;
        min-width: 60px;
        background: var(--light-green);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--primary-dark);
    }
    .exp-body h6 {
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 1.1rem;
    }
    .exp-body p {
        font-size: 0.9rem;
        color: #777;
        margin-bottom: 0;
    }

    /* ===== WHAT MAKES US DIFFERENT CARDS ===== */
    .about-diff-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.3s;
        height: 100%;
        border: 1px solid #eee;
    }
    .about-diff-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.1);
        border-color: rgba(139,195,74,0.3);
    }
    .about-diff-img {
        height: 180px;
        overflow: hidden;
    }
    .about-diff-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .about-diff-card:hover .about-diff-img img {
        transform: scale(1.05);
    }
    .about-diff-body {
        padding: 20px;
    }
    .about-diff-body h6 {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--dark);
        margin-bottom: 8px;
    }
    .about-diff-body p {
        font-size: 0.82rem;
        color: #777;
        margin-bottom: 0;
        line-height: 1.6;
    }

    /* ===== MODERN TEAM SECTION ===== */
    .about-team-section {
        padding: 90px 0;
        background: #fdfdfd;
        position: relative;
    }
    .team-header-label {
        display: inline-block;
        background: rgba(139,195,74,0.12);
        color: var(--primary);
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 15px;
    }
    .team-header-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: #1a3a1a;
        margin-bottom: 12px;
    }
    .team-header-title span { color: var(--primary); }
    .team-header-desc {
        color: #666;
        font-size: 1.05rem;
        line-height: 1.7;
        max-width: 600px;
        margin: 0 auto;
    }
    .modern-team-category {
        text-align: center;
        margin: 50px 0 30px;
        position: relative;
    }
    .modern-category-title {
        display: inline-block;
        background: #fff;
        border: 1px solid rgba(139,195,74,0.3);
        color: var(--primary-dark);
        padding: 8px 30px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }
    .modern-team-category::before {
        content: '';
        position: absolute;
        top: 50%; left: 0; right: 0;
        height: 1px;
        background: rgba(139,195,74,0.2);
        z-index: 1;
    }
    .modern-team-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        position: relative;
    }
    .modern-team-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(139,195,74,0.1);
        border-color: rgba(139,195,74,0.2);
    }
    .team-img-wrapper {
        position: relative;
        height: 260px;
        width: 100%;
        overflow: hidden;
        background: #f4fbf4;
    }
    .team-img-wrapper img, .team-placeholder {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .team-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 800;
        color: var(--primary);
        letter-spacing: 2px;
        background: linear-gradient(135deg, #eef9ee, #d8f0d8);
    }
    .modern-team-card:hover .team-img-wrapper img {
        transform: scale(1.08);
    }
    .team-info {
        padding: 25px 20px;
        text-align: center;
        background: #fff;
        position: relative;
        z-index: 2;
    }
    .team-info h5 {
        font-weight: 800;
        color: #1a3a1a;
        font-size: 1.2rem;
        margin-bottom: 5px;
        transition: color 0.3s;
    }
    .modern-team-card:hover .team-info h5 { color: var(--primary); }
    .team-role {
        display: block;
        color: var(--primary);
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }
    .team-bio {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0;
    }

    @media (max-width: 991px) {
        .about-hero h1 { font-size: 2.2rem; }
        .story-title, .team-header-title { font-size: 2rem; }
        .story-img { height: 350px; margin-top: 40px; }
        .team-img-wrapper { height: 280px; }
    }
    @media (max-width: 575px) {
        .team-img-wrapper { height: 320px; }
    }
    /* ===== TESTIMONIALS SECTION ===== */
    .about-testi-section {
        padding: 80px 0;
        background: #fff;
    }
    .about-testi-card {
        background: #f9fbf9;
        border-radius: 16px;
        padding: 35px 28px;
        height: 100%;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        transition: all 0.3s;
        border: 1px solid #eee;
        display: flex;
        flex-direction: column;
    }
    .about-testi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.08);
        border-color: rgba(139,195,74,0.3);
    }
    .about-testi-quote {
        color: var(--primary);
        font-size: 2rem;
        margin-bottom: 15px;
        opacity: 0.7;
    }
    .about-testi-stars {
        color: #f59e0b;
        font-size: 0.85rem;
        margin-bottom: 12px;
    }
    .about-testi-text {
        color: #555;
        font-size: 0.95rem;
        font-style: italic;
        line-height: 1.7;
        margin-bottom: 25px;
        flex-grow: 1;
    }
    .about-testi-author {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .about-testi-author img {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--primary);
    }
    .about-testi-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: #f0f7f0;
        border: 2px solid #C5E1A5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8db568;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .about-testi-name {
        font-weight: 700;
        font-size: 0.95rem;
        color: #1a2a1a;
        margin-bottom: 2px;
    }
    .about-testi-role {
        font-size: 0.78rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    @media (max-width: 575px) {
        .about-hero { padding: 80px 15px 40px; }
        .about-hero h1 { font-size: 1.6rem; }
        .about-hero p { font-size: 0.85rem; }
        .story-section { padding: 50px 15px; }
        .story-title { font-size: 1.5rem; }
        .story-img { height: 250px; margin-top: 20px; }
        .expertise-card { flex-direction: column; text-align: center; gap: 12px; }
        .about-team-wrap { padding: 0 10px; }
        .about-team-divider-label { font-size: 12px; padding: 4px 14px; }
        .about-team-card .at-name { font-size: 14px; }
        .about-team-card .at-role { font-size: 12px; }
        .about-team-card .at-bio { font-size: 12px; }
        .about-team-avatar { width: 70px; height: 70px; }
        .about-diff-img { height: 150px; }
        .about-diff-body { padding: 16px; }
        .about-diff-body h6 { font-size: 0.88rem; }
        .director-card { padding: 25px 18px 22px; }
        .director-img { width: 110px; height: 110px; }
        .director-name { font-size: 0.95rem; }
        .advisor-img { width: 95px; height: 95px; }
        .core-img { width: 80px; height: 80px; }
        .about-testi-section { padding: 50px 0; }
        .about-testi-card { padding: 25px 20px; }
        .about-testi-text { font-size: 0.88rem; }
        .about-testi-author img, .about-testi-avatar { width: 42px; height: 42px; }
    }
</style>
@endsection

@section('content')

<!-- Hero Section -->
<section class="about-hero">
    <div class="hero-content">
        <h1 data-aos="fade-up">About Us</h1>
        <div class="breadcrumb-custom" data-aos="fade-up" data-aos-delay="100">
            <a href="/">Home</a>
            <span>/</span>
            <span>About Us</span>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="story-section" id="overview">
    <div class="container">
        @php
            $overview = $about->where('section', 'overview')->first();
        @endphp
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="story-label">{{ $overview->title ?? 'Our Journey' }}</span>
                <h2 class="story-title">Revolutionizing Landscapes with <span>Scientific Integrity</span></h2>
                <div class="story-text">
                    {!! $overview->description ?? 'SR GREENSCAPES PVT LTD is a science-driven sustainable landscaping company creating eco-friendly, high-performance landscapes across India. We combine plant science, climate-responsive design and expert execution to deliver spaces that are beautiful, functional and built to last.' !!}
                </div>
                <div class="row g-4 mt-2">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="exp-icon" style="width:50px; height:50px; min-width:50px; font-size:1.2rem;"><i class="fas fa-check"></i></div>
                            <h6 class="mb-0 fw-bold">Certified Specialists</h6>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="exp-icon" style="width:50px; height:50px; min-width:50px; font-size:1.2rem;"><i class="fas fa-microscope"></i></div>
                            <h6 class="mb-0 fw-bold">Research-Based</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="story-img-wrap">
                    <img loading="lazy" src="{{ asset('storage/' . ($overview->image ?? 'About Us/2.2 Sustainability at the Core.jpg')) }}" alt="Our Story" class="story-img">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section class="vision-section" id="vision">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="story-label">What Guides Us</span>
            <h2 class="story-title">Our Vision & <span>Mission</span></h2>
        </div>
        <div class="row g-4 justify-content-center">
            @php
                $vision = $about->where('section', 'vision')->first();
                $mission = $about->where('section', 'mission')->first();
            @endphp
            <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="100">
                <div class="vision-card">
                    <div class="vision-icon"><i class="fas fa-eye"></i></div>
                    <h3>{{ $vision->title ?? 'Our Vision' }}</h3>
                    <p>{!! $vision->description ?? 'To be India’s leader in climate-resilient landscaping, setting global benchmarks for sustainable, science-backed outdoor development.' !!}</p>
                </div>
            </div>
            <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
                <div class="vision-card">
                    <div class="vision-icon"><i class="fas fa-bullseye"></i></div>
                    <h3>{{ $mission->title ?? 'Our Mission' }}</h3>
                    <p>{!! $mission->description ?? 'To blend horticulture science with creative design to build landscapes that perform ecologically while inspiring human connection with nature.' !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="values-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="story-label" style="color:var(--primary)">Our Core Values</span>
            <h2 class="text-white fw-bold">What Drives Our Excellence</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-leaf"></i></div>
                    <h5>Sustainability</h5>
                    <p>Every design prioritizes long-term ecological balance and resource efficiency.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-flask"></i></div>
                    <h5>Scientific Accuracy</h5>
                    <p>Decisions backed by soil data, plant biology, and environmental assessments.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-handshake"></i></div>
                    <h5>Reliability</h5>
                    <p>Transparent processes and dedicated lifecycle support for every project.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-lightbulb"></i></div>
                    <h5>Innovation</h5>
                    <p>Adopting modern technology for irrigation, vertical planting, and growth monitoring.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What Makes Us Different -->
<section class="diff-section" style="padding: 80px 0; background: #f8faf8;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="story-label">Why We Stand Out</span>
            <h2 class="story-title">What Makes Us <span>Different</span></h2>
        </div>

        <div class="row g-4">
            @php
                $diffItems = [
                    ['img' => 'About Us/2.1  Science-Driven Approach.jpg', 'title' => 'Science-Driven Approach', 'desc' => 'Every project is guided by scientific assessment, including soil analysis, plant suitability studies, and climate-responsive planning to ensure long-term landscape performance.'],
                    ['img' => 'About Us/2.2 Sustainability at the Core.jpg', 'title' => 'Sustainability at the Core', 'desc' => 'Our landscapes are designed to conserve water, improve soil health, promote native biodiversity and reduce long-term maintenance costs — creating environmentally responsible and future-ready green spaces.'],
                    ['img' => 'About Us/2.3  Research-Integrated Planning.jpg', 'title' => 'Research-Integrated Planning', 'desc' => 'Backed by academic expertise and field trials, we integrate innovation, performance evaluation and evidence-based plant selection into every project.'],
                    ['img' => 'About Us/2.4  Climate-Resilient Design.jpg', 'title' => 'Climate-Resilient Design', 'desc' => 'We develop adaptive landscapes that withstand heat stress, irregular rainfall and urban environmental pressures — ensuring durability and ecological stability.'],
                    ['img' => 'About Us/2.5  End-to-End Execution.jpg', 'title' => 'End-to-End Execution', 'desc' => 'From concept design and nursery production to irrigation systems and long-term maintenance, we provide complete, integrated green solutions under one roof.'],
                    ['img' => 'About Us/2.6 Experienced Leadership  Advisory Strength.jpg', 'title' => 'Experienced Leadership & Advisory Strength', 'desc' => 'Led by horticulture professionals and supported by a scientific advisory network, we bring institutional credibility and technical depth to every assignment.'],
                    ['img' => 'About Us/2.7 Long-Term Value Creation.jpg', 'title' => 'Long-Term Value Creation', 'desc' => 'Our focus is not just installation — but lifecycle performance, reduced resource use and sustained landscape health that delivers measurable value over time.'],
                    ['img' => 'About Us/2.8 Cost-Effective  Affordable.jpg', 'title' => 'Cost-Effective & Affordable', 'desc' => 'We deliver high-quality landscapes that balance performance, design and budget — ensuring maximum value through efficient planning, smart plant selection and optimized resource use.'],
                ];
            @endphp

            @foreach($diffItems as $item)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <div class="about-diff-card">
                        <div class="about-diff-img">
                            <img loading="lazy" src="{{ asset('storage/' . $item['img']) }}" alt="{{ $item['title'] }}">
                        </div>
                        <div class="about-diff-body">
                            <h6>{{ $item['title'] }}</h6>
                            <p>{{ $item['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Our Team Section (Modern Grid) -->
<section id="team" class="about-team-section">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center" style="margin-bottom: 50px;" data-aos="fade-up">
            <div class="team-header-label"><i class="fas fa-users" style="margin-right: 6px;"></i> Meet Our Experts</div>
            <h2 class="team-header-title">The Faces Behind <span>SR Greenscapes</span></h2>
            <p class="team-header-desc">A multidisciplinary team of horticulturists, designers, and project managers dedicated to building sustainable and inspiring environments.</p>
        </div>

        @if($teamCategories->count())
            @foreach($teamCategories as $catIndex => $category)
                @if($category->members->count())
                    
                    <div class="modern-team-category" data-aos="fade-up">
                        <h4 class="modern-category-title">{{ $category->name }}</h4>
                    </div>

                    <div class="row g-4 justify-content-center mb-5">
                        @foreach($category->members as $member)
                            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div class="modern-team-card">
                                    <div class="team-card-inner">
                                        <div class="team-img-wrapper">
                                            @if($member->photo)
                                                <img loading="lazy" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                                            @else
                                                <div class="team-placeholder">
                                                    {{ collect(explode(' ', $member->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->filter(fn($l) => ctype_alpha($l))->take(2)->implode('') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="team-info">
                                            <h5>{{ $member->name }}</h5>
                                            <span class="team-role">{{ $member->role }}</span>
                                            @if($member->bio)
                                                <p class="team-bio">{{ Str::limit($member->bio, 80) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endif
            @endforeach
        @endif

    </div>
</section>

<!-- What Our Clients Are Saying -->
<section class="about-testi-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="story-label">Testimonials</span>
            <h2 class="story-title">What Our Clients Are <span>Saying</span></h2>
        </div>

        @php
            $fallbackTestimonials = [
                (object)['name' => 'Eleanor Pena', 'designation' => 'Founder', 'message' => 'They improved our lawn beautifully. The turfing looks fresh, even, and very professionally done. The team worked with care and kept us updated throughout the process.', 'rating' => 5],
                (object)['name' => 'Emily Carter', 'designation' => 'Senior Project Manager', 'message' => 'The landscaping team delivered an outstanding result. Their scientific approach to soil analysis and plant selection gave us a garden that thrives year-round.', 'rating' => 5],
                (object)['name' => 'Bessie Cooper', 'designation' => 'Property Owner', 'message' => 'Professional, reliable and incredibly knowledgeable. SR Greenscapes transformed our commercial campus into a green oasis that our employees love.', 'rating' => 5],
            ];
            $activeTestimonials = (isset($testimonials) && $testimonials->count() > 0) ? $testimonials->take(3) : collect($fallbackTestimonials);
        @endphp

        <div class="row g-4 justify-content-center">
            @foreach($activeTestimonials as $t)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="about-testi-card">
                        <div class="about-testi-quote"><i class="fas fa-quote-left"></i></div>
                        <div class="about-testi-stars">
                            @for($i = 0; $i < ($t->rating ?? 5); $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <p class="about-testi-text">"{{ $t->content ?? $t->message ?? $t->text ?? '' }}"</p>
                        <div class="about-testi-author">
                            @php $tPhoto = $t->photo ?? $t->image ?? null; @endphp
                            @if($tPhoto)
                                <img loading="lazy" src="{{ asset('storage/' . $tPhoto) }}" alt="{{ $t->name }}">
                            @else
                                <div class="about-testi-avatar"><i class="fas fa-user"></i></div>
                            @endif
                            <div>
                                <div class="about-testi-name">{{ $t->name }}</div>
                                <div class="about-testi-role">{{ $t->designation ?? $t->role ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== CTA SPLIT CARD — About Us Only ===== -->
<section class="footer-cta-wrap">
    <div class="footer-cta-container">
        <div class="cta-split-card">

            <!-- LEFT: Men Serving Image + Testimonial -->
            <div class="cta-img-panel">
                <img loading="lazy" src="{{ asset('storage/About Us/2.5  End-to-End Execution.jpg') }}" alt="SR Greenscapes Professional Service">
                <div class="cta-quote-overlay">
                    <blockquote>"They made my home sparkle!<br>Highly professional and fast service"</blockquote>
                    <span class="cta-quote-author">Stiven Dowson</span>
                </div>
            </div>

            <!-- RIGHT: Contact Form -->
            <div class="cta-form-panel">
                <span class="cta-contact-label">● Contact Us</span>
                <h2 class="cta-form-heading">Ready to Get Started?</h2>
                <p style="color:rgba(255,255,255,0.7);font-size:0.9rem;margin-bottom:20px;line-height:1.7;">Share your requirements and our team will get back to you within 24 hours with a tailored solution for your landscape needs.</p>

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="source" value="about-cta">
                    <div class="row g-3">
                        <div class="col-6">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name">
                        </div>
                        <div class="col-6">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="col-6">
                            <input type="email" name="email" class="form-control" placeholder="Email (Optional)">
                        </div>
                        <div class="col-6">
                            <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="col-6">
                            <select name="subject" class="form-control">
                                <option value="">Select Service</option>
                                <option>Landscape Design & Execution</option>
                                <option>Hardscape & Softscape Development</option>
                                <option>Commercial Campus Landscaping</option>
                                <option>Specialized Garden Services</option>
                                <option>Nursery & Plant Supply</option>
                                <option>Horticulture Consultancy</option>
                                <option>Landscape Maintenance (AMC)</option>
                                <option>Event Styling & Green Decor</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <input type="text" name="address" class="form-control" placeholder="Address">
                        </div>
                        <div class="col-12">
                            <textarea name="message" class="form-control" rows="4" placeholder="Message"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn-cta-submit">SUBMIT REQUEST</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<style>
    /* ===== CTA SPLIT CARD — About Us ===== */
    .footer-cta-wrap {
        padding: 80px 0;
        background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover no-repeat;
        position: relative;
    }
    .footer-cta-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(10, 30, 10, 0.55);
    }
    .footer-cta-container {
        position: relative;
        z-index: 2;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .cta-split-card {
        display: flex;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 30px 80px rgba(0,0,0,0.35);
        min-height: 520px;
    }
    /* Left image panel */
    .cta-img-panel {
        flex: 0 0 44%;
        position: relative;
        overflow: hidden;
    }
    .cta-img-panel img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .cta-img-panel::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.05) 40%, rgba(0,0,0,0.7) 100%);
    }
    .cta-quote-overlay {
        position: absolute;
        bottom: 30px;
        left: 26px;
        right: 26px;
        z-index: 2;
        color: #fff;
    }
    .cta-quote-overlay blockquote {
        font-size: 1.08rem;
        font-weight: 700;
        line-height: 1.5;
        margin: 0 0 12px;
        font-style: italic;
    }
    .cta-quote-author {
        display: inline-block;
        background: rgba(255,255,255,0.18);
        border: 1px solid rgba(255,255,255,0.35);
        padding: 5px 16px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 600;
        color: #fff;
    }
    /* Right form panel */
    .cta-form-panel {
        flex: 1;
        background: linear-gradient(135deg, #f0fbe8 0%, #e8f5d8 100%);
        padding: 44px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .cta-contact-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(139,195,74,0.2);
        color: #3a6b1a;
        border-radius: 50px;
        padding: 5px 16px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }
    .cta-form-heading {
        font-size: 2rem;
        font-weight: 800;
        color: #1a2a1a;
        margin-bottom: 24px;
        line-height: 1.2;
    }
    .cta-form-panel .form-control {
        border: 1.5px solid #d4e8c2;
        border-radius: 10px;
        padding: 11px 14px;
        font-size: 0.88rem;
        color: #333;
        background: #fff;
        transition: border-color 0.2s;
    }
    .cta-form-panel .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(139,195,74,0.2);
        outline: none;
    }
    .cta-form-panel .form-control::placeholder { color: #aaa; }
    .btn-cta-submit {
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 13px 36px;
        font-size: 0.85rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
        margin-top: 6px;
    }
    .btn-cta-submit:hover {
        background: #3a6b1a;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(139,195,74,0.35);
    }
    @media (max-width: 991px) {
        .cta-split-card { flex-direction: column; }
        .cta-img-panel { flex: 0 0 300px; }
        .cta-form-panel { padding: 32px 24px; }
        .cta-form-heading { font-size: 1.6rem; }
    }
</style>

@endsection


@section('scripts')
<!-- Add AOS for scroll animations if not already present in app.blade.php -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
</script>
@endsection
