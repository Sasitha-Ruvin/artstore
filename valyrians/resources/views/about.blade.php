@extends('layouts.app')

@section('content')
<div class="bg-white py-12">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">About Us</h2>
            <p class="text-gray-600 text-lg">Discover the passion and vision behind our art.</p>
        </div>

        <!-- Content Section -->
        <div class="flex flex-col md:flex-row items-center">
            <!-- Image Section -->
            <div class="w-[60%]">
                <img src="{{ asset('Images/about-art.jpg') }}" alt="Art Showcase" class="rounded-md w-full object-cover">
            </div>
            <!-- Text Section -->
            <div class="md:w-1/2 md:pl-12 mt-8 md:mt-0">
                <h3 class="text-2xl font-semibold mb-4">Our Story</h3>
                <p class="text-gray-700 mb-6">
                    Founded by art enthusiasts, our platform was built to celebrate the transformative power of art. We bring together talented artists and passionate collectors from around the world. Our journey began with a simple idea—to create a community where creativity knows no bounds.
                </p>
                <h3 class="text-2xl font-semibold mb-4">Our Mission</h3>
                <p class="text-gray-700">
                    Our mission is to inspire, connect, and empower both artists and art lovers. We strive to offer a curated collection of exceptional artworks that not only elevate your space but also tell a story. Join us in celebrating art in all its forms.
                </p>
            </div>
        </div>

        <!-- Call-to-Action Section -->
        <div class="mt-12 text-center">
            <a href="{{ url('/arts') }}" class="bg-[#5e4585] text-white px-6 py-3 rounded-full hover:bg-[#4d3a6f] transition duration-300">
                Browse Artworks
            </a>
        </div>
    </div>
</div>
@endsection
