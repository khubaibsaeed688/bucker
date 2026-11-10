<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        $cartItems = $cart
            ? $cart->items->filter(fn($item) => $item->product !== null)
            : collect();

        $subtotal = $cartItems->sum(function ($item) {
            $product = $item->product;

            $price = $product->sale_price ?? $product->price;

            return $price * $item->quantity;
        });

        $total = $subtotal;

        return view('frontend.cart.index', compact(
            'cartItems',
            'subtotal',
            'total'
        ));
    }

    // Add product to cart
    public function store(Product $product)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        // Product price
        $price = $product->sale_price ?? $product->price;

        // Check if product already exists in cart
        $item = $cart->items()
            ->where('product_id', $product->id)
            ->first();

        if ($item) {

            // Increase quantity
            $item->increment('quantity');
        } else {

            // Create new cart item
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $price,
            ]);
        }

        return back()->with('success', 'Product added to cart.');
    }

    // Update product quantity
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item = CartItem::where('id', $id)
            ->whereHas('cart', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $item->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()
            ->route('cart')
            ->with('success', 'Cart updated successfully.');
    }

    // Remove product from cart
    public function destroy($id)
    {
        $item = CartItem::where('id', $id)
            ->whereHas('cart', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $item->delete();

        return redirect()
            ->route('cart')
            ->with('success', 'Product removed from cart.');
    }
}
