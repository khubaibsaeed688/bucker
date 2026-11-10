@extends('admin.layouts.app')
@section('title', 'Edit Banner')
@section('content')
@php $banner = ['name'=>'Homepage Hero Slide 1']; @endphp
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.banners.index') }}">Banners</a><span class="sep">/</span><span class="cur">Edit Banner</span></div>
<div class="page-head"><div><h1>Edit banner</h1></div></div>
@include('admin.banners._form', ['banner' => $banner])
@endsection
