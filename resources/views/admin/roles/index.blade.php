@extends('admin.layouts.app')
@section('title', 'Roles & Permissions')

@section('content')
@php
$permissions = ['View Dashboard','Manage Products','Manage Categories','Manage Orders','Manage Customers','Manage Coupons','Manage Blog','Manage Settings','Manage Admin Users'];
$roles = ['Super Admin','Content Editor','Support Staff'];
$matrix = [
    'Super Admin' => array_fill(0, 9, true),
    'Content Editor' => [true,true,true,false,false,false,true,false,false],
    'Support Staff' => [true,false,false,true,true,false,false,false,false],
];
@endphp
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Roles &amp; Permissions</span></div>
<div class="page-head"><div><h1>Roles &amp; permissions</h1></div><button class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Role</button></div>

<div class="card">
    <div class="table-wrap">
        <table class="grid">
            <thead>
                <tr>
                    <th>Permission</th>
                    @foreach($roles as $role)<th style="text-align:center">{{ $role }}</th>@endforeach
                </tr>
            </thead>
            <tbody>
            @foreach($permissions as $i => $perm)
                <tr>
                    <td class="cell-title">{{ $perm }}</td>
                    @foreach($roles as $role)
                        <td style="text-align:center">
                            @if($matrix[$role][$i])
                                <i class="bi bi-check-circle-fill" style="color:var(--good)"></i>
                            @else
                                <i class="bi bi-dash-circle" style="color:#D9DCE4"></i>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
