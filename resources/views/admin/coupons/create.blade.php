@extends('admin.layouts.app')
@section('title', 'Add Coupon')
@section('content')
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.coupons.index') }}">Coupons</a><span class="sep">/</span><span class="cur">Add Coupon</span></div>
<div class="page-head"><div><h1>Add coupon</h1></div></div>
@include('admin.coupons._form', ['coupon' => null])
@endsection
