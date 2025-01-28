@extends('layouts.app')

@section('content')

Title
<div class="mb-8 flex items-center">
    <a href="{{ url()->previous() }}">
        <img src="/images/left arrow.svg" alt="Profile" class="h-8 w-8">
    </a>
    <h1 class="text-xl font-bold font-raleway ml-2">Instructors</h1>
</div>

<!-- Filter Toggle -->
<div class="mb-6">
    <label class="flex items-center space-x-2 cursor-pointer">
        <input type="checkbox" id="filter-city" class="h-5 w-5 text-yeng-pink-500 focus:ring-yeng-pink-500 rounded border-gray-300">
        <span class="font-bold text-gray-900">Show only instructors from my city</span>
    </label>
</div>

<!-- Instructors List -->
<div id="instructors-list">
    @foreach ($instructors as $instructor)
        <div class="instructor-item bg-white p-6 py-4 mt-4 rounded-lg shadow-lg border-yeng-pink-500 border-2 cursor-pointer" data-city="{{ $instructor->city }}"">
            <div class="flex items-center">
                <!-- Profile Circle -->
                <div class="flex-shrink-0 h-14 w-14 rounded-full overflow-hidden bg-gray-200">
                    @if($instructor->profile_picture)
                        <img src="{{ asset('storage/' . $instructor->profile_picture) }}" alt="{{ $instructor->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="bg-gray-200 text-yeng-pink-500 flex items-center justify-center h-full w-full font-bold uppercase">
                            {{ strtoupper(substr($instructor->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div class="flex flex-col w-max">
                    <div class="ml-4">
                        <h2 class="text-lg font-bold text-gray-900">{{ $instructor->name }}</h2>
                        <h2 class="text-sm font-bold
                            @if(strtolower($instructor->gender) == 'male') text-blue-400
                            @elseif(strtolower($instructor->gender) == 'female') text-pink-400
                            @else text-green-400 @endif">
                            {{ ucfirst($instructor->gender) }}
                        </h2>
                        <h2 class="text-sm font-bold text-gray-500 mt-1">⚲ {{ $instructor->city }}</h2>
                    </div>
                </div>
            </div>
            <div class="flex text-sm font-bold mt-4 justify-end">
                <button class="font-raleway text-white border-yeng-pink-500 bg-yeng-pink-500 border-2 p-8 py-2 ml-2 rounded-full" onclick="window.location.href='{{ route('booking', ['instructor_name' => $instructor->name, 'instructor_id' => $instructor->id]) }}'">
                    Book
                </button>
            </div>
        </div>
    @endforeach
</div>

@endsection

@push('scripts')
<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const filterCheckbox = document.getElementById('filter-city');
    //     const instructorsList = document.getElementById('instructors-list');
    //     // const userCity = "{{ strtolower(auth()->user()->city ?? '') }}"; // User's city from auth
    //     const userCity = "{{ strtolower(trim(auth()->user()->city ?? '')) }}";


    //     filterCheckbox.addEventListener('change', function () {
    //         const instructorItems = instructorsList.querySelectorAll('.instructor-item');

    //         if (this.checked) {
    //             instructorItems.forEach(item => {
    //                 const instructorCity = item.dataset.city;
    //                 if (instructorCity !== userCity) {
    //                     item.classList.add('hidden');
    //                 }
    //             });
    //         } else {
    //             instructorItems.forEach(item => item.classList.remove('hidden'));
    //         }
    //     });
    // });


    document.addEventListener('DOMContentLoaded', function () {
    const filterCheckbox = document.getElementById('filter-city');
    const instructorsList = document.getElementById('instructors-list');
    const userCity = "{{ auth()->user()->city ?? '' }}".trim(); // Get user city as stored in DB

    console.log("User's city:", userCity); // Debug user's city

    filterCheckbox.addEventListener('change', function () {
        const instructorItems = instructorsList.querySelectorAll('.instructor-item');

        instructorItems.forEach(item => {
            const instructorCity = item.dataset.city.trim(); // Get instructor city as stored in DB
            console.log("Instructor's city:", instructorCity); // Debug instructor's city

            if (this.checked) {
                // Case-insensitive comparison
                if (instructorCity.toLowerCase() !== userCity.toLowerCase()) {
                    item.classList.add('hidden'); // Hide if cities don't match
                } else {
                    item.classList.remove('hidden'); // Show if cities match
                }
            } else {
                item.classList.remove('hidden'); // Show all when unchecked
            }
        });
    });
});
</script>
@endpush
