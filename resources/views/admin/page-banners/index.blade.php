@extends('admin.layouts.app')
@section('title', 'Page Banners')
@section('page-title', 'Page Banners')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="mb-4">
    <p class="text-muted mb-0">Upload hero banner images for each inner page. These appear as the top background image on their respective pages.</p>
</div>

<div class="row g-4">
    @foreach(\App\Models\PageBanner::PAGES as $pageKey => $pageLabel)
    @php $banner = $banners[$pageKey] ?? null; @endphp
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between py-2">
                <h6 class="mb-0 fw-700">
                    <i class="fas fa-file-image me-2 text-success"></i>{{ $pageLabel }}
                </h6>
                @if($banner && $banner->image)
                    <form action="{{ route('admin.page-banners.destroy', $pageKey) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Remove banner for {{ $pageLabel }}?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" title="Remove image">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                @endif
            </div>

            {{-- Current image preview --}}
            <div style="height: 180px; background: #f0f4f0; overflow: hidden; position: relative;">
                @if($banner && $banner->image)
                    <img src="{{ asset('storage/' . $banner->image) }}"
                         alt="{{ $pageLabel }} banner"
                         style="width:100%; height:100%; object-fit:cover; display:block;">
                    <span class="badge bg-success position-absolute top-0 end-0 m-2">
                        <i class="fas fa-check me-1"></i>Uploaded
                    </span>
                @else
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                        <i class="fas fa-image fa-2x mb-2 opacity-50"></i>
                        <small>No banner uploaded</small>
                    </div>
                @endif
            </div>

            <div class="card-body">
                <form action="{{ route('admin.page-banners.update', $pageKey) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Banner Image
                            @if($banner && $banner->image)
                                <span class="text-muted fw-normal">(upload new to replace)</span>
                            @endif
                        </label>
                        <input type="file" name="image" class="form-control form-control-sm"
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               {{ !($banner && $banner->image) ? 'required' : '' }}>
                        <small class="text-muted">JPG, PNG or WebP · Max 5 MB · Recommended: 1920×400px</small>
                    </div>

                    @if($pageKey === 'contact')
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Landing Image (Office/Featured)
                            @if($banner && $banner->landing_image)
                                <span class="text-muted fw-normal">(upload new to replace)</span>
                            @endif
                        </label>
                        <input type="file" name="landing_image" class="form-control form-control-sm"
                               accept="image/jpeg,image/png,image/jpg,image/webp">
                        <small class="text-muted">JPG, PNG or WebP · Max 5 MB · Recommended: 600×600px (Square)</small>
                        @if($banner && $banner->landing_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $banner->landing_image) }}"
                                     alt="Landing image preview"
                                     style="max-width:100%; max-height:150px; border-radius:4px; border:1px solid #dee2e6;">
                            </div>
                        @endif
                    </div>
                    @endif

                    <div class="mb-2">
                        <label class="form-label fw-semibold small">Page Title <span class="text-muted fw-normal">(optional)</span></label>
                        <input type="text" name="title" class="form-control form-control-sm"
                               value="{{ old('title', $banner->title ?? '') }}"
                               placeholder="{{ $pageLabel }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Subtitle <span class="text-muted fw-normal">(optional)</span></label>
                        <input type="text" name="subtitle" class="form-control form-control-sm"
                               value="{{ old('subtitle', $banner->subtitle ?? '') }}"
                               placeholder="Short description">
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-save me-1"></i>
                        {{ ($banner && $banner->image) ? 'Update Banner' : 'Upload Banner' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
