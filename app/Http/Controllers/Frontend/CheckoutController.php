<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Services\SafepayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Safepay\Webhook;
use Safepay\Exception\SignatureVerificationException;

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

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

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
                    $discount = min(
                        $discount,
                        $appliedCoupon->max_discount
                    );
                }
            } else {
                $discount = $appliedCoupon->value;
            }
        }

        $discount = min($discount, $subtotal);

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

    public function store(
        Request $request,
        SafepayService $safepayService
    ) {
        // 1. Validate checkout form.
        $validated = $request->validate([

            // Billing details
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

            // Payment methods
            'payment_method' => 'required|in:cod,bank_transfer,online',

            // Order notes
            'order_notes' => 'nullable|string',

            // Shipping details
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

        // 2. Get customer's cart.
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

        // 3. Calculate subtotal.
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shippingCost = 0;
        $discount = 0;
        $coupon = null;

        // 4. Verify coupon.
        if (session()->has('applied_coupon')) {
            $coupon = Coupon::where(
                'code',
                session('applied_coupon')
            )
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

        // 5. Calculate discount.
        if ($coupon) {
            if ($coupon->type === 'percentage') {
                $discount = ($subtotal * $coupon->value) / 100;

                if ($coupon->max_discount !== null) {
                    $discount = min(
                        $discount,
                        $coupon->max_discount
                    );
                }
            } else {
                $discount = $coupon->value;
            }
        }

        $discount = min($discount, $subtotal);

        $total = $subtotal - $discount + $shippingCost;

        // 6. Shipping checkbox.
        $differentAddress = $request->boolean(
            'ship_to_different_address'
        );

        // 7. Create order and order items.
        $order = DB::transaction(function () use (
            $validated,
            $cartItems,
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

                // Billing details
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

                // Shipping details
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

            // Save order items.
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

            // Update coupon usage.
            if ($coupon) {
                $coupon->increment('used_count');
            }

            return $order;
        });

        // 8. Online payment through Safepay.
        if ($order->payment_method === 'online') {
            try {
                $checkoutUrl = $safepayService->createCheckoutUrl(
                    $order,
                    route('payment.safepay.success', $order->id),
                    route('payment.safepay.cancel', $order->id)
                );

                Log::info('Safepay checkout URL generated', [
                    'order_id' => $order->id,
                    'url_generated' => !empty($checkoutUrl),
                    'valid_url' => filter_var($checkoutUrl, FILTER_VALIDATE_URL) !== false,
                    'url_host' => parse_url($checkoutUrl, PHP_URL_HOST),
                ]);

                // Keep cart until payment is verified.
                session()->forget('applied_coupon');

                return redirect()->away($checkoutUrl);
            } catch (\Throwable $e) {

                Log::error('Safepay checkout failed', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Safepay checkout failed. Order Number: ' . $order->order_number
                    );
            }
        }

        // 9. COD and bank transfer.
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $cart->items()->delete();
        }

        session()->forget('applied_coupon');

        return redirect()
            ->route('cart')
            ->with(
                'success',
                'Your order has been placed successfully. Order Number: ' . $order->order_number
            );
    }

    // Safepay success redirect.
    // This does NOT confirm payment.
    public function safepaySuccess(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);

        return redirect()
            ->route('cart')
            ->with(
                'success',
                'Safepay has returned you to Bucker. Your payment is awaiting server-side verification. Order Number: ' . $order->order_number
            );
    }

    // Safepay cancellation redirect.
    public function safepayCancel(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);

        return redirect()
            ->route('cart')
            ->with(
                'warning',
                'Payment was not completed. Your order remains pending. You can contact support for assistance. Order Number: ' . $order->order_number
            );
    }



    public function safepayWebhook(Request $request)
    {
        $signature = $request->header('X-SFPY-SIGNATURE');
        $secret = config('payment.safepay.webhook_secret');

        if (!$signature || !$secret) {
            Log::error('Safepay webhook: Missing signature or secret.');
            return response('Missing signature', 400);
        }

        // Safepay requires the original raw request body.
        $payload = $request->getContent();

        try {
            $event = Webhook::constructEvent(
                $payload,
                $signature,
                $secret
            );
        } catch (\UnexpectedValueException $e) {
            Log::error('Safepay invalid webhook payload: ' . $e->getMessage());
            return response('Invalid payload', 400);
        } catch (SignatureVerificationException $e) {
            Log::error('Safepay signature verification failed: ' . $e->getMessage());
            return response('Invalid signature', 400);
        }

        $eventType = $event->type ?? null;
        $payment = $event->data ?? null;

        Log::info('Safepay verified webhook received', [
            'event_type' => $eventType,
        ]);

        // Find Bucker order ID from tracker metadata.
        $metadata = $payment->metadata ?? [];

        if (is_object($metadata)) {
            $metadata = (array) $metadata;
        }

        $orderId = $metadata['order_id']
            ?? $metadata['data']['order_id']
            ?? null;

        if (!$orderId) {
            Log::error('Safepay webhook: Order ID missing.', [
                'metadata' => $metadata,
            ]);

            return response('Order ID missing', 400);
        }

        $order = Order::find($orderId);

        if (!$order || $order->payment_method !== 'online') {
            return response('Order not found', 404);
        }

        if ($eventType === 'payment.succeeded') {

            DB::transaction(function () use ($order) {

                $lockedOrder = Order::whereKey($order->id)
                    ->lockForUpdate()
                    ->first();

                if ($lockedOrder->payment_status === 'paid') {
                    return;
                }

                $lockedOrder->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed',
                ]);

                $cart = Cart::where(
                    'user_id',
                    $lockedOrder->user_id
                )->first();

                if ($cart) {
                    $cart->items()->delete();
                }
            });

            Log::info('Safepay payment marked as paid.', [
                'order_id' => $order->id,
            ]);

            return response('Payment confirmed', 200);
        }

        if ($eventType === 'payment.failed') {

            $order->update([
                'payment_status' => 'failed',
            ]);

            Log::warning('Safepay payment failed.', [
                'order_id' => $order->id,
            ]);

            return response('Payment failed recorded', 200);
        }

        return response('Event received', 200);
    }
}
