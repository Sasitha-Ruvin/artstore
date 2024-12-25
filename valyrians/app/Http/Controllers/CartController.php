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
