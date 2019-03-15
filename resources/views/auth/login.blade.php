@extends('layouts.app')

@section('content')
  <section class="hero has-text-centered">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">
          Login
        </h1>
      </div>
    </div>
  </section>
  <div class="columns is-marginless is-centered">
    <div class="column is-6">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">Login</p>
        </header>

        <div class="card-content">
          <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf()
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label for="email" class="label">E-Mail</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <p class="control">
                    <input class="input" id="email" type="email" name="email"
                           value="{{ old('email') }}" required autofocus>
                  </p>
                  <p class="help is-dark">
                    Test Email: {{ $user->email }}
                  </p>
                  @if ($errors->has('email'))
                    <p class="help is-danger">
                      {{ $errors->first('email') }}
                    </p>
                  @endif
                </div>
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label for="password" class="label">Password</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <p class="control">
                    <input class="input" id="password" type="password" name="password" required>
                  </p>
                  <p class="help is-dark">
                    Test Password: password
                  </p>
                  @if ($errors->has('password'))
                    <p class="help is-danger">
                      {{ $errors->first('password') }}
                    </p>
                  @endif
                </div>
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label is-normal"></div>
              <div class="field-body">
                <div class="field">
                  <p class="control">
                    <label class="checkbox">
                      <input type="checkbox"
                             name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                  </p>
                </div>
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label is-normal"></div>
              <div class="field-body">
                <div class="field is-grouped mt-2">
                  <div class="control">
                    <button type="submit" class="button is-info">Login</button>
                  </div>
                  <div class="control">
                    <a class="button is-text" href="{{ route('password.request') }}">
                      Forgot Your Password?
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
