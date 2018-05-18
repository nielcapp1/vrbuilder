<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileController extends Controller
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

    public function index()
    {
        $user = Auth::user();
        return view('profile/index', compact('user'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function pictureEdit($id)
    {
        $user = User::find($id);

        return view('profile.profile-edit', compact('user'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */

    public function pictureUpdate(Request $request, $id)
    {

        // Validate
        $this->validate(request(), [
            'profile_picture' => 'required|mimes:jpeg,jpg,png|max:10000',
        ]);

        $user = User::find($id);

        $oldProfilePicture= substr($user->profile_picture, 1);
        \File::delete($oldProfilePicture);

        define('UPLOAD_DIR', 'uploads/profiles/');
        $img = request('profilePictureEncoded');
        $newImage = str_replace('data:image/png;base64,', '', $img);
        $image = explode(",",$img);
        $test = base64_decode($image[1]);
        $fileName = UPLOAD_DIR . uniqid() . '.jpeg';
        file_put_contents($fileName, $test);

        // Fill Title field with the Title input.
        $user->profile_picture = '/' . $fileName;
        
        // Save the space.
        $user->save();
        return redirect('profile');
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function passwordEdit($id)
    {
        $user = User::find($id);

        return view('profile.password-edit', compact('user'));
    }


    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */

    public function passwordUpdate(Request $request, $id)
    {
        $user = User::find(Auth::user()->id);

        $this->validate(request(), [
            'old_password' => 'required_with:password|string|min:6',
            'password' => 'confirmed|string|min:6',
        ]);
        
        if (Hash::check(request('old_password'), $user->password)) { 
            $user->password = Hash::make($request->get('password'));
            $user->save();
            return redirect('profile');
        } else {
            return Redirect()->back();
        }
    }

    
}
