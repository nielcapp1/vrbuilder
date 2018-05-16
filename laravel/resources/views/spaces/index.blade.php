<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/croppie.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/assets/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/assets/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/assets/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/assets/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/assets/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/assets/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/assets/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/assets/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('/assets/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/assets/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/assets/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('/assets/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>
<body>
    <!-- Loader -->
    @include('partials.loader')
    <!-- Navigation -->
    <nav class="nav-extended blue-grey darken-4">
        <div class="nav-wrapper">
            <a href="{{ url('/') }}" class="brand-logo center"><img src="assets/logo-bap.svg"></a>
            <ul class="left">
                <li><a href="/"><i class="material-icons">arrow_back</i></a></li>
            </ul>
            <p>Omgevingen</p>
            <ul class="right">
                <li><a href="/login"><i class="material-icons">account_circle</i></a></li>
            </ul>
        </div>
    </nav>
    <!-- Content -->
    <main>
        <!-- Tabs -->
        <div class="row" style="margin-bottom: 0px;">
            <div class="form-indicator">
                <div class="col l6 m8 s12 offset-l3 offset-m2">
                    <ul class="tabs tabs-fixed-width">
                        <li class="tab col l1 m3 s2">
                            <a href="#home">Home</a>
                        </li>
                        <li class="tab col l1 m3 s2">
                            <a href="#spaces">Omgevingen</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div id="home" class="col s12">
            
        </div>
        <div id="spaces" class="col s12">
            <div class="container">
                <div class="row center-align">
                    <div class="col l6 m8 s12 offset-l3 offset-m2">
                        <div class="title-bar">
                            <h1>
                                Omgevingen
                            </h1>
                        </div>
                    </div>
                </div>
                @if(count($spaces) === 0)
                <div class="row center-align">
                    <p>Er zijn nog geen omgevingen aangemaakt.</p>
                </div>
                @endif
                <div class="row">
                    @foreach($spaces as $space)
                        <div class="col l4 m6 s10 offset-s1">
                            <a href="vr/?space={{$space->id}}">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="{{$space->thumbnail}}">
                                    </div>
                                    <div class="card-content">
                                        <p class="title">{{$space->title}}</p>
                                    </div>
                                    <div class="card-action">
                                        @foreach($users as $user)
                                            @if($space->user_id === $user->id)
                                            <div class="profile">
                                                <img src="{{$user->profile_picture}}" alt="">
                                                <p>{{$user->firstname}} {{$user->lastname}}</p>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <!-- Scripts -->
    @include ('partials.scripts')
    </body>
</html>