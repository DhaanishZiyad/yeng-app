@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div id="success-message" 
             class="bg-green-100 text-green-800 font-bold px-4 py-3 rounded-lg shadow-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

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
            <a href="{{ route('session-view', $upcomingSession->id) }}" class="block mx-auto bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-md transition-shadow duration-200">
                <!-- Instructor and Time -->
                <div class="flex text-sm font-bold justify-between">
                    <p class="text-gray-400">Instructor</p>
                    <p class="text-gray-400">Time</p>
                </div>
                <div class="flex text-lg font-bold justify-between">
                    <p>{{ $upcomingSession->instructor->name ?? 'N/A' }}</p>
                    <p>
                        {{ \Carbon\Carbon::parse($upcomingSession->time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($upcomingSession->time)->addHour()->format('H:i') }}
                    </p>
                </div>

                <!-- Date -->
                <div class="flex text-sm font-bold mt-2 justify-between">
                    <p class="text-gray-400">{{ \Carbon\Carbon::parse($upcomingSession->date)->format('l, jS F') }}</p>
                    <span class="text-xs font-semibold px-4 py-1 rounded-full 
                    {{ $upcomingSession->status === 'accepted' ? 'bg-green-100 text-green-800' : 
                        ($upcomingSession->status === 'active' ? 'bg-purple-100 text-purple-800' : '') }}">
                    {{ ucfirst($upcomingSession->status) }}
                </span>
                </div>

                <!-- Location -->
                <div class="flex text-sm font-bold mt-2">
                    <p class="text-gray-400">⚲ {{ $upcomingSession->location }}</p>
                </div>

                <!-- Buttons -->
                <div class="flex text-sm font-bold justify-end mt-4">
                    <form action="{{ route('user.yoga-sessions.cancel', $upcomingSession->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="text-yeng-pink-500 border-yeng-pink-500 border-2 p-8 py-2 rounded-full font-raleway">Cancel</button>
                    </form>
                    <!-- <a href="{{ route('yoga-sessions.edit', $upcomingSession->id) }} class="bg-yeng-pink-500 p-3 py-2 ml-2 rounded-full"">
                        <button class="bg-yeng-pink-500 p-3 py-2 ml-2 rounded-full">
                            <img src="/images/Pencil.svg" alt="Icon" class="h-6 w-4">
                        </button>
                    </a> -->
                </div>
            </a>
        @endif
    @else
        <div class="text-gray-500 text-sm mt-4 mb-32">No upcoming sessions.</div>
    @endif

    <!-- Title Div -->
    <div class="flex justify-between items-center font-raleway font-bold mt-4">
        <h1 class="text-xl">Instructors Nearby</h1>
        <a href="{{ route('instructor-list') }}">
            <p class="text-yeng-pink-500 text-sm">VIEW ALL</p>
        </a>
    </div>

    @if($instructors->isEmpty())
        <div class="text-gray-500 text-sm mt-4">No instructors found in your city.</div>
    @else
        <!-- Instructors Grid -->
        <div class="grid grid-cols-2 gap-4 mt-4">
            @foreach ($instructors as $instructor)
                <a href="{{ route('instructors.show', ['id' => $instructor->id]) }}" class="block">
                    <div class="bg-white p-6 py-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 hover:shadow-2xl transition-shadow">
                        <!-- Profile Circle -->
                        <div class="flex-shrink-0 h-20 w-20 mx-auto rounded-full overflow-hidden bg-gray-200">
                            @if($instructor->profile_picture)
                                <img src="{{ asset('storage/' . $instructor->profile_picture) }}" alt="{{ $instructor->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="bg-gray-200 text-yeng-pink-500 flex items-center justify-center h-full w-full font-bold uppercase">
                                    {{ strtoupper(substr($instructor->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <!-- Instructor Details -->
                        <div class="text-center mt-4">
                        <h2 class="text-lg font-bold text-gray-900 truncate overflow-hidden whitespace-nowrap">{{ $instructor->name }}</h2>
                        <h2 class="text-sm font-bold @if(strtolower($instructor->gender) == 'male') text-blue-400 @elseif(strtolower($instructor->gender) == 'female') text-pink-400 @else text-green-400 @endif">
                                {{ ucfirst($instructor->gender) }}
                            </h2>
                            <h2 class="text-sm font-bold text-gray-500 mt-1">⚲ {{ $instructor->city }}</h2>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    <script>
        // Automatically hide the success message after 5 seconds
        document.addEventListener('DOMContentLoaded', () => {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.transition = "opacity 0.5s ease-in-out";
                    successMessage.style.opacity = "0";
                    setTimeout(() => successMessage.remove(), 500); // Remove element after fade-out
                }, 3000); // 5 seconds
            }
        });
    </script>

@endsection
