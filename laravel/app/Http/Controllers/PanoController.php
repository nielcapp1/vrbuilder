<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Space;
use App\Component;

class PanoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('360-pano.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('360-pano.create');
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
            'pano' => 'required|mimes:jpeg,jpg,png|max:10000',
            'audio' => 'max:5000',
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
        define('UPLOAD_DIR_PANORAMAS', 'uploads/panoramas');
        $pano = request('pano');
        $destinationPathPano = 'uploads/pano';
        $fileNamePano = UPLOAD_DIR_PANORAMAS . '/' . uniqid() .'.'.$pano->guessExtension();
        $pano->move(UPLOAD_DIR_PANORAMAS, $fileNamePano);


        $space = Space::create([
            'title' => request('title'),
            'thumbnail' => '/' . $thumbnail,
            'type' => '1',
            'visibility' => '1',
            'user_id' => auth()->id()
        ]);

        $panorama = Component::create([
            'value' => $fileNamePano,
            'type' => '1',
            'place_number' => '1',
            'space_id' => $space->id
        ]);

        if (request('audio') != null) {

            // Move audio to folder for audio
            define('UPLOAD_DIR_SOUNDS', 'uploads/audio');
            $audio = request('audio');
            $destinationPathPano = 'uploads/pano';
            $fileNameAudio = UPLOAD_DIR_SOUNDS . '/' . uniqid() .'.mp3';
            $audio->move(UPLOAD_DIR_SOUNDS, $fileNameAudio);

            // Create sound component
            $sound = Component::create([
                'value' => $fileNameAudio,
                'type' => '2',
                'place_number' => '1',
                'space_id' => $space->id
            ]);

        }
        
        return redirect('/dashboard');
    }

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
         $pano = \DB::table('components')
            ->where('space_id', $space->id)
            ->where('type', 1)
            ->get();

        // Find Audio
        $audio = \DB::table('components')
                ->where('space_id', $space->id)
                ->where('type', 2)
                ->get();

        return view('360-pano.edit', compact('space', 'pano', 'audio'));
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
            'pano' => 'mimes:jpeg,jpg,png|max:10000',
            'audio' => 'max:5000',
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

        if ($request->file('pano') != null) {
            
            // Find Pano
            $pano = \DB::table('components')
                            ->where('space_id', $space->id)
                            ->where('type', 1)
                            ->get();

            // Delete Pano File
            \File::delete($pano[0]->value);

            // Delete Pano record
            Component::find($pano[0]->id)->delete();

            // Move panorama to folder for panoramas
            define('UPLOAD_DIR_PANORAMAS', 'uploads/panoramas');
            $pano = request('pano');
            $destinationPathPano = 'uploads/pano';
            $fileNamePano = UPLOAD_DIR_PANORAMAS . '/' . uniqid() . '.'.$pano->guessExtension();
            $pano->move(UPLOAD_DIR_PANORAMAS, $fileNamePano);

            // Create Pano record
            $panorama = Component::create([
                'value' => $fileNamePano,
                'type' => '1',
                'place_number' => '1',
                'space_id' => $space->id
            ]);    
        }

        if ($request->file('audio') != null) {

            // Find Audio
            $audio = \DB::table('components')
                        ->where('space_id', $space->id)
                        ->where('type', 2)
                        ->get();

            // Check if space has Audio
            if (count($audio) != 0) {

                // Delete Audio File
                \File::delete($audio[0]->value);

                // Delete Audio Record
                Component::find($audio[0]->id)->delete();

                // Move audio to folder for audio
                define('UPLOAD_DIR_SOUNDS', 'uploads/audio');
                $audio = request('audio');
                $fileNameAudio = UPLOAD_DIR_SOUNDS . '/' . uniqid() .'.mp3';
                $audio->move(UPLOAD_DIR_SOUNDS, $fileNameAudio);

                // Create sound component
                $sound = Component::create([
                    'value' => $fileNameAudio,
                    'type' => '2',
                    'place_number' => '1',
                    'space_id' => $space->id
                ]);

            } 
            else {
                
                // Move audio to folder for audio
                define('UPLOAD_DIR_SOUNDS', 'uploads/audio');
                $audio = request('audio');
                $fileNameAudio = UPLOAD_DIR_SOUNDS . '/' . uniqid() .'.mp3';
                $audio->move(UPLOAD_DIR_SOUNDS, $fileNameAudio);

                // Create sound component
                $sound = Component::create([
                    'value' => $fileNameAudio,
                    'type' => '2',
                    'place_number' => '1',
                    'space_id' => $space->id
                ]);
            }

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
        $pano = \DB::table('components')
                    ->where('space_id', $space->id)
                    ->where('type', 1)
                    ->get();

        // Find Audio
        $audio = \DB::table('components')
                    ->where('space_id', $space->id)
                    ->where('type', 2)
                    ->get();

        // Find Thumbnail
        $thumbnail = $space->thumbnail;
        $thumbnail = explode('/', $thumbnail, 2);
        $thumbnail = $thumbnail[1];
           
        // Delete Pano File
        \File::delete($pano[0]->value);
        // Delete Pano record
        Component::find($pano[0]->id)->delete();

        // Check if space has Audio
        if (count($audio) != 0) {
            // Delete Audio File
            \File::delete($audio[0]->value);
            // Delete Audio Record
            Component::find($audio[0]->id)->delete();
        }

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
