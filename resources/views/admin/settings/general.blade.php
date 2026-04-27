@extends('admin.layouts.app')
@section('title', 'General Settings')
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
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.settings.brochure') ? 'active' : '' }}" href="{{ route('admin.settings.brochure') }}" style="{{ request()->routeIs('admin.settings.brochure') ? 'background:var(--primary-green);' : '' }}">Brochure</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.settings.integrations') ? 'active' : '' }}" href="{{ route('admin.settings.integrations') }}" style="{{ request()->routeIs('admin.settings.integrations') ? 'background:var(--primary-green);' : '' }}">Integrations</a>
    </li>
</ul>

<div class="card">
    <div class="card-header"><h6 class="mb-0">General Settings</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.settings.updateGeneral') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Site Tagline</label>
                    <input type="text" name="site_tagline" class="form-control" value="{{ $settings['site_tagline'] ?? '' }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Site Email</label>
                    <input type="email" name="site_email" class="form-control" value="{{ $settings['site_email'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Site Phone</label>
                    <input type="text" name="site_phone" class="form-control" value="{{ $settings['site_phone'] ?? '' }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Site Address</label>
                <textarea name="site_address" class="form-control" rows="2">{{ $settings['site_address'] ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Google Map Embed Code</label>
                <textarea name="google_map_embed" class="form-control" rows="4" placeholder="Paste Google Maps embed iframe code here...">{{ $settings['google_map_embed'] ?? '' }}</textarea>
                <small class="text-muted">Paste the full iframe embed code from Google Maps</small>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ $settings['meta_title'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2">{{ $settings['meta_description'] ?? '' }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Settings</button>
        </form>
    </div>
</div>
@endsection
