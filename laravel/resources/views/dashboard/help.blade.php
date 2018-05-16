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
    <!-- Scripts -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
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
</head>
<body>
    <!-- Loader -->
    @include('partials.loader')
    <!-- Navigation -->
    <nav class="nav-extended blue-grey darken-4">
        <div class="nav-wrapper">
            <a href="{{ url('/') }}" class="brand-logo center"><img src="{{ asset('/assets/logo-bap.svg') }}"></a>
            <ul class="left">
                <li><a href="{{ url('/') }}"><i class="material-icons">arrow_back</i></a></li>
            </ul>
            <p>Help</p>
        </div>
    </nav>
    <!-- Content -->
    <main>
        <div class="container">
            <div class="row center-align">
                <div class="col l6 m8 s12 offset-l3 offset-m2">
                    <div class="title-bar">
                        <h1>
                            Help
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row center-align">
                <div class="col l8 m8 s12 offset-l2 offset-m2">
                    <p class="help">
                        VR-omgevingen zijn opgebouwd uit componenten. Aan de hand van de <span class="component-tag">components</span> komt u te weten 
                        welke bouwstenen een template gebruikt. Op deze pagina wordt iedere component voorgesteld.
                    </p>
                    <br>
                    <br>
                    <h1 class="help-title">Pano</h1>
                    <br>
                    <p class="help">
                        Een Pano is een afbeeldingen die wordt geprojecteerd op een bol die de toeschouwer volledig omringt. Dit 
                        beeldformaat wordt vaak gebruikt in VR-toepassingen en zijn meestal in de vorm van 
                        Equirectangular-afbeeldingen die volledige 360° horizontale en 180° verticale hoeken beslaan. U kunt 
                        360°-foto’s maken met behulp van speciale 360 ​​camera-hardware. Sommige smartphones beschikken ook 
                        over deze functionaliteit.
                        <br>
                        <br>
                    </p>
                    <br>
                    <br>
                    <h1 class="help-title">VidePano</h1>
                    <br>
                    <p class="help">
                        Een VideoPano is een component die geschikt is om 360° video's in te plaatsen. Dit component bevat dezelfde kenmerken van een Pano, maar is enkel geschikt voor video's. De video-bestanden mogen niet groter te zijn dan 50mb. De volgende bestandsextensies zijn toegelaten: '.mp4, '.mov', '.ogg'.
                        <br>
                        <br>
                    </p>
                    <br>
                    <br>
                    <h1 class="help-title">Sound</h1>
                    <br>
                    <p class="help">
                        Dit component dient om audio in te plaatsen. De audio-bestanden mogen niet groter te zijn dan 5mb. Daarnaast is het enkel mogelijk om geluidsfragmenten met de bestandsextensie '.mp3' up te loaden.
                        <br>
                        <br>
                        Het 'Audio'-component is altijd optioneel.
                        <br>
                        <br>
                    </p>
                    <br>
                    <br>
                    <h1 class="help-title">Image</h1>
                    <br>
                    <p class="help">
                        In dit component kunt om afbeeldingen plaatsen. De afbeeldingen mogen niet groter te zijn dan 10mb. De volgende bestandsextensies zijn toegelaten: '.jpeg, '.jpg', '.png'.
                        <br>
                        <br>
                    </p>
                    <br>
                    <br>
                    <h1 class="help-title">Text</h1>
                    <br>
                    <p class="help">
                        Bij een Text-component kunt u een begeleidende tekst toevoegen aan een afbeelding. We raden aan om teksten in te perken tot 100 tekens.
                        <br>
                        <br>
                    </p>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    @include('partials.footer')
    <!-- Scripts -->
    @include ('partials.scripts')
</body>
</html>