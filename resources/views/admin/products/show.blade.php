@extends('admin.layouts.app')
@section('title', 'Product Details')

@section('content')
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.products.index') }}">Products</a><span class="sep">/</span><span class="cur">{{$product->slug}}</span></div>
<div class="page-head">
    <div>
        <h1>{{$product->name}}</h1>
        @if($product->is_active)
        <span class="pill pill-good"><i class="bi bi-dot"></i>Active</span>
        @else
        <span class="pill pill-bad"><i class="bi bi-dot"></i>Hidden</span>
        @endif
    </div>
    <div style="display:flex;gap:10px">
        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
            @csrf @method('DELETE')
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline"><i class="bi bi-pencil"></i> Edit</a>
        <button class="btn btn-danger-outline"><i class="bi bi-trash"></i> Delete</button>
        </form>
    </div>
</div>

<div class="grid-2">
    <div class="card">
        <div class="card-head">
            <h3>Overview</h3>
        </div>
        <div class="card-body">
            <p style="color:var(--ink-soft)">{{ $product->description ?? 'No description added yet.' }}</p>
            <div class="form-grid" style="margin-top:14px">
                <div>
                    <div class="cell-sub">SKU</div>
                    <div class="cell-title">{{ $product->sku ?? '—' }}</div>
                </div>
                <div>
                    <div class="cell-sub">Category</div>
                    <div class="cell-title">{{ $product->category->name ?? '—' }}</div>
                </div>
                <div>
                    <div class="cell-sub">Price</div>
                    <div class="cell-title">${{ number_format($product->price, 2) }}</div>
                </div>
                <div>
                    <div class="cell-sub">Stock</div>
                    <div class="cell-title">{{ $product->stock }} units</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-head">
            <h3>Sales snapshot</h3>
        </div>
        <div class="card-body">
            <div class="stat-card" style="box-shadow:none;border:none;padding:0;margin-bottom:14px">
                <div class="label">Units sold (30d)</div>
                <div class="value">{{ $unitsSold ?? 0 }}</div>
            </div>
            <div class="stat-card" style="box-shadow:none;border:none;padding:0">
                <div class="label">Revenue (30d)</div>
                <div class="value">${{ number_format($revenue ?? 0, 2) }}</div>
            </div>
        </div>
    </div>
</div>
@endsection