@extends('frontend.layouts.app')

@section('title', 'Resources - SR Greenscapes')

@section('styles')
<style>
    .res-hero {
        position: relative;
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .res-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset('storage/Home/1.5 Cover photo 5.jpg') }}') center/cover no-repeat;
    }
    .res-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(27,94,32,0.88) 0%, rgba(26,42,26,0.92) 100%);
    }
    .res-hero-content {
        position: relative;
        z-index: 2;
    }
    .res-hero-label {
        display: inline-block;
        background: rgba(139,195,74,0.18);
        color: #8BC34A;
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }
    .res-hero h1 {
        color: #fff;
        font-size: 2.6rem;
        font-weight: 800;
        margin-bottom: 12px;
    }
    .res-hero p {
        color: rgba(255,255,255,0.8);
        font-size: 1rem;
        max-width: 550px;
        margin: 0 auto;
    }
    /* Section headings */
    .res-section { padding: 70px 0; }
    .res-section:nth-child(even) { background: #f9fbf9; }
    .res-section-label {
        display: inline-block;
        background: rgba(139,195,74,0.12);
        color: var(--primary-dark);
        padding: 6px 20px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }
    .res-section-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a3a1a;
        margin-bottom: 8px;
    }
    .res-section-title span { color: var(--primary); }
    .res-section-sub {
        color: #777;
        font-size: 0.95rem;
        margin-bottom: 40px;
        text-align: center;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .res-view-all {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary);
        color: #fff;
        padding: 11px 26px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s;
        margin-top: 30px;
    }
    .res-view-all:hover { background: var(--primary-dark); color: #fff; transform: translateY(-2px); }
    /* Blog cards */
    .res-blog-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        height: 100%;
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
        display: flex;
        flex-direction: column;
    }
    .res-blog-card:hover { transform: translateY(-6px); box-shadow: 0 12px 35px rgba(0,0,0,0.12); }
    .res-blog-img { width: 100%; height: 200px; object-fit: cover; }
    .res-blog-img-placeholder {
        width: 100%; height: 200px;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        display: flex; align-items: center; justify-content: center;
    }
    .res-blog-img-placeholder i { font-size: 3rem; color: var(--primary); }
    .res-blog-body { padding: 20px; flex: 1; display: flex; flex-direction: column; }
    .res-blog-date { font-size: 0.75rem; color: #999; margin-bottom: 8px; }
    .res-blog-title { font-size: 1rem; font-weight: 700; color: #1a3a1a; margin-bottom: 8px; line-height: 1.4; }
    .res-blog-excerpt { font-size: 0.85rem; color: #666; line-height: 1.7; flex: 1; text-align: justify; }
    .res-blog-read { font-size: 0.8rem; font-weight: 700; color: var(--primary); margin-top: 12px; }
    /* Gallery grid */
    .res-gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    .res-gallery-item {
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 4/3;
        position: relative;
        cursor: pointer;
    }
    .res-gallery-item img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .res-gallery-item:hover img { transform: scale(1.08); }
    .res-gallery-overlay {
        position: absolute; inset: 0;
        background: rgba(27,94,32,0.5);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s;
    }
    .res-gallery-item:hover .res-gallery-overlay { opacity: 1; }
    .res-gallery-overlay i { font-size: 2rem; color: #fff; }
    .res-gallery-item { cursor: pointer; }
    /* Lightbox */
    .lightbox-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.92);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    .lightbox-overlay.active { display: flex; }
    .lightbox-img {
        max-width: 90vw;
        max-height: 88vh;
        border-radius: 8px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        object-fit: contain;
    }
    .lightbox-close {
        position: absolute;
        top: 20px; right: 28px;
        color: #fff;
        font-size: 2.2rem;
        cursor: pointer;
        line-height: 1;
        opacity: 0.8;
        transition: opacity 0.2s;
    }
    .lightbox-close:hover { opacity: 1; }
    .lightbox-prev, .lightbox-next {
        position: absolute;
        top: 50%; transform: translateY(-50%);
        color: #fff;
        font-size: 2rem;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.2s;
        background: rgba(255,255,255,0.1);
        border: none;
        width: 48px; height: 48px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
    }
    .lightbox-prev { left: 20px; }
    .lightbox-next { right: 20px; }
    .lightbox-prev:hover, .lightbox-next:hover { opacity: 1; background: rgba(255,255,255,0.2); }
    /* Video cards */
    .res-video-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .res-video-card:hover { transform: translateY(-4px); box-shadow: 0 12px 35px rgba(0,0,0,0.12); }
    .res-video-thumb {
        position: relative;
        aspect-ratio: 16/9;
        background: #1a3a1a;
        overflow: hidden;
    }
    .res-video-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .res-video-play {
        position: absolute; inset: 0;
        display: flex; align-items: center; justify-content: center;
        background: rgba(0,0,0,0.3);
    }
    .res-video-play i {
        width: 56px; height: 56px;
        background: var(--primary);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; color: #fff;
        transition: transform 0.3s;
    }
    .res-video-card:hover .res-video-play i { transform: scale(1.1); }
    .res-video-body { padding: 16px 20px; }
    .res-video-title { font-size: 0.95rem; font-weight: 700; color: #1a3a1a; margin-bottom: 4px; }
    .res-video-desc { font-size: 0.82rem; color: #777; }
    @media (max-width: 767px) {
        .res-hero h1 { font-size: 1.8rem; }
        .res-gallery-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 575px) {
        .res-gallery-grid { grid-template-columns: repeat(1, 1fr); }
    }
</style>
@endsection

@section('content')

<!-- Hero -->
<section class="res-hero">
    <div class="res-hero-content">
        <div class="res-hero-label"><i class="fas fa-book-open" style="margin-right:6px;"></i> Explore</div>
        <h1>Resources</h1>
        <p>Insights, inspiration, and stories from the world of sustainable landscaping and green design.</p>
    </div>
</section>


<!-- ===== GALLERY SECTION ===== -->
<section class="res-section" id="gallery">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <div class="res-section-label"><i class="fas fa-images" style="margin-right:6px;"></i>Gallery</div>
            <h2 class="res-section-title">Our <span>Work in Pictures</span></h2>
            <p class="res-section-sub">A visual showcase of landscapes we've designed and built</p>
        </div>

        @if($gallery->count())
            <div class="res-gallery-grid" data-aos="fade-up">
                @foreach($gallery as $item)
                    <div class="res-gallery-item" data-src="{{ asset('storage/' . $item->image) }}" data-caption="{{ $item->title ?? '' }}">
                        <img loading="lazy" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title ?? 'Gallery' }}">
                        <div class="res-gallery-overlay"><i class="fas fa-expand-arrows-alt"></i></div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('gallery') }}" class="res-view-all"><i class="fas fa-images"></i> View Full Gallery</a>
            </div>
        @else
            <div class="text-center py-5" style="color:#999;"><i class="fas fa-images" style="font-size:3rem;margin-bottom:12px;display:block;"></i>No gallery images yet.</div>
        @endif
    </div>
</section>

<!-- ===== BLOG SECTION ===== -->
<section class="res-section" id="blogs">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <div class="res-section-label"><i class="fas fa-pen-nib" style="margin-right:6px;"></i>Blog</div>
            <h2 class="res-section-title">Latest <span>Articles</span></h2>
            <p class="res-section-sub">Insights, tips and expert knowledge on landscaping and green design</p>
        </div>

        @if($blogs->count())
            <div class="row g-4">
                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="{{ route('blog.detail', $blog->slug) }}" class="res-blog-card">
                            @if($blog->featured_image)
                                <img loading="lazy" src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="res-blog-img">
                            @else
                                <div class="res-blog-img-placeholder"><i class="fas fa-seedling"></i></div>
                            @endif
                            <div class="res-blog-body">
                                <div class="res-blog-date"><i class="far fa-calendar-alt" style="margin-right:4px;"></i>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : '' }}</div>
                                <div class="res-blog-title">{{ $blog->title }}</div>
                                <div class="res-blog-excerpt">{{ Str::limit(strip_tags($blog->content ?? $blog->excerpt ?? ''), 100) }}</div>
                                <div class="res-blog-read">Read More <i class="fas fa-arrow-right" style="font-size:10px;"></i></div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('blogs') }}" class="res-view-all"><i class="fas fa-pen-nib"></i> View All Articles</a>
            </div>
        @else
            <div class="text-center py-5" style="color:#999;"><i class="fas fa-pen-nib" style="font-size:3rem;margin-bottom:12px;display:block;"></i>No articles published yet.</div>
        @endif
    </div>
</section>

<!-- ===== VIDEOS SECTION ===== -->
<section class="res-section" id="videos">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <div class="res-section-label"><i class="fas fa-play-circle" style="margin-right:6px;"></i>Videos</div>
            <h2 class="res-section-title">Watch Our <span>Projects in Action</span></h2>
            <p class="res-section-sub">See how we transform spaces into thriving green environments</p>
        </div>

        @if($videos->count())
            <div class="row g-4">
                @foreach($videos as $video)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @php
                            $videoUrl = $video->url ?? $video->youtube_url ?? $video->video_url ?? '';
                            $embedUrl = '';
                            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $videoUrl, $m)) {
                                $embedUrl = 'https://www.youtube.com/embed/' . $m[1];
                                $thumbUrl = 'https://img.youtube.com/vi/' . $m[1] . '/hqdefault.jpg';
                            }
                        @endphp
                        <div class="res-video-card">
                            @if($embedUrl)
                                <a href="{{ $videoUrl }}" target="_blank" class="res-video-thumb d-block" style="text-decoration:none;">
                                    <img loading="lazy" src="{{ $thumbUrl }}" alt="{{ $video->title }}">
                                    <div class="res-video-play"><i class="fas fa-play"></i></div>
                                </a>
                            @elseif($video->thumbnail)
                                <div class="res-video-thumb">
                                    <img loading="lazy" src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}">
                                    <div class="res-video-play"><i class="fas fa-play"></i></div>
                                </div>
                            @else
                                <div class="res-video-thumb" style="background:#1a3a1a;">
                                    <div class="res-video-play"><i class="fas fa-play"></i></div>
                                </div>
                            @endif
                            <div class="res-video-body">
                                <div class="res-video-title">{{ $video->title }}</div>
                                @if($video->description)<div class="res-video-desc">{{ Str::limit($video->description, 80) }}</div>@endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('videos') }}" class="res-view-all"><i class="fas fa-play-circle"></i> View All Videos</a>
            </div>
        @else
            <div class="text-center py-5" style="color:#999;"><i class="fas fa-play-circle" style="font-size:3rem;margin-bottom:12px;display:block;"></i>No videos added yet.</div>
        @endif
    </div>
</section>

<!-- Lightbox -->
<div class="lightbox-overlay" id="lightbox">
    <span class="lightbox-close" id="lightboxClose">&times;</span>
    <button class="lightbox-prev" id="lightboxPrev"><i class="fas fa-chevron-left"></i></button>
    <img src="" alt="" class="lightbox-img" id="lightboxImg">
    <button class="lightbox-next" id="lightboxNext"><i class="fas fa-chevron-right"></i></button>
</div>

<script>
(function() {
    const items = Array.from(document.querySelectorAll('.res-gallery-item[data-src]'));
    const lb = document.getElementById('lightbox');
    const lbImg = document.getElementById('lightboxImg');
    let current = 0;

    function open(index) {
        current = index;
        lbImg.src = items[current].dataset.src;
        lb.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function close() {
        lb.classList.remove('active');
        document.body.style.overflow = '';
    }
    function prev() { current = (current - 1 + items.length) % items.length; lbImg.src = items[current].dataset.src; }
    function next() { current = (current + 1) % items.length; lbImg.src = items[current].dataset.src; }

    items.forEach((el, i) => el.addEventListener('click', () => open(i)));
    document.getElementById('lightboxClose').addEventListener('click', close);
    document.getElementById('lightboxPrev').addEventListener('click', prev);
    document.getElementById('lightboxNext').addEventListener('click', next);
    lb.addEventListener('click', function(e) { if (e.target === lb) close(); });
    document.addEventListener('keydown', function(e) {
        if (!lb.classList.contains('active')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft') prev();
        if (e.key === 'ArrowRight') next();
    });
})();
</script>

@endsection
