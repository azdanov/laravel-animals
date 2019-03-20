@extends('layouts.app')

@section('title', 'About')

@section('content')
  <section class="hero is-info is-bold">
    <div class="hero-body mt-4 mb-7">
      <div class="container has-text-centered">
        <h1 class="title">
          Animals
        </h1>
        <p class="subtitle">
          More information about us
        </p>
      </div>
    </div>
  </section>
  <div class="container about">
    <div class="columns is-marginless is-centered">
      <div class="column is-7">
        <section class="card">
          <header class="card-header">
            <figure class="image is-48x48 p-3">
              <img src="{{ asset('images/animals.svg') }}" alt="Placeholder image">
            </figure>
            <h2 class="card-header-title">
              Company
            </h2>
          </header>

          <div class="card-content">
            Phone join future majority. Campaign fact price research add. Thing friend
            leg enter
            since weight.
            Water political for resource bit PM article every. Window current be. Season
            Mrs
            international stage leader kid something deep.
          </div>
          <footer class="card-footer">
            <p class="card-footer-item">
              <a href="mailto:contact@animals.com">contact@animals.com</a>
            </p>
            <p class="card-footer-item">
              <a href="tel:+491570156">
                +49 157 0156
              </a>
            </p>
          </footer>
        </section>
        <section class="card mt-5">
          <header class="card-header">
            <figure class="image is-48x48 p-3">
              <img src="{{ asset('images/animals.svg') }}" alt="Placeholder image">
            </figure>
            <h2 class="card-header-title">
              Team
            </h2>
          </header>

          <div class="card-content">
            <article class="media">
              <figure class="media-left">
                <p class="image is-64x64">
                  <img class="has-round-corners mt-2 mt-2"
                       src="{{ asset('images/brittany.png') }}" alt="Brittany Lopez">
                </p>
              </figure>
              <div class="media-content">
                <div class="content">
                  <p>
                    <strong>Brittany Lopez</strong>
                    <small class="has-left-dash">Company Owner</small>
                    <br>
                    Nature customer with area land law ball finish. Collection
                    employee argue goal natural sister. Very stand scientist.
                  </p>
                </div>
              </div>
            </article>
            <article class="media">
              <figure class="media-left">
                <p class="image is-64x64">
                  <img class="has-round-corners mt-2"
                       src="{{ asset('images/anna.jpg') }}" alt="Anna Armstrong">
                </p>
              </figure>
              <div class="media-content">
                <div class="content">
                  <p>
                    <strong>Anna Armstrong</strong>
                    <small class="has-left-dash">Secretary</small>
                    <br>
                    Sport father campaign if TV capital seem. Keep hard discuss really
                    trade
                    protect. Position whether even none.
                  </p>
                </div>
              </div>
            </article>
            <article class="media">
              <figure class="media-left">
                <p class="image is-64x64">
                  <img class="has-round-corners mt-2"
                       src="{{ asset('images/taylor.png') }}" alt="Taylor Johnson">
                </p>
              </figure>
              <div class="media-content">
                <div class="content">
                  <p>
                    <strong>Taylor Johnson</strong>
                    <small class="has-left-dash">Sales</small>
                    <br>
                    Scientist thought long mission travel fall. Able mind tough name
                    produce article. Size per war show movement.
                  </p>
                </div>
              </div>
            </article>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection
