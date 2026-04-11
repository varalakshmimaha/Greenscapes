@extends('admin.layouts.app')
@section('title', 'Service Categories')
@section('page-title', 'Service Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Categories</h6>
    <a href="{{ route('admin.service-categories.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Category</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Image</th><th>Name</th><th>Sub Categories</th><th>Services</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($categories as $cat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($cat->image)
                                <img src="{{ asset('storage/'.$cat->image) }}" class="img-thumbnail-sm" style="max-height:40px;" alt="">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td><strong>{{ $cat->name }}</strong></td>
                        <td><span class="badge bg-info">{{ $cat->sub_categories_count }}</span></td>
                        <td><span class="badge bg-secondary">{{ $cat->services_count }}</span></td>
                        <td><span class="badge bg-secondary">{{ $cat->order }}</span></td>
                        <td>
                            @if($cat->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.service-categories.edit', $cat) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.service-categories.destroy', $cat) }}" method="POST" class="d-inline" onsubmit="return confirm('This will also delete related sub categories. Continue?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No categories found. Add your first category!</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
