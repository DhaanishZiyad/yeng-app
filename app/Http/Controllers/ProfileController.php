<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile' , compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user')); // Make sure 'profile.edit' exists
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validation for all fields
        $validatedData = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Limit size to 2MB
            'name' => 'required|string|max:255',
            'dob' => 'required|date|before_or_equal:today',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        // Update the user's profile picture if provided
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }

            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        // Update other user fields
        $user->name = $request->input('name');
        $user->dob = $request->input('dob');
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');
        $user->city = $request->input('city');

        // Save the updated user information
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
