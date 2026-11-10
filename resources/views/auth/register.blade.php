<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Create account · Bucker Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
<style>
    body{display:flex;align-items:center;justify-content:center;min-height:100vh;background:var(--sidebar)}
    .login-card{width:380px;background:var(--surface);border-radius:14px;padding:36px 32px;box-shadow:0 20px 60px rgba(0,0,0,.35)}
    .login-brand{display:flex;align-items:center;gap:10px;margin-bottom:26px}
    .login-brand .mark{width:36px;height:36px;border-radius:9px;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-family:"Sora",sans-serif;font-weight:700}
    .login-brand .name{font-family:"Sora",sans-serif;font-weight:700;font-size:16px}
</style>
</head>
<body>
<div class="login-card">
    <div class="login-brand">
        <div class="mark">B.</div>
        <div class="name">Bucker Admin</div>
    </div>
    <h2 style="font-size:19px;margin-bottom:2px">Create your account</h2>
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0 0 22px">Get started managing your store.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label>Full name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Sarah Ahmed" required>
            @error('name')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label>Email address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="you@bucker.com" required>
            @error('email')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            @error('password')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label>Confirm password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
        </div>
        <div style="margin-bottom:20px">
            <label class="checkbox-row" style="font-weight:400;font-size:13px;margin:0">
                <input type="checkbox" name="terms" required> I agree to the <a href="#" style="color:var(--accent-ink);font-weight:600">Terms</a> and <a href="#" style="color:var(--accent-ink);font-weight:600">Privacy Policy</a>
            </label>
            @error('terms')
            <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
        <button class="btn btn-primary" style="width:100%;justify-content:center" type="submit">Create account</button>
        <p style="text-align:center;font-size:13px;color:var(--ink-soft);margin-top:18px">
            Already have an account? <a href="{{ route('login') }}" style="color:var(--accent-ink);font-weight:600">Sign in</a>
        </p>
    </form>
</div>
</body>
</html>