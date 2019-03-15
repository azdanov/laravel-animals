@extends('layouts.app')

@php
  use Illuminate\Support\Str;
  /** @var \App\Category[]|\Illuminate\Support\Collection $categories */
@endphp

@section('content')
  <section class="hero is-large has-bg-img mb-4">
    <div class="hero-body">
      <div class="container has-text-centered blend">
        <h1 class="title has-text-white is-size-1">
          Animals
        </h1>
        <h2 class="subtitle has-text-white-bis is-size-2">
          Find a pet companion
        </h2>
      </div>
    </div>
    <div class="hero-foot is-clearfix">
      <a class="is-pulled-right"
         style="background-color:hsla(0, 0%, 21%, 0.6);color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, 'San Francisco', 'Helvetica Neue', Helvetica, Ubuntu, Roboto, Noto, 'Segoe UI', Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px"
         href="https://unsplash.com/@krista?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge"
         target="_blank" rel="noopener noreferrer"
         title="Download free do whatever you want high-resolution photos from Krista Mangulsone"><span
          style="display:inline-block;padding:2px 3px">
          <svg xmlns="http://www.w3.org/2000/svg"
               style="height:12px;width:auto;position:relative;vertical-align:middle;top:-2px;fill:white"
               viewBox="0 0 32 32"><title>unsplash-logo</title><path
              d="M10 9V0h12v9H10zm12 5h10v18H0V14h10v9h12v-9z"></path></svg></span><span
          style="display:inline-block;padding:2px 3px">by Krista Mangulsone</span></a>
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
          @each('partials.category', $categories, 'category')
        </div>
        <hr class="mt-7">
        <div class="mt-5 has-text-centered">
          <h3 class="is-size-3 mb-4">What our customers say</h3>
          <article class="message is-info">
            <div class="message-body is-radiusless">
              <p class="subtitle">Along wait answer film behind season establish let.
                Side during far beautiful learn baby she. Little fall reach their position.
                <small class="has-left-dash">Mark Cook</small>
              </p>
            </div>
          </article>
          <article class="message is-info">
            <div class="message-body is-radiusless">
              <p class="subtitle">Loss beyond face generation. Direction machine
                thousand politics lot. Short second
                several range usually simply share respond.
                <small class="has-left-dash">Jacqueline Russell</small>
              </p>
            </div>
          </article>
          <article class="message is-info">
            <div class="message-body is-radiusless">
              <p class="subtitle">Executive hard indicate along off. Happen value
                collection many statement nearly. Spring news weight value whole look leave.
                <small class="has-left-dash">Todd Davis</small>
              </p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>
@endsection
