<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Kreait\Laravel\Firebase\Facades\Firebase;

class ProductController extends Controller
{
    /**
     * Firebase storage instance.
     */
    private $storage;

    public function __construct()
    {
        // Initialize the Firebase storage instance.
        $this->storage = Firebase::storage();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        // Validate the request.
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();

        // Upload image to Firebase Storage if provided.
        if ($request->hasFile('image')) {
            $data['image_path'] = $this->handleImageUpload($request);
        }

        $product = Product::create($data);

        if ($request->wantsJson()) {
            return response()->json(new ProductResource($product), 201);
        }

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validate the request; all fields are optional.
        $request->validate([
            'name'        => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        // Retrieve only provided fields.
        $data = $request->only(['name', 'description', 'price', 'category_id']);

        // If a new image is provided, upload it to Firebase and update the image_path.
        if ($request->hasFile('image')) {
            $data['image_path'] = $this->handleImageUpload($request);
        }

        $product->update($data);

        if ($request->wantsJson()) {
            return response()->json(new ProductResource($product), 200);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }

    /**
     * Handle image upload to Firebase Storage and return the public URL.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();

            // Get the Firebase Storage bucket.
            $bucket = $this->storage->getBucket();
            $fileStream = fopen($file->getRealPath(), 'r');

            // Upload the image to Firebase Storage under the 'images' folder.
            $bucket->upload($fileStream, [
                'name'          => 'images/' . $fileName,
                'predefinedAcl' => 'publicRead',
            ]);

            // Generate and return the public URL.
            $publicUrl = "https://storage.googleapis.com/{$bucket->name()}/images/{$fileName}";
            return $publicUrl;
        }

        return null;
    }
}
