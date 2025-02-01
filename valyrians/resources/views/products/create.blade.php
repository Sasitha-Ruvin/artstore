<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Product</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-orange-50 min-h-screen">
  <div class="container mx-auto p-8 flex">
    <!-- Left Sidebar (Optional) -->
    <div class="w-64 mr-8">
      <div class="bg-white p-4 rounded mb-4 shadow text-center">
        Products Management
      </div>
      <div class="bg-white p-4 rounded mb-4 shadow text-center">
        Users Management
      </div>
      <div class="bg-white p-4 rounded mb-4 shadow text-center">
        Order Management
      </div>
      <div class="bg-white p-4 rounded mb-4 shadow text-center">
        Commissions
      </div>
      <div class="bg-white p-4 rounded shadow text-center">
        Category Management
      </div>
    </div>
    <!-- Main Content -->
    <div class="flex-1 bg-white p-8 rounded shadow-md">
      <h1 class="text-lg font-semibold mb-6 text-center">Add Product</h1>
      <form id="productForm" enctype="multipart/form-data">
        <div class="mb-4">
          <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
          <select id="category" name="category_id" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="" disabled selected>Select a category</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-4">
          <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
          <input type="text" id="name" name="name" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div class="mb-4">
          <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
          <input type="number" step="0.01" id="price" name="price" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div class="mb-4">
          <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
          <textarea id="description" name="description" rows="4" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
        </div>
        <div class="mb-4">
          <label for="image" class="block text-gray-700 font-medium mb-2">Images</label>
          <input type="file" id="image" name="image" class="w-full bg-gray-200 border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <button type="submit" id="save-button" class="bg-black text-white px-6 py-2 rounded w-full">Save</button>
      </form>

      <!-- Optional error display -->
      @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>
  </div>

  <script>
    document.getElementById('productForm').addEventListener('submit', async function(event) {
      event.preventDefault(); // Prevent the default form submission

      // Collect form values
      const categoryId = document.getElementById('category').value;
      const name = document.getElementById('name').value;
      const price = document.getElementById('price').value;
      const description = document.getElementById('description').value;
      const imageInput = document.getElementById('image');
      const imageFile = imageInput.files[0];

      // Simple validation check
      if (!categoryId || !name || !price) {
        Swal.fire({
          icon: 'warning',
          title: 'Validation Error',
          text: 'Please fill in the required fields (Category, Name, Price).'
        });
        return;
      }

      // Build FormData to send file and other form data
      const formData = new FormData();
      formData.append('category_id', categoryId);
      formData.append('name', name);
      formData.append('price', price);
      formData.append('description', description);
      if (imageFile) {
        formData.append('image', imageFile);
      }

      try {
        const response = await fetch('/api/products', {
          method: 'POST',
          headers: {
            // Let the browser set the appropriate Content-Type with boundaries when using FormData
            'Accept': 'application/json'
          },
          body: formData
        });

        if (response.ok) {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Product added successfully!'
          }).then(() => {
            // Redirect or clear form as needed; here we redirect to the products listing page
            window.location.href = '/products';
          });
        } else {
          const error = await response.json();
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'Something went wrong.'
          });
        }
      } catch (err) {
        console.error(err);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Failed to save the product. Please try again.'
        });
      }
    });
  </script>
</body>
</html>
