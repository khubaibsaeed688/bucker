@extends('admin.layouts.app')
@section('title', 'Banners & Sliders')

@section('content')
@php
$banners = [
    ['name'=>'Homepage Hero Slide 1','position'=>'Homepage Slider','status'=>'good'],
    ['name'=>'Homepage Hero Slide 2','position'=>'Homepage Slider','status'=>'good'],
    ['name'=>'Winter Sale Banner','position'=>'Category Top','status'=>'warn'],
    ['name'=>'Footer Newsletter Banner','position'=>'Footer','status'=>'good'],
];
@endphp
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Banners &amp; Sliders</span></div>
<div class="page-head"><div><h1>Banners &amp; sliders</h1></div><a href="{{ route('admin.banners.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Banner</a></div>

<div class="card">
    <div class="table-wrap">
        <table class="grid">
            <thead><tr><th>Preview</th><th>Name</th><th>Placement</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @foreach($banners as $b)
                <tr>
                    <td><div class="thumb" style="width:56px;height:38px;display:flex;align-items:center;justify-content:center;color:var(--ink-soft)"><i class="bi bi-image"></i></div></td>
                    <td class="cell-title">{{ $b['name'] }}</td>
                    <td>{{ $b['position'] }}</td>
                    <td>@if($b['status']=='good')<span class="pill pill-good">Live</span>@else<span class="pill pill-warn">Scheduled</span>@endif</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.banners.edit', 1) }}" class="btn btn-outline btn-icon btn-sm"><i class="bi bi-pencil"></i></a>
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
