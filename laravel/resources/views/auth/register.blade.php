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
        <div class="container">
            <form enctype="multipart/form-data" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label for="firstname" class="col-form-label text-md-right">{{ __('Voornaam') }}</label>
                        <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>
                        @if ($errors->has('firstname'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                        @endif
                        </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label for="lastname" class="col-form-label text-md-right">{{ __('Familienaam') }}</label>
                        <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>
                        @if ($errors->has('lastname'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label for="password" class="col-form-label text-md-right">{{ __('Wachtwoord') }}</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                            <label for="password-confirm" class="col-form-label text-md-right">{{ __('Herhaal wachtwoord') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div> 
                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label for="profile_picture" class="col-form-label text-md-right">Profielfoto</label>
                    </div>
                </div>
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label class="btn-upload center-block">
                            <div class="image-preview">
                                <img src=""  id="profilepicture-img-output" />
                                <i class="material-icons">camera_alt</i>
                            </div>
                            <input type="file" name="profile_picture" id="profile_picture" class="profile-picture-image image-input center-block"accept=".jpg,.jpeg,.png,.svg,image/*"/>
                            <input type="hidden" id="profilePictureEncoded" name="profilePictureEncoded">
                            @if ($errors->has('profile_picture'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('profile_picture') }}</strong>
                            </span>
                            @endif
                        </label>
                    </div>
                </div>
                <div class="row center-align">   
                    <button class="btn" type="submit">
                        <i class="material-icons left" aria-hidden="true">save</i>
                        Opslaan
                    </button>
                </div>
            </form>
        </div>  
        <!-- Modals -->
        <div class="modals">
            <!-- Profile picture Modal -->
            <div class="modal modal-fixed-footer" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-content">
                    <div id="upload-demo" class="center-block">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-wrapper-center">
                        <a class="cancelCropButton modal-action modal-close btn-flat">Sluiten</a>
                        <button id="cropImageButton" type="submit" href="" class="modal-action btn-flat">Bevestigen</button>
                    </div>
                </div>
            </div>
            <!-- Error Modal -->
            @include ('partials.errors')
        </div>
    </main>
@endsection