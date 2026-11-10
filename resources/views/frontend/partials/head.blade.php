<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description"
        content="240+ Best Bootstrap Templates are available on this website. Find your template for your project compatible with the most popular HTML library in the world." />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('og_title', config('app.name'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="@yield('og_title', config('app.name'))" />
    <!-- For the og:image content, replace the # with a link of an image -->
    <meta property="og:image" content="{{ asset('assets/img/logo/logo.png') }}" />
    <meta property="og:description" content="@yield('og_title', config('app.name'))" />

    <!-- Add site Favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon/cropped-favicon-32x32.webp') }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('assets/img/favicon/cropped-favicon-192x192.png') }}"
        sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon/cropped-favicon-180x180.png') }}" />
    <meta name="msapplication-TileImage"
        content="{{ asset('assets/img/favicon/cropped-favicon-270x270.png') }}" />

    <!-- CSS 
    ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pe-icon-7-stroke.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')

    <!--modernizr min js here-->
    <script src="{{ asset('assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>


    <!-- Structured Data  -->
    <script type="application/ld+json">
        {
        "@@context": "https://schema.org",
        "@@type": "WebSite",
        "name": "{{ config('app.name') }}",
        "url": "{{ url('/') }}"
        }
    </script>
</head>
