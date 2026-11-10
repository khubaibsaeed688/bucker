
@extends('frontend.layouts.app')

@section('title', 'Order Details - Bucker')

@section('content')

<!-- Breadcrumbs -->
<div class="breadcrumbs_aree breadcrumbs_bg mb-110"
    data-bgimg="{{ asset('assets/img/others/breadcrumbs-bg.png') }}">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs_text">
                    <h1>Order Details</h1>

                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>// <a href="{{ route('account.dashboard') }}">My Account</a></li>
                        <li>// Order Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Details Area -->
<div class="account-page-area mb-100">
    <div class="container">

        <div class="myaccount-orders">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="small-title">ORDER DETAILS</h4>

                <a href="{{ route('account.dashboard') }}"
                    class="btn btn-secondary btn-primary-hover">
                    <span>Back to Account</span>
                </a>
            </div>

            <!-- Order Information -->
            <div class="row mb-4">

                <div class="col-lg-4 col-md-6 mb-3">
                    <h5>Order Number</h5>
                    <p>#{{ $order->order_number }}</p>
                </div>

                <div class="col-lg-4 col-md-6 mb-3">
                    <h5>Order Date</h5>
                    <p>{{ $order->created_at->format('M d, Y') }}</p>
                </div>

                <div class="col-lg-4 col-md-6 mb-3">
                    <h5>Order Status</h5>
                    <p>{{ ucfirst($order->status) }}</p>
                </div>

                <div class="col-lg-4 col-md-6 mb-3">
                    <h5>Payment Status</h5>
                    <p>{{ ucfirst($order->payment_status) }}</p>
                </div>

                <div class="col-lg-4 col-md-6 mb-3">
                    <h5>Payment Method</h5>

                    <p>
                        @switch($order->payment_method)
                            @case('cod')
                                Cash on Delivery
                                @break

                            @case('bank_transfer')
                                Direct Bank Transfer
                                @break

                            @case('paypal')
                                PayPal
                                @break

                            @default
                                {{ ucfirst($order->payment_method) }}
                        @endswitch
                    </p>
                </div>

            </div>

            <!-- Products -->
            <h4 class="small-title mt-4">ORDERED PRODUCTS</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>PRODUCT</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>SUBTOTAL</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">

                                        @if($item->product && $item->product->main_image)
                                            <img
                                                src="{{ asset('uploads/products/' . $item->product->main_image) }}"
                                                alt="{{ $item->product_name }}"
                                                width="65"
                                                height="65"
                                                style="object-fit: contain;">
                                        @endif

                                        <span>{{ $item->product_name }}</span>

                                    </div>
                                </td>

                                <td>
                                    ${{ number_format($item->price, 2) }}
                                </td>

                                <td>
                                    {{ $item->quantity }}
                                </td>

                                <td>
                                    ${{ number_format($item->subtotal, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    No products found in this order.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Order Summary -->
            <div class="row justify-content-end mt-4">

                <div class="col-lg-5 col-md-7">

                    <h4 class="small-title">ORDER SUMMARY</h4>

                    <table class="table table-bordered">

                        <tr>
                            <th>Subtotal</th>
                            <td>
                                ${{ number_format($order->subtotal, 2) }}
                            </td>
                        </tr>

                        <tr>
                            <th>Shipping</th>
                            <td>
                                ${{ number_format($order->shipping_cost, 2) }}
                            </td>
                        </tr>

                        <tr>
                            <th>Discount</th>
                            <td>
                                - ${{ number_format($order->discount, 2) }}
                            </td>
                        </tr>

                        <tr>
                            <th>Total</th>
                            <td>
                                <strong>
                                    ${{ number_format($order->total, 2) }}
                                </strong>
                            </td>
                        </tr>

                    </table>

                </div>
            </div>

            <!-- Billing and Shipping Address -->
            <div class="row mt-5">

                <div class="col-md-6 mb-4">

                    <h4 class="small-title">BILLING ADDRESS</h4>

                    <address>
                        <strong>
                            {{ $order->first_name }}
                            {{ $order->last_name }}
                        </strong><br>

                        {{ $order->company }}<br>
                        {{ $order->address }}<br>

                        @if($order->address_line_2)
                            {{ $order->address_line_2 }}<br>
                        @endif

                        {{ $order->city }},
                        {{ $order->state }}
                        {{ $order->postcode }}<br>

                        {{ $order->country }}<br>
                        Phone: {{ $order->phone }}<br>
                        Email: {{ $order->email }}
                    </address>

                </div>

                <div class="col-md-6 mb-4">

                    <h4 class="small-title">SHIPPING ADDRESS</h4>

                    @if($order->ship_to_different_address)

                        <address>
                            <strong>
                                {{ $order->shipping_first_name }}
                                {{ $order->shipping_last_name }}
                            </strong><br>

                            {{ $order->shipping_address }}<br>

                            {{ $order->shipping_city }},
                            {{ $order->shipping_state }}
                            {{ $order->shipping_postcode }}<br>

                            {{ $order->shipping_country }}<br>

                            @if($order->shipping_phone)
                                Phone: {{ $order->shipping_phone }}
                            @endif
                        </address>

                    @else

                        <address>
                            Same as billing address.
                        </address>

                    @endif

                </div>

            </div>

            <!-- Order Notes -->
            @if($order->order_notes)
                <div class="mt-3">
                    <h4 class="small-title">ORDER NOTES</h4>
                    <p>{{ $order->order_notes }}</p>
                </div>
            @endif

        </div>

    </div>
</div>

@endsection
