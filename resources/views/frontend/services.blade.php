@extends('frontend.layouts.app')

@section('styles')
<style>
    .page-hero {
        background: linear-gradient(rgba(26, 42, 26, 0.7), rgba(26, 42, 26, 0.7)), url('{{ asset('storage/Home/1.2 Cover photo 2.jpg') }}');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
        text-align: center;
    }
    .page-hero h1 {
        color: #fff;
        font-size: 2.4rem;
        font-weight: 800;
    }
    .page-hero .breadcrumb {
        justify-content: center;
        margin-top: 10px;
    }
    .page-hero .breadcrumb a {
        color: var(--accent);
        text-decoration: none;
    }
    .page-hero .breadcrumb-item.active {
        color: rgba(255,255,255,0.6);
    }
    .services-grid {
        padding: 70px 0;
    }
    .svc-card {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.3s;
        height: 100%;
        border: 1px solid #eee;
        background: #fff;
        display: flex;
        flex-direction: column;
    }
    .svc-card:hover {
        box-shadow: 0 12px 40px rgba(0,0,0,0.14);
        transform: translateY(-6px);
        border-color: var(--primary);
    }
    .svc-card .svc-card-img {
        height: 200px;
        overflow: hidden;
        background: var(--light-green);
    }
    .svc-card .svc-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .svc-card:hover .svc-card-img img {
        transform: scale(1.08);
    }
    .svc-card .svc-card-img .icon-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        color: var(--primary-dark);
        background: linear-gradient(135deg, var(--light-green) 0%, #c8e6c9 100%);
    }
    .svc-card .svc-card-body {
        padding: 22px 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    a.text-decoration-none .svc-card {
        color: inherit;
    }
    .svc-card h5 {
        font-weight: 700;
        color: #1a3a1a;
        font-size: 1.05rem;
        margin-bottom: 10px;
    }
    .svc-card:hover h5 {
        color: var(--primary-dark);
    }
    .svc-card p {
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
        margin-top: 10px;
        transition: gap 0.3s;
    }
    .svc-card:hover .svc-link {
        gap: 10px;
    }
</style>
@endsection

@section('content')
<section class="page-hero">
    <div class="container">
        <h1>Our Services</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Services</li>
            </ol>
        </nav>
    </div>
</section>

<section class="services-grid">
    <div class="container">
        {{-- Category Filter Buttons --}}
        @if(isset($serviceCategories) && $serviceCategories->count())
            <div class="text-center mb-5" data-aos="fade-up">
                <a href="/services" class="btn btn-sm rounded-pill px-4 py-2 me-2 mb-2 {{ !isset($activeServiceCategory) || !$activeServiceCategory ? 'btn-success' : 'btn-outline-success' }}">All Services</a>
                @foreach($serviceCategories as $sc)
                    <a href="{{ route('services.category', $sc->slug) }}" class="btn btn-sm rounded-pill px-4 py-2 me-2 mb-2 {{ isset($activeServiceCategory) && $activeServiceCategory && $activeServiceCategory->id === $sc->id ? 'btn-success' : 'btn-outline-success' }}">{{ $sc->name }}</a>
                @endforeach
            </div>
        @endif

        <div class="row g-4">
            @foreach($services as $i => $service)
                <div class="col-lg-4 col-md-6">
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
                                    <img loading="lazy" src="{{ asset('storage/' . $fallbackImages[$i % count($fallbackImages)]) }}" alt="{{ $service->name }}">
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
                    ['icon' => 'fas fa-flask', 'title' => 'Science-Driven Approach', 'desc' => 'Every project is guided by scientific assessment, including soil analysis, plant selection, and climate-responsive planning to ensure long-term performance.'],
                    ['icon' => 'fas fa-seedling', 'title' => 'Sustainability at the Core', 'desc' => 'We design eco-friendly landscapes that conserve water, enhance soil health, support biodiversity, and reduce maintenance needs.'],
                    ['icon' => 'fas fa-chart-bar', 'title' => 'Research-Integrated Planning', 'desc' => 'Our work is backed by academic expertise, field trials, and data-driven insights for reliable and high-performing green solutions.'],
                    ['icon' => 'fas fa-globe-americas', 'title' => 'Climate-Resilient Design', 'desc' => 'We create adaptive landscapes that withstand heat, irregular rainfall, and urban environmental stress.'],
                    ['icon' => 'fas fa-hard-hat', 'title' => 'End-to-End Execution', 'desc' => 'From design and plant supply to installation and maintenance, we provide complete landscaping solutions under one roof.'],
                    ['icon' => 'fas fa-users', 'title' => 'Expert Leadership & Advisory', 'desc' => 'Led by horticulture professionals and supported by a strong scientific network, ensuring technical excellence in every project.'],
                    ['icon' => 'fas fa-hand-holding-usd', 'title' => 'Long-Term Value & Cost-Effective Solutions', 'desc' => 'We focus on delivering high-quality landscapes that balance design, performance, and budget — ensuring maximum value with optimized resources and lasting results.'],
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

<style>
    /* ===== WHY CHOOSE SECTION ===== */
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
    .why-choose-heading span {
        color: var(--primary);
    }
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
        top: 0;
        left: 0;
        width: 4px;
        height: 0;
        background: var(--primary);
        border-radius: 0 0 4px 4px;
        transition: height 0.4s;
    }
    .why-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        border-color: rgba(139,195,74,0.3);
    }
    .why-card:hover::before {
        height: 100%;
    }
    .why-card-icon {
        width: 60px;
        height: 60px;
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
    .why-card:hover .why-card-icon {
        background: var(--primary);
    }
    .why-card:hover .why-card-icon i {
        color: #fff;
    }
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

    @media (max-width: 991px) {
        .why-choose-section { padding: 60px 0; }
        .why-choose-heading { font-size: 1.8rem; }
    }
    @media (max-width: 575px) {
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

@section('cta')
<!-- Service Page CTA — Book Consultation -->
<section class="svc-cta-wrapper">
    <div class="container">
        <div class="svc-cta-section">
            <div class="svc-cta-overlay"></div>
            <div class="svc-cta-inner">

                <!-- Left: Company Info -->
                <div class="svc-cta-left">
                    <h2 class="svc-cta-company">SR GREENSCAPES PVT LTD</h2>
                    <p class="svc-cta-tagline"><i class="fas fa-leaf"></i> Sowing Science, Growing Beauty</p>
                    <p class="svc-cta-desc">
                        Reach out to discuss your ideas and outdoor needs.<br>
                        We're here to help your garden thrive beautifully.
                    </p>
                </div>

                <!-- Right: Consultation Form Card -->
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
    .svc-cta-wrapper {
        padding: 60px 0 80px;
        background: #f9fbf7;
    }
    .svc-cta-section {
        position: relative;
        background: url('{{ asset('storage/banners/UzLsmhyoocKjP5FDbGYxHVVSVkxrJaVqcw3hrUIB.jpg') }}') center/cover no-repeat;
        padding: 60px 50px;
        overflow: hidden;
        border-radius: 30px;
        box-shadow: 0 20px 60px rgba(26, 58, 26, 0.25);
    }
    .svc-cta-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(15,30,15,0.85) 0%, rgba(15,30,15,0.55) 55%, rgba(15,30,15,0.3) 100%);
        border-radius: 30px;
    }
    .svc-cta-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }

    /* Left */
    .svc-cta-left { flex: 1; max-width: 460px; }
    .svc-cta-company {
        color: #fff;
        font-size: 1.8rem;
        font-weight: 900;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }
    .svc-cta-tagline {
        color: var(--primary);
        font-size: 1rem;
        font-weight: 500;
        font-style: italic;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .svc-cta-tagline i {
        color: var(--primary);
    }
    .svc-cta-desc {
        color: rgba(255,255,255,0.6);
        font-size: 0.95rem;
        line-height: 1.75;
    }

    /* Right Card */
    .svc-cta-card {
        width: 420px;
        flex-shrink: 0;
        background: rgba(255,255,255,0.97);
        border-radius: 12px;
        padding: 30px 25px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }
    .svc-cta-card-title {
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 20px;
        font-size: 1.3rem;
    }
    .svc-cta-row {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }
    .svc-cta-input {
        flex: 1;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 11px 14px;
        font-size: 13px;
        background: #fafafa;
        width: 100%;
        transition: border-color 0.2s;
        color: var(--dark);
    }
    .svc-cta-input::placeholder { color: #999; }
    .svc-cta-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(76,175,80,0.1);
    }
    .svc-cta-input option { background: #fff; color: var(--dark); }
    .svc-cta-textarea {
        display: block;
        width: 100%;
        height: 80px;
        resize: vertical;
        margin-bottom: 12px;
        margin-top: 0;
    }
    .svc-cta-submit {
        display: block;
        width: 100%;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 13px;
        font-weight: 800;
        font-size: 0.85rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s;
    }
    .svc-cta-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(139,195,74,0.3);
    }
    @media (max-width: 991px) {
        .svc-cta-wrapper { padding: 40px 0 60px; }
        .svc-cta-section { padding: 40px 24px; border-radius: 24px; }
        .svc-cta-overlay { border-radius: 24px; }
        .svc-cta-inner { flex-direction: column; }
        .svc-cta-card { width: 100%; }
        .svc-cta-company { font-size: 1.4rem; }
    }
    @media (max-width: 575px) {
        .page-hero { padding: 60px 0; }
        .page-hero h1 { font-size: 1.6rem; }
        .services-grid { padding: 40px 0; }
        .svc-card .svc-card-img { height: 160px; }
        .svc-card .svc-card-body { padding: 18px 14px; }
        .svc-card .svc-card-body h5 { font-size: 0.95rem; }
        .svc-card .svc-card-body p { font-size: 0.8rem; }
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
