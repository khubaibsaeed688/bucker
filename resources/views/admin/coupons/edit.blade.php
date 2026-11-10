@extends('admin.layouts.app')
@section('title', 'Edit Coupon')
@section('content')
@php $coupon = ['code'=>'WELCOME10']; @endphp
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.coupons.index') }}">Coupons</a><span class="sep">/</span><span class="cur">Edit Coupon</span></div>
<div class="page-head"><div><h1>Edit coupon</h1></div></div>
@include('admin.coupons._form', ['coupon' => $coupon])
@endsection
