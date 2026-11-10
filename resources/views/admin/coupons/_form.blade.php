@php $c = $coupon ?? null; @endphp
<form method="POST" action="{{ $c ? route('admin.coupons.update', 1) : route('admin.coupons.store') }}">
    @csrf
    @if($c) @method('PUT') @endif
    <div class="card">
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Coupon code</label>
                    <input type="text" class="form-control" value="{{ $c['code'] ?? '' }}" placeholder="e.g. SUMMER20" style="text-transform:uppercase">
                </div>
                <div class="form-group">
                    <label>Discount type</label>
                    <select class="form-control"><option>Percentage</option><option>Fixed amount</option><option>Free shipping</option></select>
                </div>
                <div class="form-group">
                    <label>Discount value</label>
                    <input type="text" class="form-control" placeholder="e.g. 20">
                </div>
                <div class="form-group">
                    <label>Usage limit</label>
                    <input type="text" class="form-control" placeholder="e.g. 500">
                </div>
                <div class="form-group">
                    <label>Start date</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group">
                    <label>Expiry date</label>
                    <input type="date" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline">Cancel</a>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> {{ $c ? 'Save changes' : 'Create coupon' }}</button>
    </div>
</form>
