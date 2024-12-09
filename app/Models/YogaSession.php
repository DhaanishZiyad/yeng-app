<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YogaSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'instructor_id',
        'location',
        'date',
        'time',
        'status',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

