<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Show single product details
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function recentProducts()
    {
        $recentProducts = Product::orderBy('created_at', 'desc')->limit(6)->get();
        return view('products.recent', compact('recentProducts'));
    }
}
