@extends('layouts.app')

@section('content')

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

@endsection