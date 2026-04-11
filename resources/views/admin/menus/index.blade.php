@extends('admin.layouts.app')
@section('title', 'Navigation Menus')
@section('page-title', 'Navigation Menus')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="mb-0">Manage Menu Items</h6>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Menu Item</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Title</th><th>URL / Route</th><th>Parent</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($menus as $menu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $menu->title }}</strong></td>
                        <td>{{ $menu->url ?? $menu->route ?? '-' }}</td>
                        <td>-</td>
                        <td><span class="badge bg-secondary">{{ $menu->order ?? 0 }}</span></td>
                        <td>
                            @if($menu->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @if($menu->children->count())
                        @foreach($menu->children as $child)
                        <tr>
                            <td></td>
                            <td class="ps-4"><i class="fas fa-level-up-alt fa-rotate-90 text-muted me-2"></i>{{ $child->title }}</td>
                            <td>{{ $child->url ?? $child->route ?? '-' }}</td>
                            <td>{{ $menu->title }}</td>
                            <td><span class="badge bg-secondary">{{ $child->order ?? 0 }}</span></td>
                            <td>
                                @if($child->is_active)
                                    <span class="badge badge-active">Active</span>
                                @else
                                    <span class="badge badge-inactive">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.menus.edit', $child) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.menus.destroy', $child) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No menu items found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
