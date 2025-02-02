<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8 flex">
        <!-- Sidebar -->
        <x-sidebar class="w-1/4"/>

        <!-- Main Content -->
        <div class="w-3/4 space-y-6">
            <!-- Cards Section -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Total Products Card -->
                <div class="bg-white shadow-lg p-6 rounded-lg text-center">
                    <h2 class="text-2xl font-bold text-gray-700">Total Products</h2>
                    <p class="text-4xl font-extrabold text-blue-600">{{ $totalProducts }}</p>
                </div>

                <!-- Total Users Card -->
                <div class="bg-white shadow-lg p-6 rounded-lg text-center">
                    <h2 class="text-2xl font-bold text-gray-700">Total Users</h2>
                    <p class="text-4xl font-extrabold text-green-600">{{ $totalUsers }}</p>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="bg-white shadow-lg p-6 rounded-lg">
                <h2 class="text-2xl font-bold text-gray-700 mb-4">Products by Category</h2>
                {!! $categoryChart->container() !!}
            </div>

            <!-- Frequency Chart -->
            <div class="bg-white shadow-lg p-6 rounded-lg">
                <h2 class="text-2xl font-bold text-gray-700 mb-4">Product Addition Frequency</h2>
                {!! $frequencyChart->container() !!}
            </div>
        </div>
    </div>

    <!-- Chart Scripts -->
    {!! $categoryChart->script() !!}
    {!! $frequencyChart->script() !!}
</body>
</html>
