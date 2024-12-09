<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YogaSession;

class SessionLogController extends Controller
{
    public function index()
    {
        // Fetch pending sessions for the logged-in user
        $pendingSessions = YogaSession::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        $acceptedSessions = YogaSession::where('user_id', auth()->id())
            ->where('status', 'accepted')
            ->get();

        $declinedSessions = YogaSession::where('user_id', auth()->id())
            ->where('status', 'declined')
            ->get();

        $cancelledSessions = YogaSession::where('user_id', auth()->id())
            ->where('status', 'cancelled')
            ->get();

        $completedSessions = YogaSession::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->get();

        return view('sessions-log', compact('pendingSessions', 'acceptedSessions', 'declinedSessions', 'cancelledSessions', 'completedSessions'));
    }
}
