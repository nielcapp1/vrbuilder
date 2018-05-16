@extends('layouts.master')

@section ('navigation-link')
<a href="{{ url('/') }}">
    <i class="material-icons">
        arrow_back
    </i>
</a>
@if($space->type == 1)
<p class="left">Voorvertoning 360° panorama omgeving</p>
@endif
@if($space->type == 2)
<p class="left">Voorvertoning 360° video omgeving</p>
@endif
@if($space->type == 3)
<p class="left">Voorvertoning 360° slider omgeving</p>
@endif
@if($space->type == 4)
<p class="left">Voorvertoning 360° beeldenkamer omgeving</p>
@endif
@if($space->type == 5)
    <p class="left">Voorvertoning 360° tijdlijn omgeving</p>
@endif
@endsection

@section ('content')
<main>    
    <div class="container">
        <div class="row center-align">
            <div class="col l6 m8 s12 offset-l3 offset-m2">
                <div class="title-bar">
                    <h1>
                        @if($space->type == 1)
                            {{$space->title}}
                        @endif
                        @if($space->type == 2)
                            {{$space->title}}
                        @endif
                        @if($space->type == 3)
                            {{$space->title}}
                        @endif
                        @if($space->type == 4)
                            {{$space->title}}
                        @endif
                        @if($space->type == 5)
                           {{$space->title}}
                        @endif
                    </h1>
                </div>
            </div>
        </div>
        <div class="row center-align">
            <div class="col l12 m12 s12">
                <iframe allowvr src="http://www.vrbuilder.be/vr/?space={{$space->id}}" width="100%" height="400" />
            </div> 
        </div> 
    </div>
</main>
@endsection
      