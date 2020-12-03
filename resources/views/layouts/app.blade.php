<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
    <link rel="stylesheet" href="{{asset('css/Auth.css')}}">

    <!-- Styles -->
</head>
<body>
    <div id="app">
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                        <!-- Authentication Links -->
                        <nav href='#'>
                        @guest


                                <a href="#">
                                    <i>&#x263A;</i>
                                    <b>Home</b>
                                  </a>

                                  <a href="/teachershow">
                                    <i>&#x270E;</i>
                                    <b>Teacher</b>
                                  </a>
                                  <a href="/studentshow">
                                      <i>&#x270E;</i>
                                      <b>Student</b>
                                    </a>

                                  <a href="/contact">
                                    <i>&#x260F;</i>
                                    <b>Contact</b>
                                  </a>

                                  <a href="/about">
                                      <i>&#x270E;</i>
                                      <b>About</b>
                                    </a>
                                    <a  href="{{ route('login') }}">
                                        <i>&#x263A;</i>
                                        <b>{{ __('Login') }}</b>
                                    </a>


                            @if (Route::has('register'))

                                    <a  href="{{ route('register') }}"> <i>&#x270E;</i>
                                        <b>{{ __('Register') }}</b></a>

                            @endif
                            <span></span>
                        </nav>
                        @else

                                <a id="navbarDropdown"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                    <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>


                        @endguest


        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.dropdown-item').click(function(){
                    alert('logout clicked');
                    $.ajax({
                        type: "post",
                        url: "/Status",
                        data: "",
                        cache: false,
                        success: function (data) {
                         console.log('status changed');
                        }
                    });
                });
            });
        </script>
</body>
</html>
