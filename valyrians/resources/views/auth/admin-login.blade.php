<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-semibold text-center text-gray-800 leading-tight" style="background-image: url('{{ asset('Images/userlogin.jpg')}}');>
            {{ __('Admin Login') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-12 rounded-2xl shadow-xl w-full max-w-md">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Admin Login</h2>
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <!-- Email Input -->
                <div>
                    <x-label for="email" :value="__('Email')" class="text-lg font-medium text-gray-700"/>
                    <x-input id="email" class="block mt-2 w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Password Input -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" class="text-lg font-medium text-gray-700"/>
                    <x-input id="password" class="block mt-2 w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" type="password" name="password" required />
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <x-button class="w-full py-3 text-lg font-semibold bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition-all text-center items-center justify-center">
                        {{ __('Login') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                // Assuming the API returns a plain text token in data.token
                if (data.token) {
                    // Save the token in localStorage
                    localStorage.setItem('authToken', data.token);
                    console.log('Token saved:', data.token);
                } else {
                    alert('Login failed: Token not received');
                }
            })
            .catch(error => {
                console.error('Login failed', error);
                alert('An error occurred. Please try again.');
            });
        });
    </script>

</x-guest-layout>
