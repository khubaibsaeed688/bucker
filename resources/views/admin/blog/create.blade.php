@extends('admin.layouts.app')
@section('title', 'New Post')
@section('content')
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.blog.index') }}">Blog Posts</a><span class="sep">/</span><span class="cur">New Post</span></div>
<div class="page-head"><div><h1>New post</h1></div></div>
@include('admin.blog._form', ['post' => null])
@endsection
