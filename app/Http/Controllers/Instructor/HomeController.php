<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\YogaSession;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch pending sessions for the logged-in user
        $pendingSessions = YogaSession::where('instructor_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        $acceptedSessions = YogaSession::where('instructor_id', auth()->id())
            ->where('status', 'accepted')
            ->get();

        return view('instructor.dashboard', compact('pendingSessions', 'acceptedSessions'));
    }
}