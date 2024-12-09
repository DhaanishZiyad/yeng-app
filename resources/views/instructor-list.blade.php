@extends('layouts.app')

@section('content')

<!-- Title Div -->
<div class="flex justify-between font-raleway font-bold">
    <h1 class="text-xl">Instructors</h1>
</div>
@foreach ($instructors as $instructor)
    <div class="bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 cursor-pointer">
        <div class="flex items-center">
            <!-- Profile Circle -->
            <div class="flex-shrink-0 h-12 w-12 bg-gray-200 text-yeng-pink-500 rounded-full flex items-center justify-center font-bold uppercase">
                {{ strtoupper(substr($instructor->name, 0, 1)) }}
            </div>

            <div class="flex flex-col w-max">
            <div class="ml-4">
                <h2 class="text-lg font-bold text-gray-900">{{ $instructor->name }}</h2>
                <p class="text-sm text-gray-500">{{ $instructor->email }}</p>
                <p class="text-sm text-gray-700 mt-1">
                    <span class="font-bold text-gray-900">Location:</span> 
                    {{ $instructor->location ?? 'Not specified' }}
                </p>
                <p class="text-xs text-gray-400 mt-1">Registered on: {{ $instructor->created_at->format('d M Y') }}</p>
            </div>

            <div class="flex text-sm font-bold mt-2 justify-end">
                <button class="text-yeng-pink-500 border-yeng-pink-500 border-2 p-8 py-2 rounded-full">View</button>
                <button class="text-white border-yeng-pink-500 bg-yeng-pink-500 border-2 p-8 py-2 ml-2 rounded-full" onclick="window.location.href='{{ route('booking', ['instructor_name' => $instructor->name, 'instructor_id' => $instructor->id]) }}'">
                    Book
                </button>

            </div>
            </div>
            <!-- Instructor Details -->
            
        </div>
    </div>
@endforeach
@endsection