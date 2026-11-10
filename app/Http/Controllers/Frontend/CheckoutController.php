<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        $cartItems = $cart
            ? $cart->items->filter(fn($item) => $item->product !== null)
            : collect();

        if ($cartItems->isEmpty()) {
            return redirect()
                ->route('cart')
                ->with('error', 'Your cart is empty.');
        }

        // Calculate subtotal
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Coupon calculation
        $discount = 0;
        $appliedCoupon = null;

        if (session()->has('applied_coupon')) {

            $appliedCoupon = Coupon::where(
                'code',
                session('applied_coupon')
            )->where('is_active', true)->first();

            if (
                !$appliedCoupon ||
                ($appliedCoupon->starts_at && now()->lt($appliedCoupon->starts_at)) ||
                ($appliedCoupon->expires_at && now()->gt($appliedCoupon->expires_at)) ||
                ($appliedCoupon->usage_limit !== null &&
                    $appliedCoupon->used_count >= $appliedCoupon->usage_limit) ||
                $subtotal < $appliedCoupon->min_order_amount
            ) {
                session()->forget('applied_coupon');
                $appliedCoupon = null;
            }
        }

        if ($appliedCoupon) {

            if ($appliedCoupon->type === 'percentage') {
                $discount = ($subtotal * $appliedCoupon->value) / 100;

                if ($appliedCoupon->max_discount !== null) {
                    $discount = min($discount, $appliedCoupon->max_discount);
                }
            } else {
                $discount = $appliedCoupon->value;
            }
        }

        $discount = min($discount, $subtotal);

        // Shipping is currently free
        $shippingCost = 0;

        $total = $subtotal - $discount + $shippingCost;

        return view('frontend.cart.checkout', compact(
            'cartItems',
            'subtotal',
            'discount',
            'shippingCost',
            'total',
            'appliedCoupon'
        ));
    }



    public function store(Request $request)
    {
        // Step 1: Validate form data
        $validated = $request->validate([

            // Billing Details
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postcode' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',

            // Payment
            'payment_method' => 'required|in:cod,bank_transfer,paypal',

            // Order Notes
            'order_notes' => 'nullable|string',

            // Shipping
            'ship_to_different_address' => 'nullable|boolean',

            'shipping_first_name' => 'required_if:ship_to_different_address,1|nullable|string|max:255',
            'shipping_last_name' => 'required_if:ship_to_different_address,1|nullable|string|max:255',
            'shipping_country' => 'required_if:ship_to_different_address,1|nullable|string|max:255',
            'shipping_address' => 'required_if:ship_to_different_address,1|nullable|string|max:255',
            'shipping_city' => 'required_if:ship_to_different_address,1|nullable|string|max:255',
            'shipping_state' => 'required_if:ship_to_different_address,1|nullable|string|max:255',
            'shipping_postcode' => 'required_if:ship_to_different_address,1|nullable|string|max:20',
            'shipping_phone' => 'nullable|string|max:30',
        ]);

        // Step 2: Get customer cart
        $cart = Cart::with('items.product')
            ->where('user_id', auth()->id())
            ->first();

        $cartItems = $cart
            ? $cart->items->filter(fn($item) => $item->product !== null)
            : collect();

        if ($cartItems->isEmpty()) {
            return redirect()
                ->route('cart')
                ->with('error', 'Your cart is empty.');
        }

        // Step 3: Calculate subtotal from cart
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shippingCost = 0;
        $discount = 0;
        $coupon = null;

        // Step 4: Verify applied coupon
        if (session()->has('applied_coupon')) {

            $coupon = Coupon::where('code', session('applied_coupon'))
                ->where('is_active', true)
                ->lockForUpdate()
                ->first();

            if (
                !$coupon ||
                ($coupon->starts_at && now()->lt($coupon->starts_at)) ||
                ($coupon->expires_at && now()->gt($coupon->expires_at)) ||
                ($coupon->usage_limit !== null &&
                    $coupon->used_count >= $coupon->usage_limit) ||
                $subtotal < $coupon->min_order_amount
            ) {
                $coupon = null;
                session()->forget('applied_coupon');
            }
        }

        // Step 5: Calculate discount
        if ($coupon) {

            if ($coupon->type === 'percentage') {
                $discount = ($subtotal * $coupon->value) / 100;

                if ($coupon->max_discount !== null) {
                    $discount = min($discount, $coupon->max_discount);
                }
            } else {
                $discount = $coupon->value;
            }
        }

        $discount = min($discount, $subtotal);

        $total = $subtotal - $discount + $shippingCost;

        // Step 6: Check shipping address checkbox
        $differentAddress = $request->boolean(
            'ship_to_different_address'
        );

        // Step 7: Save order and order items
        $order = DB::transaction(function () use (
            $validated,
            $cartItems,
            $cart,
            $subtotal,
            $shippingCost,
            $discount,
            $total,
            $differentAddress,
            $coupon
        ) {

            $order = Order::create([

                'user_id' => Auth::id(),

                'order_number' => 'ORD-' . strtoupper(Str::random(6)),

                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'discount' => $discount,
                'total' => $total,

                'status' => 'pending',
                'payment_status' => 'pending',

                // Billing Details
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'company' => $validated['company'] ?? null,
                'country' => $validated['country'],
                'address' => $validated['address'],
                'address_line_2' => $validated['address_line_2'] ?? null,
                'city' => $validated['city'],
                'state' => $validated['state'],
                'postcode' => $validated['postcode'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],

                'order_notes' => $validated['order_notes'] ?? null,
                'payment_method' => $validated['payment_method'],

                // Shipping Details
                'ship_to_different_address' => $differentAddress,

                'shipping_first_name' => $differentAddress
                    ? $validated['shipping_first_name']
                    : null,

                'shipping_last_name' => $differentAddress
                    ? $validated['shipping_last_name']
                    : null,

                'shipping_country' => $differentAddress
                    ? $validated['shipping_country']
                    : null,

                'shipping_address' => $differentAddress
                    ? $validated['shipping_address']
                    : null,

                'shipping_city' => $differentAddress
                    ? $validated['shipping_city']
                    : null,

                'shipping_state' => $differentAddress
                    ? $validated['shipping_state']
                    : null,

                'shipping_postcode' => $differentAddress
                    ? $validated['shipping_postcode']
                    : null,

                'shipping_phone' => $differentAddress
                    ? ($validated['shipping_phone'] ?? null)
                    : null,
            ]);

            // Save each cart item as an order item
            foreach ($cartItems as $item) {

                $itemSubtotal = $item->price * $item->quantity;

                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            // Update coupon usage
            if ($coupon) {
                $coupon->increment('used_count');
            }

            // Empty customer cart
            $cart->items()->delete();

            return $order;
        });

        // Step 8: Clear applied coupon
        session()->forget('applied_coupon');

        return redirect()
            ->route('cart')
            ->with('success', 'Your order has been placed successfully. Order Number: ' . $order->order_number);
    }
}
