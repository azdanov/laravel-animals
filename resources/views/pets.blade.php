@extends('layouts.app')

@php
  /** @var \App\Category[]|\Illuminate\Support\Collection $categories */
  /** @var \App\Pet|\Illuminate\Support\Collection $pet */
@endphp

@section('title', 'Pets')

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
              <p id="{{ Str::slug($category->name) }}" class="card-header-title is-size-4">
                {{ $category->name }}
              </p>
            </header>

            <div class="card-content">
              @each('partials.pet', $category->pets, 'pet')
            </div>
          </nav>
        @endforeach
      </div>
    </div>
  </div>
@endsection
