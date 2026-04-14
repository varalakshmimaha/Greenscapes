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
        <form action="{{ route('admin.service-subcategories.update', $serviceSubcategory) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Select Service <span class="text-danger">*</span></label>
                    <select id="serviceSelect" class="form-select" onchange="filterCategories(this.value)">
                        <option value="">-- Select Service --</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id', $serviceSubcategory->category->service_id ?? '') == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Select Category <span class="text-danger">*</span></label>
                    <select name="service_category_id" id="categorySelect" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" data-service="{{ $cat->service_id }}" {{ old('service_category_id', $serviceSubcategory->service_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Sub Category Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $serviceSubcategory->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $serviceSubcategory->description) }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Image</label>
                    @if($serviceSubcategory->image)
                        <div class="mb-2"><img src="{{ asset('storage/'.$serviceSubcategory->image) }}" class="img-thumbnail" style="max-height:120px;" alt=""></div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Leave empty to keep current image</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">PDF</label>
                    @if($serviceSubcategory->pdf)
                        <div class="mb-2"><a href="{{ asset('storage/'.$serviceSubcategory->pdf) }}" target="_blank" class="btn btn-sm btn-outline-success"><i class="fas fa-file-pdf me-1"></i>View Current PDF</a></div>
                    @endif
                    <input type="file" name="pdf" class="form-control" accept=".pdf">
                    <small class="text-muted">Leave empty to keep current PDF</small>
                </div>
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

<script>
function filterCategories(serviceId) {
    const catSelect = document.getElementById('categorySelect');
    const options = catSelect.querySelectorAll('option[data-service]');
    options.forEach(opt => {
        opt.style.display = (!serviceId || opt.dataset.service == serviceId) ? '' : 'none';
        if (serviceId && opt.dataset.service != serviceId) opt.selected = false;
    });
    if (!serviceId) catSelect.value = '';
}
filterCategories(document.getElementById('serviceSelect').value);
</script>
@endsection
