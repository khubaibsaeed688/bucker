@extends('admin.layouts.app')
@section('title', 'reports')

@section('content')
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Reports</span></div>
<div class="page-head">
    <div><h1>Sales reports</h1></div>
    <div style="display:flex;gap:10px">
        <select class="form-control" style="width:auto"><option>Last 30 days</option><option>Last 90 days</option><option>This year</option></select>
        <button class="btn btn-outline"><i class="bi bi-download"></i> Export CSV</button>
    </div>
</div>

<div class="stat-grid">
    <div class="stat-card"><div class="label">Total revenue</div><div class="value">$48,290</div><div class="delta up"><i class="bi bi-arrow-up-short"></i> 12.4%</div></div>
    <div class="stat-card"><div class="label">Total orders</div><div class="value">1,204</div><div class="delta up"><i class="bi bi-arrow-up-short"></i> 6.1%</div></div>
    <div class="stat-card"><div class="label">Avg. order value</div><div class="value">$40.10</div><div class="delta up"><i class="bi bi-arrow-up-short"></i> 2.2%</div></div>
    <div class="stat-card"><div class="label">Conversion rate</div><div class="value">3.4%</div><div class="delta down"><i class="bi bi-arrow-down-short"></i> 0.3%</div></div>
</div>

<div class="card">
    <div class="card-head"><h3>Revenue by category</h3></div>
    <div class="card-body">
        <canvas id="catChart" height="90"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script>
new Chart(document.getElementById('catChart'), {
    type: 'bar',
    data: {
        labels: ['Boots','Sneakers','Casual','Formal','Sandals'],
        datasets: [{ label: 'Revenue', data: [18400, 15200, 7300, 5100, 2290], backgroundColor: '#3E63DD', borderRadius: 6, maxBarThickness: 46 }]
    },
    options: { plugins:{legend:{display:false}}, scales:{ y:{ grid:{color:'#EEF0F4'} }, x:{ grid:{display:false} } } }
});
</script>
@endpush
