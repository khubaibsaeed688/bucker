@extends('admin.layouts.app')
@section('title', 'Edit Admin User')
@section('content')

<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><a href="{{ route('admin.users.index') }}">Admin Users</a><span class="sep">/</span><span class="cur">Edit User</span></div>
<div class="page-head"><div><h1>Edit admin user</h1></div></div>
@include('admin.users._form', ['user' => $user])
@endsection
