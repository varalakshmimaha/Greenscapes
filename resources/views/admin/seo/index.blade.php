@extends('admin.layouts.app')
@section('title', 'SEO Settings')
@section('page-title', 'SEO Settings')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Global SEO Metadata</h5>
                <p class="text-muted small mt-2">Configure default SEO settings for your website. These values are used as fallbacks on pages without specific SEO data.</p>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.seo.update') }}" method="POST">
                    @csrf @method('PUT')

                    <!-- Meta Title -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Meta Title <span class="text-danger">*</span></label>
                        <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror"
                               value="{{ old('meta_title', $seoSettings['meta_title']) }}" placeholder="Enter page title (max 70 chars)" maxlength="70">
                        <small class="text-muted d-block mt-2">Appears in browser tab and Google search results. Recommended: 50-70 characters.</small>
                        <small class="text-info">Characters: <span id="titleCount">{{ strlen(old('meta_title', $seoSettings['meta_title'])) }}</span>/70</small>
                        @error('meta_title')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Meta Description -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Meta Description <span class="text-danger">*</span></label>
                        <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror"
                                  rows="3" placeholder="Enter meta description (max 160 chars)" maxlength="160">{{ old('meta_description', $seoSettings['meta_description']) }}</textarea>
                        <small class="text-muted d-block mt-2">Appears under the page title in Google search results. Recommended: 150-160 characters.</small>
                        <small class="text-info">Characters: <span id="descCount">{{ strlen(old('meta_description', $seoSettings['meta_description'])) }}</span>/160</small>
                        @error('meta_description')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Meta Keywords -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Meta Keywords (comma separated)</label>
                        <input type="text" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror"
                               value="{{ old('meta_keywords', $seoSettings['meta_keywords']) }}" placeholder="e.g. landscaping, garden design, Bengaluru" maxlength="500">
                        <small class="text-muted d-block mt-2">List of keywords related to your site. Separated by commas. Less important for modern SEO but still useful.</small>
                        @error('meta_keywords')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                    </div>

                    <hr class="my-4">

                    <!-- Open Graph (Facebook/LinkedIn) -->
                    <div class="mb-3">
                        <h6 class="fw-bold text-primary">Open Graph Settings (Facebook, LinkedIn)</h6>
                        <p class="text-muted small">Controls how your site appears when shared on social media.</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">OG Title</label>
                        <input type="text" name="og_title" class="form-control @error('og_title') is-invalid @enderror"
                               value="{{ old('og_title', $seoSettings['og_title']) }}" placeholder="Leave blank to use Meta Title" maxlength="70">
                        <small class="text-muted d-block mt-2">If blank, falls back to Meta Title.</small>
                        @error('og_title')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">OG Description</label>
                        <textarea name="og_description" class="form-control @error('og_description') is-invalid @enderror"
                                  rows="3" placeholder="Leave blank to use Meta Description" maxlength="160">{{ old('og_description', $seoSettings['og_description']) }}</textarea>
                        <small class="text-muted d-block mt-2">If blank, falls back to Meta Description.</small>
                        @error('og_description')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                    </div>

                    <hr class="my-4">

                    <!-- Twitter Card -->
                    <div class="mb-3">
                        <h6 class="fw-bold text-info">Twitter Card Settings</h6>
                        <p class="text-muted small">Controls how your site appears when shared on Twitter/X.</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Twitter Title</label>
                        <input type="text" name="twitter_title" class="form-control @error('twitter_title') is-invalid @enderror"
                               value="{{ old('twitter_title', $seoSettings['twitter_title']) }}" placeholder="Leave blank to use Meta Title" maxlength="70">
                        <small class="text-muted d-block mt-2">If blank, falls back to Meta Title.</small>
                        @error('twitter_title')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Twitter Description</label>
                        <textarea name="twitter_description" class="form-control @error('twitter_description') is-invalid @enderror"
                                  rows="3" placeholder="Leave blank to use Meta Description" maxlength="160">{{ old('twitter_description', $seoSettings['twitter_description']) }}</textarea>
                        <small class="text-muted d-block mt-2">If blank, falls back to Meta Description.</small>
                        @error('twitter_description')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save SEO Settings</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('input[name="meta_title"]').addEventListener('input', function() {
    document.getElementById('titleCount').textContent = this.value.length;
});
document.querySelector('textarea[name="meta_description"]').addEventListener('input', function() {
    document.getElementById('descCount').textContent = this.value.length;
});
</script>
@endsection
