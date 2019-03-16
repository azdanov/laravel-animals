@extends('layouts.app')

@section('title', 'Admin')

@section('assets')
  <script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('content')
  <section class="hero is-info is-bold">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">
          Admin Area
        </h1>
      </div>
    </div>
  </section>
  <div class="container">
    <div class="columns is-marginless is-centered">
      <div class="column">
        <admin-area></admin-area>
      </div>
    </div>
  </div>
@endsection
