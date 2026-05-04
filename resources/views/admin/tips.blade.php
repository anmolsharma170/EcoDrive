@extends('layouts.app')

@section('title', 'Manage Eco Tips')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <div>
        <h1>Manage Eco Tips</h1>
        <p>Create, edit, and manage eco driving tips.</p>
    </div>
    <a href="{{ route('admin.tips.create') }}" class="btn-eco btn">
        <i class="bi bi-plus-lg me-1"></i> Add Tip
    </a>
</div>

<div class="eco-card">
    <table class="eco-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tips as $tip)
            <tr>
                <td style="color:var(--eco-muted);">{{ $tip->id }}</td>
                <td style="font-weight:500; max-width:280px;">{{ Str::limit($tip->title, 50) }}</td>
                <td>
                    @php $catColors = ['driving'=>'badge-green','maintenance'=>'badge-blue','fuel'=>'badge-yellow']; @endphp
                    <span class="{{ $catColors[$tip->category] ?? 'badge-blue' }}">{{ ucfirst($tip->category) }}</span>
                </td>
                <td>
                    @if($tip->is_active)
                    <span class="badge-green"><i class="bi bi-check-circle me-1"></i>Active</span>
                    @else
                    <span class="badge-red"><i class="bi bi-x-circle me-1"></i>Inactive</span>
                    @endif
                </td>
                <td style="color:var(--eco-muted); font-size:.82rem;">{{ $tip->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.tips.edit', $tip) }}" class="btn btn-sm" style="background:rgba(59,130,246,.15); color:#60a5fa; border-radius:8px;">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.tips.delete', $tip) }}" onsubmit="return confirm('Delete this tip?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger-eco"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">{{ $tips->links() }}</div>
</div>
@endsection
