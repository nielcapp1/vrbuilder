<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Space;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the users
        $users = User::all();
        $spaces = Space::all();

        $currentUser = Auth::user();

        $visibleSpaces = \DB::table('spaces')
            ->where('user_id', $currentUser->id)
            ->where('visibility', 1)
            ->get();

        
        $hiddenSpaces = \DB::table('spaces')
            ->where('visibility', 0)
            ->get();

        return view('dashboard.index', compact('users', 'currentUser', 'spaces', 'visibleSpaces', 'hiddenSpaces'));
    }

    public function help()
    {
        return view('dashboard.help');
    }
}
