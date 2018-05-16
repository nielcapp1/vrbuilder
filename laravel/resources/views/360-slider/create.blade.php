@extends('layouts.master')

@section ('navigation-link')
<a href="{{ url('/') }}">
    <i class="material-icons">
        arrow_back
    </i>
</a>
<p class="left">Voeg 360° slider omgeving toe</p>
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
        <form method="POST" action="{{ url('/360-slider/store') }}" enctype='multipart/form-data'>  
            {{ csrf_field() }}
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
                        <input id="title" type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" autofocus>
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
                                <img src="" id="thumbnail-img-output" />
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
                                Kies het aantal slides
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="info">
                            <p>Bepaal het aantal slides met beelden in de slideshow<br>door een cijfer te kiezen.</p>
                        </div>
                    </div>
                </div>
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <p>
                            <label>
                                <input class="with-gap" id='slides_2' name="slides" type="radio" value="2" checked/><span>2 Slides</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input class="with-gap" id='slides_3' name="slides" type="radio" value="3"/><span>3 Slides</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input class="with-gap" id='slides_4' name="slides" type="radio" value="4"/><span>4 Slides</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input class="with-gap" id='slides_5' name="slides" type="radio" value="5"/><span>5 Slides</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input class="with-gap" id='slides_6' name="slides" type="radio" value="6"/><span>6 Slides</span>
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
                                Voeg afbeeldingen toe aan de slideshow
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="info">
                            <p>Klik op de camera om een slide toe te voegen.</p>
                        </div>
                    </div>
                </div>
                <div class="row center-align">
                        <div class="col l3 m4 s6" id="slides_1_input">
                            <label class="btn-upload center-block">
                                <div class="slide-preview">
                                    <img src="" id="slide-1-img-output" />
                                    <i class="material-icons">camera_alt</i>
                                </div>
                                <input type="file" name="slide1" id="slide1" class="slide-1-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                                <input id="slide-1-Encoded" name="slide-1-Encoded">
                                @if ($errors->has('slide1'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('slide1') }}</strong>
                                </span>
                                @endif
                            </label>
                            <input placeholder="Titel" id="title_slide_1" type="text" name="title_slide_1" class="form-control{{ $errors->has('title_slide_1') ? ' is-invalid' : '' }}" value="{{ old('title_slide_1') }}" autofocus>
                            @if ($errors->has('title_slide_1'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title_slide_1') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col l3 m4 s6" id="slides_2_input">
                            <label class="btn-upload center-block">
                                <div class="slide-preview">
                                    <img src="" id="slide-2-img-output" />
                                    <i class="material-icons">camera_alt</i>
                                </div>
                                <input type="file" name="slide2" id="slide2" class="slide-2-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                                <input id="slide-2-Encoded" name="slide-2-Encoded">
                                @if ($errors->has('slide2'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('slide2') }}</strong>
                                </span>
                                @endif
                            </label>
                            <input placeholder="Titel" id="title_slide_2" type="text" name="title_slide_2" class="form-control{{ $errors->has('title_slide_2') ? ' is-invalid' : '' }}" value="{{ old('title_slide_2') }}" autofocus>
                            @if ($errors->has('title_slide_2'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title_slide_2') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col l3 m4 s6" id="slides_3_input">
                            <label class="btn-upload center-block">
                                <div class="slide-preview">
                                    <img src="" id="slide-3-img-output" />
                                    <i class="material-icons">camera_alt</i>
                                </div>
                                <input type="file" name="slide3" id="slide3" class="slide-3-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                                <input id="slide-3-Encoded" name="slide-3-Encoded">
                                @if ($errors->has('slide3'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('slide3') }}</strong>
                                </span>
                                @endif
                            </label>
                            <input placeholder="Titel" id="title_slide_3" type="text" name="title_slide_3" class="form-control{{ $errors->has('title_slide_3') ? ' is-invalid' : '' }}" value="{{ old('title_slide_3') }}" autofocus>
                            @if ($errors->has('title_slide_3'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title_slide_3') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col l3 m4 s6" id="slides_4_input">
                            <label class="btn-upload center-block">
                                <div class="slide-preview">
                                    <img src="" id="slide-4-img-output" />
                                    <i class="material-icons">camera_alt</i>
                                </div>
                                <input type="file" name="slide4" id="slide4" class="slide-4-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                                <input id="slide-4-Encoded" name="slide-4-Encoded">
                                @if ($errors->has('slide4'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('slide4') }}</strong>
                                </span>
                                @endif
                            </label>
                            <input placeholder="Titel" id="title_slide_4" type="text" name="title_slide_4" class="form-control{{ $errors->has('title_slide_4') ? ' is-invalid' : '' }}" value="{{ old('title_slide_4') }}" autofocus>
                            @if ($errors->has('title_slide_4'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title_slide_4') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col l3 m4 s6" id="slides_5_input">
                            <label class="btn-upload center-block">
                                <div class="slide-preview">
                                    <img src="" id="slide-5-img-output" />
                                    <i class="material-icons">camera_alt</i>
                                </div>
                                <input type="file" name="slide5" id="slide5" class="slide-5-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                                <input id="slide-5-Encoded" name="slide-5-Encoded">
                                @if ($errors->has('slide5'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('slide5') }}</strong>
                                </span>
                                @endif
                            </label>
                            <input placeholder="Titel" id="title_slide_5" type="text" name="title_slide_5" class="form-control{{ $errors->has('title_slide_5') ? ' is-invalid' : '' }}" value="{{ old('title_slide_5') }}" autofocus>
                            @if ($errors->has('title_slide_5'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title_slide_5') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col l3 m4 s6" id="slides_6_input">
                            <label class="btn-upload center-block">
                                <div class="slide-preview">
                                    <img src="" id="slide-6-img-output" />
                                    <i class="material-icons">camera_alt</i>
                                </div>
                                <input type="file" name="slide6" id="slide6" class="slide-6-input image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                                <input id="slide-6-Encoded" name="slide-6-Encoded">
                                @if ($errors->has('slide6'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('slide6') }}</strong>
                                </span>
                                @endif
                            </label>
                            <input placeholder="Titel" id="title_slide_6" type="text" name="title_slide_6" class="form-control{{ $errors->has('title_slide_6') ? ' is-invalid' : '' }}" value="{{ old('title_slide_6') }}" autofocus>
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
                            <audio hidden src="" id="audio-output" controls autoplay></audio>     
                            <input type="file" name="audio" id="audio" class="audio-input center-block" accept="audio/*"/>
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
                            <div class="empty-fields-info">
                                <div class="info">
                                    <p>U heeft nog geen enkel veld ingevuld.</p>
                                </div>
                            </div>
                            <div class="empty-fields">
                                <div class="info">
                                    <p>Hier kunt u een preview van de omgevingskaart zien.<br>Klik op opslaan om te bevestigen.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row center-align">
                    <div class="col s10 m6 l4 offset-l4 offset-m3 offset-s1">
                        <div class="card card-preview">
                            <div class="card-image">
                                <img src="" id="card-thumbnail-img-output" />
                            </div>
                            <div class="card-content">
                                <p id="card-title"></p>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row center-align">
                        <div class="empty-fields">
                            <button class="btn" type="submit">
                                <i class="material-icons left" aria-hidden="true">save</i>
                                Opslaan
                            </button>
                        </div>
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

