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
                              ->whereIn('status', ['pending', 'accepted'])
                              ->first();

        if (!$session) {
            return redirect()->route('instructor.dashboard')->with('error', 'Session not found or cannot be canceled.');
        }

        $session->update(['status' => 'cancelled']);

        return redirect()->route('instructor.dashboard')->with('success', 'Session successfully canceled.');
    }

    public function start($id)
    {
        // Fetch the session
        $session = YogaSession::findOrFail($id);

        // Update the session status to 'active'
        $session->status = 'active';
        $session->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Session has been started and marked as active.');
    }

    public function complete(Request $request, $id)
    {
        // Fetch the session by ID
        $session = YogaSession::where('id', $id)
            ->where('instructor_id', auth()->id())
            ->where('status', 'active')
            ->firstOrFail();

        // Update the session status to 'completed'
        $session->update([
            'status' => 'completed',
            //'completed_at' => now(), // Optional: Track when the session was completed
        ]);

        return redirect()->route('instructor.dashboard')->with('success', 'Session marked as completed.');
    }


    public function show($id)
    {
        $session = YogaSession::findOrFail($id); // Fetch session details by ID
        return view('instructor.session-detail', compact('session')); // Render detailed view
    }
}
