<?php

use Illuminate\Http\Request;
use App\Space;
use App\Component;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('spaces', function () {
    return response(Space::all(), 200);
});


Route::get('users', function () {
    return response(User::all(), 200);
});


Route::get('spaces/{space}', function ($spaceId) {
    
    $space = Space::find($spaceId);

    $panorama = \DB::table('components')
        ->where('space_id', $spaceId)
        ->where('type', 1)
        ->get();

    $audio = \DB::table('components')
        ->where('space_id', $spaceId)
        ->where('type', 2)
        ->get();

    $videopano = \DB::table('components')
        ->where('space_id', $spaceId)
        ->where('type', 3)
        ->get();

    $slides = \DB::table('components')
        ->where('space_id', $spaceId)
        ->where('type', 4)
        ->get();

    return compact('space', 'panorama', 'audio', 'videopano', 'slides', 200);
});
  