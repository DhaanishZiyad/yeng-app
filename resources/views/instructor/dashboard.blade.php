@extends('layouts.instructor-app')

@section('content')

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold">
        <h1 class="text-xl">Upcoming Sessions</h1>
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
            <a href="{{ route('instructor.session-view', $upcomingSession->id) }}" class="block mx-auto bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
                <!-- Instructor and Time -->
                <div class="flex text-sm font-bold justify-between">
                    <p class="text-gray-400">Client</p>
                    <p class="text-gray-400">Time</p>
                </div>
                <div class="flex text-lg font-bold justify-between">
                    <p>{{ $upcomingSession->user->name ?? 'N/A' }}</p>
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

                <!-- Buttons -->
                <div class="flex text-sm font-bold justify-end mt-4">
                    <form action="{{ route('instructor.yoga-sessions.cancel', $upcomingSession->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                        <button class="text-yeng-pink-500 border-yeng-pink-500 border-2 p-8 py-2 rounded-full">Cancel</button>
                    </form>
                </div>
            </a>
        @endif
    @else
        <div class="text-gray-500 text-sm mt-4 mb-32">No upcoming sessions.</div>
    @endif

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold mt-4">
        <h1 class="text-xl">Recieved Requests</h1>
        <p class="text-yeng-pink-500 text-sm">VIEW ALL</p>
    </div>

    @if($pendingSessions->isNotEmpty())
        @foreach($pendingSessions as $session)
            <!-- Card Div -->
            <div class="mx-auto bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2">
                <!-- Instructor and Time -->
                <div class="flex text-sm font-bold justify-between">
                    <p class="text-gray-400">Client</p>
                    <p class="text-gray-400">Time</p>
                </div>
                <div class="flex text-lg font-bold justify-between">
                    <p>{{ $session->user->name ?? 'N/A' }}</p>
                    <p>{{ \Carbon\Carbon::parse($session->time)->format('H:i') }}</p>
                </div>

                <!-- Date -->
                <div class="flex text-sm font-bold mt-2">
                    <p class="text-gray-400">{{ \Carbon\Carbon::parse($session->date)->format('l, jS F') }}</p>
                </div>

                <!-- Location -->
                <div class="flex text-sm font-bold mt-2">
                    <p class="text-gray-400">⚲ {{ $session->location }}</p>
                </div>

                <!-- Buttons -->
                <div class="flex text-sm font-bold mt-2 justify-end">
                    <form action="{{ route('yoga-sessions.decline', $session->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-yeng-pink-500 border-yeng-pink-500 border-2 px-8 py-2 rounded-full mr-2">
                            Decline
                        </button>
                    </form>
                    <form action="{{ route('yoga-sessions.accept', $session->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-yeng-pink-500 text-white px-8 py-2 rounded-full">
                            Accept
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-gray-500 text-sm mt-4">No requests recieved.</div>
    @endif


@endsection

