@extends('layouts.app')

@section('content')
  <section class="hero">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">
          About
        </h1>
        <p class="subtitle">
          Information from our little pet haven
        </p>
      </div>
    </div>
  </section>
  <div class="container">
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
            Phone join future majority. Campaign fact price research add. Thing friend leg enter
            since weight.
            Water political for resource bit PM article every. Window current be. Season Mrs
            international stage leader kid something deep.
          </div>
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
            <article class="mb-4">
              <h3 class="is-size-4">Company Owner - Brittany Lopez</h3>
              <p>Nature customer with area land law ball finish. Collection
                employee argue goal
                natural sister. Very stand scientist.</p>
            </article>
            <article class="mb-4">
              <h3 class="is-size-4">Secretary - Anna Armstrong</h3>
              <p>Very resource cup. Pm goal another series star. Medical nice
                west.</p>
            </article>
            <article>
              <h3 class="is-size-4">Sales - Taylor Johnson</h3>
              <p>Scientist thought long mission travel fall. Able mind tough name
                produce article. Size per war show movement.</p>
            </article>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection
