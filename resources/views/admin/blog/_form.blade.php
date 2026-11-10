@php $p = $post ?? null; @endphp
<form method="POST" action="{{ $p ? route('admin.blog.update', 1) : route('admin.blog.store') }}">
    @csrf
    @if($p) @method('PUT') @endif
    <div class="grid-2">
        <div>
            <div class="card">
                <div class="card-head"><h3>Post content</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" value="{{ $p['title'] ?? '' }}" placeholder="Post title">
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <label>Content</label>
                        <textarea class="form-control" rows="10" placeholder="Write your post…"></textarea>
                    </div>
                </div>
            </div>
            <div class="card" style="margin-top:16px">
                <div class="card-head"><h3>Featured image</h3></div>
                <div class="card-body">
                    <div class="upload-box"><i class="bi bi-cloud-arrow-up"></i>Drag & drop an image, or <strong style="color:var(--accent-ink)">browse</strong></div>
                </div>
            </div>
        </div>
        <div>
            <div class="card">
                <div class="card-head"><h3>Publish</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control"><option>Published</option><option>Draft</option></select>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control"><option>Style Guides</option><option>Announcements</option><option>Sustainability</option><option>Guides</option></select>
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <label>Author</label>
                        <select class="form-control"><option>Sarah Ahmed</option><option>Marcus Lee</option><option>Priya Nair</option></select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <a href="{{ route('admin.blog.index') }}" class="btn btn-outline">Cancel</a>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> {{ $p ? 'Save changes' : 'Publish post' }}</button>
    </div>
</form>
