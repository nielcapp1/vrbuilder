<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->middleware('guest');

Route::get('/builder', function () {
    return view('builder');
})->middleware('guest');

Auth::routes();




Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');
Route::get('/help', 'DashboardController@help')->middleware('auth');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('admin');
Route::post('register', 'Auth\RegisterController@register')->middleware('admin');
Route::delete('/users/{user}/delete', 'Auth\RegisterController@destroy')->middleware('admin');

Route::get('/profile', 'ProfileController@index')->name('index')->middleware('auth');
Route::get('/profile/{user}/change-profile-picture', 'ProfileController@pictureEdit')->name('profile-edit')->middleware('auth');
Route::put('/profile/{user}/change-profile-picture', 'ProfileController@pictureUpdate')->name('profile.pictureUpdate')->middleware('auth');

Route::get('/profile/{user}/change-password', 'ProfileController@passwordEdit')->name('password-edit')->middleware('auth');
Route::put('/profile/{user}/change-password', 'ProfileController@passwordUpdate')->name('profile.passwordUpdate')->middleware('auth');



Route::get('/vr', 'VRController@index')->name('index');
Route::get('/preview/{space}', 'PreviewController@show')->middleware('auth');

Route::get('/360-pano/create', 'PanoController@create')->middleware('auth');
Route::get('/360-pano/{space}/edit', 'PanoController@edit')->name('360-pano.edit')->middleware('auth');
Route::delete('/360-pano/{space}/delete', 'PanoController@destroy')->middleware('auth');
Route::post('/360-pano/store', '\App\Http\Controllers\PanoController@store')->middleware('auth');
Route::put('/360-pano/{space}', 'PanoController@update')->name('360-pano.update')->middleware('auth');
Route::put('/360-pano/{space}/hide', 'PanoController@hide')->middleware('auth');
Route::put('/360-pano/{space}/show', 'PanoController@show')->middleware('auth');


Route::get('/360-video-pano/create', 'VideoPanoController@create')->middleware('auth');
Route::get('/360-video-pano/{space}/edit', 'VideoPanoController@edit')->name('360-video-pano.edit')->middleware('auth');
Route::delete('/360-video-pano/{space}/delete', 'VideoPanoController@destroy')->middleware('auth');
Route::post('/360-video-pano/store', '\App\Http\Controllers\VideoPanoController@store')->middleware('auth');
Route::put('/360-video-pano/{space}', 'VideoPanoController@update')->name('360-video-pano.update')->middleware('auth');
Route::put('/360-video-pano/{space}/hide', 'VideoPanoController@hide')->middleware('auth');
Route::put('/360-video-pano/{space}/show', 'VideoPanoController@show')->middleware('auth');

Route::get('/360-slider/create', 'SliderController@create')->middleware('auth');
Route::get('/360-slider/{space}/edit', 'SliderController@edit')->name('360-slider.edit')->middleware('auth');
Route::delete('/360-slider/{space}/delete', 'SliderController@destroy')->middleware('auth');
Route::post('/360-slider/store', '\App\Http\Controllers\SliderController@store')->middleware('auth');
Route::put('/360-slider/{space}', 'SliderController@update')->name('360-slider.update')->middleware('auth');
Route::put('/360-slider/{space}/hide', 'SliderController@hide')->middleware('auth');
Route::put('/360-slider/{space}/show', 'SliderController@show')->middleware('auth');


Route::get('/360-image-room/create', 'ImageRoomController@create')->middleware('auth');
Route::get('/360-image-room/{space}/edit', 'ImageRoomController@edit')->name('360-image-room.edit')->middleware('auth');
Route::delete('/360-image-room/{space}/delete', 'ImageRoomController@destroy')->middleware('auth');
Route::post('/360-image-room/store', '\App\Http\Controllers\ImageRoomController@store')->middleware('auth');
Route::put('/360-image-room/{space}', 'ImageRoomController@update')->name('360-image-room.update')->middleware('auth');
Route::put('/360-image-room/{space}/hide', 'ImageRoomController@hide')->middleware('auth');
Route::put('/360-image-room/{space}/show', 'ImageRoomController@show')->middleware('auth');

Route::get('/360-timeline/create', 'TimelineController@create')->middleware('auth');
Route::get('/360-timeline/{space}/edit', 'TimelineController@edit')->name('360-timeline.edit')->middleware('auth');
Route::delete('/360-timeline/{space}/delete', 'TimelineController@destroy')->middleware('auth');
Route::post('/360-timeline/store', '\App\Http\Controllers\TimelineController@store')->middleware('auth');
Route::put('/360-timeline/{space}', 'TimelineController@update')->name('360-timeline.update')->middleware('auth');
Route::put('/360-timeline/{space}/hide', 'TimelineController@hide')->middleware('auth');
Route::put('/360-timeline/{space}/show', 'TimelineController@show')->middleware('auth');


Route::get('/', 'SpaceController@index')->name('home')->middleware('guest');
