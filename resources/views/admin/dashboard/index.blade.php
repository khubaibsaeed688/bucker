@extends('admin.layouts.app')
@section('title', 'dashboard')

@section('content')
<!-- @php


$topProducts = [
    ['name'=>'Classic Leather Boot','sold'=>214,'stock'=>38],
    ['name'=>'Urban Canvas Sneaker','sold'=>187,'stock'=>52],
    ['name'=>'Trail Runner Pro','sold'=>150,'stock'=>12],
    ['name'=>'Suede Chelsea Boot','sold'=>121,'stock'=>0],
];
@endphp -->

<div class="page-head">
    <div>
        <div class="eyebrow">Overview</div>
        <h1>Good afternoon, Sarah</h1>
    </div>
    <div style="display:flex;gap:10px">
        <button class="btn btn-outline"><i class="bi bi-calendar3"></i> Last 30 days</button>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Product</a>
    </div>
</div>

<div class="stat-grid">

    {{-- Total Orders --}}
    <div class="stat-card">
        <div class="top">
            <div class="icon" style="background: var(--good-soft); color: var(--good);">
                <i class="bi bi-cart-check"></i>
            </div>
        </div>

        <div class="label">Total Orders</div>
        <div class="value">{{ $totalOrders }}</div>
    </div>


    {{-- Total Customers --}}
    <div class="stat-card">
        <div class="top">
            <div class="icon" style="background: var(--accent-soft); color: var(--accent-ink);">
                <i class="bi bi-people"></i>
            </div>
        </div>

        <div class="label">Total Customers</div>
        <div class="value">{{ $totalCustomers }}</div>
    </div>


    {{-- Total Products --}}
    <div class="stat-card">
        <div class="top">
            <div class="icon" style="background: var(--warn-soft); color: var(--warn);">
                <i class="bi bi-box-seam"></i>
            </div>
        </div>

        <div class="label">Total Products</div>
        <div class="value">{{ $totalProducts }}</div>
    </div>


    {{-- Total Revenue --}}
    <div class="stat-card">
        <div class="top">
            <div class="icon" style="background: var(--bad-soft); color: var(--bad);">
                <i class="bi bi-currency-dollar"></i>
            </div>
        </div>

        <div class="label">Total Revenue</div>
        <div class="value">Rs. {{ number_format($totalRevenue, 2) }}</div>
    </div>

</div>

<!-- <div class="grid-2">
    <div class="card">
        <div class="card-head">
            <h3>Sales performance</h3>
            <div class="pill pill-neutral">This month</div>
        </div>
        <div class="card-body">
            <canvas id="salesChart" height="110"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-head">
            <h3>Top products</h3>
            <a href="{{ route('admin.products.index') }}" style="font-size:12.5px;color:var(--accent-ink);font-weight:600">View all</a>
        </div>
        <div class="card-body" style="padding:8px 0">
            @foreach($topProducts as $p)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:11px 20px;{{ !$loop->last ? 'border-bottom:1px solid var(--line)' : '' }}">
                <div>
                    <div class="cell-title">{{ $p['name'] }}</div>
                    <div class="cell-sub">{{ $p['sold'] }} sold</div>
                </div>
                @if($p['stock'] == 0)
                    <span class="pill pill-bad">Out of stock</span>
                @elseif($p['stock'] < 20)
                    <span class="pill pill-warn">{{ $p['stock'] }} left</span>
                @else
                    <span class="pill pill-good">{{ $p['stock'] }} in stock</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div> -->

<div class="card" style="margin-top:16px">
    <div class="card-head">
        <h3>Recent orders</h3>
        <a href="{{ route('admin.orders.index') }}" style="font-size:12.5px;color:var(--accent-ink);font-weight:600">View all</a>
    </div>
    <div class="table-wrap">
        <table class="grid">
            <thead><tr><th>Order</th><th>Customer</th><th>Date</th><th>Total</th><th>Status</th></tr></thead>
            <tbody>
            @foreach($recentOrders as $o)
                <tr>
                    <td class="cell-title">{{ $o['order_number'] }}</td>
                    <td>{{ $o->user->name }}</td>
                    <td class="cell-sub">{{ $o->created_at->format('M d, Y') }}</td>
                    <td>{{ $o['total'] }}</td>
                    <td><span class="pill pill-{{ $o['type'] }}"><i class="bi bi-dot"></i>{{ $o['status'] }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
new Chart(document.getElementById('salesChart'), {
    type: 'line',
    data: {
        labels: ['Wk 1','Wk 2','Wk 3','Wk 4','Wk 5'],
        datasets: [{
            label: 'Revenue',
            data: [9200, 11800, 10400, 13950, 12980],
            borderColor: '#3E63DD',
            backgroundColor: 'rgba(62,99,221,.08)',
            fill: true, tension: .35, pointRadius: 3
        }]
    },
    options: { plugins:{legend:{display:false}}, scales:{ y:{ grid:{color:'#EEF0F4'} }, x:{ grid:{display:false} } } }
});
</script>
@endpush
