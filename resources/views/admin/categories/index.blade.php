@extends('admin.layouts.app')
@section('title', 'Categories')

@section('content')

<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Categories</span></div>
<div class="page-head">
    <div>
        <h1>Categories</h1>
    </div>
    <div style="display:flex;gap:10px">
        <button type="button" class="btn btn-outline" onclick="document.getElementById('importModal').classList.add('open')"><i class="bi bi-upload"></i> Import</button>
        <a href="{{ route('admin.categories.export') }}" class="btn btn-outline"><i class="bi bi-download"></i> Export</a>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Category</a>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="grid">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Slug</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $c)
                <tr>
                    <td>
                        <div class="cell-main">
                            @if(!empty($c['image']))
                            <img src="{{ asset('uploads/categories/' . $c['image']) }}" alt="{{ $c['name'] }}" class="thumb" style="object-fit:cover">
                            @else
                            <div class="thumb" style="display:flex;align-items:center;justify-content:center;color:var(--ink-soft)"><i class="bi bi-image"></i></div>
                            @endif
                            <div class="cell-title">{{ $c['name'] }}</div>
                        </div>
                    </td>
                    <!-- <td class="cell-title">{{ $c['name'] }}</td> -->
                    <td class="cell-sub">/{{ $c['slug'] }}</td>
                    <td>{{ $c->products_count }}</td>
                    <td>
                        @if($c['is_active']=='1')<span class="pill pill-good">Active</span>
                        @elseif($c['is_active']=='0')<span class="pill pill-warn">Empty</span>
                        @else<span class="pill pill-warn">Needs review</span>@endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.categories.edit', $c) }}" class="btn btn-outline btn-icon btn-sm"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.categories.destroy', $c) }}" method="post">
                                @csrf
                                @method('delete')
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
            {{ $categories->firstItem() }}–{{ $categories->lastItem() }}
            of {{ $categories->total() }} products
        </div>
        <div class="pg-btns">

            {{-- Previous --}}
            @if($categories->onFirstPage())
            <a href="#">
                <i class="bi bi-chevron-left"></i>
            </a>
            @else
            <a href="{{ $categories->previousPageUrl() }}">
                <i class="bi bi-chevron-left"></i>
            </a>
            @endif


            {{-- Page Numbers --}}
            @for($page = 1; $page <= $categories->lastPage(); $page++)

                <a
                    href="{{ $categories->url($page) }}"
                    class="{{ $categories->currentPage() == $page ? 'active' : '' }}">
                    {{ $page }}
                </a>

                @endfor


                {{-- Next --}}
                @if($categories->hasMorePages())
                <a href="{{ $categories->nextPageUrl() }}">
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
        <form method="POST" action="{{ route('admin.categories.import') }}" enctype="multipart/form-data">
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