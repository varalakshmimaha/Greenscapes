@extends('admin.layouts.app')
@section('title', 'Team Categories')
@section('page-title', 'Team Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Team Categories</h6>
    <a href="{{ route('admin.team-categories.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Category</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th width="60">#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Members</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th width="160">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td class="fw-semibold">{{ $category->name }}</td>
                    <td><code>{{ $category->slug }}</code></td>
                    <td><span class="badge bg-info">{{ $category->members_count }}</span></td>
                    <td>
                        @if($category->is_active)
                            <span class="badge badge-active">Active</span>
                        @else
                            <span class="badge badge-inactive">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $category->order }}</td>
                    <td>
                        <a href="{{ route('admin.team-categories.edit', $category) }}" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.team-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No team categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
