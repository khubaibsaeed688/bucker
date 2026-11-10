@extends('admin.layouts.app')
@section('title', 'Customers')

@section('content')

<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Customers</span></div>
<div class="page-head"><div><h1>Customers</h1></div><button class="btn btn-outline"><i class="bi bi-download"></i> Export</button></div>

<div class="card">
    <div class="card-body" style="padding-bottom:0">
        <div class="filters-bar">
            <div class="search"><i class="bi bi-search"></i><input class="form-control" placeholder="Search customers…"></div>
        </div>
    </div>
    <div class="table-wrap">
        <table class="grid">
            <thead><tr><th>Customer</th><th>Orders</th><th>Total spent</th><th>Joined</th><th></th></tr></thead>
            <tbody>
            @foreach($customers as $c)
                <tr>
                    <td>
                        <div class="cell-main">
                            <div class="avatar-sm">{{ strtoupper(substr($c->name, 0, 1) . substr(strrchr($c->name, ' '), 1, 1)) }}</div>
                            <div><div class="cell-title">{{ $c['name'] }}</div><div class="cell-sub">{{ $c['email'] }}</div></div>
                        </div>
                    </td>
                    <td>{{ $c->orders_count }}</td>
                    <td>$ {{ number_format($c->orders_sum_total ?? 0, 2) }}</td>
                    <td class="cell-sub">{{ $c->created_at->format('M d, Y') }}</td>
                    <td><a href="{{ route('admin.customers.show', $c) }}" class="btn btn-outline btn-sm">View</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
