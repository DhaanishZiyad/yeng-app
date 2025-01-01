<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Instructor;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')->orWhereNull('role')->get();
        $instructors = Instructor::all();

        return view('admin.users', compact('users', 'instructors'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Find the user by ID
        $user->delete(); // Delete the user

        return redirect()->route('admin.users')->with('success', 'User removed successfully.');
    }

    public function destroyInstructor($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();

        return redirect()->route('admin.users')->with('success', 'Instructor removed successfully.');
    }
}
