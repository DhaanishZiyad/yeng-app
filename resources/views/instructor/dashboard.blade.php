@extends('layouts.app')

@section('content')

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold">
        <h1 class="text-xl">Upcoming Sessions</h1>
        <p class="text-yeng-pink-500 text-sm">VIEW ALL</p>
    </div>
    <!-- Card Div -->
    <div class=" mx-auto bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2">
        <div class="flex text-sm font-bold justify-between">
            <p class="text-gray-400 ">Instructor</p>
            <p class="text-gray-400 ">Time</p>
        </div>
        <div class="flex text-lg font-bold justify-between">
            <p>Jasmine Parks</p>
            <p>14:00 - 15:00</p>
        </div>
        <div class="flex text-sm font-bold mt-2">
            <p class="text-gray-400 ">Monday, 23rd September</p>
        </div>
        <div class="flex text-sm font-bold mt-2">
            <p class="text-gray-400 ">⚲ Home</p>
        </div>
        <div class="flex text-sm font-bold mt-2 justify-end">
            <button class="text-yeng-pink-500 border-yeng-pink-500 border-2 p-8 py-2 rounded-full">Cancel</button>
            <button class="bg-yeng-pink-500 p-3 py-2 ml-2 rounded-full">
                <img src="/images/Pencil.svg" alt="Icon" class="h-4 w-4">
            </button>
        </div>
        
    </div>
    <form method="POST" action="{{ route('instructor.logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="font-raleway font-bold w-full bg-yeng-pink-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mt-2"
                onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}
        </button>
    </form>

    
@endsection

