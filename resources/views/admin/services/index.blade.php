@extends('admin.layouts.app')
@section('title', 'Services')
@section('page-title', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('admin.services.index') }}" class="btn btn-sm {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }}">All</a>
        @foreach($categories as $cat)
            <a href="{{ route('admin.services.index', ['category' => $cat->id]) }}" class="btn btn-sm {{ request('category') == $cat->id ? 'btn-primary' : 'btn-outline-primary' }}">{{ $cat->name }}</a>
        @endforeach
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Service</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Image</th><th>Name</th><th>Category</th><th>Sub Category</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($service->image)
                                <img src="{{ asset('storage/'.$service->image) }}" class="img-thumbnail-sm" alt="">
                            @else
                                <div style="width:50px;height:50px;background:#e8f5e3;color:#4a7c3f;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                    <i class="{{ $service->icon ?? 'fas fa-leaf' }}"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $service->name }}</strong></td>
                        <td>
                            @if($service->serviceCategory)
                                <span class="badge bg-success">{{ $service->serviceCategory->name }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($service->serviceSubCategory)
                                <span class="badge bg-info">{{ $service->serviceSubCategory->name }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
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
                    <tr><td colspan="8" class="text-center text-muted py-4">No services found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
