@extends('admin.layouts.app')
@section('title', 'Admin Users')

@section('content')

<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Admin Users</span></div>
<div class="page-head"><div><h1>Admin users</h1></div><a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add User</a></div>

<div class="card">
    <div class="table-wrap">
        <table class="grid">
            <thead><tr><th>User</th><th>Role</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @foreach($users as $u)
                <tr>
                    <td>
                        <div class="cell-main">
                            <div class="avatar-sm">{{ strtoupper(substr($u->name, 0, 1) . substr(strrchr($u->name, ' '), 1, 1)) }}</div>
                            <div><div class="cell-title">{{ $u['name'] }}</div><div class="cell-sub">{{ $u['email'] }}</div></div>
                        </div>
                    </td>
                    <td><span class="pill pill-accent">{{ ucfirst($u['role']) }}</span></td>
                    <td>@if($u['status']=='active')<span class="pill pill-good">Active</span>@else<span class="pill pill-warn">Invited</span>@endif</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-outline btn-icon btn-sm"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.users.destroy', $u) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger-outline btn-icon btn-sm"><i class="bi bi-trash"></i></button>
                            </form>    
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
