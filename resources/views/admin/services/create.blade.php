@extends('admin.layouts.app')
@section('title', 'Add New Service')
@section('page-title', 'Add New Service')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Service Details</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Icon Class</label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon') }}" placeholder="fas fa-leaf">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category <span class="text-muted">(Optional)</span></label>
                    <select name="service_category_id" id="categorySelect" class="form-select" onchange="loadSubCategories(this.value)">
                        <option value="">-- No Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('service_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Sub Category <span class="text-muted">(Optional)</span></label>
                    <select name="service_sub_category_id" id="subCategorySelect" class="form-select">
                        <option value="">-- No Sub Category --</option>
                        @foreach($subCategories as $sub)
                            <option value="{{ $sub->id }}" data-cat="{{ $sub->service_category_id }}" {{ old('service_sub_category_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">PDF Brochure <span class="text-muted">(Optional)</span></label>
                    <input type="file" name="pdf" class="form-control" accept=".pdf">
                    <small class="text-muted">Max 10MB. Will be available for download on the service page.</small>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Service</button>
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

    function loadSubCategories(catId) {
        const subSelect = document.getElementById('subCategorySelect');
        const options = subSelect.querySelectorAll('option[data-cat]');
        options.forEach(opt => {
            opt.style.display = (!catId || opt.dataset.cat == catId) ? '' : 'none';
            if (opt.dataset.cat != catId) opt.selected = false;
        });
        if (!catId) subSelect.value = '';
    }
    // Init filter
    loadSubCategories(document.getElementById('categorySelect').value);
</script>
@endsection
