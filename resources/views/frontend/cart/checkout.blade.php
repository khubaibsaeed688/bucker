@extends('frontend.layouts.app')



@section('title', 'Bucker – Checkout')

@section('og_title', 'Bucker – Checkout')



@section('content')

<!-- breadcrumbs area start -->

<div class="breadcrumbs_aree breadcrumbs_bg mb-110" data-bgimg="{{ asset('assets/img/others/breadcrumbs-bg.png') }}">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <div class="breadcrumbs_text">

                    <h1>Checkout</h1>

                    <ul>

                        <li><a href="{{ route('home') }}">Home</a></li>

                        <li> // Checkout</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- breadcrumbs area end -->

<div class="checkout-area">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <div class="coupon-accordion">

                    <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>

                    <div id="checkout-login" class="coupon-content">

                        <div class="coupon-info">

                            <p class="coupon-text mb-1">Quisque gravida turpis sit amet nulla posuere lacinia. Cras

                                sed

                                est

                                sit amet ipsum luctus.</p>

                            <form action="#">

                                <p class="form-row-first">

                                    <label class="mb-1">Username or email <span class="required">*</span></label>

                                    <input type="text">

                                </p>

                                <p class="form-row-last">

                                    <label>Password <span class="required">*</span></label>

                                    <input type="text">

                                </p>

                                <p class="form-row">

                                    <input type="checkbox" id="remember_me">

                                    <label for="remember_me">Remember me</label>

                                </p>

                                <p class="lost-password"><a href="#">Lost your password?</a></p>

                            </form>

                        </div>

                    </div>

                    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>

                    <div id="checkout_coupon" class="coupon-checkout-content">

                        <div class="coupon-info">

                            <form action="#">

                                <p class="checkout-coupon">

                                    <input placeholder="Coupon code" type="text">

                                    <input class="coupon-inner_btn" value="Apply Coupon" type="submit">

                                </p>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <form action="{{ route('checkout.store') }}" method="POST" class="w-100">
                @csrf

                <div class="row">

            <div class="col-lg-6 col-12">





                    <div class="checkbox-form">

                        <h3>Billing Details</h3>



                        <div class="row">



                            {{-- Country --}}

                            <div class="col-md-12">

                                <div class="country-select clearfix">

                                    <label>Country <span class="required">*</span></label>



                                    <select name="country" class="myniceselect nice-select wide">

                                        <option value="Pakistan" {{ old('country', 'Pakistan') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>

                                        <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>

                                        <option value="Romania" {{ old('country') == 'Romania' ? 'selected' : '' }}>Romania</option>

                                        <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>France</option>

                                        <option value="Germany" {{ old('country') == 'Germany' ? 'selected' : '' }}>Germany</option>

                                        <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>

                                    </select>



                                    @error('country')

                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>

                            </div>



                            {{-- First Name --}}

                            <div class="col-md-6">

                                <div class="checkout-form-list">

                                    <label>First Name <span class="required">*</span></label>

                                    <input type="text" name="first_name"

                                        value="{{ old('first_name') }}" placeholder="">



                                    @error('first_name')

                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>

                            </div>



                            {{-- Last Name --}}

                            <div class="col-md-6">

                                <div class="checkout-form-list">

                                    <label>Last Name <span class="required">*</span></label>

                                    <input type="text" name="last_name"

                                        value="{{ old('last_name') }}" placeholder="">



                                    @error('last_name')

                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>

                            </div>



                            {{-- Company --}}

                            <div class="col-md-12">

                                <div class="checkout-form-list">

                                    <label>Company Name</label>

                                    <input type="text" name="company"

                                        value="{{ old('company') }}" placeholder="">

                                </div>

                            </div>



                            {{-- Address --}}

                            <div class="col-md-12">

                                <div class="checkout-form-list">

                                    <label>Address <span class="required">*</span></label>

                                    <input type="text" name="address"

                                        value="{{ old('address') }}" placeholder="Street address">



                                    @error('address')

                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>

                            </div>



                            {{-- Apartment --}}

                            <div class="col-md-12">

                                <div class="checkout-form-list">

                                    <input type="text" name="address_line_2"

                                        value="{{ old('address_line_2') }}"

                                        placeholder="Apartment, suite, unit etc. (optional)">

                                </div>

                            </div>



                            {{-- City --}}

                            <div class="col-md-12">

                                <div class="checkout-form-list">

                                    <label>Town / City <span class="required">*</span></label>

                                    <input type="text" name="city"

                                        value="{{ old('city') }}">



                                    @error('city')

                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>

                            </div>



                            {{-- State --}}

                            <div class="col-md-6">

                                <div class="checkout-form-list">

                                    <label>State / County <span class="required">*</span></label>

                                    <input type="text" name="state"

                                        value="{{ old('state') }}" placeholder="">



                                    @error('state')

                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>

                            </div>



                            {{-- Postcode --}}

                            <div class="col-md-6">

                                <div class="checkout-form-list">

                                    <label>Postcode / Zip <span class="required">*</span></label>

                                    <input type="text" name="postcode"

                                        value="{{ old('postcode') }}" placeholder="">



                                    @error('postcode')

                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>

                            </div>



                            {{-- Email --}}

                            <div class="col-md-6">

                                <div class="checkout-form-list">

                                    <label>Email Address <span class="required">*</span></label>

                                    <input type="email" name="email"

                                        value="{{ old('email', auth()->user()->email ?? '') }}"

                                        placeholder="">



                                    @error('email')

                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>

                            </div>



                            {{-- Phone --}}

                            <div class="col-md-6">

                                <div class="checkout-form-list">

                                    <label>Phone <span class="required">*</span></label>

                                    <input type="text" name="phone"

                                        value="{{ old('phone') }}">



                                    @error('phone')

                                    <span class="text-danger">{{ $message }}</span>

                                    @enderror

                                </div>

                            </div>



                        </div>



                        {{-- Shipping Address --}}

                        <div class="different-address">



                            <div class="ship-different-title">

                                <h3>

                                    <label>Ship to a different address?</label>

                                    <input id="ship-box" type="checkbox"

                                        name="ship_to_different_address" value="1"

                                        {{ old('ship_to_different_address') ? 'checked' : '' }}>

                                </h3>

                            </div>



                            <div id="ship-box-info" class="row">



                                <div class="col-md-12">

                                    <div class="myniceselect country-select clearfix">

                                        <label>Country <span class="required">*</span></label>



                                        <select name="shipping_country" class="myniceselect nice-select wide">

                                            <option value="Pakistan" {{ old('shipping_country', 'Pakistan') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>

                                            <option value="United Kingdom" {{ old('shipping_country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>

                                            <option value="Romania" {{ old('shipping_country') == 'Romania' ? 'selected' : '' }}>Romania</option>

                                            <option value="France" {{ old('shipping_country') == 'France' ? 'selected' : '' }}>France</option>

                                            <option value="Germany" {{ old('shipping_country') == 'Germany' ? 'selected' : '' }}>Germany</option>

                                            <option value="Australia" {{ old('shipping_country') == 'Australia' ? 'selected' : '' }}>Australia</option>

                                        </select>



                                        @error('shipping_country')

                                        <span class="text-danger">{{ $message }}</span>

                                        @enderror

                                    </div>

                                </div>



                                {{-- Shipping First Name --}}

                                <div class="col-md-12">

                                    <div class="checkout-form-list">

                                        <label>First Name <span class="required">*</span></label>

                                        <input type="text" name="shipping_first_name"

                                            value="{{ old('shipping_first_name') }}">

                                    </div>

                                </div>



                                {{-- Shipping Last Name --}}

                                <div class="col-md-12">

                                    <div class="checkout-form-list">

                                        <label>Last Name <span class="required">*</span></label>

                                        <input type="text" name="shipping_last_name"

                                            value="{{ old('shipping_last_name') }}">

                                    </div>

                                </div>



                                {{-- Shipping Company --}}

                                <div class="col-md-12">

                                    <div class="checkout-form-list">

                                        <label>Company Name</label>

                                        <input type="text" name="shipping_company"

                                            value="{{ old('shipping_company') }}">

                                    </div>

                                </div>



                                {{-- Shipping Address --}}

                                <div class="col-md-12">

                                    <div class="checkout-form-list">

                                        <label>Address <span class="required">*</span></label>

                                        <input type="text" name="shipping_address"

                                            value="{{ old('shipping_address') }}"

                                            placeholder="Street address">

                                    </div>

                                </div>



                                {{-- Shipping Apartment --}}

                                <div class="col-md-12">

                                    <div class="checkout-form-list">

                                        <input type="text" name="shipping_address_line_2"

                                            value="{{ old('shipping_address_line_2') }}"

                                            placeholder="Apartment, suite, unit etc. (optional)">

                                    </div>

                                </div>



                                {{-- Shipping City --}}

                                <div class="col-md-12">

                                    <div class="checkout-form-list">

                                        <label>Town / City <span class="required">*</span></label>

                                        <input type="text" name="shipping_city"

                                            value="{{ old('shipping_city') }}">

                                    </div>

                                </div>



                                {{-- Shipping State --}}

                                <div class="col-md-12">

                                    <div class="checkout-form-list">

                                        <label>State / County <span class="required">*</span></label>

                                        <input type="text" name="shipping_state"

                                            value="{{ old('shipping_state') }}">

                                    </div>

                                </div>



                                {{-- Shipping Postcode --}}

                                <div class="col-md-12">

                                    <div class="checkout-form-list">

                                        <label>Postcode / Zip <span class="required">*</span></label>

                                        <input type="text" name="shipping_postcode"

                                            value="{{ old('shipping_postcode') }}">

                                    </div>

                                </div>



                                {{-- Shipping Phone --}}

                                <div class="col-md-12">

                                    <div class="checkout-form-list">

                                        <label>Phone <span class="required">*</span></label>

                                        <input type="text" name="shipping_phone"

                                            value="{{ old('shipping_phone') }}">

                                    </div>

                                </div>



                            </div>



                            {{-- Order Notes --}}

                            <div class="order-notes">

                                <div class="checkout-form-list checkout-form-list-2">

                                    <label>Order Notes</label>

                                    <textarea id="checkout-mess" name="order_notes"

                                        cols="30" rows="10"

                                        placeholder="Notes about your order, e.g. special notes for delivery.">{{ old('order_notes') }}</textarea>

                                </div>

                            </div>



                        </div>

                    </div>



            </div>

            <div class="col-lg-6 col-12">

                <div class="your-order">

                    <h3>Your order</h3>

                    <div class="your-order-table table-responsive">

                        <table class="table">

                            <thead>

                                <tr>

                                    <th class="cart-product-name">Product</th>

                                    <th class="cart-product-total">Total</th>

                                </tr>

                            </thead>

                            <!-- <tbody>

                                    <tr class="cart-item">

                                        <td class="cart-product-name"> Vestibulum suscipit<strong

                                                class="product-quantity">

                                                × 1</strong></td>

                                        <td class="cart-product-total"><span class="amount">$165.00</span></td>

                                    </tr>

                                    <tr class="cart-item">

                                        <td class="cart-product-name"> Vestibulum suscipit<strong

                                                class="product-quantity">

                                                × 1</strong></td>

                                        <td class="cart-product-total"><span class="amount">$165.00</span></td>

                                    </tr>

                                </tbody> -->

                            <tbody>

                                @foreach($cartItems as $item)

                                <tr class="cart-item">

                                    <td class="cart-product-name">

                                        {{ $item->product->name }}



                                        <strong class="product-quantity">

                                            × {{ $item->quantity }}

                                        </strong>

                                    </td>



                                    <td class="cart-product-total">

                                        <span class="amount">

                                            Rs. {{ number_format($item->price * $item->quantity, 2) }}

                                        </span>

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                            <!-- <tfoot>

                                <tr class="cart-subtotal">

                                    <th>Cart Subtotal</th>

                                    <td><span class="amount">$215.00</span></td>

                                </tr>

                                <tr class="order-total">

                                    <th>Order Total</th>

                                    <td><strong><span class="amount">$215.00</span></strong></td>

                                </tr>

                            </tfoot> -->

                            <tfoot>

                                <tr class="cart-subtotal">

                                    <th>Cart Subtotal</th>

                                    <td>

                                        <span class="amount">

                                            Rs. {{ number_format($subtotal, 2) }}

                                        </span>

                                    </td>

                                </tr>



                                @if($appliedCoupon)

                                <tr>

                                    <th>Coupon ({{ $appliedCoupon->code }})</th>

                                    <td>

                                        <span class="amount">

                                            - Rs. {{ number_format($discount, 2) }}

                                        </span>

                                    </td>

                                </tr>

                                @endif



                                <tr>

                                    <th>Shipping</th>

                                    <td>

                                        <span class="amount">

                                            Rs. {{ number_format($shippingCost, 2) }}

                                        </span>

                                    </td>

                                </tr>



                                <tr class="order-total">

                                    <th>Order Total</th>

                                    <td>

                                        <strong>

                                            <span class="amount">

                                                Rs. {{ number_format($total, 2) }}

                                            </span>

                                        </strong>

                                    </td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>



                    <div class="payment-method">

                        <div class="payment-accordion">

                            <div id="accordion">



                                {{-- Direct Bank Transfer --}}

                                <div class="card">

                                    <div class="card-header" id="payment-1">

                                        <h5 class="panel-title">

                                            <label for="bank_transfer" class="mb-0">

                                                <input

                                                    type="radio"

                                                    name="payment_method"

                                                    id="bank_transfer"

                                                    value="bank_transfer"

                                                    {{ old('payment_method', 'bank_transfer') == 'bank_transfer' ? 'checked' : '' }}

                                                    data-bs-toggle="collapse"

                                                    data-bs-target="#collapseOne"

                                                    aria-controls="collapseOne">

                                                Direct Bank Transfer

                                            </label>

                                        </h5>

                                    </div>



                                    <div id="collapseOne"

                                        class="collapse {{ old('payment_method', 'bank_transfer') == 'bank_transfer' ? 'show' : '' }}"

                                        data-bs-parent="#accordion">



                                        <div class="card-body">

                                            <p class="mb-3">

                                                Make your payment directly into our bank account.

                                                Please use your Order ID as the payment reference.

                                                Your order won't be shipped until the funds have

                                                cleared in our account.

                                            </p>

                                        </div>

                                    </div>

                                </div>



                                {{-- Cheque Payment --}}

                                <div class="card">

                                    <div class="card-header" id="payment-2">

                                        <h5 class="panel-title">

                                            <label for="cod" class="mb-0">

                                                <input

                                                    type="radio"

                                                    name="payment_method"

                                                    id="cod"

                                                    value="cod"

                                                    {{ old('payment_method') == 'cod' ? 'checked' : '' }}

                                                    data-bs-toggle="collapse"

                                                    data-bs-target="#collapseTwo"

                                                    aria-controls="collapseTwo">

                                                Cash on Delivery

                                            </label>

                                        </h5>

                                    </div>



                                    <div id="collapseTwo"

                                        class="collapse {{ old('payment_method') == 'cod' ? 'show' : '' }}"

                                        data-bs-parent="#accordion">



                                        <div class="card-body">

                                            <p class="mb-3">

                                                Please send your Cash on Delivery using the

                                                instructions provided by our store.

                                            </p>

                                        </div>

                                    </div>

                                </div>



                                {{-- Safepay Online Payment --}}

                                <div class="card">

                                    <div class="card-header" id="payment-3">

                                        <h5 class="panel-title">

                                            <label for="online" class="mb-0">

                                                <input

                                                    type="radio"

                                                    name="payment_method"

                                                    id="online"

                                                    value="online"

                                                    {{ old('payment_method') == 'online' ? 'checked' : '' }}

                                                    data-bs-toggle="collapse"

                                                    data-bs-target="#collapseThree"

                                                    aria-controls="collapseThree">

                                                Online

                                            </label>

                                        </h5>

                                    </div>



                                    <div id="collapseThree"

                                        class="collapse {{ old('payment_method') == 'online' ? 'show' : '' }}"

                                        data-bs-parent="#accordion">



                                        <div class="card-body">

                                            <p class="mb-3">

                                                You will be redirected to Safepay to complete your secure online payment.

                                            </p>

                                        </div>

                                    </div>

                                </div>



                            </div>



                            @error('payment_method')

                            <span class="text-danger">{{ $message }}</span>

                            @enderror



                            {{-- Place Order --}}

                            <div class="order-button-payment">

                                <input value="Place order" type="submit">

                            </div>



                        </div>

                    </div>



                </div>

                </div>
            </form>

        </div>

    </div>

</div>

@endsection