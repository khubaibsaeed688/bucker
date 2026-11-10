<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', 1)
            ->take(4)
            ->get();

        $products = Product::where('is_active', 1)
            ->where('is_featured', 1)
            ->take(8)
            ->get();

        $featuredProducts = Product::where('is_active', 1)
            ->where('is_featured', 1)
            ->latest()
            ->take(8)
            ->get();

        $bestSellerProducts = Product::where('is_active', 1)
            ->where('is_featured', 1)
            ->take(8)
            ->get();

        $newProducts = Product::where('is_active', 1)
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.home.index', compact('categories', 'products', 'featuredProducts', 'bestSellerProducts', 'newProducts'));
    }

    public function homeTwo()
    {
        $categories = Category::where('is_active', 1)
            ->take(4)
            ->latest()
            ->get();

        $categorieses = Category::where('is_active', 1)
            ->withCount('products')
            ->take(8)
            ->get();

        $products = Product::where('is_active', 1)
            ->where('is_featured', 1)
            ->take(8)
            ->get();

        $featuredProducts = Product::where('is_active', 1)
            ->where('is_featured', 1)
            ->latest()
            ->take(8)
            ->get();

        $bestSellerProducts = Product::where('is_active', 1)
            ->where('is_featured', 1)
            ->take(8)
            ->get();

        $newProducts = Product::where('is_active', 1)
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.home.index-two', compact(
            'categories',
            'products',
            'featuredProducts',
            'bestSellerProducts',
            'newProducts',
            'categorieses'
        ));
    }
}
