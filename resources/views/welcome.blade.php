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
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700&0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen flex flex-col justify-center items-center bg-gray-100 ">
    <div class="flex flex-row w-screen justify-center items-center">
        <img src="/images/yeng_logo.svg" alt="">
    </div>
    <div class="flex flex-row w-screen justify-center items-center mt-4">
        <img src="/images/yeng_text.svg" alt="">
    </div>

    <div class="flex flex-row w-screen justify-center items-center mt-8">
        <div class="flex flex-col gap-4 w-80">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-raleway font-bold w-full bg-yeng-pink-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-center">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="font-raleway font-bold w-full bg-yeng-pink-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-center">
                        Log in
                    </a>
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="font-raleway font-bold w-full bg-gray-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-center mt-2">
                            Register
                        </a>
                    @endif

                    <a href="{{ route('instructor.login') }}" class="font-raleway font-bold w-full bg-yeng-pink-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-center mt-2">
                        Instructor Log in
                    </a>

                    <a href="{{ route('instructor.register') }}" class="font-raleway font-bold w-full bg-gray-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-center mt-2">
                        Instructor Register
                    </a>
                @endauth
            @endif
        </div>
    </div>
</body>
</html>