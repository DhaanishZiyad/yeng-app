@extends('layouts.instructor-app')

@section('content')

    <!-- Title Div -->
    <div class="mb-8 flex items-center">
        <a href="{{ route('instructor.profile') }}">
            <img src="/images/left arrow.svg" alt="Profile" class="h-8 w-8">
        </a>
        <h1 class="text-xl font-bold font-raleway ml-2">Edit Profile</h1>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Edit Profile Form -->
    <form action="{{ route('instructor.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Profile Picture -->
        <div class="mb-6">
            <label for="profile_picture" class="block text-gray-700 font-semibold">Profile Picture</label>
            @if ($instructor->profile_picture)
                <img src="{{ asset('storage/' . $instructor->profile_picture) }}" alt="Profile Picture" class="rounded-full w-16 h-16 mt-4">
            @else
                <p class="text-gray-500 mt-2">No profile picture uploaded.</p>
            @endif
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="mt-4 block w-full">
            <small class="text-gray-500">Max file size: 2MB</small>
        </div>

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $instructor->name) }}" 
                class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-400 focus:border-blue-400 text-sm">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Date of Birth -->
        <div class="mb-4">
            <label for="dob" class="block text-gray-700 font-semibold">Date of Birth</label>
            <input type="date" name="dob" id="dob" value="{{ old('dob', $instructor->dob) }}" 
                max="{{ date('Y-m-d') }}"
                class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-400 focus:border-blue-400 text-sm">
            @error('dob')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Gender -->
        <div class="mb-4">
            <label for="gender" class="block text-gray-700 font-semibold">Gender</label>
            <select name="gender" id="gender" 
                class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-400 focus:border-blue-400 text-sm">
                <option value="" disabled>Select Gender</option>
                <option value="male" {{ old('gender', $instructor->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $instructor->gender) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender', $instructor->gender) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Address -->
        <div class="mb-4">
            <label for="address" class="block text-gray-700 font-semibold">Address</label>
            <input type="text" name="address" id="address" value="{{ old('address', $instructor->address) }}" 
                class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-400 focus:border-blue-400 text-sm">
            @error('address')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- City -->
        <div class="mb-4">
            <label for="city" class="block text-gray-700 font-semibold">City</label>
            <select name="city" id="city" 
                class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-400 focus:border-blue-400 text-sm">
                <option value="" disabled>Select City</option>
                <option value="Colombo" {{ old('city', $instructor->city) == 'Colombo' ? 'selected' : '' }}>Colombo</option>
                <option value="Mount Lavinia" {{ old('city', $instructor->city) == 'Mount Lavinia' ? 'selected' : '' }}>Mount Lavinia</option>
                <option value="Kesbewa" {{ old('city', $instructor->city) == 'Kesbewa' ? 'selected' : '' }}>Kesbewa</option>
                <option value="Maharagama" {{ old('city', $instructor->city) == 'Maharagama' ? 'selected' : '' }}>Maharagama</option>
                <option value="Moratuwa" {{ old('city', $instructor->city) == 'Moratuwa' ? 'selected' : '' }}>Moratuwa</option>
                <option value="Ratnapura" {{ old('city', $instructor->city) == 'Ratnapura' ? 'selected' : '' }}>Ratnapura</option>
                <option value="Negombo" {{ old('city', $instructor->city) == 'Negombo' ? 'selected' : '' }}>Negombo</option>
                <option value="Kandy" {{ old('city', $instructor->city) == 'Kandy' ? 'selected' : '' }}>Kandy</option>
                <option value="Sri Jayewardenepura Kotte" {{ old('city', $instructor->city) == 'Sri Jayewardenepura Kotte' ? 'selected' : '' }}>Sri Jayewardenepura Kotte</option>
                <option value="Kalmunai" {{ old('city', $instructor->city) == 'Kalmunai' ? 'selected' : '' }}>Kalmunai</option>
                <option value="Trincomalee" {{ old('city', $instructor->city) == 'Trincomalee' ? 'selected' : '' }}>Trincomalee</option>
                <option value="Galle" {{ old('city', $instructor->city) == 'Galle' ? 'selected' : '' }}>Galle</option>
                <option value="Jaffna" {{ old('city', $instructor->city) == 'Jaffna' ? 'selected' : '' }}>Jaffna</option>
                <option value="Athurugiriya" {{ old('city', $instructor->city) == 'Athurugiriya' ? 'selected' : '' }}>Athurugiriya</option>
                <option value="Weligama" {{ old('city', $instructor->city) == 'Weligama' ? 'selected' : '' }}>Weligama</option>
                <option value="Matara" {{ old('city', $instructor->city) == 'Matara' ? 'selected' : '' }}>Matara</option>
                <option value="Kolonnawa" {{ old('city', $instructor->city) == 'Kolonnawa' ? 'selected' : '' }}>Kolonnawa</option>
                <option value="Gampaha" {{ old('city', $instructor->city) == 'Gampaha' ? 'selected' : '' }}>Gampaha</option>
                <option value="Puttalam" {{ old('city', $instructor->city) == 'Puttalam' ? 'selected' : '' }}>Puttalam</option>
                <option value="Badulla" {{ old('city', $instructor->city) == 'Badulla' ? 'selected' : '' }}>Badulla</option>
                <option value="Kalutara" {{ old('city', $instructor->city) == 'Kalutara' ? 'selected' : '' }}>Kalutara</option>
                <option value="Bentota" {{ old('city', $instructor->city) == 'Bentota' ? 'selected' : '' }}>Bentota</option>
                <option value="Mannar" {{ old('city', $instructor->city) == 'Mannar' ? 'selected' : '' }}>Mannar</option>
                <option value="Kurunegala" {{ old('city', $instructor->city) == 'Kurunegala' ? 'selected' : '' }}>Kurunegala</option>
            </select>
            @error('city')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-8 flex justify-center">
            <button type="submit" class="bg-yeng-pink-500 text-white font-bold px-8 py-2 rounded-full">
                Save Changes
            </button>
        </div>
        
    </form>
    <script>
        document.getElementById('profile_picture').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file && file.size > 2 * 1024 * 1024) { // 2MB in bytes
                alert('File size exceeds 2MB. Please upload a smaller file.');
                event.target.value = ''; // Clear the file input
            }
        });
    </script>

@endsection
