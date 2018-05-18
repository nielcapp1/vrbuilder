<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Space;
use App\Component;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'profile_picture' => 'required|mimes:jpeg,jpg,png|max:5000',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        define('UPLOAD_DIR', 'uploads/profiles/');
        $img = $data['profilePictureEncoded'];
        $newImage = str_replace('data:image/png;base64,', '', $img);
        $image = explode(",",$img);
        $test = base64_decode($image[1]);
        $fileName = UPLOAD_DIR . uniqid() . '.jpeg';
        file_put_contents($fileName, $test);

        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_picture' => '/' . $fileName,
            'type' => 1,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Get the user
        $user = User::find($id);
        
        // Get all the spaces
        $spaces = \DB::table('spaces')->where('spaces.user_id', $user->id)->get();
        
        $components = [];
        // Get all the components
        foreach ($spaces as $space) {
            $component = \DB::table('components')->where('components.space_id', $space->id)->get();
            array_push($components, $component);
        }
        
        // Delete all the components
        foreach ($components as $component) {
            // Space has more than one component
            if (count($component) > 1) {
                foreach ($component as $file) {
                    \File::delete($file->value);
                }
            } 
            // Space has one component
            else {
                \File::delete($component[0]->value);
            }
        }

        // Delete all the spaces
        foreach ($spaces as $space) {

            // Find Thumbnail
            $thumbnail = $space->thumbnail;
            $thumbnail = explode('/', $thumbnail, 2);
            $thumbnail = $thumbnail[1];

            // Delete Thumbnail file
            \File::delete($thumbnail);

            // Delete the space record
            Space::find($space->id)->delete();

        }

        // Get the file from the uploads folder
        $profilePicture = $user->profile_picture;
        $filename = public_path().'/'.$profilePicture;

        // Delete the file from the uploads folder
        \File::delete($filename);

        // Delete the user record
        User::find($id)->delete();

        // Redirect to dashboard
        return redirect('/dashboard');

    }
}
