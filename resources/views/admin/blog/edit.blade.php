@extends('admin.layouts.app')
@section('title', 'Edit Post')
@section('content')
@php $post = ['title'=>'5 Ways to Style Chelsea Boots This Fall']; @endphp
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.blog.index') }}">Blog Posts</a><span class="sep">/</span><span class="cur">Edit Post</span></div>
<div class="page-head"><div><h1>Edit post</h1></div></div>
@include('admin.blog._form', ['post' => $post])
@endsection
