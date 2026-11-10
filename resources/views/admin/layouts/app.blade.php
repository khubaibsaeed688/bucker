<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') · Bucker Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    @stack('styles')
</head>

<body>
    <div class="shell">

        @include('admin.partials.sidebar')

        <div class="main">
            @include('admin.partials.topbar')

            <div class="content">
                @if(session('success'))
                <div class="card" style="border-color:var(--good);background:var(--good-soft);padding:12px 18px;margin-bottom:18px;color:var(--good);font-weight:600;font-size:13.5px;">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                 <div class="card" style="border-color:var(--danger);background:var(--danger-soft);padding:12px 18px;margin-bottom:18px;color:var(--danger);font-weight:600;font-size:13.5px;"> 
                    <i class="bi bi-x-circle"></i> {{ session('error') }} 
                </div>
                @endif
                @if(session('warning'))
                <div class="card" style="border-color:var(--warning);background:var(--warning-soft);padding:12px 18px;margin-bottom:18px;color:var(--warning);font-weight:600;font-size:13.5px;"> 
                    <i class="bi bi-exclamation-triangle"></i> {{ session('warning') }} 
                </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        document.querySelector('.menu-toggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('open');
        });
        document.querySelectorAll('.tabs').forEach(function(tabs) {
            tabs.querySelectorAll('.tab-link').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var target = btn.dataset.tab;
                    var scope = tabs.closest('.tab-scope') || document;
                    scope.querySelectorAll('.tab-link').forEach(b => b.classList.remove('active'));
                    scope.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
                    btn.classList.add('active');
                    scope.querySelector('#' + target).classList.add('active');
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>