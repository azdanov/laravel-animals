<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') | {{ config('app.name', 'Animals') }}</title>

  <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">
  <!-- Code snippet to speed up Google Fonts rendering: googlefonts.3perf.com -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
  <link
    rel="preload"
    href="https://fonts.googleapis.com/css?family=Raleway:300,400,600"
    as="fetch"
    crossorigin="anonymous"
  >
  <script type="text/javascript">
  !(function(e, n, t) {
    'use strict'
    var o = 'https://fonts.googleapis.com/css?family=Raleway:300,400,600',
      r = '__3perf_googleFontsStylesheet'

    function c(e) {
      ;(n.head || n.body).appendChild(e)
    }

    function a() {
      var e = n.createElement('link')
      ;(e.href = o), (e.rel = 'stylesheet'), c(e)
    }

    function f(e) {
      if (!n.getElementById(r)) {
        var t = n.createElement('icons.css')
        ;(t.id = r), c(t)
      }
      n.getElementById(r).innerHTML = e
    }

    e.FontFace && e.FontFace.prototype.hasOwnProperty('display')
      ? (t[r] && f(t[r]),
        fetch(o)
          .then(function(e) {
            return e.text()
          })
          .then(function(e) {
            return e.replace(/@font-face {/g, '@font-face{font-display:swap;')
          })
          .then(function(e) {
            return (t[r] = e)
          })
          .then(f)
          .catch(a))
      : a()
  })(window, document, localStorage)
  </script>
  <!-- End of code snippet for Google Fonts -->

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}" defer></script>@yield('assets')
</head>
<body>
<div id="app">
  @include('partials.navbar')
  <div class="main">
    @yield('content')
    @hasSection('code')
      <div class="flex-center position-ref centered">
        <div class="code">@yield('code')</div>

        <div class="error-message" style="padding: 10px;">@yield('message')</div>
      </div>
    @endIf
  </div>
  <footer class="footer p-5 mt-6">
    <div class="content has-text-centered">
      <p>© {{ now()->year }}</p>
    </div>
  </footer>
</div>
</body>
</html>
