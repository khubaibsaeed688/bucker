@extends('admin.layouts.app')
@section('title', 'Edit Category')
@section('content')

<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.categories.index') }}">Categories</a><span class="sep">/</span><span class="cur">Edit Category</span></div>
<div class="page-head"><div><h1>Edit category</h1></div></div>
@include('admin.categories._form', ['category' => $category])
@endsection
