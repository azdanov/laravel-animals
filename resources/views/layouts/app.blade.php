<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') | {{ config('app.name', 'Animals') }}</title>

  <!-- Code snippet to speed up Google Fonts rendering: googlefonts.3perf.com -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
  <link rel="preload" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600"
        as="fetch"
        crossorigin="anonymous">
  <script type="text/javascript">
  !function(e, n, t) {
    'use strict'
    var o = 'https://fonts.googleapis.com/css?family=Raleway:300,400,600',
      r = '__3perf_googleFontsStylesheet'

    function c(e) {(n.head || n.body).appendChild(e)}

    function a() {
      var e = n.createElement('link')
      e.href = o, e.rel = 'stylesheet', c(e)
    }

    function f(e) {
      if (!n.getElementById(r)) {
        var t = n.createElement('style')
        t.id = r, c(t)
      }
      n.getElementById(r).innerHTML = e
    }

    e.FontFace && e.FontFace.prototype.hasOwnProperty('display') ? (t[r] && f(t[r]), fetch(o).then(function(e) {return e.text()}).then(function(e) {return e.replace(/@font-face {/g, '@font-face{font-display:swap;')}).then(function(e) {return t[r] = e}).then(f).catch(a)) : a()
  }(window, document, localStorage)
  </script>
  <!-- End of code snippet for Google Fonts -->

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}" defer></script>

  @yield('assets')
</head>
<body>
<div id="app">
  <nav class="navbar has-shadow">
    <div class="container">
      <div class="navbar-brand">
        <p class="navbar-item is-unselectable">
          <img style="width:1rem; height:1rem" src="{{ asset('images/animals.svg') }}"
               alt="Animal footprints logo">
          {{ config('app.name', 'Laravel') }}
        </p>

        <div class="navbar-burger burger" data-target="navMenu">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>

      <div class="navbar-menu" id="navMenu">
        <div class="navbar-start is-unselectable">
          <a href="{{ route('home') }}" class="navbar-item">
            Home
          </a>

          <a href="{{ route('pets') }}" class="navbar-item">
            Pets
          </a>

          <a href="{{ route('about') }}" class="navbar-item">
            About
          </a>
        </div>

        <div class="navbar-end is-unselectable">
          @if (Auth::guest())
            @hasSection('code')
            @else
              <a class="navbar-item " href="{{ route('login') }}">Login</a>
              <a class="navbar-item " href="{{ route('register') }}">Register</a>
            @endif
          @else
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link" href="#">{{ Auth::user()->name }}</a>

              <div class="navbar-dropdown">
                @if (Auth::user()->is_admin)
                  <a class="navbar-item" href="{{ route('admin') }}">
                    Admin
                  </a>
                @endif
                <a class="navbar-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                  {{ csrf_field() }}
                </form>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </nav>
  <div class="main">
    @yield('content')

    @hasSection('code')
      <div class="flex-center position-ref centered">
        <div class="code">
          @yield('code')
        </div>

        <div class="error-message" style="padding: 10px;">
          @yield('message')
        </div>
      </div>
    @endIf
  </div>
  <footer class="footer p-5 mt-5">
    <div class="content has-text-centered">
      <p>©{{ now()->year }}</p>
    </div>
  </footer>
</div>
</body>
</html>
