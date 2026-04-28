@extends('frontend.layouts.app')

@section('title', 'Our Process - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO ===== */
    .proc-hero {
        position: relative;
        width: 100%;
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .proc-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover no-repeat;
    }
    .proc-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(15,30,15,0.85) 0%, rgba(26,42,26,0.75) 100%);
    }
    .proc-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .proc-hero-content h1 {
        color: #fff;
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }
    .proc-hero-content p {
        color: rgba(255,255,255,0.8);
        font-size: 1.05rem;
        max-width: 550px;
        margin: 0 auto;
    }

    /* ===== SHARED ===== */
    .proc-label {
        font-size: 13px;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 14px;
        display: inline-block;
    }
    .proc-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a2d1a;
        line-height: 1.25;
        margin-bottom: 16px;
    }
    .proc-title span { color: var(--primary); }

    /* =============================================
       OUR PROCESS — MODERN VERTICAL TIMELINE
       ============================================= */
    .proc-timeline-section {
        padding: 90px 0 70px;
        background: #f9fbf9;
        position: relative;
    }

    /* Timeline container */
    .proc-timeline {
        position: relative;
        max-width: 960px;
        margin: 0 auto;
        padding: 20px 0;
    }

    /* Center vertical line */
    .proc-timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, var(--primary), rgba(139,195,74,0.2));
        transform: translateX(-50%);
        border-radius: 3px;
    }

    /* Each timeline item */
    .tl-item {
        display: flex;
        align-items: center;
        margin-bottom: 60px;
        position: relative;
        min-height: 290px;
    }
    .tl-item:last-child { margin-bottom: 0; }

    /* Left items: content left, visual right */
    .tl-item.tl-left .tl-content {
        width: 44%;
        text-align: right;
        padding-right: 50px;
    }
    .tl-item.tl-left .tl-visual {
        width: 44%;
        margin-left: auto;
        padding-left: 50px;
    }

    /* Right items: visual left, content right */
    .tl-item.tl-right .tl-visual {
        width: 44%;
        padding-right: 50px;
    }
    .tl-item.tl-right .tl-content {
        width: 44%;
        margin-left: auto;
        text-align: left;
        padding-left: 50px;
    }

    /* Center node / number circle */
    .tl-node {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 62px;
        height: 62px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
        box-shadow: 0 0 0 7px #f9fbf9, 0 0 0 10px rgba(139,195,74,0.3), 0 10px 28px rgba(139,195,74,0.35);
        transition: all 0.3s;
    }
    .tl-item:hover .tl-node {
        transform: translate(-50%, -50%) scale(1.12);
        box-shadow: 0 0 0 7px #f9fbf9, 0 0 0 11px rgba(139,195,74,0.45), 0 12px 32px rgba(139,195,74,0.45);
    }
    .tl-node span {
        color: #fff;
        font-weight: 800;
        font-size: 1.2rem;
        letter-spacing: 0.5px;
    }

    /* Content card */
    .tl-content-card {
        background: #fff;
        border-radius: 18px;
        padding: 28px 26px;
        box-shadow: 0 6px 25px rgba(0,0,0,0.05);
        border: 1px solid #eee;
        transition: all 0.35s;
        position: relative;
    }
    .tl-item:hover .tl-content-card {
        transform: translateY(-4px);
        box-shadow: 0 14px 40px rgba(0,0,0,0.09);
        border-color: rgba(139,195,74,0.3);
    }
    .tl-content-card h4 {
        font-weight: 800;
        font-size: 1.1rem;
        color: var(--primary-dark);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .tl-item.tl-left .tl-content-card h4 {
        justify-content: flex-end;
    }
    .tl-content-card h4 i {
        font-size: 0.9rem;
        color: var(--primary);
    }
    .tl-content-card p {
        font-size: 0.93rem;
        color: #666;
        line-height: 1.8;
        margin: 0;
        text-align: justify;
    }

    /* Visual circle image */
    .tl-visual {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .tl-img-circle {
        width: 280px;
        height: 280px;
        border-radius: 50%;
        overflow: hidden;
        border: 6px solid rgba(139,195,74,0.3);
        box-shadow: 0 12px 40px rgba(0,0,0,0.14);
        transition: all 0.4s;
        position: relative;
        flex-shrink: 0;
    }
    .tl-img-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .tl-item:hover .tl-img-circle {
        border-color: var(--primary);
        box-shadow: 0 16px 50px rgba(139,195,74,0.35);
        transform: scale(1.04);
    }
    .tl-item:hover .tl-img-circle img {
        transform: scale(1.1);
    }
    /* Outer ring decoration */
    .tl-img-circle::after {
        content: '';
        position: absolute;
        inset: -8px;
        border-radius: 50%;
        border: 2px dashed rgba(139,195,74,0.2);
        transition: border-color 0.4s;
        pointer-events: none;
    }
    .tl-item:hover .tl-img-circle::after {
        border-color: rgba(139,195,74,0.5);
    }

    /* =============================================
       WHAT INFLUENCES — MODERN NUMBERED CARDS
       ============================================= */
    .proc-invest-section {
        padding: 70px 0;
        background: linear-gradient(180deg, #f4fbf0 0%, #ffffff 100%);
    }
    .invest-card {
        position: relative;
        background: #fff;
        border-radius: 22px;
        padding: 32px 26px 26px;
        height: 100%;
        border: 1px solid rgba(139,195,74,0.12);
        transition: all 0.38s cubic-bezier(0.165,0.84,0.44,1);
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .invest-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), #c5e1a5);
        border-radius: 22px 22px 0 0;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }
    .invest-card:hover::before { transform: scaleX(1); }
    .invest-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 24px 55px rgba(139,195,74,0.14);
        border-color: rgba(139,195,74,0.25);
    }
    .invest-card-num {
        position: absolute;
        top: 12px; right: 16px;
        font-size: 4rem;
        font-weight: 900;
        color: rgba(139,195,74,0.07);
        line-height: 1;
        transition: color 0.3s;
        font-family: 'Poppins', sans-serif;
    }
    .invest-card:hover .invest-card-num {
        color: rgba(139,195,74,0.14);
    }
    .invest-icon-wrap {
        width: 72px;
        height: 72px;
        background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e9 100%);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: all 0.4s cubic-bezier(0.175,0.885,0.32,1.275);
        border: 2px solid rgba(139,195,74,0.18);
        box-shadow: 0 4px 16px rgba(139,195,74,0.1);
        padding: 10px;
    }
    .invest-icon-wrap svg {
        width: 100%;
        height: 100%;
        transition: transform 0.4s;
    }
    .invest-card:hover .invest-icon-wrap {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        border-color: rgba(139,195,74,0.4);
        box-shadow: 0 10px 28px rgba(139,195,74,0.25);
        transform: translateY(-4px) scale(1.08);
        border-radius: 50%;
    }
    .invest-card:hover .invest-icon-wrap svg {
        transform: scale(1.05);
    }
    .invest-card h5 {
        font-weight: 700;
        font-size: 1.05rem;
        color: #1a2a1a;
        margin-bottom: 10px;
        line-height: 1.35;
    }
    .invest-card .invest-desc {
        font-size: 0.87rem;
        color: #666;
        line-height: 1.75;
        margin-bottom: 16px;
        text-align: justify;
    }
    .invest-impact {
        background: linear-gradient(135deg, #f1f8e9 0%, #f8fdf4 100%);
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 0.81rem;
        color: #5a6a5a;
        line-height: 1.65;
        border-left: 3px solid var(--primary);
    }
    .invest-impact strong {
        color: var(--primary-dark);
        font-weight: 700;
    }

    /* =============================================
       WHY CHOOSE US — DARK GREEN BANNER STYLE
       ============================================= */
    .proc-why-section {
        position: relative;
        overflow: hidden;
        background: #14291a;
    }
    .proc-why-bg {
        position: absolute;
        inset: 0;
        background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover no-repeat;
        opacity: 0.15;
    }
    .proc-why-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: stretch;
        min-height: 480px;
    }
    /* Left: Image panel */
    .proc-why-img-panel {
        flex: 0 0 38%;
        position: relative;
        overflow: hidden;
    }
    .proc-why-img-panel img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .proc-why-img-panel::after {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 80px; height: 100%;
        background: linear-gradient(to left, #14291a, transparent);
    }
    /* Right: Content panel */
    .proc-why-content {
        flex: 1;
        padding: 60px 50px 60px 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .proc-why-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: rgba(255,255,255,0.6);
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 16px;
    }
    .proc-why-badge i {
        font-size: 1rem;
    }
    .proc-why-heading {
        color: #fff !important;
        font-size: 1.55rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 40px;
        white-space: nowrap;
    }
    .proc-why-heading span {
        color: var(--primary);
    }
    /* Icon grid — 3 columns */
    .proc-why-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px 35px;
    }
    .proc-why-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        transition: transform 0.3s;
    }
    .proc-why-item:hover {
        transform: translateY(-3px);
    }
    .proc-why-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border: 1.5px solid rgba(255,255,255,0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    .proc-why-icon i {
        font-size: 1.1rem;
        color: rgba(255,255,255,0.7);
        transition: all 0.3s;
    }
    .proc-why-item:hover .proc-why-icon {
        border-color: var(--primary);
        background: rgba(139,195,74,0.1);
    }
    .proc-why-item:hover .proc-why-icon i {
        color: var(--primary);
    }
    .proc-why-text {
        color: #fff;
        font-weight: 600;
        font-size: 0.9rem;
        line-height: 1.4;
        padding-top: 2px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .proc-hero { height: 260px; }
        .proc-hero-content h1 { font-size: 2.4rem; }
        .proc-title { font-size: 1.6rem; }

        /* Why Choose: stack */
        .proc-why-inner { flex-direction: column; min-height: auto; }
        .proc-why-img-panel { flex: none; height: 300px; }
        .proc-why-img-panel::after { display: none; }
        .proc-why-content { padding: 40px 30px; }
        .proc-why-heading { font-size: 1.25rem; margin-bottom: 30px; white-space: normal; }
        .proc-why-grid { grid-template-columns: repeat(3, 1fr); gap: 24px; }

        /* Timeline: stack vertically, line on left */
        .proc-timeline::before { left: 26px; }
        .tl-node { left: 26px; width: 44px; height: 44px; top: 0; }
        .tl-node span { font-size: 0.95rem; }
        .tl-item { flex-direction: column !important; padding-left: 70px; }
        .tl-item.tl-left .tl-content,
        .tl-item.tl-right .tl-content {
            width: 100%;
            text-align: left;
            padding: 0;
        }
        .tl-item.tl-left .tl-content-card h4,
        .tl-item.tl-right .tl-content-card h4 {
            justify-content: flex-start;
        }
        .tl-item.tl-left .tl-visual,
        .tl-item.tl-right .tl-visual {
            width: 100%;
            padding: 0;
            margin: 16px 0 0;
            justify-content: flex-start;
        }
        .tl-img-circle { width: 180px; height: 180px; }
        .tl-node { width: 52px; height: 52px; }
        .tl-node span { font-size: 1rem; }
    }

    @media (max-width: 768px) {
        .proc-why-img-panel { height: 240px; }
        .proc-why-content { padding: 30px 20px; }
        .proc-why-heading { font-size: 1.1rem; margin-bottom: 24px; white-space: normal; }
        .proc-why-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
    }

    @media (max-width: 575px) {
        .proc-hero { height: 220px; }
        .proc-hero-content h1 { font-size: 1.7rem; }
        .proc-hero-content p { font-size: 0.88rem; }
        .proc-title { font-size: 1.35rem; }
        .proc-timeline-section { padding: 60px 0 50px; }
        .tl-item { margin-bottom: 35px; padding-left: 60px; }
        .proc-timeline::before { left: 20px; }
        .tl-node { left: 20px; width: 38px; height: 38px; }
        .tl-node span { font-size: 0.85rem; }
        .tl-content-card { padding: 20px 18px; border-radius: 14px; }
        .tl-content-card h4 { font-size: 0.98rem; }
        .tl-content-card p { font-size: 0.82rem; }
        .proc-invest-section { padding: 60px 0; }
        .invest-card { padding: 28px 20px 22px; }
        .proc-why-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .proc-why-icon { width: 40px; height: 40px; min-width: 40px; }
        .proc-why-text { font-size: 0.82rem; }
    }

    @media (max-width: 480px) {
        .proc-hero { height: 180px; }
        .proc-hero-content h1 { font-size: 1.4rem; }
        .proc-hero-content p { font-size: 0.82rem; }
        .proc-why-grid { grid-template-columns: 1fr; }
        .tl-item { padding-left: 50px; }
        .tl-content-card { padding: 16px 14px; }
        .invest-card { padding: 20px 15px; }
        .invest-card-num { font-size: 3rem; }
    }
</style>
@endsection

@section('content')

<!-- Hero Banner -->
<div class="proc-hero">
    <div class="proc-hero-content" data-aos="fade-up">
        <h1>Our Process</h1>
        <p>What Influences Your Landscape Investment</p>
        <nav aria-label="breadcrumb" style="margin-top:18px;">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="/" style="color:var(--primary);text-decoration:none;">Home</a></li>
                <li class="breadcrumb-item active" style="color:rgba(255,255,255,0.6);">Process</li>
            </ol>
        </nav>
    </div>
</div>

<!-- ============================================
     OUR PROCESS — VERTICAL TIMELINE
     ============================================ -->
<section class="proc-timeline-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="proc-label">How We Work</span>
            <h2 class="proc-title">Our Process &mdash; From Vision to <span>Living Landscape</span></h2>
            <p style="color:#666; font-size:0.95rem; max-width:680px; margin:0 auto;">From your vision to a thriving living landscape &mdash; we design, build, and nurture outdoor spaces that grow in beauty and value over time.</p>
        </div>

        @php
            $steps = [
                ['icon' => 'fas fa-clipboard-check', 'img' => 'Construction/4.1 Consultation  Site Assessment.jpg', 'title' => 'Consultation & Site Assessment', 'desc' => 'We begin with a detailed consultation and site evaluation to understand your vision, functional needs, site conditions and aesthetic preferences. Key factors such as soil, sunlight, drainage and water availability are carefully assessed to guide the project effectively.'],
                ['icon' => 'fas fa-drafting-compass', 'img' => 'Construction/4.2 Research-Based Design Development.png', 'title' => 'Research-Based Design Development', 'desc' => 'Based on our assessment, we create a customized landscape design that blends creativity with scientific planning. This includes climate-responsive plant selection, soil improvement strategies, irrigation planning, and functional space design. We provide 2D layouts or 3D visualizations to help you clearly envision the final outcome before execution.'],
                ['icon' => 'fas fa-file-invoice', 'img' => 'Construction/4.3 Proposal  Technical Planning.jpg', 'title' => 'Proposal & Technical Planning', 'desc' => 'A detailed proposal is shared outlining scope of work, materials, timelines, cost structure and project approach, ensuring complete clarity before execution begins.'],
                ['icon' => 'fas fa-hard-hat', 'img' => 'Construction/4.4  Professional Execution.png', 'title' => 'Professional Execution', 'desc' => 'Our experienced, multidisciplinary team carries out the project with precision and quality control covering site preparation, hardscape works, irrigation systems, planting and lawn development ensuring every element is executed to the highest standards.'],
                ['icon' => 'fas fa-handshake', 'img' => 'Construction/4.5 Structured Handover.png', 'title' => 'Structured Handover', 'desc' => 'Upon completion, we conduct a guided site walkthrough with you. We provide practical guidance on plant care, irrigation usage, and maintenance practices, ensuring you are fully equipped to manage your landscape effectively.'],
                ['icon' => 'fas fa-seedling', 'img' => 'Construction/4.6  Establishment Care  Lifecycle Support.jpg', 'title' => 'Establishment Care & Lifecycle Support', 'desc' => 'Our commitment continues beyond project completion. We monitor plant establishment and offer customized maintenance programs to ensure plant health, ecological balance and long-term landscape performance, helping your green space mature beautifully over time.'],
            ];
        @endphp

        <div class="proc-timeline">
            @foreach($steps as $i => $step)
                <div class="tl-item {{ $i % 2 === 0 ? 'tl-left' : 'tl-right' }}" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">

                    {{-- Center node --}}
                    <div class="tl-node"><span>{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span></div>

                    @if($i % 2 === 0)
                        {{-- LEFT: content on left, circle image on right --}}
                        <div class="tl-content">
                            <div class="tl-content-card">
                                <h4><i class="{{ $step['icon'] }}"></i> {{ $step['title'] }}</h4>
                                <p>{{ $step['desc'] }}</p>
                            </div>
                        </div>
                        <div class="tl-visual">
                            <div class="tl-img-circle">
                                <img src="{{ asset('storage/' . $step['img']) }}" alt="{{ $step['title'] }}" loading="lazy">
                            </div>
                        </div>
                    @else
                        {{-- RIGHT: circle image on left, content on right --}}
                        <div class="tl-visual">
                            <div class="tl-img-circle">
                                <img src="{{ asset('storage/' . $step['img']) }}" alt="{{ $step['title'] }}" loading="lazy">
                            </div>
                        </div>
                        <div class="tl-content">
                            <div class="tl-content-card">
                                <h4><i class="{{ $step['icon'] }}"></i> {{ $step['title'] }}</h4>
                                <p>{{ $step['desc'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why Clients Choose SR Greenscapes -->
<section class="proc-why-section" id="why-choose-us">
    <div class="proc-why-bg"></div>
    <div class="proc-why-inner">
        <!-- Left: Image -->
        <div class="proc-why-img-panel" data-aos="fade-right">
            <img loading="lazy" src="{{ asset('storage/About Us/2.5  End-to-End Execution.jpg') }}" alt="SR Greenscapes Professional">
        </div>

        <!-- Right: Content -->
        <div class="proc-why-content" data-aos="fade-left">
            <div class="proc-why-badge">WHY CHOOSE US <i class="fas fa-leaf"></i></div>
            <h2 class="proc-why-heading">Trusted Professionals For Complete <span>Garden Services</span></h2>

            <div class="proc-why-grid">
                @php
                    $whyItems = [
                        ['icon' => 'fas fa-microscope', 'text' => 'Scientifically Driven Planning'],
                        ['icon' => 'fas fa-seedling', 'text' => 'Trusted Garden Services'],
                        ['icon' => 'fas fa-cut', 'text' => 'Precision Garden Execution'],
                        ['icon' => 'fas fa-truck', 'text' => 'On-Time Service Delivery'],
                        ['icon' => 'fas fa-check-double', 'text' => 'Quality Service Assurance'],
                        ['icon' => 'fas fa-map-marked-alt', 'text' => 'On-Site Service Mobility'],
                    ];
                @endphp
                @foreach($whyItems as $i => $item)
                    <div class="proc-why-item" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                        <div class="proc-why-icon">
                            <i class="{{ $item['icon'] }}"></i>
                        </div>
                        <div class="proc-why-text">{{ $item['text'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     WHAT INFLUENCES YOUR LANDSCAPE INVESTMENT
     ============================================ -->
<section class="proc-invest-section" id="investment-factors">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="proc-label">Investment Factors</span>
            <h2 class="proc-title">What Influences Your <span>Landscape Investment</span></h2>
            <p style="color:#666; font-size:0.95rem; max-width:720px; margin:0 auto;">A Scientific & Thoughtful Approach to Every Project. Our pricing is carefully derived based on site conditions, design complexity, plant selection, and long-term sustainability goals &mdash; ensuring you receive maximum value for your investment.</p>
        </div>

        <div class="row g-4">
            @php
                $factors = [
                    [
                        'title' => 'Site Size & Complexity',
                        'desc'  => 'Larger or challenging sites require additional planning, grading, and preparation.',
                        'impact'=> 'A flat plot is easier to develop, while sloped or rocky terrain involves structural work and soil correction.',
                        'svg'   => '<svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <rect x="8" y="10" width="34" height="28" rx="3" fill="#e8f5e9" stroke="#689F38" stroke-width="2.2"/>
                          <path d="M8 27 L18 20 L28 25 L38 16 L42 16" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M8 10 L14 10 M8 10 L8 16" stroke="#2E7D32" stroke-width="2.2" stroke-linecap="round"/>
                          <path d="M42 10 L36 10 M42 10 L42 16" stroke="#2E7D32" stroke-width="2.2" stroke-linecap="round"/>
                          <path d="M8 38 L14 38 M8 38 L8 32" stroke="#2E7D32" stroke-width="2.2" stroke-linecap="round"/>
                          <path d="M42 38 L36 38 M42 38 L42 32" stroke="#2E7D32" stroke-width="2.2" stroke-linecap="round"/>
                          <rect x="14" y="43" width="22" height="5" rx="2.5" fill="#8BC34A"/>
                          <line x1="14" y1="45.5" x2="18" y2="45.5" stroke="#fff" stroke-width="1.2"/>
                          <line x1="22" y1="45.5" x2="26" y2="45.5" stroke="#fff" stroke-width="1.2"/>
                          <line x1="30" y1="45.5" x2="34" y2="45.5" stroke="#fff" stroke-width="1.2"/>
                        </svg>',
                    ],
                    [
                        'title' => 'Design Requirements',
                        'desc'  => 'The level of design detail, customization, and spatial planning directly influences the project scope.',
                        'impact'=> 'A simple lawn and planting layout differs significantly from a fully designed landscape with zoning, pathways, seating areas, and thematic elements.',
                        'svg'   => '<svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <rect x="7" y="5" width="30" height="38" rx="3" fill="#e8f5e9" stroke="#689F38" stroke-width="2"/>
                          <line x1="7" y1="15" x2="37" y2="15" stroke="#a5d6a7" stroke-width="1.2"/>
                          <line x1="7" y1="23" x2="37" y2="23" stroke="#a5d6a7" stroke-width="1.2"/>
                          <line x1="7" y1="31" x2="37" y2="31" stroke="#a5d6a7" stroke-width="1.2"/>
                          <line x1="17" y1="5" x2="17" y2="43" stroke="#a5d6a7" stroke-width="1.2"/>
                          <line x1="27" y1="5" x2="27" y2="43" stroke="#a5d6a7" stroke-width="1.2"/>
                          <path d="M11 35 L11 22 L22 15 L33 22 L33 35 Z" fill="#c8e6c9" stroke="#4CAF50" stroke-width="1.8" stroke-linejoin="round"/>
                          <rect x="18" y="27" width="8" height="8" rx="1" fill="#fff" stroke="#689F38" stroke-width="1.5"/>
                          <rect x="37" y="28" width="5" height="22" rx="2" transform="rotate(-38 37 28)" fill="#FFC107" stroke="#F57F17" stroke-width="1.2"/>
                          <path d="M44 44 L47 50 L41 48 Z" fill="#FF9800"/>
                        </svg>',
                    ],
                    [
                        'title' => 'Plant Selection, Size & Density',
                        'desc'  => 'Planting involves choosing the right species, size, maturity, and density to balance immediate impact and long-term growth.',
                        'impact'=> 'Dense, mature planting gives an instant lush look but at a higher cost, while younger plants with lighter density are more economical and develop gradually over time.',
                        'svg'   => '<svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <rect x="4" y="42" width="48" height="5" rx="2.5" fill="#8d6e63"/>
                          <line x1="12" y1="42" x2="12" y2="50" stroke="#6d4c41" stroke-width="1.5"/>
                          <line x1="28" y1="42" x2="28" y2="50" stroke="#6d4c41" stroke-width="1.5"/>
                          <line x1="44" y1="42" x2="44" y2="50" stroke="#6d4c41" stroke-width="1.5"/>
                          <!-- Small plant -->
                          <line x1="12" y1="34" x2="12" y2="42" stroke="#4CAF50" stroke-width="2" stroke-linecap="round"/>
                          <ellipse cx="12" cy="30" rx="6" ry="5" fill="#81C784" stroke="#388E3C" stroke-width="1.5"/>
                          <ellipse cx="8" cy="34" rx="5" ry="3.5" fill="#A5D6A7" stroke="#388E3C" stroke-width="1.2" transform="rotate(-30 8 34)"/>
                          <!-- Medium plant -->
                          <line x1="28" y1="28" x2="28" y2="42" stroke="#4CAF50" stroke-width="2.2" stroke-linecap="round"/>
                          <ellipse cx="28" cy="22" rx="8" ry="7" fill="#4CAF50" stroke="#2E7D32" stroke-width="1.8"/>
                          <ellipse cx="22" cy="28" rx="6" ry="4" fill="#81C784" stroke="#388E3C" stroke-width="1.3" transform="rotate(-20 22 28)"/>
                          <!-- Large/tall plant -->
                          <line x1="44" y1="18" x2="44" y2="42" stroke="#2E7D32" stroke-width="2.5" stroke-linecap="round"/>
                          <ellipse cx="44" cy="11" rx="10" ry="9" fill="#2E7D32" stroke="#1B5E20" stroke-width="2"/>
                          <ellipse cx="36" cy="20" rx="7" ry="5" fill="#4CAF50" stroke="#2E7D32" stroke-width="1.5" transform="rotate(-25 36 20)"/>
                          <ellipse cx="51" cy="18" rx="6" ry="4" fill="#388E3C" stroke="#2E7D32" stroke-width="1.3" transform="rotate(20 51 18)"/>
                        </svg>',
                    ],
                    [
                        'title' => 'Soil Preparation & Nutrient Management',
                        'desc'  => 'Healthy soil is the foundation of every successful landscape.',
                        'impact'=> 'Incorporating organic manure, compost and soil conditioners improves soil structure, enhances root development, and ensures long-term plant health and sustainability.',
                        'svg'   => '<svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <!-- Soil layers -->
                          <rect x="6" y="8" width="44" height="8" rx="3" fill="#a5d6a7" stroke="#4CAF50" stroke-width="1.5"/>
                          <text x="28" y="15" font-size="5" fill="#2E7D32" text-anchor="middle" font-family="sans-serif" font-weight="bold">TOPSOIL</text>
                          <rect x="6" y="17" width="44" height="8" rx="1" fill="#8d6e63" stroke="#6d4c41" stroke-width="1.5"/>
                          <text x="28" y="24" font-size="5" fill="#fff" text-anchor="middle" font-family="sans-serif" font-weight="bold">SUBSOIL</text>
                          <rect x="6" y="26" width="44" height="8" rx="1" fill="#bcaaa4" stroke="#795548" stroke-width="1.5"/>
                          <text x="28" y="33" font-size="5" fill="#4e342e" text-anchor="middle" font-family="sans-serif" font-weight="bold">BEDROCK</text>
                          <!-- Roots -->
                          <path d="M22 8 L22 20 L18 28 L18 34" stroke="#2E7D32" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M28 8 L28 24 L32 32 L32 34" stroke="#388E3C" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M34 8 L34 18 L38 24 L40 30" stroke="#4CAF50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <!-- Water droplets -->
                          <ellipse cx="14" cy="38" rx="3.5" ry="4.5" fill="#64B5F6" opacity="0.8"/>
                          <ellipse cx="24" cy="40" rx="3" ry="4" fill="#64B5F6" opacity="0.7"/>
                          <ellipse cx="38" cy="39" rx="3" ry="4" fill="#64B5F6" opacity="0.75"/>
                          <!-- Nutrient dots -->
                          <circle cx="14" cy="44" r="2.5" fill="#FFB300"/>
                          <circle cx="24" cy="46" r="2" fill="#FF8F00"/>
                          <circle cx="38" cy="45" r="2.5" fill="#FFB300"/>
                        </svg>',
                    ],
                    [
                        'title' => 'Materials & Features',
                        'desc'  => 'The selection of hardscape materials and additional features defines both aesthetics and functionality.',
                        'impact'=> 'Elements like natural stone paving, decorative lighting, irrigation systems, pergolas, and water features enhance usability while increasing project scope and visual appeal.',
                        'svg'   => '<svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <!-- Paving tiles 3x3 grid -->
                          <rect x="5" y="26" width="13" height="9" rx="1.5" fill="#e0e0e0" stroke="#9e9e9e" stroke-width="1.5"/>
                          <rect x="20" y="26" width="13" height="9" rx="1.5" fill="#d7ccc8" stroke="#9e9e9e" stroke-width="1.5"/>
                          <rect x="35" y="26" width="13" height="9" rx="1.5" fill="#bcaaa4" stroke="#8d6e63" stroke-width="1.5"/>
                          <rect x="5" y="37" width="13" height="9" rx="1.5" fill="#d7ccc8" stroke="#9e9e9e" stroke-width="1.5"/>
                          <rect x="20" y="37" width="13" height="9" rx="1.5" fill="#bcaaa4" stroke="#8d6e63" stroke-width="1.5"/>
                          <rect x="35" y="37" width="13" height="9" rx="1.5" fill="#e0e0e0" stroke="#9e9e9e" stroke-width="1.5"/>
                          <!-- Lamp post -->
                          <line x1="28" y1="6" x2="28" y2="26" stroke="#757575" stroke-width="2.5" stroke-linecap="round"/>
                          <path d="M22 6 Q28 2 34 6" stroke="#757575" stroke-width="2" fill="none" stroke-linecap="round"/>
                          <!-- Light glow -->
                          <circle cx="28" cy="6" r="5" fill="#FFF9C4" stroke="#FDD835" stroke-width="1.5"/>
                          <circle cx="28" cy="6" r="3" fill="#FFEE58"/>
                          <!-- Sparkle lines -->
                          <line x1="28" y1="-1" x2="28" y2="1" stroke="#FDD835" stroke-width="1.5" stroke-linecap="round"/>
                          <line x1="34" y1="0" x2="33" y2="2" stroke="#FDD835" stroke-width="1.5" stroke-linecap="round"/>
                          <line x1="22" y1="0" x2="23" y2="2" stroke="#FDD835" stroke-width="1.5" stroke-linecap="round"/>
                          <!-- Water feature -->
                          <ellipse cx="46" cy="18" rx="6" ry="4" fill="#B3E5FC" stroke="#29B6F6" stroke-width="1.5"/>
                          <path d="M43 15 Q46 11 49 15" stroke="#0288D1" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        </svg>',
                    ],
                    [
                        'title' => 'Maintenance Scope & Sustainability',
                        'desc'  => 'Long-term maintenance planning is a crucial part of landscape investment.',
                        'impact'=> 'Landscapes designed with efficient irrigation, proper plant spacing, and climate-suitable plants reduce maintenance effort, water usage and long-term costs.',
                        'svg'   => '<svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <!-- Circular eco arrows -->
                          <path d="M28 8 A20 20 0 0 1 48 28" stroke="#4CAF50" stroke-width="3" stroke-linecap="round" fill="none"/>
                          <path d="M48 28 A20 20 0 0 1 28 48" stroke="#8BC34A" stroke-width="3" stroke-linecap="round" fill="none"/>
                          <path d="M28 48 A20 20 0 0 1 8 28" stroke="#4CAF50" stroke-width="3" stroke-linecap="round" fill="none"/>
                          <path d="M8 28 A20 20 0 0 1 28 8" stroke="#8BC34A" stroke-width="3" stroke-linecap="round" fill="none"/>
                          <!-- Arrow heads -->
                          <path d="M46 22 L48 28 L42 26" fill="#4CAF50"/>
                          <path d="M10 34 L8 28 L14 30" fill="#4CAF50"/>
                          <!-- Central leaf -->
                          <path d="M28 18 C28 18 38 22 36 32 C34 38 28 40 28 40 C28 40 22 38 20 32 C18 22 28 18 28 18 Z" fill="#4CAF50" stroke="#2E7D32" stroke-width="1.5"/>
                          <line x1="28" y1="40" x2="28" y2="44" stroke="#2E7D32" stroke-width="1.8" stroke-linecap="round"/>
                          <path d="M28 32 C28 32 22 28 24 24" stroke="#fff" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                          <!-- Water drops -->
                          <ellipse cx="14" cy="12" rx="2.5" ry="3.5" fill="#64B5F6" opacity="0.8"/>
                          <ellipse cx="42" cy="44" rx="2.5" ry="3.5" fill="#64B5F6" opacity="0.8"/>
                        </svg>',
                    ],
                ];
            @endphp

            @foreach($factors as $i => $factor)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="invest-card">
                        <div class="invest-card-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="invest-icon-wrap">
                            {!! $factor['svg'] !!}
                        </div>
                        <h5>{{ $factor['title'] }}</h5>
                        <p class="invest-desc">{{ $factor['desc'] }}</p>
                        <div class="invest-impact">
                            <strong>Impact:</strong> {{ $factor['impact'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@section('cta')
<section class="proc-cta-wrapper">
    <div class="container">
        <div class="proc-cta-section">
            <div class="proc-cta-overlay"></div>
            <div class="proc-cta-inner">
                <div class="proc-cta-left">
                    <h2 class="proc-cta-company">SR GREENSCAPES PVT LTD</h2>
                    <p class="proc-cta-tagline"><i class="fas fa-leaf"></i> Sowing Science, Growing Beauty</p>
                    <p class="proc-cta-desc">
                        Our structured 6-step process ensures every project is executed with precision, transparency, and care. Start your landscape journey today.
                    </p>
                </div>
                <div class="proc-cta-card">
                    <h4 class="proc-cta-card-title">Book Consultation</h4>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="process-cta">
                        <div class="proc-cta-row">
                            <input type="text" name="name" class="proc-cta-input" placeholder="Name *" required>
                            <input type="text" name="phone" class="proc-cta-input" placeholder="Phone *" required>
                        </div>
                        <select name="message" class="proc-cta-input" style="margin-bottom:10px;">
                            <option value="">Select Service *</option>
                            <option>Landscape Design & Execution</option>
                            <option>Specialized Garden Services</option>
                            <option>Nursery & Plant Supply</option>
                            <option>Landscape Maintenance</option>
                            <option>Horticulture Consultancy</option>
                            <option>Others</option>
                        </select>
                        <textarea name="details" class="proc-cta-input proc-cta-textarea" placeholder="Message"></textarea>
                        <button type="submit" class="proc-cta-submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .proc-cta-wrapper { padding: 60px 0 80px; background: #f9fbf7; }
    .proc-cta-section {
        position: relative;
        background: url('{{ asset('storage/banners/UzLsmhyoocKjP5FDbGYxHVVSVkxrJaVqcw3hrUIB.jpg') }}') center/cover no-repeat;
        padding: 60px 50px; overflow: hidden; border-radius: 30px;
        box-shadow: 0 20px 60px rgba(26,58,26,0.25);
    }
    .proc-cta-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to right, rgba(15,30,15,0.85) 0%, rgba(15,30,15,0.55) 55%, rgba(15,30,15,0.3) 100%);
        border-radius: 30px;
    }
    .proc-cta-inner { position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; gap: 40px; }
    .proc-cta-left { flex: 1; max-width: 460px; }
    .proc-cta-company { color: #fff; font-size: 1.8rem; font-weight: 900; letter-spacing: 1px; margin-bottom: 12px; }
    .proc-cta-tagline { color: var(--primary); font-size: 1rem; font-weight: 500; font-style: italic; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
    .proc-cta-desc { color: rgba(255,255,255,0.6); font-size: 0.95rem; line-height: 1.75; }
    .proc-cta-card { width: 420px; flex-shrink: 0; background: rgba(255,255,255,0.97); border-radius: 12px; padding: 30px 25px; box-shadow: 0 15px 40px rgba(0,0,0,0.2); }
    .proc-cta-card-title { font-weight: 800; color: #1a3a1a; margin-bottom: 20px; font-size: 1.3rem; }
    .proc-cta-row { display: flex; gap: 10px; margin-bottom: 10px; }
    .proc-cta-input { flex: 1; border: 1px solid #e0e0e0; border-radius: 8px; padding: 11px 14px; font-size: 13px; background: #fafafa; width: 100%; transition: border-color 0.2s; color: #333; }
    .proc-cta-input::placeholder { color: #999; }
    .proc-cta-input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(76,175,80,0.1); }
    .proc-cta-textarea { display: block; width: 100%; height: 80px; resize: vertical; margin-bottom: 12px; }
    .proc-cta-submit { display: block; width: 100%; background: var(--primary); color: #fff; border: none; border-radius: 8px; padding: 13px; font-weight: 800; font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; transition: all 0.3s; }
    .proc-cta-submit:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(139,195,74,0.3); }
    @media (max-width: 991px) {
        .proc-cta-wrapper { padding: 40px 0 60px; }
        .proc-cta-section { padding: 40px 24px; border-radius: 24px; }
        .proc-cta-overlay { border-radius: 24px; }
        .proc-cta-inner { flex-direction: column; }
        .proc-cta-card { width: 100%; }
        .proc-cta-company { font-size: 1.4rem; }
    }
    @media (max-width: 575px) {
        .proc-cta-wrapper { padding: 25px 0 40px; }
        .proc-cta-section { padding: 25px 16px; border-radius: 18px; }
        .proc-cta-overlay { border-radius: 18px; }
        .proc-cta-company { font-size: 1.1rem; }
        .proc-cta-card { padding: 20px 16px; }
        .proc-cta-card-title { font-size: 1.1rem; }
        .proc-cta-row { flex-direction: column; gap: 8px; }
    }
</style>
@endsection
