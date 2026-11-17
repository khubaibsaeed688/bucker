@php
    // Highlights the current section in the desktop menu (same rules the original template used).
    $active = fn ($patterns) => request()->routeIs(...(array) $patterns) ? ' class="active"' : '';
@endphp

<!--header area start-->
    <header class="header_section">
        <div class="header_top">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header_top_inner d-flex justify-content-between">
                            <div class="welcome_text">
                                <p>World Wide Completely Free Returns and Free Shipping</p>
                            </div>
                            <div class="header_top_sidebar d-flex align-items-center">
                                <ul class="d-flex">
                                    <li><i class="icofont-phone"></i> <a href="tel:+00123456789">+00 123 456 789</a>
                                    </li>
                                    <li><i class="icofont-envelope"></i> <a
                                            href="mailto:demo@example.com">demo@example.com</a></li>
                                    <li class="account_link"> <i class="icofont-user-alt-7"></i><a href="#">Account</a>
                                        <ul class="dropdown_account_link">
                                            <li><a href="{{ route('account.dashboard') }}">My Account</a></li>
                                            <!-- <li><a href="{{ route('account.login-register') }}">Login</a></li> -->
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                            <li><a href="{{ route('contact') }}">Contact</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main_header d-flex justify-content-between align-items-center">
                        <div class="header_logo">
                            <a class="sticky_none" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo/logo.png') }}" alt=""></a>
                        </div>
                        <!--main menu start-->
                        <div class="main_menu d-none d-lg-block">
                            <nav>
                                <ul class="d-flex">
                                    <li><a{!! $active('home*') !!} href="{{ route('home') }}">Home</a>
                                        <ul class="bucker-dropdown">
                                            <li><a href="{{ route('home') }}">Home 01</a></li>
                                            <li><a href="{{ route('home.two') }}">Home 02</a></li>
                                        </ul>
                                    </li>
                                    <li><a{!! $active('about') !!} href="{{ route('about') }}">About</a></li>
                                    <li><a{!! $active(['faq', 'not-found']) !!} href="{{route('faq')}}">Pages</a>
                                        <ul class="bucker-dropdown">
                                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                                            <li><a href="{{ route('not-found') }}">Error 404</a></li>
                                        </ul>
                                    </li>
                                    <li class="megamenu-holder">
                                        <a{!! $active(['shop.*', 'product.*', 'cart', 'checkout', 'compare', 'wishlist', 'account.*']) !!} href="{{ route('shop.left-sidebar') }}">Shop</a>
                                        <ul class="megamenu grid-container">
                                            <li class="grid-item">
                                                <span class="title">Shop Layout</span>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('shop.fullwidth') }}">Shop Fullwidth</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('shop.left-sidebar') }}">Shop Left Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('shop.right-sidebar') }}">Shop Right Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('shop.list-fullwidth') }}">Shop List Fullwidth</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('shop.list-left-sidebar') }}">Shop List Left Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('shop.list-right-sidebar') }}">Shop List Right
                                                            Sidebar</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="grid-item">
                                                <span class="title">Product Style</span>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('product.single', ['slug' => 'octavia-garrett']) }}">Single Product Default</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('product.group') }}">Single Product Group</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('product.variable') }}">Single Product
                                                            Variable</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('product.sale') }}">Single Product Sale</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('product.sticky') }}">Single Product Sticky</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('product.affiliate') }}">Single Product
                                                            Affiliate</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="grid-item">
                                                <span class="title">Popular Products</span>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('shop.left-sidebar') }}">Classic Carrot Cake</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('shop.left-sidebar') }}">Gingerbread Cake</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('shop.left-sidebar') }}">Yellow Cupcakes</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('shop.left-sidebar') }}">Hawaiian Cake Roll</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('shop.left-sidebar') }}">Banana Snack Cake</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('shop.left-sidebar') }}">Chocolate Cake</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="grid-item">
                                                <span class="title">Product Related</span>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('account.dashboard') }}">My Account</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('account.login-register') }}">Login | Register</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('cart') }}">Shopping Cart</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('wishlist') }}">Wishlist</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('compare') }}">Compare</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('checkout') }}">Checkout</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a{!! $active('blog.*') !!} href="{{ route('blog.left-sidebar') }}">blog</a>
                                        <ul class="bucker-dropdown">
                                            <li class="submenu-holder"><a href="#">Blog Holder</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('blog.left-sidebar') }}">Blog Left Sidebar</a></li>
                                                    <li><a href="{{ route('blog.right-sidebar') }}">Blog Right Sidebar</a></li>
                                                    <li><a href="{{ route('blog.fullwidth') }}">Blog Fullwidth</a></li>
                                                    <li><a href="{{ route('blog.list-left-sidebar') }}">Blog List Left Sidebar</a>
                                                    </li>
                                                    <li><a href="{{ route('blog.list-right-sidebar') }}">Blog List Right
                                                            Sidebar</a>
                                                    </li>
                                                    <li><a href="{{ route('blog.list-fullwidth') }}">Blog List Fullwidth</a></li>
                                                </ul>
                                            </li>
                                            <li class="submenu-holder"><a href="#">Blog Details Holder</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('blog.detail.fullwidth') }}">Blog Detail Fullwidth</a>
                                                    </li>
                                                    <li><a href="{{ route('blog.detail.left-sidebar') }}">Blog Detail Left
                                                            Sidebar</a></li>
                                                    <li><a href="{{ route('blog.detail.right-sidebar') }}">Blog Detail Right
                                                            Sidebar</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a{!! $active('contact') !!} href="{{ route('contact') }}">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!--main menu end-->
                        <div class="header_account">
                            <ul class="d-flex">
                                <li class="header_search"><a href="javascript:void(0)"><i class="pe-7s-search"></i></a>
                                </li>
                                <li class="header_wishlist"><a href="{{ route('wishlist') }}"><i class="pe-7s-like"></i></a></li>
                                <li class="shopping_cart"><a href="javascript:void(0)"><i class="pe-7s-shopbag"></i></a>
                                    <span class="item_count">2</span>
                                </li>
                            </ul>
                            <div class="canvas_open">
                                <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
