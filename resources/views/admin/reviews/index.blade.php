@extends('admin.layouts.app')
@section('title', 'Reviews')

@section('content')
@php
$reviews = [
    ['product'=>'Classic Leather Boot','customer'=>'Amelia Hart','rating'=>5,'comment'=>'Extremely comfortable, true to size. Will buy again!','date'=>'Sep 25, 2026','status'=>'good'],
    ['product'=>'Trail Runner Pro','customer'=>'Chris Owens','rating'=>2,'comment'=>'Sole started peeling after two weeks of light use.','date'=>'Sep 24, 2026','status'=>'warn'],
    ['product'=>'Urban Canvas Sneaker','customer'=>'Zainab Noor','rating'=>4,'comment'=>'Great look, runs slightly narrow.','date'=>'Sep 22, 2026','status'=>'good'],
    ['product'=>'Suede Chelsea Boot','customer'=>'Farhan Malik','rating'=>1,'comment'=>'Item arrived damaged, requesting a refund.','date'=>'Sep 20, 2026','status'=>'bad'],
];
@endphp
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Reviews</span></div>
<div class="page-head"><div><h1>Reviews</h1></div></div>

<div class="filters-bar">
    <select class="form-control"><option>All ratings</option><option>5 stars</option><option>4 stars</option><option>3 stars</option><option>2 stars</option><option>1 star</option></select>
    <select class="form-control"><option>All statuses</option><option>Published</option><option>Pending</option><option>Flagged</option></select>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="grid">
            <thead><tr><th>Product</th><th>Customer</th><th>Rating</th><th>Comment</th><th>Date</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @foreach($reviews as $r)
                <tr>
                    <td class="cell-title">{{ $r['product'] }}</td>
                    <td>{{ $r['customer'] }}</td>
                    <td>
                        @for($i=0;$i<5;$i++)
                            <i class="bi bi-star{{ $i < $r['rating'] ? '-fill' : '' }}" style="color:{{ $i < $r['rating'] ? '#B9770E' : '#D9DCE4' }};font-size:12px"></i>
                        @endfor
                    </td>
                    <td class="cell-sub" style="max-width:260px">{{ $r['comment'] }}</td>
                    <td class="cell-sub">{{ $r['date'] }}</td>
                    <td>
                        @if($r['status']=='good')<span class="pill pill-good">Published</span>
                        @elseif($r['status']=='warn')<span class="pill pill-warn">Pending</span>
                        @else<span class="pill pill-bad">Flagged</span>@endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <button class="btn btn-outline btn-icon btn-sm"><i class="bi bi-check-lg"></i></button>
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
