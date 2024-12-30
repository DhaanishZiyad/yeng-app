<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InstructorAvailability;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AvailabilityController extends Controller
{
    /**
     * Get available times for a specific instructor and date.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAvailableTimes(Request $request)
    {
        $request->validate([
            'instructor_id' => 'required|exists:instructors,id',
            'date' => 'required|date',
        ]);

        $instructorId = $request->input('instructor_id');
        $date = $request->input('date');
        $dayOfWeek = Carbon::parse($date)->format('l'); // Convert date to "Monday", "Tuesday", etc.

        // Fetch available times for the given day
        $availability = DB::table('instructor_availabilities')
            ->where('instructor_id', $instructorId)
            ->where('day_of_week', $dayOfWeek)
            ->first(['start_time', 'end_time']); // Use correct column names for times

        if (!$availability) {
            // Return empty response if no availability is found
            return response()->json([]);
        }

        // Parse start_time and end_time as Carbon instances
        $startTime = Carbon::parse($availability->start_time);
        $endTime = Carbon::parse($availability->end_time);

        // Generate hourly time slots
        $timeSlots = [];
        while ($startTime->lt($endTime)) {
            $endSlotTime = $startTime->copy()->addHour(); // Increment by 1 hour
            if ($endSlotTime->gt($endTime)) {
                break;
            }

            $timeSlots[] = [
                'start_time' => $startTime->format('H:i'),
                'end_time' => $endSlotTime->format('H:i'),
            ];

            $startTime->addHour(); // Move to the next slot
        }

        return response()->json($timeSlots);
    }
}
