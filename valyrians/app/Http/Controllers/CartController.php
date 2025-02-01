<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Http\Resources\CartResource;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $carts = Cart::with('cartItems.product')->get();
        return CartResource::collection($carts);
    }
    public function view()
    {
        $user = auth()->user();
        // Retrieve the cart with its items and the related products for the authenticated user
        $cart = Cart::with('cartItems.product')->where('user_id', $user->id)->first();
        
        return view('cart', compact('cart'));
    }

  

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = auth()->user();

        // Find or create the cart for the user
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Check if the product is already in the cart
        $cartItem = $cart->cartItems()->where('product_id', $request->product_id)->first();

        if ($cartItem) {
            return response()->json(['message' => 'Product already in cart'], 409);
        }

        // Add item to cart
        $cart->cartItems()->create([
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Product added to cart successfully'], 201);
    }


    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $cart = Cart::create($request->all());
        return new CartResource($cart);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $cart = Cart::with('cartItems.product')->findOrFail($id);
        return new CartResource($cart);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $cart = Cart::findOrFail($id);
        $cart->update($request->all());

        return new CartResource($cart);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return response()->json(null, 204);
    }
}
