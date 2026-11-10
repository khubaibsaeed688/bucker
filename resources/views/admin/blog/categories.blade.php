@extends('admin.layouts.app')
@section('title', 'Blog Categories')

@section('content')
@php
$cats = [
    ['name'=>'Style Guides','posts'=>12],
    ['name'=>'Announcements','posts'=>8],
    ['name'=>'Sustainability','posts'=>5],
    ['name'=>'Guides','posts'=>9],
];
@endphp
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Blog Categories</span></div>
<div class="page-head"><div><h1>Blog categories</h1></div></div>

<div class="grid-2">
    <div class="card">
        <div class="table-wrap">
            <table class="grid">
                <thead><tr><th>Category</th><th>Posts</th><th></th></tr></thead>
                <tbody>
                @foreach($cats as $c)
                    <tr>
                        <td class="cell-title">{{ $c['name'] }}</td>
                        <td>{{ $c['posts'] }}</td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <button class="btn btn-outline btn-icon btn-sm"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-danger-outline btn-icon btn-sm"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-head"><h3>Add category</h3></div>
        <div class="card-body">
            <div class="form-group"><label>Name</label><input type="text" class="form-control" placeholder="e.g. Interviews"></div>
            <button class="btn btn-primary" style="width:100%;justify-content:center"><i class="bi bi-plus-lg"></i> Add category</button>
        </div>
    </div>
</div>
@endsection
