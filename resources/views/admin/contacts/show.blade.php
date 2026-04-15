@extends('admin.layouts.app')
@section('title', 'View Message')
@section('page-title', 'View Message')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back to Messages</a>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Message from {{ $contact->name }}</h6>
        @if($contact->source == 'consultation')
            <span class="badge bg-success"><i class="fas fa-calendar-check me-1"></i>Book Consultation</span>
        @else
            <span class="badge bg-info"><i class="fas fa-envelope me-1"></i>Contact Form</span>
        @endif
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label text-muted small">Name</label>
                <p class="fw-semibold">{{ $contact->name }}</p>
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small">Phone</label>
                <p><a href="tel:{{ $contact->phone }}">{{ $contact->phone ?? '-' }}</a></p>
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small">Email</label>
                <p>{{ $contact->email ?? '-' }}</p>
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small">City</label>
                <p>{{ $contact->subject ?? '-' }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label text-muted small">Service Required</label>
                <p class="fw-semibold">{{ $contact->message ?? '-' }}</p>
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small">Source</label>
                <p>
                    @if($contact->source == 'consultation')
                        <span class="badge bg-success">Book Consultation</span>
                    @else
                        <span class="badge bg-info">Contact Form</span>
                    @endif
                </p>
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small">Received</label>
                <p>{{ $contact->created_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger"><i class="fas fa-trash me-2"></i>Delete Message</button>
        </form>
    </div>
</div>
@endsection
