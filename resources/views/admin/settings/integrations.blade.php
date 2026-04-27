@extends('admin.layouts.app')
@section('title', 'Integrations')
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
        <a class="nav-link active" href="{{ route('admin.settings.integrations') }}" style="background:var(--primary-green);">Integrations</a>
    </li>
</ul>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form action="{{ route('admin.settings.updateIntegrations') }}" method="POST">
    @csrf

    {{-- Email Notifications --}}
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center gap-2">
            <i class="fas fa-envelope text-success"></i>
            <h6 class="mb-0">Email Notifications (Gmail SMTP)</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Notification Recipient Email <span class="text-danger">*</span></label>
                    <input type="email" name="notification_email" class="form-control"
                        value="{{ $settings['notification_email'] ?? '' }}"
                        placeholder="e.g. info@srgreenscapes.com">
                    <small class="text-muted">All inquiry form submissions will be sent to this address.</small>
                </div>
            </div>

            <div class="alert alert-info py-2 px-3 mb-0" style="font-size:0.85rem;">
                <i class="fas fa-info-circle me-1"></i>
                <strong>Gmail SMTP setup required in your server <code>.env</code> file:</strong>
                <pre class="mb-0 mt-2" style="font-size:0.8rem;background:transparent;border:none;padding:0;">MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=your-16-char-app-password
MAIL_FROM_ADDRESS=your-gmail@gmail.com
MAIL_FROM_NAME="SR Greenscapes"</pre>
                <hr class="my-2">
                <strong>Steps to get a Gmail App Password:</strong><br>
                1. Enable 2-Step Verification on your Google Account<br>
                2. Go to Google Account → Security → App Passwords<br>
                3. Generate a password for "Mail" and paste it as <code>MAIL_PASSWORD</code>
            </div>
        </div>
    </div>

    {{-- Google Analytics --}}
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center gap-2">
            <i class="fab fa-google text-danger"></i>
            <h6 class="mb-0">Google Analytics 4</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Measurement ID</label>
                    <input type="text" name="google_analytics_id" class="form-control"
                        value="{{ $settings['google_analytics_id'] ?? '' }}"
                        placeholder="e.g. G-XXXXXXXXXX">
                    <small class="text-muted">
                        Find this in Google Analytics → Admin → Data Streams → your stream → Measurement ID.
                        Leave blank to disable tracking.
                    </small>
                </div>
            </div>
            @if(!empty($settings['google_analytics_id']))
                <div class="alert alert-success py-2 px-3 mb-0" style="font-size:0.85rem;">
                    <i class="fas fa-check-circle me-1"></i>
                    Google Analytics is <strong>active</strong> with ID: <code>{{ $settings['google_analytics_id'] }}</code>
                </div>
            @else
                <div class="alert alert-warning py-2 px-3 mb-0" style="font-size:0.85rem;">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Google Analytics is <strong>not configured</strong>. Enter your Measurement ID above to enable tracking.
                </div>
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-2"></i>Save Integration Settings
    </button>
</form>
@endsection
