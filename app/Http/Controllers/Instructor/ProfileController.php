<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Instructor;

class ProfileController extends Controller
{
    public function index()
    {
        $instructor = auth()->user();
        return view('instructor.profile' , compact('instructor'));
    }

    public function edit()
    {
        $instructor = auth()->user();
        return view('instructor.profile.edit', compact('instructor')); // Make sure 'profile.edit' exists
    }

    public function update(Request $request)
    {
        $instructor = auth()->user();

        // Validation for all fields
        $validatedData = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Limit size to 2MB
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date|before_or_equal:today',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        // Update the instructor's profile picture if provided
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($instructor->profile_picture) {
                Storage::delete($instructor->profile_picture);
            }

            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $instructor->profile_picture = $path;
        }

        // Update other instructor fields
        $instructor->name = $request->input('name');
        $instructor->dob = $request->input('dob');
        $instructor->gender = $request->input('gender');
        $instructor->address = $request->input('address');
        $instructor->city = $request->input('city');

        // Save the updated instructor information
        $instructor->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
