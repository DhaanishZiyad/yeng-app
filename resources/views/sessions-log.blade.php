@extends('layouts.app')

@section('content')

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold">
        <h1 class="text-xl">Session History</h1>
    </div>

    <!-- to check if there is a session to show message -->
    @php
        $hasSessions = false;
    @endphp

    @if($pendingSessions->isNotEmpty())
        @php $hasSessions = true; @endphp
        <!-- Sub Title Div -->
        <div class="flex justify-between font-raleway font-bold mt-4">
            <h1 class="text-gray-400">Pending Sessions</h1>
        </div>
        @foreach($pendingSessions as $session)
            <!-- Slim Card Div -->
            <a href="{{ route('session-view', $session->id) }}" class="block bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
                <!-- Instructor and Time -->
                <div class="flex justify-between text-lg font-bold">
                    <p>{{ $session->instructor->name ?? 'N/A' }}</p>
                    <p>
                        {{ \Carbon\Carbon::parse($session->time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($session->time)->addHour()->format('H:i') }}
                    </p>
                </div>

                <!-- Date and Status -->
                <div class="flex justify-between items-center text-sm font-bold mt-2">
                    <p class="text-gray-400">{{ \Carbon\Carbon::parse($session->date)->format('l, jS F') }}</p>
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-4 py-1 rounded-full">
                        Pending
                    </span>
                </div>
            </a>
        @endforeach
    @endif


    @if($acceptedSessions->isNotEmpty())
        @php $hasSessions = true; @endphp
        <!-- Sub Title Div -->
        <div class="flex justify-between font-raleway font-bold mt-4">
            <h1 class="text-gray-400">Accepted Sessions</h1>
        </div>
        @foreach($acceptedSessions as $session)
            <!-- Slim Card Div -->
            <a href="{{ route('session-view', $session->id) }}" class="block bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
            <!-- Instructor and Time -->
                <div class="flex justify-between text-lg font-bold">
                    <p>{{ $session->instructor->name ?? 'N/A' }}</p>
                    <p>
                        {{ \Carbon\Carbon::parse($session->time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($session->time)->addHour()->format('H:i') }}
                    </p>
                </div>

                <!-- Date and Status -->
                <div class="flex justify-between items-center text-sm font-bold mt-2">
                    <p class="text-gray-400">{{ \Carbon\Carbon::parse($session->date)->format('l, jS F') }}</p>
                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-4 py-1 rounded-full">
                        Accepted
                    </span>
                </div>
            </a>
        @endforeach
    @endif

    @if($declinedSessions->isNotEmpty())
        @php $hasSessions = true; @endphp
        <!-- Sub Title Div -->
        <div class="flex justify-between font-raleway font-bold mt-4">
            <h1 class="text-gray-400">Declined Sessions</h1>
            <!-- <form action="{{ route('sessions.clear.declined') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all Declined sessions?');">
                @csrf
                <button type="submit" class="bg-yeng-pink-100 text-yeng-pink-500 px-3 py-1 rounded-md text-sm hover:bg-red-600 transition">
                    Clear
                </button>
            </form> -->
        </div>
        @foreach($declinedSessions as $session)
            <!-- Slim Card Div -->
            <a href="{{ route('session-view', $session->id) }}" class="block bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
                <!-- Instructor and Time -->
                <div class="flex justify-between text-lg font-bold">
                    <p>{{ $session->instructor->name ?? 'N/A' }}</p>
                    <p>
                        {{ \Carbon\Carbon::parse($session->time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($session->time)->addHour()->format('H:i') }}
                    </p>
                </div>

                <!-- Date and Status -->
                <div class="flex justify-between items-center text-sm font-bold mt-2">
                    <p class="text-gray-400">{{ \Carbon\Carbon::parse($session->date)->format('l, jS F') }}</p>
                    <span class="bg-red-100 text-red-800 text-xs font-semibold px-4 py-1 rounded-full">
                        Declined
                    </span>
                </div>
            </a>
        @endforeach
    @endif

    @if($cancelledSessions->isNotEmpty())
        @php $hasSessions = true; @endphp
        <!-- Sub Title Div -->
        <div class="flex justify-between font-raleway font-bold mt-4">
            <h1 class="text-gray-400">Cancelled Sessions</h1>
            <!-- <form action="{{ route('sessions.clear.cancelled') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all Cancelled sessions?');">
                @csrf
                <button type="submit" class="bg-yeng-pink-100 text-yeng-pink-500 px-3 py-1 rounded-md text-sm hover:bg-red-600 transition">
                    Clear
                </button>
            </form> -->
        </div>
        @foreach($cancelledSessions as $session)
            <!-- Slim Card Div -->
            <a href="{{ route('session-view', $session->id) }}" class="block bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
                <!-- Instructor and Time -->
                <div class="flex justify-between text-lg font-bold">
                    <p>{{ $session->instructor->name ?? 'N/A' }}</p>
                    <p>
                        {{ \Carbon\Carbon::parse($session->time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($session->time)->addHour()->format('H:i') }}
                    </p>
                </div>

                <!-- Date and Status -->
                <div class="flex justify-between items-center text-sm font-bold mt-2">
                    <p class="text-gray-400">{{ \Carbon\Carbon::parse($session->date)->format('l, jS F') }}</p>
                    <span class="bg-gray-200 text-gray-800 text-xs font-semibold px-4 py-1 rounded-full">
                        Cancelled
                    </span>
                </div>
            </a>
        @endforeach
    @endif


    @if($completedSessions->isNotEmpty())
        @php $hasSessions = true; @endphp
        <!-- Sub Title Div -->
        <div class="flex justify-between font-raleway font-bold mt-4">
            <h1 class="text-gray-400">Completed Sessions</h1>
        </div>
        @foreach($completedSessions as $session)
            <!-- Slim Card Div -->
            <a href="{{ route('session-view', $session->id) }}" class="block bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
                <!-- Instructor and Time -->
                <div class="flex justify-between text-lg font-bold">
                    <p>{{ $session->instructor->name ?? 'N/A' }}</p>
                    <p>
                        {{ \Carbon\Carbon::parse($session->time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($session->time)->addHour()->format('H:i') }}
                    </p>
                </div>

                <!-- Date and Status -->
                <div class="flex justify-between items-center text-sm font-bold mt-2">
                    <p class="text-gray-400">{{ \Carbon\Carbon::parse($session->date)->format('l, jS F') }}</p>
                    <span class="bg-blue-200 text-blue-800 text-xs font-semibold px-4 py-1 rounded-full">
                        Completed
                    </span>
                </div>
            </a>
        @endforeach
    @endif

    @if(!$hasSessions)
        <div class="text-gray-500 text-sm mt-4">No sessions made.</div>
    @endif

@endsection