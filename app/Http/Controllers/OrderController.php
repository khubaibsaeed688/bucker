<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // Show customer's orders
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    //  Show customer's orders to the admin panal
    public function adminIndex()
    {
        $orders = Order::with('user', 'items')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // Show checkout page
    public function create()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->with('items.product')
            ->firstOrFail();

        return view('orders.create', compact('cart'));
    }

    // Create order from cart
    public function store(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->with('items.product')
            ->firstOrFail();

        if ($cart->items->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;

        foreach ($cart->items as $item) {
            $subtotal += $item->price * $item->quantity;
        }

        $shippingCost = 0;
        $discount = 0;
        $total = $subtotal + $shippingCost - $discount;

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'discount' => $discount,
            'total' => $total,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        foreach ($cart->items as $item) {

            $order->items()->create([
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'subtotal' => $item->price * $item->quantity,
            ]);
        }

        // Empty cart after order
        $cart->items()->delete();

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Order placed successfully.');
    }

    // Show one order
    public function show(Order $order)
    {
        abort_unless(
            $order->user_id === Auth::id(),
            403
        );

        $order->load('items.product', 'payment');

        return view('orders.show', compact('order'));
    }

    // Show one order in admin panal
    public function adminShow(Order $order)
    {
        $order->load(
            'user',
            'items.product',
            'payment'
        );

        return view('admin.orders.show', compact('order'));
    }
}
