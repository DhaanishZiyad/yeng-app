<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class InstructorAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    protected $table = 'instructor_availabilities';

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    /**
     * Scope a query to get availability for a specific instructor on a given day.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $instructorId
     * @param string $dayOfWeek
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function forInstructorOnDay($query, $instructorId, $dayOfWeek)
    {
        return $query->where('instructor_id', $instructorId)
                     ->where('day_of_week', $dayOfWeek);
    }
}
