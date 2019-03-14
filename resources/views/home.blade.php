@extends('layouts.app')

@section('content')
  <section class="hero is-large has-bg-img mb-4">
    <div class="hero-body">
      <div class="container has-text-centered blend">
        <h1 class="title has-text-white is-size-1">
          Animals
        </h1>
        <h2 class="subtitle has-text-white-bis is-size-2">
          Find a companion for life
        </h2>
      </div>
    </div>
  </section>
  <div class="container">
    <div class="columns is-marginless is-centered">
      <div class="column is-8">
        <h3 class="title">Meet our friends</h3>
        <p class="subtitle">You will find your favorite little or big friend on our list.
          Response need model
          point meeting pressure. Involve produce method star air read. Check good debate
          garden.
        </p>

        <div class="categories mt-5 mb-5">
          <a href="#">
            <figure class="image is-128x128">
              <img src="{{ asset('images/cat.svg') }}"
                   alt="A cat">
              <figcaption class="has-text-centered is-size-3">Cats</figcaption>
            </figure>
          </a>
          <a href="#">
            <figure class="image is-128x128">
              <img src="{{ asset('images/dog.svg') }}"
                   alt="A dog">
              <figcaption class="has-text-centered is-size-3">Dogs</figcaption>
            </figure>
          </a>
          <a href="#">
            <figure class="image is-128x128">
              <img src="{{ asset('images/bird.svg') }}"
                   alt="A bird">
              <figcaption class="has-text-centered is-size-3">Birds</figcaption>
            </figure>
          </a>
        </div>
        <hr class="mt-7">
        <div class="mt-5 has-text-centered">
          <h3 class="is-size-3 mb-4">What our customers say</h3>
          <article class="message is-info">
            <div class="message-body">
              <p class="subtitle">Along wait answer film behind season establish let.
                Side during far beautiful learn baby she. Little fall reach their position.
                <small class="customer">Mark Cook</small>
              </p>
            </div>
          </article>
          <article class="message is-info">
            <div class="message-body">
              <p class="subtitle">Loss beyond face generation. Direction machine
                thousand politics lot. Short second
                several range usually simply share respond.
                <small class="customer">Jacqueline Russell</small>
              </p>
            </div>
          </article>
          <article class="message is-info">
            <div class="message-body">
              <p class="subtitle">Executive hard indicate along off. Happen value
                collection many statement nearly. Spring news weight value whole look leave.
                <small class="customer">Todd Davis</small>
              </p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>
@endsection
