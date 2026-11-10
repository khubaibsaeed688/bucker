<!--offcanvas menu area start-->
    <div class="body_overlay">

    </div>
    <div class="offcanvas_menu">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="offcanvas_menu_wrapper">
                        <div class="canvas_close">
                            <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                        </div>
                        <div class="welcome_text text-center">
                            <p>Welcome to Bucker Bakery Shop</p>
                        </div>
                        <div id="menu" class="text-left ">
                            <ul class="offcanvas_main_menu">
                                <li class="menu-item-has-children active">
                                    <a href="#">Home</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('home') }}">Home 01</a></li>
                                        <li><a href="{{ route('home.two') }}">Home 02</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li class="menu-item-has-children"><a href="#">Pages</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                                        <li><a href="{{ route('not-found') }}">Error 404</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="#">Shop</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item-has-children"><a href="#">Shop Layout</a>
                                            <ul class="sub-menu">
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
                                        <li class="menu-item-has-children"><a href="#">Product Style</a>
                                            <ul class="sub-menu">
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
                                        <li class="menu-item-has-children"><a href="#">Popular Products</a>
                                            <ul class="sub-menu">
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
                                        <li class="menu-item-has-children"><a href="#">Product Related</a>
                                            <ul class="sub-menu">
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
                                <li class="menu-item-has-children"><a href="{{ route('blog.fullwidth') }}">blog</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item-has-children"><a href="#">Blog Holder</a>
                                            <ul class="sub-menu">
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
                                        <li class="menu-item-has-children"><a href="#">Blog Details Holder</a>
                                            <ul class="sub-menu">
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
                                <li class="menu-item-has-children"><a href="{{ route('contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--offcanvas menu area end-->
