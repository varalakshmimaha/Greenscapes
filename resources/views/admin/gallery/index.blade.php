@extends('admin.layouts.app')
@section('title', 'Gallery')
@section('page-title', 'Gallery')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Gallery</h6>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Image</a>
</div>

<div class="row g-4">
    @forelse($galleries as $gallery)
    <div class="col-md-3 col-sm-6">
        <div class="card h-100">
            <img src="{{ asset('storage/'.$gallery->image) }}" class="card-img-top" style="height:200px;object-fit:cover;" alt="">
            <div class="card-body">
                <h6 class="card-title mb-1">{{ $gallery->title ?? 'Untitled' }}</h6>
                @if($gallery->category)
                    <span class="badge bg-secondary mb-2">{{ $gallery->category }}</span>
                @endif
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if($gallery->is_active)
                            <span class="badge badge-active">Active</span>
                        @else
                            <span class="badge badge-inactive">Inactive</span>
                        @endif
                    </div>
                    <span class="badge bg-secondary">Order: {{ $gallery->order ?? 0 }}</span>
                </div>
            </div>
            <div class="card-footer bg-transparent d-flex justify-content-between">
                <a href="{{ route('admin.gallery.edit', $gallery) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card"><div class="card-body text-center text-muted py-5">No gallery images found. Add your first image!</div></div>
    </div>
    @endforelse
</div>
@endsection
