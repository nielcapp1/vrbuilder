@extends('layouts.master')

@section ('navigation-link')
<a href="{{ url('/') }}">
    <i class="material-icons">
        arrow_back
    </i>
</a>
<p class="left">Profiel</p>
@endsection

@section ('content')
<main>
    <div class="container">
        <div class="row center-align">
            <a href="{{ url('/profile') . '/' . $user->id .'/change-password' }}" class="btn">
                <i class="material-icons left" aria-hidden="true">edit</i>
                {{ __('Wachtwoord wijzigen') }}
            </a>
            <a href="{{ url('/profile') . '/' . $user->id .'/change-profile-picture' }}" class="btn">
                <i class="material-icons left" aria-hidden="true">edit</i>
                {{ __('Profiel foto wijzigen') }}
            </a>
        </div>
        <div class="row center-align">
                <div class="col l4 m8 s12 offset-l4 offset-m2">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ asset($user->profile_picture) }}" alt="">
                        </div>
                        <div class="card-content">
                            <p>{{$user->firstname}} {{$user->lastname}}</p>
                            <p>{{$user->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row center-align">
            <a href="{{ route('logout') }}" class="btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="material-icons left">exit_to_app</i>{{ __('Afmelden') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</main>
@endsection