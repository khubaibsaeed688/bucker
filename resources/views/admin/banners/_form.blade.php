@php $b = $banner ?? null; @endphp
<form method="POST" action="{{ $b ? route('admin.banners.update', 1) : route('admin.banners.store') }}">
    @csrf
    @if($b) @method('PUT') @endif
    <div class="grid-2">
        <div class="card">
            <div class="card-head"><h3>Banner image</h3></div>
            <div class="card-body">
                <div class="upload-box"><i class="bi bi-cloud-arrow-up"></i>Drag & drop image, or <strong style="color:var(--accent-ink)">browse</strong><div class="form-hint">Recommended: 1600×600px</div></div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group"><label>Banner name</label><input type="text" class="form-control" value="{{ $b['name'] ?? '' }}" placeholder="e.g. Winter Sale Banner"></div>
                <div class="form-group"><label>Placement</label><select class="form-control"><option>Homepage Slider</option><option>Category Top</option><option>Footer</option></select></div>
                <div class="form-group"><label>Link URL <span class="opt">(optional)</span></label><input type="text" class="form-control" placeholder="/shop/sale"></div>
                <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0">
                    <label style="margin:0">Live now</label>
                    <label class="switch"><input type="checkbox" checked><span class="slider"></span></label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <a href="{{ route('admin.banners.index') }}" class="btn btn-outline">Cancel</a>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> {{ $b ? 'Save changes' : 'Add banner' }}</button>
    </div>
</form>
