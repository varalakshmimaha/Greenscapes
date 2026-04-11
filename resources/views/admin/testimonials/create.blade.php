@extends('admin.layouts.app')
@section('title', 'Add Testimonial')
@section('page-title', 'Add Testimonial')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Testimonial Details</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Role / Designation</label>
                    <input type="text" name="role" class="form-control" value="{{ old('role') }}" placeholder="e.g. Founder, Client, CEO">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Rating <span class="text-danger">*</span></label>
                    <select name="rating" class="form-control" required>
                        <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5 Stars</option>
                        <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 Stars</option>
                        <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 Stars</option>
                        <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 Stars</option>
                        <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 Star</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Testimonial Content <span class="text-danger">*</span></label>
                <textarea name="content" class="form-control" rows="4" required placeholder="What the client said...">{{ old('content') }}</textarea>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Testimonial</button>
        </form>
    </div>
</div>
@endsection
