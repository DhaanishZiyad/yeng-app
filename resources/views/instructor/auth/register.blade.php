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
<body class="h-screen flex flex-col justify-center items-center bg-gray-100">
    <div class="flex flex-row w-screen justify-center items-center">
        <img src="/images/yeng_logo.svg" alt="">
    </div>
    <div class="flex flex-row w-screen justify-center items-center mt-4">
        <img src="/images/yeng_text.svg" alt="">
    </div>

    <div class="flex flex-row w-screen justify-center items-center mt-8">
        <form method="POST" action="{{ route('instructor.register') }}" class="flex flex-col gap-4 my-8 w-80">
            @csrf

            <!-- Name -->
            <div>
                <x-text-input id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Name') }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-text-input id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="{{ __('Email') }}" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-text-input id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-text-input id="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yeng-pink-400 focus:border-yeng-pink-400 text-sm bg-white text-black" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <button type="submit" class="font-raleway font-bold w-full bg-yeng-pink-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mt-2">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>