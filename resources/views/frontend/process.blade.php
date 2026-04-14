@extends('frontend.layouts.app')

@section('title', 'Our Process - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO ===== */
    .proc-hero {
        position: relative;
        width: 100%;
        height: 340px;
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
        color: #1a2a1a;
        line-height: 1.25;
        margin-bottom: 16px;
    }

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
        align-items: flex-start;
        margin-bottom: 50px;
        position: relative;
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
        top: 20px;
        transform: translateX(-50%);
        width: 52px;
        height: 52px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
        box-shadow: 0 0 0 6px #f9fbf9, 0 0 0 9px rgba(139,195,74,0.25), 0 8px 25px rgba(139,195,74,0.3);
        transition: all 0.3s;
    }
    .tl-item:hover .tl-node {
        transform: translateX(-50%) scale(1.1);
        box-shadow: 0 0 0 6px #f9fbf9, 0 0 0 10px rgba(139,195,74,0.4), 0 10px 30px rgba(139,195,74,0.4);
    }
    .tl-node span {
        color: #fff;
        font-weight: 800;
        font-size: 1.1rem;
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
        color: #1a2a1a;
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
        font-size: 0.88rem;
        color: #666;
        line-height: 1.75;
        margin: 0;
    }

    /* Visual icon panel */
    .tl-icon-panel {
        width: 100%;
        height: 160px;
        background: linear-gradient(135deg, rgba(139,195,74,0.08) 0%, rgba(139,195,74,0.03) 100%);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px dashed rgba(139,195,74,0.25);
        transition: all 0.35s;
    }
    .tl-item:hover .tl-icon-panel {
        background: linear-gradient(135deg, rgba(139,195,74,0.15) 0%, rgba(139,195,74,0.05) 100%);
        border-color: rgba(139,195,74,0.4);
    }
    .tl-icon-panel i {
        font-size: 3.5rem;
        color: var(--primary);
        opacity: 0.6;
        transition: all 0.35s;
    }
    .tl-item:hover .tl-icon-panel i {
        opacity: 1;
        transform: scale(1.15);
    }

    /* =============================================
       WHAT INFLUENCES — MODERN NUMBERED CARDS
       ============================================= */
    .proc-invest-section {
        padding: 90px 0 80px;
        background: #fff;
    }
    .invest-card {
        position: relative;
        background: #fff;
        border-radius: 20px;
        padding: 35px 26px 28px;
        height: 100%;
        border: 1px solid #f0f0f0;
        transition: all 0.35s;
        overflow: hidden;
    }
    .invest-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), rgba(139,195,74,0.3));
        border-radius: 20px 20px 0 0;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .invest-card:hover::before { opacity: 1; }
    .invest-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        border-color: transparent;
    }
    .invest-card-num {
        position: absolute;
        top: 14px;
        right: 18px;
        font-size: 3.5rem;
        font-weight: 900;
        color: rgba(139,195,74,0.08);
        line-height: 1;
        transition: color 0.3s;
    }
    .invest-card:hover .invest-card-num {
        color: rgba(139,195,74,0.15);
    }
    .invest-icon-wrap {
        width: 58px;
        height: 58px;
        background: linear-gradient(135deg, rgba(139,195,74,0.12) 0%, rgba(139,195,74,0.04) 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: all 0.3s;
    }
    .invest-icon-wrap i {
        font-size: 1.4rem;
        color: var(--primary-dark);
        transition: all 0.3s;
    }
    .invest-card:hover .invest-icon-wrap {
        background: var(--primary);
    }
    .invest-card:hover .invest-icon-wrap i {
        color: #fff;
    }
    .invest-card h5 {
        font-weight: 700;
        font-size: 1.02rem;
        color: #1a2a1a;
        margin-bottom: 10px;
    }
    .invest-card .invest-desc {
        font-size: 0.85rem;
        color: #666;
        line-height: 1.7;
        margin-bottom: 14px;
    }
    .invest-impact {
        background: #f8faf6;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 0.8rem;
        color: #777;
        line-height: 1.6;
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
        color: #fff;
        font-size: 2.2rem;
        font-weight: 800;
        line-height: 1.25;
        margin-bottom: 40px;
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
        .proc-hero { height: 280px; }
        .proc-hero-content h1 { font-size: 2.4rem; }
        .proc-title { font-size: 1.6rem; }

        /* Why Choose: stack */
        .proc-why-inner { flex-direction: column; min-height: auto; }
        .proc-why-img-panel { flex: none; height: 300px; }
        .proc-why-img-panel::after { display: none; }
        .proc-why-content { padding: 40px 30px; }
        .proc-why-heading { font-size: 1.7rem; margin-bottom: 30px; }
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
            margin: 0;
            display: none;
        }
    }

    @media (max-width: 768px) {
        .proc-why-img-panel { height: 240px; }
        .proc-why-content { padding: 30px 20px; }
        .proc-why-heading { font-size: 1.5rem; margin-bottom: 24px; }
        .proc-why-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
    }

    @media (max-width: 575px) {
        .proc-hero { height: 230px; }
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
        .proc-hero { height: 200px; }
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
            <h2 class="proc-title">Our Process &mdash; From Vision to Living Landscape</h2>
            <p style="color:#666; font-size:0.95rem; max-width:680px; margin:0 auto;">From your vision to a thriving living landscape &mdash; we design, build, and nurture outdoor spaces that grow in beauty and value over time.</p>
        </div>

        @php
            $steps = [
                ['icon' => 'fas fa-clipboard-check', 'title' => 'Consultation & Site Assessment', 'desc' => 'We begin with a detailed consultation and site evaluation to understand your vision, functional needs, site conditions and aesthetic preferences. Key factors such as soil, sunlight, drainage and water availability are carefully assessed to guide the project effectively.'],
                ['icon' => 'fas fa-drafting-compass', 'title' => 'Research-Based Design Development', 'desc' => 'Based on our assessment, we create a customized landscape design that blends creativity with scientific planning. This includes climate-responsive plant selection, soil improvement strategies, irrigation planning, and functional space design. We provide 2D layouts or 3D visualizations to help you clearly envision the final outcome before execution.'],
                ['icon' => 'fas fa-file-invoice', 'title' => 'Proposal & Technical Planning', 'desc' => 'A detailed proposal is shared outlining scope of work, materials, timelines, cost structure and project approach, ensuring complete clarity before execution begins.'],
                ['icon' => 'fas fa-hard-hat', 'title' => 'Professional Execution', 'desc' => 'Our experienced, multidisciplinary team carries out the project with precision and quality control covering site preparation, hardscape works, irrigation systems, planting and lawn development ensuring every element is executed to the highest standards.'],
                ['icon' => 'fas fa-handshake', 'title' => 'Structured Handover', 'desc' => 'Upon completion, we conduct a guided site walkthrough with you. We provide practical guidance on plant care, irrigation usage, and maintenance practices, ensuring you are fully equipped to manage your landscape effectively.'],
                ['icon' => 'fas fa-seedling', 'title' => 'Establishment Care & Lifecycle Support', 'desc' => 'Our commitment continues beyond project completion. We monitor plant establishment and offer customized maintenance programs to ensure plant health, ecological balance and long-term landscape performance, helping your green space mature beautifully over time.'],
            ];
        @endphp

        <div class="proc-timeline">
            @foreach($steps as $i => $step)
                <div class="tl-item {{ $i % 2 === 0 ? 'tl-left' : 'tl-right' }}" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">

                    {{-- Center node --}}
                    <div class="tl-node"><span>{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span></div>

                    @if($i % 2 === 0)
                        {{-- LEFT: content on left, icon on right --}}
                        <div class="tl-content">
                            <div class="tl-content-card">
                                <h4><i class="{{ $step['icon'] }}"></i> {{ $step['title'] }}</h4>
                                <p>{{ $step['desc'] }}</p>
                            </div>
                        </div>
                        <div class="tl-visual">
                            <div class="tl-icon-panel">
                                <i class="{{ $step['icon'] }}"></i>
                            </div>
                        </div>
                    @else
                        {{-- RIGHT: icon on left, content on right --}}
                        <div class="tl-visual">
                            <div class="tl-icon-panel">
                                <i class="{{ $step['icon'] }}"></i>
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
<section class="proc-why-section">
    <div class="proc-why-bg"></div>
    <div class="proc-why-inner">
        <!-- Left: Image -->
        <div class="proc-why-img-panel" data-aos="fade-right">
            <img loading="lazy" src="{{ asset('storage/About Us/2.5  End-to-End Execution.jpg') }}" alt="SR Greenscapes Professional">
        </div>

        <!-- Right: Content -->
        <div class="proc-why-content" data-aos="fade-left">
            <div class="proc-why-badge">WHY CHOOSE US <i class="fas fa-leaf"></i></div>
            <h2 class="proc-why-heading">Trusted Professionals For<br>Complete <span>Garden Services</span></h2>

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
<section class="proc-invest-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="proc-label">Investment Factors</span>
            <h2 class="proc-title">What Influences Your Landscape Investment</h2>
            <p style="color:#666; font-size:0.95rem; max-width:720px; margin:0 auto;">A Scientific & Thoughtful Approach to Every Project. Our pricing is carefully derived based on site conditions, design complexity, plant selection, and long-term sustainability goals &mdash; ensuring you receive maximum value for your investment.</p>
        </div>

        <div class="row g-4">
            @php
                $factors = [
                    ['icon' => 'fas fa-expand-arrows-alt', 'title' => 'Site Size & Complexity', 'desc' => 'Larger or challenging sites require additional planning, grading, and preparation.', 'impact' => 'A flat plot is easier to develop, while sloped or rocky terrain involves structural work and soil correction.'],
                    ['icon' => 'fas fa-pencil-ruler', 'title' => 'Design Requirements', 'desc' => 'The level of design detail, customization, and spatial planning directly influences the project scope.', 'impact' => 'A simple lawn and planting layout differs significantly from a fully designed landscape with zoning, pathways, seating areas, and thematic elements.'],
                    ['icon' => 'fas fa-pagelines', 'title' => 'Plant Selection, Size & Density', 'desc' => 'Planting involves choosing the right species, size, maturity, and density to balance immediate impact and long-term growth.', 'impact' => 'Dense, mature planting gives an instant lush look but at a higher cost, while younger plants with lighter density are more economical and develop gradually over time.'],
                    ['icon' => 'fas fa-globe-americas', 'title' => 'Soil Preparation & Nutrient Management', 'desc' => 'Healthy soil is the foundation of every successful landscape.', 'impact' => 'Incorporating organic manure, compost and soil conditioners improves soil structure, enhances root development, and ensures long-term plant health and sustainability.'],
                    ['icon' => 'fas fa-gem', 'title' => 'Materials & Features', 'desc' => 'The selection of hardscape materials and additional features defines both aesthetics and functionality.', 'impact' => 'Elements like natural stone paving, decorative lighting, irrigation systems, pergolas, and water features enhance usability while increasing project scope and visual appeal.'],
                    ['icon' => 'fas fa-tools', 'title' => 'Maintenance Scope & Sustainability', 'desc' => 'Long-term maintenance planning is a crucial part of landscape investment.', 'impact' => 'Landscapes designed with efficient irrigation, proper plant spacing, and climate-suitable plants reduce maintenance effort, water usage and long-term costs.'],
                ];
            @endphp

            @foreach($factors as $i => $factor)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="invest-card">
                        <div class="invest-card-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="invest-icon-wrap">
                            <i class="{{ $factor['icon'] }}"></i>
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
