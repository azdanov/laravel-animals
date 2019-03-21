@php
  /** @var \App\Pet $pet */
  /** @var bool $in_cart */
  /** @var \App\User $user */
  $user = Auth::user();
@endphp
<article class="media">
  <figure class="media-left mt-2">
    <a href="{{ asset('images/' . $pet->image) }}" class="image is-64x64">
      <img
        class="has-round-corners"
        src="{{ asset('images/' . $pet->image) }}"
        alt="{{ $pet->name }}"
      >
    </a>
  </figure>
  <div class="media-content mr-2">
    <div class="content">
      <div>
        <strong>{{ $pet->name }}</strong>
        <small class="has-left-dash">@money($pet->price, 'EUR', true)</small>
        <br>
        <p class="has-text-justified">{{ $pet->description }}</p>
        <form class="" action="{{ $in_cart ? '' : route('cart-store') }}"
              method="post">
          @unless($in_cart)
            @csrf()
            <input type="text" hidden name="id" value="{{$pet->id}}">
            <input type="text" hidden name="name" value="{{$pet->name}}">
            <input type="text" hidden name="price" value="{{$pet->price}}">
            <input type="text" hidden name="quantity" value="1">
          @endif
          <div class="field">
            <div class="control">
              <button
                class="button is-fullwidth pet__button is-outlined{{$user && !$in_cart ? '' : 'is-disabled'}}"
                {{$user && !$in_cart ? '' : 'disabled'}}>
                {{$in_cart ? 'Already in cart' : 'Add to cart'}}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</article>
