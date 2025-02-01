<?php

namespace App\Http\Controllers;
use App\Models\CartItem;
use App\Http\Resources\CartItemResource;

use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cartItems = CartItem::where('cart_id', $cartId)->with('product')->get();
        return CartItemResource::collection($cartItems);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $cartItem = CartItem::create($request->all());
        return new CartItemResource($cartItem);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $cartItem = CartItem::with('product')->findOrFail($id);
        return new CartItemResource($cartItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return response()->json(null, 204);
    }
}
