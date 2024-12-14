@extends('layouts.instructor-app')

@section('content')

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold">
        <h1 class="text-xl">Session History</h1>
    </div>

    @if($pendingSessions->isNotEmpty())
        <!-- Sub Title Div -->
        <div class="flex justify-between font-raleway font-bold mt-4">
            <h1 class="text-gray-400">Pending Sessions</h1>
        </div>
        @foreach($pendingSessions as $session)
            <!-- Slim Card Div -->
            <a href="{{ route('instructor.session-view', $session->id) }}" class="block bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
                <!-- Instructor and Time -->
                <div class="flex justify-between text-lg font-bold">
                    <p>{{ $session->user->name ?? 'N/A' }}</p>
                    <p>{{ \Carbon\Carbon::parse($session->time)->format('H:i') }}</p>
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
        <!-- Sub Title Div -->
        <div class="flex justify-between font-raleway font-bold mt-4">
            <h1 class="text-gray-400">Accepted Sessions</h1>
        </div>
        @foreach($acceptedSessions as $session)
            <!-- Slim Card Div -->
            <a href="{{ route('instructor.session-view', $session->id) }}" class="block bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
            <!-- Instructor and Time -->
                <div class="flex justify-between text-lg font-bold">
                    <p>{{ $session->user->name ?? 'N/A' }}</p>
                    <p>{{ \Carbon\Carbon::parse($session->time)->format('H:i') }}</p>
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
        <!-- Sub Title Div -->
        <div class="flex justify-between font-raleway font-bold mt-4">
            <h1 class="text-gray-400">Declined Sessions</h1>
        </div>
        @foreach($declinedSessions as $session)
            <!-- Slim Card Div -->
            <a href="{{ route('instructor.session-view', $session->id) }}" class="block bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
                <!-- Instructor and Time -->
                <div class="flex justify-between text-lg font-bold">
                    <p>{{ $session->user->name ?? 'N/A' }}</p>
                    <p>{{ \Carbon\Carbon::parse($session->time)->format('H:i') }}</p>
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
        <!-- Sub Title Div -->
        <div class="flex justify-between font-raleway font-bold mt-4">
            <h1 class="text-gray-400">Cancelled Sessions</h1>
        </div>
        @foreach($cancelledSessions as $session)
            <!-- Slim Card Div -->
            <a href="{{ route('instructor.session-view', $session->id) }}" class="block bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
                <!-- Instructor and Time -->
                <div class="flex justify-between text-lg font-bold">
                    <p>{{ $session->user->name ?? 'N/A' }}</p>
                    <p>{{ \Carbon\Carbon::parse($session->time)->format('H:i') }}</p>
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
        <!-- Sub Title Div -->
        <div class="flex justify-between font-raleway font-bold mt-4">
            <h1 class="text-gray-400">Completed Sessions</h1>
        </div>
        @foreach($completedSessions as $session)
            <!-- Slim Card Div -->
            <a href="{{ route('instructor.session-view', $session->id) }}" class="block bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
                <!-- Instructor and Time -->
                <div class="flex justify-between text-lg font-bold">
                    <p>{{ $session->user->name ?? 'N/A' }}</p>
                    <p>{{ \Carbon\Carbon::parse($session->time)->format('H:i') }}</p>
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

@endsection