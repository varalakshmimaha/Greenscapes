@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalServices }}</div>
                    <div class="stat-label">Total Services</div>
                </div>
                <div class="icon-box" style="background: #e8f5e3; color: #4a7c3f;">
                    <i class="fas fa-concierge-bell"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalProjects }}</div>
                    <div class="stat-label">Total Projects</div>
                </div>
                <div class="icon-box" style="background: #e3f2fd; color: #1976d2;">
                    <i class="fas fa-project-diagram"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalGallery }}</div>
                    <div class="stat-label">Gallery Images</div>
                </div>
                <div class="icon-box" style="background: #fff3e0; color: #f57c00;">
                    <i class="fas fa-images"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalFaqs }}</div>
                    <div class="stat-label">Total FAQs</div>
                </div>
                <div class="icon-box" style="background: #fce4ec; color: #c62828;">
                    <i class="fas fa-question-circle"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $unreadContacts }}</div>
                    <div class="stat-label">Unread Messages</div>
                </div>
                <div class="icon-box" style="background: #f3e5f5; color: #7b1fa2;">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalTeam }}</div>
                    <div class="stat-label">Team Members</div>
                </div>
                <div class="icon-box" style="background: #e0f7fa; color: #00838f;">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalBanners }}</div>
                    <div class="stat-label">Banners</div>
                </div>
                <div class="icon-box" style="background: #fff8e1; color: #f9a825;">
                    <i class="fas fa-image"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalBlogs }}</div>
                    <div class="stat-label">Blog Posts</div>
                </div>
                <div class="icon-box" style="background: #e8eaf6; color: #3949ab;">
                    <i class="fas fa-blog"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalVideos }}</div>
                    <div class="stat-label">Videos</div>
                </div>
                <div class="icon-box" style="background: #fbe9e7; color: #d84315;">
                    <i class="fas fa-video"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalMenus }}</div>
                    <div class="stat-label">Menu Items</div>
                </div>
                <div class="icon-box" style="background: #f1f8e9; color: #558b2f;">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Recent Contact Messages</h6>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-success">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead><tr><th>Name</th><th>Subject</th><th>Date</th><th>Status</th></tr></thead>
                        <tbody>
                            @forelse($recentContacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ Str::limit($contact->subject, 30) }}</td>
                                <td>{{ $contact->created_at->diffForHumans() }}</td>
                                <td>
                                    @if($contact->is_read)
                                        <span class="badge badge-active">Read</span>
                                    @else
                                        <span class="badge badge-inactive">Unread</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">No messages yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Recent Projects</h6>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-success">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead><tr><th>Title</th><th>Client</th><th>Status</th></tr></thead>
                        <tbody>
                            @forelse($recentProjects as $project)
                            <tr>
                                <td>{{ Str::limit($project->title, 30) }}</td>
                                <td>{{ $project->client_name ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $project->status === 'completed' ? 'badge-active' : 'bg-warning text-dark' }}">
                                        {{ ucfirst($project->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-muted py-3">No projects yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
