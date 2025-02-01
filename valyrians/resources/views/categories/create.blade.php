<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Create Category</title>
   <script src="https://cdn.tailwindcss.com"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto p-8 flex">
        <!-- Left Sidebar (Fixed Width) -->
            <x-sidebar />

 
        <!-- Main Content (Takes Remaining Space) -->
        <div class="flex-1 p-8">
            <h1 class="text-lg font-semibold mb-4">Category Name</h1>
            <div class="flex items-center">
                <input id="name" type="text" class="w-full max-w-lg bg-gray-200 border border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button class="bg-purple-600 text-white px-6 py-2 rounded-full ml-4" id="save-button">
                    Save
                </button>
            </div>
        </div>
    </div>

   <script>
       document.getElementById('save-button').addEventListener('click', async function() {
           const name = document.getElementById('name')?.value;

           if (!name) {
               Swal.fire({
                   icon: 'warning',
                   title: 'Validation Error',
                   text: 'Category name is required.',
               });
               return;
           }

           // Retrieve the auth token from localStorage
           const token = localStorage.getItem('authToken');
           if (!token) {
               Swal.fire({
                   icon: 'error',
                   title: 'Unauthorized',
                   text: 'You must be logged in to perform this action.',
               });
               return;
           }

           try {
               const response = await fetch('/api/categories', {
                   method: 'POST',
                   headers: {
                       'Content-Type': 'application/json',
                       'Accept': 'application/json',
                       // Include the token in the Authorization header
                       'Authorization': 'Bearer ' + token,
                   },
                   body: JSON.stringify({ name }),
               });

               if (response.ok) {
                   Swal.fire({
                       icon: 'success',
                       title: 'Success',
                       text: 'Category added successfully!',
                   }).then(() => {
                       window.location.href = '/categories';
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
               console.error(err);
               Swal.fire({
                   icon: 'error',
                   title: 'Error',
                   text: 'Failed to save the category. Please try again.',
               });
           }
       });
   </script>
</body>
</html>
