<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Space;
use App\User;
use Illuminate\Http\Response;

class SpaceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spaces = \DB::table('spaces')
                        ->where('visibility', 1)
                        ->get();
                        
        $users = User::all();

        return view('home', compact('spaces', 'users'));
    }
}
