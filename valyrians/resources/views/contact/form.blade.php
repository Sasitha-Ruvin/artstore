@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-10 rounded-xl shadow-xl w-full max-w-md">
        <h2 class="text-center text-3xl font-semibold text-gray-800 mb-6">Contact Us</h2>

        @if(session('success'))
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'bg-green-500 text-white rounded-full py-2 px-4 hover:bg-green-600'
                    }
                });
            </script>
        @endif
        
        <form action="{{ route('commission.submit') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="name" class="block text-lg font-medium text-gray-700">Your Name</label>
                <input type="text" id="name" name="name" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" required>
            </div>
            
            <div class="mb-5">
                <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" required>
            </div>

            <div class="mb-5">
                <label for="message" class="block text-lg font-medium text-gray-700">Message</label>
                <textarea id="message" name="message" rows="5" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg text-lg font-medium shadow-md hover:bg-indigo-700 transition-all">
                    Send
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
