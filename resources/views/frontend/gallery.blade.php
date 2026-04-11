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
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('{{ asset('storage/Home/1.6 Cover photo 6.jpg') }}') center/cover no-repeat;
    }
    .gallery-hero::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(20, 45, 25, 0.70);
    }
    .gallery-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .gallery-hero-content h1 {
        color: #fff;
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .gallery-hero-content p {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.15rem;
        max-width: 650px;
        margin: 0 auto;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }

    /* ===== FILTER ===== */
    .gallery-filter-btns {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-bottom: 40px;
    }
    .gallery-filter-btns .gbtn {
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
    .gallery-filter-btns .gbtn:hover,
    .gallery-filter-btns .gbtn.active {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
    }

    /* ===== GALLERY ITEM ===== */
    .gallery-item {
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        height: 280px;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.3s;
    }
    .gallery-item:hover {
        box-shadow: 0 12px 40px rgba(0,0,0,0.14);
        transform: translateY(-5px);
    }
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .gallery-item:hover img {
        transform: scale(1.08);
    }
    .gallery-item .gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(transparent 50%, rgba(0,0,0,0.7));
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        align-items: flex-end;
        padding: 20px;
    }
    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }
    .gallery-overlay h6 {
        color: #fff;
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 4px;
    }
    .gallery-overlay small {
        color: rgba(255,255,255,0.6);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .gallery-item .zoom-icon {
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
    }
    .gallery-item:hover .zoom-icon {
        transform: translate(-50%, -50%) scale(1);
    }

    @media (max-width: 575px) {
        .gallery-item { height: 200px; border-radius: 12px; }
        .gallery-filter-btns .gbtn { padding: 6px 14px; font-size: 0.75rem; }
        .gallery-filter-btns { gap: 6px; margin-bottom: 25px; }
        .gallery-item .zoom-icon { width: 38px; height: 38px; font-size: 14px; }
    }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="gallery-hero">
    <div class="gallery-hero-content" data-aos="fade-up">
        <h1>Our Gallery</h1>
        <p>A visual showcase of our landscape transformations and green space creations across India.</p>
    </div>
</div>

<!-- Gallery Grid -->
<section class="py-5" style="background: #f9fbf9;">
    <div class="container py-4">

        @if(isset($categories) && $categories->count())
        <div class="gallery-filter-btns" data-aos="fade-up">
            <button class="gbtn active" onclick="filterGallery('all', this)">All</button>
            @foreach($categories as $cat)
                <button class="gbtn" onclick="filterGallery('{{ $cat }}', this)">{{ $cat }}</button>
            @endforeach
        </div>
        @endif

        <div class="row g-4" id="galleryGrid">
            @forelse($gallery as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 gallery-grid-item" data-category="{{ $item->category ?? '' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                    <div class="gallery-item" onclick="openLightbox('{{ asset('storage/' . $item->image) }}', '{{ $item->title ?? '' }}')">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title ?? 'Gallery Image' }}">
                        <div class="zoom-icon"><i class="fas fa-search-plus"></i></div>
                        <div class="gallery-overlay">
                            <div>
                                @if($item->title)<h6>{{ $item->title }}</h6>@endif
                                @if($item->category)<small>{{ $item->category }}</small>@endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No gallery images available yet.</p>
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

<!-- Lightbox Modal -->
<div class="modal fade" id="galleryLightbox" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 text-center">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"></button>
                <img id="lightboxImg" src="" alt="" style="max-width:100%; max-height:85vh; border-radius:12px; box-shadow:0 20px 60px rgba(0,0,0,0.5);">
                <p id="lightboxCaption" class="text-white mt-3 fw-bold"></p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
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

function openLightbox(src, caption) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightboxCaption').textContent = caption;
    new bootstrap.Modal(document.getElementById('galleryLightbox')).show();
}
</script>
@endsection
