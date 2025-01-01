<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Top Nav -->
    <nav class="flex justify-center items-center bg-white p-4 shadow-lg font-raleway font-bold fixed top-0 w-full z-50">
        <div class="flex space-x-8">
            <!-- Sessions Toggle Button -->
            <a href="{{ route('admin.dashboard') }}" id="sessions-btn" class="sessions-toggle text-gray-500 px-6 py-2 hover:text-black transition duration-300">
                Admin Dashboard
                <span id="sessions-underline" class="bg-gray-500 block h-1 transition-all rounded"></span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div id="content" class="content p-6 pt-24 pb-32">
        @yield('content')
    </div>

    <!-- Bottom Nav -->
    <div class="fixed bottom-0 left-0 right-0 bg-gray-500 shadow-lg p-2 m-6 flex justify-between items-center border-t border-gray-200 z-50 rounded-full">
    <a href="{{ route('admin.dashboard') }}" class="nav-button transition duration-300 rounded-full h-16 w-16 flex justify-center items-center {{ request()->routeIs('admin.dashboard') ? 'bg-gray-400' : '' }}">
        <img src="/images/House.svg" alt="Dashboard" class="h-8 w-8">
    </a>
        <a href="{{ route('admin.users') }}" class="nav-button transition duration-300 rounded-full h-16 w-16 flex justify-center items-center {{ request()->routeIs('admin.users') ? 'bg-gray-400' : '' }}">
            <img src="/images/users.svg" alt="Home" class="h-8 w-8">
        </a>
        <a href="{{ route('admin.products') }}" class="nav-button transition duration-300 rounded-full h-16 w-16 flex justify-center items-center {{ request()->routeIs('admin.products') ? 'bg-gray-400' : '' }}">
            <img src="/images/shopping bag.svg" alt="Sessions" class="h-8 w-8">
        </a>
        <a href="#" class="nav-button transition duration-300 rounded-full h-16 w-16 flex justify-center items-center {{ request()->routeIs('profile') ? 'bg-gray-400' : '' }}">
            <img src="/images/account.svg" alt="Profile" class="h-8 w-8">
        </a>
    </div>

    

    <script>
        // // Top Nav toggle
        // function toggleTopNav(selected) {
        //     const sessionsBtn = document.getElementById('sessions-btn');
        //     const storeBtn = document.getElementById('store-btn');
        //     const sessionsUnderline = document.getElementById('sessions-underline');
        //     const storeUnderline = document.getElementById('store-underline');

        //     // Reset underline styles and remove 'bg-black' from both buttons
        //     sessionsUnderline.classList.remove('bg-gray-500');
        //     storeUnderline.classList.remove('bg-yeng-green-500');

        //     // Show the content and apply pink underline to the selected button
        //     if (selected === 'sessions') {
        //         sessionsUnderline.classList.add('bg-gray-500');
        //     } else {
        //         storeUnderline.classList.add('bg-yeng-green-500');
        //     }
        // }
        // //Initialize with 'sessions' selected
        // toggleTopNav('sessions');

        Bottom Nav toggle
        function highlightButton(button) {
            // Remove 'selected' class from all buttons
            document.querySelectorAll('.nav-button').forEach(btn => btn.classList.remove('bg-gray-400'));

            // Add 'selected' class to the clicked button
            button.classList.add('bg-gray-400');
        }
    </script>

    
</body>
</html>