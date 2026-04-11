@extends('frontend.layouts.app')

@section('styles')
<style>
    /* ===== HERO BANNER ===== */
    .service-hero {
        position: relative;
        background-size: cover !important;
        background-position: center !important;
        padding: 110px 0 80px;
        text-align: center;
        overflow: hidden;
    }
    .service-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(rgba(15, 30, 15, 0.72), rgba(15, 30, 15, 0.72));
        z-index: 0;
    }
    .service-hero .container { position: relative; z-index: 1; }
    .service-hero h1 {
        color: #fff;
        font-size: 2.8rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-bottom: 12px;
    }
    .service-hero .breadcrumb {
        justify-content: center;
        background: transparent;
        padding: 0; margin: 0;
    }
    .service-hero .breadcrumb-item a {
        color: rgba(255,255,255,0.55);
        text-decoration: none;
        font-size: 0.88rem;
    }
    .service-hero .breadcrumb-item.active { color: var(--primary); font-size: 0.88rem; }
    .service-hero .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.3); }

    /* ===== CONTENT AREA ===== */
    .service-detail-wrap {
        padding: 60px 0 80px;
        background: #f7f9f7;
    }

    /* ===== LEFT: Image + Description ===== */
    .svc-main-img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        border-radius: 16px;
        display: block;
        margin-bottom: 32px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }
    .svc-about-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e8f0e8;
    }
    .svc-about-heading i { color: var(--primary); font-size: 1.1rem; }
    .service-desc {
        font-size: 1rem;
        line-height: 1.9;
        color: #555;
    }
    .service-desc h2, .service-desc h3, .service-desc h4 {
        color: var(--dark); margin-top: 22px; margin-bottom: 8px; font-weight: 700;
    }
    .service-desc ul, .service-desc ol { padding-left: 20px; margin-bottom: 14px; }
    .service-desc li { margin-bottom: 7px; }

    .pdf-download-btn {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        background: #fff;
        border: 2px solid var(--primary);
        border-radius: 12px;
        padding: 14px 22px;
        text-decoration: none;
        color: var(--dark);
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
        margin-top: 22px;
    }
    .pdf-download-btn:hover { background: var(--primary); color: #fff; }
    .pdf-download-btn i { font-size: 1.8rem; color: #e53935; transition: color 0.3s; }
    .pdf-download-btn:hover i { color: #fff; }

    /* ===== SIDEBAR ===== */
    .service-sidebar { position: sticky; top: 90px; }

    /* Enquiry Card */
    .enquiry-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 6px 30px rgba(0,0,0,0.09);
        margin-bottom: 24px;
        border: 1px solid #e6efe6;
    }
    .enquiry-card-header {
        background: #1a2a1a;
        padding: 18px 22px 14px;
    }
    .enquiry-card-header .enq-title {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #fff;
        font-size: 1rem;
        font-weight: 700;
        margin: 0 0 2px;
    }
    .enquiry-card-header .enq-title i { color: var(--primary); }
    .enquiry-card-header .enq-sub {
        color: rgba(255,255,255,0.5);
        font-size: 0.78rem;
        margin: 0;
    }
    .enquiry-card-body { padding: 20px; }
    .enq-field {
        width: 100%;
        border: 1.5px solid #e0ece0;
        border-radius: 8px;
        padding: 11px 14px;
        font-size: 0.88rem;
        color: #333;
        background: #fafcfa;
        transition: border-color 0.2s;
        margin-bottom: 12px;
        display: block;
    }
    .enq-field:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(139,195,74,0.15);
        background: #fff;
    }
    .enq-field::placeholder { color: #aab8aa; }
    .enq-readonly {
        background: #f0f6f0;
        color: #666;
        border-color: #dde8dd;
        cursor: default;
    }
    .btn-send-enquiry {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 13px;
        font-weight: 800;
        font-size: 0.88rem;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 4px;
    }
    .btn-send-enquiry:hover { background: #2e5c1a; transform: translateY(-1px); }
    .enq-trust {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #aaa;
        font-size: 0.75rem;
        margin-top: 10px;
        justify-content: center;
    }
    .enq-trust i { color: var(--primary); }

    /* Related Services Card */
    .related-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 6px 30px rgba(0,0,0,0.09);
        border: 1px solid #e6efe6;
    }
    .related-card-header {
        padding: 14px 20px;
        border-bottom: 1px solid #eef3ee;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        font-size: 0.92rem;
        color: var(--dark);
    }
    .related-card-header i { color: var(--primary); }
    .related-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 18px;
        border-bottom: 1px solid #f2f6f2;
        text-decoration: none;
        color: inherit;
        transition: background 0.2s, padding-left 0.2s;
    }
    .related-item:last-child { border-bottom: none; }
    .related-item:hover { background: #f5fbf5; padding-left: 24px; color: var(--dark); }
    .related-thumb {
        width: 52px; height: 52px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
        background: #e8f0e8;
        display: flex; align-items: center; justify-content: center;
    }
    .related-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .related-thumb i { color: var(--primary); font-size: 1.1rem; }
    .related-name {
        flex: 1;
        font-size: 0.88rem;
        font-weight: 600;
        color: #333;
        line-height: 1.35;
    }
    .related-arrow { color: #ccc; font-size: 0.7rem; }

    @media (max-width: 991px) {
        .service-hero h1 { font-size: 2rem; }
        .service-sidebar { position: static; }
        .svc-main-img { height: 240px; }
    }
</style>
@endsection

@section('content')

{{-- ===== HERO BANNER ===== --}}
<section class="service-hero"
    style="background: url('{{ $service->image ? asset('storage/'.$service->image) : asset('storage/Home/1.1Cover photo 1.jpg') }}');">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/services">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
            </ol>
        </nav>
        <h1>{{ $service->name }}</h1>
        <p class="text-white-50 mt-2" style="font-size: 1rem; max-width: 600px; margin: 0 auto;">
            Science-driven, sustainable landscaping solutions tailored for you.
        </p>
    </div>
</section>

{{-- ===== TWO-COLUMN CONTENT ===== --}}
<section class="service-detail-wrap">
    <div class="container">
        <div class="row g-5 align-items-start">

            {{-- LEFT: Image + Description --}}
            <div class="col-lg-8">

                {{-- Service Image --}}
                @if($service->image)
                    <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->name }}" class="svc-main-img">
                @else
                    <img src="{{ asset('storage/Home/1.1Cover photo 1.jpg') }}" alt="{{ $service->name }}" class="svc-main-img">
                @endif

                {{-- About Heading --}}
                <h3 class="svc-about-heading">
                    <i class="fas fa-info-circle"></i>
                    About This Service
                </h3>

                {{-- Description --}}
                <div class="service-desc">
                    {!! $service->description !!}
                </div>

                {{-- PDF Brochure --}}
                @if($service->pdf)
                    <a href="{{ asset('storage/'.$service->pdf) }}" target="_blank" class="pdf-download-btn">
                        <i class="fas fa-file-pdf"></i>
                        <div>
                            <div>Download Service Brochure</div>
                            <small style="font-weight: 400; opacity: 0.65;">PDF Document — Click to view</small>
                        </div>
                    </a>
                @endif

            </div>

            {{-- RIGHT: Sticky Sidebar --}}
            <div class="col-lg-4">
                <div class="service-sidebar">

                    {{-- Enquiry Form Card --}}
                    <div class="enquiry-card">
                        <div class="enquiry-card-header">
                            <p class="enq-title">
                                <i class="fas fa-paper-plane"></i>
                                Enquire About This Service
                            </p>
                            <p class="enq-sub">We'll get back to you within 24 hours</p>
                        </div>
                        <div class="enquiry-card-body">
                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="source" value="service-enquiry">
                                <input type="text"  name="name"    class="enq-field" placeholder="Full Name *" required>
                                <input type="text"  name="phone"   class="enq-field" placeholder="Phone Number *" required>
                                <input type="email" name="email"   class="enq-field" placeholder="Email Address *" required>
                                <input type="text"  name="subject" class="enq-field enq-readonly" value="Enquiry about: {{ $service->name }}" readonly>
                                <button type="submit" class="btn-send-enquiry">
                                    <i class="fas fa-paper-plane"></i> Send Enquiry
                                </button>
                                <p class="enq-trust">
                                    <i class="fas fa-shield-alt"></i>
                                    Your details are safe with us. No spam.
                                </p>
                            </form>
                        </div>
                    </div>

                    {{-- Related Services Card --}}
                    @if($relatedServices->count())
                    <div class="related-card">
                        <div class="related-card-header">
                            <i class="fas fa-th-list"></i>
                            Related Services
                        </div>
                        @foreach($relatedServices as $related)
                            <a href="{{ route('service.detail', $related->slug) }}" class="related-item">
                                <div class="related-thumb">
                                    @if($related->image)
                                        <img src="{{ asset('storage/'.$related->image) }}" alt="{{ $related->name }}">
                                    @else
                                        <i class="fas fa-leaf"></i>
                                    @endif
                                </div>
                                <span class="related-name">{{ $related->name }}</span>
                                <i class="fas fa-chevron-right related-arrow"></i>
                            </a>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</section>

@endsection
