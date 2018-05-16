@extends('layouts.master')

@section ('navigation-link')
    <a href="{{ url('/profile') }}">
        <i class="material-icons">
            arrow_back
        </i>
    </a>
    <p class="left">Wachtwoord wijzigen</p>
@endsection

@section ('content')
<main>
    <div class="container">
            <div class="row center-align">
                <div class="col l6 m8 s12 offset-l3 offset-m2">
                    <div class="title-bar">
                        <h1>
                            Wachtwoord wijzigen
                        </h1>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.passwordUpdate', ['id' => $user->id ]) }}"  enctype='multipart/form-data'>
                {{ csrf_field() }}
                {{ method_field('PUT')}} 

                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label for="old_password" class="col-form-label text-md-right">{{ __('Oud wachtwoord') }}</label>
                        <input id="old_password" type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label for="password" class="col-form-label text-md-right">{{ __('Nieuw wachtwoord') }}</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <label for="password-confirm" class="col-form-label text-md-right">{{ __('Herhaal wachtwoord') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
    </div>
    <!-- Modals -->
    <div class="modals">
        <!-- Error Modal -->
        @include ('partials.errors')
    </div>
</main>
@endsection