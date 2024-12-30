@extends('layouts.app')

@section('content')

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold">
        <h1 class="text-xl">Book a Session</h1>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('yoga-sessions.store') }}" method="POST" class="mx-auto bg-white p-6 py-4 mt-12 rounded-lg shadow-lg border-yeng-pink-500 border-2">
        @csrf

        <input type="hidden" name="instructor_id" value="{{ old('instructor_id', $instructorId) }}">

        <div class="mb-4">
            <label for="instructor" class="block text-sm font-bold text-gray-400">Instructor</label>
            <input 
                type="text" 
                id="instructor" 
                name="instructor" 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yeng-pink-500 text-gray-900 font-bold" 
                placeholder="Select Your Instructor"
                value="{{ old('instructor', $instructorName) }}" 
                readonly 
                onclick="window.location.href='{{ route('instructor-list') }}';" 
            >
            <x-input-error :messages="$errors->get('instructor')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label for="location" class="block text-sm font-bold text-gray-400">Location</label>
            <input 
                type="text" 
                id="location" 
                name="location" 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yeng-pink-500 text-gray-900 font-bold"
                placeholder="Your address"
                value="{{ old('location', $location) }}"
            >
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label for="date" class="block text-sm font-bold text-gray-400">Date</label>
            <input 
                type="date" 
                id="date" 
                name="date" 
                :value="old('date')" 
                min="{{ date('Y-m-d') }}"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yeng-pink-500 text-gray-900 font-bold">
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>

        <div class="mb-6">
            <label for="time" class="block text-sm font-bold text-gray-400">Time</label>
            <select 
                id="time" 
                name="time" 
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yeng-pink-500 text-gray-900 font-bold">
                <option value="" disabled selected>Select a time</option>
            </select>
            <x-input-error :messages="$errors->get('time')" class="mt-2" />
        </div>

        <div class="flex justify-center">
            <button 
                type="submit" 
                class="bg-yeng-pink-500 px-6 py-2 text-white font-bold font-raleway rounded-full">
                Book
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
        
            dateInput.addEventListener('change', function () {
                const selectedDate = dateInput.value;
            
                if (!selectedDate || !instructorId) return;
            
                // Clear dropdown and add a default option
                timeSelect.innerHTML = '<option value="" disabled selected>Select a time</option>';
            
                // Fetch available times dynamically
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
                    console.log(data); // Log response for debugging
                    if (data.length === 0) {
                        // No available times
                        const noTimesOption = document.createElement('option');
                        noTimesOption.textContent = "No times available";
                        noTimesOption.disabled = true;
                        timeSelect.appendChild(noTimesOption);
                    } else {
                        // Populate available times
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
