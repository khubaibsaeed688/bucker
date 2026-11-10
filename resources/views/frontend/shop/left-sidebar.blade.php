@extends('frontend.layouts.app')

@section('title', 'Bucker – Shop Left Sidebar')
@section('og_title', 'Bucker – Products page')

@section('content')
<!-- breadcrumbs area start -->
<div class="breadcrumbs_aree breadcrumbs_bg mb-100" data-bgimg="{{ asset('assets/img/others/breadcrumbs-bg.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs_text">
                    <h1>Products</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home </a></li>
                        <li> // Shop Left Sidebar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs area end -->

<!-- product page section start -->
<div class="product_page_section mb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-2 order-lg-1">
                <div class="product_sidebar product_widget">
                    <div class="widget__list widget_filter wow fadeInUp" data-wow-delay="0.1s"
                        data-wow-duration="1.1s">
                        <h3>Filter</h3>
                        <div class="widget_filter_list mb-30">
                            <h4>Filter By Size</h4>
                            <ul>
                                <li><a href="#">All (65)</a></li>
                                <li><a href="#">Small (15)</a></li>
                                <li><a href="#">Medium (10)</a></li>
                                <li><a href="#">Lerge (22)</a></li>
                            </ul>
                        </div>
                        <div class="widget_filter_list">
                            <h4>Filter By Price</h4>

                            <div id="slider-range"></div>
                            <div class="filter_price d-flex align-items-center">
                                <span>Price: </span>
                                <input type="text" id="amount">
                            </div>

                        </div>
                    </div>
                    <div class="widget__list category wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1.2s">
                        <h3>category</h3>
                        <div class="widget_category">
                            <ul>
                                <li><a href="#">All <span>(65)</span></a></li>
                                <li><a href="#">Cookies <span>(15)</span></a></li>
                                <li><a href="#">Desserts <span>(10)</span></a></li>
                                <li><a href="#">Muffins <span>(22)</span></a></li>
                                <li><a href="#">Pizza <span>(15)</span></a></li>
                                <li><a href="#">Doughnuts <span>(10)</span></a></li>
                                <li><a href="#">Danish <span>(24)</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget__list wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1.3s">
                        <div class="widget_banner">
                            <img src="{{ asset('assets/img/others/product-sidaber-banner.png') }}" alt="">
                        </div>
                    </div>
                    <div class="widget__list tags wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1.4s">
                        <h3>Tags</h3>
                        <div class="widget_tags">
                            <ul>
                                <li><a href="#">Cookies</a></li>
                                <li><a href="#">Doughnuts</a></li>
                                <li><a href="#">Desserts</a></li>
                                <li><a href="#">Muffins</a></li>
                                <li><a href="#">Doughnuts</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product_page_wrapper">
                    <!--shop toolbar area start-->
                    <div class="product_sidebar_header mb-60 d-flex justify-content-between align-items-center">
                        <div class="page__amount border">
                            <p>
                                <span>{{ $products->count() }}</span>
                                Product Found of
                                <span>{{ $totalProducts }}</span>
                            </p>
                        </div>
                        <div class="product_header_right d-flex align-items-center">
                            <div class="sorting__by d-flex align-items-center">
                                <span>Sort By : </span>
                                <form class="select_option" action="#">
                                    <select name="orderby" id="short">
                                        <option selected value="1">Default</option>
                                        <option value="2">Sort by popularity</option>
                                        <option value="3">Sort by newness</option>
                                        <option value="4"> low to high</option>
                                        <option value="5"> high to low</option>
                                        <option value="6">Product Name: Z</option>
                                    </select>
                                </form>
                            </div>
                            <div class="product__toolbar__btn">
                                <ul class="nav" role="tablist">
                                    <li class="nav-item">
                                        <a class="active" data-bs-toggle="tab" href="#grid" role="tab"
                                            aria-controls="grid" aria-selected="true"><i class="ion-grid"></i></a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="tab" href="#list" aria-controls="list" role="tab"
                                            aria-selected="false"><i class="ion-ios-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--shop toolbar area end-->


                    <!--shop gallery start-->
                    <div class="product_page_gallery">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="grid">
                                <div class="row grid__product">
                                    @foreach($products as $product)
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <article class="single_product wow fadeInUp" data-wow-delay="0.2s"
                                            data-wow-duration="1.2s">
                                            <figure>
                                                <div class="product_thumb">
                                                    <a href="{{ route('product.single', ['slug' => $product->slug]) }}"><img style="width: 100%; height: 250px; object-fit: contain; padding-bottom: 50px; display: block;"
                                                            src="{{ $product->main_image
                                                                        ? asset('uploads/products/' . $product->main_image)
                                                                        : asset('assets/img/product/product1.png') }}"
                                                            alt="{{ $product->name }}"></a>
                                                    <div class="action_links">
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="add_to_cart">
                                                                <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                                                    @csrf

                                                                    <a href="javascript:void(0);"
                                                                        onclick="this.closest('form').submit();"
                                                                        title="Add to cart">
                                                                        <span class="pe-7s-shopbag"></span>
                                                                    </a>
                                                                </form>
                                                            </li>
                                                            <li class="wishlist">
                                                                <form action="{{ route('wishlist.store', $product->id) }}"
                                                                    method="POST"
                                                                    style="display: contents;">
                                                                    @csrf

                                                                    <a href="javascript:void(0);"
                                                                        onclick="this.closest('form').submit();"
                                                                        title="Add to Wishlist">

                                                                        <span class="pe-7s-like"></span>

                                                                    </a>
                                                                </form>
                                                            </li>
                                                            <li class="quick_button"><a href="#" title="Quick View"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal_box"> <span
                                                                        class="pe-7s-look"></span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <figcaption class="product_content text-center">
                                                    <h4><a href="{{ route('product.single', ['slug' => $product->slug]) }}">{{$product->name}}</a></h4>
                                                    <div class="price_box">
                                                        <span class="current_price">Rs.{{$product->price}}</span>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </article>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="tab-pane fade" id="list">
                                <div class="list__product">
                                    @foreach($products as $product)
                                    <article class="product_list_items border-bottom">
                                        <figure class="product_list_flex d-flex align-items-center">
                                            <div class="product_thumb">
                                                <a href="{{ route('product.single', ['slug' => $product->slug]) }}">
                                                    <img style="width: 100%; height: 250px; object-fit: cover; object-position: center; padding: 20px; padding-bottom: 50px; display: block;"
                                                        src="{{ $product->main_image
                                                                        ? asset('uploads/products/' . $product->main_image)
                                                                        : asset('assets/img/product/product1.png') }}"
                                                        alt="{{ $product->name }}">
                                                </a>
                                                <div class="action_links">
                                                    <ul class="d-flex justify-content-center">
                                                        <li class="add_to_cart">
                                                            <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                                                @csrf

                                                                <a href="javascript:void(0);"
                                                                    onclick="this.closest('form').submit();"
                                                                    title="Add to cart">
                                                                    <span class="pe-7s-shopbag"></span>
                                                                </a>
                                                            </form>
                                                        </li>
                                                        <li class="wishlist">
                                                            <form action="{{ route('wishlist.store', $product->id) }}"
                                                                method="POST"
                                                                style="display: contents;">
                                                                @csrf

                                                                <a href="javascript:void(0);"
                                                                    onclick="this.closest('form').submit();"
                                                                    title="Add to Wishlist">

                                                                    <span class="pe-7s-like"></span>

                                                                </a>
                                                            </form>
                                                        </li>
                                                        <li class="quick_button"><a href="#" title="Quick View"
                                                                data-bs-toggle="modal" data-bs-target="#modal_box">
                                                                <span class="pe-7s-look"></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <figcaption class="product_list_content">
                                                <h4><a href="{{ route('product.single', ['slug' => $product->slug]) }}">{{$product->name}}</a></h4>
                                                <div class="product__ratting">
                                                    <ul class="d-flex">
                                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                        <li><a href="#"><i class="ion-android-star-outline"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="price_box">
                                                    <span class="current_price">${{$product->price}}</span>
                                                </div>
                                                <div class="product__desc">
                                                    <p>{{$product->description}}</p>
                                                </div>
                                                <div class="action_links product_list_action">
                                                    <ul class="d-flex">
                                                        <li class="add_to_cart">
                                                            <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                                                @csrf

                                                                <a href="javascript:void(0);"
                                                                    onclick="this.closest('form').submit();"
                                                                    title="Add to cart">
                                                                    <span class="pe-7s-shopbag"></span>
                                                                </a>
                                                            </form>
                                                        </li>
                                                        <li class="wishlist">
                                                            <form action="{{ route('wishlist.store', $product->id) }}"
                                                                method="POST"
                                                                style="display: contents;">
                                                                @csrf

                                                                <a href="javascript:void(0);"
                                                                    onclick="this.closest('form').submit();"
                                                                    title="Add to Wishlist">

                                                                    <span class="pe-7s-like"></span>

                                                                </a>
                                                            </form>
                                                        </li>
                                                        <li class="quick_button"><a href="#" title="Quick View"
                                                                data-bs-toggle="modal" data-bs-target="#modal_box">
                                                                <span class="pe-7s-look"></span></a></li>
                                                    </ul>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </article>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    @if($products->hasPages())
                    <div class="pagination poduct_pagination">
                        <ul>
                            @if($products->onFirstPage())
                            <li class="disabled" style="display: none; pointer-events: none;"><span aria-label="Previous"><i class="ion-chevron-left"></i></span></li>
                            @else
                            <li><a href="{{ $products->previousPageUrl() }}" aria-label="Previous"><i class="ion-chevron-left"></i></a></li>
                            @endif

                            @foreach($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                            @if($page == $products->currentPage())
                            <li class="current"><span>{{ $page }}</span></li>
                            @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                            @endforeach

                            @if($products->hasMorePages())
                            <li class="next"><a href="{{ $products->nextPageUrl() }}" aria-label="Next"><i class="ion-chevron-right"></i></a></li>
                            @else
                            <li style="display: none; pointer-events: none;"><span><i class="ion-chevron-right"></i></span></li>
                            @endif
                        </ul>
                    </div>
                    @endif
                    <!--shop gallery end-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product page section end -->
@endsection

@section('modals')
@include('frontend.partials.quick-view-modal')
@endsection