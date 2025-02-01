@extends('layouts.app')

@section('content')
<div class="bg-[#f9f3eb] min-h-screen">
    <div class="relative">
        <img src="{{ asset('Images/background.jpg') }}" class="w-full h-96 object-cover" alt="Banner">
        <div class="absolute inset-0 flex flex-col justify-center items-center text-white">
            <h1 class="text-6xl font-bold">Delve into Artistry</h1>
        </div>   
    </div>
    <div class="container mx-auto py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $pro)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden cursor-pointer"
            onclick="">
                <img src="{{ $pro->image_path }}"  alt="{{ $pro->name}}" class="w-full h-64 object-cover">
                <div class="p-6">
                <h2 class="text-2xl font-bold mb-2">{{ $pro->name}}</h2>
                <p class="text-gray-700">{{ $pro->description}}</p>
                <div class="mt-4 text-lg font-semibold text-gray-900">${{ $pro->price }}</div>
                <div class="flex justify-between items-center mt-4">
                    <button onclick="addToCart({{ $pro->id }})" class="bg-[#5e4585] text-white px-4 py-2 rounded hover:bg-[#4d3a6f]">
                        Add to Cart
                    </button>
                    <script>
                        function addToCart(productId) {
                            fetch('/api/cart/add', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Authorization': 'Bearer ' + localStorage.getItem('authToken'), 
                                },
                                body: JSON.stringify({ product_id: productId }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.message) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonColor: '#5e4585'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something went wrong. Please try again.',
                                    icon: 'error',
                                    confirmButtonColor: '#d33'
                                });
                            });
                        }
                    </script>
                    
                    <button class="text-black text-2xl">
                        <i class="far fa-hart"></i>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <p>No Products Available</p>
        @endforelse
        </div>
    </div>

</div>
@endsection

