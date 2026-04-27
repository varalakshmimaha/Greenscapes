@extends('frontend.layouts.app')

@section('styles')
<style>
    /* ===== HERO SECTION ===== */
    .about-hero {
        position: relative;
        height: 320px;
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
        text-align: justify;
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
        font-size: 0.95rem;
        line-height: 1.75;
        margin-bottom: 0;
        transition: color 0.3s;
        text-align: justify;
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
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.4s;
        height: 100%;
        text-align: center;
        background: #eaf5ea;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 35px 25px 30px;
        border: none;
    }
    .about-diff-card:hover {
        box-shadow: none;
        transform: translateY(-8px);
    }
    .about-diff-img {
        width: 175px;
        height: 175px;
        border-radius: 50%;
        background: #e6f0e6;
        overflow: hidden;
        margin-bottom: 22px;
        flex-shrink: 0;
        border: 5px solid rgba(139,195,74,0.3);
        transition: border-color 0.3s;
    }
    .about-diff-card:hover .about-diff-img {
        border-color: var(--primary);
    }
    .about-diff-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .about-diff-card:hover .about-diff-img img {
        transform: scale(1.08);
    }
    .about-diff-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }
    .about-diff-body h6 {
        font-weight: 700;
        font-size: 1.1rem;
        color: #111;
        margin: 0;
        line-height: 1.4;
    }
    .about-diff-body p {
        font-size: 0.88rem;
        color: #555;
        margin: 0;
        line-height: 1.75;
        text-align: justify;
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
        height: 320px;
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
        font-size: 0.92rem;
        line-height: 1.65;
        margin: 0;
        text-align: justify;
    }

    @media (max-width: 991px) {
        .about-hero { height: 260px; }
        .about-hero h1 { font-size: 2.2rem; }
        .story-title, .team-header-title { font-size: 2rem; }
        .story-img { height: 350px; margin-top: 40px; }
        .team-img-wrapper { height: 300px; }
    }
    @media (max-width: 575px) {
        .team-img-wrapper { height: 280px; }
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
        .about-diff-img { width: 130px; height: 130px; }
        .about-diff-body h6 { font-size: 1rem; }
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

@section('cta')
<section class="about-cta-wrapper">
    <div class="container">
        <div class="about-cta-section">
            <div class="about-cta-overlay"></div>
            <div class="about-cta-inner">
                <div class="about-cta-left">
                    <h2 class="about-cta-company">SR GREENSCAPES PVT LTD</h2>
                    <p class="about-cta-tagline"><i class="fas fa-leaf"></i> Sowing Science, Growing Beauty</p>
                    <p class="about-cta-desc">
                        Our PhD horticulture professionals and landscape designers are ready to bring world-class greenery to your space.<br>Let's build something beautiful together.
                    </p>
                </div>
                <div class="about-cta-card">
                    <h4 class="about-cta-card-title">Book Consultation</h4>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="about-cta">
                        <div class="about-cta-row">
                            <input type="text" name="name" class="about-cta-input" placeholder="Name *" required>
                            <input type="text" name="phone" class="about-cta-input" placeholder="Phone *" required>
                        </div>
                        <select name="message" class="about-cta-input" style="margin-bottom:10px;">
                            <option value="">Select Service *</option>
                            <option>Landscape Design & Execution</option>
                            <option>Specialized Garden Services</option>
                            <option>Nursery & Plant Supply</option>
                            <option>Landscape Maintenance</option>
                            <option>Horticulture Consultancy</option>
                            <option>Others</option>
                        </select>
                        <textarea name="details" class="about-cta-input about-cta-textarea" placeholder="Message"></textarea>
                        <button type="submit" class="about-cta-submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .about-cta-wrapper { padding: 60px 0 80px; background: #f9fbf7; }
    .about-cta-section {
        position: relative;
        background: url('{{ asset('storage/banners/UzLsmhyoocKjP5FDbGYxHVVSVkxrJaVqcw3hrUIB.jpg') }}') center/cover no-repeat;
        padding: 60px 50px; overflow: hidden; border-radius: 30px;
        box-shadow: 0 20px 60px rgba(26,58,26,0.25);
    }
    .about-cta-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to right, rgba(15,30,15,0.85) 0%, rgba(15,30,15,0.55) 55%, rgba(15,30,15,0.3) 100%);
        border-radius: 30px;
    }
    .about-cta-inner { position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; gap: 40px; }
    .about-cta-left { flex: 1; max-width: 460px; }
    .about-cta-company { color: #fff; font-size: 1.8rem; font-weight: 900; letter-spacing: 1px; margin-bottom: 12px; }
    .about-cta-tagline { color: var(--primary); font-size: 1rem; font-weight: 500; font-style: italic; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
    .about-cta-desc { color: rgba(255,255,255,0.6); font-size: 0.95rem; line-height: 1.75; }
    .about-cta-card { width: 420px; flex-shrink: 0; background: rgba(255,255,255,0.97); border-radius: 12px; padding: 30px 25px; box-shadow: 0 15px 40px rgba(0,0,0,0.2); }
    .about-cta-card-title { font-weight: 800; color: #1a3a1a; margin-bottom: 20px; font-size: 1.3rem; }
    .about-cta-row { display: flex; gap: 10px; margin-bottom: 10px; }
    .about-cta-input { flex: 1; border: 1px solid #e0e0e0; border-radius: 8px; padding: 11px 14px; font-size: 13px; background: #fafafa; width: 100%; transition: border-color 0.2s; color: #333; }
    .about-cta-input::placeholder { color: #999; }
    .about-cta-input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(76,175,80,0.1); }
    .about-cta-textarea { display: block; width: 100%; height: 80px; resize: vertical; margin-bottom: 12px; }
    .about-cta-submit { display: block; width: 100%; background: var(--primary); color: #fff; border: none; border-radius: 8px; padding: 13px; font-weight: 800; font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; transition: all 0.3s; }
    .about-cta-submit:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(139,195,74,0.3); }
    @media (max-width: 991px) {
        .about-cta-wrapper { padding: 40px 0 60px; }
        .about-cta-section { padding: 40px 24px; border-radius: 24px; }
        .about-cta-overlay { border-radius: 24px; }
        .about-cta-inner { flex-direction: column; }
        .about-cta-card { width: 100%; }
        .about-cta-company { font-size: 1.4rem; }
    }
    @media (max-width: 575px) {
        .about-cta-wrapper { padding: 25px 0 40px; }
        .about-cta-section { padding: 25px 16px; border-radius: 18px; }
        .about-cta-overlay { border-radius: 18px; }
        .about-cta-company { font-size: 1.1rem; }
        .about-cta-card { padding: 20px 16px; }
        .about-cta-card-title { font-size: 1.1rem; }
        .about-cta-row { flex-direction: column; gap: 8px; }
    }
</style>
@endsection
