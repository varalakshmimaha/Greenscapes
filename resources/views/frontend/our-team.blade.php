@extends('frontend.layouts.app')

@section('title', 'Our Team - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO BANNER ===== */
    .tm-hero {
        position: relative;
        width: 100%;
        height: 340px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .tm-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover no-repeat;
    }
    .tm-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(20,45,20,0.85) 0%, rgba(30,60,30,0.7) 100%);
    }
    .tm-hero-inner {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .tm-hero-inner h1 {
        color: #fff;
        font-size: 3rem;
        font-weight: 500;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }
    .tm-hero-inner p {
        color: rgba(255,255,255,0.8);
        font-size: 1.05rem;
        font-weight: 400;
        max-width: 580px;
        margin: 0 auto 18px;
        line-height: 1.7;
    }
    .tm-hero .breadcrumb-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 0.85rem;
    }
    .tm-hero .breadcrumb-row a { color: rgba(255,255,255,0.7); text-decoration: none; transition: color 0.2s; }
    .tm-hero .breadcrumb-row a:hover { color: var(--primary); }
    .tm-hero .breadcrumb-row .sep { color: rgba(255,255,255,0.35); font-size: 0.7rem; }
    .tm-hero .breadcrumb-row .current { color: var(--primary); font-weight: 500; }

    /* ===== TEAM PAGE WRAPPER ===== */
    .tm-page {
        background: #f4f9f0;
        padding: 60px 20px 80px;
    }
    .tm-page-inner {
        max-width: 900px;
        margin: 0 auto;
    }

    /* ===== PAGE HEADER (Eyebrow + Title + Subtext) ===== */
    .tm-page-header {
        text-align: center;
        margin-bottom: 48px;
    }
    .tm-eyebrow {
        font-size: 11px;
        color: #4a8a3e;
        letter-spacing: 0.12em;
        font-weight: 500;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .tm-page-header h2 {
        font-size: 2rem;
        font-weight: 600;
        color: #1a3d17;
        margin: 0 0 14px;
        letter-spacing: -0.3px;
    }
    .tm-page-header p {
        color: #666;
        font-size: 13px;
        line-height: 1.6;
        max-width: 640px;
        margin: 0 auto;
    }

    /* ===== SECTION DIVIDER (thin line + pill label) ===== */
    .tm-divider {
        display: flex;
        align-items: center;
        gap: 16px;
        margin: 44px 0 28px;
    }
    .tm-divider::before,
    .tm-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #c6dfc2;
    }
    .tm-divider-label {
        background: #fff;
        border: 1px solid #c6dfc2;
        color: #1a3d17;
        padding: 4px 20px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* ===== SECTION SUBTITLE ===== */
    .tm-section-sub {
        text-align: center;
        color: #666;
        font-size: 13px;
        line-height: 1.6;
        margin: -12px 0 24px;
    }

    /* ===== AVATAR ===== */
    .tm-avatar {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 3px solid #c6dfc2;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        overflow: hidden;
        transition: border-color 0.3s;
        flex-shrink: 0;
    }
    .tm-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .tm-avatar-initials {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e8f5e2, #d4eaca);
        color: #2d5a27;
        font-size: 1.5rem;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* ===== CARD BASE ===== */
    .tm-card {
        background: #fff;
        border: 1px solid #e0edd8;
        border-radius: 16px;
        padding: 28px 24px;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
    }
    .tm-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(45,90,39,0.12);
        border-color: #b8d8b0;
    }
    .tm-card:hover .tm-avatar {
        border-color: #4a8a3e;
    }
    .tm-card .tm-name {
        font-size: 16px;
        font-weight: 600;
        color: #1a3d17;
        margin: 0 0 4px;
    }
    .tm-card .tm-role {
        font-size: 13px;
        font-weight: 500;
        font-style: italic;
        color: #4a8a3e;
        margin: 0 0 10px;
    }
    .tm-card .tm-bio {
        font-size: 13px;
        color: #666;
        line-height: 1.6;
        margin: 0;
    }

    /* ===== LEADERSHIP GRID: 2-column, equal, 24px gap ===== */
    .tm-leadership-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }

    /* ===== ADVISORS GRID: 2-column centered, narrower cards ===== */
    .tm-advisors-grid {
        display: grid;
        grid-template-columns: repeat(2, 200px);
        gap: 24px;
        justify-content: center;
    }
    .tm-advisors-grid .tm-card {
        padding: 24px 16px;
    }
    .tm-advisors-grid .tm-card .tm-bio {
        display: none;
    }

    /* ===== OPERATIONS GRID: flex-wrap centered, expandable ===== */
    .tm-operations-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        justify-content: center;
    }
    .tm-operations-grid .tm-card {
        width: 200px;
        padding: 24px 16px;
    }

    /* ===== EMPTY STATE ===== */
    .tm-empty {
        text-align: center;
        padding: 60px 20px;
    }
    .tm-empty i { font-size: 3rem; color: #ccc; margin-bottom: 16px; display: block; }
    .tm-empty p { color: #999; font-size: 1rem; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .tm-hero { height: 280px; }
        .tm-hero-inner h1 { font-size: 2.4rem; }
    }
    @media (max-width: 700px) {
        .tm-leadership-grid { grid-template-columns: repeat(2, 1fr); }
        .tm-advisors-grid { grid-template-columns: repeat(2, 1fr); }
        .tm-operations-grid .tm-card { width: calc(50% - 12px); }
    }
    @media (max-width: 480px) {
        .tm-hero { height: 240px; padding: 80px 15px 40px; }
        .tm-hero-inner h1 { font-size: 1.4rem; }
        .tm-hero-inner p { font-size: 0.82rem; }
        .tm-page { padding: 40px 16px 60px; }
        .tm-page-header { margin-bottom: 36px; }
        .tm-page-header h2 { font-size: 1.6rem; }
        .tm-avatar { width: 70px; height: 70px; }
        .tm-avatar-initials { font-size: 20px; }
        .tm-card .tm-name { font-size: 0.9rem; }
        .tm-card .tm-role { font-size: 0.75rem; }
        .tm-leadership-grid { grid-template-columns: 1fr; gap: 16px; }
        .tm-advisors-grid { grid-template-columns: 1fr; gap: 16px; }
        .tm-operations-grid { gap: 16px; }
        .tm-operations-grid .tm-card { width: 100%; }
        .tm-divider { margin: 32px 0 20px; }
        .tm-divider-label { white-space: normal; font-size: 11px; }
    }
    @media (max-width: 320px) {
        .tm-hero { height: 220px; padding: 70px 10px 30px; }
        .tm-hero-inner h1 { font-size: 1.2rem; }
        .tm-hero-inner p { font-size: 0.78rem; }
        .tm-page { padding: 30px 10px 50px; }
        .tm-page-header h2 { font-size: 1.35rem; }
        .tm-avatar { width: 60px; height: 60px; }
        .tm-avatar-initials { font-size: 17px; }
        .tm-card { padding: 20px 14px; border-radius: 12px; }
        .tm-card .tm-name { font-size: 0.85rem; }
        .tm-card .tm-role { font-size: 0.7rem; }
        .tm-card .tm-bio { font-size: 12px; }
        .tm-divider-label { font-size: 10px; padding: 3px 14px; }
    }
</style>
@endsection

@section('content')

<!-- ==================== HERO BANNER ==================== -->
<section class="tm-hero">
    <div class="tm-hero-inner" data-aos="fade-up">
        <h1>Our Team</h1>
        <p>Meet the people behind SR Greenscapes — blending expertise, creativity, and passion for sustainable landscapes.</p>
        <div class="breadcrumb-row">
            <a href="/"><i class="fas fa-home"></i></a>
            <span class="sep"><i class="fas fa-chevron-right"></i></span>
            <a href="/about">About Us</a>
            <span class="sep"><i class="fas fa-chevron-right"></i></span>
            <span class="current">Our Team</span>
        </div>
    </div>
</section>

<!-- ==================== TEAM CONTENT ==================== -->
<div class="tm-page">
    <div class="tm-page-inner">

        <!-- Page Header: Eyebrow + Title + Subtext -->
        <div class="tm-page-header" data-aos="fade-up">
            <div class="tm-eyebrow">Meet Our Experts</div>
            <h2>Our Expert Team</h2>
            <p>The leadership and advisory team at SR Greenscapes Pvt Ltd combine academic excellence, field expertise and research-driven innovation to deliver sustainable and scientifically planned landscape solutions across India.</p>
        </div>

        <!-- ==================== DYNAMIC SECTIONS ==================== -->
        @if($teamCategories->count())
            @foreach($teamCategories as $catIndex => $category)
                @if($category->members->count())

                    <!-- Divider: {{ $category->name }} -->
                    <div class="tm-divider" data-aos="fade-up">
                        <span class="tm-divider-label">{{ $category->name }}</span>
                    </div>

                    @if($catIndex === 1)
                        <p class="tm-section-sub" data-aos="fade-up">Our external advisors guiding us with their expert insights.</p>
                    @endif

                    @if($catIndex === 0)
                        <!-- LEADERSHIP: 2-column equal grid -->
                        <div class="tm-leadership-grid">
                            @foreach($category->members as $member)
                                <article class="tm-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                    <div class="tm-avatar" aria-label="Avatar of {{ $member->name }}">
                                        @if($member->photo)
                                            <img loading="lazy" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                                        @else
                                            <div class="tm-avatar-initials">{{ collect(explode(' ', $member->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->filter(fn($l) => ctype_alpha($l))->take(2)->implode('') }}</div>
                                        @endif
                                    </div>
                                    <h3 class="tm-name">{{ $member->name }}</h3>
                                    <div class="tm-role">{{ $member->role }}</div>
                                    @if($member->bio)
                                        <p class="tm-bio">{{ Str::limit($member->bio, 140) }}</p>
                                    @endif
                                </article>
                            @endforeach
                        </div>

                    @elseif($catIndex === 1)
                        <!-- ADVISORS: 2-column centered, narrower cards -->
                        <div class="tm-advisors-grid">
                            @foreach($category->members as $member)
                                <article class="tm-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                    <div class="tm-avatar" aria-label="Avatar of {{ $member->name }}">
                                        @if($member->photo)
                                            <img loading="lazy" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                                        @else
                                            <div class="tm-avatar-initials">{{ collect(explode(' ', $member->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->filter(fn($l) => ctype_alpha($l))->take(2)->implode('') }}</div>
                                        @endif
                                    </div>
                                    <h3 class="tm-name">{{ $member->name }}</h3>
                                    <div class="tm-role">{{ $member->role }}</div>
                                </article>
                            @endforeach
                        </div>

                    @else
                        <!-- OPERATIONS / OTHER: flex-wrap centered, expandable -->
                        <div class="tm-operations-grid">
                            @foreach($category->members as $member)
                                <article class="tm-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                    <div class="tm-avatar" aria-label="Avatar of {{ $member->name }}">
                                        @if($member->photo)
                                            <img loading="lazy" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                                        @else
                                            <div class="tm-avatar-initials">{{ collect(explode(' ', $member->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->filter(fn($l) => ctype_alpha($l))->take(2)->implode('') }}</div>
                                        @endif
                                    </div>
                                    <h3 class="tm-name">{{ $member->name }}</h3>
                                    <div class="tm-role">{{ $member->role }}</div>
                                </article>
                            @endforeach
                        </div>
                    @endif

                @endif
            @endforeach
        @endif

        <!-- ==================== UNCATEGORIZED MEMBERS ==================== -->
        @php
            $categorizedIds = $teamCategories->pluck('members')->flatten()->pluck('id');
            $uncategorized = $teamMembers->whereNotIn('id', $categorizedIds);
        @endphp

        @if($uncategorized->count())
            <div class="tm-divider" data-aos="fade-up">
                <span class="tm-divider-label">Team Members</span>
            </div>
            <div class="tm-operations-grid">
                @foreach($uncategorized as $member)
                    <article class="tm-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="tm-avatar" aria-label="Avatar of {{ $member->name }}">
                            @if($member->photo)
                                <img loading="lazy" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                            @else
                                <div class="tm-avatar-initials">{{ collect(explode(' ', $member->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->filter(fn($l) => ctype_alpha($l))->take(2)->implode('') }}</div>
                            @endif
                        </div>
                        <h3 class="tm-name">{{ $member->name }}</h3>
                        <div class="tm-role">{{ $member->role }}</div>
                    </article>
                @endforeach
            </div>
        @endif

        <!-- ==================== EMPTY STATE ==================== -->
        @if(!$teamMembers->count() && !$teamCategories->sum(fn($c) => $c->members->count()))
            <div class="tm-empty">
                <i class="fas fa-users"></i>
                <p>No team members found.</p>
            </div>
        @endif

    </div>
</div>

@endsection
