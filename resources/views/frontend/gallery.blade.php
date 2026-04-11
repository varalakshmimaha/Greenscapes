@extends('frontend.layouts.app')

@section('title', 'Gallery - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO ===== */
    .gallery-hero {
        position: relative;
        width: 100%;
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .gallery-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset('storage/Home/1.6 Cover photo 6.jpg') }}') center/cover no-repeat;
    }
    .gallery-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(20, 45, 25, 0.75);
    }
    .gallery-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .gallery-hero-content h1 {
        color: #fff;
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 12px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .gallery-hero-content p {
        color: rgba(255,255,255,0.9);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* ===== FILTER TABS ===== */
    .gallery-filters {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        padding: 40px 0 10px;
    }
    .gallery-filters .gbtn {
        padding: 10px 28px;
        border-radius: 50px;
        border: 2px solid var(--primary);
        background: transparent;
        color: var(--primary);
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    .gallery-filters .gbtn:hover,
    .gallery-filters .gbtn.active {
        background: var(--primary);
        color: #fff;
        box-shadow: 0 4px 15px rgba(139,195,74,0.3);
    }

    /* ===== EQUAL GRID ===== */
    .gallery-grid {
        padding: 40px 0 80px;
    }
    .gallery-item {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.4s;
        height: 320px;
    }
    .gallery-item:hover {
        box-shadow: 0 15px 45px rgba(0,0,0,0.15);
        transform: translateY(-6px);
    }
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s;
    }
    .gallery-item:hover img {
        transform: scale(1.05);
    }
    .gallery-item .g-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(transparent 40%, rgba(0,0,0,0.75));
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 25px;
    }
    .gallery-item:hover .g-overlay {
        opacity: 1;
    }
    .g-overlay h5 {
        color: #fff;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 4px;
    }
    .g-overlay span {
        color: var(--primary);
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .gallery-item .g-zoom {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        width: 56px;
        height: 56px;
        background: var(--primary);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        z-index: 3;
        transition: transform 0.3s;
        box-shadow: 0 4px 15px rgba(139,195,74,0.4);
    }
    .gallery-item:hover .g-zoom {
        transform: translate(-50%, -50%) scale(1);
    }

    /* ===== LIGHTBOX SLIDER ===== */
    .lightbox-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.95);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    .lightbox-backdrop.active {
        display: flex;
    }
    .lightbox-close {
        position: absolute;
        top: 15px;
        right: 20px;
        background: none;
        border: none;
        color: #fff;
        font-size: 2.5rem;
        cursor: pointer;
        z-index: 10001;
        transition: color 0.3s;
        line-height: 1;
    }
    .lightbox-close:hover { color: var(--primary); }

    .lightbox-container {
        position: relative;
        width: 90vw;
        height: 85vh;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .lightbox-container img {
        max-width: 100%;
        max-height: 80vh;
        border-radius: 10px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        object-fit: contain;
        background: transparent;
        padding: 0;
        min-width: 60vw;
        min-height: 60vh;
    }
    .lightbox-caption {
        color: #fff;
        margin-top: 14px;
        font-size: 1.15rem;
        font-weight: 600;
    }
    .lightbox-caption .lb-cat {
        display: block;
        color: var(--primary);
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 4px;
    }
    .lightbox-counter {
        color: rgba(255,255,255,0.5);
        font-size: 0.85rem;
        margin-top: 6px;
    }

    .lightbox-nav {
        position: fixed;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.1);
        border: 2px solid rgba(255,255,255,0.25);
        color: #fff;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        cursor: pointer;
        transition: all 0.3s;
        z-index: 10001;
    }
    .lightbox-nav:hover {
        background: var(--primary);
        border-color: var(--primary);
    }
    .lightbox-prev { left: 25px; }
    .lightbox-next { right: 25px; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 991px) {
        .gallery-hero { height: 260px; }
        .gallery-hero-content h1 { font-size: 2.2rem; }
        .gallery-item { height: 280px; }
        .lightbox-prev { left: 10px; }
        .lightbox-next { right: 10px; }
        .lightbox-nav { width: 45px; height: 45px; font-size: 1.1rem; }
    }
    @media (max-width: 575px) {
        .gallery-hero { height: 220px; }
        .gallery-hero-content h1 { font-size: 1.6rem; }
        .gallery-hero-content p { font-size: 0.9rem; }
        .gallery-filters { gap: 8px; padding: 25px 0 5px; }
        .gallery-filters .gbtn { padding: 8px 18px; font-size: 0.78rem; }
        .gallery-item { height: 220px; }
        .gallery-grid { padding: 25px 0 50px; }
        .lightbox-prev { left: 8px; }
        .lightbox-next { right: 8px; }
        .lightbox-nav { width: 38px; height: 38px; font-size: 0.9rem; }
    }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="gallery-hero">
    <div class="gallery-hero-content" data-aos="fade-up">
        <h1>Our Gallery</h1>
        <p>A visual showcase of our landscape transformations and green space creations</p>
    </div>
</div>

<!-- Filter Tabs -->
<section style="background: #f9fbf9;">
    <div class="container">
        @if(isset($categories) && $categories->count())
        <div class="gallery-filters" data-aos="fade-up">
            <button class="gbtn active" onclick="filterGallery('all', this)">All</button>
            @foreach($categories as $cat)
                <button class="gbtn" onclick="filterGallery('{{ $cat }}', this)">{{ $cat }}</button>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Gallery Grid -->
<section class="gallery-grid" style="background: #f9fbf9;">
    <div class="container">
        <div class="row g-4" id="galleryGrid">
            @forelse($gallery as $idx => $item)
                <div class="col-lg-3 col-md-4 col-sm-6 gallery-grid-item" data-category="{{ $item->category ?? '' }}" data-aos="fade-up" data-aos-delay="{{ ($idx % 4) * 80 }}">
                    <div class="gallery-item" onclick="openLightbox({{ $idx }})">
                        <img loading="lazy" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title ?? 'Gallery' }}">
                        <div class="g-zoom"><i class="fas fa-expand"></i></div>
                        <div class="g-overlay">
                            @if($item->title)<h5>{{ $item->title }}</h5>@endif
                            @if($item->category)<span>{{ $item->category }}</span>@endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-images" style="font-size:3rem;color:#ccc;margin-bottom:16px;"></i>
                    <p style="color:#999;">No gallery images available yet.</p>
                </div>
            @endforelse
        </div>

        @if($gallery instanceof \Illuminate\Pagination\LengthAwarePaginator && $gallery->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $gallery->links() }}
            </div>
        @endif
    </div>
</section>

<!-- Lightbox Slider -->
<div class="lightbox-backdrop" id="lightbox">
    <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
    <button class="lightbox-nav lightbox-prev" onclick="navigateLightbox(-1)"><i class="fas fa-chevron-left"></i></button>
    <div class="lightbox-container">
        <img id="lightboxImg" src="" alt="">
        <div class="lightbox-caption">
            <span id="lightboxTitle"></span>
            <span class="lb-cat" id="lightboxCategory"></span>
        </div>
        <div class="lightbox-counter" id="lightboxCounter"></div>
    </div>
    <button class="lightbox-nav lightbox-next" onclick="navigateLightbox(1)"><i class="fas fa-chevron-right"></i></button>
</div>

@endsection

@section('scripts')
<script>
const galleryItems = [
    @foreach($gallery as $item)
    {
        src: '{{ asset("storage/" . $item->image) }}',
        title: '{{ addslashes($item->title ?? "") }}',
        category: '{{ addslashes($item->category ?? "") }}'
    },
    @endforeach
];

let currentIndex = 0;
let visibleItems = [];

function getVisibleItems() {
    const items = document.querySelectorAll('.gallery-grid-item');
    visibleItems = [];
    items.forEach((item, idx) => {
        if (item.style.display !== 'none') {
            visibleItems.push(idx);
        }
    });
}

function openLightbox(idx) {
    getVisibleItems();
    currentIndex = visibleItems.indexOf(idx);
    if (currentIndex === -1) currentIndex = 0;
    showSlide();
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = '';
}

function navigateLightbox(dir) {
    currentIndex += dir;
    if (currentIndex < 0) currentIndex = visibleItems.length - 1;
    if (currentIndex >= visibleItems.length) currentIndex = 0;
    showSlide();
}

function showSlide() {
    const realIdx = visibleItems[currentIndex];
    const item = galleryItems[realIdx];
    const img = document.getElementById('lightboxImg');
    img.style.opacity = '0';
    setTimeout(() => {
        img.src = item.src;
        document.getElementById('lightboxTitle').textContent = item.title;
        document.getElementById('lightboxCategory').textContent = item.category;
        document.getElementById('lightboxCounter').textContent = (currentIndex + 1) + ' / ' + visibleItems.length;
        img.style.opacity = '1';
    }, 150);
    img.style.transition = 'opacity 0.3s';
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lb = document.getElementById('lightbox');
    if (!lb.classList.contains('active')) return;
    if (e.key === 'ArrowLeft') navigateLightbox(-1);
    if (e.key === 'ArrowRight') navigateLightbox(1);
    if (e.key === 'Escape') closeLightbox();
});

// Click backdrop to close
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) closeLightbox();
});

// Filter
function filterGallery(cat, btn) {
    document.querySelectorAll('.gbtn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.gallery-grid-item').forEach(item => {
        if (cat === 'all' || item.dataset.category === cat) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>
@endsection
