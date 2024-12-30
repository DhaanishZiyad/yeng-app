@extends('layouts.app')

@section('content')

<!-- Title Div -->
<div class="mb-8 flex items-center">
    <a href="{{ route('sessions-log') }}">
        <img src="/images/left arrow.svg" alt="Back" class="h-8 w-8">
    </a>
    <h1 class="text-xl font-bold font-raleway ml-2">Edit Session</h1>
</div>

<form action="{{ route('yoga-sessions.update', $session->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg border-2 border-yeng-pink-500">
    @csrf
    @method('PUT')

    <input type="hidden" name="instructor_id" value="{{ old('instructor_id', $session->instructor_id) }}">
    <input type="hidden" name="status" value="pending">

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
            value="{{ old('location', $session->location) }}" 
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
            <!-- Default blank option -->
            <option value="" disabled selected>Select a time</option>
            <!-- Display available time slots -->
            @foreach ($availableTimes as $time)
                <option 
                    value="{{ $time['start_time'] }}" 
                    {{ old('time', $session->time) == $time['start_time'] ? 'selected' : '' }}>
                    {{ $time['start_time'] }} - {{ $time['end_time'] }}
                </option>
            @endforeach
        </select>
        @error('time') 
            <p class="text-red-500 text-sm">{{ $message }}</p> 
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="flex justify-center">
        <button 
            type="submit" 
            class="bg-yeng-pink-500 px-6 py-2 text-white font-raleway font-bold rounded-full">
            Update
        </button>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById('date');
        const timeSelect = document.getElementById('time');
        const instructorId = document.querySelector('input[name="instructor_id"]').value;

        // Clear dropdown and add a default option on page load
        timeSelect.innerHTML = '<option value="" disabled selected>Select a time</option>';

        // Fetch available times dynamically based on date
        dateInput.addEventListener('change', function () {
            const selectedDate = dateInput.value;

            if (!selectedDate || !instructorId) return;

            // Clear dropdown and add a default option
            timeSelect.innerHTML = '<option value="" disabled selected>Select a time</option>';

            fetch('/get-available-times', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    instructor_id: instructorId,
                    date: selectedDate
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    const noTimesOption = document.createElement('option');
                    noTimesOption.textContent = "No times available";
                    noTimesOption.disabled = true;
                    timeSelect.appendChild(noTimesOption);
                } else {
                    data.forEach(time => {
                        const option = document.createElement('option');
                        option.value = time.start_time;
                        option.textContent = `${time.start_time} - ${time.end_time}`;
                        timeSelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching available times:', error);
                const errorOption = document.createElement('option');
                errorOption.textContent = "Error loading times";
                errorOption.disabled = true;
                timeSelect.appendChild(errorOption);
            });
        });
    });
</script>


@endsection
