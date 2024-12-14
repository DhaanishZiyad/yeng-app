@extends('layouts.app')

@section('content')


    <!-- Session Details Card -->
        <!-- Title -->
        <div class="mb-8 flex items-center">
            <a href="{{ url()->previous() }}">
                <img src="/images/left arrow.svg" alt="Profile" class="h-8 w-8">
            </a>
            <h1 class="text-xl font-bold font-raleway ml-2">Session Details</h1>
        </div>

        <!-- Date and Time -->
        <div class="flex justify-between items-center mb-4">
            <div>
                <p class="text-gray-400 font-bold text-sm">Date</p>
                <p class="text-lg">{{ \Carbon\Carbon::parse($session->date)->format('l, jS F') }}</p>
            </div>
            <div>
                <p class="text-gray-400 font-bold text-sm">Time</p>
                <p class="text-lg">{{ \Carbon\Carbon::parse($session->time)->format('H:i') }}</p>
            </div>
        </div>

        <!-- Instructor -->
        <div class="mb-4">
            <p class="text-gray-400 font-bold text-sm">Instructor</p>
            <p class="text-lg">{{ $session->instructor->name ?? 'N/A' }}</p>
        </div>

        <!-- Location -->
        <div class="mb-4">
            <p class="text-gray-400 font-bold text-sm">Location</p>
            <p class="text-lg">{{ $session->location }}</p>
        </div>

        <div class="flex justify-between items-center mb-4">
            <!-- City -->
            <div>
                <p class="text-gray-400 font-bold text-sm">City</p>
                <p class="text-lg">{{ $session->user->city }}</p>
            </div>

            <!-- Status -->
            <div>
                <span class="text-xs font-semibold px-4 py-1 rounded-full 
                    {{ $session->status === 'accepted' ? 'bg-green-100 text-green-800' : 
                       ($session->status === 'declined' ? 'bg-red-100 text-red-800' : 
                       ($session->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                       ($session->status === 'cancelled' ? 'bg-gray-200 text-gray-800' : 
                       ($session->status === 'completed' ? 'bg-blue-200 text-blue-800' : '')))) }}">
                    {{ ucfirst($session->status) }}
                </span>
            </div>
        </div>
@endsection