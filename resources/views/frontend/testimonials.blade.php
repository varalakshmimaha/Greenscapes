@extends('frontend.layouts.app')

@section('title', 'Testimonials - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO ===== */
    .testi-hero {
        position: relative;
        width: 100%;
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .testi-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover no-repeat;
    }
    .testi-hero::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(20, 45, 25, 0.70);
    }
    .testi-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .testi-hero-content h1 {
        color: #fff;
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .testi-hero-content p {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.15rem;
        max-width: 650px;
        margin: 0 auto;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }

    /* ===== TESTIMONIAL CARD ===== */
    .testimonial-card {
        background: #fff;
        border-radius: 16px;
        padding: 40px 30px;
        min-height: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    }
    .testi-quote {
        color: #8BC34A;
        font-size: 2.5rem;
        margin-bottom: 20px;
        opacity: 0.8;
    }
    .testi-text-content {
        color: #555;
        font-size: 1.05rem;
        font-style: italic;
        line-height: 1.7;
        margin-bottom: 30px;
    }
    .testi-author-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: auto;
    }
    .testi-author-info img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #8BC34A;
    }
    .testi-avatar-placeholder {
        width: 60px; height: 60px;
        border-radius: 50%;
        background: rgba(197,225,165,0.2);
        border: 2px solid #C5E1A5;
        display: flex; align-items: center; justify-content: center;
        color: #8db568;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    .testi-name {
        color: #1a3a1a;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 4px;
    }
    .testi-role {
        color: #888;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .testi-stars {
        color: #f59e0b;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    @media (max-width: 575px) {
        .testimonial-card { padding: 25px 18px; border-radius: 12px; }
        .testi-quote { font-size: 1.8rem; margin-bottom: 12px; }
        .testi-text-content { font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px; }
        .testi-author-info img { width: 45px; height: 45px; }
        .testi-avatar-placeholder { width: 45px; height: 45px; font-size: 1.1rem; }
        .testi-name { font-size: 0.95rem; }
        .testi-role { font-size: 0.75rem; }
    }
</style>
@endsection

@section('content')

<!-- Hero Section -->
<div class="testi-hero">
    <div class="testi-hero-content" data-aos="fade-up">
        <h1>Client Testimonials</h1>
        <p>Discover what our clients have to say about the passion, professionalism, and science-driven approach we bring to every project.</p>
    </div>
</div>

<!-- Testimonials Section -->
<section class="py-5" style="background-color: #f9fbf9;">
    <div class="container py-5">
        
        <div class="text-center mb-5 pb-3">
            <h2 class="display-5 fw-bold" style="color: var(--primary);">Words from Our Clients</h2>
        </div>

        @php
            // Fallback testimonials if none are in database
            $fallbackTestimonials = [
                (object)['name' => 'Eleanor Pena', 'designation' => 'Founder', 'message' => 'They improved our lawn beautifully. The turfing looks fresh, even, and very professionally done. The team worked with care and kept us updated throughout the process. We\'re really happy with the final result.', 'image' => 'storage/Home/1.7 Cover photo 7.jpg', 'rating' => 5],
                (object)['name' => 'Emily Carter', 'designation' => 'Senior Project Manager', 'message' => 'They improved our lawn beautifully. The turfing looks fresh, even, and very professionally done. The team worked with care and kept us updated throughout the process. We\'re really happy with the final result.', 'image' => 'storage/Home/1.8 Science-Driven Approach.jpg', 'rating' => 5],
                (object)['name' => 'Bessie Cooper', 'designation' => 'Client', 'message' => 'They improved our lawn beautifully. The turfing looks fresh, even, and very professionally done. The team worked with care and kept us updated throughout the process. We\'re really happy with the final result.', 'image' => 'storage/Home/1.9 Sustainability at the Core.jpg', 'rating' => 5],
                (object)['name' => 'John Doe', 'designation' => 'Property Owner', 'message' => 'They improved our lawn beautifully. The turfing looks fresh, even, and very professionally done. The team worked with care and kept us updated throughout the process. We\'re really happy with the final result.', 'rating' => 5],
            ];
            
            $activeTestimonials = (isset($testimonials) && count($testimonials) > 0) ? $testimonials : $fallbackTestimonials;
        @endphp

        <div class="row g-4">
            @foreach($activeTestimonials as $t)
            <div class="col-lg-6 col-xl-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="testimonial-card d-flex flex-column">
                    <div class="testi-quote">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="testi-stars">
                        @for($i = 0; $i < ($t->rating ?? 5); $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                    </div>
                    <p class="testi-text-content flex-grow-1">"{{ $t->content ?? $t->message ?? $t->text ?? '' }}"</p>
                    
                    <div class="testi-author-info">
                        @php $tPhoto = $t->photo ?? $t->image ?? null; @endphp
                        @if($tPhoto)
                            @php
                                $imgSrc = !str_contains($tPhoto, 'storage') ? asset('storage/' . $tPhoto) : asset($tPhoto);
                            @endphp
                            <img src="{{ $imgSrc }}" alt="{{ $t->name }}">
                        @else
                            <div class="testi-avatar-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div>
                            <div class="testi-name">{{ $t->name }}</div>
                            <div class="testi-role">{{ $t->designation ?? $t->role ?? '' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection