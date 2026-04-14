@extends('admin.layouts.app')
@section('title', 'Edit Service')
@section('page-title', 'Edit Service')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit Service</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Icon Class</label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon) }}" placeholder="fas fa-leaf">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $service->description) }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Image</label>
                    @if($service->image)
                        <div class="mb-2"><img src="{{ asset('storage/'.$service->image) }}" class="img-thumbnail" style="max-height:150px" alt=""></div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Leave empty to keep current image</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">PDF Brochure <span class="text-muted">(Optional)</span></label>
                    @if($service->pdf)
                        <div class="mb-2 d-flex align-items-center gap-2">
                            <a href="{{ asset('storage/'.$service->pdf) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-file-pdf me-1"></i> View Current PDF
                            </a>
                            <label class="form-check-label">
                                <input type="checkbox" name="remove_pdf" class="form-check-input" value="1"> Remove PDF
                            </label>
                        </div>
                    @endif
                    <input type="file" name="pdf" class="form-control" accept=".pdf">
                    <small class="text-muted">Max 10MB. Leave empty to keep current PDF.</small>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $service->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Service</button>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        height: 300,
        removePlugins: 'elementspath',
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'insert', items: ['Table', 'HorizontalRule'] },
            { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize', 'Source'] }
        ]
    });
</script>
@endsection
