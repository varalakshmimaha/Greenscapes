<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $siteSettings['meta_title'] ?? 'SR Greenscapes Pvt Ltd' }}</title>
    <meta name="description" content="{{ $siteSettings['meta_description'] ?? '' }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #8BC34A; /* Brighter Lime Green from reference */
            --primary-dark: #689F38;
            --primary-darker: #1a2a1a;
            --accent: #8BC34A;
            --accent-light: #C5E1A5;
            --green-dark: #1a2a1a;
            --dark-bg: #1a2a1a;
            --cream: #f9fbf7;
            --light-green: #f1f8e9;
            --gray: #757575;
            --white: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        /* ===== NAVBAR ===== */
        .main-navbar {
            background: var(--dark-bg);
            padding: 0;
            z-index: 1050;
        }
        .main-navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-brand-custom {
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 12px 0;
        }
        .navbar-brand-custom .brand-icon {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }
        .navbar-brand-custom .brand-icon i {
            color: #fff;
            font-size: 18px;
        }
        .navbar-brand-custom .brand-text {
            color: #fff;
            font-weight: 700;
            font-size: 1.25rem;
            line-height: 1.2;
        }
        .navbar-brand-custom .brand-text small {
            display: block;
            font-size: 0.65rem;
            font-weight: 400;
            color: rgba(255,255,255,0.6);
            letter-spacing: 1px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            align-items: center;
            white-space: nowrap;
        }
        .nav-menu > li {
            position: relative;
        }
        .nav-menu > li > a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 18px 14px;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.3s;
        }
        .nav-menu > li > a:hover,
        .nav-menu > li > a.active {
            color: var(--accent);
        }
        .nav-menu .dropdown-menu-custom {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            min-width: 220px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-top: 3px solid var(--primary);
            z-index: 1060;
            white-space: normal;
        }
        .nav-menu > li:hover .dropdown-menu-custom {
            display: block;
        }
        .nav-menu .dropdown-menu-custom a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
        }
        .nav-menu .dropdown-menu-custom a:hover {
            background: var(--light-green);
            color: var(--primary-dark);
            padding-left: 25px;
        }

        .nav-right {
            display: flex;
            align-items: center;
        }
        .btn-appointment {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-appointment:hover {
            background: var(--accent);
            color: var(--dark);
        }

        /* Mobile Toggle */
        .nav-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }

        /* ===== GENERAL ===== */
        .section-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 10px;
        }
        .section-subtitle {
            color: var(--gray);
            font-size: 0.95rem;
            margin-bottom: 40px;
        }
        .about-label {
            color: var(--primary);
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-theme {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--primary);
            color: #fff;
            padding: 14px 28px;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            text-decoration: none !important;
            transition: var(--transition);
            border: none;
            box-shadow: 0 4px 15px rgba(139,195,74,0.3);
        }
        .btn-theme .btn-icon {
            width: 30px;
            height: 30px;
            background: #fff;
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: var(--transition);
        }
        .btn-theme:hover {
            background: var(--green-dark);
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .btn-theme:hover .btn-icon {
            background: var(--primary);
            color: #fff;
            transform: rotate(-45deg);
        }

        .btn-theme-white {
            background: #fff;
            color: var(--dark-bg);
        }
        .btn-theme-white .btn-icon {
            background: var(--primary);
            color: #fff;
        }
        .btn-theme-white:hover {
            background: var(--primary);
            color: #fff;
        }
        .btn-theme-white:hover .btn-icon {
            background: #fff;
            color: var(--primary);
        }

        /* ===== WHATSAPP ===== */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
            background: #25d366;
            color: #fff;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 4px 15px rgba(37,211,102,0.4);
            text-decoration: none;
            transition: transform 0.3s;
        }
        .whatsapp-float:hover {
            transform: scale(1.1);
            color: #fff;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--dark-bg);
            color: #fff;
            padding: 60px 0 20px;
        }
        .footer h5 {
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--accent);
            font-size: 1.1rem;
        }
        .footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer a:hover {
            color: var(--accent);
        }
        .footer-links li {
            margin-bottom: 10px;
        }
        .footer-links li a i {
            margin-right: 8px;
            color: var(--accent);
            font-size: 12px;
        }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: rgba(255,255,255,0.5);
        }
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            color: #fff;
            margin-right: 8px;
            transition: all 0.3s;
        }
        .social-links a:hover {
            background: var(--primary);
            color: #fff;
        }

        /* ===== FOOTER CTA — SPLIT CARD DESIGN ===== */
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
            min-height: 480px;
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
            background: linear-gradient(to bottom, rgba(0,0,0,0.05) 40%, rgba(0,0,0,0.65) 100%);
        }
        .cta-quote-overlay {
            position: absolute;
            bottom: 28px;
            left: 24px;
            right: 24px;
            z-index: 2;
            color: #fff;
        }
        .cta-quote-overlay blockquote {
            font-size: 1.05rem;
            font-weight: 700;
            line-height: 1.5;
            margin: 0 0 10px;
            font-style: italic;
        }
        .cta-quote-author {
            display: inline-block;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.35);
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
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
            .cta-img-panel { flex: 0 0 280px; }
            .cta-form-panel { padding: 32px 24px; }
            .cta-form-heading { font-size: 1.6rem; }
            .footer-cta-wrap { padding: 50px 0; }
        }
        @media (max-width: 575px) {
            .cta-split-card { border-radius: 18px; min-height: auto; }
            .cta-img-panel { flex: 0 0 200px; }
            .cta-form-panel { padding: 24px 18px; }
            .cta-form-heading { font-size: 1.3rem; }
            .footer-cta-wrap { padding: 30px 0; }
        }

        /* ===== TOP BAR ===== */
        .top-bar {
            background-color: #ffffff;
            border-bottom: 1px solid #e8ede9;
            padding: 10px 0;
            font-size: 0.85rem;
            color: #666;
            font-weight: 500;
        }
        .top-bar i {
            color: var(--primary);
            margin-right: 6px;
        }
        @media (max-width: 991px) {
            .top-bar .top-bar-inner {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .nav-toggle { display: block; }
            .nav-menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--dark-bg);
                z-index: 1050;
            }
            .nav-menu.show { display: flex; }
            .nav-menu > li > a { padding: 12px 20px; }
            .nav-right { display: none; }
        }

    </style>
    @yield('styles')
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container d-flex justify-content-between align-items-center top-bar-inner">
            <div class="top-bar-left">
                <i class="fas fa-phone-alt"></i> +91 9845728507
            </div>
            <div class="top-bar-center" style="color: var(--primary); font-weight: 700;">
                Welcome to SR Greenscapes Pvt Ltd
            </div>
            <div class="top-bar-right">
                <i class="fas fa-envelope"></i> srgreenscapes@gmail.com
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="main-navbar sticky-top">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand-custom">
                <div class="brand-icon"><i class="fas fa-leaf"></i></div>
                <div class="brand-text">
                    SR Greenscapes
                    <small>PVT LTD</small>
                </div>
            </a>

            <button class="nav-toggle" onclick="document.getElementById('navMenu').classList.toggle('show')">
                <i class="fas fa-bars"></i>
            </button>

            <ul class="nav-menu" id="navMenu">
                @if(isset($navMenus) && $navMenus->count())
                    @foreach($navMenus as $menu)
                        @if($menu->has_dropdown && $menu->children->count())
                            <li>
                                <a href="{{ $menu->url }}">{{ strtoupper($menu->title) }} <i class="fas fa-chevron-down" style="font-size:10px;"></i></a>
                                <div class="dropdown-menu-custom">
                                    @foreach($menu->children as $child)
                                        <a href="{{ $child->url }}">{{ $child->title }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li>
                                <a href="{{ $menu->url }}" class="{{ request()->is(ltrim($menu->url, '/') ?: '/') ? 'active' : '' }}">
                                    {{ strtoupper($menu->title) }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @else
                    <li><a href="/" class="active">HOME</a></li>
                    <li><a href="/about">ABOUT US</a></li>
                    <li><a href="/services">SERVICES</a></li>
                    <li><a href="/projects">PROJECTS</a></li>
                    <li><a href="/contact">CONTACT US</a></li>
                @endif
            </ul>

            <div class="nav-right">
                <a href="/contact" class="btn-appointment">GET APPOINTMENT</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')
    
    {{-- CTA Section — Can be overridden by child views --}}
    @hasSection('cta')
        @yield('cta')
    @else
        {{-- Fallback default global CTA --}}
        @unless(in_array(Route::currentRouteName(), ['about', 'home', 'services', 'projects', 'faqs', 'contact']))
        <section class="footer-cta-wrap">
            <div class="footer-cta-container">
                <div class="cta-split-card">

                    <!-- LEFT: Image + Testimonial -->
                    <div class="cta-img-panel">
                        <img src="{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}" alt="SR Greenscapes Landscaping">
                        <div class="cta-quote-overlay">
                            <blockquote>"They made my space sparkle!<br>Highly professional and fast service"</blockquote>
                            <span class="cta-quote-author">SR Greenscapes Client</span>
                        </div>
                    </div>

                    <!-- RIGHT: Form -->
                    <div class="cta-form-panel">
                        <span class="cta-contact-label">● Contact Us</span>
                        <h2 class="cta-form-heading">We're Here to Help!</h2>

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="source" value="cta-form">
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
                                    <textarea name="message" class="form-control" rows="3" placeholder="Message"></textarea>
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
        @endunless
    @endif


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">

                <!-- Column 1: Logo, About & Address -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <div style="width:42px;height:42px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;margin-right:10px;">
                            <i class="fas fa-leaf text-white"></i>
                        </div>
                        <div>
                            <strong class="text-white" style="font-size:1.1rem;">SR Greenscapes</strong><br>
                            <small style="color:rgba(255,255,255,0.5);font-size:0.7rem;">PVT LTD</small>
                        </div>
                    </div>
                    <p style="color:rgba(255,255,255,0.55);font-size:13px;line-height:1.8;margin-bottom:18px;">Creating High-Performance, Science-Driven Sustainable Landscapes. Based in Bengaluru with Pan-India Project Execution.</p>
                    <p style="color:rgba(255,255,255,0.6);font-size:13px;line-height:1.9;margin-bottom:0;">
                        <i class="fas fa-map-marker-alt me-2" style="color:var(--accent);font-size:12px;"></i>
                        {{ $siteSettings['address'] ?? 'Sy No. 32/40, Ground Floor, Jinnagara, Gangalu Main Road, Hoskote Taluk, Bangalore - 562114' }}
                    </p>
                </div>

                <!-- Column 2: Quick Links (two columns) + Gallery -->
                <div class="col-lg-5 col-md-6 mb-4">
                    <div class="row">
                        <div class="col-6">
                            <h5>Quick Links</h5>
                            <ul class="list-unstyled footer-links">
                                <li><a href="/"><i class="fas fa-chevron-right"></i> Home</a></li>
                                <li><a href="/about"><i class="fas fa-chevron-right"></i> About Us</a></li>
                                <li><a href="/services"><i class="fas fa-chevron-right"></i> Services</a></li>
                                <li><a href="/projects"><i class="fas fa-chevron-right"></i> Projects</a></li>
                                <li><a href="/gallery"><i class="fas fa-chevron-right"></i> Gallery</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h5>Explore</h5>
                            <ul class="list-unstyled footer-links">
                                <li><a href="/blogs"><i class="fas fa-chevron-right"></i> Blogs</a></li>
                                <li><a href="/videos"><i class="fas fa-chevron-right"></i> Videos</a></li>
                                <li><a href="/testimonials"><i class="fas fa-chevron-right"></i> Testimonials</a></li>
                                <li><a href="/faqs"><i class="fas fa-chevron-right"></i> FAQ's</a></li>
                                <li><a href="/contact"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Gallery Thumbnails --}}
                    @if(isset($footerGallery) && $footerGallery->count())
                    <div class="footer-gallery-label mt-3">
                        <small style="color:var(--accent);font-weight:600;font-size:0.75rem;text-transform:uppercase;letter-spacing:1px;">
                            <i class="fas fa-images me-1"></i> Gallery
                        </small>
                        <a href="/gallery" style="color:rgba(255,255,255,0.5);font-size:0.72rem;text-decoration:none;">View All <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></a>
                    </div>
                    <div class="footer-gallery-grid">
                        @foreach($footerGallery as $fg)
                        <a href="/gallery" class="footer-gallery-thumb">
                            <img src="{{ asset('storage/' . $fg->image) }}" alt="{{ $fg->title ?? 'Gallery' }}">
                            <div class="footer-gallery-hover"><i class="fas fa-search-plus"></i></div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Column 3: Contact Us & Social -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled footer-contact-list">
                        <li>
                            <div class="footer-contact-icon"><i class="fas fa-phone-alt"></i></div>
                            <div>
                                <span>{{ $siteSettings['phone'] ?? '+91 9845728507' }}</span><br>
                                <span>+91 9113620609</span>
                            </div>
                        </li>
                        <li>
                            <div class="footer-contact-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <span>{{ $siteSettings['email'] ?? 'srgreenscapes@gmail.com' }}</span><br>
                                <span>mdsrgreenscapes@gmail.com</span>
                            </div>
                        </li>
                    </ul>

                    <h6 style="color:var(--accent);font-size:0.85rem;font-weight:600;margin-top:22px;margin-bottom:12px;">Follow Us</h6>
                    <div class="footer-social-icons">
                        <a href="https://www.facebook.com/profile.php?id=61579521119580" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/sr_greenscapes/?hl=en" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://x.com/GreenscapesSr" target="_blank" title="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
                        <a href="https://www.linkedin.com/company/sr-greenscapes-pvt-ltd/" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.youtube.com/@srgreenscapes" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>

                    {{-- Recent Blogs --}}
                    @if(isset($footerBlogs) && $footerBlogs->count())
                    <h6 style="color:var(--accent);font-size:0.85rem;font-weight:600;margin-top:22px;margin-bottom:12px;">Recent Blogs</h6>
                    <div class="footer-blog-list">
                        @foreach($footerBlogs as $fb)
                        <a href="{{ route('blog.detail', $fb->slug) }}" class="footer-blog-item">
                            <div class="footer-blog-img">
                                @if($fb->image)
                                    <img src="{{ asset('storage/' . $fb->image) }}" alt="{{ $fb->title }}">
                                @else
                                    <div class="footer-blog-img-placeholder"><i class="fas fa-blog"></i></div>
                                @endif
                            </div>
                            <div class="footer-blog-info">
                                <h6>{{ Str::limit($fb->title, 40) }}</h6>
                                <small><i class="fas fa-calendar-alt me-1"></i> {{ $fb->published_at ? $fb->published_at->format('M d, Y') : '' }}</small>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>

            </div>

            <div class="footer-bottom">
                <p class="mb-0">{{ $siteSettings['copyright_text'] ?? '© 2025 SR Greenscapes Pvt Ltd. All rights reserved.' }}</p>
            </div>
        </div>
    </footer>

    <style>
        /* Footer Contact List */
        .footer-contact-list { padding: 0; }
        .footer-contact-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
            color: rgba(255,255,255,0.65);
            font-size: 13px;
            line-height: 1.7;
        }
        .footer-contact-icon {
            width: 34px;
            height: 34px;
            min-width: 34px;
            background: rgba(139,195,74,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 13px;
        }

        /* Footer Social */
        .footer-social-icons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .footer-social-icons a {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 13px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .footer-social-icons a:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-4px);
            border-color: var(--primary);
        }

        /* Footer Blog List */
        .footer-blog-list { display: flex; flex-direction: column; gap: 12px; }
        .footer-blog-item {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            padding: 8px;
            border-radius: 10px;
            transition: background 0.3s;
        }
        .footer-blog-item:hover { background: rgba(255,255,255,0.05); }
        .footer-blog-img {
            width: 60px;
            height: 52px;
            min-width: 60px;
            border-radius: 8px;
            overflow: hidden;
        }
        .footer-blog-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .footer-blog-img-placeholder {
            width: 100%;
            height: 100%;
            background: rgba(139,195,74,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 16px;
        }
        .footer-blog-info h6 {
            color: rgba(255,255,255,0.85);
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 4px;
            line-height: 1.4;
        }
        .footer-blog-item:hover .footer-blog-info h6 { color: var(--accent); }
        .footer-blog-info small {
            color: rgba(255,255,255,0.4);
            font-size: 0.7rem;
        }
        .footer-blog-info small i { color: var(--accent); }

        /* Footer Gallery Grid */
        .footer-gallery-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .footer-gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }
        .footer-gallery-thumb {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            height: 65px;
            display: block;
        }
        .footer-gallery-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .footer-gallery-thumb:hover img { transform: scale(1.1); }
        .footer-gallery-hover {
            position: absolute;
            inset: 0;
            background: rgba(139,195,74,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .footer-gallery-thumb:hover .footer-gallery-hover { opacity: 1; }

        /* ===== GLOBAL MOBILE RESPONSIVE ===== */
        @media (max-width: 991px) {
            .footer { padding: 40px 0 15px; }
            .footer h5 { font-size: 1rem; margin-bottom: 15px; }
            .footer-contact-list li { font-size: 12px; }
            .footer-bottom { margin-top: 25px; padding-top: 15px; }
        }
        @media (max-width: 767px) {
            .footer-gallery-grid { grid-template-columns: repeat(3, 1fr); }
            .footer-gallery-thumb { height: 55px; }
            .footer-blog-img { width: 50px; height: 44px; min-width: 50px; }
            .footer-blog-info h6 { font-size: 0.78rem; }
            .footer-social-icons a { width: 32px; height: 32px; font-size: 12px; }
            .whatsapp-float { width: 48px; height: 48px; font-size: 22px; bottom: 15px; right: 15px; }
        }
        @media (max-width: 575px) {
            .footer { padding: 30px 0 10px; }
            .footer h5 { font-size: 0.95rem; }
            .footer-contact-icon { width: 30px; height: 30px; min-width: 30px; font-size: 11px; }
            .footer-contact-list li { gap: 8px; margin-bottom: 12px; }
        }

        /* ===== HERO SECTIONS GLOBAL MOBILE ===== */
        @media (max-width: 767px) {
            .testi-hero, .projects-hero, .blogs-hero, .videos-hero, .gallery-hero,
            .services-hero, .contact-hero, .faq-hero, .about-hero { height: 220px; }
            .testi-hero-content h1, .projects-hero-content h1, .blogs-hero-content h1,
            .videos-hero-content h1, .gallery-hero-content h1 { font-size: 2rem; }
            .testi-hero-content p, .blogs-hero-content p, .videos-hero-content p,
            .gallery-hero-content p { font-size: 0.9rem; }
        }
        @media (max-width: 575px) {
            .testi-hero, .projects-hero, .blogs-hero, .videos-hero, .gallery-hero,
            .services-hero, .contact-hero, .faq-hero, .about-hero { height: 180px; }
            .testi-hero-content h1, .projects-hero-content h1, .blogs-hero-content h1,
            .videos-hero-content h1, .gallery-hero-content h1 { font-size: 1.6rem; }
        }

        /* ===== NAVBAR MOBILE ===== */
        @media (max-width: 575px) {
            .top-bar { font-size: 0.75rem; padding: 6px 0; }
            .navbar-custom { padding: 8px 0; }
            .navbar-custom .brand-text strong { font-size: 0.95rem; }
            .btn-appointment { padding: 6px 14px; font-size: 11px; }
        }

        /* ===== CTA SECTIONS MOBILE ===== */
        @media (max-width: 575px) {
            .proj-cta-wrapper, .svc-cta-wrapper, .faq-cta-wrapper, .contact-cta-wrapper { padding: 30px 0 40px; }
            .proj-cta-section, .svc-cta-section, .faq-cta-section, .contact-cta-section { padding: 25px 16px; border-radius: 18px; }
            .proj-cta-overlay, .svc-cta-overlay, .faq-cta-overlay, .contact-cta-overlay { border-radius: 18px; }
            .proj-cta-company, .svc-cta-company, .faq-cta-company, .contact-cta-company { font-size: 1.1rem; }
            .proj-cta-card, .svc-cta-card, .faq-cta-card, .contact-cta-card { padding: 20px 16px; }
            .proj-cta-card-title, .svc-cta-card-title, .faq-cta-card-title, .contact-cta-card-title { font-size: 1.1rem; }
            .proj-cta-row, .svc-cta-row, .faq-cta-row, .contact-cta-row { flex-direction: column; gap: 8px; }
        }
    </style>

    <!-- WhatsApp Float -->
    <a href="https://wa.me/919845728507" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
