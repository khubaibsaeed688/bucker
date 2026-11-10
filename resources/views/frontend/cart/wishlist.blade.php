@extends('frontend.layouts.app')

@section('title', 'Bucker – Wishlist')
@section('og_title', 'Bucker – Wishlist')

@section('content')

<!-- breadcrumbs area start -->
<div class="breadcrumbs_aree breadcrumbs_bg mb-110"
    data-bgimg="{{ asset('assets/img/others/breadcrumbs-bg.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs_text">
                    <h1>Wishlist</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li> // Wishlist</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs area end -->

<!-- wishlist area start -->
<div class="wishlist-area">
    <div class="container">
        <div class="row">
            <div class="col-12">

                {{-- Success message --}}
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="table-content table-responsive">
                    <table class="table">

                        <thead>
                            <tr>
                                <th class="product_remove">remove</th>
                                <th class="product-thumbnail">images</th>
                                <th class="cart-product-name">Product</th>
                                <th class="product-price">Unit Price</th>
                                <th class="product-stock-status">Stock Status</th>
                                <th class="cart_btn">View Product</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($wishlists as $wishlist)

                            @if ($wishlist->product)
                            @php
                            $product = $wishlist->product;

                            $image = $product->main_image
                            ? asset('uploads/products/' . $product->main_image)
                            : asset('assets/img/product/mini-product/product1.png');

                            $price = $product->sale_price ?? $product->price;

                            $inStock = $product->stock > 0;
                            @endphp

                            <tr>
                                {{-- Remove from wishlist --}}
                                <td class="product_remove">
                                    <form
                                        action="{{ route('wishlist.destroy', $wishlist->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            title="Remove"
                                            aria-label="Remove {{ $product->name }} from wishlist"
                                            style="background: none; border: none; padding: 0; cursor: pointer;">

                                            <i class="pe-7s-close"></i>

                                        </button>
                                    </form>
                                </td>

                                {{-- Product image --}}
                                <td class="product-thumbnail">
                                    <a href="{{ route('product.single', ['slug' => $product->slug]) }}">

                                        <img
                                            src="{{ $image }}"
                                            alt="{{ $product->name }}"
                                            width="50"
                                            height="50"
                                            style="width: 50px; height: 50px; object-fit: contain;"
                                            onerror="this.onerror=null;this.src='{{ asset('assets/img/product/mini-product/product1.png') }}';">

                                    </a>
                                </td>

                                {{-- Product name --}}
                                <td class="product-name">
                                    <a href="{{ route('product.single', ['slug' => $product->slug]) }}">
                                        {{ $product->name }}
                                    </a>
                                </td>

                                {{-- Product price --}}
                                <td class="product-price">
                                    <span class="amount">
                                        ${{ number_format((float) $price, 2) }}
                                    </span>
                                </td>

                                {{-- Stock status --}}
                                <td class="product-stock-status">

                                    @if ($inStock)
                                    <span class="in-stock">In stock</span>
                                    @else
                                    <span class="in-stock text-danger">Out of stock</span>
                                    @endif

                                </td>

                                {{-- View product --}}
                                <td class="cart_btn">
                                    <a href="{{ route('product.single', ['slug' => $product->slug]) }}">
                                        View Product
                                    </a>
                                </td>
                            </tr>
                            @endif

                            @empty

                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <h4>Your wishlist is empty!</h4>

                                    <p>
                                        You have not added any products to your wishlist yet.
                                    </p>

                                    <a href="{{ route('home') }}">
                                        Continue Shopping
                                    </a>
                                </td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- wishlist area end -->

@endsection