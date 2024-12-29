<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto p-8 flex">
        <!-- Left Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <div class="flex-1">
            <div class="flex justify-end mb-6">
                <a href="{{ route('categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Add Category
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                <div class="bg-white p-4 rounded shadow">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg">{{ $category->name }}</h2>
                        <div class="space-x-2">
                            <button class="bg-indigo-600 text-white px-4 py-1 rounded">
                                Edit
                            </button>
                            <button class="bg-red-600 text-white px-4 py-1 rounded">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>