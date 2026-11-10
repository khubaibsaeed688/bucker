@extends('admin.layouts.app')
@section('title', 'blog Posts')

@section('content')
@php
$posts = [
    ['title'=>'5 Ways to Style Chelsea Boots This Fall','cat'=>'Style Guides','author'=>'Sarah Ahmed','date'=>'Sep 20, 2026','status'=>'good'],
    ['title'=>'Behind the Leather: Our Sourcing Process','cat'=>'Sustainability','author'=>'Marcus Lee','date'=>'Sep 12, 2026','status'=>'good'],
    ['title'=>'New Arrivals: The Winter 2026 Collection','cat'=>'Announcements','author'=>'Sarah Ahmed','date'=>'Sep 05, 2026','status'=>'warn'],
    ['title'=>'Sneaker Care 101: Keep Them Fresh','cat'=>'Guides','author'=>'Priya Nair','date'=>'Aug 28, 2026','status'=>'good'],
];
@endphp
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Blog Posts</span></div>
<div class="page-head"><div><h1>Blog posts</h1></div><a href="{{ route('admin.blog.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> New Post</a></div>

<div class="card">
    <div class="table-wrap">
        <table class="grid">
            <thead><tr><th>Title</th><th>Category</th><th>Author</th><th>Date</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @foreach($posts as $p)
                <tr>
                    <td class="cell-title">{{ $p['title'] }}</td>
                    <td>{{ $p['cat'] }}</td>
                    <td>{{ $p['author'] }}</td>
                    <td class="cell-sub">{{ $p['date'] }}</td>
                    <td>@if($p['status']=='good')<span class="pill pill-good">Published</span>@else<span class="pill pill-warn">Draft</span>@endif</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.blog.edit', 1) }}" class="btn btn-outline btn-icon btn-sm"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-danger-outline btn-icon btn-sm"><i class="bi bi-trash"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
