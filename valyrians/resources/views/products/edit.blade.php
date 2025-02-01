<!-- resources/views/products/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
        <h1 class="text-lg font-semibold mb-6 text-center">Edit Product</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')  

            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
                <select name="category_id" id="category" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="" disabled>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $product->price) }}" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea id="description" name="description" rows="4" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-medium mb-2">Product Image</label>
                <input type="file" id="image" name="image" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            @if ($product->image_path)
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Current Image</label>
                    <img src="{{ $pro->image_path }}" alt="Product Image" class="w-32 h-32 object-cover">
                </div>
            @endif

            <button type="submit" class="bg-black text-white px-6 py-2 rounded w-full">Update Product</button>
        </form>
    </div>
</body>
</html>
