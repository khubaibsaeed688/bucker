@extends('admin.layouts.app')
@section('title', 'Coupons')

@section('content')
@php
$coupons = [
    ['code'=>'WELCOME10','type'=>'Percentage','value'=>'10%','uses'=>'214 / 1000','expires'=>'Dec 31, 2026','status'=>'good'],
    ['code'=>'FREESHIP','type'=>'Free shipping','value'=>'—','uses'=>'89 / 500','expires'=>'Nov 15, 2026','status'=>'good'],
    ['code'=>'SALE25','type'=>'Percentage','value'=>'25%','uses'=>'500 / 500','expires'=>'Oct 01, 2026','status'=>'neutral'],
    ['code'=>'FLASH5','type'=>'Fixed amount','value'=>'$5.00','uses'=>'12 / 200','expires'=>'Sep 30, 2026','status'=>'warn'],
];
@endphp
<div class="breadcrumbs"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="sep">/</span><span class="cur">Coupons</span></div>
<div class="page-head"><div><h1>Coupons</h1></div><a href="{{ route('admin.coupons.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Coupon</a></div>

<div class="card">
    <div class="table-wrap">
        <table class="grid">
            <thead><tr><th>Code</th><th>Type</th><th>Value</th><th>Uses</th><th>Expires</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @foreach($coupons as $c)
                <tr>
                    <td class="cell-title">{{ $c['code'] }}</td>
                    <td>{{ $c['type'] }}</td>
                    <td>{{ $c['value'] }}</td>
                    <td class="cell-sub">{{ $c['uses'] }}</td>
                    <td class="cell-sub">{{ $c['expires'] }}</td>
                    <td>
                        @if($c['status']=='good')<span class="pill pill-good">Active</span>
                        @elseif($c['status']=='warn')<span class="pill pill-warn">Expiring soon</span>
                        @else<span class="pill pill-neutral">Limit reached</span>@endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.coupons.edit', 1) }}" class="btn btn-outline btn-icon btn-sm"><i class="bi bi-pencil"></i></a>
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
