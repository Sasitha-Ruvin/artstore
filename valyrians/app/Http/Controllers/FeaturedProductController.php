<?php

namespace App\Http\Controllers;

use App\Models\FeaturedProduct;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Str;
use Kreait\Firebase\Contract\Storage;
use Illuminate\Http\Request;

class FeaturedProductController extends Controller
{
    private $database;
    private $storage;

    public function __construct()
    {
        $this->database = Firebase::database();
        $this->storage = Firebase::storage();
    }

    public function index()
    {
        $featuredProducts = $this->database->getReference('featured')->getValue();

        return view('featured_product.index', compact('featuredProducts'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate($this->getValidationRules());

        // Handle image upload and get the signed URL
        $imageUrl = $this->handleImageUpload($request);

        // Prepare the product data
        $featuredData = array_merge($validateData, ['image' => $imageUrl]);

        // Store the item in Firebase

        $newFeatured = $this->database->getReference('featured')->push($featuredData);

        $response = [
            'message' => "Item created Successfully",
            'product' => $featuredData,
            'id' => $newFeatured->getKey(),
        ];

        if($request->is('api/*')){
            return response()->json($response,201);
        }
    }

    public function show(Request $request, $id)
    {
        $featuredProduct = $this->database->getReference('featured/' .$id)->getValue();

        if(!$featuredProduct){
            abort(404,"Featured product not found");
        }

        $imageUrl = isset($featuredProduct['image'])&& !empty($featuredProduct['image'])
        ? $featuredProduct['image']
        : 'https://via.placeholder.com/150';

        if($request->is('api/*')){
            return response()->json([
                'status'=>'success',
                'message'=>'Featured product retrieved',
                'data'=> $featuredProduct,
            ], 200);
        }
        return view("featured_product.index",compact('featuredProduct','imageUrl'));
    }

        public function create()
    {
        return view('featured_product.create');
    }
    public function destroy($id)
{
    $productRef = $this->database->getReference('featured/' . $id);

    if ($productRef->getValue()) {
        $productRef->remove(); // Delete from Firebase

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Product not found'
        ], 404);
    }
}



    /**
     * Handle image upload and return a signed URL
     * 
     *  @param \Illuminate\Http\Request $request
     *  @return string|null
     */

     private function handleImageUpload(Request $request)
     {
        if ($request->hasFile('image')){
            $file = $request->file('image');

            $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();

            // Upload the image to Firebase Storage
            $bucket = $this->storage->getBucket();
            $fileStream = fopen($file->getRealPath(), 'r');
            $object = $bucket->upload($fileStream, [
                'name' => 'images/' . $fileName,
                'predefinedAcl' => 'publicRead',
            ]);

            // Generate the public URL
            $publicUrl = "https://storage.googleapis.com/{$bucket->name()}/images/{$fileName}";
            return $publicUrl;

        }
        return null;
    }

    /**
     * Get the validation rules for storing/updating items.
     *
     * @return array
     */

    private function getValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'description'=> 'required|string|max:255',
            'price'=>'required|numeric',
            'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

       
}
