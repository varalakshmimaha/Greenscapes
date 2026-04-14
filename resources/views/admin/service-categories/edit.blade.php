@extends('admin.layouts.app')
@section('title', 'Edit Service Category')
@section('page-title', 'Edit Service Category')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.service-categories.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit Category</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.service-categories.update', $serviceCategory) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Select Service <span class="text-danger">*</span></label>
                <select name="service_id" class="form-select" required>
                    <option value="">-- Select Service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id', $serviceCategory->service_id) == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Category Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $serviceCategory->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $serviceCategory->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                @if($serviceCategory->image)
                    <div class="mb-2"><img src="{{ asset('storage/'.$serviceCategory->image) }}" class="img-thumbnail" style="max-height:120px;" alt=""></div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Leave empty to keep current image</small>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $serviceCategory->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Category</button>
        </form>
    </div>
</div>
@endsection
