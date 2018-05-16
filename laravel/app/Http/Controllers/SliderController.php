<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Space;
use App\Component;

class SliderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('360-slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('360-slider.create');
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
            'slide1' => 'mimes:jpeg,jpg,png|max:10000',
            'slide2' => 'mimes:jpeg,jpg,png|max:10000',
            'slide3' => 'mimes:jpeg,jpg,png|max:10000',
            'slide4' => 'mimes:jpeg,jpg,png|max:10000',
            'slide5' => 'mimes:jpeg,jpg,png|max:10000',
            'slide6' => 'mimes:jpeg,jpg,png|max:10000',
            'audio' => 'max:5000',
        ]);
        

        // Move thumbnail to folder for thumbnails
        define('UPLOAD_DIR_THUMBNAILS', 'uploads/thumbnails');
        define('UPLOAD_DIR_SLIDES', 'uploads/slides');
        $thumbnailEncoded = request('thumbnailEncoded');
        $splitImage = explode('base64,', $thumbnailEncoded);
        $image = $splitImage[1];
        $imageDecoded = base64_decode($image);
        $thumbnail = UPLOAD_DIR_THUMBNAILS . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';
        file_put_contents($thumbnail, $imageDecoded);

        $space = Space::create([
            'title' => request('title'),
            'thumbnail' => DIRECTORY_SEPARATOR . $thumbnail,
            'type' => '3',
            'visibility' => '1',
            'user_id' => auth()->id()
        ]);

        if (request('slide-1-Encoded') != null) {
            $slide1Encoded = request('slide-1-Encoded');
            $splitImage = explode('base64,', $slide1Encoded);
            $image = $splitImage[1];
            $imageDecoded = base64_decode($image);
            $slide1 = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';
            file_put_contents($slide1, $imageDecoded);
            $title1 = request('title_slide_1');
            Component::create([
                'value' => $slide1,
                'title' => $title1,
                'type' => '4',
                'place_number' => '1',
                'space_id' => $space->id
            ]);
        }

        if (request('slide-2-Encoded') != null) {
            $slide2Encoded = request('slide-2-Encoded');
            $splitImage = explode('base64,', $slide2Encoded);
            $image = $splitImage[1];
            $imageDecoded = base64_decode($image);
            $slide2 = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';
            file_put_contents($slide2, $imageDecoded);
            $title2 = request('title_slide_2');
            Component::create([
                'value' => $slide2,
                'title' => $title2,
                'type' => '4',
                'place_number' => '2',
                'space_id' => $space->id
            ]);
        }

        if (request('slide-3-Encoded') != null) {
            $slide3Encoded = request('slide-3-Encoded');
            $splitImage = explode('base64,', $slide3Encoded);
            $image = $splitImage[1];
            $imageDecoded = base64_decode($image);
            $slide3 = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';
            file_put_contents($slide3, $imageDecoded);
            $title3 = request('title_slide_3');
            Component::create([
                'value' => $slide3,
                'title' => $title3,
                'type' => '4',
                'place_number' => '3',
                'space_id' => $space->id
            ]);
        }

        if (request('slide-4-Encoded') != null) {
            $slide4Encoded = request('slide-4-Encoded');
            $splitImage = explode('base64,', $slide4Encoded);
            $image = $splitImage[1];
            $imageDecoded = base64_decode($image);
            $slide4 = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';
            file_put_contents($slide4, $imageDecoded);
            $title4 = request('title_slide_4');
            Component::create([
                'value' => $slide4,
                'title' => $title4,
                'type' => '4',
                'place_number' => '4',
                'space_id' => $space->id
            ]);
        }

        if (request('slide-5-Encoded') != null) {
            $slide5Encoded = request('slide-5-Encoded');
            $splitImage = explode('base64,', $slide5Encoded);
            $image = $splitImage[1];
            $imageDecoded = base64_decode($image);
            $slide5 = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';
            file_put_contents($slide5, $imageDecoded);
            $title5 = request('title_slide_5');
            Component::create([
                'value' => $slide5,
                'title' => $title5,
                'type' => '4',
                'place_number' => '5',
                'space_id' => $space->id
            ]);
        }

        if (request('slide-6-Encoded') != null) {
            $slide6Encoded = request('slide-6-Encoded');
            $splitImage = explode('base64,', $slide6Encoded);
            $image = $splitImage[1];
            $imageDecoded = base64_decode($image);
            $slide6 = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';
            file_put_contents($slide6, $imageDecoded);
            $title6 = request('title_slide_6');
            Component::create([
                'value' => $slide6,
                'title' => $title6,
                'type' => '4',
                'place_number' => '6',
                'space_id' => $space->id
            ]);
        }

        if (request('audio') != null) {

            // Move audio to folder for audio
            define('UPLOAD_DIR_SOUNDS', 'uploads/audio');
            $audio = request('audio');
            $destinationPathPano = 'uploads/pano';
            $fileNameAudio = UPLOAD_DIR_SOUNDS . DIRECTORY_SEPARATOR . uniqid() .'.mp3';
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {

        $space = Space::find($id);

        // Find Slides
        $slides = \DB::table('components')
            ->where('space_id', $space->id)
            ->where('type', 4)
            ->orderBy('place_number', 'asc')
            ->get();

        $encodedSlides = [];

        foreach($slides as $slide) {
            array_push($encodedSlides, 'data:image/jpeg;base64,'.base64_encode(file_get_contents($slide->value)));
        }

        // Find Audio
        $audio = \DB::table('components')
                ->where('space_id', $space->id)
                ->where('type', 2)
                ->get();

        return view('360-slider.edit', compact('space', 'slides', 'encodedSlides', 'audio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        // Validate
        $this->validate(request(), [
            'title' => 'required|string|min:2|max:255',
            'thumbnail' => 'mimes:jpeg,jpg,png|max:5000',
            'slide1' => 'mimes:jpeg,jpg,png|max:10000',
            'slide2' => 'mimes:jpeg,jpg,png|max:10000',
            'slide3' => 'mimes:jpeg,jpg,png|max:10000',
            'slide4' => 'mimes:jpeg,jpg,png|max:10000',
            'slide5' => 'mimes:jpeg,jpg,png|max:10000',
            'slide6' => 'mimes:jpeg,jpg,png|max:10000',
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
            $newThumbnail = UPLOAD_DIR_THUMBNAILS . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';
            file_put_contents($newThumbnail, $imageDecoded);

            // Put the new url in the database
            $space->thumbnail = DIRECTORY_SEPARATOR . $newThumbnail;
            
        }

        

        // Move panorama to folder for panoramas
        define('UPLOAD_DIR_SLIDES', 'uploads/slides');

        // START SLIDE 1 UPDATE
        // If Slide 1 Input is Filled
        if (request('slide-1-Encoded') != null) {
            
            // Find Slide 1 Component
            $slide = \DB::table('components')
                ->where('space_id', $space->id)
                ->where('type', 4)
                ->where('place_number', 1)
                ->get();

            // If Slide 1 exists...
            if (count($slide) != 0) {

                // Delete Slide 1 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 1 record Component
                Component::find($slide[0]->id)->delete();

                // Get Image
                $slideEncoded = request('slide-1-Encoded');

                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 1
                $title = request('title_slide_1');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '1',
                    'space_id' => $space->id
                ]);

            }
            else if (count($slide) == 0) {

                // Get Image
                $slideEncoded = request('slide-1-Encoded');
                
                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 1
                $title = request('title_slide_1');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '1',
                    'space_id' => $space->id
                ]);

            }

        }
        // If Slide 1 Input is not Filled
        else if (request('slide-1-Encoded') == null) {
            
            // Find Slide 1 Component
            $slide = \DB::table('components')
            ->where('space_id', $space->id)
            ->where('type', 4)
            ->where('place_number', 1)
            ->get();

            // If Slide 1 exists...
            if (count($slide) != 0) {

                // Delete Slide 1 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 1 record Component
                Component::find($slide[0]->id)->delete();
            }

        }
        // END SLIDE 1 UPDATE


        // START SLIDE 2 UPDATE
        // If Slide 2 Input is Filled
        if (request('slide-2-Encoded') != null) {
            
            // Find Slide 2 Component
            $slide = \DB::table('components')
                ->where('space_id', $space->id)
                ->where('type', 4)
                ->where('place_number', 2)
                ->get();

            // If Slide 2 exists...
            if (count($slide) != 0) {

                // Delete Slide 2 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 2 record Component
                Component::find($slide[0]->id)->delete();

                // Get Image
                $slideEncoded = request('slide-2-Encoded');

                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 2
                $title = request('title_slide_2');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '2',
                    'space_id' => $space->id
                ]);

            }
            else if (count($slide) == 0) {

                // Get Image
                $slideEncoded = request('slide-2-Encoded');
                
                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 2
                $title = request('title_slide_2');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '2',
                    'space_id' => $space->id
                ]);

            }

        }
        // If Slide 2 Input is not Filled
        else if (request('slide-2-Encoded') == null) {
            
            // Find Slide 2 Component
            $slide = \DB::table('components')
            ->where('space_id', $space->id)
            ->where('type', 4)
            ->where('place_number', 2)
            ->get();

            // If Slide 2 exists...
            if (count($slide) != 0) {

                // Delete Slide 2 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 2 record Component
                Component::find($slide[0]->id)->delete();
            }

        }
        // END SLIDE 2 UPDATE
        
        // START SLIDE 3 UPDATE
        // If Slide 3 Input is Filled
        if (request('slide-3-Encoded') != null) {

            // Find Slide 3 Component
            $slide = \DB::table('components')
                ->where('space_id', $space->id)
                ->where('type', 4)
                ->where('place_number', 3)
                ->get();

            // If Slide 3 exists...
            if (count($slide) != 0) {

                // Delete Slide 3 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 3 record Component
                Component::find($slide[0]->id)->delete();

                // Get Image
                $slideEncoded = request('slide-3-Encoded');

                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 3
                $title = request('title_slide_3');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '3',
                    'space_id' => $space->id
                ]);

            }
            else if (count($slide) == 0) {

                // Get Image
                $slideEncoded = request('slide-3-Encoded');
                
                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 3
                $title = request('title_slide_3');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '3',
                    'space_id' => $space->id
                ]);

            }

        }
        // If Slide 3 Input is not Filled
        else if (request('slide-3-Encoded') == null) {
            
            // Find Slide 3 Component
            $slide = \DB::table('components')
            ->where('space_id', $space->id)
            ->where('type', 4)
            ->where('place_number', 3)
            ->get();

            // If Slide 3 exists...
            if (count($slide) != 0) {

                // Delete Slide 3 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 3 record Component
                Component::find($slide[0]->id)->delete();
            }

        }
        // END SLIDE 3 UPDATE

        // START SLIDE 4 UPDATE
        // If Slide 4 Input is Filled
        if (request('slide-4-Encoded') != null) {
            
            // Find Slide 4 Component
            $slide = \DB::table('components')
                ->where('space_id', $space->id)
                ->where('type', 4)
                ->where('place_number', 4)
                ->get();

            // If Slide 4 exists...
            if (count($slide) != 0) {

                // Delete Slide 4 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 4 record Component
                Component::find($slide[0]->id)->delete();

                // Get Image
                $slideEncoded = request('slide-4-Encoded');

                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 4
                $title = request('title_slide_4');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '4',
                    'space_id' => $space->id
                ]);

            }
            else if (count($slide) == 0) {

                // Get Image
                $slideEncoded = request('slide-4-Encoded');
                
                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 4
                $title = request('title_slide_4');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '4',
                    'space_id' => $space->id
                ]);

            }

        }
        // If Slide 4 Input is not Filled
        else if (request('slide-4-Encoded') == null) {
            
            // Find Slide 4 Component
            $slide = \DB::table('components')
                ->where('space_id', $space->id)
                ->where('type', 4)
                ->where('place_number', 4)
                ->get();

            // If Slide 4 exists...
            if (count($slide) != 0) {

                // Delete Slide 4 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 4 record Component
                Component::find($slide[0]->id)->delete();
            }

        }
        // END SLIDE 4 UPDATE
        
        // START SLIDE 5 UPDATE
        // If Slide 5 Input is Filled
        if (request('slide-5-Encoded') != null) {

            // Find Slide 5 Component
            $slide = \DB::table('components')
                ->where('space_id', $space->id)
                ->where('type', 4)
                ->where('place_number', 5)
                ->get();

            // If Slide 5 exists...
            if (count($slide) != 0) {

                // Delete Slide 5 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 5 record Component
                Component::find($slide[0]->id)->delete();

                // Get Image
                $slideEncoded = request('slide-5-Encoded');

                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 5
                $title = request('title_slide_5');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '5',
                    'space_id' => $space->id
                ]);

            }
            else if (count($slide) == 0) {

                // Get Image
                $slideEncoded = request('slide-5-Encoded');
                
                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 5
                $title = request('title_slide_5');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '5',
                    'space_id' => $space->id
                ]);

            }

        }
        // If Slide 5 Input is not Filled
        else if (request('slide-5-Encoded') == null) {
            
            // Find Slide 5 Component
            $slide = \DB::table('components')
            ->where('space_id', $space->id)
            ->where('type', 4)
            ->where('place_number', 5)
            ->get();

            // If Slide 5 exists...
            if (count($slide) != 0) {

                // Delete Slide 5 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 5 record Component
                Component::find($slide[0]->id)->delete();
            }

        }
        // END SLIDE 5 UPDATE

        // START SLIDE 6 UPDATE
        // If Slide 6 Input is Filled
        if (request('slide-6-Encoded') != null) {
            
            // Find Slide 6 Component
            $slide = \DB::table('components')
                ->where('space_id', $space->id)
                ->where('type', 4)
                ->where('place_number', 6)
                ->get();

            // If Slide 6 exists...
            if (count($slide) != 0) {

                // Delete Slide 6 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 6 record Component
                Component::find($slide[0]->id)->delete();

                // Get Image
                $slideEncoded = request('slide-6-Encoded');

                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 6
                $title = request('title_slide_6');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '6',
                    'space_id' => $space->id
                ]);

            }
            else if (count($slide) == 0) {

                // Get Image
                $slideEncoded = request('slide-6-Encoded');
                
                // Get Base 64
                $splitImage = explode('base64,', $slideEncoded);
                $image = $splitImage[1];

                // Decode Base64 to Image
                $imageDecoded = base64_decode($image);

                // Create Filename
                $slide = UPLOAD_DIR_SLIDES . DIRECTORY_SEPARATOR . uniqid() . '.jpeg';

                // Put File in Public Folder
                file_put_contents($slide, $imageDecoded);

                // Get Title for Slide 6
                $title = request('title_slide_6');

                // Create Component
                Component::create([
                    'value' => $slide,
                    'title' => $title,
                    'type' => '4',
                    'place_number' => '6',
                    'space_id' => $space->id
                ]);

            }

        }
        // If Slide 6 Input is not Filled
        else if (request('slide-6-Encoded') == null) {
            
            // Find Slide 6 Component
            $slide = \DB::table('components')
            ->where('space_id', $space->id)
            ->where('type', 4)
            ->where('place_number', 6)
            ->get();

            // If Slide 6 exists...
            if (count($slide) != 0) {

                // Delete Slide 6 File Component
                \File::delete($slide[0]->value);

                // Delete Slide 6 record Component
                Component::find($slide[0]->id)->delete();
            }

        }
        // END SLIDE 6 UPDATE


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
                $fileNameAudio = UPLOAD_DIR_SOUNDS . DIRECTORY_SEPARATOR . uniqid() .'.mp3';
                $audio->move(UPLOAD_DIR_SOUNDS, $fileNameAudio);

                // Create sound component
                $sound = Component::create([
                    'value' => $fileNameAudio,
                    'type' => '2',
                    'place_number' => '1',
                    'space_id' => $space->id
                ]);

            } else {
                
                // Move audio to folder for audio
                define('UPLOAD_DIR_SOUNDS', 'uploads/audio');
                $audio = request('audio');
                $fileNameAudio = UPLOAD_DIR_SOUNDS . DIRECTORY_SEPARATOR . uniqid() .'.mp3';
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

        // Find Audio
        $audio = \DB::table('components')
            ->where('space_id', $space->id)
            ->where('type', 2)
            ->get();

        // Find Slides
        $slides = \DB::table('components')
            ->where('space_id', $space->id)
            ->where('type', 4)
            ->get();

        // For every slide...
        foreach ($slides as $slide) {
            // Delete Slide File
            \File::delete($slide->value);
            // Delete Slide Record
            Component::find($slide->id)->delete();
        }

        // Check if space has Audio
        if (count($audio) != 0) {
            // Delete Audio File
            \File::delete($audio[0]->value);
            // Delete Audio Record
            Component::find($audio[0]->id)->delete();
        }

        // Find Thumbnail
        $thumbnail = $space->thumbnail;
        $thumbnail = explode('/', $thumbnail, 2);
        $thumbnail = $thumbnail[1];

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
