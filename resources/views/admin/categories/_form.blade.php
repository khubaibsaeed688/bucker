@php $c = $category ?? null; @endphp
<form method="POST" enctype="multipart/form-data" action="{{ $c ? route('admin.categories.update', $c) : route('admin.categories.store') }}">
    @csrf
    @if($c) @method('PUT') @endif
    <div class="card">
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Category name</label>
                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $c['name'] ?? '') }}" placeholder="e.g. Sandals">
                    @error('name')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input id="slug" name="slug" type="text" readonly class="form-control" value="{{ old('slug', $c['slug'] ?? '') }}" placeholder="sandals">
                    @error('slug')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ old('is_active', $c['is_active'] ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active', $c['is_active'] ?? 1) == 0 ? 'selected' : '' }}>Hidden</option>
                    </select>
                    @error('is_active')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Image <span class="opt">(optional)</span></label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if(!empty($c['image']))
                    <p class="mt-1 text-sm">Current: {{ $c['image'] }}</p>
                    @endif
                    @error('image')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group full">
                    <label>Description <span class="opt">(optional)</span></label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Short category description…">{{ old('description', $c['description'] ?? '') }}</textarea>
                    @error('description')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Cancel</a>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> {{ $c ? 'Save changes' : 'Add category' }}</button>
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