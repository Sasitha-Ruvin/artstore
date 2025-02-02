@extends('layouts.app')

@section('content')

{{-- Hero Section --}}
<section class="relative">
    <div class="h-96 bg-cover bg-center" style="background-image: url('{{ asset('Images/mainback.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="text-center text-white">
                <h1 class="text-5xl font-bold">Valyrian Visions</h1>
                <p class="text-lg mt-2">Where Art Speaks</p>
            </div>
        </div>
    </div>
</section>

{{-- About Section --}}
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold text-gray-900">About Valyrian Visions</h2>
        <p class="mt-4 text-lg text-gray-600 leading-relaxed">
            We believe that art is a universal language that transcends boundaries. 
            Our platform connects talented artists with passionate collectors, creating a vibrant community that appreciates creativity.
        </p>
    </div>
</section>

{{-- Featured Artworks Section --}}
<section class="py-16 bg-gray-100">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-gray-900 mb-8">Featured Artworks</h2>
        <div class="flex overflow-x-auto gap-6 pb-4">
            @php
                $artworks = [
                    ['img' => 'Images/art1.jpg', 'title' => 'Ethereal Dreams', 'artist' => 'Ava Sterling', 'price' => '$150'],
                    ['img' => 'Images/art2.webp', 'title' => 'Urban Chaos', 'artist' => 'Liam Cross', 'price' => '$200'],
                    ['img' => 'Images/art3.jpg', 'title' => 'Serene Waters', 'artist' => 'Elena Ruiz', 'price' => '$180'],
                    ['img' => 'Images/art4.png', 'title' => 'Mystic Forest', 'artist' => 'Oliver Hart', 'price' => '$220'],
                    ['img' => 'Images/art5.jpg', 'title' => 'Golden Hour', 'artist' => 'Sophia Lane', 'price' => '$175'],
                ];
            @endphp

            @foreach($artworks as $art)
            <div class="min-w-[250px] bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="{{ asset($art['img']) }}" alt="{{ $art['title'] }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">{{ $art['title'] }}</h3>
                    <p class="text-gray-500">by {{ $art['artist'] }}</p>
                    <p class="text-red-600 font-bold mt-2">{{ $art['price'] }}</p>
                    <button class="mt-3 w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">View Details</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Testimonials Section --}}
<section class="py-16 bg-gray-900 text-white text-center">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-4xl font-bold">What Our Collectors Say</h2>
        <div class="mt-6 space-y-6">
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                <p class="text-lg">"Valyrian Visions has completely transformed my collection! The art here is stunning and unique!"</p>
                <p class="mt-3 font-bold">— Jane Doe</p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                <p class="text-lg">"The platform connects me with incredible artists. The buying process is seamless and enjoyable."</p>
                <p class="mt-3 font-bold">— Alex Smith</p>
            </div>
        </div>
    </div>
</section>

{{-- Our Artists Section --}}
<section class="py-16 bg-white">
    <div class="w-full mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold text-gray-900">Meet Our Artists</h2>
        <p class="mt-4 text-lg text-gray-600 leading-relaxed">
            Discover the creative minds behind the masterpieces. Our artists bring passion and talent to every artwork.
        </p>
        <div class="mt-8 flex flex-wrap justify-center gap-6">
            <div class="w-[40%] bg-gray-100 p-6 rounded-lg text-center">
                <img src="Images/artist2.webp" class="mx-auto rounded-lg">
                <h3 class="mt-4 text-xl font-semibold">Eleanor Carter</h3>
                <p class="text-gray-500">Abstract & Digital Artist</p>
            </div>
            <div class="w-[40%] bg-gray-100 p-6 rounded-lg text-center">
                <img src="Images/artist1.webp" class="mx-auto rounded-lg">
                <h3 class="mt-4 text-xl font-semibold">Michael Ross</h3>
                <p class="text-gray-500">Modern & Street Art</p>
            </div>
        </div>
    </div>
</section>

{{-- Join Community Section --}}
<section class="py-16 bg-gray-900 text-white text-center">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-4xl font-bold">Join Our Art Community</h2>
        <p class="mt-3 text-lg">Be the first to discover new artworks, exclusive deals, and artist insights.</p>
        <form class="mt-6 flex flex-col sm:flex-row justify-center gap-4">
            <input type="email" placeholder="Enter your email" class="w-full sm:w-auto px-4 py-3 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500">
            <button class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white text-lg font-semibold rounded-lg shadow-lg transition">Subscribe</button>
        </form>
    </div>
</section>

@endsection
