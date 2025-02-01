<div class="w-64 mr-8">
    <a href="{{ route('products.index') }}" class="block bg-white p-4 rounded mb-4 shadow hover:bg-gray-100">
        Products Management
    </a>
    <a href="#" class="block bg-white p-4 rounded mb-4 shadow hover:bg-gray-100">
        Users Management
    </a>
    <a href="{{ route('featured-products.index') }}" class="block bg-white p-4 rounded mb-4 shadow hover:bg-gray-100">
       Featured Products Management
    </a>
    <a href="#" class="block bg-white p-4 rounded mb-4 shadow hover:bg-gray-100">
        Order Management
    </a>
    <a href="{{ route('categories.index') }}"  class="block bg-white p-4 rounded mb-4 shadow hover:bg-gray-100">
        Category Management
     </a>
    <a href="#" class="block bg-white p-4 rounded mb-4 shadow hover:bg-gray-100">
        Commissions
    </a>
    <a href="#" onclick="logoutUser()" class="block bg-red-400 text-white p-4 rounded shadow hover:bg-red-500">
        Log Out
    </a>
    
    <script>
        function logoutUser() {
        const token = localStorage.getItem('authToken');

        if (!token) {
            alert('You are already logged out.');
            window.location.href = '/';
            return;
        }

        fetch('/logout', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(async response => {
            // If the response is not JSON, redirect to home
            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                window.location.href = '/';
                return;
            }

            const data = await response.json();
            console.log(data.message);

            // Remove the token from localStorage
            localStorage.removeItem('authToken');

            // Redirect to welcome page
            window.location.href = '/';
        })
        .catch(error => {
            console.error('Logout failed:', error);
            alert('An error occurred while logging out.');
        });
    }
    </script>
</div>
