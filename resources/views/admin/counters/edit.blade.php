@extends('admin.layouts.app')
@section('title', 'Edit Counter')
@section('page-title', 'Edit Counter')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.counters.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit Counter</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.counters.update', $counter) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Icon Class <span class="text-danger">*</span></label>
                    <input type="text" name="icon" class="form-control" value="{{ old('icon', $counter->icon) }}" required placeholder="e.g. fas fa-leaf">
                    <small class="text-muted">Use Font Awesome class (e.g. fas fa-leaf, fas fa-trophy, fas fa-users)</small>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Number <span class="text-danger">*</span></label>
                    <input type="text" name="number" class="form-control" value="{{ old('number', $counter->number) }}" required placeholder="e.g. 5">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Suffix</label>
                    <input type="text" name="suffix" class="form-control" value="{{ old('suffix', $counter->suffix) }}" placeholder="e.g. +, %, k">
                    <small class="text-muted">Appears after the number</small>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Label <span class="text-danger">*</span></label>
                <input type="text" name="label" class="form-control" value="{{ old('label', $counter->label) }}" required placeholder="e.g. Successful Years">
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $counter->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Counter</button>
        </form>
    </div>
</div>
@endsection
