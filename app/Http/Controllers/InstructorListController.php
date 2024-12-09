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
}
