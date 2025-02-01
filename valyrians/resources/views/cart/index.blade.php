@extends('layout.app')

@section('content')
<div class="container mx-auto p-8 bg-orange-50 min-h-screen flex justify-center">
    <div class="text-center text-2xl font-semibold mb-6">Cart Summary</div>
    @foreach($cartItems as $item)
    <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg mb-4">
        <div class="flex-1 ml-4">
            <h2 class="font-bold">{{ $item->product->name}}</h2>
            <p class="text-sm text-gray-600">{{ $item->product->description}}</p>
        </div>
        <div class="text-right">
            <p class="text-lg font-semibold">{{ $item->product->price}}$</p>
            <form action="{{route('cart.remove',$item->id)}}" method="POST">
                @csrf_token
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded mt-2">Remove</button>
            </form>
        </div>
    </div>
    @endforeach
    <div class="text-right mt-6">
        <p class="text-lg"><span class="font-semibold">$5</span></p>
        <p class="text-lg font-semibold">Total: {{ $totalPrice + 5 }}$</p>
        <button class="bg-black text-white px-6 py-2 rounded mt-4">Confirm</button>
    </div>
</div>