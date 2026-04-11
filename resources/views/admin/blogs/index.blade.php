@extends('admin.layouts.app')
@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Blog Posts</h6>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Post</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Image</th><th>Title</th><th>Category</th><th>Author</th><th>Order</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($blogs as $blog)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($blog->image)
                                <img src="{{ asset('storage/'.$blog->image) }}" class="img-thumbnail-sm" alt="">
                            @else
                                <div style="width:60px;height:60px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-newspaper text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ Str::limit($blog->title, 40) }}</strong></td>
                        <td>{{ $blog->category ?? '-' }}</td>
                        <td>{{ $blog->author ?? '-' }}</td>
                        <td><span class="badge bg-secondary">{{ $blog->order ?? 0 }}</span></td>
                        <td>
                            @if($blog->is_published)
                                <span class="badge badge-active">Published</span>
                            @else
                                <span class="badge badge-inactive">Draft</span>
                            @endif
                        </td>
                        <td>{{ $blog->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">No blog posts found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
