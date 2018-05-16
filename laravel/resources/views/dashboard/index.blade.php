@extends('layouts.master')

@section ('navigation-link')
<p class="left">Dashboard</p>
@endsection

@section ('content')
<main>
<!-- Administrator Section -->
@if (Auth::user()->type == 0)
    <div class="container">
        <div class="row center-align">
            <div class="col l6 m8 s12 offset-l3 offset-m2">
                <div class="title-bar">
                    <h1>
                        Gebruikers
                    </h1>
                </div>
            </div>
        </div>
        <!-- Create Button -->
        <div class="row">
            <div class="col l12 m12 s12">
                <a href="{{ url('/register') }}" class="btn">
                    <i class="material-icons left">add</i>{{ __('Gebruiker toevoegen') }}
                </a>
            </div>
        </div>
        <!-- Users -->
        <div class="row">
            @if (count($users) <= 1)
                <p>Er zijn nog geen gebruikers in de database.</p>
            @endif
            @foreach ($users as $user)   
                @if ($user->id !== Auth::user()->id)
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-image">
                                <img src="{{ asset($user->profile_picture) }}">
                            </div>
                            <div class="card-content">
                                <p>{{$user->firstname}} {{$user->lastname}}</p>
                                <p>{{$user->email}}</p>
                            </div>
                            <div class="card-action">

                                <a id="open-delete-user-{{ $user->id }}-modal" onclick="
                                    let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                    M.Modal.init(document.getElementById('delete-user-{{ $user->id }}-modal'), options).open();">
                                    <i class="material-icons">delete</i>
                                </a>
                                <div class="modal modal-fixed-footer" id="delete-user-{{ $user->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-content">
                                        <h1>Bent u zeker dat u onderstaande gebruiker wilt verwijderen?</h1>
                                        <p>{{$user->firstname}} {{$user->lastname}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-wrapper-center">
                                            <a class="modal-action modal-close btn-flat">Nee</a>
                                            <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('destroy-form-{{ $user->id }}').submit();">Ja</a>
                                            <form id="destroy-form-{{ $user->id }}" action="{{ url('/users') . '/' . $user->id .'/delete' }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif

<!-- User Section -->
@if (Auth::user()->type != 0)
<!-- Tabs -->
<div class="row">
    <div class="form-indicator">
        <div class="col l6 m8 s12 offset-l3 offset-m2">
            <ul class="tabs tabs-fixed-width">
                <li class="tab col l1 m3 s2">
                    <a class="active" href="#step1">Openbaar</a>
                </li>
                <li class="tab col l1 m3 s2">
                    <a href="#step2">Verborgen</a>
                </li>
                <li class="tab col l1 m3 s2">
                    <a href="#step3">Bouwen</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container">  
    <div id="step1" class="col s12">
        <div class="row center-align">
            <div class="col l6 m8 s12 offset-l3 offset-m2">
                <div class="title-bar">
                    <h1>
                        <i class="material-icons right step-two" aria-hidden="true">arrow_forward</i>
                        Openbare omgevingen
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
        @if(count($visibleSpaces) == 0)
            <p>Er zijn nog geen zichtbare omgevingen in de database voor {{$currentUser->firstname}} {{$currentUser->lastname}}.</p>
        @endif
        @foreach ($visibleSpaces as $space)
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset($space->thumbnail) }}">
                    </div>
                    <div class="card-content">
                        <p class="title">{{$space->title}}</p>
                        <br>
                        @if($space->type == 1)
                            <p>360 panorama omgeving</p>
                            <br>
                            <div class="component">Pano</div>
                            <div class="component">Sound</div>
                        @endif
                        @if($space->type == 2)
                            <p>360 video omgeving</p>
                            <br>
                            <div class="component">VideoPano</div>
                        @endif
                        @if($space->type == 3)
                            <p>360 slider omgeving</p>
                            <br>
                            <div class="component">Image</div>
                            <div class="component">Text</div>
                            <div class="component">Sound</div>
                        @endif
                        @if($space->type == 4)
                            <p>360 beeldenkamer omgeving</p>
                            <br>
                            <div class="component">Image</div>
                            <div class="component">Text</div>
                            <div class="component">Sound</div>
                        @endif
                        @if($space->type == 5)
                            <p>360 tijdlijn omgeving</p>
                            <br>
                            <div class="component">Image</div>
                            <div class="component">Text</div>
                            <div class="component">Sound</div>
                        @endif
                    </div>
                    <div class="card-action">
                        @if($space->type == 1)
                            <a onclick="
                                let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                M.Modal.init(document.getElementById('delete-space-{{ $space->id }}-modal'), options).open();">
                                <i class="material-icons">delete</i>
                            </a>
                            <div class="modal modal-fixed-footer" id="delete-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-content">
                                    <h1>Bent u zeker dat u onderstaande omgeving wilt verwijderen?</h1>
                                    <p>{{$space->title}}</p>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-wrapper-center">
                                        <a class="modal-action modal-close btn-flat">Nee</a>
                                        <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('destroy-form-{{ $space->id }}').submit();">Ja</a>
                                        <form id="destroy-form-{{ $space->id }}" action="{{ url('/360-pano') . '/' . $space->id .'/delete' }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            
                            <a onclick="
                                let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                M.Modal.init(document.getElementById('hide-space-{{ $space->id }}-modal'), options).open();">
                                <i class="material-icons">visibility_off</i>
                            </a>

                            <div class="modal modal-fixed-footer" id="hide-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-content">
                                    <h1>Bent u zeker dat u onderstaande omgeving wilt verbergen?</h1>
                                    <p>{{$space->title}}</p>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-wrapper-center">
                                        <a class="modal-action modal-close btn-flat">Nee</a>
                                        <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('hide-form-{{ $space->id }}').submit();">Ja</a>
                                        <form method="POST" id="hide-form-{{ $space->id }}"  action="{{ url('/360-pano') . '/' . $space->id .'/hide' }}" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT')}} 
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ url('/360-pano') . '/' . $space->id .'/edit' }}">
                                <i class="material-icons">edit</i>
                            </a>

                            <a href="{{ url('/preview') . '/' . $space->id }}">
                                <i class="material-icons">pageview</i>
                            </a>

                        @endif
                        @if($space->type == 2)

                            <a onclick="
                                let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                M.Modal.init(document.getElementById('delete-space-{{ $space->id }}-modal'), options).open();">
                                <i class="material-icons">delete</i>
                            </a>

                            <div class="modal modal-fixed-footer" id="delete-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-content">
                                    <h1>Bent u zeker dat u onderstaande omgeving wilt verwijderen?</h1>
                                    <p>{{$space->title}}</p>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-wrapper-center">
                                        <a class="modal-action modal-close btn-flat">Nee</a>
                                        <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('destroy-form-{{ $space->id }}').submit();">Ja</a>
                                        <form id="destroy-form-{{ $space->id }}" action="{{ url('/360-video-pano') . '/' . $space->id .'/delete' }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <a onclick="
                                let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                M.Modal.init(document.getElementById('hide-space-{{ $space->id }}-modal'), options).open();">
                                <i class="material-icons">visibility_off</i>
                            </a>

                            <div class="modal modal-fixed-footer" id="hide-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-content">
                                    <h1>Bent u zeker dat u onderstaande omgeving wilt verbergen?</h1>
                                    <p>{{$space->title}}</p>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-wrapper-center">
                                        <a class="modal-action modal-close btn-flat">Nee</a>
                                        <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('hide-form-{{ $space->id }}').submit();">Ja</a>
                                        <form method="POST" id="hide-form-{{ $space->id }}"  action="{{ url('/360-video-pano') . '/' . $space->id .'/hide' }}" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT')}} 
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ url('/360-video-pano') . '/' . $space->id .'/edit' }}">
                                <i class="material-icons">edit</i>
                            </a>

                            <a href="{{ url('/preview') . '/' . $space->id }}">
                                <i class="material-icons">pageview</i>
                            </a>


                        @endif
                        @if($space->type == 3)
                            
                            <a onclick="
                                let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                M.Modal.init(document.getElementById('delete-space-{{ $space->id }}-modal'), options).open();">
                                <i class="material-icons">delete</i>
                            </a>

                            <div class="modal modal-fixed-footer" id="delete-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-content">
                                    <h1>Bent u zeker dat u onderstaande omgeving wilt verwijderen?</h1>
                                    <p>{{$space->title}}</p>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-wrapper-center">
                                        <a class="modal-action modal-close btn-flat">Nee</a>
                                        <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('destroy-form-{{ $space->id }}').submit();">Ja</a>
                                        <form id="destroy-form-{{ $space->id }}" action="{{ url('/360-slider') . '/' . $space->id .'/delete' }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <a onclick="
                                let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                M.Modal.init(document.getElementById('hide-space-{{ $space->id }}-modal'), options).open();">
                                <i class="material-icons">visibility_off</i>
                            </a>

                            <div class="modal modal-fixed-footer" id="hide-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-content">
                                    <h1>Bent u zeker dat u onderstaande omgeving wilt verbergen?</h1>
                                    <p>{{$space->title}}</p>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-wrapper-center">
                                        <a class="modal-action modal-close btn-flat">Nee</a>
                                        <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('hide-form-{{ $space->id }}').submit();">Ja</a>
                                        <form method="POST" id="hide-form-{{ $space->id }}"  action="{{ url('/360-slider') . '/' . $space->id .'/hide' }}" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT')}} 
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ url('/360-slider') . '/' . $space->id .'/edit' }}">
                                <i class="material-icons">edit</i>
                            </a>

                            <a href="{{ url('/preview') . '/' . $space->id }}">
                                <i class="material-icons">pageview</i>
                            </a>

                        @endif
                        @if($space->type == 4)
                                
                            <a onclick="
                                let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                M.Modal.init(document.getElementById('delete-space-{{ $space->id }}-modal'), options).open();">
                                <i class="material-icons">delete</i>
                            </a>

                            <div class="modal modal-fixed-footer" id="delete-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-content">
                                    <h1>Bent u zeker dat u onderstaande omgeving wilt verwijderen?</h1>
                                    <p>{{$space->title}}</p>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-wrapper-center">
                                        <a class="modal-action modal-close btn-flat">Nee</a>
                                        <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('destroy-form-{{ $space->id }}').submit();">Ja</a>
                                        <form id="destroy-form-{{ $space->id }}" action="{{ url('/360-image-room') . '/' . $space->id .'/delete' }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <a onclick="
                                let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                M.Modal.init(document.getElementById('hide-space-{{ $space->id }}-modal'), options).open();">
                                <i class="material-icons">visibility_off</i>
                            </a>

                            <div class="modal modal-fixed-footer" id="hide-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-content">
                                    <h1>Bent u zeker dat u onderstaande omgeving wilt verbergen?</h1>
                                    <p>{{$space->title}}</p>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-wrapper-center">
                                        <a class="modal-action modal-close btn-flat">Nee</a>
                                        <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('hide-form-{{ $space->id }}').submit();">Ja</a>
                                        <form method="POST" id="hide-form-{{ $space->id }}"  action="{{ url('/360-image-room') . '/' . $space->id .'/hide' }}" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT')}} 
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ url('/360-image-room') . '/' . $space->id .'/edit' }}">
                                <i class="material-icons">edit</i>
                            </a>

                            <a href="{{ url('/preview') . '/' . $space->id }}">
                                <i class="material-icons">pageview</i>
                            </a>

                        @endif
                        @if($space->type == 5)

                            <a onclick="
                                let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                M.Modal.init(document.getElementById('delete-space-{{ $space->id }}-modal'), options).open();">
                                <i class="material-icons">delete</i>
                            </a>

                            <div class="modal modal-fixed-footer" id="delete-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-content">
                                    <h1>Bent u zeker dat u onderstaande omgeving wilt verwijderen?</h1>
                                    <p>{{$space->title}}</p>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-wrapper-center">
                                        <a class="modal-action modal-close btn-flat">Nee</a>
                                        <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('destroy-form-{{ $space->id }}').submit();">Ja</a>
                                        <form id="destroy-form-{{ $space->id }}" action="{{ url('/360-timeline') . '/' . $space->id .'/delete' }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <a onclick="
                                let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                M.Modal.init(document.getElementById('hide-space-{{ $space->id }}-modal'), options).open();">
                                <i class="material-icons">visibility_off</i>
                            </a>

                            <div class="modal modal-fixed-footer" id="hide-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-content">
                                    <h1>Bent u zeker dat u onderstaande omgeving wilt verbergen?</h1>
                                    <p>{{$space->title}}</p>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-wrapper-center">
                                        <a class="modal-action modal-close btn-flat">Nee</a>
                                        <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('hide-form-{{ $space->id }}').submit();">Ja</a>
                                        <form method="POST" id="hide-form-{{ $space->id }}"  {{ url('/360-timeline') . '/' . $space->id .'/hide' }}" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT')}} 
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ url('/360-timeline') . '/' . $space->id .'/edit' }}">
                                <i class="material-icons">edit</i>
                            </a>

                            <a href="{{ url('/preview') . '/' . $space->id }}">
                                <i class="material-icons">pageview</i>
                            </a>

                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    <div id="step2" class="col s12">
        <div class="row center-align">
            <div class="col l6 m8 s12 offset-l3 offset-m2">
                <div class="title-bar">
                    <h1>
                        <i class="material-icons left step-one" aria-hidden="true">arrow_back</i>
                        <i class="material-icons right step-three" aria-hidden="true">arrow_forward</i>
                        Verborgen omgevingen
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
            @if(count($hiddenSpaces) == 0)
                <p>Er zijn nog geen verborgen omgevingen in de database voor {{$currentUser->firstname}} {{$currentUser->lastname}}.</p>
            @endif
            @foreach ($hiddenSpaces as $space)
                <div class="col s12 m6 l4">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ asset($space->thumbnail) }}">
                        </div>
                        <div class="card-content">
                            <p class="title">{{$space->title}}</p>
                            <br>
                            @if($space->type == 1)
                                <p>360 panorama omgeving</p>
                                <br>
                                <div class="component">Pano</div>
                                <div class="component">Sound</div>
                            @endif
                            @if($space->type == 2)
                                <p>360 video omgeving</p>
                                <br>
                                <div class="component">VideoPano</div>
                            @endif
                            @if($space->type == 3)
                                <p>360 slider omgeving</p>
                                <br>
                                <div class="component">Image</div>
                                <div class="component">Text</div>
                                <div class="component">Sound</div>
                            @endif
                            @if($space->type == 4)
                                <p>360 beeldenkamer omgeving</p>
                                <br>
                                <div class="component">Image</div>
                                <div class="component">Text</div>
                                <div class="component">Sound</div>
                            @endif
                            @if($space->type == 5)
                                <p>360 tijdlijn omgeving</p>
                                <br>
                                <div class="component">Image</div>
                                <div class="component">Text</div>
                                <div class="component">Sound</div>
                            @endif
                        </div>
                        <div class="card-action">
                            @if($space->type == 1)

                                <a onclick="
                                    let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                    M.Modal.init(document.getElementById('delete-space-{{ $space->id }}-modal'), options).open();">
                                    <i class="material-icons">delete</i>
                                </a>

                                <div class="modal modal-fixed-footer" id="delete-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-content">
                                        <h1>Bent u zeker dat u onderstaande omgeving wilt verwijderen?</h1>
                                        <p>{{$space->title}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-wrapper-center">
                                            <a class="modal-action modal-close btn-flat">Nee</a>
                                            <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('destroy-form-{{ $space->id }}').submit();">Ja</a>
                                            <form id="destroy-form-{{ $space->id }}" action="{{ url('/360-pano') . '/' . $space->id .'/delete' }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <a onclick="
                                    let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                    M.Modal.init(document.getElementById('show-space-{{ $space->id }}-modal'), options).open();">
                                    <i class="material-icons">visibility</i>
                                </a>

                                <div class="modal modal-fixed-footer" id="show-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-content">
                                        <h1>Bent u zeker dat u onderstaande omgeving wilt zichtbaar maken?</h1>
                                        <p>{{$space->title}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-wrapper-center">
                                            <a class="modal-action modal-close btn-flat">Nee</a>
                                            <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('show-form-{{ $space->id }}').submit();">Ja</a>
                                            <form method="POST" id="show-form-{{ $space->id }}"  action="{{ url('/360-pano') . '/' . $space->id .'/show' }}" style="display: none;">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT')}} 
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ url('/360-pano') . '/' . $space->id .'/edit' }}">
                                    <i class="material-icons">edit</i>
                                </a>

                            @endif
                            @if($space->type == 2)

                                <a onclick="
                                    let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                    M.Modal.init(document.getElementById('delete-space-{{ $space->id }}-modal'), options).open();">
                                    <i class="material-icons">delete</i>
                                </a>

                                <div class="modal modal-fixed-footer" id="delete-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-content">
                                        <h1>Bent u zeker dat u onderstaande omgeving wilt verwijderen?</h1>
                                        <p>{{$space->title}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-wrapper-center">
                                            <a class="modal-action modal-close btn-flat">Nee</a>
                                            <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('destroy-form-{{ $space->id }}').submit();">Ja</a>
                                            <form id="destroy-form-{{ $space->id }}" action="{{ url('/360-video-pano') . '/' . $space->id .'/delete' }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <a onclick="
                                    let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                    M.Modal.init(document.getElementById('show-space-{{ $space->id }}-modal'), options).open();">
                                    <i class="material-icons">visibility</i>
                                </a>

                                <div class="modal modal-fixed-footer" id="show-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-content">
                                        <h1>Bent u zeker dat u onderstaande omgeving wilt zichtbaar maken?</h1>
                                        <p>{{$space->title}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-wrapper-center">
                                            <a class="modal-action modal-close btn-flat">Nee</a>
                                            <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('show-form-{{ $space->id }}').submit();">Ja</a>
                                            <form method="POST" id="show-form-{{ $space->id }}"  action="{{ url('/360-video-pano') . '/' . $space->id .'/show' }}" style="display: none;">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT')}} 
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="{{ url('/360-video-pano') . '/' . $space->id .'/edit' }}">
                                    <i class="material-icons">edit</i>
                                </a>

                            @endif
                            @if($space->type == 3)

                                <a onclick="
                                    let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                    M.Modal.init(document.getElementById('delete-space-{{ $space->id }}-modal'), options).open();">
                                    <i class="material-icons">delete</i>
                                </a>

                                <div class="modal modal-fixed-footer" id="delete-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-content">
                                        <h1>Bent u zeker dat u onderstaande omgeving wilt verwijderen?</h1>
                                        <p>{{$space->title}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-wrapper-center">
                                            <a class="modal-action modal-close btn-flat">Nee</a>
                                            <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('destroy-form-{{ $space->id }}').submit();">Ja</a>
                                            <form id="destroy-form-{{ $space->id }}" action="{{ url('/360-slider') . '/' . $space->id .'/delete' }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <a onclick="
                                    let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                    M.Modal.init(document.getElementById('show-space-{{ $space->id }}-modal'), options).open();">
                                    <i class="material-icons">visibility</i>
                                </a>

                                <div class="modal modal-fixed-footer" id="show-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-content">
                                        <h1>Bent u zeker dat u onderstaande omgeving wilt zichtbaar maken?</h1>
                                        <p>{{$space->title}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-wrapper-center">
                                            <a class="modal-action modal-close btn-flat">Nee</a>
                                            <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('show-form-{{ $space->id }}').submit();">Ja</a>
                                            <form method="POST" id="show-form-{{ $space->id }}"  action="{{ url('/360-slider') . '/' . $space->id .'/show' }}" style="display: none;">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT')}} 
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ url('/360-slider') . '/' . $space->id .'/edit' }}">
                                    <i class="material-icons">edit</i>
                                </a>

                            @endif
                            @if($space->type == 4)
                                
                                <a onclick="
                                    let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                    M.Modal.init(document.getElementById('delete-space-{{ $space->id }}-modal'), options).open();">
                                    <i class="material-icons">delete</i>
                                </a>

                                <div class="modal modal-fixed-footer" id="delete-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-content">
                                        <h1>Bent u zeker dat u onderstaande omgeving wilt verwijderen?</h1>
                                        <p>{{$space->title}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-wrapper-center">
                                            <a class="modal-action modal-close btn-flat">Nee</a>
                                            <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('destroy-form-{{ $space->id }}').submit();">Ja</a>
                                            <form id="destroy-form-{{ $space->id }}" action="{{ url('/360-image-room') . '/' . $space->id .'/delete' }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <a onclick="
                                    let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                    M.Modal.init(document.getElementById('show-space-{{ $space->id }}-modal'), options).open();">
                                    <i class="material-icons">visibility</i>
                                </a>

                                <div class="modal modal-fixed-footer" id="show-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-content">
                                        <h1>Bent u zeker dat u onderstaande omgeving wilt zichtbaar maken?</h1>
                                        <p>{{$space->title}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-wrapper-center">
                                            <a class="modal-action modal-close btn-flat">Nee</a>
                                            <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('show-form-{{ $space->id }}').submit();">Ja</a>
                                            <form method="POST" id="show-form-{{ $space->id }}"  action="{{ url('/360-image-room') . '/' . $space->id .'/show' }}" style="display: none;">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT')}} 
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ url('/360-image-room') . '/' . $space->id .'/edit' }}">
                                    <i class="material-icons">edit</i>
                                </a>

                            @endif
                            @if($space->type == 5)

                                <a onclick="
                                    let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                    M.Modal.init(document.getElementById('delete-space-{{ $space->id }}-modal'), options).open();">
                                    <i class="material-icons">delete</i>
                                </a>

                                <div class="modal modal-fixed-footer" id="delete-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-content">
                                        <h1>Bent u zeker dat u onderstaande omgeving wilt verwijderen?</h1>
                                        <p>{{$space->title}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-wrapper-center">
                                            <a class="modal-action modal-close btn-flat">Nee</a>
                                            <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('destroy-form-{{ $space->id }}').submit();">Ja</a>
                                            <form id="destroy-form-{{ $space->id }}" action="{{ url('/360-timeline') . '/' . $space->id .'/delete' }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <a onclick="
                                    let options = { dismissible: false, opacity: .85, in_duration: 300, out_duration: 200 }
                                    M.Modal.init(document.getElementById('show-space-{{ $space->id }}-modal'), options).open();">
                                    <i class="material-icons">visibility</i>
                                </a>

                                <div class="modal modal-fixed-footer" id="show-space-{{ $space->id }}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-content">
                                        <h1>Bent u zeker dat u onderstaande omgeving wilt zichtbaar maken?</h1>
                                        <p>{{$space->title}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-wrapper-center">
                                            <a class="modal-action modal-close btn-flat">Nee</a>
                                            <a class="modal-action btn-flat" onclick="event.preventDefault(); document.getElementById('show-form-{{ $space->id }}').submit();">Ja</a>
                                            <form method="POST" id="show-form-{{ $space->id }}"  action="{{ url('/360-timeline') . '/' . $space->id .'/show' }}" style="display: none;">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT')}} 
                                            </form>
                                        </div>
                                    </div>
                                </div>    

                                <a href="{{ url('/360-timeline') . '/' . $space->id .'/edit' }}">
                                    <i class="material-icons">edit</i>
                                </a>

                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div id="step3" class="col s12">
        <div class="row center-align">
            <div class="col l6 m8 s12 offset-l3 offset-m2">
                <div class="title-bar">
                    <h1>
                        <i class="material-icons left step-two" aria-hidden="true">arrow_back</i>
                        Bouwen
                    </h1>
                </div>
            </div>
        </div>
        <div class="row center-align">
            <div class="col l8 m10 s12 offset-l2 offset-m1">
                <p> Op deze pagina kan je een template kiezen waarmee je een omgeving kan bouwen. Iedere template bevat componenten die je tijdens het bouwen kan invullen met inhoud. Alle info over componenten kan je vinden op de help pagina.</p>
            </div>
        </div>
        <div class="row">
            <div class="col l12 m12 s12">
                <a href="{{ url('/help') }}" class="btn">
                    <i class="material-icons left">help_outline</i>{{ __('Help') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('/assets/thumbnail_360pano.png') }}">
                    </div>
                    <div class="card-content">
                        <p class="title">360° panorama omgeving</p>
                        <br>
                        <div class="component">Pano</div>
                        <div class="component">Sound</div>
                    </div>
                    <div class="card-action">
                        <a href="{{ url('360-pano/create') }}"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('/assets/thumbnail_360video.png') }}">
                    </div>
                    <div class="card-content">
                        <p class="title">360° video omgeving</p>
                        <br>
                        <div class="component">VidePano</div>
                    </div>
                    <div class="card-action">
                        <a href="{{ url('360-video-pano/create') }}"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('/assets/thumbnail_360slider.png') }}">
                    </div>
                    <div class="card-content">
                        <p class="title">360° slider omgeving</p>
                        <br>
                        <div class="component">Pano</div>
                        <div class="component">Text</div>
                        <div class="component">Sound</div>
                    </div>
                    <div class="card-action">
                        <a href="{{ url('360-slider/create') }}"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('/assets/thumbnail_360imageroom.png') }}">
                    </div>
                    <div class="card-content">
                        <p class="title">360° beeldenkamer omgeving</p>
                        <br>
                        <div class="component">Pano</div>
                        <div class="component">Text</div>
                        <div class="component">Sound</div>
                    </div>
                    <div class="card-action">
                        <a href="{{ url('360-image-room/create') }}"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ asset('/assets/thumbnail_360tijdlijn.png') }}">
                    </div>
                    <div class="card-content">
                        <p class="title">360° tijdlijn omgeving</p>
                        <br>
                        <div class="component">Pano</div>
                        <div class="component">Text</div>
                        <div class="component">Sound</div>
                    </div>
                    <div class="card-action">
                        <a href="{{ url('360-timeline/create') }}"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
</main>
@endsection

