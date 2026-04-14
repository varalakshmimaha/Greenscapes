@extends('admin.layouts.app')
@section('title', 'Edit Menu Item')
@section('page-title', 'Edit Menu Item')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit Menu Item</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $menu->title) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Parent Menu</label>
                    <select name="parent_id" class="form-select">
                        <option value="">None (Top Level)</option>
                        @foreach($parentMenus as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">URL</label>
                    <input type="text" name="url" class="form-control" value="{{ old('url', $menu->url) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Route Name</label>
                    <input type="text" name="route" class="form-control" value="{{ old('route', $menu->route) }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $menu->order) }}" min="0">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="has_dropdown" class="form-check-input" id="has_dropdown" {{ $menu->has_dropdown ? 'checked' : '' }}>
                        <label class="form-check-label" for="has_dropdown">Has Dropdown</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $menu->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Menu Item</button>
        </form>
    </div>
</div>
@endsection
