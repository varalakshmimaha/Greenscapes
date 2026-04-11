@extends('admin.layouts.app')
@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">All Messages & Consultations</h6>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm {{ !request('filter') ? 'btn-primary' : 'btn-outline-secondary' }}">All</a>
        <a href="{{ route('admin.contacts.index', ['filter' => 'consultation']) }}" class="btn btn-sm {{ request('filter') == 'consultation' ? 'btn-success' : 'btn-outline-success' }}">
            <i class="fas fa-calendar-check me-1"></i>Consultations
        </a>
        <a href="{{ route('admin.contacts.index', ['filter' => 'contact']) }}" class="btn btn-sm {{ request('filter') == 'contact' ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fas fa-envelope me-1"></i>Contact Form
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Name</th><th>Phone</th><th>Service / Subject</th><th>Source</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr class="{{ !$contact->is_read ? 'fw-bold' : '' }}">
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->phone ?? '-' }}</td>
                        <td>{{ Str::limit($contact->message ?? $contact->subject, 30) ?? '-' }}</td>
                        <td>
                            @if($contact->source == 'consultation')
                                <span class="badge bg-success"><i class="fas fa-calendar-check me-1"></i>Consultation</span>
                            @else
                                <span class="badge bg-info"><i class="fas fa-envelope me-1"></i>Contact</span>
                            @endif
                        </td>
                        <td>{{ $contact->created_at->format('M d, Y') }}</td>
                        <td>
                            @if($contact->is_read)
                                <span class="badge badge-active">Read</span>
                            @else
                                <span class="badge badge-inactive">Unread</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No messages yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">{{ $contacts->links() }}</div>
@endsection
