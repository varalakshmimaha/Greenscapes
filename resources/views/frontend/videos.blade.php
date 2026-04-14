@extends('frontend.layouts.app')

@section('title', 'Videos - SR Greenscapes')

@section('styles')
<style>
    /* ===== HERO ===== */
    .videos-hero {
        position: relative;
        width: 100%;
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .videos-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ asset('storage/Home/1.3 Cover photo 3.jpg') }}') center/cover no-repeat;
    }
    .videos-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(20, 45, 25, 0.70);
    }
    .videos-hero-content {
        position: relative;
        z-index: 2;
        padding: 0 20px;
    }
    .videos-hero-content h1 {
        color: #fff;
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .videos-hero-content p {
        color: rgba(255, 255, 255, 0.95);
        font-size: 1.15rem;
        max-width: 650px;
        margin: 0 auto;
    }

    /* ===== VIDEO CARD ===== */
    .video-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        transition: all 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #eee;
    }
    .video-card:hover {
        box-shadow: 0 12px 40px rgba(0,0,0,0.12);
        transform: translateY(-5px);
    }
    .video-card-thumb {
        position: relative;
        height: 220px;
        overflow: hidden;
        cursor: pointer;
    }
    .video-card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .video-card:hover .video-card-thumb img {
        transform: scale(1.05);
    }
    .video-card-thumb .play-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 65px;
        height: 65px;
        background: rgba(139,195,74,0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 22px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        transition: all 0.3s;
    }
    .video-card:hover .play-icon {
        background: var(--primary);
        transform: translate(-50%, -50%) scale(1.1);
    }
    .video-card-body {
        padding: 20px 25px;
        flex: 1;
    }
    .video-card-body h5 {
        font-weight: 700;
        color: #1a3a1a;
        font-size: 1.05rem;
        margin-bottom: 8px;
    }
    .video-card-body p {
        color: #777;
        font-size: 0.88rem;
        line-height: 1.6;
        margin: 0;
    }
    .video-card-category {
        display: inline-block;
        background: rgba(139,195,74,0.1);
        color: var(--primary);
        padding: 3px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    @media (max-width: 575px) {
        .video-card-thumb { height: 180px; }
        .video-card-thumb .play-icon { width: 50px; height: 50px; font-size: 18px; }
        .video-card-body { padding: 14px 16px; }
        .video-card-body h5 { font-size: 0.9rem; }
        .video-card-body p { font-size: 0.8rem; }
    }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="videos-hero">
    <div class="videos-hero-content" data-aos="fade-up">
        <h1>Our Videos</h1>
        <p>Watch our landscape transformations, tutorials, and behind-the-scenes project journeys.</p>
    </div>
</div>

<!-- Videos Grid -->
<section class="py-5" style="background: #f9fbf9;">
    <div class="container py-4">
        <div class="row g-4">
            @forelse($videos as $video)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <div class="video-card">
                        <div class="video-card-thumb" onclick="openVideo('{{ $video->video_url }}')">
                            @if($video->thumbnail)
                                <img loading="lazy" src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}">
                            @else
                                @php
                                    $ytId = '';
                                    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->video_url, $m)) {
                                        $ytId = $m[1];
                                    }
                                @endphp
                                @if($ytId)
                                    <img loading="lazy" src="https://img.youtube.com/vi/{{ $ytId }}/maxresdefault.jpg" alt="{{ $video->title }}">
                                @else
                                    <img loading="lazy" src="{{ asset('storage/Home/1.3 Cover photo 3.jpg') }}" alt="{{ $video->title }}">
                                @endif
                            @endif
                            <div class="play-icon"><i class="fas fa-play ms-1"></i></div>
                        </div>
                        <div class="video-card-body">
                            <h5>{{ $video->title }}</h5>
                            @if($video->description)
                                <p>{{ Str::limit($video->description, 100) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-video fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No videos available yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border-0" style="border-radius:16px; overflow:hidden;">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe id="videoFrame" src="" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openVideo(url) {
    var embedUrl = url;
    var ytMatch = url.match(/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
    if (ytMatch) {
        embedUrl = 'https://www.youtube.com/embed/' + ytMatch[1] + '?autoplay=1';
    }
    document.getElementById('videoFrame').src = embedUrl;
    new bootstrap.Modal(document.getElementById('videoModal')).show();
}
document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('videoFrame').src = '';
});
</script>
@endsection
