<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Show wishlist
    public function index()
    {
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $wishlist->load('items.product');

        return view('wishlist.index', compact('wishlist'));
    }

    // Add product to wishlist
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $exists = $wishlist->items()
            ->where('product_id', $product->id)
            ->exists();

        if (!$exists) {
            $wishlist->items()->create([
                'product_id' => $product->id,
            ]);
        }

        return redirect()
            ->route('wishlist.index')
            ->with('success', 'Product added to wishlist.');
    }

    // Remove product from wishlist
    public function destroy(string $id)
    {
        $wishlist = Wishlist::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        $item = $wishlist->items()->findOrFail($id);

        $item->delete();

        return redirect()
            ->route('wishlist.index')
            ->with('success', 'Product removed from wishlist.');
    }
}