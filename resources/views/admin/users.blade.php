@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="page-header">
    <h1>Manage Users</h1>
    <p>All registered users on the platform.</p>
</div>

<div class="eco-card">
    <table class="eco-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Eco Score</th>
                <th>Trips</th>
                <th>Joined</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td style="color:var(--eco-muted);">{{ $user->id }}</td>
                <td>
                    <div style="display:flex; align-items:center; gap:.6rem;">
                        <div style="width:32px; height:32px; border-radius:50%; background:rgba(34,197,94,.15); display:inline-flex; align-items:center; justify-content:center; color:var(--eco-green); font-weight:700; font-size:.85rem;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <span style="font-weight:500;">{{ $user->name }}</span>
                    </div>
                </td>
                <td style="color:var(--eco-muted); font-size:.85rem;">{{ $user->email }}</td>
                <td>
                    @if($user->role === 'admin')
                    <span class="badge-blue">Admin</span>
                    @else
                    <span class="badge-green">User</span>
                    @endif
                </td>
                <td><span style="color:var(--eco-green); font-weight:600;">{{ number_format($user->eco_score, 2) }}</span></td>
                <td>{{ $user->trips_count }}</td>
                <td style="color:var(--eco-muted); font-size:.82rem;">{{ $user->created_at->format('M d, Y') }}</td>
                <td>
                    @if($user->role !== 'admin')
                    <form method="POST" action="{{ route('admin.users.delete', $user) }}" onsubmit="return confirm('Delete user {{ $user->name }}? This cannot be undone.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger-eco"><i class="bi bi-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">{{ $users->links() }}</div>
</div>
@endsection
