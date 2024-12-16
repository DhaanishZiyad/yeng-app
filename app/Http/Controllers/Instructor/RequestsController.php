<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\YogaSession;

class RequestsController extends Controller
{
    public function index()
    {
        // Fetch pending sessions for the logged-in user
        $pendingSessions = YogaSession::where('instructor_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        return view('instructor.requests', compact('pendingSessions'));
    }
}