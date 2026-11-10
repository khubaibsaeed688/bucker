<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(6);

        return view('admin.categories.index', compact('categories'));
    }

    // Show create form
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store category
    public function store(Request $request)
    {
        //  Auto-generate slug from name if not provided
        $request->merge([
            'slug' => $request->filled('slug')
                ? Str::slug($request->slug)
                : Str::slug($request->name),
        ]);

        // Validate request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'is_active' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // Upload image
        if ($request->hasFile('image')) {

            $imageName = time() . '.' .
                $request->image->extension();

            $request->image->move(
                public_path('uploads/categories'),
                $imageName
            );

            $validated['image'] = $imageName;
        }

        // Active by default
        // $validated['is_active'] = true;

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    // Show single category
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    // Show edit form
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // No 'slug' validation needed!
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'required|in:0,1',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
                unlink(public_path('uploads/categories/' . $category->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
            $validated['image'] = $imageName;
        }

        // Model automatically updates slug if 'name' changed
        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    // Export CSV
    public function export()
    {
        $categories = Category::latest()->get();

        $filename = 'categories-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($categories) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'name',
                'description',
                'image',
                'is_active',
            ]);

            foreach ($categories as $category) {
                fputcsv($file, [
                    $category->name,
                    $category->description,
                    $category->image,
                    $category->is_active ? 1 : 0,
                ]);
            }

            fclose($file);
        };

        return response()->stream(
            $callback,
            200,
            $headers
        );
    }

    // Import page
    public function importForm()
    {
        return view('categories.import');
    }

    // Import CSV
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = fopen($request->file('file')->getRealPath(), 'r');

        $header = fgetcsv($file);

        $expectedHeader = [
            'name',
            'description',
            'image',
            'is_active',
        ];

        if ($header !== $expectedHeader) {
            fclose($file);

            return back()->withErrors([
                'file' => 'Invalid CSV format.',
            ]);
        }

        $imported = 0;
        $errors = [];
        $rowNumber = 1;

        while (($row = fgetcsv($file)) !== false) {

            $rowNumber++;

            $data = array_combine($expectedHeader, $row);

            if (empty($data['name'])) {
                $errors[] = "Row {$rowNumber}: Category name is required.";
                continue;
            }

            $slug = Str::slug($data['name']);

            if (Category::where('slug', $slug)->exists()) {
                $errors[] = "Row {$rowNumber}: Category '{$data['name']}' already exists.";
                continue;
            }

            Category::create([
                'name' => $data['name'],
                'slug' => $slug,
                'description' => $data['description'] ?? null,
                'image' => $data['image'] ?? null,
                'is_active' => (int) $data['is_active'],
            ]);

            $imported++;
        }

        fclose($file);

        return redirect()
            ->route('admin.categories.index')
            ->with([
                'success' => "{$imported} categories imported successfully.",
                'import_errors' => $errors,
            ]);
    }
}
