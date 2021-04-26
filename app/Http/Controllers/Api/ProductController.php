<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('name', 'id', 'slug', 'description', 'price')->get();

        return ProductResource::collection($products);
    }

    public function show(Request $request, Product $product)
    {
        return new ProductResource($product);
    }
}
