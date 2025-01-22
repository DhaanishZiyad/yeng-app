<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InstructorListController extends Controller
{
    public function index()
    {
        $instructors = Instructor::all();
        return view('instructor-list', compact('instructors'));
    }

    // public function show($id)
    // {
    //     // Fetch the instructor details by ID
    //     $instructor = Instructor::findOrFail($id);

    //     // Pass the instructor details to the view
    //     return view('instructor-detail', compact('instructor'));
    // }

    public function show($id)
    {
        // Fetch the instructor details with their availability
        $instructor = Instructor::with('availabilities')->findOrFail($id);

        // Pass the instructor and their availabilities to the view
        return view('instructor-detail', compact('instructor'));
    }
}
