<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        $relatedProducts = Product::where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->when(
                $product->category_id,
                fn ($query) => $query->where(
                    'category_id',
                    $product->category_id
                )
            )
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.product.single', compact(
            'product',
            'relatedProducts'
        ));
    }
}