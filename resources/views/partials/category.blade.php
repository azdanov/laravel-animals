@php
  /** @var \App\Category|\Illuminate\Support\Collection $category */
  use Illuminate\Support\Str;
@endphp
<a
  href="{{ route('pets') . '/#' . Str::slug($category->name) }}"
>
  <figure class="image is-128x128">
    <img
      src="{{ asset('images/'. $category->image) }}"
      alt="{{ $category->description }}"
    >
    <figcaption class="has-text-centered is-size-3">{{ $category->name }}</figcaption>
  </figure>
</a>
