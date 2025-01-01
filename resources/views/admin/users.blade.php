@extends('layouts.admin-app')

@section('content')

    @if(session('success'))
        <div id="success-message" 
             class="bg-green-100 text-green-800 font-bold px-4 py-3 rounded-lg shadow-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold mb-4">
        <h1 class="text-xl">Users</h1>
    </div>

    <!-- Responsive Table for Users -->
    <div class="mb-8">
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Gender</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Dob</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Address</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">City</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->gender }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->dob }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->address }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->city }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold mb-4">
        <h1 class="text-xl">Instructors</h1>
    </div>

    <!-- Responsive Table for Instructors -->
    <div>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Gender</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Dob</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Address</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">City</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instructors as $instructor)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $instructor->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $instructor->gender }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $instructor->dob }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $instructor->email }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $instructor->address }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $instructor->city }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <form action="{{ route('admin.instructors.destroy', $instructor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this instructor?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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
