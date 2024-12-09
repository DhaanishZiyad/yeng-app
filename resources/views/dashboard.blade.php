@extends('layouts.app')

@section('content')

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold">
        <h1 class="text-xl">Upcoming Sessions</h1>
        <p class="text-yeng-pink-500 text-sm">VIEW ALL</p>
    </div>
    
    @if($acceptedSessions->isNotEmpty())
        @php
            // Sort sessions by date and time to get the upcoming one
            $upcomingSession = $acceptedSessions->sortBy(function($session) {
                return \Carbon\Carbon::parse($session->date . ' ' . $session->time);
            })->first();
        @endphp

        @if($upcomingSession)
            <!-- Card Div -->
            <a href="{{ route('session-view', $upcomingSession->id) }}" class="block mx-auto bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
                <!-- Instructor and Time -->
                <div class="flex text-sm font-bold justify-between">
                    <p class="text-gray-400">Instructor</p>
                    <p class="text-gray-400">Time</p>
                </div>
                <div class="flex text-lg font-bold justify-between">
                    <p>{{ $upcomingSession->instructor->name ?? 'N/A' }}</p>
                    <p>{{ \Carbon\Carbon::parse($upcomingSession->time)->format('H:i') }}</p>
                </div>

                <!-- Date -->
                <div class="flex text-sm font-bold mt-2 justify-between">
                    <p class="text-gray-400">{{ \Carbon\Carbon::parse($upcomingSession->date)->format('l, jS F') }}</p>
                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-4 py-1 rounded-full">
                        Accepted
                    </span>
                </div>

                <!-- Location -->
                <div class="flex text-sm font-bold mt-2">
                    <p class="text-gray-400">⚲ {{ $upcomingSession->location }}</p>
                </div>
            </a>
        @endif
    @else
        <div class="text-gray-500 text-sm mt-4">No upcoming sessions.</div>
    @endif

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold mt-4">
        <h1 class="text-xl">Instructors Nearby</h1>
        <a href="{{ route('instructor-list') }}">
            <p class="text-yeng-pink-500 text-sm">VIEW ALL</p>
        </a>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="font-raleway font-bold w-full bg-yeng-pink-500 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mt-2 logout-button-u"
                onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}
        </button>
    </form>

@endsection
