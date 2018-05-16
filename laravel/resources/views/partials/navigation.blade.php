<nav class="nav-extended blue-grey darken-4">
    <div class="nav-wrapper">
        <a href="{{ url('/') }}" class="brand-logo center">
            <img src="{{asset('/assets/logo-bap.svg')}}" alt="">
        </a>
        <ul class="left">
            <li>
                @yield('navigation-link')
            </li>
        </ul>
        <ul class="right">
            <li>
                <a class="profile" href="{{ url('/profile') }}">
                    <img src="{{asset(Auth::user()->profile_picture)}}" alt="">
                </a>                        
            </li>
        </ul>
    </div>
</nav>