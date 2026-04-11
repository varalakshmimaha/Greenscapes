@extends('admin.layouts.app')
@section('title', 'Add About Section')
@section('page-title', 'Add About Section')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.about.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">About Section Details</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Section <span class="text-danger">*</span></label>
                    <select name="section" class="form-select" required>
                        <option value="overview" {{ old('section') == 'overview' ? 'selected' : '' }}>Overview</option>
                        <option value="mission" {{ old('section') == 'mission' ? 'selected' : '' }}>Mission</option>
                        <option value="vision" {{ old('section') == 'vision' ? 'selected' : '' }}>Vision</option>
                        <option value="history" {{ old('section') == 'history' ? 'selected' : '' }}>History</option>
                        <option value="values" {{ old('section') == 'values' ? 'selected' : '' }}>Values</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
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
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Section</button>
        </form>
    </div>
</div>
@endsection
