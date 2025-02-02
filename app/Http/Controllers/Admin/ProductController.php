<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display all products.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a new product in MongoDB.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'category' => 'required|string',
            'quantity' => 'required|integer',
            'size' => 'nullable|string',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('products', 'public');

        // Create product
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'size' => $request->size,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully.');
    }

    /**
     * Show the form for editing a product.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update a product.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'category' => 'required|string',
            'quantity' => 'required|integer',
            'size' => 'nullable|string',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Update product
        $product->update($request->only(['name', 'price', 'description', 'category', 'quantity', 'size']));

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove a product.
     */
    public function destroy(Product $product)
    {
        // Delete image
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
