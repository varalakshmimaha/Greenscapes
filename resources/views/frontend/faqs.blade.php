@extends('frontend.layouts.app')

@section('styles')
<style>
    /* ===== HERO ===== */
    .faq-hero {
        position: relative;
        width: 100%;
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .faq-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('{{ asset('storage/banners/3pl1gRy59ySBn4viINYs279UJvvPZHE8R4dvzLVt.jpg') }}') center/cover no-repeat;
    }
    .faq-hero::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(20, 45, 25, 0.70);
    }
    .faq-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .faq-hero-content h1 {
        color: #fff;
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .faq-hero-content p {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.15rem;
        max-width: 650px;
        margin: 0 auto;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }

    /* ===== FAQ SECTION ===== */
    .faq-section {
        padding: 70px 0 90px;
        background: #f7f9fb;
    }
    .faq-heading {
        margin-bottom: 10px;
    }
    .faq-heading h2 {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--primary);
    }
    .faq-heading p {
        color: #888;
        font-size: 0.92rem;
        max-width: 450px;
        line-height: 1.7;
    }

    /* ===== TWO COLUMN LAYOUT ===== */
    .faq-layout {
        margin-top: 40px;
    }

    .faq-cat-pills {
        display: flex;
        flex-wrap: nowrap;
        gap: 6px;
        margin-bottom: 40px;
        justify-content: center;
    }
    .faq-cat-pill {
        white-space: nowrap;
        padding: 8px 14px;
        border-radius: 30px;
        border: 1px solid var(--primary);
        background: #fff;
        color: var(--primary);
        font-weight: 500;
        font-size: 0.78rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    .faq-cat-pill:hover, .faq-cat-pill.active {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }

    .faq-container {
        display: flex;
        gap: 40px;
        align-items: flex-start;
    }
    .faq-left-col {
        flex: 0 0 45%;
    }
    .faq-left-img {
        width: 100%;
        height: 420px;
        object-fit: cover;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    @media (max-width: 991px) {
        .faq-container { flex-direction: column; }
        .faq-left-col { flex: none; width: 100%; margin-bottom: 30px; }
        .faq-left-img { height: 400px; }
    }

    /* RIGHT: Q&A Accordion */
    .faq-right {
        flex: 1;
        min-width: 0;
    }
    .faq-panel {
        display: none;
    }
    .faq-panel.active {
        display: block;
        animation: faqSlideIn 0.4s ease;
    }
    @keyframes faqSlideIn {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Accordion item */
    .faq-acc-item {
        background: #fff;
        border-radius: 16px;
        margin-bottom: 14px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        overflow: hidden;
        transition: all 0.3s;
    }
    .faq-acc-item:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    }
    .faq-acc-item.open {
        box-shadow: 0 6px 25px rgba(76,175,80,0.1);
    }
    .faq-acc-header {
        width: 100%;
        padding: 20px 24px;
        border: none;
        background: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        cursor: pointer;
        text-align: left;
    }
    .faq-acc-header .q-text {
        flex: 1;
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--dark);
        line-height: 1.45;
    }
    .faq-acc-item.open .faq-acc-header .q-text {
        color: var(--primary-dark);
    }
    .faq-acc-header .q-toggle {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 50%;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: all 0.35s;
    }
    .faq-acc-item.open .faq-acc-header .q-toggle {
        transform: rotate(45deg);
    }
    .faq-acc-body {
        display: none;
        padding: 0 24px 22px 24px;
        color: #666;
        font-size: 0.88rem;
        line-height: 1.85;
        border-top: 1px solid #f5f5f5;
        padding-top: 16px;
        margin-top: -2px;
        text-align: left;
    }
    .faq-acc-item.open .faq-acc-body {
        display: block;
        animation: faqSlideIn 0.3s ease;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .faq-hero { height: 260px; }
        .faq-hero-content h1 { font-size: 2.5rem; }
    }
    @media (max-width: 575px) {
        .faq-hero { height: 180px; }
        .faq-hero-content h1 { font-size: 1.6rem; }
        .faq-hero-content p { font-size: 0.88rem; }
        .faq-heading h2 { font-size: 1.6rem; }
        .faq-cat-pills { justify-content: center; flex-wrap: wrap; gap: 5px; }
        .faq-cat-pill { padding: 6px 10px; font-size: 0.7rem; }
        .faq-left-img { height: 250px; border-radius: 12px; }
        .faq-acc-item { border-radius: 12px; margin-bottom: 10px; }
        .faq-acc-header { padding: 14px 16px; }
        .faq-acc-header .q-text { font-size: 0.85rem; }
        .faq-acc-header .q-toggle { width: 28px; height: 28px; min-width: 28px; font-size: 15px; }
        .faq-acc-body { padding: 0 16px 16px; font-size: 0.82rem; }
        .faq-section { padding: 40px 0 50px; }
    }
</style>
@endsection

@section('content')

<!-- HERO BANNER -->
<section class="faq-hero">
    <div class="faq-hero-content">
        <h1>Frequently Asked Questions</h1>
        <p>Everything you need to know about our landscaping, delivery, and services.</p>
    </div>
</section>

<!-- FAQ SECTION -->
<section class="faq-section">
    <div class="container">

        @php
            $catIcons = [
                'About Us' => 'fa-building',
                'Services & Projects' => 'fa-tools',
                'Consultation & Project Process' => 'fa-clipboard-list',
                'Landscape & Garden Design' => 'fa-drafting-compass',
                'Garden Maintenance & Irrigation' => 'fa-wrench',
                'Nursery & Plant Orders' => 'fa-seedling',
                'Team & Contact' => 'fa-users',
            ];
            $catDescs = [
                'About Us' => 'Learn about SR Greenscapes — our mission, values, and science-driven approach to sustainable landscaping.',
                'Services & Projects' => 'Explore our comprehensive landscaping solutions from design to maintenance and event styling.',
                'Consultation & Project Process' => 'Understand how we plan, design and execute your landscaping projects step by step.',
                'Landscape & Garden Design' => 'Everything about garden designs, timelines, measurements and consultation fees.',
                'Garden Maintenance & Irrigation' => 'Regular maintenance plans, irrigation systems and service coverage details.',
                'Nursery & Plant Orders' => 'Plant delivery, soil orders, damaged plant policies and custom sourcing.',
                'Team & Contact' => 'Meet our team, find our office and get in touch through multiple channels.',
            ];
            $catImages = [
                'About Us' => asset('storage/About Us/2.1  Science-Driven Approach.jpg'),
                'Services & Projects' => asset('storage/Home/1.17 Specialized Garden Services.jpg'),
                'Consultation & Project Process' => asset('storage/Construction/4.1 Consultation  Site Assessment.jpg'),
                'Landscape & Garden Design' => asset('storage/Home/1.18 Hardscape  Softscape Development.jpg'),
                'Garden Maintenance & Irrigation' => asset('storage/Home/1.19 Landscape Maintenance.png'),
                'Nursery & Plant Orders' => asset('storage/Home/1.20 Nursery  Plant Supply.jpg'),
                'Team & Contact' => asset('storage/Home/1.3 Cover photo 3.jpg'),
            ];

            // Use DB data if available, otherwise hardcoded
            $hasDbData = isset($faqCategories) && $faqCategories->count();

            $hardcodedFaqs = [
                'About Us' => [
                    ['q' => 'What is SR Greenscapes Pvt Ltd?', 'a' => 'SR Greenscapes Pvt Ltd is a sustainable landscaping company based in Bengaluru, providing research-integrated landscape, nursery, horticulture and ecological solutions across India.'],
                    ['q' => 'How are you different from other landscaping companies?', 'a' => 'We integrate scientific planning, soil assessment, climate-responsive plant selection and sustainability principles into every project. Our approach focuses on long-term ecological performance rather than short-term aesthetics.'],
                    ['q' => 'Do you promote native and climate-resilient plants?', 'a' => 'Yes. We prioritize native and adaptive species that support biodiversity, reduce water use, and improve long-term sustainability.'],
                    ['q' => 'Do you handle institutional or government landscape projects?', 'a' => 'Yes. We undertake institutional, campus and public-sector projects with structured planning, documentation and professional execution standards.'],
                    ['q' => 'Where do you operate?', 'a' => 'Headquartered in Bengaluru, we deliver projects across India.'],
                ],
                'Services & Projects' => [
                    ['q' => 'What types of projects do you handle?', 'a' => 'Homes, villas, apartments, offices, resorts, hospitals, schools, corporate campuses, parks, and public landscapes.'],
                    ['q' => 'What services do you offer?', 'a' => 'Landscape design & execution, softscape & hardscape, specialized garden services, maintenance, event styling, horticulture consultancy, nursery supply, irrigation, water features, and lighting.'],
                    ['q' => 'Do you provide maintenance services?', 'a' => 'Yes. We offer tailored maintenance plans including pruning, fertilization, pest control, irrigation and plant health monitoring.'],
                    ['q' => 'Can you design temporary green decor for events?', 'a' => 'Absolutely. We handle weddings, corporate events, exhibitions, festive occasions and themed green installations.'],
                ],
                'Consultation & Project Process' => [
                    ['q' => 'How do I start a landscaping project?', 'a' => 'Begin with a consultation via call, video chat, or on-site visit to discuss your space, needs, budget and maintenance expectations.'],
                    ['q' => 'Will I see the design before work begins?', 'a' => 'Yes. We provide 2D drawings or 3D visualizations so you can clearly visualize the final result.'],
                    ['q' => 'How is the project executed?', 'a' => 'Our team manages site preparation, hardscaping, planting, irrigation and lawn installation, keeping you updated throughout the process.'],
                    ['q' => 'Do you offer support after completion?', 'a' => 'Yes. We provide a guided handover and optional post-completion support to keep your garden healthy and vibrant.'],
                ],
                'Landscape & Garden Design' => [
                    ['q' => 'Do you handle small gardens or terraces?', 'a' => 'Yes. We specialize in small spaces, including balconies, terraces, courtyards and vertical gardens.'],
                    ['q' => 'What if I don\'t have measurements or a layout?', 'a' => 'No problem. Our team can visit the site, take measurements and create a customized design.'],
                    ['q' => 'How long does a garden design take?', 'a' => 'Typically, 1-3 weeks for small gardens, depending on complexity.'],
                    ['q' => 'Do you charge for consultation?', 'a' => 'A nominal fee applies, which is adjusted if you proceed with the project.'],
                ],
                'Garden Maintenance & Irrigation' => [
                    ['q' => 'Do you provide regular garden maintenance?', 'a' => 'Yes. Weekly, bi-weekly, or monthly plans are available depending on your garden\'s needs.'],
                    ['q' => 'Can you service existing irrigation systems?', 'a' => 'Yes. We install, repair and maintain all types of irrigation systems.'],
                    ['q' => 'Do you provide garden installation outside Bengaluru or India?', 'a' => 'Yes, for select locations across India.'],
                ],
                'Nursery & Plant Orders' => [
                    ['q' => 'Do you ship plants outside Bengaluru?', 'a' => 'Yes! Delivery is available to select locations, with charges varying by distance and plant type.'],
                    ['q' => 'Can I order soils or farmyard manure (FYM)?', 'a' => 'Yes. We provide red soil, garden soil and FYM in convenient sacks.'],
                    ['q' => 'What if plants are damaged during delivery?', 'a' => 'Contact us immediately. We offer replacement or refund for damaged plants.'],
                    ['q' => 'Can I request plants not listed in your nursery?', 'a' => 'Absolutely! Share the details and we\'ll try to source it for you.'],
                ],
                'Team & Contact' => [
                    ['q' => 'Who is behind SR Greenscapes Pvt Ltd?', 'a' => 'Our team includes PhD horticulture professionals, landscape designers, project managers, and skilled horticulture experts. MDs: Dr. Supriya Narayan & Mr. Srinidhi AT, supported by a strategic advisory panel.'],
                    ['q' => 'How can I contact you?', 'a' => 'Phone / WhatsApp: +91 9845728507, +91 9113620609<br>Email: srgreenscapes@gmail.com, mdsrgreenscapes@gmail.com'],
                    ['q' => 'Where is your office located?', 'a' => 'Sy No. 32/40, Ground Floor, Jinnagara, Gangalu Main Road, Near Jinnagara Basaveshwara Temple, Hoskote Taluk, Bangalore – 562114, Karnataka, India'],
                    ['q' => 'Are you open on Sundays?', 'a' => 'Yes, we operate 24 &times; 7, ensuring uninterrupted service and support for our clients.'],
                ],
            ];

            // Force use of complete hardcoded data provided by the user
            $activeCats = collect(array_keys($hardcodedFaqs));
            $hasDbData = false;
        @endphp

        <div class="faq-layout">
            <div class="text-center mb-4">
                <h2 style="font-size: 1.8rem; font-weight: 800; color: var(--primary);">SR Greenscapes Pvt Ltd &ndash; FAQ &#127807;</h2>
            </div>
            <!-- TOP: PILLS -->
            <div class="faq-cat-pills">
                @foreach($activeCats as $idx => $cat)
                    <button class="faq-cat-pill {{ $idx === 0 ? 'active' : '' }}" onclick="switchFaqCat({{ $idx }}, this, '{{ $catImages[$cat] ?? asset('storage/banners/UzLsmhyoocKjP5FDbGYxHVVSVkxrJaVqcw3hrUIB.jpg') }}')">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>

            <div class="faq-container">
                <!-- LEFT SIDE IMAGE -->
                <div class="faq-left-col">
                    <img loading="lazy" src="{{ $catImages[$activeCats[0]] ?? asset('storage/banners/UzLsmhyoocKjP5FDbGYxHVVSVkxrJaVqcw3hrUIB.jpg') }}" id="faqMainImg" class="faq-left-img" alt="FAQ Category Image">
                </div>

                <!-- RIGHT SIDE QUESTION AND ANS -->
                <div class="faq-right">
                    @foreach($activeCats as $idx => $cat)
                        <div class="faq-panel {{ $idx === 0 ? 'active' : '' }}" id="faqPanel{{ $idx }}">
                            @if($hasDbData)
                                @foreach($faqCategories[$cat] as $faq)
                                    <div class="faq-acc-item" onclick="toggleFaqAcc(this)">
                                        <button class="faq-acc-header">
                                            <span class="q-text">{{ $faq->question }}</span>
                                            <span class="q-toggle"><i class="fas fa-plus"></i></span>
                                        </button>
                                        <div class="faq-acc-body">{!! nl2br(e($faq->answer)) !!}</div>
                                    </div>
                                @endforeach
                            @else
                                @foreach($hardcodedFaqs[$cat] as $item)
                                    <div class="faq-acc-item" onclick="toggleFaqAcc(this)">
                                        <button class="faq-acc-header">
                                            <span class="q-text">{{ $item['q'] }}</span>
                                            <span class="q-toggle"><i class="fas fa-plus"></i></span>
                                        </button>
                                        <div class="faq-acc-body">{!! $item['a'] !!}</div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@section('cta')
<!-- FAQs Page CTA — Book Consultation -->
<section class="faq-cta-wrapper">
    <div class="container">
        <div class="faq-cta-section">
            <div class="faq-cta-overlay"></div>
            <div class="faq-cta-inner">
                <div class="faq-cta-left">
                    <h2 class="faq-cta-company">SR GREENSCAPES PVT LTD</h2>
                    <p class="faq-cta-tagline"><i class="fas fa-leaf"></i> Sowing Science, Growing Beauty</p>
                    <p class="faq-cta-desc">Still have questions about our landscaping?<br>Feel free to contact our support team or book a consultation.</p>
                </div>
                <div class="faq-cta-card">
                    <h4 class="faq-cta-card-title">Book Consultation</h4>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="faq-cta">
                        <div class="faq-cta-row">
                            <input type="text" name="name" class="faq-cta-input" placeholder="Name *" required>
                            <input type="text" name="phone" class="faq-cta-input" placeholder="Phone *" required>
                        </div>
                        <div class="faq-cta-row">
                            <input type="text" name="subject" class="faq-cta-input" placeholder="City">
                            <select name="message" class="faq-cta-input" required>
                                <option value="">Select Service *</option>
                                <option>Landscape Design & Execution</option>
                                <option>Specialized Garden Services</option>
                                <option>Nursery & Plant Supply</option>
                                <option>Landscape Maintenance</option>
                                <option>Horticulture Consultancy</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <textarea name="details" class="faq-cta-input faq-cta-textarea" placeholder="Message"></textarea>
                        <button type="submit" class="faq-cta-submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .faq-cta-wrapper { padding: 60px 0 80px; background: #f9fbf7; }
    .faq-cta-section { position: relative; background: url('{{ asset('storage/banners/7Y3HMip9xIwGpteCyZhegEkqwr4MpYeF348aEQ4q.jpg') }}') center/cover no-repeat; padding: 60px 50px; overflow: hidden; border-radius: 30px; box-shadow: 0 20px 60px rgba(26,58,26,0.25); }
    .faq-cta-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(15,30,15,0.85) 0%, rgba(15,30,15,0.55) 55%, rgba(15,30,15,0.3) 100%); border-radius: 30px; }
    .faq-cta-inner { position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; gap: 40px; }
    .faq-cta-left { flex: 1; max-width: 460px; }
    .faq-cta-company { color: #fff; font-size: 1.8rem; font-weight: 900; letter-spacing: 1px; margin-bottom: 12px; }
    .faq-cta-tagline { color: var(--primary); font-size: 1rem; font-weight: 500; font-style: italic; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
    .faq-cta-desc { color: rgba(255,255,255,0.6); font-size: 0.95rem; line-height: 1.75; }
    .faq-cta-card { width: 420px; flex-shrink: 0; background: rgba(255,255,255,0.97); border-radius: 12px; padding: 30px 25px; box-shadow: 0 15px 40px rgba(0,0,0,0.2); }
    .faq-cta-card-title { font-weight: 800; color: var(--dark); margin-bottom: 20px; font-size: 1.3rem; }
    .faq-cta-row { display: flex; gap: 10px; margin-bottom: 10px; }
    .faq-cta-input { flex: 1; border: 1px solid #e0e0e0; border-radius: 8px; padding: 11px 14px; font-size: 13px; background: #fafafa; width: 100%; transition: border-color 0.2s; color: var(--dark); }
    .faq-cta-input::placeholder { color: #999; }
    .faq-cta-input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(76,175,80,0.1); }
    .faq-cta-input option { background: #fff; color: var(--dark); }
    .faq-cta-textarea { display: block; width: 100%; height: 80px; resize: vertical; margin-bottom: 12px; }
    .faq-cta-submit { display: block; width: 100%; background: var(--primary); color: #fff; border: none; border-radius: 8px; padding: 13px; font-weight: 800; font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; transition: all 0.3s; }
    .faq-cta-submit:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(139,195,74,0.3); }
    @media (max-width: 991px) {
        .faq-cta-wrapper { padding: 40px 0 60px; }
        .faq-cta-section { padding: 40px 24px; border-radius: 24px; }
        .faq-cta-overlay { border-radius: 24px; }
        .faq-cta-inner { flex-direction: column; }
        .faq-cta-card { width: 100%; }
        .faq-cta-company { font-size: 1.4rem; }
    }
</style>
@endsection
@endsection

@section('scripts')
<script>
    function switchFaqCat(index, btn, imgSrc) {
        // Tabs
        document.querySelectorAll('.faq-cat-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Update image
        if(imgSrc) {
            document.getElementById('faqMainImg').src = imgSrc;
        }

        // Panels
        document.querySelectorAll('.faq-panel').forEach(p => p.classList.remove('active'));
        document.getElementById('faqPanel' + index).classList.add('active');

        // Close open items
        document.querySelectorAll('#faqPanel' + index + ' .faq-acc-item').forEach(i => i.classList.remove('open'));
    }

    function toggleFaqAcc(item) {
        const wasOpen = item.classList.contains('open');
        item.closest('.faq-panel').querySelectorAll('.faq-acc-item').forEach(i => i.classList.remove('open'));
        if (!wasOpen) item.classList.add('open');
    }
</script>
@endsection
