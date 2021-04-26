<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products  = Product::select('name', 'id', 'description', 'price', 'slug')->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated  = $request->validate([
            'name' => 'required|unique:products,name',
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        $slug = Str::slug($validated['name']);

        $validated['slug'] = $slug;

        $product = Product::create($validated);
        
        $this->calculateDiscount($product);

        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.create', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated  = $request->validate([
            'name' => 'required|unique:products,name,' . $product->id,
            'slug' => 'required|unique:products,slug,' . $product->id,
            'price' => 'required|integer',
            'description' => 'required',
        ]);


        $product->update($validated);

        $this->calculateDiscount($product);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('product.index'));
    }

    private function calculateDiscount(Product $product)
    {
        if($product->price >= 112 && $product->price <= 115) {
            $percentage = 0.25;
            $price = $product->price;

            $discount = ($percentage / 100) * $price;

            if($product->discount()->exists()){
                $product->discount()->update(['discount' => $discount]);

            } else {

                $product->discount()->create(['discount' => $discount]);
            }
        }

        if($product->price >= 120) {
            $percentage = 0.50;
            $price = $product->price;

            $discount = ($percentage / 100) * $price;

            $product->discount()->create(['discount' => $discount]);
        }
    }
}
