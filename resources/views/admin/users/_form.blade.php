@php $u = $user ?? null; @endphp
<form method="POST" action="{{ $u ? route('admin.users.update', $u) : route('admin.users.store') }}">
    @csrf
    @if($u) @method('PUT') @endif
    <div class="card">
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Full name</label><input type="text" name="name" class="form-control" value="{{ $u['name'] ?? '' }}">
                    @error('name')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email address</label><input type="email" name="email" class="form-control" value="{{ $u['email'] ?? '' }}">
                    @error('email')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Role</label><select name="role" class="form-control">
                        <option value="super_admin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label><select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Suspended</option>
                    </select>
                </div>
                @unless($u)
                <div class="form-group">
                    <label>Password</label><input type="password" name="password" class="form-control" placeholder="••••••••">
                    @error('password')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirm password</label><input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
                    @error('password')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                @endunless
            </div>
        </div>
    </div>
    <div class="form-actions">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Cancel</a>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> {{ $u ? 'Save changes' : 'Add user' }}</button>
    </div>
</form>