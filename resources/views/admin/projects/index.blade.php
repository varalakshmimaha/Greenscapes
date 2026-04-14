@extends('admin.layouts.app')
@section('title', 'Projects')
@section('page-title', 'Projects')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Projects</h6>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Project</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Image</th><th>Title</th><th>Client</th><th>Order</th><th>Status</th><th>Active</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($project->featured_image)
                                <img src="{{ asset('storage/'.$project->featured_image) }}" class="img-thumbnail-sm" alt="">
                            @else
                                <span class="text-muted"><i class="fas fa-image"></i></span>
                            @endif
                        </td>
                        <td><strong>{{ $project->title }}</strong></td>
                        <td>{{ $project->client_name ?? '-' }}</td>
                        <td><span class="badge bg-secondary">{{ $project->order ?? 0 }}</span></td>
                        <td>
                            <span class="badge {{ $project->status === 'completed' ? 'badge-active' : 'bg-warning text-dark' }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </td>
                        <td>
                            @if($project->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No projects found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
