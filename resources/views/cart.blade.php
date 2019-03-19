@extends('layouts.app')

@section('title', 'Cart')

@section('assets')
  <script src="{{ asset('js/cart.js') }}" defer></script>
@endsection

@section('content')
  <cart-area></cart-area>
@endsection

