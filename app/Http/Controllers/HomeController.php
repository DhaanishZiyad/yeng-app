<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\YogaSession;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $age = Carbon::parse($user->dob)->age;
        // Fetch pending sessions for the logged-in user
        $pendingSessions = YogaSession::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        $acceptedSessions = YogaSession::where('user_id', auth()->id())
            ->where('status', 'accepted')
            ->get();

        return view('dashboard', compact('pendingSessions', 'acceptedSessions', 'user', 'age'));
    }
}
