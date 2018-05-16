@extends('layouts.master')

@section ('navigation-link')
<a href="{{ url('/') }}">
    <i class="material-icons">
        arrow_back
    </i>
</a>
<p class="left">Bewerk 360° video omgeving</p>
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
                </ul>
            </div>
        </div>
    </div>
    <!-- Foms -->
    <div class="container">
        <form method="POST" action="{{ route('360-video-pano.update', ['id' => $space->id ]) }}"  enctype='multipart/form-data'>
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
                                Voeg een 360° video toe
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="info">
                            <p>Klik op de camera om een 360° video toe te voegen.</p>
                        </div>
                    </div>
                </div>
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label class="btn-upload center-block">
                            <div class="video-pano-preview">
                                <i class="material-icons">videocam</i>
                                <p id="video-pano-name"></p>
                            <video src="{{ asset($videopano[0]->value) }}" id="video-pano-output" loop autoplay></video>
                            </div>
                            <input type="file" name="video_pano" id="video_pano" class="video-pano-input center-block" accept="video/*"/>
                            @if ($errors->has('video_pano'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('video_pano') }}</strong>
                            </span>
                            @endif
                        </label>
                    </div>
                </div>
            </div>
            <div id="step3" class="col s12">
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="title-bar">
                            <h1>
                                <i class="material-icons left step-two" aria-hidden="true">arrow_back</i>
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
        <!-- Error Modal -->
        @include ('partials.errors')
    </div>
</main>
@endsection