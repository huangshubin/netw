<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @hasSection('title')
        @yield('title')
        @else
            SMS Contact
        @endif
    </title>
    <link href="{{asset('css/built-all.css')}}" rel="stylesheet"/>
    <style>
        @yield('styles')
    </style>
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>


        </div>

        <div class="collapse navbar-collapse width sidebar"  id="app-navbar-collapse">
            @if(Auth::check())
                <ul class="nav navbar-nav" style="font-size:1.1em;">
                    <li><a  href="{{ url('/messages') }}">
                            Messages
                        </a>
                    </li>

                    <li>

                        <a  href="{{ url('/message/manage') }}">
                            Message Management
                        </a>
                    </li>
                 @can('view',ENTITY_USER)

                    <li>
                        <a  href="{{ url('/users') }}">
                            Users
                        </a>
                    </li>
                    @endcan
                </ul>

        @endif
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-sign-out"></i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>

                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<script type="application/javascript" src="{{asset('js/built-all.js')}}"/>
<script type="application/javascript">
    @yield('scripts')
</script>
</body>
</html>
