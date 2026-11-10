@extends('admin.layouts.app')
@section('title', 'Order #BK-3391')

@section('content')
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.orders.index') }}">Orders</a><span class="sep">/</span><span class="cur">#{{ $order->order_number }}</span></div>
<div class="page-head">
    <div>
        <h1>Order #{{ $order->order_number }}</h1>
        <div style="color:var(--ink-soft);font-size:13px;margin-top:2px">Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}</div>
    </div>
    <div style="display:flex;gap:10px;align-items:center">
        <select class="form-control" style="width:auto">
            <option>Processing</option>
            <option selected>Delivered</option>
            <option>Shipped</option>
            <option>Cancelled</option>
        </select>
        <button onclick="window.print()" class="btn btn-outline"><i class="bi bi-printer"></i> Print invoice</button>
    </div>
</div>

<div class="grid-2">
    <div>
        <div class="card">
            <div class="card-head">
                <h3>Items</h3>
            </div>
            <div class="table-wrap">
                <table class="grid">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td class="cell-main">
                                <div class="thumb" style="display:flex;align-items:center;justify-content:center;color:var(--ink-soft)"><i class="bi bi-image"></i></div>
                                <div class="cell-title">{{ $item->product_name }}</div>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>${{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body" style="border-top:1px solid var(--line)">
                <div style="display:flex;justify-content:space-between;margin-bottom:6px;color:var(--ink-soft);font-size:13.5px"><span>Subtotal</span><span>${{ number_format($order->subtotal, 2) }}</span></div>
                <div style="display:flex;justify-content:space-between;margin-bottom:6px;color:var(--ink-soft);font-size:13.5px"><span>Shipping</span><span>${{ number_format($order->shipping_cost, 2) }}</span></div>
                <div style="display:flex;justify-content:space-between;font-weight:700;font-size:15px;margin-top:8px;padding-top:8px;border-top:1px solid var(--line)"><span>Total</span><span>${{ number_format($order->total, 2) }}</span></div>
            </div>
        </div>

        <div class="card" style="margin-top:16px">
            <div class="card-head">
                <h3>Order timeline</h3>
            </div>
            <div class="card-body">
                <div style="display:flex;gap:12px;margin-bottom:16px">
                    <span class="pill pill-good" style="padding:4px 4px"><i class="bi bi-check"></i></span>
                    <div>
                        <div class="cell-title">Order {{ ucfirst($order->status) }}</div>
                        <div class="cell-sub">{{ $order->updated_at->format('M d, Y · g:i A') }}</div>
                    </div>
                </div>
                <div style="display:flex;gap:12px;margin-bottom:16px">
                    <span class="pill pill-accent" style="padding:4px 4px"><i class="bi bi-truck"></i></span>
                    <div>
                        <div class="cell-title">Order shipped</div>
                        <div class="cell-sub">Sep 25, 2026 · 10:03 AM</div>
                        @if($order->status === 'shipped')
                        <div class="cell-sub">
                            {{ $order->updated_at->format('M d, Y · h:i A') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div style="display:flex;gap:12px">
                    <span class="pill pill-neutral" style="padding:4px 4px"><i class="bi bi-bag-check"></i></span>
                    <div>
                        <div class="cell-title">Order placed</div>
                        <div class="cell-sub">{{ $order->created_at->format('M d, Y · g:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-head">
                <h3>Customer</h3>
            </div>
            <div class="card-body">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px">
                    <div class="avatar-sm">{{ strtoupper(substr($order->user->name, 0, 1) . substr(strrchr($order->user->name, ' '), 1, 1)) }}</div>
                    <div>
                        <div class="cell-title">{{ $order->user->name }}</div>
                        <div class="cell-sub">{{ $order->user->email }}</div>
                    </div>
                </div>
                <a href="{{ route('admin.customers.show', $order->user) }}" class="btn btn-outline btn-sm" style="width:100%;justify-content:center">View customer</a>
            </div>
        </div>
        <div class="card" style="margin-top:16px">
            <div class="card-head">
                <h3>Shipping address</h3>
            </div>
            <div class="card-body" style="font-size:13.5px;color:var(--ink-soft);line-height:1.7">
                221B Baker Street<br>Lahore, Punjab 54000<br>Pakistan<br>+92 300 1234567
            </div>
        </div>
        <div class="card" style="margin-top:16px">
            <div class="card-head">
                <h3>Payment</h3>
            </div>
            <div class="card-body">
                <span class="pill pill-good">Paid via Visa •••• 4242</span>
                <!-- @if($order->payment)  //this is apply when the payment table are complete

                    <p class="font-medium">
                        {{ ucfirst($order->payment->status) }}
                    </p>

                    <p class="text-gray-500 mt-1">
                        Paid via {{ $order->payment->method }}
                    </p>

                @else

                    <p class="text-gray-500">
                        Payment information not available.
                    </p>

                @endif -->
            </div>
        </div>
    </div>
</div>
@endsection