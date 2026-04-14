@extends('admin.layouts.app')
@section('title', 'Videos')
@section('page-title', 'Videos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Videos</h6>
    <a href="{{ route('admin.videos.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Video</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Thumbnail</th><th>Title</th><th>Video URL</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($videos as $video)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($video->thumbnail)
                                <img src="{{ asset('storage/'.$video->thumbnail) }}" class="img-thumbnail-sm" alt="">
                            @else
                                <div style="width:60px;height:60px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-play text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $video->title }}</strong></td>
                        <td><a href="{{ $video->video_url }}" target="_blank" class="text-decoration-none">{{ Str::limit($video->video_url, 30) }} <i class="fas fa-external-link-alt fa-xs"></i></a></td>
                        <td><span class="badge bg-secondary">{{ $video->order ?? 0 }}</span></td>
                        <td>
                            @if($video->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.videos.edit', $video) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No videos found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
