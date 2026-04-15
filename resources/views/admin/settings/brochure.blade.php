@extends('admin.layouts.app')
@section('title', 'Brochure Settings')
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
    <div class="card-header"><h6 class="mb-0">Upload Brochure (PDF)</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.settings.updateBrochure') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Brochure PDF</label>
                <input type="file" name="brochure_file" class="form-control" accept=".pdf">
                @error('brochure_file') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            @if(!empty($settings['brochure_file']))
                <div class="mb-3">
                    <label class="form-label text-muted small">Current Brochure</label>
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-file-pdf text-danger fa-2x"></i>
                        <div>
                            <p class="mb-1 fw-semibold">{{ basename($settings['brochure_file']) }}</p>
                            <a href="{{ asset('storage/' . $settings['brochure_file']) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>View PDF
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Brochure</button>
        </form>
    </div>
</div>
@endsection
