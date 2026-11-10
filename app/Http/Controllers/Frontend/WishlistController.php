<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Display customer's wishlist
    public function index()
    {
        $wishlist = \App\Models\Wishlist::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        $wishlists = $wishlist
            ? $wishlist->items
            : collect();

        return view('frontend.cart.wishlist', compact('wishlists'));
    }

    // Add a product to wishlist
    public function store(Product $product)
    {
        $user = Auth::user();

        // Get existing wishlist or create a new one
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => $user->id,
        ]);

        // Add product only if it does not already exist
        $wishlist->items()->firstOrCreate([
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Product added to your wishlist.');
    }

    // Remove a product from wishlist
    public function destroy($id)
{
    $item = WishlistItem::where('id', $id)
        ->whereHas('wishlist', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->first();

    if (!$item) {
        return redirect()
            ->route('wishlist')
            ->with('error', 'Wishlist item not found.');
    }

    $item->delete();

    return redirect()
        ->route('wishlist')
        ->with('success', 'Product removed from wishlist.');
}
}
