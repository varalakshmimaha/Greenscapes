@extends('admin.layouts.app')
@section('title', 'Logo Settings')
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
</ul>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Logo & Favicon</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.settings.updateLogo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Site Logo</label>
                    @if(isset($settings['site_logo']) && $settings['site_logo'])
                        <div class="mb-2 p-3 bg-light rounded text-center">
                            <img src="{{ asset('storage/'.$settings['site_logo']) }}" style="max-height:80px" alt="Logo">
                        </div>
                    @endif
                    <input type="file" name="site_logo" class="form-control" accept="image/*">
                    <small class="text-muted">Recommended: PNG or SVG, max 2MB</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Site Favicon</label>
                    @if(isset($settings['site_favicon']) && $settings['site_favicon'])
                        <div class="mb-2 p-3 bg-light rounded text-center">
                            <img src="{{ asset('storage/'.$settings['site_favicon']) }}" style="max-height:40px" alt="Favicon">
                        </div>
                    @endif
                    <input type="file" name="site_favicon" class="form-control" accept="image/*">
                    <small class="text-muted">Recommended: ICO or PNG, max 1MB</small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Logo</button>
        </form>
    </div>
</div>
@endsection
