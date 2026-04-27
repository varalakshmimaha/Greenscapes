<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $siteSettings['meta_title'] ?? 'SR Greenscapes Pvt Ltd' }}</title>
    <meta name="description" content="{{ $siteSettings['meta_description'] ?? '' }}">

    <!-- Preconnect for faster loading -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

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

        html { font-size: 17px; }

        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        /* ===== NAVBAR ===== */
        .main-navbar {
            background: #1e3838;
            padding: 8px 0;
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
        .navbar-brand-custom .brand-logo {
            height: 80px;
            width: 80px;
            margin-right: 10px;
            object-fit: cover;
            border-radius: 50%;
            background: #fff;
            padding: 4px;
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
            -ms-interpolation-mode: bicubic;
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
            color: #fff;
            text-decoration: none;
            padding: 18px 16px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.6px;
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
            min-width: 230px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-top: 3px solid var(--primary);
            z-index: 1060;
            white-space: normal;
            padding: 6px 0;
            border-radius: 0 0 8px 8px;
        }
        .nav-menu > li:hover > .dropdown-menu-custom {
            display: block;
        }
        .nav-menu .dropdown-menu-custom .dropdown-item-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            position: relative;
        }
        .nav-menu .dropdown-menu-custom a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
        }
        .nav-menu .dropdown-menu-custom a:hover,
        .nav-menu .dropdown-menu-custom .dropdown-item-custom:hover {
            background: var(--light-green);
            color: var(--primary-dark);
        }
        /* Nested sub-dropdown (flyout) */
        .nav-menu .dropdown-submenu {
            position: relative;
        }
        .nav-menu .dropdown-submenu .dropdown-submenu-menu {
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            background: #fff;
            min-width: 220px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-left: 3px solid var(--primary);
            z-index: 1070;
            padding: 6px 0;
            border-radius: 0 8px 8px 0;
        }
        .nav-menu .dropdown-submenu:hover > .dropdown-submenu-menu {
            display: block;
        }
        .nav-menu .dropdown-submenu-menu a {
            display: block;
            padding: 9px 20px;
            color: #333;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.3s;
        }
        .nav-menu .dropdown-submenu-menu a:hover {
            background: var(--light-green);
            color: var(--primary-dark);
            padding-left: 25px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .nav-social-icons {
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .nav-social-icons a {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 12px;
            transition: all 0.3s;
            border: 1px solid rgba(255,255,255,0.15);
        }
        .nav-social-icons a:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            transform: translateY(-2px);
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
        /* Call Float Button */
        .call-float {
            position: fixed;
            bottom: 95px;
            right: 30px;
            z-index: 999;
            background: #1976D2;
            color: #fff;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 4px 15px rgba(25,118,210,0.45);
            text-decoration: none;
            transition: transform 0.3s;
        }
        .call-float:hover {
            transform: scale(1.1);
            color: #fff;
        }
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

        /* ===== UNIFORM SELECT STYLING (all CTA forms) ===== */
        select[class*="-input"] {
            -webkit-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%23aaa' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
            padding-right: 32px;
            cursor: pointer;
            outline: none;
            -webkit-tap-highlight-color: transparent;
        }
        select[class*="-input"]:focus,
        select[class*="-input"]:focus-visible {
            outline: none;
        }
        /* Force exact match with sibling inputs — higher specificity overrides browser UA */
        select.gcta-input {
            background-color: #ffffff;
            color: #333;
            border: 1.5px solid #d9d9d9;
        }
        select.home-cta-input {
            background-color: rgba(255,255,255,0.07);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.12);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3E%3C/svg%3E");
        }
        select.svc-cta-input,
        select.about-cta-input,
        select.proc-cta-input,
        select.faq-cta-input,
        select.proj-cta-input {
            background-color: #fafafa;
            color: #333;
            border: 1px solid #e0e0e0;
        }
        select.contact-cta-input {
            background-color: rgba(255,255,255,0.07);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.12);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3E%3C/svg%3E");
        }

        /* ===== FOOTER ===== */
        .footer {
            background: #1e3838;
            color: #fff;
            padding: 64px 0 0;
        }

        /* CSS Grid layout — Logo wider, 3 equal nav columns */
        .footer-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr 1fr;
            column-gap: 48px;
            gap: 0 48px;
            align-items: start;
            padding: 0 40px 48px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        /* Every column: left-aligned, flex column */
        .footer-col {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
        }
        /* Extra 8px on logo column → effective gap to Quick Links = 48+8 = 56px */
        .footer-col-brand { padding-right: 8px; }

        .footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer a:hover { color: var(--accent); }

        /* --- Column title --- */
        .footer-col-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1.4px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            position: relative;
            width: 100%;
        }
        .footer-col-title::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 32px;
            height: 2px;
            background: var(--accent);
            border-radius: 2px;
        }

        /* --- Brand block --- */
        .footer-brand-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }
        .footer-brand-logo {
            width: 56px; height: 56px; min-width: 56px;
            border-radius: 50%;
            object-fit: cover;
            background: #fff;
            padding: 3px;
        }
        .footer-brand-name {
            display: flex;
            flex-direction: column;
            line-height: 1.25;
        }
        .footer-brand-name strong {
            font-size: 1.1rem; font-weight: 800; color: #fff;
        }
        .footer-brand-name span {
            font-size: 0.72rem; font-weight: 400;
            color: rgba(255,255,255,0.45);
            letter-spacing: 1.5px; text-transform: uppercase;
        }
        .footer-about-text {
            color: rgba(255,255,255,0.58);
            font-size: 0.83rem;
            line-height: 1.75;
            margin-bottom: 16px;
            text-align: left;
        }
        .footer-address {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: rgba(255,255,255,0.5);
            font-size: 0.79rem;
            line-height: 1.65;
            margin-bottom: 16px;
        }
        .footer-address i {
            color: var(--accent); margin-top: 3px; flex-shrink: 0; font-size: 12px;
        }
        .footer-tagline {
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--accent);
            font-size: 0.79rem;
            font-weight: 600;
            font-style: italic;
        }

        /* --- Links columns --- */
        .footer-links {
            list-style: none;
            padding: 0; margin: 0;
            width: 100%;
        }
        .footer-links li { margin-bottom: 10px; }
        .footer-links li a {
            font-size: 0.84rem;
            color: rgba(255,255,255,0.62);
            display: flex;
            align-items: center;
            gap: 7px;
            transition: all 0.25s;
        }
        .footer-links li a:hover {
            color: var(--accent);
            padding-left: 3px;
        }
        .footer-links li a i {
            color: var(--accent); font-size: 10px; flex-shrink: 0;
        }

        /* --- Contact column --- */
        .footer-contact-list {
            list-style: none;
            padding: 0; margin: 0;
            width: 100%;
        }
        .footer-contact-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
        }
        .footer-contact-icon {
            width: 36px; height: 36px; min-width: 36px;
            background: rgba(139,195,74,0.12);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--accent); font-size: 13px;
            margin-top: 2px;
        }
        .footer-contact-detail {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .footer-contact-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.9px;
            color: var(--accent);
            margin-bottom: 2px;
        }
        .footer-contact-detail a,
        .footer-contact-detail span {
            display: block;
            color: rgba(255,255,255,0.65);
            font-size: 0.83rem;
            line-height: 1.5;
        }
        .footer-contact-detail a:hover { color: var(--accent); }

        /* --- Social --- */
        .footer-social-wrap {
            margin-top: 6px;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,0.08);
            width: 100%;
        }
        .footer-social-label {
            display: block;
            font-size: 0.68rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.9px;
            color: rgba(255,255,255,0.4);
            margin-bottom: 10px;
        }
        .footer-social-icons {
            display: flex; gap: 8px; flex-wrap: wrap;
        }
        .footer-social-icons a {
            width: 34px; height: 34px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.75);
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .footer-social-icons a:hover {
            background: var(--primary); border-color: var(--primary);
            color: #fff; transform: translateY(-3px);
        }

        /* --- Bottom bar --- */
        .footer-bottom {
            padding: 18px 0;
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.4);
        }
        .footer-bottom-links {
            margin-top: 5px;
        }
        .footer-bottom-links a {
            color: rgba(255,255,255,0.38);
            font-size: 12px; text-decoration: none; transition: color 0.3s;
        }
        .footer-bottom-links a:hover { color: var(--accent); }
        .footer-bottom-links span { color: rgba(255,255,255,0.2); margin: 0 8px; }

        /* --- Responsive --- */
        @media (max-width: 991px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 36px 32px;
                padding: 0 0 40px;
            }
            /* Natural flow: Logo|Quick Links row1 · Resources|Get In Touch row2 */
            .footer-col-brand, .footer-col-contact { grid-column: auto; grid-row: auto; }
        }
        @media (max-width: 575px) {
            .footer { padding: 40px 0 0; }
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 28px;
                padding: 0 0 32px;
            }
            .footer-brand-logo { width: 46px; height: 46px; min-width: 46px; }
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
            .nav-menu .dropdown-menu-custom {
                position: static;
                box-shadow: none;
                border-top: none;
                background: rgba(255,255,255,0.05);
                display: none;
            }
            .nav-menu .dropdown-menu-custom a {
                color: rgba(255,255,255,0.7);
                padding: 8px 30px;
                font-size: 13px;
            }
            .nav-menu .dropdown-menu-custom a:hover {
                background: rgba(255,255,255,0.1);
                color: var(--primary);
                padding-left: 35px;
            }
            .nav-menu > li.dropdown-open > .dropdown-menu-custom {
                display: block;
            }
            .nav-menu .dropdown-menu-custom .dropdown-item-custom {
                color: rgba(255,255,255,0.7);
                padding: 8px 30px;
                font-size: 13px;
                cursor: pointer;
            }
            .nav-menu .dropdown-menu-custom .dropdown-item-custom:hover {
                background: rgba(255,255,255,0.1);
                color: var(--primary);
            }
            .nav-menu .dropdown-submenu .dropdown-submenu-menu {
                position: static;
                box-shadow: none;
                border-left: none;
                background: rgba(255,255,255,0.03);
                display: none;
                padding: 0;
                border-radius: 0;
            }
            .nav-menu .dropdown-submenu .dropdown-submenu-menu a {
                color: rgba(255,255,255,0.6);
                padding: 7px 45px;
                font-size: 12px;
            }
            .nav-menu .dropdown-submenu.submenu-open > .dropdown-submenu-menu {
                display: block;
            }
            .nav-right { display: none; }
        }

        /* ===== MOBILE RESPONSIVE ===== */
        @media (max-width: 575px) {
            .top-bar .top-bar-inner { flex-direction: column; gap: 4px; text-align: center; font-size: 0.75rem; }
            .top-bar-left, .top-bar-right { font-size: 0.72rem; }
            .top-bar-center { font-size: 0.75rem; }
            .navbar-brand-custom .brand-text { font-size: 1rem; }
            .navbar-brand-custom .brand-logo { height: 60px; }
            .whatsapp-float { bottom: 20px; right: 15px; width: 48px; height: 48px; font-size: 24px; }
            .btn-theme { padding: 12px 22px; font-size: 12px; }
            .section-title { font-size: 1.4rem; }
            .section-subtitle { font-size: 0.85rem; margin-bottom: 25px; }
        }
        @media (max-width: 400px) {
            .top-bar { padding: 6px 0; }
            .top-bar-left, .top-bar-right { font-size: 0.68rem; word-break: break-all; }
            .navbar-brand-custom .brand-text { font-size: 0.9rem; }
            .footer-bottom { font-size: 12px; }
        }

    </style>
    @yield('styles')

    {{-- Google Analytics 4 --}}
    @if(!empty($siteSettings['google_analytics_id']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $siteSettings['google_analytics_id'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $siteSettings['google_analytics_id'] }}');
    </script>
    @endif
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container d-flex justify-content-between align-items-center top-bar-inner">
            <div class="top-bar-left">
                <i class="fas fa-phone-alt"></i> +91 6361115701
            </div>
            <div class="top-bar-center" style="color: var(--primary); font-weight: 700;">
                Welcome to SR Greenscapes Pvt Ltd
            </div>
            <div class="top-bar-right">
                <i class="fas fa-envelope"></i> info@srgreenscapes.com
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="main-navbar sticky-top">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand-custom">
                @if(!empty($siteSettings['site_logo']))
                    <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] ?? 'Logo' }}" class="brand-logo">
                @else
                    <div class="brand-text">
                        {{ $siteSettings['site_name'] ?? 'SR Greenscapes' }}
                    </div>
                @endif
            </a>

            <button class="nav-toggle" onclick="document.getElementById('navMenu').classList.toggle('show')">
                <i class="fas fa-bars"></i>
            </button>

            <ul class="nav-menu" id="navMenu">
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">HOME</a></li>
                <li>
                    <a href="/about" class="{{ request()->is('about*') ? 'active' : '' }}">ABOUT US <i class="fas fa-chevron-down" style="font-size:10px;"></i></a>
                    <div class="dropdown-menu-custom">
                        <a href="/about">Our Story</a>
                        <a href="/about#team">Our Team</a>
                        <a href="/about#mission">Mission & Vision</a>
                        <a href="/about#values">Our Values</a>
                    </div>
                </li>
                <li>
                    <a href="/services" class="{{ request()->is('services*') ? 'active' : '' }}">SERVICES <i class="fas fa-chevron-down" style="font-size:10px;"></i></a>
                    <div class="dropdown-menu-custom">
                        @if(isset($navServiceCategories) && $navServiceCategories->count())
                            @foreach($navServiceCategories as $cat)
                                @if($cat->service)
                                    <a href="{{ route('service.detail', $cat->service->slug) }}">{{ $cat->name }}</a>
                                @endif
                            @endforeach
                        @else
                            <a href="/services">All Services</a>
                        @endif
                    </div>
                </li>
                <li><a href="/projects" class="{{ request()->is('projects*') ? 'active' : '' }}">PROJECTS</a></li>
                <li><a href="/process" class="{{ request()->is('process*') ? 'active' : '' }}">OUR PROCESS</a></li>
                <li>
                    <a href="#" class="{{ request()->is('blogs*') || request()->is('gallery*') || request()->is('videos*') || request()->is('faqs') ? 'active' : '' }}">RESOURCES <i class="fas fa-chevron-down" style="font-size:10px;"></i></a>
                    <div class="dropdown-menu-custom">
                        <a href="/blogs">Blog</a>
                        <a href="/gallery">Gallery</a>
                        <a href="/videos">Videos</a>
                        <a href="/faqs">FAQ's</a>
                    </div>
                </li>
                <li><a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">CONTACTS</a></li>
            </ul>

            <div class="nav-right">
                <div class="nav-social-icons">
                    <a href="https://www.facebook.com/profile.php?id=61579521119580" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/sr_greenscapes/?hl=en" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://x.com/GreenscapesSr" target="_blank" title="X"><i class="fab fa-x-twitter"></i></a>
                    <a href="https://www.linkedin.com/company/sr-greenscapes-pvt-ltd/" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://www.youtube.com/@srgreenscapes" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
                @if(!empty($siteSettings['brochure_file']))
                    <a href="{{ asset('storage/' . $siteSettings['brochure_file']) }}" download class="btn-appointment">Brochure</a>
                @else
                    <a href="/contact" class="btn-appointment">Brochure</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')
    
    @hasSection('cta')
        @yield('cta')
    @else
    {{-- Default CTA — shown on pages without a custom CTA section --}}
    <section class="gcta-wrapper">
        <div class="container">
            <div class="gcta-section">
                <div class="gcta-overlay"></div>
                <div class="gcta-inner">
                    <div class="gcta-left">
                        <p class="gcta-eyebrow"><i class="fas fa-leaf"></i> Get In Touch</p>
                        <h2 class="gcta-company">SR Greenscapes Pvt Ltd</h2>
                        <p class="gcta-tagline"><i class="fas fa-quote-left"></i> Sowing Science, Growing Beauty</p>
                        <p class="gcta-desc">Ready to transform your space? Our landscape experts are here to bring your vision to life — scientifically, sustainably, and beautifully.</p>
                        <ul class="gcta-points">
                            <li><i class="fas fa-check-circle"></i> Free site consultation</li>
                            <li><i class="fas fa-check-circle"></i> Science-driven design</li>
                            <li><i class="fas fa-check-circle"></i> Pan-India execution</li>
                        </ul>
                    </div>
                    <div class="gcta-card">
                        <h4 class="gcta-card-title">Book a Consultation</h4>
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="source" value="default-cta">
                            <div class="gcta-row">
                                <input type="text" name="name" class="gcta-input" placeholder="Your Name *" required>
                                <input type="text" name="phone" class="gcta-input" placeholder="Phone *" required>
                            </div>
                            <select name="subject" class="gcta-input" style="margin-bottom:10px;">
                                <option value="">Select Service</option>
                                <option>Landscape Design & Execution</option>
                                <option>Garden Maintenance</option>
                                <option>Nursery & Plant Supply</option>
                                <option>Horticulture Consultancy</option>
                                <option>Event Styling</option>
                                <option>Others</option>
                            </select>
                            <textarea name="message" class="gcta-input gcta-textarea" placeholder="Tell us about your project..."></textarea>
                            <button type="submit" class="gcta-submit"><i class="fas fa-calendar-check"></i> BOOK CONSULTATION</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .gcta-wrapper { padding: 60px 0 80px; background: #f5f9f2; }
        .gcta-section {
            position: relative;
            background: url('{{ asset('storage/banners/UzLsmhyoocKjP5FDbGYxHVVSVkxrJaVqcw3hrUIB.jpg') }}') center/cover no-repeat;
            padding: 60px 50px; overflow: hidden; border-radius: 30px;
            box-shadow: 0 20px 60px rgba(26,58,26,0.25);
        }
        .gcta-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to right, rgba(15,30,15,0.88) 0%, rgba(15,30,15,0.62) 55%, rgba(15,30,15,0.35) 100%);
            border-radius: 30px;
        }
        .gcta-inner {
            position: relative; z-index: 2;
            display: flex; align-items: center; justify-content: space-between; gap: 40px;
        }
        .gcta-left { flex: 1; max-width: 480px; }
        .gcta-eyebrow {
            display: inline-flex; align-items: center; gap: 7px;
            background: rgba(139,195,74,0.18); color: var(--primary);
            padding: 5px 16px; border-radius: 50px;
            font-size: 0.76rem; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; margin-bottom: 16px;
        }
        .gcta-company { color: #fff; font-size: 1.9rem; font-weight: 900; letter-spacing: 1px; margin-bottom: 10px; line-height: 1.2; }
        .gcta-tagline { color: var(--accent); font-size: 0.95rem; font-weight: 500; font-style: italic; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
        .gcta-tagline i { font-size: 0.78rem; opacity: 0.7; }
        .gcta-desc { color: rgba(255,255,255,0.62); font-size: 0.92rem; line-height: 1.78; margin-bottom: 22px; }
        .gcta-points { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 9px; }
        .gcta-points li { color: rgba(255,255,255,0.82); font-size: 0.87rem; display: flex; align-items: center; gap: 9px; }
        .gcta-points li i { color: var(--primary); font-size: 0.8rem; flex-shrink: 0; }
        .gcta-card { width: 420px; flex-shrink: 0; background: rgba(255,255,255,0.97); border-radius: 14px; padding: 32px 28px; box-shadow: 0 15px 40px rgba(0,0,0,0.22); }
        .gcta-card-title { font-weight: 800; color: #1a3a1a; margin-bottom: 20px; font-size: 1.3rem; }
        .gcta-row { display: flex; gap: 10px; margin-bottom: 10px; }
        .gcta-input { flex: 1; border: 1.5px solid #d9d9d9; border-radius: 8px; padding: 10px 13px; font-size: 0.83rem; background: #ffffff; width: 100%; transition: border-color 0.2s; color: #333; }
        .gcta-input::placeholder { color: #aaa; }
        .gcta-input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(139,195,74,0.15); }
        .gcta-textarea { display: block; width: 100%; height: 78px; resize: none; margin-bottom: 12px; }
        .gcta-submit { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; background: var(--primary); color: #fff; border: none; border-radius: 8px; padding: 13px; font-weight: 800; font-size: 0.84rem; letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; transition: all 0.3s; }
        .gcta-submit:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(139,195,74,0.35); }
        @media (max-width: 991px) {
            .gcta-wrapper { padding: 40px 0 60px; }
            .gcta-section { padding: 40px 28px; border-radius: 24px; }
            .gcta-overlay { border-radius: 24px; }
            .gcta-inner { flex-direction: column; gap: 32px; }
            .gcta-left { max-width: 100%; }
            .gcta-card { width: 100%; }
            .gcta-company { font-size: 1.5rem; }
        }
        @media (max-width: 575px) {
            .gcta-wrapper { padding: 25px 0 40px; }
            .gcta-section { padding: 28px 18px; border-radius: 18px; }
            .gcta-overlay { border-radius: 18px; }
            .gcta-company { font-size: 1.2rem; }
            .gcta-card { padding: 22px 18px; }
            .gcta-card-title { font-size: 1.1rem; }
            .gcta-row { flex-direction: column; gap: 8px; }
        }
    </style>
    @endif

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">

                <!-- Col 1: Brand + About -->
                <div class="footer-col footer-col-brand">
                    <div class="footer-brand-wrap">
                        @if(!empty($siteSettings['site_logo']))
                            <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] ?? 'Logo' }}" class="footer-brand-logo">
                        @endif
                        <div class="footer-brand-name">
                            <strong>SR Greenscapes</strong>
                            <span>Pvt Ltd</span>
                        </div>
                    </div>
                    <p class="footer-about-text">Creating High-Performance, Science-Driven Sustainable Landscapes. Based in Bengaluru with Pan-India Project Execution.</p>
                    <div class="footer-address">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $siteSettings['address'] ?? 'Sy No. 32/40, Ground Floor, Jinnagara, Gangalu Main Road, Hoskote Taluk, Bangalore - 562114' }}</span>
                    </div>
                    <div class="footer-tagline">
                        <i class="fas fa-leaf"></i> Sowing Science, Growing Beauty
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div class="footer-col">
                    <h5 class="footer-col-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="/"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="/about"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="/services"><i class="fas fa-chevron-right"></i> Services</a></li>
                        <li><a href="/projects"><i class="fas fa-chevron-right"></i> Projects</a></li>
                        <li><a href="/process"><i class="fas fa-chevron-right"></i> Our Process</a></li>
                        <li><a href="/gallery"><i class="fas fa-chevron-right"></i> Gallery</a></li>
                    </ul>
                </div>

                <!-- Col 3: Resources -->
                <div class="footer-col">
                    <h5 class="footer-col-title">Resources</h5>
                    <ul class="footer-links">
                        <li><a href="/blogs"><i class="fas fa-chevron-right"></i> Blogs</a></li>
                        <li><a href="/videos"><i class="fas fa-chevron-right"></i> Videos</a></li>
                        <li><a href="/testimonials"><i class="fas fa-chevron-right"></i> Testimonials</a></li>
                        <li><a href="/faqs"><i class="fas fa-chevron-right"></i> FAQ's</a></li>
                        <li><a href="/contact"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
                    </ul>
                </div>

                <!-- Col 4: Get In Touch -->
                <div class="footer-col footer-col-contact">
                    <h5 class="footer-col-title">Get In Touch</h5>
                    <ul class="footer-contact-list">
                        <li>
                            <div class="footer-contact-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="footer-contact-detail">
                                <span class="footer-contact-label">Phone / WhatsApp</span>
                                <a href="tel:+919845728507">+91 9845728507</a>
                                <a href="tel:+916361115701">+91 6361115701</a>
                            </div>
                        </li>
                        <li>
                            <div class="footer-contact-icon"><i class="fas fa-envelope"></i></div>
                            <div class="footer-contact-detail">
                                <span class="footer-contact-label">Email Us</span>
                                <a href="mailto:info@srgreenscapes.com">info@srgreenscapes.com</a>
                            </div>
                        </li>
                    </ul>
                    <div class="footer-social-wrap">
                        <span class="footer-social-label">Follow Us</span>
                        <div class="footer-social-icons">
                            <a href="https://www.facebook.com/profile.php?id=61579521119580" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/sr_greenscapes/?hl=en" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="https://x.com/GreenscapesSr" target="_blank" title="X"><i class="fab fa-x-twitter"></i></a>
                            <a href="https://www.linkedin.com/company/sr-greenscapes-pvt-ltd/" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://www.youtube.com/@srgreenscapes" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="footer-bottom">
                <p class="mb-0">{{ $siteSettings['copyright_text'] ?? '© 2025 SR Greenscapes Pvt Ltd. All rights reserved.' }}</p>
                <p class="mb-0 footer-bottom-links">
                    <a href="/privacy-policy">Privacy Policy</a>
                    <span>•</span>
                    <a href="/terms">Terms of Use</a>
                    <span>•</span>
                    <a href="/sitemap">Sitemap</a>
                </p>
            </div>
        </div>
    </footer>

    <style>
        /* ===== HERO SECTIONS GLOBAL MOBILE ===== */
        @media (max-width: 991px) {
            .about-hero, .svc-hero, .projects-hero, .proc-hero,
            .faq-hero, .contact-hero, .blogs-hero, .gallery-hero,
            .testi-hero, .videos-hero { height: 260px !important; }
        }
        @media (max-width: 767px) {
            .about-hero, .svc-hero, .projects-hero, .proc-hero,
            .faq-hero, .contact-hero, .blogs-hero, .gallery-hero,
            .testi-hero, .videos-hero { height: 220px !important; }
            .testi-hero-content h1, .projects-hero-content h1, .blogs-hero-content h1,
            .videos-hero-content h1, .gallery-hero-content h1 { font-size: 2rem; }
            .testi-hero-content p, .blogs-hero-content p, .videos-hero-content p,
            .gallery-hero-content p { font-size: 0.9rem; }
        }
        @media (max-width: 575px) {
            .about-hero, .svc-hero, .projects-hero, .proc-hero,
            .faq-hero, .contact-hero, .blogs-hero, .gallery-hero,
            .testi-hero, .videos-hero { height: 180px !important; }
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

    <!-- Call Float -->
    <a href="tel:+919845728507" class="call-float" title="Call Us">
        <i class="fas fa-phone-alt"></i>
    </a>

    <!-- WhatsApp Float -->
    <a href="https://wa.me/919845728507" class="whatsapp-float" target="_blank" title="WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Mobile dropdown toggle for nav items with sub-menus
    document.querySelectorAll('.nav-menu > li').forEach(function(li) {
        var dropdown = li.querySelector('.dropdown-menu-custom');
        if (dropdown) {
            li.querySelector(':scope > a').addEventListener('click', function(e) {
                if (window.innerWidth <= 991) {
                    e.preventDefault();
                    li.classList.toggle('dropdown-open');
                    document.querySelectorAll('.nav-menu > li').forEach(function(other) {
                        if (other !== li) other.classList.remove('dropdown-open');
                    });
                }
            });
        }
    });
    // Mobile sub-dropdown toggle (flyout items)
    document.querySelectorAll('.dropdown-submenu .dropdown-item-custom').forEach(function(item) {
        item.addEventListener('click', function(e) {
            if (window.innerWidth <= 991) {
                e.stopPropagation();
                var submenu = item.closest('.dropdown-submenu');
                submenu.classList.toggle('submenu-open');
                // Close other sub-dropdowns
                document.querySelectorAll('.dropdown-submenu').forEach(function(other) {
                    if (other !== submenu) other.classList.remove('submenu-open');
                });
            }
        });
    });
    </script>
    @yield('scripts')
</body>
</html>
