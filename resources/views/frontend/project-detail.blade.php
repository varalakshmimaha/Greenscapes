@extends('frontend.layouts.app')

@section('title', ($project->title ?? 'Project Details') . ' - SR Greenscapes')

@section('content')
<!-- Project Hero -->
@php
    $bannerImg = isset($project->image) ? asset('storage/'.$project->image) : asset('storage/Home/1.1Cover photo 1.jpg');
    if(!isset($project->title)) { $projectTitle = "Scientific Landscape Transformation"; } else { $projectTitle = $project->title; }
@endphp

<section class="project-detail-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('{{ $bannerImg }}') center/cover no-repeat; padding: 150px 0 100px;">
    <div class="container text-center text-white">
        <span class="badge bg-white text-primary mb-3 px-3 py-2 rounded-pill fw-bold" data-aos="fade-up">{{ $project->status ?? 'RESIDENTIAL' }}</span>
        <h1 class="display-3 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100">{{ $projectTitle }}</h1>
        <div class="d-flex justify-content-center gap-4 align-items-center" data-aos="fade-up" data-aos-delay="200">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-map-marker-alt text-accent"></i>
                <span>{{ $project->client_name ?? 'Bengaluru, Karnataka' }}</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-calendar-alt text-accent"></i>
                <span>2024</span>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="project-info-section py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right">
                <h3 class="fw-bold mb-4">About the Project</h3>
                <div class="project-description text-muted lh-lg">
                    {!! $project->description ?? 'This project represents our commitment to scientific planning and sustainable execution. By analyzing soil conditions, light exposure, and local biodiversity, we crafted a landscape that not only enhances aesthetic value but also functions as a thriving living system. Every element, from the selection of native plant species to the irrigation infrastructure, was chosen to ensure long-term resilience and minimal maintenance requirements.' !!}
                </div>

                <!-- Multiple Pics Gallery -->
                <div class="project-gallery mt-5">
                    <h4 class="fw-bold mb-4">Project Gallery</h4>
                    <div class="row g-3">
                        @php
                            $galleryPics = [
                                'Home/1.1Cover photo 1.jpg', 'Home/1.2 Cover photo 2.jpg', 
                                'Home/1.3 Cover photo 3.jpg', 'Home/1.4 Cover photo  4.jpg',
                                'Home/1.5 Cover photo 5.jpg', 'Home/1.6 Cover photo 6.jpg'
                            ];
                        @endphp
                        @foreach($galleryPics as $pic)
                            <div class="col-md-4 col-sm-6">
                                <a href="{{ asset('storage/'.$pic) }}" target="_blank" class="gallery-item-wrap">
                                    <img src="{{ asset('storage/'.$pic) }}" alt="Gallery" class="img-fluid rounded-4 shadow-sm gallery-img">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-left">
                <div class="project-specs p-4 rounded-4 bg-light border sticky-top" style="top: 100px;">
                    <h5 class="fw-bold mb-4">Project Details</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex justify-content-between">
                            <span class="text-muted small">Category</span>
                            <span class="fw-bold">{{ $project->status ?? 'Landscape Development' }}</span>
                        </li>
                        <li class="mb-3 d-flex justify-content-between">
                            <span class="text-muted small">Location</span>
                            <span class="fw-bold">{{ $project->client_name ?? 'Bengaluru' }}</span>
                        </li>
                        <li class="mb-3 d-flex justify-content-between">
                            <span class="text-muted small">Area</span>
                            <span class="fw-bold">5,000 Sq. Ft.</span>
                        </li>
                        <li class="mb-3 d-flex justify-content-between">
                            <span class="text-muted small">Completion</span>
                            <span class="fw-bold">December 2024</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-muted small">Project Manager</span>
                            <span class="fw-bold">SR Greenscapes Experts</span>
                        </li>
                    </ul>
                    <hr>
                    <a href="/contact" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">Enquire About This Service</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .gallery-img {
        height: 200px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .gallery-item-wrap {
        display: block;
        overflow: hidden;
        border-radius: 15px;
    }
    .gallery-item-wrap:hover .gallery-img {
        transform: scale(1.1);
    }

    @media (max-width: 575px) {
        .project-detail-hero { padding: 80px 0 50px !important; }
        .project-detail-hero h1 { font-size: 1.6rem !important; }
        .project-info-section { padding-top: 30px !important; padding-bottom: 30px !important; }
        .project-specs { top: auto !important; position: relative !important; }
        .gallery-img { height: 150px; }
    }
</style>

@endsection
