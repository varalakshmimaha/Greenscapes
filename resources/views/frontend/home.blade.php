@extends('frontend.layouts.app')

@section('styles')
<style>
    /* ===== HERO BANNER ===== */
    .hero-banner {
        position: relative;
        min-height: auto;
        max-height: 600px;
        overflow: hidden;
        border-radius: 30px;
        margin: 15px 20px 0;
    }
    .hero-banner .carousel-item {
        min-height: auto;
        max-height: 600px;
    }
    .hero-banner .carousel-item img {
        object-fit: cover;
        width: 100%;
        height: 600px;
    }
    .hero-banner .overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.25) 50%, rgba(0,0,0,0.15) 100%);
        z-index: 2;
    }
    .hero-inner {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 5;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hero-inner .container {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hero-text {
        text-align: center;
        max-width: 700px;
        width: 100%;
    }
    .hero-slide-text {
        transition: opacity 0.4s ease;
        opacity: 1;
    }
    .hero-text h1 {
        font-family: 'Poppins', sans-serif;
        font-size: 3.2rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        text-shadow: 0 2px 12px rgba(0,0,0,0.35);
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .hero-text .hero-company {
        font-family: 'Poppins', sans-serif;
        font-size: 1.25rem;
        font-weight: 600;
        color: #fff;
        letter-spacing: 2px;
        margin-bottom: 10px;
        text-transform: uppercase;
        text-shadow: 0 1px 6px rgba(0,0,0,0.3);
    }
    .hero-text .hero-sub {
        font-family: 'Poppins', sans-serif;
        font-size: 1.1rem;
        color: #fff;
        margin-top: 6px;
        font-weight: 400;
        letter-spacing: 1px;
        font-style: normal;
        text-shadow: 0 1px 6px rgba(0,0,0,0.3);
    }
    .btn-book-consult {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--primary);
        color: #fff;
        padding: 14px 34px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 6px 20px rgba(0,0,0,0.25);
        margin-top: 10px;
    }
    .btn-book-consult:hover {
        background: #fff;
        color: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    .hero-banner .carousel-control-prev,
    .hero-banner .carousel-control-next {
        z-index: 10;
        width: 45px;
        height: 45px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        backdrop-filter: blur(5px);
        opacity: 1;
        margin: 0 15px;
    }
    .hero-banner .carousel-control-prev:hover,
    .hero-banner .carousel-control-next:hover {
        background: var(--primary);
    }
    .hero-banner .carousel-indicators {
        z-index: 10;
        margin-bottom: 20px;
    }
    .hero-banner .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255,255,255,0.5);
        border: 2px solid rgba(255,255,255,0.8);
        margin: 0 5px;
    }
    .hero-banner .carousel-indicators button.active {
        background: var(--primary);
        border-color: var(--primary);
    }


    /* ===== ABOUT SECTION ===== */
    .about-section {
        padding: 80px 0;
        background: #fff;
        overflow: hidden;
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
    .about-label::before {
        content: '';
        width: 8px;
        height: 8px;
        background: var(--primary);
        border-radius: 50%;
    }
    .about-heading-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 30px;
    }
    .about-section h2 {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1.3;
        color: #1a1a1a;
        margin-bottom: 0;
        flex: 1;
    }
    .about-section h2 span {
        color: #1a1a1a;
    }
    .about-exp-badge {
        width: 110px;
        height: 110px;
        min-width: 110px;
        background: var(--primary);
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-align: center;
        box-shadow: 0 8px 25px rgba(139, 195, 74, 0.3);
    }
    .about-exp-badge .exp-num {
        font-size: 2.2rem;
        font-weight: 900;
        line-height: 1;
    }
    .about-exp-badge .exp-txt {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.2;
        margin-top: 4px;
    }
    .about-content-row {
        display: flex;
        gap: 40px;
        align-items: stretch;
    }
    .about-left {
        flex: 1;
    }
    .about-text {
        font-size: 0.95rem;
        line-height: 1.85;
        color: #666;
        margin-bottom: 30px;
        text-align: justify;
    }
    .about-text strong {
        color: var(--dark);
    }
    .about-features-row {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }
    .about-feature-card {
        background: #fff;
        border-radius: 12px;
        padding: 22px 18px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        border: 1px dashed #d0d0d0;
        flex: 1;
        transition: all 0.3s;
    }
    .about-feature-card:hover {
        border-color: var(--primary);
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }
    .about-feature-card .feat-icon {
        width: 50px;
        height: 50px;
        min-width: 50px;
        background: var(--light-green);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--primary-dark);
        margin-bottom: 12px;
    }
    .about-feature-card h6 {
        font-weight: 700;
        font-size: 0.88rem;
        color: var(--dark);
        margin-bottom: 0;
    }
    .about-feature-card p {
        font-size: 0.78rem;
        color: var(--gray);
        margin-bottom: 0;
        line-height: 1.6;
    }
    .btn-learn-more {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--primary);
        color: #fff;
        padding: 14px 30px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s;
    }
    .btn-learn-more:hover {
        background: var(--primary-dark);
        color: #fff;
    }
    .btn-learn-more .arrow-circle {
        width: 32px;
        height: 32px;
        background: rgba(255,255,255,0.25);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }
    .about-right {
        flex: 1;
        display: flex;
        gap: 15px;
        max-width: 500px;
    }
    .about-img-tall {
        flex: 1;
        border-radius: 120px 120px 120px 120px;
        overflow: hidden;
        height: 420px;
    }
    .about-img-tall img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .about-img-short {
        flex: 1;
        border-radius: 120px 120px 120px 120px;
        overflow: hidden;
        height: 420px;
        margin-top: 40px;
    }
    .about-img-short img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    @media (max-width: 991px) {
        .about-content-row { flex-direction: column; gap: 30px; }
        .about-right { max-width: 100%; }
        .about-img-tall, .about-img-short { height: 280px; border-radius: 60px; }
        .about-img-short { margin-top: 0; }
        .about-section h2 { font-size: 1.8rem; }
        .about-heading-row { flex-direction: column; }
        .about-features-row { flex-direction: column; }
    }

    /* ===== WHAT MAKES US DIFFERENT ===== */
    .diff-section {
        padding: 80px 0;
        background: #f8faf8;
        overflow: hidden;
    }
    .diff-card {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.4s;
        height: 100%;
        text-align: center;
        background: #eaf5ea;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 35px 25px 30px;
        border: none;
    }
    .diff-card:hover {
        box-shadow: none;
        transform: translateY(-8px);
    }
    .diff-card .diff-img {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        background: #e6f0e6;
        overflow: hidden;
        margin-bottom: 22px;
        flex-shrink: 0;
        border: 4px solid rgba(139,195,74,0.25);
        transition: border-color 0.3s;
    }
    .diff-card:hover .diff-img {
        border-color: var(--primary);
    }
    .diff-card .diff-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .diff-card:hover .diff-img img {
        transform: scale(1.08);
    }
    .diff-card .diff-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }
    .diff-card .diff-body h6 {
        font-weight: 700;
        font-size: 1.1rem;
        color: #2d3a2d;
        margin: 0;
        line-height: 1.4;
    }
    .diff-card .diff-body p {
        font-size: 0.95rem;
        color: #555;
        margin: 0;
        line-height: 1.7;
    }

    /* ===== SERVICES ===== */
    .services-section {
        padding: 90px 0;
        background: #f8faf8;
        position: relative;
        overflow: hidden;
    }
    .services-section::before {
        content: '';
        position: absolute;
        top: -80px;
        left: -80px;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        background: rgba(76,175,80,0.05);
    }
    .services-section::after {
        content: '';
        position: absolute;
        bottom: -60px;
        right: -60px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(139,195,74,0.05);
    }
    .services-section .section-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--light-green);
        color: var(--primary-dark);
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 15px;
    }
    .services-section .section-desc {
        color: #777;
        font-size: 0.95rem;
        max-width: 550px;
        margin: 0 auto 50px;
    }
    .service-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.3s;
        height: 100%;
        border: 1px solid #eee;
        display: flex;
        flex-direction: column;
    }
    .service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.1);
        border-color: rgba(139,195,74,0.3);
    }
    .service-card .svc-img-wrap {
        aspect-ratio: 4/3;
        overflow: hidden;
        background: #fff;
    }
    .service-card .svc-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
        transition: transform 0.4s;
    }
    .service-card:hover .svc-img-wrap img {
        transform: scale(1.05);
    }
    .service-card .svc-body {
        padding: 20px;
        text-align: center;
    }
    .service-card .svc-body h5 {
        font-weight: 700;
        color: var(--dark);
        font-size: 1.4rem;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    .service-card .svc-body .svc-desc {
        font-size: 0.9rem;
        color: #777;
        margin-bottom: 12px;
        line-height: 1.75;
        text-align: justify;
    }
    .service-card .svc-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        font-weight: 600;
        font-size: 0.88rem;
        text-decoration: none;
        transition: all 0.3s;
    }
    .service-card .svc-link:hover {
        color: #a4d65e;
        gap: 12px;
    }
    .service-card .svc-link i {
        font-size: 0.75rem;
        transition: transform 0.3s;
    }
    .service-card .svc-link:hover i {
        transform: translateX(3px);
    }
    @media (max-width: 575px) {
        .service-card .svc-body { padding: 16px; }
    }

    /* ===== PROCESS SECTION ===== */
    .process-section {
        padding: 80px 0;
        background: transparent;
        overflow: hidden;
    }
    .process-flow {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0;
        margin-top: 40px;
    }
    .process-flow-row {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        margin-bottom: 30px;
    }
    .process-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
        width: 220px;
        border: 2px solid transparent;
    }
    .process-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 35px rgba(0,0,0,0.12);
        border-color: var(--primary);
        color: inherit;
    }
    .process-card .card-img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }
    .process-card .card-body-custom {
        padding: 15px;
        text-align: center;
    }
    .process-card .step-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: var(--primary);
        color: #fff;
        border-radius: 50%;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .process-card h6 {
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--dark);
        margin: 0;
        line-height: 1.4;
    }
    .process-arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        min-width: 50px;
        color: var(--primary);
        font-size: 1.5rem;
    }
    .process-flow .process-arrow-down {
        display: none;
    }
    .process-arrow-turn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        min-width: 50px;
        color: var(--primary);
        font-size: 1.5rem;
    }
    @media (max-width: 991px) {
        .process-flow { display: none; }
        .process-mobile { display: flex !important; flex-direction: column; align-items: center; gap: 5px; }
        .process-mobile .process-card { width: 260px; }
        .process-mobile .process-arrow-down { display: flex; justify-content: center; width: 100%; color: var(--primary); font-size: 1.5rem; padding: 10px 0; }
    }
    @media (min-width: 992px) {
        .process-mobile { display: none !important; }
    }

    /* ===== STATS ===== */
    .stats-section {
        padding: 50px 0;
        background: var(--dark-bg);
        color: #fff;
    }
    .stat-item {
        text-align: center;
        padding: 15px;
    }
    .stat-number {
        font-size: 2.8rem;
        font-weight: 900;
        color: var(--accent);
        line-height: 1;
    }
    /* ===== NEW PORTFOLIO DESIGN ===== */
    .portfolio-stats-bar {
        background: var(--green-dark);
        border-radius: 0;
        display: flex;
        padding: 40px 15px;
        margin-bottom: 60px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
    }
    .portfolio-stat-item {
        flex: 1;
        text-align: center;
        border-right: 1px solid rgba(255,255,255,0.08);
        padding: 10px;
    }
    .portfolio-stat-item:last-child { border-right: 0; }
    .portfolio-stat-item .stat-num {
        color: var(--primary);
        font-size: 2.4rem;
        font-weight: 800;
        display: block;
        margin-bottom: 5px;
        line-height: 1;
    }
    .portfolio-stat-item .stat-txt {
        color: rgba(255,255,255,0.7);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 700;
    }

    .custom-project-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        height: 380px;
        margin-bottom: 30px;
        cursor: pointer;
        transition: transform 0.4s;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    /* Masonry heights */
    .portfolio-grid .col-lg-4:nth-child(even) .custom-project-card {
        height: 480px;
    }
    .portfolio-grid .col-lg-4:nth-child(3n) .custom-project-card {
        height: 420px;
    }
    
    .custom-project-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    .custom-project-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .custom-project-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.8) 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 25px;
        transition: background 0.3s;
    }
    .custom-project-card:hover .custom-project-overlay {
        background: rgba(26,42,26,0.5); /* Greenish tint on hover */
    }
    .project-type-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #fff;
        color: #1a2a1a;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .project-content-bottom h5 {
        color: #fff;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }
    .project-content-bottom p {
        color: rgba(255,255,255,0.7);
        font-size: 0.8rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .view-project-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.8);
        background: var(--primary);
        color: #fff;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.8rem;
        opacity: 0;
        transition: all 0.3s;
        box-shadow: 0 6px 20px rgba(139,195,74,0.4);
    }
    .custom-project-card:hover .view-project-btn {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }

    .btn-view-all {
        background: var(--primary);
        border: 2px solid var(--primary);
        color: #fff;
        padding: 12px 35px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
        margin-top: 20px;
    }
    .btn-view-all:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139,195,74,0.35);
    }

    @media (max-width: 991px) {
        .portfolio-stats-bar { flex-wrap: wrap; }
        .portfolio-stat-item { flex: 0 0 33.33%; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .portfolio-stat-item:nth-child(3n) { border-right: 0; }
    }
    @media (max-width: 575px) {
        .portfolio-stat-item { flex: 0 0 50%; }
        .portfolio-stat-item:nth-child(even) { border-right: 0; }
    }

    /* ===== PORTFOLIO ===== */
    .portfolio-section {
        padding: 80px 0;
        background: #fff;
    }
    .project-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        margin-bottom: 25px;
        transition: all 0.3s;
        position: relative;
    }
    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 35px rgba(0,0,0,0.12);
    }
    .project-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .project-card .info {
        padding: 15px;
    }
    .project-card .info h6 {
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 4px;
    }
    .project-card .info small {
        color: var(--gray);
    }
    .project-card .badge-type {
        position: absolute;
        top: 12px;
        right: 12px;
        background: var(--primary);
        color: #fff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    /* ===== FAQ ===== */
    .faq-section {
        padding: 80px 0;
        background: #f8faf8;
    }
    .accordion-item {
        border: 1px solid #e8e8e8;
        border-radius: 8px !important;
        margin-bottom: 12px;
        overflow: hidden;
    }
    .accordion-button {
        font-weight: 600;
        color: var(--dark);
        font-size: 15px;
        padding: 16px 20px;
        text-align: left;
    }
    .accordion-body {
        text-align: left;
    }
    .accordion-button:not(.collapsed) {
        background: var(--primary);
        color: #fff;
        box-shadow: none;
    }
    .accordion-button:focus {
        box-shadow: none;
    }
    .accordion-button::after {
        filter: none;
    }
    .accordion-button:not(.collapsed)::after {
        filter: brightness(0) invert(1);
    }

    @media (max-width: 991px) {
        .hero-banner, .hero-banner .carousel-item { height: auto; min-height: auto; max-height: 450px; }
        .hero-inner { position: relative; padding: 30px 0; }
        .hero-text h1 { font-size: 2.2rem; letter-spacing: 1.5px; }
        .hero-text .hero-company { font-size: 1rem; letter-spacing: 1.5px; }
        .hero-text .hero-sub { font-size: 0.95rem; }
        .btn-book-consult { padding: 12px 28px; font-size: 0.88rem; }
        .stat-number { font-size: 2rem; }
        .services-section { padding: 50px 0; }
        .portfolio-section { padding: 50px 0; }
    }
    @media (max-width: 575px) {
        .hero-banner { margin: 8px 10px 0; border-radius: 20px; min-height: 60vh; }
        .hero-banner .carousel-item { min-height: 60vh; }
        .hero-text h1 { font-size: 1.6rem; letter-spacing: 1px; }
        .hero-text .hero-company { font-size: 0.82rem; letter-spacing: 1.5px; }
        .hero-text .hero-sub { font-size: 0.8rem; }
        .btn-book-consult { padding: 11px 24px; font-size: 0.82rem; }
        .hero-inner { padding: 20px 0; }
        .hero-inner .container { gap: 18px; }
        .hero-banner .carousel-control-prev,
        .hero-banner .carousel-control-next { width: 35px; height: 35px; margin: 0 8px; }
        .hero-banner .carousel-indicators button { width: 8px; height: 8px; }
        .about-section { padding: 40px 0; }
        .about-section h2 { font-size: 1.4rem !important; }
        .diff-section { padding: 40px 0; }
        .choose-img-circle { width: 220px; height: 220px; }
        .choose-img-small { width: 80px; height: 80px; }
        .services-section { padding: 40px 0; }
        .stats-section { padding: 30px 0; }
        .stat-number { font-size: 1.6rem !important; }
        .portfolio-section { padding: 40px 0; }
        .project-card img { height: 160px; }
        .faq-landspire-section { padding: 50px 0; }
        .faq-left-content .faq-title { font-size: 1.8rem; }
        .faq-images-split { height: 180px; }
        .img-shape-left { width: 100px; height: 180px; border-radius: 100px 0 0 100px; }
        .img-shape-right { width: 100px; height: 150px; border-radius: 0 100px 100px 0; margin-top: 30px; }
        .img-shape-left img { width: 205px; height: 180px; }
        .img-shape-right img { width: 205px; height: 180px; top: -30px; left: -105px; }
        .faq-btn { padding: 12px 14px; font-size: 0.85rem; }
        .faq-icon { width: 30px; height: 30px; font-size: 0.75rem; }
        .faq-body { padding: 0 14px 18px 14px; font-size: 0.85rem; }
        .faq-accordion .faq-item { border-radius: 20px; margin-bottom: 12px; }
        .faq-btn-touch { font-size: 0.8rem; padding: 8px 12px 8px 16px; }
        .faq-btn-touch .arrow-icon { width: 24px; height: 24px; margin-left: 8px; }
        .faq-cta-text { font-size: 0.88rem; }
        .btn-theme { padding: 10px 20px; font-size: 12px; }
    }
    @media (max-width: 768px) {
        .hero-banner { margin: 10px 10px 0; border-radius: 16px; }
        .hero-inner .container { flex-direction: column; gap: 20px; padding: 20px 15px; }
        .hero-text { text-align: center; }
        .hero-text h1 { font-size: 1.8rem; }
        .hero-text p { font-size: 0.9rem; }
        .about-heading-row { flex-direction: column; gap: 15px; }
        .about-features-row { flex-direction: column; gap: 15px; }
        .about-feature-card { min-width: unset; }
    }
    @media (max-width: 400px) {
        .hero-text h1 { font-size: 1.3rem; }
        .hero-banner { margin: 3px 3px 0; }
    }
</style>
@endsection

@section('content')

<!-- Hero Banner Slider -->
<section class="hero-banner">
    <div id="heroCarousel" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="4000">
        <!-- Indicators -->
        <div class="carousel-indicators">
            @if($banners->count())
                @foreach($banners as $index => $banner)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></button>
                @endforeach
            @else
                @for($i = 0; $i < 6; $i++)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"></button>
                @endfor
            @endif
        </div>

        <div class="carousel-inner h-100">
            @if($banners->count())
                @foreach($banners as $index => $banner)
                    <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}">
                        <img {{ $index === 0 ? 'loading="eager" fetchpriority="high"' : 'loading="lazy"' }} src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}">
                    </div>
                @endforeach
            @else
                <div class="carousel-item h-100 active">
                    <img loading="eager" fetchpriority="high" src="{{ asset('storage/Home/1.2 Cover photo 2.jpg') }}" alt="Landscape Design">
                </div>
                <div class="carousel-item h-100">
                    <img loading="lazy" src="{{ asset('storage/Home/1.2 Cover photo 2.jpg') }}" alt="Garden">
                </div>
                <div class="carousel-item h-100">
                    <img loading="lazy" src="{{ asset('storage/Home/1.3 Cover photo 3.jpg') }}" alt="Plants">
                </div>
                <div class="carousel-item h-100">
                    <img loading="lazy" src="{{ asset('storage/Home/1.4 Cover photo  4.jpg') }}" alt="Outdoor Space">
                </div>
                <div class="carousel-item h-100">
                    <img loading="lazy" src="{{ asset('storage/Home/1.5 Cover photo 5.jpg') }}" alt="Landscaping">
                </div>
                <div class="carousel-item h-100">
                    <img loading="lazy" src="{{ asset('storage/Home/1.6 Cover photo 6.jpg') }}" alt="Green Space">
                </div>
            @endif
        </div>
        <div class="overlay"></div>

        <!-- Slider Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Hero Content Overlay: Centered -->
    <div class="hero-inner">
        <div class="container">
            <div class="hero-text">
                @if($banners->count())
                    @foreach($banners as $index => $banner)
                        @if($banner->title || $banner->subtitle || $banner->description)
                        <div class="hero-slide-text" data-slide="{{ $index }}" style="{{ $index !== 0 ? 'display:none;' : '' }}">
                            @if($banner->title)<h1>{{ $banner->title }}</h1>@endif
                            @if($banner->subtitle)<p class="hero-company">{{ $banner->subtitle }}</p>@endif
                            @if($banner->description)<p class="hero-sub">{{ $banner->description }}</p>@endif
                            <div class="mt-4">
                                <a href="/contact" class="btn-book-consult">
                                    <i class="fas fa-calendar-check"></i> Book Consultation
                                </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @else
                    <div class="hero-slide-text" data-slide="0">
                        <h1>SR GREENSCAPES Pvt Ltd</h1>
                        <p class="hero-company">Welcome</p>
                        <p class="hero-sub">Science driven sustainable landscaping</p>
                        <div class="mt-4">
                            <a href="/contact" class="btn-book-consult">
                                <i class="fas fa-calendar-check"></i> Book Consultation
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- About Preview Section -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Content -->
            <div class="col-lg-6 mb-5 mb-lg-0 pe-lg-5">
                <p class="about-label">About Our Company</p>
                <h2>Creating High-Performance, <span>Science-Driven</span> Sustainable Landscapes.</h2>
                <p style="color: #555; font-size: 0.95rem; line-height: 1.8; margin-bottom: 25px;">
                    We combine plant science, climate-responsive design, and expert execution to deliver spaces that are beautiful and functional. From design to maintenance, we offer end-to-end green solutions for homes, commercial spaces, and institutions.
                </p>

                <div class="row g-4 mb-4">
                    <div class="col-sm-6 d-flex align-items-start gap-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-circle" style="width: 26px; height: 26px; font-size: 0.7rem; background: var(--primary); color: #fff;">
                            <i class="fas fa-check"></i>
                        </div>
                        <p class="mb-0" style="font-size: 0.9rem; line-height: 1.6; color: #555;">Scientific solutions & expert execution for long-lasting functional green spaces.</p>
                    </div>
                    <div class="col-sm-6 d-flex align-items-start gap-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-circle" style="width: 26px; height: 26px; font-size: 0.7rem; background: var(--primary); color: #fff;">
                            <i class="fas fa-check"></i>
                        </div>
                        <p class="mb-0" style="font-size: 0.9rem; line-height: 1.6; color: #555;">End-to-end robust green solutions from planning to regular maintenance.</p>
                    </div>
                    <div class="col-sm-6 d-flex align-items-start gap-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-circle" style="width: 26px; height: 26px; font-size: 0.7rem; background: var(--primary); color: #fff;">
                            <i class="fas fa-check"></i>
                        </div>
                        <p class="mb-0" style="font-size: 0.9rem; line-height: 1.6; color: #555;">Climate-responsive designs tailored for homes, commercials, & institutions.</p>
                    </div>
                    <div class="col-sm-6 d-flex align-items-start gap-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-circle" style="width: 26px; height: 26px; font-size: 0.7rem; background: var(--primary); color: #fff;">
                            <i class="fas fa-check"></i>
                        </div>
                        <p class="mb-0" style="font-size: 0.9rem; line-height: 1.6; color: #555;">Dedicated team committed to creating aesthetics and sustainability.</p>
                    </div>
                </div>

                <a href="/about" class="btn-theme mt-3">
                    Know More <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>

            <!-- Right Content: Image -->
            <div class="col-lg-6 position-relative ps-lg-5">
                <div class="position-absolute" style="top: -20px; bottom: 20px; left: 30px; right: 0; border-radius: 20px; z-index: 0; background: var(--light-green);"></div>
                <div class="position-relative z-1 p-3">
                    <img loading="lazy" src="{{ asset('storage/Home/1.11 Climate-Resilient Design.jpg') }}" alt="SR Greenscapes Landscaping" class="img-fluid w-100" style="border-radius: 20px; object-fit: cover; max-height: 600px; box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What Makes Us Different -->
<section class="diff-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="about-label d-flex justify-content-center">What Makes Us Different</p>
            <h2 class="section-title">Why Homeowners Trust Our Landscaping Expertise</h2>
            <p class="text-muted mx-auto" style="max-width: 650px;">Every project is guided by scientific assessment, expert execution and a commitment to sustainable, long-lasting results.</p>
        </div>

        <div class="row g-4">
            @php
                $diffItems = [
                    ['img' => 'Home/1.8 Science-Driven Approach.jpg', 'title' => 'Science-Driven Approach', 'desc' => 'Our projects are grounded in scientific research, soil analysis, and evidence-based plant selection for sustainable results.'],
                    ['img' => 'Home/1.9 Sustainability at the Core.jpg', 'title' => 'Sustainability at the Core', 'desc' => 'Every decision we make prioritizes environmental responsibility — from water-efficient irrigation to native plant species.'],
                    ['img' => 'Home/1.10 Research-Integrated Planning.jpg', 'title' => 'Research-Integrated Planning', 'desc' => 'We incorporate the latest horticultural research into every design, ensuring long-term viability and ecological balance.'],
                    ['img' => 'Home/1.11 Climate-Resilient Design.jpg', 'title' => 'Climate-Resilient Design', 'desc' => 'Our landscapes are engineered to withstand heat stress, irregular rainfall, and changing urban environmental conditions.'],
                    ['img' => 'Home/1.12 End-to-End Execution.jpg', 'title' => 'End-to-End Execution', 'desc' => 'From concept design and nursery production to irrigation, hardscape installation, and ongoing maintenance support.'],
                    ['img' => 'Home/1.13 Experienced Leadership  Advisory Strength.jpg', 'title' => 'Experienced Leadership & Advisory Strength', 'desc' => 'Led by PhD horticulture professionals with a scientific advisory network providing institutional credibility.'],
                    ['img' => 'Home/1.14 Long-Term Value Creation.jpg', 'title' => 'Long-Term Value Creation', 'desc' => 'Our landscapes are built to mature beautifully, increasing property value and reducing maintenance costs over time.'],
                    ['img' => 'Home/1.15 Cost-Effective  Affordable.jpg', 'title' => 'Cost-Effective & Affordable', 'desc' => 'Premium quality landscapes delivered at competitive pricing through our own nursery and efficient project management.'],
                ];
            @endphp

            @foreach($diffItems as $item)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <div class="diff-card">
                        <div class="diff-img">
                            <img loading="lazy" src="{{ asset('storage/' . $item['img']) }}" alt="{{ $item['title'] }}">
                        </div>
                        <div class="diff-body">
                            <h6>{{ $item['title'] }}</h6>
                            <p>{{ $item['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="services-section py-5" id="services">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="about-label">What We Offer</p>
            <h2 class="section-title">Our Professional Services</h2>
            <p class="text-muted mx-auto" style="max-width: 650px;">Comprehensive landscaping solutions powered by science, sustainability, and a passion for green spaces.</p>
        </div>

        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="service-card">
                        @if($service->image)
                        <div class="svc-img-wrap">
                            <img loading="lazy" src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                        </div>
                        @endif
                        <div class="svc-body">
                            <h5>{{ $service->name }}</h5>
                            <p class="svc-desc">{{ Str::limit(strip_tags($service->description), 100) }}</p>
                            <a href="{{ route('service.detail', $service->slug) }}" class="svc-link">Explore Services <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="/services" class="btn-theme">
                View All Services
                <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
            </a>
        </div>
    </div>
</section>


<style>
/* Circular Step Layout (Traveltag Inspired) */
.process-section {
    background-color: #ffffff;
    padding: 100px 0;
}
.process-section .section-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 15px;
}
.process-step-container {
    position: relative;
    text-align: center;
    margin-bottom: 60px;
}
.process-circle-outer {
    width: 260px;
    height: 260px;
    margin: 0 auto 30px auto;
    border: 1px dashed #8bc34a;
    border-radius: 50%;
    position: relative;
    padding: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.4s ease, border-color 0.4s ease;
}
.process-circle-outer:hover {
    transform: translateY(-5px);
    border-color: #5b96bf;
}
.process-circle-inner {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.process-circle-inner img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.process-circle-outer:hover .process-circle-inner img {
    transform: scale(1.08);
}
.step-badge-circle {
    position: absolute;
    top: 10px;
    right: 5px;
    width: 60px;
    height: 60px;
    background-color: var(--primary, #8BC34A); /* Theme button color / light green */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 20px;
    box-shadow: 0 4px 10px rgba(139, 195, 74, 0.4);
    z-index: 2;
    transition: transform 0.3s ease;
}
.process-circle-outer:hover .step-badge-circle {
    transform: scale(1.1);
}
.process-step-info h4 {
    font-size: 1.3rem;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 12px;
}
.process-step-info p {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.6;
    padding: 0 15px;
}

/* Connecting Arrow */
.curved-arrow {
    position: absolute;
    top: 100px;
    right: -60px;
    width: 120px;
    height: 40px;
    z-index: 0;
    pointer-events: none;
}
@media (max-width: 1199px) {
    .curved-arrow {
        right: -40px;
        width: 80px;
    }
}
@media (max-width: 991px) {
    .curved-arrow {
        display: none !important;
    }
    .process-circle-outer {
        width: 220px;
        height: 220px;
    }
}
</style>

<!-- Our Process (Circular Inspired Design) -->
<section class="process-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="about-label d-flex justify-content-center">Structured, Measurable, Repeatable</p>
            <h2 class="section-title">Our Process</h2>
            <p class="text-muted mx-auto" style="max-width: 650px;">A systematic approach rooted in science and precision, ensuring every project is delivered with consistency, quality, and lasting impact.</p>
        </div>

        @php
            $processSteps = [
                ['num' => '01', 'title' => 'Consultation & Assessment', 'desc' => 'Initial understanding of project needs and comprehensive on-site evaluation.', 'img' => 'Home/1.8 Science-Driven Approach.jpg'],
                ['num' => '02', 'title' => 'Research-Based Design', 'desc' => 'Creating layouts focusing on biodiversity, climate, and site characteristics.', 'img' => 'Home/1.10 Research-Integrated Planning.jpg'],
                ['num' => '03', 'title' => 'Technical Planning', 'desc' => 'Detailed technical structuring, responsible material choices, and timelines.', 'img' => 'Home/1.9 Sustainability at the Core.jpg'],
                ['num' => '04', 'title' => 'Professional Execution', 'desc' => 'Expert on-ground implementation with strict quality and safety controls.', 'img' => 'Home/1.12 End-to-End Execution.jpg'],
                ['num' => '05', 'title' => 'Structured Handover', 'desc' => 'Final thorough reviews and detailed documentation provided upon project handover.', 'img' => 'Home/1.14 Long-Term Value Creation.jpg'],
                ['num' => '06', 'title' => 'Lifecycle Support', 'desc' => 'Continuous maintenance and care tailored for long-term health and growth.', 'img' => 'Home/1.11 Climate-Resilient Design.jpg'],
            ];
        @endphp

        <div class="row g-4">
            @foreach($processSteps as $i => $step)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ 100 + ($i * 100) }}">
                    <div class="process-step-container">
                        <div class="process-circle-outer">
                            <div class="process-circle-inner">
                                <img loading="lazy" src="{{ asset('storage/' . $step['img']) }}" alt="{{ $step['title'] }}">
                            </div>
                            <div class="step-badge-circle">{{ $step['num'] }}</div>
                        </div>
                        <div class="process-step-info">
                            <h4>{{ $step['title'] }}</h4>
                            <p>{{ $step['desc'] }}</p>
                        </div>
                        
                        {{-- Add arrow between items in a row, except the last one in a 3-column grid --}}
                        @if($i % 3 != 2 && $i != count($processSteps) - 1)
                            <svg class="curved-arrow d-none d-lg-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 30">
                                <path d="M0,25 Q50,0 95,20" fill="none" stroke="#8BC34A" stroke-width="1.5" style="stroke: var(--primary, #8BC34A);" />
                                <path d="M90,13 L97,21 L85,22" fill="none" stroke="#8BC34A" stroke-width="1.5" style="stroke: var(--primary, #8BC34A);" />
                            </svg>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Stats Section (New Pattern Design) -->
<section class="stats-bar-section py-5 my-5 position-relative" style="background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover no-repeat; overflow: hidden; border-radius: 0;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(17, 45, 20, 0.85); z-index: 0;"></div>
    <div class="position-absolute rounded-circle blur-bg" style="width: 300px; height: 300px; background: rgba(189, 228, 57, 0.1); top: -100px; left: -100px; filter: blur(80px); z-index: 0;"></div>
    <div class="position-absolute rounded-circle blur-bg" style="width: 400px; height: 400px; background: rgba(255, 255, 255, 0.05); bottom: -150px; right: -100px; filter: blur(100px); z-index: 0;"></div>

    <div class="container position-relative z-1 py-4">
        <div class="row justify-content-center g-3">
            @php
                $fallbackStats = [
                    (object)['icon' => 'fas fa-calendar-check', 'number' => '5', 'suffix' => '+', 'label' => 'Successful Years'],
                    (object)['icon' => 'fas fa-seedling', 'number' => '4', 'suffix' => '+', 'label' => 'Projects Completed'],
                    (object)['icon' => 'fas fa-user-tie', 'number' => '10', 'suffix' => '+', 'label' => 'Professionals'],
                    (object)['icon' => 'fas fa-leaf', 'number' => '30', 'suffix' => '+', 'label' => 'Gardeners'],
                    (object)['icon' => 'fas fa-map-marker-alt', 'number' => '5', 'suffix' => '+', 'label' => 'Locations Executed'],
                    (object)['icon' => 'fas fa-trophy', 'number' => '2', 'suffix' => '+', 'label' => 'Awards Won'],
                    (object)['icon' => 'fab fa-google', 'number' => '3.3', 'suffix' => '+', 'label' => 'Google Rating'],
                ];
                $activeCounters = (isset($counters) && $counters->count()) ? $counters : collect($fallbackStats);
            @endphp

            @foreach($activeCounters as $stat)
            <div class="col-6 col-md-4 col-lg-auto" style="flex: 1 1 118px; max-width: 155px;">
                <div class="stat-card text-center p-3 rounded-4 h-100 d-flex flex-column align-items-center justify-content-center"
                     style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); transition: transform 0.3s;"
                     onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="icon-diamond mb-2 position-relative d-flex align-items-center justify-content-center"
                         style="width: 46px; height: 46px; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); border-radius: 10px; transform: rotate(45deg);">
                        <i class="{{ $stat->icon }} text-white" style="transform: rotate(-45deg); font-size: 1rem;"></i>
                    </div>
                    <div class="stat-num text-white fw-bold lh-1 mb-2" style="font-size: 1.75rem;">{{ $stat->number }}{{ $stat->suffix }}</div>
                    <div class="d-flex align-items-center justify-content-center w-100 px-2 mb-2">
                        <div style="flex-grow: 1; height: 1px; background: rgba(255,255,255,0.4);"></div>
                        <div style="width: 5px; height: 5px; border-radius: 50%; background: #fff; margin: 0 6px;"></div>
                        <div style="flex-grow: 1; height: 1px; background: rgba(255,255,255,0.4);"></div>
                    </div>
                    <div class="stat-txt text-white fw-bold text-uppercase" style="font-size: 0.62rem; letter-spacing: 0.4px; white-space: nowrap;">{{ $stat->label }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Portfolio -->
<section class="portfolio-section text-center py-5" id="portfolio">
    <div class="container">
        <div class="mb-5" data-aos="fade-up">
            <p class="about-label d-flex justify-content-center">Featured Portfolio</p>
            <h2 class="section-title">Crafting Landscapes That Perform, Evolve and Inspire</h2>
            <p class="text-muted mx-auto" style="max-width: 800px;">
                Every project is a reflection of our commitment to scientific planning, thoughtful design and 
                sustainable execution. Our portfolio showcases a diverse range of landscapes- each uniquely 
                designed to respond to its environment, purpose and client vision.
            </p>
        </div>

        <div class="row portfolio-grid g-4">
            @foreach($projects->take(6) as $p)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="custom-project-card border rounded-4 overflow-hidden shadow-sm bg-white" style="height: 380px;" onclick="window.location.href='{{ route('project.detail', $p->slug) }}'">
                        <div class="project-img-container h-100 position-relative">
                            <img loading="lazy" src="{{ asset('storage/' . ($p->featured_image ?? 'Home/1.1Cover photo 1.jpg')) }}" alt="{{ $p->title }}" class="w-100 h-100 object-fit-cover">
                            <div class="project-type-badge position-absolute top-0 end-0 m-3">
                                {{ $p->category ?? ucfirst($p->status) }}
                            </div>
                            <div class="custom-project-overlay position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
                                <div class="project-content-bottom text-white">
                                    <h5 class="mb-1 fw-bold">{{ $p->title }}</h5>
                                    <p class="mb-0 small opacity-75"><i class="fas fa-map-marker-alt me-2"></i> {{ $p->location ?? $p->client_name ?? 'Location' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="/projects" class="btn-view-all">View All Projects <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>


<!-- FAQ - Green Landspire Theme -->

<!-- FAQ - EXACT LANDSPIRE MATCH -->
<section class="faq-landspire-section" id="faqs">
    <div class="container">
        <div class="row g-5 align-items-center">

            {{-- LEFT PANEL --}}
            <div class="col-lg-5 ps-lg-4">
                <div class="faq-left-content">
                    <div class="faq-pill">
                        <span class="faq-dot"></span> FAQS
                    </div>
                    <h2 class="faq-title mt-3">Frequently Asked<br>Questions</h2>
                    
                    <div class="faq-images-split mt-4 mb-4">
                        <div class="img-shape-left">
                            <img loading="lazy" src="{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}" alt="Expert">
                        </div>
                        <div class="img-shape-right">
                            <img loading="lazy" src="{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}" alt="Garden">
                        </div>
                    </div>

                    <div class="faq-cta-box d-flex align-items-center justify-content-between mt-4">
                        <p class="faq-cta-text mb-0">Have Any Question<br>on Your Minds?</p>
                        <a href="/contact" class="faq-btn-touch">
                            Get In Touch <span class="arrow-icon"><i class="fas fa-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- RIGHT PANEL --}}
            <div class="col-lg-7 py-5 pe-lg-5">
                <div class="faq-accordion" id="greenFaqAccordion">
                    @foreach($faqs as $faq)
                        <div class="faq-item">
                            <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#gfaq{{ $faq->id }}" aria-expanded="false">
                                <span class="faq-q-text">{{ $faq->question }}</span>
                                <span class="faq-icon"><i class="fas fa-plus"></i></span>
                            </button>
                            <div id="gfaq{{ $faq->id }}" class="collapse" data-bs-parent="#greenFaqAccordion">
                                <div class="faq-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    /* ===== EXACT LANDSPIRE FAQ THEME ===== */
    .faq-landspire-section {
        background-color: #1e5a2e; /* Dark green matching the image */
        padding: 90px 0;
        overflow: hidden;
        font-family: inherit;
        background-image: url('data:image/svg+xml;utf8,<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"><g fill="rgba(255,255,255,0.02)"><path d="M0 0h20v20H0z"/></g></svg>'); /* Subtle texture placeholder */
    }

    /* Left Side Elements */
    .faq-pill {
        display: inline-flex;
        align-items: center;
        background-color: #fff;
        color: #1a3a1a;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .faq-dot {
        width: 8px;
        height: 8px;
        background-color: #C1EB4A; /* Lime green dot */
        border-radius: 50%;
        margin-right: 8px;
    }
    
    .faq-left-content .faq-title {
        color: #fff;
        font-size: 3.2rem;
        font-weight: 700;
        line-height: 1.2;
    }

    /* Images overlapping like leafs */
    .faq-images-split {
        display: flex;
        gap: 5px;
        height: 260px;
    }
    .img-shape-left {
        width: 140px;
        height: 260px;
        overflow: hidden;
        position: relative;
        border-radius: 140px 0 0 140px;
    }
    .img-shape-right {
        width: 140px;
        height: 220px;
        overflow: hidden;
        position: relative;
        border-radius: 0 140px 140px 0;
        margin-top: 40px;
    }
    .img-shape-left img {
        position: absolute;
        top: 0;
        left: 0;
        width: 285px; /* 140px + 5px gap + 140px */
        height: 260px;
        object-fit: cover;
        object-position: center;
    }
    .img-shape-right img {
        position: absolute;
        top: -40px; /* Counter margin-top */
        left: -145px; /* Counter left container width + gap */
        width: 285px;
        height: 260px;
        object-fit: cover;
        object-position: center;
    }

    /* Bottom Call to Action */
    .faq-cta-text {
        color: #fff;
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.4;
    }
    .faq-btn-touch {
        background-color: #8BC34A;
        color: #fff;
        padding: 10px 14px 10px 22px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s;
        font-size: 0.9rem;
    }
    .faq-btn-touch:hover {
        background-color: #689F38;
        color: #fff;
    }
    .faq-btn-touch .arrow-icon {
        background-color: #fff;
        color: #1a3a1a;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-left: 12px;
        font-size: 0.7rem;
        transition: all 0.3s;
    }
    .faq-btn-touch:hover .arrow-icon {
        background-color: #1a3a1a;
        color: #fff;
    }

    /* Right Side Accordion */
    .faq-accordion .faq-item {
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 50px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        background-color: transparent;
    }
    .faq-accordion .faq-item:hover,
    .faq-btn[aria-expanded="true"] {
        border-color: rgba(255,255,255,0.4);
    }
    
    .faq-btn {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 24px;
        background: transparent;
        border: none;
        color: #fff;
        font-weight: 500;
        font-size: 1.05rem;
        text-align: left;
    }
    
    .faq-icon {
        width: 36px;
        height: 36px;
        background-color: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #C1EB4A; /* Light green plus */
        font-size: 0.9rem;
        flex-shrink: 0;
        transition: all 0.3s;
    }
    
    .faq-btn[aria-expanded="true"] .faq-icon {
        background-color: #C1EB4A;
        color: #1a3a1a;
        transform: rotate(45deg);
    }

    .faq-body {
        padding: 0 40px 24px 24px;
        color: rgba(255,255,255,0.8);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    @media (max-width: 991px) {
        .faq-images-split {
            justify-content: center;
            margin-bottom: 40px;
        }
        .faq-cta-box {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 20px;
            margin-bottom: 40px;
        }
        .faq-left-content .faq-title { font-size: 2.2rem; }
        .faq-accordion .faq-item { border-radius: 30px; }
        .faq-btn { padding: 14px 18px; font-size: 0.95rem; }
    }
</style>


@endsection

@section('cta')
<!-- ===== HOME CTA — Start A Conversation ===== -->
<section class="home-cta-wrapper">
    <div class="container">
        <div class="home-cta-section">
            <div class="home-cta-overlay"></div>
            <div class="home-cta-inner">

                <!-- Left: Heading Text -->
                <div class="home-cta-left">
                    <span class="home-cta-label">YOUR INQUIRY</span>
                    <h2 class="home-cta-heading">Start A Conversation With Us</h2>
                    <p class="home-cta-desc">
                        Reach out to discuss your ideas and outdoor needs.<br>
                        We're here to help your garden thrive beautifully<br>
                        with science-driven sustainable landscapes.
                    </p>
                </div>

                <!-- Right: Floating Form Card -->
                <div class="home-cta-card">
                    <h4 class="home-cta-card-title">Book Consultation</h4>
                    <p class="home-cta-card-sub">Share your details and we'll respond with the right garden solution for you.</p>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="home-cta">
                        <div class="home-cta-row">
                            <input type="text" name="name" class="home-cta-input" placeholder="Your Name *" required>
                            <input type="text" name="phone" class="home-cta-input" placeholder="Phone Number *" required>
                        </div>
                        <select name="subject" class="home-cta-input" style="margin-bottom:10px;">
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
                        <textarea name="inquiry_message" class="home-cta-input home-cta-textarea" placeholder="Your message"></textarea>
                        <button type="submit" class="home-cta-submit">SEND MESSAGE</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    .home-cta-wrapper {
        padding: 60px 0 80px;
        background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover no-repeat fixed;
        position: relative;
    }
    .home-cta-wrapper::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(20, 45, 20, 0.55);
    }
    .home-cta-wrapper .container {
        position: relative;
        z-index: 1;
    }
    .home-cta-section {
        position: relative;
        background: url('{{ asset('storage/Home/1.5 Cover photo 5.jpg') }}') center/cover no-repeat;
        padding: 70px 50px;
        overflow: hidden;
        border-radius: 30px;
        box-shadow: 0 20px 60px rgba(26, 58, 26, 0.25);
    }
    .home-cta-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(15,30,15,0.85) 0%, rgba(15,30,15,0.6) 55%, rgba(15,30,15,0.25) 100%);
        border-radius: 30px;
    }
    .home-cta-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }
    .home-cta-left { flex: 1; max-width: 460px; }
    .home-cta-label {
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
    .home-cta-label::after {
        content: '';
        display: block;
        height: 2px;
        width: 40px;
        background: var(--primary);
    }
    .home-cta-heading {
        color: #fff;
        font-size: 2.4rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 18px;
        white-space: nowrap;
    }
    .home-cta-desc {
        color: rgba(255,255,255,0.6);
        font-size: 0.95rem;
        line-height: 1.75;
    }
    .home-cta-card {
        width: 420px;
        flex-shrink: 0;
        background: rgba(22, 42, 22, 0.92);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 30px 28px;
        border: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    .home-cta-card-title { color: #fff; font-size: 1.25rem; font-weight: 800; margin-bottom: 6px; }
    .home-cta-card-sub { color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 20px; line-height: 1.5; }
    .home-cta-row { display: flex; gap: 10px; margin-bottom: 10px; }
    .home-cta-input {
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
    .home-cta-input::placeholder { color: rgba(255,255,255,0.35); }
    .home-cta-input:focus { outline: none; border-color: var(--primary); background: rgba(255,255,255,0.1); }
    .home-cta-input option { background: #1a2a1a; color: #fff; }
    .home-cta-textarea { display: block; width: 100%; height: 90px; resize: vertical; margin-bottom: 14px; margin-top: 10px; }
    .home-cta-submit {
        display: block; width: 100%; background: var(--primary); color: #fff; border: none;
        border-radius: 8px; padding: 13px; font-weight: 800; font-size: 0.85rem;
        letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; transition: all 0.3s;
    }
    .home-cta-submit:hover { background: #3a6b1a; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(139,195,74,0.3); }
    @media (max-width: 991px) {
        .home-cta-wrapper { padding: 40px 0 60px; }
        .home-cta-section { padding: 40px 24px; border-radius: 24px; }
        .home-cta-overlay { border-radius: 24px; }
        .home-cta-inner { flex-direction: column; }
        .home-cta-card { width: 100%; }
        .home-cta-heading { font-size: 1.8rem; }
    }
    @media (max-width: 575px) {
        .home-cta-wrapper { padding: 25px 0 40px; }
        .home-cta-section { padding: 25px 16px; border-radius: 18px; }
        .home-cta-overlay { border-radius: 18px; }
        .home-cta-heading { font-size: 1.3rem; }
        .home-cta-card { padding: 20px 16px; }
        .home-cta-card-title { font-size: 1.1rem; }
        .home-cta-row { flex-direction: column; gap: 8px; }
        .home-cta-input { padding: 10px 12px; font-size: 12px; }
        .home-cta-textarea { height: 65px; }
        .home-cta-submit { padding: 11px; font-size: 0.78rem; }
    }
</style>
@endsection

@section('scripts')
<script>
    // Scroll-triggered animations for service cards
    const svcObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                svcObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.svc-animate').forEach(el => svcObserver.observe(el));

    // Sync hero text with carousel slide
    const heroCarousel = document.getElementById('heroCarousel');
    if (heroCarousel) {
        heroCarousel.addEventListener('slide.bs.carousel', function(e) {
            const allTexts = document.querySelectorAll('.hero-slide-text');
            allTexts.forEach(el => {
                el.style.display = 'none';
                el.style.opacity = '0';
            });
            const activeText = document.querySelector('.hero-slide-text[data-slide="' + e.to + '"]');
            if (activeText) {
                activeText.style.display = 'block';
                setTimeout(() => { activeText.style.opacity = '1'; }, 50);
            }
        });
    }
</script>
@endsection

