@extends('admin.layouts.app')
@section('title', 'About Us')
@section('page-title', 'About Us Sections')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage About Sections</h6>
    <a href="{{ route('admin.about.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Section</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Image</th><th>Title</th><th>Section</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($abouts as $about)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($about->image)
                                <img src="{{ asset('storage/'.$about->image) }}" class="img-thumbnail-sm" alt="">
                            @else
                                <span class="text-muted"><i class="fas fa-image"></i></span>
                            @endif
                        </td>
                        <td>{{ $about->title }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($about->section) }}</span></td>
                        <td><span class="badge bg-secondary">{{ $about->order ?? 0 }}</span></td>
                        <td>
                            @if($about->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.about.edit', $about) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.about.destroy', $about) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No about sections found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
