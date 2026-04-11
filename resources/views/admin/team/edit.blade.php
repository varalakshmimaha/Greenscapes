@extends('admin.layouts.app')
@section('title', 'Edit Team Member')
@section('page-title', 'Edit Team Member')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit Member</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.team.update', $member) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Role <span class="text-danger">*</span></label>
                    <input type="text" name="role" class="form-control" value="{{ old('role', $member->role) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Category</label>
                    <select name="team_category_id" class="form-select">
                        <option value="">-- No Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('team_category_id', $member->team_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Photo</label>
                @if($member->photo)
                    <div class="mb-2"><img src="{{ asset('storage/'.$member->photo) }}" class="img-thumbnail" style="max-height:150px" alt=""></div>
                @endif
                <input type="file" name="photo" class="form-control" accept="image/*">
                <small class="text-muted">Leave empty to keep current photo</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control" rows="3">{{ old('bio', $member->bio) }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label"><i class="fab fa-facebook me-1"></i>Facebook URL</label>
                    <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $member->facebook) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><i class="fab fa-linkedin me-1"></i>LinkedIn URL</label>
                    <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $member->linkedin) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label"><i class="fab fa-instagram me-1"></i>Instagram URL</label>
                    <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $member->instagram) }}">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $member->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Member</button>
        </form>
    </div>
</div>
@endsection
