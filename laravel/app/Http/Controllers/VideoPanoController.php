<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Space;
use App\Component;

class VideoPanoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('360-video-pano.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $this->validate(request(), [
            'title' => 'required|string|min:2|max:255',
            'thumbnail' => 'required|mimes:jpeg,jpg,png|max:5000',
            'video_pano' => 'required|mimes:mp4,mov,ogg|max:50000'
        ]);

        // Move thumbnail to folder for thumbnails
        define('UPLOAD_DIR_THUMBNAILS', 'uploads/thumbnails');
        $thumbnailEncoded = request('thumbnailEncoded');
        $splitImage = explode('base64,', $thumbnailEncoded);
        $image = $splitImage[1];
        $imageDecoded = base64_decode($image);
        $thumbnail = UPLOAD_DIR_THUMBNAILS . '/' . uniqid() . '.jpeg';
        file_put_contents($thumbnail, $imageDecoded);

        // Move panorama to folder for panoramas
        define('UPLOAD_DIR_VIDEOPANO', 'uploads/videopano');
        $videopano = request('video_pano');
        $fileNameVideoPano = UPLOAD_DIR_VIDEOPANO . '/' . uniqid() .'.'.$videopano->guessExtension();
        $videopano->move(UPLOAD_DIR_VIDEOPANO, $fileNameVideoPano);


        $space = Space::create([
            'title' => request('title'),
            'thumbnail' => '/' . $thumbnail,
            'type' => '2',
            'visibility' => '1',
            'user_id' => auth()->id()
        ]);

        $panorama = Component::create([
            'value' => $fileNameVideoPano,
            'type' => '3',
            'place_number' => '1',
            'space_id' => $space->id
        ]);
        
        return redirect('/dashboard');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Nominee $nominee)
    // {
    //     $categories = $nominee->categories;
    //     return view('backoffice.nominees.show', compact('nominee', 'categories'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($id)
    {
        $space = Space::find($id);

        // Find Pano
        $videopano = \DB::table('components')
            ->where('space_id', $space->id)
            ->where('type', 3)
            ->get();

        return view('360-video-pano.edit', compact('space', 'videopano'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */

    public function update(Request $request, $id)
    {
        // Validate
        $this->validate(request(), [
            'title' => 'required|string|min:2|max:255',
            'thumbnail' => 'mimes:jpeg,jpg,png|max:5000',
            'video_pano' => 'mimes:mp4,mov,ogg|max:50000'
        ]);

        $space = Space::find($id);
        
        if ($request->file('thumbnail') != null) {
            // Delete the old picture
            $thumbnail = $space->thumbnail;
            $thumbnail = explode('/', $thumbnail, 2);
            $thumbnail = $thumbnail[1];
            \File::delete($thumbnail);

            // Move thumbnail to folder for thumbnails
            define('UPLOAD_DIR_THUMBNAILS', 'uploads/thumbnails');
            $thumbnailEncoded = request('thumbnailEncoded');
            $splitImage = explode('base64,', $thumbnailEncoded);
            $image = $splitImage[1];
            $imageDecoded = base64_decode($image);
            $newThumbnail = UPLOAD_DIR_THUMBNAILS . '/' . uniqid() . '.jpeg';
            file_put_contents($newThumbnail, $imageDecoded);

            // Put the new url in the database
            $space->thumbnail = '/' . $newThumbnail;
            
        }
        
        if (request('video_pano') != null) {
            
            // Find VideoPano
            $videopano = \DB::table('components')
                            ->where('space_id', $space->id)
                            ->where('type', 3)
                            ->get();

            // Delete Pano File
            \File::delete($videopano[0]->value);

            // Delete Pano record
            Component::find($videopano[0]->id)->delete();

            // Move panorama to folder for panoramas
            define('UPLOAD_DIR_VIDEOPANO', 'uploads/videopano');
            $videopano = request('video_pano');
            $fileNameVideoPano = UPLOAD_DIR_VIDEOPANO . '/' . uniqid() . '.'.$videopano->guessExtension();
            $videopano->move(UPLOAD_DIR_VIDEOPANO, $fileNameVideoPano);

            // Create Pano record
            $videopanorama = Component::create([
                'value' => $fileNameVideoPano,
                'type' => '3',
                'place_number' => '1',
                'space_id' => $space->id
            ]);    
        }

        // Fill Title field with the Title input.
        $space->title = $request->get('title');
        
        // Save the space.
        $space->save();

        return redirect()->route('dashboard');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        // Find Space
        $space = Space::find($id);

        // Find Pano
        $videopano = \DB::table('components')
                            ->where('space_id', $space->id)
                            ->where('type', 3)
                            ->get();

        // Find Thumbnail
        $thumbnail = $space->thumbnail;
        $thumbnail = explode('/', $thumbnail, 2);
        $thumbnail = $thumbnail[1];
           
        // Delete Pano File
        \File::delete($videopano[0]->value);
        // Delete Pano record
        Component::find($videopano[0]->id)->delete();

        // Delete Thumbnail file
        \File::delete($thumbnail);

        // Delete Space
        Space::find($id)->delete();

        // Return to dashboard
        return redirect('/dashboard');
    }

    // /**
    //  * Hide the specified resource from the visible spaces.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function hide($id)
    {
        // Find Space
        $space = Space::find($id);

        // Fill Visibility field with 0.
        $space->visibility = '0';
        
        // Save the space.
        $space->save();

        // Return to dashboard
        return redirect('/dashboard');
    }

    // /**
    //  * Show the specified resource in the visible spaces.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function show($id)
    {
        // Find Space
        $space = Space::find($id);

        // Fill Visibility field with 1.
        $space->visibility = '1';
        
        // Save the space.
        $space->save();

        // Return to dashboard
        return redirect('/dashboard');
    }
    
}
