@php $p = $product ?? null; @endphp
<form method="POST" enctype="multipart/form-data" action="{{ $p ? route('admin.products.update', $p['id'] ?? 1) : route('admin.products.store') }}">
    @csrf
    @if($p) @method('PUT') @endif

    <div class="grid-2">
        <div>
            <div class="card">
                <div class="card-head">
                    <h3>Product information</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Product name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $p['name'] ?? '') }}" placeholder="e.g. Classic Leather Boot">
                        @error('name')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input id="slug" name="slug" type="text" readonly class="form-control" value="{{ old('slug', $p['slug'] ?? '') }}" placeholder="classic-leather-boot">
                        @error('slug')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="5" placeholder="Write a short product description…">{{ old('description', $p['description'] ?? '') }}</textarea>
                        @error('description')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>SKU</label>
                            <input name="sku" type="text" class="form-control" value="{{ old('sku', $p['sku'] ?? '') }}" placeholder="BK-1007">
                            @error('sku')
                            <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top:16px">
                <div class="card-head">
                    <h3>Product image</h3>
                </div>
                <div class="card-body">
                    @if($p && !empty($p['main_image']))
                    <div style="margin-bottom:12px">
                        <img src="{{ asset('uploads/products/' . $p['main_image']) }}" alt="{{ $p['name'] }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px">
                    </div>
                    @endif
                    <label class="upload-box" style="display:block;cursor:pointer">
                        <i class="bi bi-cloud-arrow-up"></i>
                        Drag & drop image here, or <strong style="color:var(--accent-ink)">browse</strong>
                        <div class="form-hint">PNG or JPG, up to 5MB</div>
                        <input type="file" name="main_image" accept="image/*" style="display:none">
                    </label>
                    @error('main_image')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="card-head">
                    <h3>Pricing &amp; stock</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Price ($)</label>
                        <input name="price" type="text" class="form-control" value="{{ old('price', $p['price'] ?? '') }}" placeholder="0.00">
                        @error('price')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Sale price <span class="opt">(optional)</span></label>
                        <input name="sale_price" type="text" class="form-control" value="{{ old('sale_price', $p['sale_price'] ?? '') }}" placeholder="0.00">
                        @error('sale_price')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Stock quantity</label>
                        <input name="stock" type="number" class="form-control" value="{{ old('stock', $p['stock'] ?? '') }}" placeholder="0">
                        @error('stock')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0">
                        <label style="margin:0">Featured product</label>
                        <label class="switch">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $p['is_featured'] ?? false) ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top:16px">
                <div class="card-head">
                    <h3>Status</h3>
                </div>
                <div class="card-body">
                    <div class="form-group" style="margin-bottom:0">
                        <label>Visibility</label>
                        <select name="is_active" class="form-control">
                            <option value="1" {{ old('is_active', $p['is_active'] ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active', $p['is_active'] ?? 1) == 0 ? 'selected' : '' }}>Hidden</option>
                        </select>
                        @error('is_active')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Cancel</a>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> {{ $p ? 'Save changes' : 'Publish product' }}</button>
    </div>
</form>


<!-- JS Script for Live Slug Preview -->
<script>
    document.getElementById('name').addEventListener('input', function() {
        const nameValue = this.value;
        const slugInput = document.getElementById('slug');

        slugInput.value = nameValue
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '') // Remove non-word chars
            .replace(/[\s_-]+/g, '-') // Replace spaces with -
            .replace(/^-+|-+$/g, ''); // Trim - from start and end
    });
</script>