@extends('layouts.app')

@section('content')
<div class="bg-[#f9f3eb] min-h-screen">
    <!-- Banner Section -->
    <div class="relative">
        <img src="{{ asset('Images/background.jpg') }}" class="w-full h-96 object-cover" alt="Banner">
        <div class="absolute inset-0 flex flex-col justify-center items-center text-white">
            <h1 class="text-6xl font-bold">Delve into Artistry</h1>
        </div>   
    </div>

    <!-- Products Grid -->
    <div class="container mx-auto py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $pro)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden cursor-pointer"
                 onclick="openProductModal({{ json_encode($pro) }})">
                <img src="{{ $pro->image_path }}" alt="{{ $pro->name }}" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-2">{{ $pro->name }}</h2>
                    <p class="text-gray-700 truncate">{{ $pro->description }}</p>
                    <div class="mt-4 text-lg font-semibold text-gray-900">
                        ${{ number_format($pro->price, 2) }}
                    </div>
                </div>
            </div>
            @empty
                <p>No Products Available</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal for Product Details -->
<div id="productModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden w-11/12 md:w-3/4 lg:w-1/2">
        <div class="relative">
            <img id="modalProductImage" src="" alt="Product Image" class="w-full h-64 object-cover">
            <button onclick="closeProductModal()" class="absolute top-2 right-2 text-white bg-gray-800 rounded-full p-1 hover:bg-gray-700">
                &times;
            </button>
        </div>
        <div class="p-6">
            <h2 id="modalProductName" class="text-3xl font-bold mb-4"></h2>
            <p id="modalProductDescription" class="text-gray-700 mb-4"></p>
            <div id="modalProductPrice" class="text-xl font-semibold text-gray-900 mb-6"></div>
            <div class="flex justify-end">
                <button onclick="addToCartFromModal()" class="bg-[#5e4585] text-white px-4 py-2 rounded hover:bg-[#4d3a6f]">
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let currentProduct = {};
    function openProductModal(product) {
        currentProduct = product; 
        document.getElementById('modalProductImage').src = product.image_path;
        document.getElementById('modalProductName').textContent = product.name;
        document.getElementById('modalProductDescription').textContent = product.description;
        document.getElementById('modalProductPrice').textContent = '$' + parseFloat(product.price).toFixed(2);
        document.getElementById('productModal').classList.remove('hidden');
    }

    // Closes the modal
    function closeProductModal() {
        document.getElementById('productModal').classList.add('hidden');
    }
    function addToCartFromModal() {
        Swal.fire({
            title: 'Add to Cart',
            text: "Are you sure you want to add this product to your cart?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#5e4585',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/api/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('authToken'),
                    },
                    body: JSON.stringify({ product_id: currentProduct.id }),
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
                        closeProductModal();
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Unexpected response from the server.',
                            icon: 'error',
                            confirmButtonColor: '#d33'
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
        });
    }
</script>
@endsection
