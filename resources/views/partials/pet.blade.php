@php
  /** @var \App\Pet $pet */
@endphp
<article class="media">
  <figure class="media-left">
    <a href="{{ asset('images/' . $pet->image) }}" class="image is-64x64">
      <img
        class="has-round-corners mt-2 mt-2"
        src="{{ asset('images/' . $pet->image) }}"
        alt="{{ $pet->name }}"
      >
    </a>
  </figure>
  <div class="media-content">
    <div class="content">
      <p>
        <strong>{{ $pet->name }}</strong>
        <small class="has-left-dash">@money($pet->price, 'EUR', true)</small>
        <br>
        {{ $pet->description }}
      </p>
    </div>
  </div>
</article>
