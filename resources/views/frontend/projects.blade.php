@extends('frontend.layouts.app')

@section('title', 'Projects - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO ===== */
    .projects-hero {
        position: relative;
        width: 100%;
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .projects-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('{{ asset('storage/Home/1.5 Cover photo 5.jpg') }}') center/cover no-repeat;
    }
    .projects-hero::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(20, 45, 25, 0.70);
    }
    .projects-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .projects-hero-content h1 {
        color: #fff;
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .projects-hero-content .breadcrumb {
        justify-content: center;
        margin-top: 10px;
    }
    .projects-hero-content .breadcrumb a {
        color: var(--accent);
        text-decoration: none;
    }
    .projects-hero-content .breadcrumb-item.active {
        color: rgba(255,255,255,0.6);
    }

    /* ===== FILTER BUTTONS ===== */
    .filter-btns {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-bottom: 40px;
    }
    .filter-btns .filter-btn {
        padding: 8px 22px;
        border-radius: 50px;
        border: 2px solid #ddd;
        background: #fff;
        color: #555;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    .filter-btns .filter-btn:hover,
    .filter-btns .filter-btn.active {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }

    /* ===== PROJECT CARD ===== */
    .proj-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.3s;
        height: 380px;
        position: relative;
        cursor: pointer;
        border: 1px solid #eee;
        background: #fff;
    }
    .proj-card:hover {
        box-shadow: 0 12px 40px rgba(0,0,0,0.14);
        transform: translateY(-6px);
    }
    .proj-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .proj-card:hover img {
        transform: scale(1.05);
    }
    .proj-card .proj-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #fff;
        color: var(--dark);
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        z-index: 2;
    }
    .proj-card .proj-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 25px 20px;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        z-index: 2;
    }
    .proj-card .proj-overlay h5 {
        color: #fff;
        font-weight: 700;
        font-size: 1.05rem;
        margin-bottom: 5px;
    }
    .proj-card .proj-overlay p {
        color: rgba(255,255,255,0.7);
        font-size: 0.8rem;
        margin: 0;
    }
    .proj-card .view-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        width: 50px;
        height: 50px;
        background: var(--primary);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        z-index: 3;
        transition: transform 0.3s;
        text-decoration: none;
    }
    .proj-card:hover .view-btn {
        transform: translate(-50%, -50%) scale(1);
    }
</style>
@endsection

@section('content')

<!-- Hero Section -->
<div class="projects-hero">
    <div class="projects-hero-content" data-aos="fade-up">
        <h1>Our Projects</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Projects</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Projects Grid -->
<section class="py-5" style="background: #f9fbf9;">
    <div class="container py-4">

        <!-- Filter Buttons -->
        <div class="filter-btns" data-aos="fade-up">
            <button class="filter-btn active" onclick="filterProjects('all', this)">All</button>
            <button class="filter-btn" onclick="filterProjects('RESIDENTIAL', this)">Residential</button>
            <button class="filter-btn" onclick="filterProjects('COMMERCIAL', this)">Commercial</button>
            <button class="filter-btn" onclick="filterProjects('INSTITUTIONAL', this)">Institutional</button>
            <button class="filter-btn" onclick="filterProjects('SPECIALIZED', this)">Specialized</button>
        </div>

        @php
            $fallbackProjects = [
                (object)['title' => 'Villa Garden Design', 'slug' => 'sample-project', 'client_name' => 'Bengaluru, Karnataka', 'status' => 'RESIDENTIAL', 'image' => 'Home/1.1Cover photo 1.jpg'],
                (object)['title' => 'Corporate Campus Landscape', 'slug' => 'sample-project', 'client_name' => 'Bengaluru, Karnataka', 'status' => 'COMMERCIAL', 'image' => 'Home/1.2 Cover photo 2.jpg'],
                (object)['title' => 'School & Institutional Garden', 'slug' => 'sample-project', 'client_name' => 'Hoskote, Karnataka', 'status' => 'INSTITUTIONAL', 'image' => 'Home/1.3 Cover photo 3.jpg'],
                (object)['title' => 'Terrace & Rooftop Garden', 'slug' => 'sample-project', 'client_name' => 'Bengaluru, Karnataka', 'status' => 'RESIDENTIAL', 'image' => 'Home/1.4 Cover photo  4.jpg'],
                (object)['title' => 'Resort & Hotel Landscape', 'slug' => 'sample-project', 'client_name' => 'Bengaluru, Karnataka', 'status' => 'COMMERCIAL', 'image' => 'Home/1.5 Cover photo 5.jpg'],
                (object)['title' => 'Miyawaki Forest Project', 'slug' => 'sample-project', 'client_name' => 'Pan-India', 'status' => 'SPECIALIZED', 'image' => 'Home/1.6 Cover photo 6.jpg'],
            ];
            $activeProjects = (isset($projects) && $projects->count()) ? $projects : collect($fallbackProjects);
        @endphp

        <div class="row g-4" id="projectsGrid">
            @foreach($activeProjects as $project)
                <div class="col-lg-4 col-md-6 project-item" data-type="{{ $project->status ?? 'RESIDENTIAL' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <a href="{{ route('project.detail', $project->slug) }}" class="text-decoration-none">
                        <div class="proj-card">
                            <img src="{{ asset('storage/' . ($project->image ?? $project->after_image ?? 'Home/1.1Cover photo 1.jpg')) }}" alt="{{ $project->title }}">
                            <div class="proj-badge">{{ $project->status ?? 'RESIDENTIAL' }}</div>
                            <div class="view-btn"><i class="fas fa-arrow-right"></i></div>
                            <div class="proj-overlay">
                                <h5>{{ $project->title }}</h5>
                                <p><i class="fas fa-map-marker-alt me-1"></i> {{ $project->client_name ?? 'Location' }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        @if(isset($projects) && $projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $projects->links() }}
            </div>
        @endif

    </div>
</section>

<!-- Stats / Counter Section -->
<section class="stats-bar-section py-5 my-0 position-relative" style="background: url('{{ asset('storage/Home/1.7 Cover photo 7.jpg') }}') center/cover fixed no-repeat; overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(17, 45, 20, 0.85); z-index: 0;"></div>
    <div class="position-absolute rounded-circle" style="width: 300px; height: 300px; background: rgba(189, 228, 57, 0.1); top: -100px; left: -100px; filter: blur(80px); z-index: 0;"></div>
    <div class="position-absolute rounded-circle" style="width: 400px; height: 400px; background: rgba(255, 255, 255, 0.05); bottom: -150px; right: -100px; filter: blur(100px); z-index: 0;"></div>

    <div class="container position-relative z-1 py-4">
        <div class="row justify-content-center g-4">
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
                $activeStats = (isset($counters) && $counters->count()) ? $counters : collect($fallbackStats);
            @endphp

            @foreach($activeStats as $stat)
            <div class="col-6 col-md-4 col-lg text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="rounded-4 py-4 px-3"
                     style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); transition: transform 0.3s;"
                     onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="mb-4 d-flex align-items-center justify-content-center"
                         style="width: 60px; height: 60px; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); border-radius: 12px; transform: rotate(45deg); margin: 0 auto;">
                        <i class="{{ $stat->icon }} text-white fs-4" style="transform: rotate(-45deg);"></i>
                    </div>
                    <div class="text-white fw-bold lh-1 mb-3" style="font-size: 2.8rem;">{{ $stat->number }}{{ $stat->suffix }}</div>
                    <div class="d-flex align-items-center justify-content-center w-100 px-3 mb-3">
                        <div style="flex-grow: 1; height: 1px; background: rgba(255,255,255,0.4);"></div>
                        <div style="width: 6px; height: 6px; border-radius: 50%; background: #fff; margin: 0 8px;"></div>
                        <div style="flex-grow: 1; height: 1px; background: rgba(255,255,255,0.4);"></div>
                    </div>
                    <div class="text-white fw-bold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">{{ $stat->label }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5" style="background: #fff;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <p class="about-label d-flex justify-content-center">Testimonials</p>
            <h2 class="section-title">What Our Clients Say</h2>
        </div>

        @php
            $fallbackTestimonials = [
                (object)['name' => 'Eleanor Pena', 'designation' => 'Founder', 'content' => 'They improved our lawn beautifully. The turfing looks fresh, even, and very professionally done.', 'photo' => null, 'rating' => 5],
                (object)['name' => 'Emily Carter', 'designation' => 'Senior Project Manager', 'content' => 'The team worked with care and kept us updated throughout the process. We\'re really happy with the final result.', 'photo' => null, 'rating' => 5],
                (object)['name' => 'Bessie Cooper', 'designation' => 'Client', 'content' => 'Scientific approach and professional execution. Our corporate campus has never looked better.', 'photo' => null, 'rating' => 5],
            ];
            $activeTestimonials = (isset($testimonials) && $testimonials->count()) ? $testimonials : collect($fallbackTestimonials);
        @endphp

        <div class="row g-4">
            @foreach($activeTestimonials->take(3) as $t)
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="p-4 h-100 rounded-4" style="background: #f9fbf9; border: 1px solid #eee;">
                    <div class="mb-3" style="color: #f59e0b; font-size: 0.9rem;">
                        @for($i = 0; $i < ($t->rating ?? 5); $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                    </div>
                    <p class="mb-4" style="color: #555; font-style: italic; line-height: 1.7; font-size: 0.95rem;">"{{ $t->content ?? $t->message ?? '' }}"</p>
                    <div class="d-flex align-items-center gap-3">
                        @php $tPhoto = $t->photo ?? null; @endphp
                        @if($tPhoto)
                            <img src="{{ asset('storage/' . $tPhoto) }}" alt="{{ $t->name }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                        @else
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(139,195,74,0.15); border: 2px solid var(--primary); display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.2rem;">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div>
                            <div style="font-weight: 700; color: #1a3a1a; font-size: 0.95rem;">{{ $t->name }}</div>
                            <div style="color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">{{ $t->designation ?? $t->role ?? '' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@section('cta')
<!-- Projects Page CTA — Book Consultation -->
<section class="proj-cta-wrapper">
    <div class="container">
        <div class="proj-cta-section">
            <div class="proj-cta-overlay"></div>
            <div class="proj-cta-inner">
                <div class="proj-cta-left">
                    <h2 class="proj-cta-company">SR GREENSCAPES PVT LTD</h2>
                    <p class="proj-cta-tagline"><i class="fas fa-leaf"></i> Sowing Science, Growing Beauty</p>
                    <p class="proj-cta-desc">Have a similar project in mind?<br>Fill out the form and we'll get back to you with a free initial estimate.</p>
                </div>
                <div class="proj-cta-card">
                    <h4 class="proj-cta-card-title">Book Consultation</h4>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="projects-cta">
                        <div class="proj-cta-row">
                            <input type="text" name="name" class="proj-cta-input" placeholder="Name *" required>
                            <input type="text" name="phone" class="proj-cta-input" placeholder="Phone *" required>
                        </div>
                        <div class="proj-cta-row">
                            <input type="text" name="subject" class="proj-cta-input" placeholder="City">
                            <select name="message" class="proj-cta-input" required>
                                <option value="">Select Service *</option>
                                <option>Residential Landscaping</option>
                                <option>Commercial Landscaping</option>
                                <option>Terrace / Rooftop Garden</option>
                                <option>Miyawaki Forest</option>
                                <option>Maintenance (AMC)</option>
                                <option>Vertical Garden</option>
                                <option>Water Bodies</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <textarea name="details" class="proj-cta-input proj-cta-textarea" placeholder="Message"></textarea>
                        <button type="submit" class="proj-cta-submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .proj-cta-wrapper { padding: 60px 0 80px; background: #f9fbf7; }
    .proj-cta-section { position: relative; background: url('{{ asset('storage/banners/ghizQFprxQKdakI2dh7yYoZFnsO6LSqSV8dm95lV.jpg') }}') center/cover no-repeat; padding: 60px 50px; overflow: hidden; border-radius: 30px; box-shadow: 0 20px 60px rgba(26,58,26,0.25); }
    .proj-cta-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(15,30,15,0.85) 0%, rgba(15,30,15,0.55) 55%, rgba(15,30,15,0.3) 100%); border-radius: 30px; }
    .proj-cta-inner { position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; gap: 40px; }
    .proj-cta-left { flex: 1; max-width: 460px; }
    .proj-cta-company { color: #fff; font-size: 1.8rem; font-weight: 900; letter-spacing: 1px; margin-bottom: 12px; }
    .proj-cta-tagline { color: var(--primary); font-size: 1rem; font-weight: 500; font-style: italic; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
    .proj-cta-desc { color: rgba(255,255,255,0.6); font-size: 0.95rem; line-height: 1.75; }
    .proj-cta-card { width: 420px; flex-shrink: 0; background: rgba(255,255,255,0.97); border-radius: 12px; padding: 30px 25px; box-shadow: 0 15px 40px rgba(0,0,0,0.2); }
    .proj-cta-card-title { font-weight: 800; color: var(--dark); margin-bottom: 20px; font-size: 1.3rem; }
    .proj-cta-row { display: flex; gap: 10px; margin-bottom: 10px; }
    .proj-cta-input { flex: 1; border: 1px solid #e0e0e0; border-radius: 8px; padding: 11px 14px; font-size: 13px; background: #fafafa; width: 100%; transition: border-color 0.2s; color: var(--dark); }
    .proj-cta-input::placeholder { color: #999; }
    .proj-cta-input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(76,175,80,0.1); }
    .proj-cta-input option { background: #fff; color: var(--dark); }
    .proj-cta-textarea { display: block; width: 100%; height: 80px; resize: vertical; margin-bottom: 12px; }
    .proj-cta-submit { display: block; width: 100%; background: var(--primary); color: #fff; border: none; border-radius: 8px; padding: 13px; font-weight: 800; font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; cursor: pointer; transition: all 0.3s; }
    .proj-cta-submit:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(139,195,74,0.3); }
    @media (max-width: 991px) {
        .proj-cta-wrapper { padding: 40px 0 60px; }
        .proj-cta-section { padding: 40px 24px; border-radius: 24px; }
        .proj-cta-overlay { border-radius: 24px; }
        .proj-cta-inner { flex-direction: column; }
        .proj-cta-card { width: 100%; }
        .proj-cta-company { font-size: 1.4rem; }
    }
</style>
@endsection

@endsection

@section('scripts')
<script>
    function filterProjects(type, btn) {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.project-item').forEach(item => {
            if (type === 'all' || item.dataset.type === type) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endsection
