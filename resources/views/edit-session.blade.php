@extends('layouts.app')

@section('content')

<!-- Title Div -->
<div class="mb-8 flex items-center">
    <a href="{{ route('sessions-log') }}">
        <img src="/images/left arrow.svg" alt="Profile" class="h-8 w-8">
    </a>
    <h1 class="text-xl font-bold font-raleway ml-2">Edit Session</h1>
</div>

<form action="{{ route('yoga-sessions.update', $session->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg border-2 border-yeng-pink-500">
    @csrf
    @method('PUT')

    <input type="hidden" name="instructor_id" value="{{ old('instructor_id', $instructorId) }}">

    <!-- Instructor -->
    <div class="mb-4">
        <label for="instructor" class="block text-sm font-bold text-gray-400">Instructor</label>
        <input 
            type="text" 
            id="instructor" 
            name="instructor" 
            class="block w-full px-4 py-2 border rounded-md text-gray-900 font-bold bg-gray-100" 
            value="{{ $instructorName }}" 
            readonly
        >
    </div>

    <!-- Location -->
    <div class="mb-4">
        <label for="location" class="block text-sm font-bold text-gray-400">Location</label>
        <input 
            type="text" 
            id="location" 
            name="location" 
            class="block w-full px-4 py-2 border rounded-md text-gray-900 font-bold" 
            value="{{ old('location', $location) }}" 
        >
        @error('location') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Date -->
    <div class="mb-4">
        <label for="date" class="block text-sm font-bold text-gray-400">Date</label>
        <input 
            type="date" 
            id="date" 
            name="date" 
            class="block w-full px-4 py-2 border rounded-md text-gray-900 font-bold" 
            value="{{ old('date', $session->date) }}"
            min="{{ date('Y-m-d') }}"
        >
        @error('date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Time -->
    <div class="mb-6">
        <label for="time" class="block text-sm font-bold text-gray-400">Time</label>
        <select 
            id="time" 
            name="time" 
            class="block w-full px-4 py-2 border rounded-md text-gray-900 font-bold"
        >
            @php
                $startHour = 6; $endHour = 16; $minutes = [0, 15, 30, 45];
            @endphp
            @for ($hour = $startHour; $hour <= $endHour; $hour++)
                @foreach ($minutes as $minute)
                    @php
                        $formattedHour = $hour > 12 ? $hour - 12 : $hour;
                        $ampm = $hour >= 12 ? 'PM' : 'AM';
                        $formattedTime = sprintf('%02d:%02d', $hour, $minute);
                        $displayTime = sprintf('%d:%02d %s', $formattedHour, $minute, $ampm);
                    @endphp
                    <option value="{{ $formattedTime }}" {{ $session->time == $formattedTime ? 'selected' : '' }}>
                        {{ $displayTime }}
                    </option>
                @endforeach
            @endfor
        </select>
        @error('time') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Submit Button -->
    <div class="flex justify-center">
        <button 
            type="submit" 
            class="bg-yeng-pink-500 px-6 py-2 text-white font-bold rounded-full">
            Update
        </button>
    </div>
</form>

@endsection
