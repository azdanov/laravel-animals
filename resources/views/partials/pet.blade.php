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
      <div>
        <strong>{{ $pet->name }}</strong>
        <small class="has-left-dash">@money($pet->price, 'EUR', true)</small>
        <br>
        <p>{{ $pet->description }}</p>
        <form action="{{ route('cart-add') }}" method="post">
          @csrf()
          <input type="text" hidden name="id" value="{{$pet->id}}">
          <input type="text" hidden name="name" value="{{$pet->name}}">
          <input type="text" hidden name="price" value="{{$pet->price}}">
          <input type="text" hidden name="quantity" value="1">
          <div class="field">
            <div class="control">
              <button class="button is-link is-outlined">Add to cart</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</article>
