@extends('admin.layouts.app')
@section('title', 'Customer Details')

@section('content')
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.customers.index') }}">Customers</a><span class="sep">/</span><span class="cur">Amelia Hart</span></div>

<div class="page-head">
    <div style="display:flex;align-items:center;gap:14px">
        <div class="avatar-sm" style="width:52px;height:52px;font-size:17px">{{ strtoupper(substr($user->name, 0, 1) . substr(strrchr($user->name, ' '), 1, 1)) }}</div>
        <div>
            <h1>{{ $user->name }}</h1>
            <div style="color:var(--ink-soft);font-size:13px">{{ $user->email }} · Joined {{ $user->created_at->format('M d, Y') }}</div>
        </div>
    </div>
    <button class="btn btn-outline"><i class="bi bi-envelope"></i> Send email</button>
</div>

<div class="stat-grid" style="grid-template-columns:repeat(3,1fr)">
    <div class="stat-card">
        <div class="label">Total orders</div>
        <div class="value"> {{ $totalOrders }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Total spent</div>
        <div class="value">${{ number_format($totalSpent, 2) }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Avg. order value</div>
        <div class="value">${{ number_format($averageOrderValue, 2) }}</div>
    </div>
</div>

<div class="card">
    <div class="card-head">
        <h3>Order history</h3>
    </div>
    <div class="table-wrap">
        <table class="grid">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($user->orders as $order)
                <tr>
                    <td class="cell-title">#{{ $order->order_number }}</td>
                    <td class="cell-sub">{{ $order->created_at->format('M d, Y') }}</td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td><span class="pill pill-good">{{ ucfirst($order->status) }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-8 text-gray-500">No orders found for this customer.</td>
                </tr>
                @endforelse
                <!-- <tr><td class="cell-title">#BK-3312</td><td class="cell-sub">Aug 14, 2026</td><td>$212.00</td><td><span class="pill pill-good">Delivered</span></td></tr>
                <tr><td class="cell-title">#BK-3204</td><td class="cell-sub">Jul 02, 2026</td><td>$76.00</td><td><span class="pill pill-good">Delivered</span></td></tr> -->
            </tbody>
        </table>
    </div>
</div>
@endsection