<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function fullwidth(Request $request)
    {
        $query = Product::where('is_active', 1);

        // Sorting
        switch ($request->input('orderby', 'default')) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;

            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            case 'name':
                $query->orderBy('name', 'asc');
                break;

            default:
                $query->latest();
                break;
        }

        // Paginate products: 12 per page
        $products = $query->paginate(12)->withQueryString();

        return view('frontend.shop.fullwidth', compact('products'));
    }

    public function leftSidebar(Request $request)
    {
        // Get active categories with active product counts
        $categories = Category::query()
            ->where('is_active', 1)
            ->withCount([
                'products' => function ($query) {
                    $query->where('is_active', 1);
                }
            ])
            ->orderBy('name')
            ->get();

        // Base product query
        $query = Product::query()
            ->where('is_active', 1);

        // Filter by category ID or category slug
        if ($request->filled('category')) {
            $category = $request->input('category');

            $query->whereHas('category', function ($categoryQuery) use ($category) {
                if (is_numeric($category)) {
                    $categoryQuery->where('id', $category);
                } else {
                    $categoryQuery->where('slug', $category);
                }
            });
        }

        // Minimum price filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->min_price);
        }

        // Maximum price filter
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        // Sorting based on the existing Blade select values
        switch ($request->input('orderby', '1')) {
            case '2':
                // Featured products first; true popularity needs sales/views data
                $query->orderByDesc('is_featured')
                    ->latest();
                break;

            case '3':
                // Newest products
                $query->orderByDesc('created_at');
                break;

            case '4':
                // Price: low to high
                $query->orderBy('price', 'asc');
                break;

            case '5':
                // Price: high to low
                $query->orderBy('price', 'desc');
                break;

            case '6':
                // Product name: Z to A
                $query->orderBy('name', 'desc');
                break;

            default:
                // Default ordering
                $query->orderByDesc('created_at');
                break;
        }

        // Total active products before filters
        $totalProducts = Product::where('is_active', 1)->count();

        // Paginate products and preserve selected filters
        $products = $query->paginate(12)->withQueryString();

        // Price limits for the sidebar
        $minProductPrice = Product::where('is_active', 1)->min('price') ?? 0;
        $maxProductPrice = Product::where('is_active', 1)->max('price') ?? 1000;

        return view('frontend.shop.left-sidebar', compact(
            'products',
            'categories',
            'totalProducts',
            'minProductPrice',
            'maxProductPrice'
        ));
    }

    public function rightSidebar(Request $request)
    {
        // Get active categories with active product counts
        $categories = Category::query()
            ->where('is_active', 1)
            ->withCount([
                'products' => function ($query) {
                    $query->where('is_active', 1);
                }
            ])
            ->orderBy('name')
            ->get();

        // Base product query
        $query = Product::query()
            ->where('is_active', 1);

        // Filter by category ID or category slug
        if ($request->filled('category')) {
            $category = $request->input('category');

            $query->whereHas('category', function ($categoryQuery) use ($category) {
                if (is_numeric($category)) {
                    $categoryQuery->where('id', $category);
                } else {
                    $categoryQuery->where('slug', $category);
                }
            });
        }

        // Minimum price filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->min_price);
        }

        // Maximum price filter
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        // Sorting based on the existing Blade select values
        switch ($request->input('orderby', '1')) {
            case '2':
                // Featured products first; true popularity needs sales/views data
                $query->orderByDesc('is_featured')
                    ->latest();
                break;

            case '3':
                // Newest products
                $query->orderByDesc('created_at');
                break;

            case '4':
                // Price: low to high
                $query->orderBy('price', 'asc');
                break;

            case '5':
                // Price: high to low
                $query->orderBy('price', 'desc');
                break;

            case '6':
                // Product name: Z to A
                $query->orderBy('name', 'desc');
                break;

            default:
                // Default ordering
                $query->orderByDesc('created_at');
                break;
        }

        // Total active products before filters
        $totalProducts = Product::where('is_active', 1)->count();

        // Paginate products and preserve selected filters
        $products = $query->paginate(12)->withQueryString();

        // Price limits for the sidebar
        $minProductPrice = Product::where('is_active', 1)->min('price') ?? 0;
        $maxProductPrice = Product::where('is_active', 1)->max('price') ?? 1000;

        return view('frontend.shop.right-sidebar', compact(
            'products',
            'categories',
            'totalProducts',
            'minProductPrice',
            'maxProductPrice'
        ));
    }

    public function listfullwidth(Request $request)
    {
        $query = Product::where('is_active', 1);

        // Sorting
        switch ($request->input('orderby', 'default')) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;

            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            case 'name':
                $query->orderBy('name', 'asc');
                break;

            default:
                $query->latest();
                break;
        }

        // Paginate products: 12 per page
        $products = $query->paginate(12)->withQueryString();

        return view('frontend.shop.list-fullwidth', compact('products'));
    }

    public function listleftSidebar(Request $request)
    {
        // Get active categories with active product counts
        $categories = Category::query()
            ->where('is_active', 1)
            ->withCount([
                'products' => function ($query) {
                    $query->where('is_active', 1);
                }
            ])
            ->orderBy('name')
            ->get();

        // Base product query
        $query = Product::query()
            ->where('is_active', 1);

        // Filter by category ID or category slug
        if ($request->filled('category')) {
            $category = $request->input('category');

            $query->whereHas('category', function ($categoryQuery) use ($category) {
                if (is_numeric($category)) {
                    $categoryQuery->where('id', $category);
                } else {
                    $categoryQuery->where('slug', $category);
                }
            });
        }

        // Minimum price filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->min_price);
        }

        // Maximum price filter
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        // Sorting based on the existing Blade select values
        switch ($request->input('orderby', '1')) {
            case '2':
                // Featured products first; true popularity needs sales/views data
                $query->orderByDesc('is_featured')
                    ->latest();
                break;

            case '3':
                // Newest products
                $query->orderByDesc('created_at');
                break;

            case '4':
                // Price: low to high
                $query->orderBy('price', 'asc');
                break;

            case '5':
                // Price: high to low
                $query->orderBy('price', 'desc');
                break;

            case '6':
                // Product name: Z to A
                $query->orderBy('name', 'desc');
                break;

            default:
                // Default ordering
                $query->orderByDesc('created_at');
                break;
        }

        // Total active products before filters
        $totalProducts = Product::where('is_active', 1)->count();

        // Paginate products and preserve selected filters
        $products = $query->paginate(12)->withQueryString();

        // Price limits for the sidebar
        $minProductPrice = Product::where('is_active', 1)->min('price') ?? 0;
        $maxProductPrice = Product::where('is_active', 1)->max('price') ?? 1000;

        return view('frontend.shop.list-left-sidebar', compact(
            'products',
            'categories',
            'totalProducts',
            'minProductPrice',
            'maxProductPrice'
        ));
    }

    public function listrightSidebar(Request $request)
    {
        // Get active categories with active product counts
        $categories = Category::query()
            ->where('is_active', 1)
            ->withCount([
                'products' => function ($query) {
                    $query->where('is_active', 1);
                }
            ])
            ->orderBy('name')
            ->get();

        // Base product query
        $query = Product::query()
            ->where('is_active', 1);

        // Filter by category ID or category slug
        if ($request->filled('category')) {
            $category = $request->input('category');

            $query->whereHas('category', function ($categoryQuery) use ($category) {
                if (is_numeric($category)) {
                    $categoryQuery->where('id', $category);
                } else {
                    $categoryQuery->where('slug', $category);
                }
            });
        }

        // Minimum price filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->min_price);
        }

        // Maximum price filter
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        // Sorting based on the existing Blade select values
        switch ($request->input('orderby', '1')) {
            case '2':
                // Featured products first; true popularity needs sales/views data
                $query->orderByDesc('is_featured')
                    ->latest();
                break;

            case '3':
                // Newest products
                $query->orderByDesc('created_at');
                break;

            case '4':
                // Price: low to high
                $query->orderBy('price', 'asc');
                break;

            case '5':
                // Price: high to low
                $query->orderBy('price', 'desc');
                break;

            case '6':
                // Product name: Z to A
                $query->orderBy('name', 'desc');
                break;

            default:
                // Default ordering
                $query->orderByDesc('created_at');
                break;
        }

        // Total active products before filters
        $totalProducts = Product::where('is_active', 1)->count();

        // Paginate products and preserve selected filters
        $products = $query->paginate(12)->withQueryString();

        // Price limits for the sidebar
        $minProductPrice = Product::where('is_active', 1)->min('price') ?? 0;
        $maxProductPrice = Product::where('is_active', 1)->max('price') ?? 1000;

        return view('frontend.shop.list-right-sidebar', compact(
            'products',
            'categories',
            'totalProducts',
            'minProductPrice',
            'maxProductPrice'
        ));
    }
}
