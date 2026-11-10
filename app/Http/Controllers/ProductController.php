<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Show all products
    public function index(Request $request)
    {
        // $products = Product::with('category')->latest()->paginate(6);

        $products = Product::with('category')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::where('is_active', true)->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|max:255|unique:products,sku',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1048',
            'is_active' => 'required|in:0,1',
        ]);

        // Auto generate slug
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('main_image')) {

            $imageName = time() . '.' .
                $request->main_image->extension();

            $request->main_image->move(
                public_path('uploads/products'),
                $imageName
            );

            $validated['main_image'] = $imageName;
        }

        $validated['is_featured'] = $request->has('is_featured');
        // $validated['is_active'] = true;

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    // Show single product
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // Show edit form
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();

        return view('admin.products.edit', compact(
            'product',
            'categories'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|max:255|unique:products,sku,' . $product->id,
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'required|in:0,1',
        ]);

        // Auto generate slug
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('main_image')) {

            $imageName = time() . '.' .
                $request->main_image->extension();

            $request->main_image->move(
                public_path('uploads/products'),
                $imageName
            );

            $validated['main_image'] = $imageName;
        }

        $validated['is_featured'] = $request->has('is_featured');

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    // Export product
    public function export()
    {
        $products = Product::with('category')->get();

        $filename = 'products-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $columns = [
            'ID',
            'Product Name',
            'Category',
            'SKU',
            'Price',
            'Sale Price',
            'Stock',
            'Featured',
            'Status',
            'Created At',
        ];

        $callback = function () use ($products, $columns) {

            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->name,
                    $product->category->name ?? 'N/A',
                    $product->sku,
                    $product->price,
                    $product->sale_price ?? '',
                    $product->stock,
                    $product->is_featured ? 'Yes' : 'No',
                    $product->is_active ? 'Active' : 'Inactive',
                    $product->created_at->format('Y-m-d'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Import product
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');

        $handle = fopen($file->getRealPath(), 'r');

        if (!$handle) {
            return back()->with('error', 'Unable to read the CSV file.');
        }

        // Read CSV header
        $header = fgetcsv($handle);

        $expectedHeader = [
            'name',
            'category',
            'description',
            'price',
            'sale_price',
            'stock',
            'sku',
            'main_image',
            'is_featured',
            'is_active',
        ];

        if ($header !== $expectedHeader) {

            fclose($handle);

            return back()->with(
                'error',
                'Invalid CSV format. Please use the correct template.'
            );
        }

        $imported = 0;
        $skipped = 0;

        while (($row = fgetcsv($handle)) !== false) {

            if (count($row) !== count($expectedHeader)) {
                $skipped++;
                continue;
            }

            $data = array_combine($expectedHeader, $row);

            // Check required fields
            if (
                empty($data['name']) ||
                empty($data['category']) ||
                empty($data['price']) ||
                empty($data['stock']) ||
                empty($data['sku'])
            ) {
                $skipped++;
                continue;
            }

            // Check duplicate SKU
            if (Product::where('sku', $data['sku'])->exists()) {
                $skipped++;
                continue;
            }

            // Find category
            $category = Category::where('name', $data['category'])->first();

            if (!$category) {
                $skipped++;
                continue;
            }

            $slug = Str::slug($data['name']);

            if (Product::where('slug', $slug)->exists()) {
                return back()->withErrors([
                    "Product '{$data['name']}' already exists."
                ]);
            }

            Product::create([
                'category_id' => $category->id,
                'name' => $data['name'],
                'slug' => $slug,
                'description' => $data['description'] ?? null,
                'price' => $data['price'],
                'sale_price' => !empty($data['sale_price'])
                    ? $data['sale_price']
                    : null,
                'stock' => $data['stock'],
                'sku' => $data['sku'],
                'main_image' => $data['main_image'] ?? null,
                'is_featured' => (int) $data['is_featured'],
                'is_active' => (int) $data['is_active'],
            ]);

            $imported++;
        }

        fclose($handle);

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                "$imported products imported successfully. $skipped rows skipped."
            );
    }
}
