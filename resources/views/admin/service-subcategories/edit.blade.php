@extends('admin.layouts.app')
@section('title', 'Edit Sub Category')
@section('page-title', 'Edit Sub Category')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.service-subcategories.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit Sub Category</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.service-subcategories.update', $serviceSubcategory) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Parent Category <span class="text-danger">*</span></label>
                <select name="service_category_id" class="form-select" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('service_category_id', $serviceSubcategory->service_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Sub Category Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $serviceSubcategory->name) }}" required>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $serviceSubcategory->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Sub Category</button>
        </form>
    </div>
</div>
@endsection
