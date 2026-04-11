@extends('admin.layouts.app')
@section('title', 'Edit FAQ')
@section('page-title', 'Edit FAQ')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back</a>
</div>

<div class="card">
    <div class="card-header"><h6 class="mb-0">Edit FAQ</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category" class="form-control" required>
                        @foreach(\App\Models\Faq::CATEGORIES as $cat)
                            <option value="{{ $cat }}" {{ old('category', $faq->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $faq->order) }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Question <span class="text-danger">*</span></label>
                <input type="text" name="question" class="form-control" value="{{ old('question', $faq->question) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Answer <span class="text-danger">*</span></label>
                <textarea name="answer" class="form-control" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Category Image <small class="text-muted">(shown on frontend for this category tab)</small></label>
                @if($faq->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $faq->image) }}" alt="" class="img-thumbnail" style="max-height:120px;">
                        <div class="form-check mt-1">
                            <input type="checkbox" name="remove_image" class="form-check-input" id="remove_image">
                            <label class="form-check-label text-danger" for="remove_image">Remove image</label>
                        </div>
                    </div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $faq->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update FAQ</button>
        </form>
    </div>
</div>
@endsection
