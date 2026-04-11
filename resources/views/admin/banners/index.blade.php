@extends('admin.layouts.app')
@section('title', 'Banners')
@section('page-title', 'Banners')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Banners</h6>
    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Banner</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Image</th><th>Title</th><th>Subtitle</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($banners as $banner)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/'.$banner->image) }}" class="img-thumbnail-sm" alt=""></td>
                        <td>{{ $banner->title ?? '-' }}</td>
                        <td>{{ $banner->subtitle ?? '-' }}</td>
                        <td><span class="badge bg-secondary">{{ $banner->order ?? 0 }}</span></td>
                        <td>
                            @if($banner->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No banners found. Add your first banner!</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
