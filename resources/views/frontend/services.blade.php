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
    .svc-card h5 {
        font-weight: 700;
        color: var(--dark);
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
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                                @else
                                    <img src="{{ asset('storage/' . $fallbackImages[$i % count($fallbackImages)]) }}" alt="{{ $service->name }}">
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
</style>
@endsection
