@extends('admin.layouts.app')
@section('title', 'Add Banner')
@section('content')
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.banners.index') }}">Banners</a><span class="sep">/</span><span class="cur">Add Banner</span></div>
<div class="page-head"><div><h1>Add banner</h1></div></div>
@include('admin.banners._form', ['banner' => null])
@endsection
