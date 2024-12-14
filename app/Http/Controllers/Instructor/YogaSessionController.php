<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\YogaSession;

class YogaSessionController extends Controller
{
    public function accept($id)
    {
        // Find the session assigned to the instructor and ensure it's pending
        $session = YogaSession::where('id', $id)
                              ->where('instructor_id', auth()->id())
                              ->where('status', 'pending')
                              ->first();

        if (!$session) {
            return redirect()->route('instructor.dashboard')->with('error', 'Session not found or cannot be accepted.');
        }

        // Update the status to 'accepted'
        $session->update(['status' => 'accepted']);

        return redirect()->route('instructor.dashboard')->with('success', 'Session successfully accepted.');
    }

    public function decline($id)
    {
        $session = YogaSession::where('id', $id)
                              ->where('instructor_id', auth()->id())
                              ->where('status', 'pending') // Ensure only pending sessions can be canceled
                              ->first();

        if (!$session) {
            return redirect()->route('instructor.dashboard')->with('error', 'Session not found or cannot be canceled.');
        }

        $session->update(['status' => 'declined']);

        return redirect()->route('instructor.dashboard')->with('success', 'Session successfully declined.');
    }

    public function cancel($id)
    {
        $session = YogaSession::where('id', $id)
                              ->where('instructor_id', auth()->id())
                              ->whereIn('status', ['pending', 'accepted']) // Ensure only pending sessions can be canceled
                              ->first();

        if (!$session) {
            return redirect()->route('instructor.dashboard')->with('error', 'Session not found or cannot be canceled.');
        }

        $session->update(['status' => 'cancelled']);

        return redirect()->route('instructor.dashboard')->with('success', 'Session successfully canceled.');
    }

    public function show($id)
    {
        $session = YogaSession::findOrFail($id); // Fetch session details by ID
        return view('instructor.session-detail', compact('session')); // Render detailed view
    }
}
