<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container mx-auto py-8">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar -->
            <div class="w-full md:w-1/4">
                <x-sidebar/>
            </div>
    
            <!-- Commission Requests -->
            <div class="w-full md:w-3/4">
                <h2 class="text-3xl font-semibold mb-6 text-gray-800">Commission Requests</h2>
    
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
    
                @if(empty($commissions))
                    <p class="text-gray-500 text-lg">No commission requests found.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($commissions as $id => $commission)
                            <div class="bg-white shadow-lg rounded-xl p-6 transition-all hover:shadow-xl border border-gray-200">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xl font-semibold text-gray-800">Commission Request</h3>
                                    <span class="px-3 py-1 text-sm font-medium rounded-full 
                                        {{ ($commission['status'] ?? 'pending') === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                        {{ ucfirst($commission['status'] ?? 'pending') }}
                                    </span>
                                </div>
                                <div class="space-y-2">
                                    <p><strong class="text-gray-700">Name:</strong> {{ $commission['name'] ?? 'N/A' }}</p>
                                    <p><strong class="text-gray-700">Email:</strong> {{ $commission['email'] ?? 'N/A' }}</p>
                                    <p><strong class="text-gray-700">Contact:</strong> {{ $commission['contact'] ?? 'N/A' }}</p>
                                    <p><strong class="text-gray-700">Product:</strong> {{ $commission['product'] ?? 'N/A' }}</p>
                                    <p class="text-gray-600"><strong>Description:</strong> {{ $commission['description'] ?? 'N/A' }}</p>
                                </div>
    
                                @if(($commission['status'] ?? 'pending') === 'pending')
                                    <form action="{{ route('commissions.accept', $id) }}" method="POST" class="mt-4">
                                        @csrf
                                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg font-medium shadow-md hover:bg-indigo-700 transition-all">
                                            Accept Request
                                        </button>
                                    </form>
                                @else
                                    <p class="mt-4 text-green-600 font-semibold text-center">Accepted</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>