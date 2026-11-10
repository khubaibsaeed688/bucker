@extends('admin.layouts.app')
@section('title', 'Settings')

@section('content')
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Settings</span></div>
<div class="page-head"><div><h1>Store settings</h1></div></div>

<div class="tab-scope">
<div class="tabs">
    <div class="tab-link active" data-tab="tab-general">General</div>
    <div class="tab-link" data-tab="tab-payment">Payment</div>
    <div class="tab-link" data-tab="tab-shipping">Shipping</div>
    <div class="tab-link" data-tab="tab-seo">SEO</div>
</div>

<div id="tab-general" class="tab-pane active">
    <div class="card">
        <div class="card-head"><h3>General information</h3></div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group"><label>Store name</label><input type="text" class="form-control" value="Bucker"></div>
                <div class="form-group"><label>Store email</label><input type="email" class="form-control" value="support@bucker.com"></div>
                <div class="form-group"><label>Phone number</label><input type="text" class="form-control" value="+92 300 1234567"></div>
                <div class="form-group"><label>Currency</label><select class="form-control"><option>USD ($)</option><option>PKR (₨)</option><option>EUR (€)</option></select></div>
                <div class="form-group full"><label>Store address</label><textarea class="form-control" rows="3">221B Baker Street, Lahore, Punjab, Pakistan</textarea></div>
            </div>
            <div class="form-actions"><button class="btn btn-primary"><i class="bi bi-check-lg"></i> Save changes</button></div>
        </div>
    </div>
</div>

<div id="tab-payment" class="tab-pane">
    <div class="card">
        <div class="card-head"><h3>Payment methods</h3></div>
        <div class="card-body">
            @foreach(['Stripe','PayPal','Cash on Delivery'] as $i => $method)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 0;{{ !$loop->last ? 'border-bottom:1px solid var(--line)' : '' }}">
                <div class="cell-title">{{ $method }}</div>
                <label class="switch"><input type="checkbox" {{ $i < 2 ? 'checked' : '' }}><span class="slider"></span></label>
            </div>
            @endforeach
            <div class="form-actions"><button class="btn btn-primary"><i class="bi bi-check-lg"></i> Save changes</button></div>
        </div>
    </div>
</div>

<div id="tab-shipping" class="tab-pane">
    <div class="card">
        <div class="card-head"><h3>Shipping zones</h3></div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group"><label>Flat shipping rate ($)</label><input type="text" class="form-control" value="0.00"></div>
                <div class="form-group"><label>Free shipping over ($)</label><input type="text" class="form-control" value="100.00"></div>
            </div>
            <div class="form-actions"><button class="btn btn-primary"><i class="bi bi-check-lg"></i> Save changes</button></div>
        </div>
    </div>
</div>

<div id="tab-seo" class="tab-pane">
    <div class="card">
        <div class="card-head"><h3>SEO defaults</h3></div>
        <div class="card-body">
            <div class="form-group"><label>Meta title</label><input type="text" class="form-control" value="Bucker — Footwear for Every Step"></div>
            <div class="form-group"><label>Meta description</label><textarea class="form-control" rows="3">Shop premium boots, sneakers and casual footwear at Bucker.</textarea></div>
            <div class="form-actions"><button class="btn btn-primary"><i class="bi bi-check-lg"></i> Save changes</button></div>
        </div>
    </div>
</div>
</div>
@endsection
