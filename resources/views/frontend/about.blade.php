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
        transition: transform 0.3s;
    }
    .vision-card:hover {
        transform: translateY(-10px);
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
    }
    .vision-card h3 {
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 15px;
        font-size: 1.5rem;
    }
    .vision-card p {
        color: #666;
        line-height: 1.7;
        margin-bottom: 0;
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

    @media (max-width: 991px) {
        .about-hero h1 { font-size: 2.2rem; }
        .story-title { font-size: 2rem; }
        .story-img { height: 350px; margin-top: 40px; }
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

<!-- Expertise & Differentiation -->
<section class="expertise-wrap">
    <div class="container">
        @php
            $expertise = $about->where('section', 'expertise')->first();
        @endphp
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <img loading="lazy" src="{{ asset('storage/' . ($expertise->image ?? 'About Us/2.3  Research-Integrated Planning.jpg')) }}" alt="Expertise" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="story-label">Why We Stand Out</span>
                <h2 class="story-title mb-4">The SR Greenscapes <span>Difference</span></h2>
                <div class="expertise-list">
                    <div class="expertise-card">
                        <div class="exp-icon"><i class="fas fa-vial"></i></div>
                        <div class="exp-body">
                            <h6>Evidence-Based Selection</h6>
                            <p>We don't just pick pretty plants; we select species that thrive in your specific soil and micro-climate.</p>
                        </div>
                    </div>
                    <div class="expertise-card">
                        <div class="exp-icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="exp-body">
                            <h6>Climate Resilience</h6>
                            <p>Designs built to withstand heatwaves, heavy monsoons, and urban stressors.</p>
                        </div>
                    </div>
                    <div class="expertise-card">
                        <div class="exp-icon"><i class="fas fa-sync"></i></div>
                        <div class="exp-body">
                            <h6>360-Degree Execution</h6>
                            <p>From internal nursery production to specialized project management and AMC support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section" id="team">
    <div class="container">
        <div class="text-center mb-5">
            <span class="story-label">Meet Our Experts</span>
            <h2 class="story-title">
                @if(isset($activeCategory) && $activeCategory)
                    {{ $activeCategory->name }} <span>Team</span>
                @else
                    Behind Our <span>Green Success</span>
                @endif
            </h2>
        </div>

        <div class="row g-4">
            @if(isset($teamMembers) && $teamMembers->count())
                @foreach($teamMembers as $member)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up">
                        <div class="team-card">
                            <div class="team-img-wrap">
                                <img loading="lazy" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                            </div>
                            <div class="team-info">
                                <h5>{{ $member->name }}</h5>
                                <span>{{ $member->role }}</span>
                                <div class="team-social">
                                    @if($member->linkedin) <a href="{{ $member->linkedin }}"><i class="fab fa-linkedin-in"></i></a> @endif
                                    @if($member->facebook) <a href="{{ $member->facebook }}"><i class="fab fa-facebook-f"></i></a> @endif
                                    @if($member->instagram) <a href="{{ $member->instagram }}"><i class="fab fa-instagram"></i></a> @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @php
                    $dummyTeam = [
                        ['name' => 'Dr. Raghavan S.', 'role' => 'Principal Horticulture Consultant'],
                        ['name' => 'Meera Iyer', 'role' => 'Landscape Architect'],
                        ['name' => 'Karan Singh', 'role' => 'Project Operations Head'],
                        ['name' => 'Anita Desai', 'role' => 'Sustainable Design Expert'],
                    ];
                @endphp
                @foreach($dummyTeam as $i => $dt)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        <div class="team-card">
                            <div class="team-img-wrap" style="background:#f0f7f0; display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-user-circle" style="font-size: 10rem; color: #d0e0d0;"></i>
                            </div>
                            <div class="team-info">
                                <h5>{{ $dt['name'] }}</h5>
                                <span>{{ $dt['role'] }}</span>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
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
                <h2 class="cta-form-heading">We're Here to Help!</h2>

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
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-6">
                            <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="col-6">
                            <input type="text" name="company" class="form-control" placeholder="Company">
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
