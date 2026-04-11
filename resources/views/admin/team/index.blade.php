@extends('admin.layouts.app')
@section('title', 'Team Members')
@section('page-title', 'Team Members')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Team</h6>
    <a href="{{ route('admin.team.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Member</a>
</div>

<div class="row g-4">
    @forelse($members as $member)
    <div class="col-md-4 col-sm-6">
        <div class="card h-100">
            @if($member->photo)
                <img src="{{ asset('storage/'.$member->photo) }}" class="card-img-top" style="height:200px;object-fit:cover;" alt="">
            @else
                <div style="height:200px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-user fa-3x text-muted"></i>
                </div>
            @endif
            <div class="card-body">
                <h6 class="card-title mb-1">{{ $member->name }}</h6>
                <p class="text-muted small mb-1">{{ $member->role }}</p>
                @if($member->category)
                    <span class="badge bg-success mb-2" style="font-size: 0.7rem;">{{ $member->category->name }}</span>
                @endif
                <div class="mb-2">
                    @if($member->facebook)<a href="{{ $member->facebook }}" target="_blank" class="me-2 text-muted"><i class="fab fa-facebook"></i></a>@endif
                    @if($member->linkedin)<a href="{{ $member->linkedin }}" target="_blank" class="me-2 text-muted"><i class="fab fa-linkedin"></i></a>@endif
                    @if($member->instagram)<a href="{{ $member->instagram }}" target="_blank" class="text-muted"><i class="fab fa-instagram"></i></a>@endif
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if($member->is_active)
                            <span class="badge badge-active">Active</span>
                        @else
                            <span class="badge badge-inactive">Inactive</span>
                        @endif
                    </div>
                    <span class="badge bg-secondary">Order: {{ $member->order ?? 0 }}</span>
                </div>
            </div>
            <div class="card-footer bg-transparent d-flex justify-content-between">
                <a href="{{ route('admin.team.edit', $member) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('admin.team.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card"><div class="card-body text-center text-muted py-5">No team members found.</div></div>
    </div>
    @endforelse
</div>
@endsection
