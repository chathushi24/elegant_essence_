<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return response()->json($products);
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function recentProducts(){
        $recentProducts = Product::orderBy('created_at', 'desc')->limit(6)->get();
        return response()->json($recentProducts);
    }
}
