@extends('admin.layouts.app')
@section('title', 'Add Service Category')
@section('page-title', 'Add Service Category')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.service-categories.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Category Details</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.service-categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Category Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Category</button>
        </form>
    </div>
</div>
@endsection
