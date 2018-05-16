@extends('layouts.master')

@section ('navigation-link')
<a href="{{ url('/') }}">
    <i class="material-icons">
        arrow_back
    </i>
</a>
<p class="left">Bewerk 360° beeldenkamer omgeving</p>
@endsection

@section ('content')
<main>
    <!-- Tabs -->
    <div class="row">
        <div class="form-indicator">
            <div class="col l6 m8 s12 offset-l3 offset-m2">
                <ul class="tabs tabs-fixed-width">
                    <li class="tab col l1 m3 s2">
                        <a class="active" href="#step1">Stap 1</a>
                    </li>
                    <li class="tab col l1 m3 s2">
                        <a href="#step2">Stap 2</a>
                    </li>
                    <li class="tab col l1 m3 s2">
                        <a href="#step3">Stap 3</a>
                    </li>
                    <li class="tab col l1 m3 s2">
                        <a href="#step4">Stap 4</a>
                    </li>
                    <li class="tab col l1 m3 s2">
                        <a href="#step5">Stap 5</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Form -->
    <div class="container">
        <form method="POST" action="{{ route('360-image-room.update', ['id' => $space->id ]) }}"  enctype='multipart/form-data'>
            {{ csrf_field() }}
            {{ method_field('PUT')}} 
            <div id="step1" class="col s12">
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="title-bar">
                            <h1>
                                <i class="material-icons right step-two" aria-hidden="true">arrow_forward</i>
                                Informatie
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="info">
                            <p>Voeg een titel en thumbnail toe aan de omgeving.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label for="title" class="col-form-label text-md-right">{{ __('Titel') }}</label>
                        <input id="title" type="text" name="title" value="{{ $space->title }}" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" autofocus>
                        @if ($errors->has('thumbnail'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label for="thumbnail" class="col-form-label text-md-right">Thumbnail</label>
                    </div>
                </div>
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label class="btn-upload center-block">
                            <div class="thumbnail-preview">
                                <img src="{{ asset($space->thumbnail) }}" id="thumbnail-img-output" />
                                <i class="material-icons">camera_alt</i>
                            </div>
                            <input type="file" name="thumbnail" id="thumbnail" class="thumbnail-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                            <input type="hidden" id="thumbnailEncoded" name="thumbnailEncoded">
                            @if ($errors->has('thumbnail'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('thumbnail') }}</strong>
                            </span>
                            @endif
                        </label>
                    </div>
                </div>
            </div> 
            <div id="step2" class="col s12">
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="title-bar">
                            <h1>
                                <i class="material-icons left step-one" aria-hidden="true">arrow_back</i>
                                <i class="material-icons right step-three" aria-hidden="true">arrow_forward</i>
                                Kies het aantal beelden
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="info">
                            <p>Bepaal het aantal beelden in de beeldenkamer<br>door een cijfer te kiezen.</p>
                        </div>
                    </div>
                </div>
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <p>
                            <label>
                                @if (count($slides) >= 2 )
                                <input class="with-gap" id='slides_2' name="slides" type="radio" value="2" checked/><span>2 Beelden</span>
                                @else 
                                <input class="with-gap" id='slides_2' name="slides" type="radio" value="2"/><span>2 Beelden</span>
                                @endif
                            </label>
                        </p>
                        <p>
                            <label>
                                @if (count($slides) >= 3 )
                                <input class="with-gap" id='slides_3' name="slides" type="radio" value="3" checked/><span>3 Beelden</span>
                                @else 
                                <input class="with-gap" id='slides_3' name="slides" type="radio" value="3"/><span>3 Beelden</span>
                                @endif
                            </label>
                        </p>
                        <p>
                            <label>
                                @if (count($slides) >= 4 )
                                <input class="with-gap" id='slides_4' name="slides" type="radio" value="4" checked/><span>4 Beelden</span>
                                @else 
                                <input class="with-gap" id='slides_4' name="slides" type="radio" value="4"/><span>4 Beelden</span>
                                @endif
                            </label>
                        </p>
                        <p>
                            <label>
                                @if (count($slides) >= 5 )
                                <input class="with-gap" id='slides_5' name="slides" type="radio" value="5" checked/><span>5 Beelden</span>
                                @else 
                                <input class="with-gap" id='slides_5' name="slides" type="radio" value="5"/><span>5 Beelden</span>
                                @endif
                            </label>
                        </p>
                        <p>
                            <label>
                                @if (count($slides) >= 6 )
                                <input class="with-gap" id='slides_6' name="slides" type="radio" value="6" checked/><span>6 Beelden</span>
                                @else 
                                <input class="with-gap" id='slides_6' name="slides" type="radio" value="6"/><span>6 Beelden</span>
                                @endif
                            </label>
                        </p>
                    </div>
                </div>
            </div>  
            <div id="step3" class="col s12">
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="title-bar">
                            <h1>
                                <i class="material-icons left step-two" aria-hidden="true">arrow_back</i>
                                <i class="material-icons right step-four" aria-hidden="true">arrow_forward</i>
                                Voeg afbeeldingen toe aan de beeldenkamer
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="info">
                            <p>Klik op de camera om een afbeelding toe te voegen.</p>
                        </div>
                    </div>
                </div>
                <div class="row center-align">
                    <div class="col l3 m4 s6" id="slides_1_input">
                        <label class="btn-upload center-block">
                            <div class="slide-preview">
                                <img src="{{ asset($slides[0]->value) }}" id="slide-1-img-output" />
                                <i class="material-icons">camera_alt</i>
                            </div>
                            <input type="file"  name="slide1" id="slide1" class="slide-1-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                            <input value="{{$encodedSlides[0]}}" id="slide-1-Encoded" name="slide-1-Encoded">
                            @if ($errors->has('slide1'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('slide1') }}</strong>
                            </span>
                            @endif
                        </label>
                        <input placeholder="Titel" value="{{$slides[0]->title}}" id="title_slide_1" type="text" name="title_slide_1" class="form-control{{ $errors->has('title_slide_1') ? ' is-invalid' : '' }}" value="{{ old('title_slide_1') }}" autofocus>
                        @if ($errors->has('title_slide_1'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title_slide_1') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col l3 m4 s6" id="slides_2_input">
                        <label class="btn-upload center-block">
                            <div class="slide-preview">
                                <img src="{{ asset($slides[1]->value) }}" id="slide-2-img-output" />
                                <i class="material-icons">camera_alt</i>
                            </div>
                            <input type="file" name="slide2" id="slide2" class="slide-2-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                            <input value="{{$encodedSlides[1]}}" id="slide-2-Encoded" name="slide-2-Encoded">                                        
                            @if ($errors->has('slide2'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('slide2') }}</strong>
                            </span>
                            @endif
                        </label>
                        <input placeholder="Titel" value="{{$slides[1]->title}}" id="title_slide_2" type="text" name="title_slide_2" class="form-control{{ $errors->has('title_slide_2') ? ' is-invalid' : '' }}" value="{{ old('title_slide_2') }}" autofocus>
                        @if ($errors->has('title_slide_2'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title_slide_2') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col l3 m4 s6" id="slides_3_input">
                        <label class="btn-upload center-block">
                            <div class="slide-preview">
                                @if (count($slides) >= 3)
                                <img src="{{ asset($slides[2]->value) }}" id="slide-3-img-output" />
                                <i class="material-icons">camera_alt</i>
                                @else
                                <img src="" id="slide-3-img-output" />
                                <i class="material-icons">camera_alt</i>
                                @endif
                            </div>
                            <input type="file" name="slide3" id="slide3" class="slide-3-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                            @if (count($slides) >= 3)
                            <input value="{{$encodedSlides[2]}}" id="slide-3-Encoded" name="slide-3-Encoded">  
                            @else
                            <input id="slide-3-Encoded" name="slide-3-Encoded">  
                            @endif                                 
                            @if ($errors->has('slide3'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('slide3') }}</strong>
                            </span>
                            @endif
                        </label>
                        @if (count($slides) >= 3)
                        <input placeholder="Titel" value="{{$slides[2]->title}}" id="title_slide_3" type="text" name="title_slide_3" class="form-control{{ $errors->has('title_slide_3') ? ' is-invalid' : '' }}" value="{{ old('title_slide_3') }}" autofocus>
                        @else
                        <input placeholder="Titel" id="title_slide_3" type="text" name="title_slide_3" class="form-control{{ $errors->has('title_slide_3') ? ' is-invalid' : '' }}" value="{{ old('title_slide_3') }}" autofocus>
                        @endif 
                        @if ($errors->has('title_slide_3'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title_slide_3') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col l3 m4 s6" id="slides_4_input">
                        <label class="btn-upload center-block">
                            <div class="slide-preview">
                                @if (count($slides) >= 4)
                                <img src="{{ asset($slides[3]->value) }}" id="slide-4-img-output" />
                                <i class="material-icons">camera_alt</i>
                                @else
                                <img src="" id="slide-4-img-output" />
                                <i class="material-icons">camera_alt</i>
                                @endif
                            </div>
                            <input type="file" name="slide4" id="slide4" class="slide-4-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                            @if (count($slides) >= 4)
                            <input value="{{$encodedSlides[3]}}" id="slide-4-Encoded" name="slide-4-Encoded">                                        
                            @else
                            <input id="slide-4-Encoded" name="slide-4-Encoded">                                
                            @endif
                            @if ($errors->has('slide4'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('slide4') }}</strong>
                            </span>
                            @endif
                        </label>
                        @if (count($slides) >= 4)
                        <input placeholder="Titel" value="{{$slides[3]->title}}" id="title_slide_4" type="text" name="title_slide_4" class="form-control{{ $errors->has('title_slide_4') ? ' is-invalid' : '' }}" value="{{ old('title_slide_4') }}" autofocus>
                        @else
                        <input placeholder="Titel" id="title_slide_4" type="text" name="title_slide_4" class="form-control{{ $errors->has('title_slide_4') ? ' is-invalid' : '' }}" value="{{ old('title_slide_4') }}" autofocus>
                        @endif
                        @if ($errors->has('title_slide_4'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title_slide_4') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col l3 m4 s6" id="slides_5_input">
                        <label class="btn-upload center-block">
                            <div class="slide-preview">
                                @if (count($slides) >= 5)
                                <img src="{{ asset($slides[4]->value) }}" id="slide-5-img-output" />
                                <i class="material-icons">camera_alt</i>
                                @else
                                <img src="" id="slide-5-img-output" />
                                <i class="material-icons">camera_alt</i>
                                @endif
                            </div>
                            <input type="file" name="slide5" id="slide5" class="slide-5-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                            @if (count($slides) >= 5)
                            <input value="{{$encodedSlides[4]}}" id="slide-5-Encoded" name="slide-5-Encoded">                                        
                            @else
                            <input id="slide-5-Encoded" name="slide-5-Encoded">                                
                            @endif
                            @if ($errors->has('slide5'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('slide5') }}</strong>
                            </span>
                            @endif
                        </label>
                        @if (count($slides) >= 5)
                        <input placeholder="Titel" value="{{$slides[4]->title}}" id="title_slide_5" type="text" name="title_slide_5" class="form-control{{ $errors->has('title_slide_5') ? ' is-invalid' : '' }}" value="{{ old('title_slide_5') }}" autofocus>
                        @else
                        <input placeholder="Titel" id="title_slide_5" type="text" name="title_slide_5" class="form-control{{ $errors->has('title_slide_5') ? ' is-invalid' : '' }}" value="{{ old('title_slide_5') }}" autofocus>                            
                        @endif
                        @if ($errors->has('title_slide_5'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title_slide_5') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col l3 m4 s6" id="slides_6_input">
                        <label class="btn-upload center-block">
                            <div class="slide-preview">
                                @if (count($slides) >= 6 )
                                    <img src="{{ asset($slides[5]->value) }}" id="slide-6-img-output" />
                                    <i class="material-icons">camera_alt</i>
                                @else 
                                    <img src="" id="slide-6-img-output" />
                                    <i class="material-icons">camera_alt</i>
                                @endif   
                            </div>
                            <input type="file" name="slide6" id="slide6" class="slide-6-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                            @if (count($encodedSlides) >= 6 )
                                <input value="{{$encodedSlides[5]}}"  id="slide-6-Encoded" name="slide-6-Encoded">
                            @else 
                                <input id="slide-6-Encoded" name="slide-6-Encoded">  
                            @endif  
                            @if ($errors->has('slide6'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('slide6') }}</strong>
                                </span>
                            @endif
                        </label>
                        @if (count($slides) >= 6 )
                            <input placeholder="Titel" value="{{$slides[5]->title}}" id="title_slide_6" type="text" name="title_slide_6" class="form-control{{ $errors->has('title_slide_6') ? ' is-invalid' : '' }}" value="{{ old('title_slide_6') }}" autofocus>
                        @else 
                            <input placeholder="Titel" id="title_slide_6" type="text" name="title_slide_6" class="form-control{{ $errors->has('title_slide_6') ? ' is-invalid' : '' }}" value="{{ old('title_slide_6') }}" autofocus>
                        @endif
                        @if ($errors->has('title_slide_6'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title_slide_6') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>  
            <div id="step4" class="col s12">
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="title-bar">
                            <h1>
                                <i class="material-icons left step-three" aria-hidden="true">arrow_back</i>
                                <i class="material-icons right step-five" aria-hidden="true">arrow_forward</i>                                    
                                Voeg een audio fragment toe
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="info">
                            <p>Het toevoegen van een audio fragment is optioneel.</p>
                        </div>
                    </div>
                </div>
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label class="btn-upload center-block">
                            <div class="audio-preview">
                                <i class="material-icons">audiotrack</i>
                                <p id="audio-name"></p>
                            </div>
                            @if (count($audio) != 0)
                            <audio hidden src="{{ asset($audio[0]->value) }}" id="audio-output" controls autoplay></audio> 
                            @else   
                                <audio hidden src="" id="audio-output" controls autoplay></audio>
                            @endif
                            <input type="file" name="audio" id="audio" class="audio-input center-block"accept="audio/*"/>
                            @if ($errors->has('audio'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('audio') }}</strong>
                            </span>
                            @endif
                        </label>
                    </div>
                </div>
            </div>
            <div id="step5" class="col s12">
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="title-bar">
                            <h1>
                                <i class="material-icons left step-four" aria-hidden="true">arrow_back</i>
                                Bevestigen
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="info">
                            <p>Hier kunt u een preview van de omgevingskaart zien.<br>Klik op opslaan om te bevestigen.</p>
                        </div>
                    </div>
                </div>
                <div class="row center-align">
                <div class="col s10 m6 l4 offset-l4 offset-m3 offset-s1">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ asset($space->thumbnail) }}" id="card-thumbnail-img-output"/>
                        </div>
                        <div class="card-content">
                            <p id="card-title">{{ $space->title }}</p>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row center-align">
                    <button class="btn" type="submit">
                        <i class="material-icons left" aria-hidden="true">save</i>
                        Wijzigingen opslaan
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- Modals -->
    <div class="modals">
        <!-- Thumbnail Modal -->
        @include ('partials.thumbnail-crop-modal')
        <!-- Slide Modals -->
        @include('partials.slides-crop-modals')
        <!-- Error Modal -->
        @include ('partials.errors')
    </div>
</main>
@endsection


   