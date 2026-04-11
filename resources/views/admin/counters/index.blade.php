@extends('admin.layouts.app')
@section('title', 'Counters')
@section('page-title', 'Counters')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Counters</h6>
    <a href="{{ route('admin.counters.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Counter</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Icon</th>
                    <th>Number</th>
                    <th>Label</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($counters as $counter)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><i class="{{ $counter->icon }} fa-lg text-success"></i></td>
                    <td><strong>{{ $counter->number }}{{ $counter->suffix }}</strong></td>
                    <td>{{ $counter->label }}</td>
                    <td><span class="badge bg-secondary">{{ $counter->order }}</span></td>
                    <td>
                        @if($counter->is_active)
                            <span class="badge badge-active">Active</span>
                        @else
                            <span class="badge badge-inactive">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.counters.edit', $counter) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.counters.destroy', $counter) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No counters found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
