<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    <div class="container mx-auto p-8 flex">
        <!-- Left Sidebar -->
        <x-sidebar/>

        <!-- Main Content -->
        <div class="flex-1">
            <h1 class="text-center text-2xl justify-center mb-5">Product Management</h1>
            <div class="flex justify-end mb-6">
                <a href="{{ route('products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Add Product
                </a>
            </div>
            
            <div class="space-y-6">
                @forelse($products as $pro)
                    <div class="bg-white rounded-lg shadow-md p-4 flex items-center">
                        <!-- Product Image -->
                        <div class="w-1/4 flex justify-center">
                            <img src="{{ $pro->image_path }}" alt="IMG" class="h-40 rounded-lg object-cover">

                        </div>
    
                        <!-- Product Details -->
                        <div class="w-1/2 px-4">
                            <h3 class="text-xl font-semibold">{{ $pro->name }}</h3>
                            <p class="text-gray-600 mt-2">{{ $pro->description }}</p>
                        </div>
    
                        <!-- Actions (Edit and Delete) -->
                        <div class="w-1/4 flex justify-end space-x-3">
                            <a href="{{ route('products.edit', $pro->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Edit
                            </a>
                            
    
                            <!-- Delete Button with Confirmation -->
                            <button type="button" onclick="confirmDelete({{ $pro->id }})" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                Remove
                            </button>
    
                            <!-- Hidden delete form for the product -->
                            <form id="delete-form-{{ $pro->id }}" action="{{ route('products.destroy', $pro->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No products available.</p>
                @endforelse
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                document.getElementById('delete-form-' + productId).submit();
            }
        }
    </script>
</body>
</html>