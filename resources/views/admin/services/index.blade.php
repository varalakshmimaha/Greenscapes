@extends('admin.layouts.app')
@section('title', 'Services')
@section('page-title', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Services</h6>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Service</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Image</th><th>Name</th><th>Categories</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($service->image)
                                <img src="{{ asset('storage/'.$service->image) }}" class="img-thumbnail-sm" style="max-height:40px;" alt="">
                            @else
                                <div style="width:40px;height:40px;background:#e8f5e3;color:#4a7c3f;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                    <i class="{{ $service->icon ?? 'fas fa-leaf' }}"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $service->name }}</strong></td>
                        <td><span class="badge bg-info">{{ $service->categories_count }}</span></td>
                        <td><span class="badge bg-secondary">{{ $service->order }}</span></td>
                        <td>
                            @if($service->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No services found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
