@extends('frontend.layouts.app')

@section('title', ($activeCategory ? $activeCategory->name . ' Team' : 'Our Team') . ' - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO ===== */
    .team-hero {
        position: relative;
        width: 100%;
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .team-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover no-repeat;
    }
    .team-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(20, 45, 25, 0.75);
    }
    .team-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .team-hero-content h1 {
        color: #fff;
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 12px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .team-hero-content p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* ===== CATEGORY TABS ===== */
    .team-tabs {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 40px 0 10px;
    }
    .team-tab {
        padding: 10px 28px;
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        border: 2px solid var(--primary);
        color: var(--primary);
        background: transparent;
    }
    .team-tab:hover {
        background: var(--primary);
        color: #fff;
    }
    .team-tab.active {
        background: var(--primary);
        color: #fff;
        box-shadow: 0 4px 15px rgba(139,195,74,0.3);
    }

    /* ===== TEAM CARDS ===== */
    .team-grid {
        padding: 40px 0 80px;
    }
    .team-member-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0,0,0,0.06);
        transition: all 0.3s;
        height: 100%;
        border: 1px solid #eee;
    }
    .team-member-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 45px rgba(0,0,0,0.12);
        border-color: rgba(139,195,74,0.3);
    }
    .team-member-img {
        height: 280px;
        overflow: hidden;
        position: relative;
    }
    .team-member-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .team-member-card:hover .team-member-img img {
        transform: scale(1.05);
    }
    .team-member-img .team-category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: var(--primary);
        color: #fff;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .team-member-info {
        padding: 25px;
        text-align: center;
    }
    .team-member-info h5 {
        font-weight: 700;
        color: #1a3a1a;
        font-size: 1.1rem;
        margin-bottom: 6px;
    }
    .team-member-info .role {
        color: var(--primary);
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 12px;
    }
    .team-member-info .bio {
        color: #777;
        font-size: 0.82rem;
        line-height: 1.6;
        margin-bottom: 16px;
    }
    .team-social-links {
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    .team-social-links a {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(139,195,74,0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        transition: all 0.3s;
        text-decoration: none;
    }
    .team-social-links a:hover {
        background: var(--primary);
        color: #fff;
        transform: translateY(-2px);
    }

    /* ===== EMPTY STATE ===== */
    .team-empty {
        text-align: center;
        padding: 60px 20px;
    }
    .team-empty i {
        font-size: 3rem;
        color: #ccc;
        margin-bottom: 16px;
    }
    .team-empty p {
        color: #999;
        font-size: 1rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .team-hero { height: 260px; }
        .team-hero-content h1 { font-size: 2.2rem; }
        .team-member-img { height: 240px; }
    }
    @media (max-width: 575px) {
        .team-hero { height: 220px; }
        .team-hero-content h1 { font-size: 1.6rem; }
        .team-hero-content p { font-size: 0.9rem; }
        .team-tabs { gap: 8px; padding: 25px 0 5px; }
        .team-tab { padding: 8px 20px; font-size: 0.78rem; }
        .team-member-img { height: 200px; }
        .team-member-info { padding: 18px 16px; }
        .team-member-info h5 { font-size: 0.95rem; }
        .team-member-info .bio { font-size: 0.78rem; }
        .team-grid { padding: 25px 0 50px; }
    }
</style>
@endsection

@section('content')

<!-- Hero Banner -->
<div class="team-hero">
    <div class="team-hero-content" data-aos="fade-up">
        <h1>Our Team</h1>
        <p>Meet the passionate experts driving innovation in sustainable landscaping</p>
    </div>
</div>

<!-- Category Tabs -->
<section style="background: #f9fbf9;">
    <div class="container">
        <div class="team-tabs">
            @foreach($teamCategories as $tc)
                <a href="{{ url('/our-team?category=' . $tc->slug) }}"
                   class="team-tab {{ isset($activeCategory) && $activeCategory && $activeCategory->id === $tc->id ? 'active' : '' }}">
                    {{ $tc->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Team Members Grid -->
<section class="team-grid" style="background: #f9fbf9;">
    <div class="container">
        @if($teamMembers->count())
            <div class="row g-4">
                @foreach($teamMembers as $member)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="team-member-card">
                            <div class="team-member-img">
                                @if($member->photo)
                                    <img loading="lazy" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                                @else
                                    <div style="width:100%;height:100%;background:#f0f7f0;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-user" style="font-size:4rem;color:#d0e0d0;"></i>
                                    </div>
                                @endif
                                @if($member->category)
                                    <span class="team-category-badge">{{ $member->category->name }}</span>
                                @endif
                            </div>
                            <div class="team-member-info">
                                <h5>{{ $member->name }}</h5>
                                <div class="role">{{ $member->role }}</div>
                                @if($member->bio)
                                    <p class="bio">{{ Str::limit($member->bio, 120) }}</p>
                                @endif
                                <div class="team-social-links">
                                    @if($member->linkedin)
                                        <a href="{{ $member->linkedin }}" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                    @if($member->facebook)
                                        <a href="{{ $member->facebook }}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if($member->instagram)
                                        <a href="{{ $member->instagram }}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="team-empty">
                <i class="fas fa-users"></i>
                <p>No team members found in this category.</p>
            </div>
        @endif
    </div>
</section>

@endsection
