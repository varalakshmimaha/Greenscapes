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
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Image</label>
                    @if($serviceCategory->image)
                        <div class="mb-2"><img src="{{ asset('storage/'.$serviceCategory->image) }}" class="img-thumbnail" style="max-height:120px;" alt=""></div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Leave empty to keep current image</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">PDF</label>
                    @if($serviceCategory->pdf)
                        <div class="mb-2"><a href="{{ asset('storage/'.$serviceCategory->pdf) }}" target="_blank" class="btn btn-sm btn-outline-success"><i class="fas fa-file-pdf me-1"></i>View Current PDF</a></div>
                    @endif
                    <input type="file" name="pdf" class="form-control" accept=".pdf">
                    <small class="text-muted">Leave empty to keep current PDF</small>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Sub Categories</label>
                <select class="form-select" disabled>
                    @forelse($serviceCategory->subCategories as $sub)
                        <option>{{ $sub->name }}</option>
                    @empty
                        <option>-- No Sub Categories --</option>
                    @endforelse
                </select>
                <small class="text-muted">Sub categories are managed from <a href="{{ route('admin.service-subcategories.index') }}">Sub Categories</a> in sidebar</small>
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
