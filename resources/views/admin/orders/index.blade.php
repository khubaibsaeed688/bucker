@extends('admin.layouts.app')
@section('title', 'Orders')

@section('content')

<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Orders</span></div>
<div class="page-head">
    <div>
        <h1>Orders</h1>
    </div>
    <button class="btn btn-outline"><i class="bi bi-download"></i> Export</button>
</div>

<div class="card">
    <div class="card-body" style="padding-bottom:0">
        <div class="filters-bar">
            <div class="search"><i class="bi bi-search"></i><input class="form-control" placeholder="Search order ID or customer…"></div>
            <select class="form-control">
                <option>All statuses</option>
                <option>Processing</option>
                <option>Shipped</option>
                <option>Delivered</option>
                <option>Cancelled</option>
            </select>
            <select class="form-control">
                <option>All payments</option>
                <option>Paid</option>
                <option>Pending</option>
                <option>Refunded</option>
            </select>
        </div>
    </div>
    <div class="table-wrap">
        <table class="grid">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $o)
                <tr>
                    <td class="cell-title">{{ $o->order_number  }}</td>
                    <td>{{ $o->user->name }}</td>
                    <td>{{ $o->items->count() }} items</td>
                    <td class="cell-sub">{{ $o->created_at->format('M d, Y') }}</td>
                    <td>${{ number_format($o->total, 2) }}</td>
                    <td><span class="pill pill-neutral">{{ ucfirst($o->payment_status) }}</span></td>
                    <td><span class="pill pill-{{ $o['type'] }}"><i class="bi bi-dot"></i>{{ ucfirst($o->status) }}</span></td>
                    <td><a href="{{ route('admin.orders.show', $o) }}" class="btn btn-outline btn-sm">View</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        No orders found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-bar">
        <div>Showing 1–6 of 1,204 orders</div>
        <div class="pg-btns"><a href="#"><i class="bi bi-chevron-left"></i></a><a href="#" class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#"><i class="bi bi-chevron-right"></i></a></div>
    </div>
</div>
@endsection