@extends('layouts.instructor-app')

@section('content')

    <!-- Title Div -->
    <div class="flex font-raleway font-bold">
        <h1 class="text-xl">Profile</h1>
    </div>

    <div class="flex items-center justify-center mt-8">
        <img src="{{ $instructor->profile_picture ? asset('storage/' . $instructor->profile_picture) : asset('images/default-avatar.png') }}" 
        alt="Profile Picture" 
        class="rounded-full w-36 h-36">
    </div>
    <div class="flex items-center justify-center mt-4">
        <p class="text-lg font-bold font-raleway">{{ $instructor->name }}</p>
    </div>
    <div class="flex items-center justify-center">
        <p class="text-sm font-bold font-raleway text-gray-500">{{ $instructor->email }}</p>
    </div>

    <!-- Sub Title Div -->
    <div class="flex font-raleway font-bold mt-8">
            <h1 class="text-gray-400">Address</h1>
    </div>

    <div>
        <p class="font-bold font-raleway">{{ $instructor->address }}</p>
    </div>

    <!-- Sub Title Div -->
    <div class="flex font-raleway font-bold mt-4">
        <h1 class="text-gray-400">City</h1>
    </div>

    <div>
        <p class="font-bold font-raleway">{{ $instructor->city }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('instructor.profile.edit') }}">
            <button class="bg-yeng-pink-500 p-3 rounded-full">
                <img src="/images/Pencil.svg" alt="Icon" class="h-5 w-5">
            </button>
        </a>
    </div>

    <form method="POST" action="{{ route('instructor.logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="font-raleway font-bold w-full bg-yeng-pink-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mt-2 logout-button-i"
                onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}
        </button>
    </form>
@endsection

