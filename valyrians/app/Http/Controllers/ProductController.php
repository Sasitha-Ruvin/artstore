<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->get();
        return ProductResource::collection($products);
    }

    public function getProductsForView()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

   
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();  // Fetch all categories
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }
    
        $product = Product::create($data);
    
        return response()->json(new ProductResource($product), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::with('category')->findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            // If there's a new image, handle the file upload
            if ($product->image_path && Storage::exists('public/' . $product->image_path)) {
                Storage::delete('public/' . $product->image_path); // Delete the old image if it exists
            }
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }
        
        // Update the product
        $product->update($data);

        $product->update($request->except('_token'));

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}
