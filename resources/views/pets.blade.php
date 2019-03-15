@extends('layouts.app')

@php
  /** @var \App\Category[]|\Illuminate\Support\Collection $categories */
  /** @var \App\Pet|\Illuminate\Support\Collection $pet */
@endphp

@section('content')
  <section class="hero">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">
          Pets Selection
        </h1>
        <h2 class="subtitle">
          Choose your favorite animal
        </h2>
      </div>
    </div>
  </section>
  <div class="container">
    <div class="columns is-marginless is-centered">
      <div class="column is-7">

        @foreach ($categories as $category)
          <nav class="card">
            <header class="card-header">
              <p class="card-header-title is-size-4">
                {{ $category->name }}
              </p>
            </header>

            <div class="card-content">
              @foreach($category->pets as $pet)
                <article class="media">
                  <figure class="media-left">
                    <a href="{{ asset('images/' . $pet->image) }}" class="image is-64x64">
                      <img class="has-round-corners mt-2 mt-2"
                           src="{{ asset('images/' . $pet->image) }}" alt="{{ $pet->name }}">
                    </a>
                  </figure>
                  <div class="media-content">
                    <div class="content">
                      <p>
                        <strong>{{ $pet->name }}</strong>
                        <small class="has-left-dash">{{ number_format($pet->price / 100, 2, ',', '.') }} €</small>
                        <br>
                        {{ $pet->description }}
                      </p>
                    </div>
                  </div>
                </article>
              @endforeach
            </div>
          </nav>
        @endforeach
      </div>
    </div>
  </div>
@endsection
