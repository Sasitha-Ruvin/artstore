<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Featured Product Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mx-auto p-8 flex">  
        
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Main Content -->
        <div class="flex-1 pl-8">
            <!-- Top Section (Button + Title) -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Featured Product Management</h1>
                <a href="{{ route('featured-products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Add Product
                </a>
            </div>

            <!-- Product List -->
            <div class="space-y-6">
                @forelse($featuredProducts as $id => $product)
                <div id="product-{{ $id }}" class="bg-white rounded-lg shadow-md p-4 flex items-center">


                    <div class="w-1/4 flex justify-center">
                        <img src="{{ $product['image'] ?? 'https://via.placeholder.com/150'}}" alt="Featured Product" class="h-40 rounded-lg object-cover">
                    </div>

                    <div class="w-1/2 px-4">
                        <h3 class="text-xl font-semibold">{{$product['name']}}</h3>
                        <p>${{ $product['price']}}</p>
                    </div>
                    
                    <div class="w-1/4 flex justify-end space-x-3">
                        <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 cursor-pointer">
                            Edit
                        </a>
                        <button type="button" onclick="confirmDelete('{{ $id}}')" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                            Remove
                        </button>
                        <form id="delete-form-{{ $id}}" action="#" method="POST" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
                @empty
                <p>No Featured Products Available</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This product will be permanently deleted!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/featured-products/${productId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Deleted!", "The Product has been removed.", "success");

                            // Find and remove the product div safely
                            let productElement = document.getElementById(`product-${productId}`);
                            if (productElement) {
                                productElement.remove();
                            } else {
                                console.warn("Product element not found in the DOM");
                            }
                        } else {
                            Swal.fire("Error!", "Something went wrong.", "error");
                        }
                    })
                    .catch(error => {
                        Swal.fire("Error!", "Failed to delete product.", "error");
                        console.error("Error:", error);
                    });
                }
            });
        }

    </script>
</body>
</html>
