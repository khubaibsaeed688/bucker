<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    // Show all images of a product
    public function index(Product $product)
    {
        $images = $product->images()->latest()->get();

        return view('products.images.index', compact('product', 'images'));
    }

    // Show upload form
    public function create(Product $product)
    {
        return view('products.images.create', compact('product'));
    }

    // Store image
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/products'),
                $imageName
            );

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $imageName,
                'sort_order' => $validated['sort_order'] ?? 0,
            ]);
        }

        return redirect()
            ->route('products.images.index', $product)
            ->with('success', 'Product image uploaded successfully.');
    }

    // Show one image
    public function show(Product $product, ProductImage $image)
    {
        return view('products.images.show', compact('product', 'image'));
    }

    // Show edit form
    public function edit(Product $product, ProductImage $image)
    {
        return view('products.images.edit', compact('product', 'image'));
    }

    // Update image information
    public function update(
        Request $request,
        Product $product,
        ProductImage $image
    ) {
        $validated = $request->validate([
            'sort_order' => 'required|integer|min:0',
        ]);

        $image->update($validated);

        return redirect()
            ->route('products.images.index', $product)
            ->with('success', 'Product image updated successfully.');
    }

    // Delete image
    public function destroy(Product $product, ProductImage $image)
    {
        $image->delete();

        return redirect()
            ->route('products.images.index', $product)
            ->with('success', 'Product image deleted successfully.');
    }
}