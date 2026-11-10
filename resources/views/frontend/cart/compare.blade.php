@extends('frontend.layouts.app')

@section('title', 'Bucker – Compare')
@section('og_title', 'Bucker – About Us')

@section('content')
    <!-- breadcrumbs area start -->
    <div class="breadcrumbs_aree breadcrumbs_bg mb-110" data-bgimg="{{ asset('assets/img/others/breadcrumbs-bg.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs_text">
                        <h1>Compare</h1>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li> // Compare</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs area end -->
    <div class="compare-area">
        <div class="container">
            <div class="compare-table table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <tbody>
                        <tr>
                            <th class="compare-column-titles">Image</th>
                            <td class="compare-column-productinfo">
                                <div class="compare-pdoduct-image">
                                    <a href="{{ route('product.single', ['slug' => 'Octavia Garrett']) }}">
                                        <img src="{{ asset('assets/img/product/mini-product/product1.png') }}"
                                            alt="Wishlist Thumbnail">
                                    </a>
                                    <a href="{{ route('cart') }}" class="btn custom-btn md-size rounded-0">
                                        <span>ADD TO CART</span>
                                    </a>
                                </div>
                            </td>
                            <td class="compare-column-productinfo">
                                <div class="compare-pdoduct-image">
                                    <a href="{{ route('product.single', ['slug' => 'Octavia Garrett']) }}">
                                        <img src="{{ asset('assets/img/product/mini-product/product2.png') }}"
                                            alt="Wishlist Thumbnail">
                                    </a>
                                    <a href="{{ route('cart') }}" class="btn custom-btn md-size rounded-0">
                                        <span>ADD TO CART</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td>
                                <h5 class="compare-product-name"><a href="{{ route('product.single', ['slug' => 'Octavia Garrett']) }}">Product Name Here</a>
                                </h5>
                            </td>
                            <td>
                                <h5 class="compare-product-name"><a href="{{ route('product.single', ['slug' => 'Octavia Garrett']) }}">Lorem, ipsum dolor.</a>
                                </h5>
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li
                                sam vocabular. Lingues differe
                                solmen in grammatica, pronunciation commun vocabules.</td>
                            <td>Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li
                                sam vocabular. Lingues differe
                                solmen in grammatica, pronunciation commun vocabules.</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>$22</td>
                            <td>$24</td>
                        </tr>
                        <tr>
                            <th>Color</th>
                            <td>Black</td>
                            <td>Red</td>
                        </tr>
                        <tr>
                            <th>Size</th>
                            <td>Medium</td>
                            <td>Large</td>
                        </tr>
                        <tr>
                            <th>Stock</th>
                            <td>In Stock</td>
                            <td>Stock Out</td>
                        </tr>
                        <tr>
                            <th>Rating</th>
                            <td>
                                <div class="rating-box">
                                    <ul>
                                        <li><i class="pe-7s-star"></i></li>
                                        <li><i class="pe-7s-star"></i></li>
                                        <li><i class="pe-7s-star"></i></li>
                                        <li><i class="pe-7s-star"></i></li>
                                        <li><i class="pe-7s-star"></i></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="rating-box">
                                    <ul>
                                        <li><i class="pe-7s-star"></i></li>
                                        <li><i class="pe-7s-star"></i></li>
                                        <li><i class="pe-7s-star"></i></li>
                                        <li><i class="pe-7s-star"></i></li>
                                        <li><i class="pe-7s-star"></i></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
