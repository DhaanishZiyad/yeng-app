@extends('layouts.app')

@section('content')

<!-- Title -->
<div class="mb-4 flex items-center">
    <a href="{{ url()->previous() }}">
        <img src="/images/left arrow.svg" alt="Profile" class="h-8 w-8">
    </a>
    <h1 class="text-xl font-bold font-raleway ml-2">Instructor Profile</h1>
</div>

        <!-- Profile Picture -->
        <div class="flex justify-center">
            <div class="w-full max-w-screen-sm aspect-square bg-gray-200 rounded-lg overflow-hidden">
                @if($instructor->profile_picture)
                    <img src="{{ asset('storage/' . $instructor->profile_picture) }}" 
                        alt="{{ $instructor->name }}" 
                        class="object-cover w-full h-full">
                @else
                    <div class="flex items-center justify-center text-yeng-pink-500 font-bold uppercase text-6xl h-full w-full">
                        {{ strtoupper(substr($instructor->name, 0, 1)) }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Instructor Information -->
        <div class="text-center mt-6">
            <h1 class="text-xl font-bold font-raleway text-gray-900">{{ $instructor->name }}</h1>
            <p class="font-bold mt-2 @if(strtolower($instructor->gender) == 'male') text-blue-400 @elseif(strtolower($instructor->gender) == 'female') text-pink-400 @else text-green-400 @endif">
                {{ ucfirst($instructor->gender) }}
            </p>
        </div>

        <div class="flex font-bold font-raleway mt-4 justify-center">
            <button 
                class="text-white border-yeng-pink-500 bg-yeng-pink-500 border-2 p-8 py-2 rounded-full w-full max-w-screen-sm"
                onclick="window.location.href='{{ route('booking', ['instructor_name' => $instructor->name, 'instructor_id' => $instructor->id]) }}'">
                Book a Session
            </button>
        </div>
        <!-- Additional Information -->
        <div class="mt-6">
            <!-- Sub Title Div -->
            <div class="flex font-raleway font-bold mt-4">
                <h1 class="text-gray-400">City</h1>
            </div>

            <div>
                <p class="font-bold font-raleway">{{ $instructor->city }}</p>
            </div>

            <!-- Sub Title Div -->
            <div class="flex font-raleway font-bold mt-4">
                <h1 class="text-gray-400">Email</h1>
            </div>

            <div>
                <p class="font-bold font-raleway">{{ $instructor->email }}</p>
            </div>

            <div class="flex font-raleway font-bold mt-4">
                <h1 class="text-gray-400">Date of Birth</h1>
            </div>

            <div>
                <p class="font-bold font-raleway">{{ \Carbon\Carbon::parse($instructor->dob)->format('F d, Y') }}</p>
            </div>

            <!-- Instructor Availability Section -->
            <div class="flex font-raleway font-bold mt-4">
                <h1 class="text-gray-400">Available Days</h1>
            </div>
            @forelse($instructor->availabilities as $availability)
                <div>
                    <p class="font-bold font-raleway">
                        {{ ucfirst($availability->day_of_week) }} 
                        {{ \Carbon\Carbon::parse($availability->start_time)->format('H:i') }}-
                        {{ \Carbon\Carbon::parse($availability->end_time)->format('H:i') }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500 mt-2">This instructor has not set any availability yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
