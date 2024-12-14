<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\YogaSession;

class SessionLogController extends Controller
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

        $declinedSessions = YogaSession::where('instructor_id', auth()->id())
            ->where('status', 'declined')
            ->get();

        $cancelledSessions = YogaSession::where('instructor_id', auth()->id())
            ->where('status', 'cancelled')
            ->get();

        $completedSessions = YogaSession::where('instructor_id', auth()->id())
            ->where('status', 'completed')
            ->get();

        return view('instructor.sessions-log', compact('pendingSessions', 'acceptedSessions', 'declinedSessions', 'cancelledSessions', 'completedSessions'));
    }
}
