{{-- products//index.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-orange-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
        <h1 class="text-lg font-semibold mb-6 text-center">Add Product</h1>
        <form id="add-product-form" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
                <select id="category" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="" disabled selected>Select a category</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
                <input type="text" id="name" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                <input type="number" step="0.01" id="price" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea id="description" rows="4" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-medium mb-2">Images</label>
                <input type="file" id="image" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <button type="button" id="save-button" class="bg-black text-white px-6 py-2 rounded w-full">Save</button>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', async () => {
    const categorySelect = document.getElementById('category');
    try {
        const response = await fetch('/api/categories');
        if (response.ok) {
            const data = await response.json();
            const categories = Array.isArray(data.data) ? data.data : data; // Handle both raw array and API resource collection
            
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                categorySelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Failed to load categories:', error);
    }
});


        document.getElementById('save-button').addEventListener('click', async () => {
            const name = document.getElementById('name').value;
            const price = document.getElementById('price').value;
            const description = document.getElementById('description').value;
            const category = document.getElementById('category').value;
            const image = document.getElementById('image').files[0];

            if (!name || !price || !category) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Validation Error',
                    text: 'Please fill all required fields.',
                });
                return;
            }

            const formData = new FormData();
            formData.append('name', name);
            formData.append('price', price);
            formData.append('description', description);
            formData.append('category_id', category);
            if (image) formData.append('image', image);

            try {
                const response = await fetch('/api/products', {
                    method: 'POST',
                    body: formData,
                });

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Product added successfully!',
                    }).then(() => {
                        window.location.href = '/products';
                    });
                } else {
                    const error = await response.json();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Something went wrong.',
                    });
                }
            } catch (err) {
                console.error('Failed to save product', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to save the product. Please try again.',
                });
            }
        });
    </script>
</body>
</html>
