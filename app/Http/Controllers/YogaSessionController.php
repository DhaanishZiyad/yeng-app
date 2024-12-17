<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YogaSession;

class YogaSessionController extends Controller
{
    public function create(Request $request)
    {
        // Retrieve the instructor name and ID from the query parameters
        $instructorName = $request->query('instructor_name', '');
        $instructorId = $request->query('instructor_id', null);

        // Retrieve the user's address or a default location
        $location = auth()->user()->address ?? 'Enter your address';

        // Pass the data to the view
        return view('booking', compact('instructorName', 'instructorId', 'location'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'instructor' => 'required|string',
            'instructor_id' => 'required|integer',
            'location' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Save the data to the database
        YogaSession::create([
            'user_id' => auth()->id(), // Assuming the user is logged in
            'instructor_id' => $request->input('instructor_id'), // Replace with actual instructor ID
            'location' => $request->input('location'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'status' => 'pending', // Default status
        ]);

        // Redirect with success message
        return redirect()->route('dashboard')->with('success', 'Session successfully booked!');
    }

    public function cancel($id)
    {
        $session = YogaSession::where('id', $id)
                              ->where('user_id', auth()->id())
                              ->whereIn('status', ['pending', 'accepted'])
                              ->first();

        if (!$session) {
            return redirect()->route('dashboard')->with('error', 'Session not found or cannot be canceled.');
        }

        $session->update(['status' => 'cancelled']);

        return redirect()->route('dashboard')->with('success', 'Session successfully canceled.');
    }

    public function show($id)
    {
        $session = YogaSession::findOrFail($id); // Fetch session details by ID
        return view('session-detail', compact('session')); // Render detailed view
    }

    public function edit($id)
    {
        // Fetch the session belonging to the user and check status
        $session = YogaSession::where('id', $id)
                              ->where('user_id', auth()->id())
                              ->whereIn('status', ['pending', 'accepted'])
                              ->firstOrFail();

        // Pass session data to the view
        return view('edit-session', [
            'session' => $session,
            'instructorName' => $session->instructor->name ?? 'N/A',
            'instructorId' => $session->instructor_id,
            'location' => $session->location,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string',
        ]);

        // Fetch the session and check if it can be updated
        $session = YogaSession::where('id', $id)
                              ->where('user_id', auth()->id())
                              ->whereIn('status', ['pending', 'accepted'])
                              ->firstOrFail();

        // Update the session details
        $session->update([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'location' => $request->input('location'),
        ]);

        return redirect()->route('sessions-log')->with('success', 'Session updated successfully.');
    }

    public function clearDeclined()
    {
        // Find all declined sessions belonging to the authenticated user
        $sessions = YogaSession::where('user_id', auth()->id())
                               ->where('status', 'declined')
                               ->get();

        // Check if there are any sessions to clear
        if ($sessions->isEmpty()) {
            return redirect()->route('sessions-log')->with('error', 'No declined sessions to clear.');
        }

        // Update status to "cleared"
        foreach ($sessions as $session) {
            $session->update(['status' => 'cleared']);
        }

        return redirect()->route('sessions-log')->with('success', 'Declined sessions have been cleared.');
    }

    public function clearCancelled()
    {
        // Find all cancelled sessions belonging to the authenticated user
        $sessions = YogaSession::where('user_id', auth()->id())
                               ->where('status', 'cancelled')
                               ->get();

        // Check if there are any sessions to clear
        if ($sessions->isEmpty()) {
            return redirect()->route('sessions-log')->with('error', 'No cancelled sessions to clear.');
        }

        // Update status to "cleared"
        foreach ($sessions as $session) {
            $session->update(['status' => 'cleared']);
        }

        return redirect()->route('sessions-log')->with('success', 'Cancelled sessions have been cleared.');
    }


}
