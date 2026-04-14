@extends('admin.layouts.app')
@section('title', 'Service Sub Categories')
@section('page-title', 'Service Sub Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Sub Categories</h6>
    <a href="{{ route('admin.service-subcategories.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Sub Category</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Name</th><th>Service</th><th>Category</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($subCategories as $sub)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $sub->name }}</strong></td>
                        <td>
                            @if($sub->category && $sub->category->service)
                                <span class="badge bg-primary">{{ $sub->category->service->name }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td><span class="badge bg-success">{{ $sub->category->name ?? '-' }}</span></td>
                        <td><span class="badge bg-secondary">{{ $sub->order }}</span></td>
                        <td>
                            @if($sub->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.service-subcategories.edit', $sub) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.service-subcategories.destroy', $sub) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No sub categories found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
