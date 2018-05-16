@extends('layouts.master')

@section ('navigation-link')
    <a href="{{ url('/profile') }}">
        <i class="material-icons">
            arrow_back
        </i>
    </a>
    <p class="left">Profielfoto wijzigen</p>
@endsection

@section ('content')
<main>
    <div class="container">
            <div class="row center-align">
                <div class="col l6 m8 s12 offset-l3 offset-m2">
                    <div class="title-bar">
                        <h1>
                            Profielfoto wijzigen
                        </h1>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('profile.pictureUpdate', ['id' => $user->id ]) }}"  enctype='multipart/form-data'>
                {{ csrf_field() }}
                {{ method_field('PUT')}} 
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label class="btn-upload center-block">
                            <div class="image-preview">
                                <img src="{{ asset($user->profile_picture) }}"  id="profilepicture-img-output" />
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

        </div>  
    </div>
</main>
@endsection