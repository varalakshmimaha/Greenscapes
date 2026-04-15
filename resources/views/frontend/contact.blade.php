@extends('frontend.layouts.app')

@section('styles')
<style>
    /* ===== HERO BANNER ===== */
    .contact-hero {
        position: relative;
        height: 420px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('{{ asset('storage/Home/1.5 Cover photo 5.jpg') }}') center/cover no-repeat;
    }
    .contact-hero::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(27,94,32,0.88) 0%, rgba(26,42,26,0.92) 100%);
    }
    .contact-hero .hero-content {
        position: relative;
        z-index: 2;
    }
    .contact-hero .breadcrumb-nav {
        font-size: 0.85rem;
        margin-bottom: 20px;
    }
    .contact-hero .breadcrumb-nav a {
        color: var(--accent);
        text-decoration: none;
    }
    .contact-hero .breadcrumb-nav span {
        color: rgba(255,255,255,0.6);
    }
    .contact-hero h1 {
        color: #fff;
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }
    .contact-hero p {
        color: rgba(255,255,255,0.75);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }
    .hero-leaf-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }
    .hero-leaf-divider span {
        width: 50px;
        height: 2px;
        background: var(--accent);
    }
    .hero-leaf-divider i {
        color: var(--accent);
        font-size: 18px;
    }

    /* ===== QUICK INFO BAR ===== */
    .quick-info-bar {
        background: #fff;
        margin-top: -55px;
        position: relative;
        z-index: 10;
    }
    .quick-info-inner {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0,0,0,0.12);
    }
    .qi-item {
        padding: 35px 30px;
        display: flex;
        align-items: flex-start;
        gap: 18px;
        background: #fff;
        transition: all 0.4s;
        border-right: 1px solid #f0f0f0;
    }
    .qi-item:last-child { border-right: 0; }
    .qi-item:hover {
        background: var(--primary);
    }
    .qi-item:hover .qi-icon {
        background: #fff;
        color: var(--primary);
    }
    .qi-item:hover h6,
    .qi-item:hover p,
    .qi-item:hover a {
        color: #fff !important;
    }
    .qi-icon {
        width: 58px;
        height: 58px;
        min-width: 58px;
        border-radius: 50%;
        background: var(--light-green);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        transition: all 0.4s;
    }
    .qi-text h6 {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--dark);
        margin-bottom: 6px;
        transition: color 0.4s;
    }
    .qi-text p, .qi-text a {
        font-size: 0.88rem;
        color: #666;
        margin: 0;
        line-height: 1.6;
        text-decoration: none;
        transition: color 0.4s;
    }

    /* ===== MAIN CONTACT SECTION ===== */
    .contact-main {
        padding: 90px 0 80px;
        background: #fafcfa;
    }
    .contact-section-header {
        text-align: center;
        margin-bottom: 55px;
    }
    .contact-section-header .label-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--light-green);
        color: var(--primary-dark);
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 15px;
    }
    .contact-section-header h2 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 12px;
    }
    .contact-section-header p {
        color: #777;
        font-size: 1rem;
        max-width: 550px;
        margin: 0 auto;
    }

    /* Left: Office Landing Image */
    .contact-landing-img {
        width: 100%;
        height: 100%;
        min-height: 480px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 40px rgba(0,0,0,0.06);
    }
    .contact-landing-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Colored Info Blocks */
    .info-blocks-section {
        padding: 0 0 80px 0;
        background: #fafcfa;
    }
    .info-box {
        border-radius: 16px;
        padding: 40px 30px;
        color: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s;
    }
    .info-box:hover { transform: translateY(-5px); }
    .info-box .icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 20px;
    }
    .info-box h5 {
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 12px;
    }
    .info-box p {
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
        opacity: 0.95;
    }

    /* Right: Contact Form */
    .contact-form-card {
        background: #fff;
        border-radius: 20px;
        padding: 45px 40px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.06);
        border: 1px solid rgba(0,0,0,0.04);
        position: relative;
        overflow: hidden;
    }
    .contact-form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--accent));
    }
    .contact-form-card h4 {
        font-weight: 800;
        color: var(--dark);
        font-size: 1.35rem;
        margin-bottom: 5px;
    }
    .contact-form-card .form-intro {
        color: #888;
        font-size: 0.88rem;
        margin-bottom: 30px;
    }
    .form-floating-custom {
        position: relative;
        margin-bottom: 20px;
    }
    .form-floating-custom .form-control,
    .form-floating-custom .form-select {
        border: 2px solid #eef0ee;
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 0.9rem;
        background: #fafcfa;
        transition: all 0.3s;
        height: auto;
    }
    .form-floating-custom .form-control:focus,
    .form-floating-custom .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(76,175,80,0.08);
        background: #fff;
    }
    .form-floating-custom label {
        font-weight: 600;
        font-size: 0.8rem;
        color: var(--dark);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 8px;
        display: block;
    }
    .form-floating-custom label .required {
        color: #e53935;
        margin-left: 2px;
    }
    .btn-submit-contact {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: #fff;
        border: none;
        padding: 16px 45px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: all 0.4s;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .btn-submit-contact:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-darker) 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(76,175,80,0.3);
        color: #fff;
    }
    .form-secure-note {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 15px;
        color: #999;
        font-size: 0.75rem;
    }
    .form-secure-note i { color: var(--primary); }

    /* ===== MAP SECTION ===== */
    .map-section {
        position: relative;
    }
    .map-section .map-label {
        position: absolute;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 5;
        background: #fff;
        padding: 10px 25px;
        border-radius: 50px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .map-section .map-label i {
        color: var(--primary);
    }
    .map-section iframe {
        width: 100%;
        height: 420px;
        border: 0;
        filter: saturate(0.85) contrast(1.05);
    }

    /* ===== CTA BOTTOM SECTION ===== */
    .contact-cta {
        padding: 80px 0;
        background: var(--dark-bg);
        position: relative;
        overflow: hidden;
    }
    .contact-cta::before {
        content: '';
        position: absolute;
        top: -150px;
        right: -150px;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: rgba(76,175,80,0.06);
    }
    .contact-cta::after {
        content: '';
        position: absolute;
        bottom: -100px;
        left: -100px;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(139,195,74,0.05);
    }
    .cta-inner {
        position: relative;
        z-index: 2;
    }
    .cta-left h3 {
        color: #fff;
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 12px;
        line-height: 1.3;
    }
    .cta-left .cta-tagline {
        color: var(--accent);
        font-size: 1rem;
        font-weight: 500;
        font-style: italic;
        margin-bottom: 30px;
    }
    .cta-features {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }
    .cta-feat-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgba(255,255,255,0.8);
        font-size: 0.88rem;
    }
    .cta-feat-item i {
        color: var(--accent);
        font-size: 12px;
        min-width: 16px;
    }
    .cta-social {
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    .cta-social h6 {
        color: rgba(255,255,255,0.4);
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 14px;
    }
    .cta-social-links {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .cta-social-links a {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: rgba(255,255,255,0.07);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 16px;
        transition: all 0.3s;
        border: 1px solid rgba(255,255,255,0.08);
    }
    .cta-social-links a:hover {
        background: var(--primary);
        border-color: var(--primary);
        transform: translateY(-3px);
    }

    /* Brochure Card */
    .brochure-download {
        background: linear-gradient(135deg, var(--primary-darker) 0%, var(--primary-dark) 100%);
        border-radius: 20px;
        padding: 40px 35px;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .brochure-icon-wrap {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        position: relative;
    }
    .brochure-icon-wrap::after {
        content: '';
        position: absolute;
        top: -5px; left: -5px; right: -5px; bottom: -5px;
        border-radius: 50%;
        border: 2px dashed rgba(255,255,255,0.2);
        animation: spin 20s linear infinite;
    }
    @keyframes spin { 100% { transform: rotate(360deg); } }
    .brochure-icon-wrap i {
        font-size: 36px;
        color: #fff;
    }
    .brochure-download h5 {
        color: #fff;
        font-weight: 700;
        font-size: 1.15rem;
        margin-bottom: 8px;
    }
    .brochure-download p {
        color: rgba(255,255,255,0.6);
        font-size: 0.85rem;
        margin-bottom: 25px;
        line-height: 1.6;
    }
    .btn-download-brochure {
        background: #fff;
        color: var(--primary-dark);
        padding: 14px 35px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .btn-download-brochure:hover {
        background: var(--accent);
        color: var(--dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .contact-hero { height: 320px; }
        .contact-hero h1 { font-size: 2.2rem; }
        .quick-info-inner { grid-template-columns: 1fr; }
        .qi-item { border-right: 0; border-bottom: 1px solid #f0f0f0; }
        .qi-item:last-child { border-bottom: 0; }
        .contact-main { padding: 60px 0 50px; }
        .office-card { margin-bottom: 30px; }
        .contact-form-card { padding: 30px 25px; }
        .cta-features { grid-template-columns: 1fr; }
        .cta-left { margin-bottom: 40px; }
        .brochure-download { margin-top: 20px; }
    }
    @media (max-width: 768px) {
        .quick-info-inner { grid-template-columns: 1fr !important; gap: 15px; }
        .qi-item { padding: 20px 18px; }
    }
    @media (max-width: 575px) {
        .contact-hero h1 { font-size: 1.8rem; }
        .contact-section-header h2 { font-size: 1.8rem; }
        .office-card, .contact-form-card { padding: 25px 20px; }
        .cta-left h3 { font-size: 1.5rem; }
    }
    @media (max-width: 480px) {
        .contact-hero { height: 250px !important; }
        .contact-hero h1 { font-size: 1.4rem; }
        .contact-hero p { font-size: 0.82rem; }
        .qi-item { padding: 15px 14px; }
        .qi-item h6 { font-size: 1rem; }
        .qi-item p { font-size: 0.82rem; }
        .contact-form-card { padding: 25px 18px !important; }
        .contact-form-card h4 { font-size: 1.2rem; }
        .map-section iframe { height: 280px; }
    }
</style>
@endsection

@section('content')

<!-- HERO BANNER -->
<section class="contact-hero">
    <div class="hero-content">
        <div class="breadcrumb-nav">
            <a href="{{ url('/') }}">Home</a> <span>&nbsp;/&nbsp; Contact Us</span>
        </div>
        <div class="hero-leaf-divider">
            <span></span>
            <i class="fas fa-leaf"></i>
            <span></span>
        </div>
        <h1>Let&rsquo;s Build Your Green Vision</h1>
        <p>Connect with SR Greenscapes Pvt Ltd to design sustainable, functional and future-ready landscapes across India.</p>
    </div>
</section>



<!-- MAIN CONTACT: Office Details + Form -->
<section class="contact-main">
    <div class="container">
        <div class="contact-section-header">
            <div class="label-tag"><i class="fas fa-paper-plane"></i> Get In Touch</div>
            <h2>We'd Love to Hear From You</h2>
            <p>Have a project in mind? Fill out the form or reach us at our office — we're here to bring your green vision to life.</p>
        </div>

        <div class="row g-4">
            <!-- Left: Office Info -->
            <div class="col-lg-5">
                <div class="contact-landing-img">
                    <img loading="lazy" src="{{ asset('storage/banners/UzLsmhyoocKjP5FDbGYxHVVSVkxrJaVqcw3hrUIB.jpg') }}" alt="SR Greenscapes Office Interior">
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div class="col-lg-7">
                <div class="contact-form-card" id="contactForm">
                    <h4>Send Us a Message</h4>
                    <p class="form-intro">Fill in the details below and our team will get back to you within 24 hours.</p>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" style="border-radius:12px; border:0; background: #e8f5e9; color: var(--primary-dark);">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <label>Full Name <span class="required">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <label>Phone Number <span class="required">*</span></label>
                                    <input type="text" name="phone" class="form-control" placeholder="+91 XXXXX XXXXX" value="{{ old('phone') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <label>Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="your@email.com" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating-custom">
                                    <label>City</label>
                                    <input type="text" name="subject" class="form-control" placeholder="Your city" value="{{ old('subject') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating-custom">
                                    <label>Service Required <span class="required">*</span></label>
                                    <select name="subject" class="form-select" required>
                                        <option value="">— Select a Service —</option>
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
                            </div>
                            <div class="col-12">
                                <div class="form-floating-custom">
                                    <label>Your Message</label>
                                    <textarea name="details" class="form-control" rows="4" placeholder="Tell us about your project or requirements...">{{ old('details') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-submit-contact">
                                    <i class="fas fa-paper-plane"></i> Submit Request
                                </button>
                                <div class="form-secure-note">
                                    <i class="fas fa-lock"></i> Your information is secure and will not be shared.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- COLORED INFO BLOCKS -->
<section class="info-blocks-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="info-box" style="background:var(--primary);">
                    <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                    <h5>Registered Office</h5>
                    <p>Sy No. 32/40, Ground Floor, Jinnagara, Gangalu Main Road, Near Jinnagara Basaveshwara Temple, Hoskote Taluk, Bangalore - 562114</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box" style="background:#fff; color:var(--dark); box-shadow: 0 4px 20px rgba(0,0,0,0.05); border: 1px solid #eef0ee;">
                    <div class="icon" style="background:var(--light-green); color:var(--primary-dark);"><i class="fas fa-globe-asia"></i></div>
                    <h5 style="color:var(--dark);">Operational Presence</h5>
                    <p style="color:#555;">Headquartered in Bengaluru with pan-India project execution across residential, commercial, and institutional sectors.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box" style="background:var(--primary-dark);">
                    <div class="icon"><i class="fas fa-clock"></i></div>
                    <h5>Working Hours</h5>
                    <p>Mon &ndash; Sat: 9:00 AM &ndash; 6:00 PM<br>Sunday: By Appointment</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GOOGLE MAP -->
<section class="map-section">
    <div class="map-label"><i class="fas fa-map-marker-alt"></i> Our Location</div>
    @if(!empty($siteSettings['google_map_embed']))
        <iframe src="{{ $siteSettings['google_map_embed'] }}" allowfullscreen="" loading="lazy"></iframe>
    @else
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.0!2d77.7!3d13.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDAwJzAwLjAiTiA3N8KwNDInMDAuMCJF!5e0!3m2!1sen!2sin!4v1600000000000" allowfullscreen="" loading="lazy"></iframe>
    @endif
</section>

<!-- CTA BOTTOM SECTION -->
<section class="contact-cta">
    <div class="container cta-inner">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <div class="cta-left">
                    <h3>SR Greenscapes Pvt Ltd</h3>
                    <p class="cta-tagline">"Sowing Science, Growing Beauty"</p>
                    <div class="cta-features">
                        <div class="cta-feat-item"><i class="fas fa-check-circle"></i> Residential Landscaping</div>
                        <div class="cta-feat-item"><i class="fas fa-check-circle"></i> Commercial Projects</div>
                        <div class="cta-feat-item"><i class="fas fa-check-circle"></i> Vertical Gardens</div>
                        <div class="cta-feat-item"><i class="fas fa-check-circle"></i> Horticulture Consultancy</div>
                        <div class="cta-feat-item"><i class="fas fa-check-circle"></i> Nursery & Plant Supply</div>
                        <div class="cta-feat-item"><i class="fas fa-check-circle"></i> Maintenance & Care</div>
                    </div>
                    <div class="cta-social">
                        <h6>Follow Us On Social Media</h6>
                        <div class="cta-social-links">
                            <a href="https://www.facebook.com/profile.php?id=61579521119580" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/sr_greenscapes/?hl=en" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/company/sr-greenscapes-pvt-ltd/?viewAsMember=true" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://x.com/GreenscapesSr" target="_blank" title="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
                            <a href="https://www.pinterest.com/srgreenscapes/" target="_blank" title="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                            <a href="https://www.youtube.com/@srgreenscapes" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="https://wa.me/919845728507" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="brochure-download">
                    <div class="brochure-icon-wrap">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <h5>Download Our Brochure</h5>
                    <p>Get our complete company profile with service details, project portfolio, and pricing.</p>
                    @if(!empty($siteSettings['brochure_file']))
                        <a href="{{ asset('storage/' . $siteSettings['brochure_file']) }}" download class="btn-download-brochure">
                            <i class="fas fa-download"></i> Download PDF
                        </a>
                    @else
                        <a href="#" class="btn-download-brochure disabled" style="opacity:0.5;pointer-events:none;">
                            <i class="fas fa-download"></i> Coming Soon
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@section('cta')
<!-- Contact Page CTA — Reach Our Team -->
<section class="contact-cta-wrapper">
    <div class="container">
        <div class="contact-cta-section">
            <div class="contact-cta-overlay"></div>
            <div class="contact-cta-inner">

                <!-- Left: Company Info -->
                <div class="contact-cta-left">
                    <h2 class="contact-cta-heading">SR GREENSCAPES PVT LTD</h2>
                    <p style="color: var(--primary); font-size: 1rem; font-weight: 500; font-style: italic; margin-bottom: 18px; display: flex; align-items: center; gap: 8px;"><i class="fas fa-leaf"></i> Sowing Science, Growing Beauty</p>
                    <p class="contact-cta-desc">
                        Reach out to discuss your ideas and outdoor needs.<br>
                        We're here to help your garden thrive beautifully.
                    </p>
                </div>

                <!-- Right: Floating Form Card -->
                <div class="contact-cta-card">
                    <h4 class="contact-cta-card-title">Book Consultation</h4>
                    <p class="contact-cta-card-sub">Share your details and we'll respond with the right garden solution for you.</p>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="contact-cta">
                        <div class="contact-cta-row">
                            <input type="text" name="name" class="contact-cta-input" placeholder="Your Name *" required>
                            <input type="email" name="email" class="contact-cta-input" placeholder="Email Address (Optional)">
                        </div>
                        <div class="contact-cta-row">
                            <select name="subject" class="contact-cta-input" required>
                                <option value="">Select Service *</option>
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
                            <input type="text" name="phone" class="contact-cta-input" placeholder="Phone Number *" required>
                        </div>
                        <textarea name="details" class="contact-cta-input contact-cta-textarea" placeholder="Your message"></textarea>
                        <button type="submit" class="contact-cta-submit">SUBMIT</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    .contact-cta-wrapper {
        padding: 60px 0 80px;
        background: #f9fbf7;
    }
    .contact-cta-section {
        position: relative;
        background: url('{{ asset('storage/banners/ueaz16XcDCJsllA9ie8MX688BRmk319Eli32FS27.jpg') }}') center/cover no-repeat;
        padding: 70px 50px;
        overflow: hidden;
        border-radius: 30px;
        box-shadow: 0 20px 60px rgba(26, 58, 26, 0.25);
    }
    .contact-cta-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(15,30,15,0.85) 0%, rgba(15,30,15,0.6) 55%, rgba(15,30,15,0.25) 100%);
        border-radius: 30px;
    }
    .contact-cta-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }

    /* Left */
    .contact-cta-left { flex: 1; max-width: 460px; }
    .contact-cta-label {
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgba(255,255,255,0.55);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }
    .contact-cta-line {
        display: inline-block;
        height: 2px;
        width: 40px;
        background: var(--primary);
    }
    .contact-cta-heading {
        color: #fff;
        font-size: 2.4rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 18px;
    }
    .contact-cta-desc {
        color: rgba(255,255,255,0.6);
        font-size: 0.95rem;
        line-height: 1.75;
    }

    /* Right Card */
    .contact-cta-card {
        width: 420px;
        flex-shrink: 0;
        background: rgba(22, 42, 22, 0.92);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 30px 28px;
        border: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    .contact-cta-card-title {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 800;
        margin-bottom: 6px;
    }
    .contact-cta-card-sub {
        color: rgba(255,255,255,0.5);
        font-size: 0.8rem;
        margin-bottom: 20px;
        line-height: 1.5;
    }
    .contact-cta-row {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }
    .contact-cta-input {
        flex: 1;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 8px;
        padding: 11px 14px;
        color: #fff;
        font-size: 0.87rem;
        width: 100%;
        transition: border-color 0.2s;
        margin-bottom: 0;
    }
    .contact-cta-input::placeholder { color: rgba(255,255,255,0.35); }
    .contact-cta-input:focus {
        outline: none;
        border-color: var(--primary);
        background: rgba(255,255,255,0.1);
    }
    .contact-cta-input option { background: #1a2a1a; color: #fff; }
    .contact-cta-textarea {
        display: block;
        width: 100%;
        height: 90px;
        resize: vertical;
        margin-bottom: 14px;
        margin-top: 10px;
    }
    .contact-cta-submit {
        display: block;
        width: 100%;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 13px;
        font-weight: 800;
        font-size: 0.9rem;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .contact-cta-submit:hover {
        background: #3a6b1a;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(139,195,74,0.3);
    }
    @media (max-width: 991px) {
        .contact-cta-wrapper { padding: 40px 0 60px; }
        .contact-cta-section { padding: 40px 24px; border-radius: 24px; }
        .contact-cta-overlay { border-radius: 24px; }
        .contact-cta-inner { flex-direction: column; }
        .contact-cta-card { width: 100%; }
        .contact-cta-heading { font-size: 1.8rem; }
    }
</style>
@endsection
@endsection
