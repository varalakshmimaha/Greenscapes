@extends('admin.layouts.app')
@section('title', 'Footer Settings')
@section('page-title', 'Site Settings')

@section('content')
<ul class="nav nav-pills mb-4">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}" href="{{ route('admin.settings.general') }}" style="{{ request()->routeIs('admin.settings.general') ? 'background:var(--primary-green);' : '' }}">General</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.settings.logo') ? 'active' : '' }}" href="{{ route('admin.settings.logo') }}" style="{{ request()->routeIs('admin.settings.logo') ? 'background:var(--primary-green);' : '' }}">Logo & Favicon</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.settings.footer') ? 'active' : '' }}" href="{{ route('admin.settings.footer') }}" style="{{ request()->routeIs('admin.settings.footer') ? 'background:var(--primary-green);' : '' }}">Footer & Social</a>
    </li>
</ul>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Footer Information</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.settings.updateFooter') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Footer About Text</label>
                <textarea name="footer_about" class="form-control" rows="3">{{ $settings['footer_about'] ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Copyright Text</label>
                <input type="text" name="footer_copyright" class="form-control" value="{{ $settings['footer_copyright'] ?? '' }}" placeholder="&copy; 2026 Ecoscapes. All rights reserved.">
            </div>
            <hr>
            <h6 class="mb-3">Social Media Links</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-facebook me-1 text-primary"></i>Facebook URL</label>
                    <input type="url" name="facebook_url" class="form-control" value="{{ $settings['facebook_url'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-twitter me-1 text-info"></i>Twitter URL</label>
                    <input type="url" name="twitter_url" class="form-control" value="{{ $settings['twitter_url'] ?? '' }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-instagram me-1 text-danger"></i>Instagram URL</label>
                    <input type="url" name="instagram_url" class="form-control" value="{{ $settings['instagram_url'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-linkedin me-1 text-primary"></i>LinkedIn URL</label>
                    <input type="url" name="linkedin_url" class="form-control" value="{{ $settings['linkedin_url'] ?? '' }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-youtube me-1 text-danger"></i>YouTube URL</label>
                    <input type="url" name="youtube_url" class="form-control" value="{{ $settings['youtube_url'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-whatsapp me-1 text-success"></i>WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" class="form-control" value="{{ $settings['whatsapp_number'] ?? '' }}" placeholder="9845728507">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-pinterest me-1 text-danger"></i>Pinterest URL</label>
                    <input type="url" name="pinterest_url" class="form-control" value="{{ $settings['pinterest_url'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-x-twitter me-1"></i>X (Twitter) URL</label>
                    <input type="url" name="x_url" class="form-control" value="{{ $settings['x_url'] ?? '' }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Footer Settings</button>
        </form>
    </div>
</div>
@endsection
