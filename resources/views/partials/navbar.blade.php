@php
  /** @var null|int $cart_total */
  /** @var \App\User $user */
  $user = Auth::user()
@endphp

<nav class="navbar has-shadow">
  <div class="container">
    <div class="navbar-brand">
      <p class="navbar-item is-unselectable">
        <img
          style="width:1rem; height:1rem"
          src="{{ asset('images/animals.svg') }}"
          alt="Animal footprints logo"
        >
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
        <a href="{{ route('home') }}"
           class="navbar-item{{ request()->is('/') ? ' is-active' : '' }}">Home</a>

        <a href="{{ route('pets') }}"
           class="navbar-item{{ request()->is('pets') ? ' is-active' : '' }}">Pets</a>

        <a href="{{ route('about') }}"
           class="navbar-item{{ request()->is('about') ? ' is-active' : '' }}">About</a>
      </div>

      <div class="navbar-end is-unselectable">
        @if (Auth::guest())
          @hasSection('code')
          @else
            <a
              class="navbar-item"
              href="{{ route('login') }}"
            >Login</a>
            <a class="navbar-item" href="{{ route('register') }}">Register</a>
          @endif
        @else
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link" href="#">{{ $user->name }}</a>

            <div class="navbar-dropdown">
              @if ($user->is_admin)
                <a
                  class="navbar-item"
                  href="{{ route('admin') }}"
                >Admin</a>
                <hr class="navbar-divider">
              @endif
              <a
                id="navbar-cart"
                class="navbar-item"
                href="{{ route('user') . '/cart' }}"
              >Cart{{$cart_total ? " ({$cart_total})" : ''}}</a>
              <a
                id="navbar-cart"
                class="navbar-item"
                href="{{ route('user') . '/orders' }}"
              >Orders</a>
              <hr class="navbar-divider">
              <a
                class="navbar-item"
                href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
              >Logout</a>

              <form
                id="logout-form"
                action="{{ route('logout') }}"
                method="POST"
                style="display: none;"
              >{{ csrf_field() }}</form>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</nav>
