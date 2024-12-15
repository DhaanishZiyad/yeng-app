@extends('layouts.app')

@section('content')

<!-- Title -->
<div class="mb-8 flex items-center">
    <a href="{{ url()->previous() }}">
        <img src="/images/left arrow.svg" alt="Profile" class="h-8 w-8">
    </a>
    <h1 class="text-xl font-bold font-raleway ml-2">Instructors</h1>
</div>
@foreach ($instructors as $instructor)
    <div class="bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 cursor-pointer">
        <div class="flex items-center">
            <!-- Profile Circle -->
            <div class="flex-shrink-0 h-14 w-14 rounded-full overflow-hidden bg-gray-200">
                @if($instructor->profile_picture)
                    <img src="{{ asset('storage/' . $instructor->profile_picture) }}" alt="{{ $instructor->name }}" class="h-full w-full object-cover">
                @else
                    <div class="bg-gray-200 text-yeng-pink-500 flex items-center justify-center h-full w-full font-bold uppercase">
                        {{ strtoupper(substr($instructor->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <div class="flex flex-col w-max">
                <div class="ml-4">
                    <h2 class="text-lg font-bold text-gray-900">{{ $instructor->name }}</h2>
                    <h2 class="text-sm font-bold
                        @if(strtolower($instructor->gender) == 'male') text-blue-400
                        @elseif(strtolower($instructor->gender) == 'female') text-pink-400
                        @else text-green-400 @endif">
                        {{ ucfirst($instructor->gender) }}
                    </h2>
                    <h2 class="text-sm font-bold text-gray-500 mt-1">⚲ {{ $instructor->city }}</h2>
                </div>
            </div>
        </div>
        <div class="flex text-sm font-bold mt-4 justify-end">
            <button class="text-white border-yeng-pink-500 bg-yeng-pink-500 border-2 p-8 py-2 ml-2 rounded-full" onclick="window.location.href='{{ route('booking', ['instructor_name' => $instructor->name, 'instructor_id' => $instructor->id]) }}'">
                Book
            </button>
        </div>
    </div>
@endforeach
@endsection