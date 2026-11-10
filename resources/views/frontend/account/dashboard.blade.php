@extends('frontend.layouts.app')

@section('title', 'Bucker – My Account')
@section('og_title', 'Bucker – About Us')

@section('content')
<!-- breadcrumbs area start -->
<div class="breadcrumbs_aree breadcrumbs_bg mb-110" data-bgimg="{{ asset('assets/img/others/breadcrumbs-bg.png') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs_text">
                    <h1>My Account</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">Home </a></li>
                        <li> // My Account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs area end -->
<div class="account-page-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="account-dashboard-tab" data-bs-toggle="tab"
                            href="#account-dashboard" role="tab" aria-controls="account-dashboard"
                            aria-selected="true">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="account-orders-tab" data-bs-toggle="tab" href="#account-orders"
                            role="tab" aria-controls="account-orders" aria-selected="false">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="account-address-tab" data-bs-toggle="tab" href="#account-address"
                            role="tab" aria-controls="account-address" aria-selected="false">Addresses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="account-details-tab" data-bs-toggle="tab" href="#account-details"
                            role="tab" aria-controls="account-details" aria-selected="false">Account Details</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="account-logout-tab" href="{{ route('account.login-register') }}" role="tab"
                            aria-selected="false">Logout</a>
                    </li> -->

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="nav-link"
                                id="account-logout-tab"
                                role="tab"
                                aria-selected="false"
                                style="width: 100%; text-align: left; border: none; cursor: pointer; background:#333333; color: white;">
                                LOGOUT
                            </button>
                        </form>

                    </li>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                    <div class="tab-pane fade show active" id="account-dashboard" role="tabpanel"
                        aria-labelledby="account-dashboard-tab">
                        <!-- <div class="myaccount-dashboard">
                            <p>Hello <b>Bucker</b> (not Bucker? <a href="{{ route('account.login-register') }}">Sign
                                    out</a>)</p>
                            <p>From your account dashboard you can view your recent orders, manage your shipping and
                                billing addresses and <a href="javascript:void(0)">edit your password and account
                                    details</a>.</p>
                        </div> -->

                        <div class="myaccount-dashboard">
                            <p>
                                Hello <b>{{ $user->name }}</b>
                                (not {{ $user->name }}?
                            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                @csrf
                                <button type="submit" style="border: none; background: none; padding: 0; color: #c7a17a; cursor: pointer;">
                                    Sign out
                                </button>
                            </form>)
                            </p>

                            <p>
                                From your account dashboard you can view your
                                <a href="#account-orders" data-bs-toggle="tab">recent orders</a>,
                                manage your shipping and billing addresses and
                                edit your account details.
                            </p>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="account-orders" role="tabpanel"
                        aria-labelledby="account-orders-tab">
                        <div class="myaccount-orders">
                            <h4 class="small-title">MY ORDERS</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <!-- <tbody>
                                        <tr>
                                            <th>ORDER</th>
                                            <th>DATE</th>
                                            <th>STATUS</th>
                                            <th>TOTAL</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td><a class="account-order-id" href="javascript:void(0)">#5364</a></td>
                                            <td>Mar 27, 2019</td>
                                            <td>On Hold</td>
                                            <td>$162.00 for 2 items</td>
                                            <td><a href="javascript:void(0)"
                                                    class="btn btn-secondary btn-primary-hover"><span>View</span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a class="account-order-id" href="javascript:void(0)">#5356</a></td>
                                            <td>Mar 27, 2019</td>
                                            <td>On Hold</td>
                                            <td>$162.00 for 2 items</td>
                                            <td><a href="javascript:void(0)"
                                                    class="btn btn-secondary btn-primary-hover"><span>View</span></a>
                                            </td>
                                        </tr>
                                    </tbody> -->

                                    <tbody>
                                        <tr>
                                            <th>ORDER</th>
                                            <th>DATE</th>
                                            <th>STATUS</th>
                                            <th>TOTAL</th>
                                            <th></th>
                                        </tr>

                                        @forelse($orders as $order)
                                        <tr>
                                            <td>
                                                <a class="account-order-id" href="javascript:void(0)">
                                                    #{{ $order->order_number }}
                                                </a>
                                            </td>

                                            <td>
                                                {{ $order->created_at->format('M d, Y') }}
                                            </td>

                                            <td>
                                                {{ ucfirst($order->status) }}
                                            </td>

                                            <td>
                                                ${{ number_format($order->total, 2) }}
                                                for {{ $order->items->sum('quantity') }} items
                                            </td>

                                            <td>
                                                <!-- <a href="javascript:void(0)"
                                                    class="btn btn-secondary btn-primary-hover">
                                                    <span>View</span>
                                                </a> -->
                                                <a href="{{ route('account.orders.show', $order->id) }}"
                                                    class="btn btn-secondary btn-primary-hover">
                                                    <span>View</span>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                You have not placed any orders yet.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="account-address" role="tabpanel"
                        aria-labelledby="account-address-tab">
                        <div class="myaccount-address">
                            <p>The following addresses will be used on the checkout page by default.</p>
                            <!-- <div class="row">
                                <div class="col">
                                    <h4 class="small-title">BILLING ADDRESS</h4>
                                    <address>
                                        1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                    </address>
                                </div>
                                <div class="col">
                                    <h4 class="small-title">SHIPPING ADDRESS</h4>
                                    <address>
                                        1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                    </address>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col">
                                    <h4 class="small-title">BILLING ADDRESS</h4>

                                    @if($latestOrder)
                                    <address>
                                        {{ $latestOrder->first_name }}
                                        {{ $latestOrder->last_name }}<br>

                                        {{ $latestOrder->company }}<br>
                                        {{ $latestOrder->address }}<br>

                                        {{ $latestOrder->address_line_2 }}<br>

                                        {{ $latestOrder->city }},
                                        {{ $latestOrder->state }}
                                        {{ $latestOrder->postcode }}<br>

                                        {{ $latestOrder->country }}<br>
                                        {{ $latestOrder->phone }}<br>
                                        {{ $latestOrder->email }}
                                    </address>
                                    @else
                                    <p>No billing address available.</p>
                                    @endif
                                </div>

                                <div class="col">
                                    <h4 class="small-title">SHIPPING ADDRESS</h4>

                                    @if($latestOrder)
                                    @if($latestOrder->ship_to_different_address)
                                    <address>
                                        {{ $latestOrder->shipping_first_name }}
                                        {{ $latestOrder->shipping_last_name }}<br>

                                        {{ $latestOrder->shipping_address }}<br>

                                        {{ $latestOrder->shipping_city }},
                                        {{ $latestOrder->shipping_state }}
                                        {{ $latestOrder->shipping_postcode }}<br>

                                        {{ $latestOrder->shipping_country }}<br>
                                        {{ $latestOrder->shipping_phone }}
                                    </address>
                                    @else
                                    <address>
                                        Same as billing address.
                                    </address>
                                    @endif
                                    @else
                                    <p>No shipping address available.</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="account-details" role="tabpanel"
                        aria-labelledby="account-details-tab">
                        <div class="myaccount-details">
                            <form action="#" class="myaccount-form">
                                <div class="myaccount-form-inner">
                                    <div class="single-input single-input-half">
                                        <label>First Name*</label>
                                        <input type="text">
                                    </div>
                                    <div class="single-input single-input-half">
                                        <label>Last Name*</label>
                                        <input type="text">
                                    </div>
                                    <div class="single-input">
                                        <label>Email*</label>
                                        <input type="email">
                                    </div>
                                    <div class="single-input">
                                        <label>Current Password(leave blank to leave
                                            unchanged)</label>
                                        <input type="password">
                                    </div>
                                    <div class="single-input">
                                        <label>New Password (leave blank to leave
                                            unchanged)</label>
                                        <input type="password">
                                    </div>
                                    <div class="single-input">
                                        <label>Confirm New Password</label>
                                        <input type="password">
                                    </div>
                                    <div class="single-input">
                                        <button class="btn custom-btn" type="submit">
                                            <span>SAVE CHANGES</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->

                    <div class="tab-pane fade" id="account-details" role="tabpanel"
                        aria-labelledby="account-details-tab">

                        <div class="myaccount-details">

                            {{-- Success Message --}}
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            {{-- Validation Errors --}}
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form action="{{ route('account.details.update') }}"
                                method="POST" class="myaccount-form">

                                @csrf
                                @method('PUT')

                                <div class="myaccount-form-inner">

                                    

                                    <div class="single-input">
                                        <label>Full Name*</label>
                                        <input type="text" name="name"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    <div class="single-input">
                                        <label>Email*</label>
                                        <input type="email" name="email"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>

                                    <div class="single-input">
                                        <label>Current Password (leave blank to leave unchanged)</label>
                                        <input type="password" name="current_password"
                                            autocomplete="current-password">
                                    </div>

                                    <div class="single-input">
                                        <label>New Password (leave blank to leave unchanged)</label>
                                        <input type="password" name="password"
                                            autocomplete="new-password">
                                    </div>

                                    <div class="single-input">
                                        <label>Confirm New Password</label>
                                        <input type="password" name="password_confirmation"
                                            autocomplete="new-password">
                                    </div>

                                    <div class="single-input">
                                        <button class="btn custom-btn" type="submit">
                                            <span>SAVE CHANGES</span>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection