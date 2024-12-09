

@extends('layouts.app')

@section('content')

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold">
        <h1 class="text-xl">Book a Session</h1>
    </div>

    <form action="{{ route('yoga-sessions.store') }}" method="POST" class="mx-auto bg-white p-6 py-4 mt-12 rounded-lg shadow-lg border-yeng-pink-500 border-2">
        @csrf

        <input type="hidden" name="instructor_id" value="{{ old('instructor_id', $instructorId) }}">

        <div class="mb-4">
            <label for="instructor" class="block text-sm font-bold text-gray-400">Instructor</label>
            <input 
                type="text" 
                id="instructor" 
                name="instructor" 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yeng-pink-500 text-gray-900 font-bold" 
                placeholder="Select Your Instructor"
                value="{{ old('instructor', $instructorName) }}" 
                readonly 
                onclick="window.location.href='{{ route('instructor-list') }}';" 
            >
        </div>

        <div class="mb-4">
            <label for="location" class="block text-sm font-bold text-gray-400">Location</label>
            <input 
                type="text" 
                id="location" 
                name="location" 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yeng-pink-500 text-gray-900 font-bold"
                placeholder="Your address"
                value="{{ old('location', $location) }}"
                readonly
            >
        </div>

        <div class="mb-4">
            <label for="date" class="block text-sm font-bold text-gray-400">Date</label>
            <input 
                type="date" 
                id="date" 
                name="date" 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yeng-pink-500 text-gray-900 font-bold">
        </div>

        <div class="mb-6">
            <label for="time" class="block text-sm font-bold text-gray-400">Time</label>
            <input 
                type="time" 
                id="time" 
                name="time" 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yeng-pink-500 text-gray-900 font-bold">
        </div>

        <div class="flex justify-center">
            <button 
                type="submit" 
                class="bg-yeng-pink-500 px-6 py-2 text-white font-bold rounded-full">
                Book
            </button>
        </div>
    </form>

@endsection
