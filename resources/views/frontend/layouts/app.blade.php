<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('frontend.partials.head')

<body>

    @include('frontend.partials.offcanvas-menu')

    @include('frontend.partials.header')

    @include('frontend.partials.mini-cart')

    @include('frontend.partials.search-box')

    @yield('content')

    @include('frontend.partials.footer')

    @yield('modals')

    @include('frontend.partials.scripts')

</body>

</html>
