@extends('layouts.app')
@section('content')
  <section class="hero has-text-centered">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">Register</h1>
      </div>
    </div>
  </section>
  <div class="columns is-marginless is-centered">
    <div class="column is-6">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">Register</p>
        </header>
        <div class="card-content">
          <form class="register-form" method="POST" action="{{ route('register') }}">
            @csrf()
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label for="name" class="label">Name</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <p class="control has-icons-left">
                    <input
                      class="input"
                      id="name"
                      type="text"
                      name="name"
                      value="{{ old('name') }}"
                      required
                      autofocus
                      placeholder="Jay Jones"
                    >
                    <span class="icon is-small is-left">
                    <span class="icon-user-circle"></span>
                  </span>
                  </p>
                  @if ($errors->has('name'))
                    <p class="help is-danger">{{ $errors->first('name') }}</p>
                  @endif
                </div>
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label for="email" class="label">E-mail</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <p class="control has-icons-left">
                    <input
                      class="input"
                      id="email"
                      type="email"
                      name="email"
                      value="{{ old('email') }}"
                      required
                      autofocus
                      placeholder="user@example.com"
                    >
                    <span class="icon is-small is-left">
                    <span class="icon-at"></span>
                  </span>
                  </p>
                  @if ($errors->has('email'))
                    <p class="help is-danger">{{ $errors->first('email') }}</p>
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
                  <p class="control has-icons-left">
                    <input
                      class="input"
                      id="password"
                      type="password"
                      name="password"
                      required
                      placeholder="********"
                    >
                    <span class="icon is-small is-left">
                    <span class="icon-key"></span>
                  </span>
                  </p>
                  @if ($errors->has('password'))
                    <p class="help is-danger">{{ $errors->first('password') }}</p>
                  @endif
                </div>
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label for="password-confirm" class="label">Confirm Password</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <p class="control has-icons-left">
                    <input
                      class="input"
                      id="password-confirm"
                      type="password"
                      name="password_confirmation"
                      required
                      placeholder="********"
                    >
                    <span class="icon is-small is-left">
                    <span class="icon-key"></span>
                  </span>
                  </p>
                </div>
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label is-normal"></div>
              <div class="field-body">
                <div class="field is-grouped">
                  <div class="control">
                    <button type="submit" class="button is-primary">Register</button>
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
