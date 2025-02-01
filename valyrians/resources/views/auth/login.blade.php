<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-cover bg-center relative" style="background-image: url('{{ asset('Images/userlogin.jpg')}}');">
        <div class="absolute inset-0 bg-black opacity-50"></div> <!-- Shadow overlay -->
        <div class="bg-[#fef5e7] px-8 py-10 rounded-lg shadow-md w-full max-w-sm relative z-10">
            <h1 class="text-center text-2xl font-bold mb-2">Welcome Back!</h1>
            <p class="text-center text-gray-700 mb-6">Log in to your Account</p>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-label for="email" value="Email" />
                    <x-input id="email" class="block mt-1 w-full border-gray-300 rounded-md" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mb-4">
                    <x-label for="password" value="Password" />
                    <x-input id="password" class="block mt-1 w-full border-gray-300 rounded-md" type="password" name="password" required />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center text-sm text-gray-600">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ml-2">Remember me</span>
                    </label>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition">
                        Login
                    </button>
                </div>
            </form>

            <p class="text-center text-sm mt-6 text-gray-700">
                Don’t have an Account? 
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Sign Up</a>
            </p>
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(event){
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            axios.post('api/login',{
                email: email,
                password: password
            })
            .then(response => {
                localStorage.setItem('authToken', response.data.token);
            })
            .catch(error => {
                console.error('login failed', error);
                alert(error);
            })
        })
    </script>
</x-guest-layout>
