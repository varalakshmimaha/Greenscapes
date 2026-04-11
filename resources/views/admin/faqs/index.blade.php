@extends('admin.layouts.app')
@section('title', 'FAQs')
@section('page-title', 'FAQs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage FAQs</h6>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add FAQ</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Category</th><th>Question</th><th>Image</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($faqs as $faq)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge bg-success">{{ $faq->category }}</span></td>
                        <td>{{ Str::limit($faq->question, 50) }}</td>
                        <td>
                            @if($faq->image)
                                <img src="{{ asset('storage/' . $faq->image) }}" alt="" class="img-thumbnail-sm" style="max-height:40px;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td><span class="badge bg-secondary">{{ $faq->order }}</span></td>
                        <td>
                            @if($faq->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No FAQs found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
