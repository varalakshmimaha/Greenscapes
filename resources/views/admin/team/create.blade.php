@extends('admin.layouts.app')
@section('title', 'Add Team Member')
@section('page-title', 'Add Team Member')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Member Details</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Role <span class="text-danger">*</span></label>
                    <input type="text" name="role" class="form-control" value="{{ old('role') }}" required placeholder="e.g. Head Gardener">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Category</label>
                    <select name="team_category_id" class="form-select">
                        <option value="">-- No Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('team_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control" rows="3">{{ old('bio') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label"><i class="fab fa-facebook me-1"></i>Facebook URL</label>
                    <input type="url" name="facebook" class="form-control" value="{{ old('facebook') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><i class="fab fa-linkedin me-1"></i>LinkedIn URL</label>
                    <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><i class="fab fa-instagram me-1"></i>Instagram URL</label>
                    <input type="url" name="instagram" class="form-control" value="{{ old('instagram') }}">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Member</button>
        </form>
    </div>
</div>
@endsection
