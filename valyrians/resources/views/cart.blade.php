{{-- resources/views/cart.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Your Cart</h1>

    @if($cart && $cart->cartItems->count())
        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 text-left">Product</th>
                    <th class="py-3 px-4 text-left">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->cartItems as $item)
                    <tr class="border-b">
                        <td class="py-3 px-4">
                            {{-- Assuming your product has a 'name' attribute --}}
                            {{ $item->product->name ?? 'Unknown Product' }}
                        </td>
                        <td class="py-3 px-4">
                            {{-- Assuming your product has a 'price' attribute --}}
                            ${{ number_format($item->product->price, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600">Your cart is empty.</p>
    @endif
</div>
@endsection
