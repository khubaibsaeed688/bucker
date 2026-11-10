@extends('admin.layouts.app')
@section('title', 'products')

@section('content')


<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Products</span></div>
<div class="page-head">
    <div>
        <h1>Products</h1>
    </div>
    <div style="display:flex;gap:10px">
        <button type="button" class="btn btn-outline" onclick="document.getElementById('importModal').classList.add('open')"><i class="bi bi-upload"></i> Import</button>
        <a href="{{ route('admin.products.export') }}" class="btn btn-outline"><i class="bi bi-download"></i> Export</a>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Product</a>
    </div>
</div>

<div class="card">
    <div class="card-body" style="padding-bottom:0">
        <div class="filters-bar">
            <!-- <div class="search"><i class="bi bi-search"></i><input class="form-control" placeholder="Search products…"></div> -->
            <form method="GET" action="{{ route('admin.products.index') }}">
                <div class="search">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search products…">
                </div>
            </form>
            <select class="form-control">
                <option>All categories</option>
                <option>Boots</option>
                <option>Sneakers</option>
                <option>Casual</option>
                <option>Formal</option>
            </select>
            <select class="form-control">
                <option>All stock levels</option>
                <option>In stock</option>
                <option>Low stock</option>
                <option>Out of stock</option>
            </select>
        </div>
    </div>
    <div class="table-wrap">
        <table class="grid">
            <thead>
                <tr>
                    <th style="width:36px"><input type="checkbox"></th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="cell-main">
                            @if(!empty($p['main_image']))
                            <img src="{{ asset('uploads/products/' . $p['main_image']) }}" alt="{{ $p['name'] }}" class="thumb" style="object-fit:cover">
                            @else
                            <div class="thumb" style="display:flex;align-items:center;justify-content:center;color:var(--ink-soft)"><i class="bi bi-image"></i></div>
                            @endif
                            <div class="cell-title">{{ $p['name'] }}</div>
                        </div>
                    </td>
                    <td class="cell-sub">{{ $p['sku'] }}</td>
                    <td>{{ $p->category->name }}</td>
                    <td>{{ $p['price'] }}</td>
                    <td>{{ $p['stock'] }}</td>
                    <td>
                        @if($p['is_active']=='1')<span class="pill pill-good">Active</span>
                        @elseif($p['is_active']=='warn')<span class="pill pill-warn">Low stock</span>
                        @else<span class="pill pill-bad">Out of stock</span>@endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.products.show', $p) }}" class="btn btn-outline btn-icon btn-sm"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-outline btn-icon btn-sm"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.products.destroy', $p) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger-outline btn-icon btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-bar">

        <div>
            Showing
            {{ $products->firstItem() }}–{{ $products->lastItem() }}
            of {{ $products->total() }} products
        </div>

        <div class="pg-btns">

            {{-- Previous --}}
            @if($products->onFirstPage())
            <a href="#">
                <i class="bi bi-chevron-left"></i>
            </a>
            @else
            <a href="{{ $products->previousPageUrl() }}">
                <i class="bi bi-chevron-left"></i>
            </a>
            @endif


            {{-- Page Numbers --}}
            @for($page = 1; $page <= $products->lastPage(); $page++)

                <a
                    href="{{ $products->url($page) }}"
                    class="{{ $products->currentPage() == $page ? 'active' : '' }}">
                    {{ $page }}
                </a>

                @endfor


                {{-- Next --}}
                @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}">
                    <i class="bi bi-chevron-right"></i>
                </a>
                @else
                <a href="#">
                    <i class="bi bi-chevron-right"></i>
                </a>
                @endif

        </div>

    </div>
</div>


<div id="importModal" class="modal-overlay {{ $errors->has('file') ? 'open' : '' }}">
    <div class="card modal-box">
        <div class="card-head">
            <h3>Import products</h3>
            <button type="button" class="btn btn-outline btn-icon btn-sm" onclick="document.getElementById('importModal').classList.remove('open')"><i class="bi bi-x-lg"></i></button>
        </div>
        <form method="POST" action="{{ route('admin.products.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0">
                    <label>CSV file</label>
                    <input type="file" name="file" class="form-control" accept=".csv,.txt">
                    <div class="form-hint">First row must be the header: category_id, name, slug, description, price, sale_price, stock, sku, is_featured, is_active</div>
                    @error('file')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-actions" style="padding:16px 20px;margin-top:0">
                <button type="button" class="btn btn-outline" onclick="document.getElementById('importModal').classList.remove('open')">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Import</button>
            </div>
        </form>
    </div>
</div>


@endsection