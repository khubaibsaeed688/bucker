@extends('frontend.layouts.app')

@section('title', 'Bucker – Cart')
@section('og_title', 'Bucker – About Us')

@section('content')
<!-- breadcrumbs area start -->
<div class="breadcrumbs_aree breadcrumbs_bg mb-110" data-bgimg="{{ asset('assets/img/others/breadcrumbs-bg.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs_text">
                    <h1>Cart</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li> // Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs area end -->

<div class="cart-area">
    <div class="container">
        <div class="row">
            <div class="col-12">

                {{-- Success Message --}}
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                {{-- Error Message --}}
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
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
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($cartItems as $item)

                            @php
                            $product = $item->product;

                            $image = $product->main_image
                            ? asset('uploads/products/' . $product->main_image)
                            : asset('assets/img/product/mini-product/product1.png');

                            // Price saved when product was added to cart
                            $price = $item->price;

                            $itemTotal = $price * $item->quantity;
                            @endphp

                            <tr>

                                {{-- Remove Product --}}
                                <td class="product_remove">
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            style="background: none; border: none; padding: 0; cursor: pointer;">
                                            <i class="pe-7s-close" title="Remove"></i>
                                        </button>
                                    </form>
                                </td>

                                {{-- Product Image --}}
                                <td class="product-thumbnail">
                                    <a href="{{ route('product.single', ['slug' => $product->slug]) }}">
                                        <img src="{{ $image }}"
                                            alt="{{ $product->name }}"
                                            width="60"
                                            height="60"
                                            style="width: 60px; height: 60px; object-fit: contain;">
                                    </a>
                                </td>

                                {{-- Product Name --}}
                                <td class="product-name">
                                    <a href="{{ route('product.single', ['slug' => $product->slug]) }}">
                                        {{ $product->name }}
                                    </a>
                                </td>

                                {{-- Unit Price --}}
                                <td class="product-price">
                                    <span class="amount">
                                        ${{ number_format($price, 2) }}
                                    </span>
                                </td>

                                {{-- Quantity --}}
                                <td class="product_pro_button quantity">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <div class="pro-qty border">
                                            <input type="text"
                                                name="quantity"
                                                value="{{ $item->quantity }}"
                                                inputmode="numeric"
                                                onchange="this.form.submit()">
                                        </div>
                                    </form>
                                </td>

                                {{-- Product Total --}}
                                <td class="product-subtotal">
                                    <span class="amount">
                                        ${{ number_format($itemTotal, 2) }}
                                    </span>
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="6" class="text-center">
                                    <h4>Your cart is empty!</h4>
                                    <p>You haven't added any products to your cart yet.</p>
                                    <a href="{{ route('home') }}">Continue Shopping</a>
                                </td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>

                @if ($cartItems->isNotEmpty())

                <div class="row">
                    <div class="col-12">
                        <div class="coupon-all">

                            <div class="coupon">
                                <input id="coupon_code"
                                    class="input-text"
                                    name="coupon_code"
                                    value=""
                                    placeholder="Coupon code"
                                    type="text">

                                <input class="button mt-xxs-30"
                                    name="apply_coupon"
                                    value="Apply coupon"
                                    type="button"
                                    disabled>
                            </div>

                            <div class="coupon2">
                                <input class="button"
                                    name="update_cart"
                                    value="Update cart"
                                    type="button"
                                    onclick="window.location.reload()">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 ml-auto">
                        <div class="cart-page-total">

                            <h2>Cart totals</h2>

                            <ul>
                                <li>
                                    Subtotal
                                    <span>${{ number_format($subtotal, 2) }}</span>
                                </li>

                                <li>
                                    Total
                                    <span>${{ number_format($total, 2) }}</span>
                                </li>
                            </ul>

                            <!-- <a href="#">Proceed to checkout</a> -->
                            <a href="{{ route('checkout') }}">
                                Proceed to checkout
                            </a>

                        </div>
                    </div>
                </div>

                @endif

            </div>
        </div>
    </div>
</div>
@endsection