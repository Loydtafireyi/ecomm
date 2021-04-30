<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\CalculateDiscount;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use CalculateDiscount;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products  = Product::select('name', 'id', 'description', 'price', 'slug', 'image')->paginate(10);

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
            'image' => 'required|image',
        ]);

        // convert name to slug
        $slug = Str::slug($validated['name']);
        $validated['slug'] = $slug;

        $product = Product::create($validated);

        // save product image
        $name = Str::random(14);
        $extension = $validated['image']->getClientOriginalExtension();
        $image = Image::make($validated['image'])->fit(720, 400)->encode($extension);
        Storage::disk('public')->put($path = "products/{$product->id}/{$name}.{$extension}", (string) $image);
        
        $product->update(['image' => "storage/$path"]);

        $this->calculateDiscount($product);

        return redirect(route('product.index'));
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
            'image' => 'nullable|image'
        ]);


        $product->update($validated);

        if ($request->hasFile('image')) {
            //delete old image
            Storage::disk('public')->delete($product->image);
            // save product image
            $name = Str::random(14);
            $extension = $validated['image']->getClientOriginalExtension();
            $image = Image::make($validated['image'])->fit(720, 400)->encode($extension);
            Storage::disk('public')->put($path = "products/{$product->id}/{$name}.{$extension}", (string) $image);
            
            $product->update(['image' => "storage/$path"]);
        }

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
        Storage::disk('public')->delete($product->image);

        $product->delete();

        return redirect(route('product.index'));
    }
}
