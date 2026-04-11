@extends('admin.layouts.app')
@section('title', 'Testimonials')
@section('page-title', 'Testimonials')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Testimonials</h6>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Testimonial</a>
</div>

<div class="row g-4">
    @forelse($testimonials as $testimonial)
    <div class="col-md-4 col-sm-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    @if($testimonial->photo)
                        <img src="{{ asset('storage/'.$testimonial->photo) }}" class="rounded-circle me-3" style="width:50px;height:50px;object-fit:cover;" alt="">
                    @else
                        <div class="rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:#f0f0f0;">
                            <i class="fas fa-user text-muted"></i>
                        </div>
                    @endif
                    <div>
                        <h6 class="mb-0">{{ $testimonial->name }}</h6>
                        <small class="text-muted">{{ $testimonial->role }}</small>
                    </div>
                </div>
                <div class="mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}" style="color: {{ $i <= $testimonial->rating ? '#f59e0b' : '#ddd' }}; font-size: 0.85rem;"></i>
                    @endfor
                </div>
                <p class="text-muted small mb-3" style="line-height:1.7;">"{{ Str::limit($testimonial->content, 150) }}"</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if($testimonial->is_active)
                            <span class="badge badge-active">Active</span>
                        @else
                            <span class="badge badge-inactive">Inactive</span>
                        @endif
                    </div>
                    <span class="badge bg-secondary">Order: {{ $testimonial->order ?? 0 }}</span>
                </div>
            </div>
            <div class="card-footer bg-transparent d-flex justify-content-between">
                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card"><div class="card-body text-center text-muted py-5">No testimonials found.</div></div>
    </div>
    @endforelse
</div>
@endsection
