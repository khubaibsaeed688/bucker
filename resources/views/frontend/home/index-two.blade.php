@extends('frontend.layouts.app')

@section('title', 'Bucker – Bakery Shop HTML Template')
@section('og_title', 'Bucker – Bakery Shop Bootstrap 5 Template')

@section('content')
<!--slide banner section start-->
<div class="hero_banner_section hero_banner2 d-flex align-items-center mb-60"
    data-bgimg="{{ asset('assets/img/bg/hero-bg2.png') }}">
    <div class="container">
        <div class="hero_banner_inner">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero_content hero_content2">
                        <h3 class="wow fadeInUp text-white" data-wow-delay="0.1s" data-wow-duration="1.1s"> Up To
                            Sale <span> 50% Off</span> </h3>
                        <h1 class="wow fadeInUp text-white" data-wow-delay="0.2s" data-wow-duration="1.2s">We Bake
                            With <br>
                            Pasion.</h1>
                        <a class="btn btn-link wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1.3s"
                            href="{{ route('shop.left-sidebar') }}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--slider area end-->

<!-- featured banner section start -->
<div class="featured_banner_section mb-100">
    <div class="container-fluid">
        <div class="row featured_banner_inner slick__activation" data-slick='{
                "slidesToShow": 3,
                "slidesToScroll": 1,
                "arrows": true,
                "dots": false,
                "autoplay": false,
                "speed": 300,
                "infinite": true,
                "responsive":[
                  {"breakpoint":768, "settings": { "slidesToShow": 2 } },
                  {"breakpoint":500, "settings": { "slidesToShow": 1 } }
                ]
            }'>

            @foreach($categorieses as $category)
            <div class="col-lg-4">
                <div class="single_featured_banner wow fadeInUp"
                    data-wow-delay="0.{{ ($loop->index % 3) + 1 }}s"
                    data-wow-duration="1.{{ ($loop->index % 3) + 1 }}s">

                    <div class="featured_banner_thumb">
                        <a href="{{ route('shop.left-sidebar') }}">
                            <img
                                style="width: 100%; height: 220px; object-fit: cover;"
                                src="{{ $category->image
                                        ? asset('uploads/categories/' . $category->image)
                                        : asset('assets/img/bg/featured-banner' . (($loop->index % 3) + 1) . '.png') }}"
                                alt="{{ $category->name }}">
                        </a>
                    </div>

                    <div class="featured_banner_text d-flex justify-content-between align-items-center">
                        <h3>
                            <a href="{{ route('shop.left-sidebar') }}">
                                {{ $category->name }}
                            </a>
                        </h3>

                        <span>({{ $category->products_count }})</span>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- featured banner section end -->

<!-- product section start -->
<div class="product_section mb-80 wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
    <div class="container">
        <div class="product_header">
            <div class="section_title text-center">
                <h2>New Products</h2>
            </div>
            <div class="product_tab_button">
                <ul class="nav justify-content-center" role="tablist" id="nav-tab">
                    <li>
                        <a class="active" data-toggle="tab" href="#features" role="tab" aria-controls="features"
                            aria-selected="false">Our Features </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#seller" role="tab" aria-controls="seller" aria-selected="false">
                            Best Sellers </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#sales" role="tab" aria-controls="sales"
                            aria-selected="false">New Items </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content product_container">
            <div class="tab-pane fade show active" id="features" role="tabpanel">
                <div class="product_gallery">
                    <div class="row">
                        @foreach($featuredProducts as $product)

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb" style="height: 300px;">
                                        <a href="{{ route('product.single', $product->slug) }}">
                                            <img
                                                class="w-100"
                                                style="height: 250px; object-fit: cover;"
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

                                                <li class="quick_button">
                                                    <a href="{{$product->slug}}" title="Quick View"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_box">
                                                        <span class="pe-7s-look"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <figcaption class="product_content text-center">
                                        <h4>
                                            <a href="{{ route('product.single', $product->slug) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h4>

                                        <div class="price_box">
                                            @if($product->sale_price)
                                            <span class="current_price">
                                                Rs. {{ number_format($product->sale_price, 2) }}
                                            </span>

                                            @else
                                            <span class="current_price">
                                                Rs. {{ number_format($product->price, 2) }}
                                            </span>
                                            @endif
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="seller" role="tabpanel">
                <div class="product_gallery">
                    <div class="row">

                        @foreach($bestSellerProducts as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb" style="height: 300px;">
                                        <a href="{{ route('product.single', $product->slug) }}">
                                            <img
                                                class="w-100"
                                                style="height: 250px; object-fit: cover;"
                                                src="{{ $product->main_image
                                                ? asset('uploads/products/' . $product->main_image)
                                                : asset('assets/img/product/product5.png') }}"
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

                                                <li class="quick_button">
                                                    <a href="#" title="Quick View"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_box">
                                                        <span class="pe-7s-look"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <figcaption class="product_content text-center">
                                        <h4>
                                            <a href="{{ route('product.single', $product->slug) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h4>

                                        <div class="price_box">
                                            @if($product->sale_price)
                                            <span class="current_price">
                                                Rs. {{ number_format($product->sale_price, 2) }}
                                            </span>

                                            @else
                                            <span class="current_price">
                                                Rs. {{ number_format($product->price, 2) }}
                                            </span>
                                            @endif
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                        @endforeach



                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="sales" role="tabpanel">
                <div class="product_gallery">
                    <div class="row">

                        @foreach($newProducts as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb" style="height: 300px;">
                                        <a href="{{ route('product.single', $product->slug) }}">
                                            <img
                                                class="w-100"
                                                style="height: 250px; object-fit: cover;"
                                                src="{{ $product->main_image
                                                ? asset('uploads/products/' . $product->main_image)
                                                : asset('assets/img/product/product3.png') }}"
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

                                                <li class="quick_button">
                                                    <a href="#" title="Quick View"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_box">
                                                        <span class="pe-7s-look"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <figcaption class="product_content text-center">
                                        <h4>
                                            <a href="{{ route('product.single', $product->slug) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h4>

                                        <div class="price_box">
                                            @if($product->sale_price)
                                            <span class="current_price">
                                                Rs. {{ number_format($product->sale_price, 2) }}
                                            </span>

                                            @else
                                            <span class="current_price">
                                                Rs. {{ number_format($product->price, 2) }}
                                            </span>
                                            @endif
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product section end -->

<!-- banner section  start -->
<div class="banner_section banner_section2 mb-140 padding-l-r-92">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single_banner wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                    <div class="banner_thumb">
                        <a href="#"><img src="{{ asset('assets/img/bg/banner3.png') }}" alt=""></a>
                        <div class="banner_text">
                            <h3><span>70%</span> Sale Off</h3>
                            <h2>Best Quality <br>
                                Products</h2>
                            <a class="btn btn-link" href="{{ route('shop.left-sidebar') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_banner wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1.2s">
                    <div class="banner_thumb">
                        <a href="#"><img src="{{ asset('assets/img/bg/banner4.png') }}" alt=""></a>
                        <div class="banner_text">
                            <h3><span>25%</span> Sale Off</h3>
                            <h2>Hot & Spicy <br>
                                Pastry</h2>
                            <a class="btn btn-link" href="{{ route('shop.left-sidebar') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_banner wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1.3s">
                    <div class="banner_thumb">
                        <a href="#"><img src="{{ asset('assets/img/bg/banner5.png') }}" alt=""></a>
                        <div class="banner_text">
                            <h3><span>35%</span> Sale Off</h3>
                            <h2>Best Quality <br>
                                Products</h2>
                            <a class="btn btn-link" href="{{ route('shop.left-sidebar') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner section  end -->

<!-- service section start-->

<div class="service_section services_style2 service_container mb-86">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="services_section_inner d-flex justify-content-between">

                    @foreach($categories as $category)

                    <div class="single_services {{ ['one', 'two', 'three', 'four'][$loop->index] }} text-center wow fadeInUp"
                        data-wow-delay="0.{{ $loop->index + 1 }}s"
                        data-wow-duration="1.{{ $loop->index + 1 }}s">

                        <div class="services_thumb">
                            <img
                                style="width: 150px; height: 150px; object-fit: contain;"
                                src="{{ $category->image
                                    ? asset('uploads/categories/' . $category->image)
                                    : asset('assets/img/others/services' . ($loop->index + 5) . '.png') }}"
                                alt="{{ $category->name }}">
                        </div>

                        <div class="services_content">
                            <h3>
                                <a href="{{ route('shop.left-sidebar') }}">
                                    {{ $category->name }}
                                </a>
                            </h3>

                            <p>{{ $category->description }}</p>
                        </div>

                    </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

<!-- service section end-->

<!-- product section start -->
<div class="product_section mb-80 wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
    <div class="container">
        <div class="section_title text-center mb-55">
            <h2>Best Seller</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod <br>
                tempor incididunt ut labore et dolore magna</p>
        </div>

        <div class="row product_slick slick_navigation slick__activation" data-slick='{
        "slidesToShow": 4,
        "slidesToScroll": 1,
        "arrows": true,
        "dots": false,
        "autoplay": false,
        "speed": 300,
        "infinite": true,
        "responsive": [
            {"breakpoint": 992, "settings": {"slidesToShow": 3}},
            {"breakpoint": 768, "settings": {"slidesToShow": 2}},
            {"breakpoint": 500, "settings": {"slidesToShow": 1}}
        ]
    }'>

            @foreach($bestSellerProducts as $product)
            <div class="col-lg-3">
                <article class="single_product">
                    <figure>
                        <div class="product_thumb" style="height: 300px;">
                            <a href="{{ route('product.single', $product->slug) }}">
                                <img
                                    class="w-100"
                                    style="height: 250px; object-fit: cover;"
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

                                    <li class="quick_button">
                                        <a href="#" title="Quick View"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal_box">
                                            <span class="pe-7s-look"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <figcaption class="product_content text-center">
                            <h4>
                                <a href="{{ route('product.single', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h4>

                            <div class="price_box">
                                @if($product->sale_price)
                                <span class="current_price">
                                    Rs. {{ number_format($product->sale_price, 2) }}
                                </span>
                                @else
                                <span class="current_price">
                                    Rs. {{ number_format($product->price, 2) }}
                                </span>
                                @endif
                            </div>
                        </figcaption>
                    </figure>
                </article>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- product section end -->

<!-- banner fullwidth section start -->
<div class="deals_banner_section padding-l-r-92 mb-105 wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
    <div class="deals_banner_bg" data-bgimg="{{ asset('assets/img/bg/banner-fullwidth2.png') }}">
        <div class="container">
            <div class="deals_banner_inner">
                <div class="row">
                    <div class="col-lg-6 offset-lg-6 col-md-6 offset-md-6">
                        <div class="banner_discount_text deals_banner_text ">
                            <h3><span>30% </span> Sale Off</h3>
                            <h2>Deal of the day</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                eiusmod <br> tempor
                                incididunt ut labore et dolore magna</p>
                            <div class="timer__area">
                                <div data-countdown="2023/10/11"></div>
                            </div>
                            <a class="btn btn-link" href="{{ route('shop.left-sidebar') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="add_discount">
                    <img src="{{ asset('assets/img/others/add-discount.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner fullwidth section end -->

<!-- blog section start -->
<div class="blog_section mb-90">
    <div class="container">
        <div class="section_title text-center wow fadeInUp mb-50" data-wow-delay="0.1s" data-wow-duration="1.1s">
            <h2>Latest Blog</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod <br>
                tempor incididunt ut
                labore et dolore magna</p>
        </div>
        <div class="row blog_inner slick__activation" data-slick='{
                "slidesToShow": 3,
                "slidesToScroll": 1,
                "arrows": false,
                "dots": false,
                "autoplay": false,
                "speed": 300,
                "infinite": true ,  
                "responsive":[  
                  {"breakpoint":992, "settings": { "slidesToShow": 2 } },  
                  {"breakpoint":576, "settings": { "slidesToShow": 1 } }  
                 ]                                                     
            }'>
            <div class="col-lg-4">
                <div class="single_blog wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                    <div class="blog_thumb">
                        <a href="{{ route('blog.detail.left-sidebar') }}"><img src="{{ asset('assets/img/blog/blog1.png') }}" alt=""></a>
                    </div>
                    <div class="blog_content">
                        <div class="blog_arrow_btn">
                            <a href="{{ route('blog.detail.left-sidebar') }}"><i class="ion-arrow-right-c"></i></a>
                        </div>
                        <span>Brakery</span>
                        <h3><a href="{{ route('blog.detail.left-sidebar') }}">Lorem ipsum doloril
                                sit amet consepy.</a></h3>
                        <div class="blog__meta d-flex align-items-center">
                            <div class="blog__meta__thumb">
                                <img src="{{ asset('assets/img/others/meta-img1.png') }}" alt="">
                            </div>
                            <div class="blog__meta__text">
                                <ul class="d-flex">
                                    <li>By: Admin</li>
                                    <li><i class="icofont-calendar"></i> 22 Aug, 2021</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single_blog wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1.2s">
                    <div class="blog_thumb">
                        <a href="{{ route('blog.detail.left-sidebar') }}"><img src="{{ asset('assets/img/blog/blog2.png') }}" alt=""></a>
                    </div>
                    <div class="blog_content">
                        <div class="blog_arrow_btn">
                            <a href="{{ route('blog.detail.left-sidebar') }}"><i class="ion-arrow-right-c"></i></a>
                        </div>
                        <span class="color2">Brakery</span>
                        <h3><a href="{{ route('blog.detail.left-sidebar') }}">Lorem ipsum dolor sit, elit,
                                dolores is .</a>
                        </h3>
                        <div class="blog__meta d-flex align-items-center">
                            <div class="blog__meta__thumb">
                                <img src="{{ asset('assets/img/others/meta-img2.png') }}" alt="">
                            </div>
                            <div class="blog__meta__text">
                                <ul class="d-flex">
                                    <li>By: Admin</li>
                                    <li><i class="icofont-calendar"></i> 22 Aug, 2021</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single_blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1.3s">
                    <div class="blog_thumb">
                        <a href="{{ route('blog.detail.left-sidebar') }}"><img src="{{ asset('assets/img/blog/blog3.png') }}" alt=""></a>
                    </div>
                    <div class="blog_content">
                        <div class="blog_arrow_btn">
                            <a href="{{ route('blog.detail.left-sidebar') }}"><i class="ion-arrow-right-c"></i></a>
                        </div>
                        <span class="color3">Brakery</span>
                        <h3><a href="{{ route('blog.detail.left-sidebar') }}"> harum dolorum culpa quas
                                are veniam</a></h3>
                        <div class="blog__meta d-flex align-items-center">
                            <div class="blog__meta__thumb">
                                <img src="{{ asset('assets/img/others/meta-img3.png') }}" alt="">
                            </div>
                            <div class="blog__meta__text">
                                <ul class="d-flex">
                                    <li>By: Admin</li>
                                    <li><i class="icofont-calendar"></i> 22 Aug, 2021</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single_blog wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                    <div class="blog_thumb">
                        <a href="{{ route('blog.detail.left-sidebar') }}"><img src="{{ asset('assets/img/blog/blog1.png') }}" alt=""></a>
                    </div>
                    <div class="blog_content">
                        <div class="blog_arrow_btn">
                            <a href="{{ route('blog.detail.left-sidebar') }}"><i class="ion-arrow-right-c"></i></a>
                        </div>
                        <span>Brakery</span>
                        <h3><a href="{{ route('blog.detail.left-sidebar') }}">There are many of Lorem
                                Ipsum.</a></h3>
                        <div class="blog__meta d-flex align-items-center">
                            <div class="blog__meta__thumb">
                                <img src="{{ asset('assets/img/others/meta-img1.png') }}" alt="">
                            </div>
                            <div class="blog__meta__text">
                                <ul class="d-flex">
                                    <li>By: Admin</li>
                                    <li><i class="icofont-calendar"></i> 22 Aug, 2021</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog section end -->
@endsection

@section('modals')
@include('frontend.partials.quick-view-modal')
@endsection