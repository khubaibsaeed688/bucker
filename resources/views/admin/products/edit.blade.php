@extends('admin.layouts.app')
@section('title', 'Edit Product')

@section('content')

<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.products.index') }}">Products</a><span class="sep">/</span><span class="cur">Edit Product</span></div>
<div class="page-head"><div><h1>Edit product</h1></div></div>

@include('admin.products._form', ['product' => $product])
@endsection
