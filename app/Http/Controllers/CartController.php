<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show cart
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $cart->load('items.product');

        return view('cart.index', compact('cart'));
    }

    // Add product to cart
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $cartItem = $cart->items()
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {

            $cartItem->increment(
                'quantity',
                $validated['quantity']
            );

        } else {

            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
                'price' => $product->sale_price ?? $product->price,
            ]);
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Product added to cart.');
    }

    // Update cart item
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('user_id', Auth::id())->firstOrFail();

        $item = $cart->items()->findOrFail($id);

        $item->update([
            'quantity' => $validated['quantity'],
        ]);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Cart updated successfully.');
    }

    // Remove item from cart
    public function destroy(string $id)
    {
        $cart = Cart::where('user_id', Auth::id())->firstOrFail();

        $item = $cart->items()->findOrFail($id);

        $item->delete();

        return redirect()
            ->route('cart.index')
            ->with('success', 'Product removed from cart.');
    }
}