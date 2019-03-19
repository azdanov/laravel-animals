@extends('layouts.app')

@section('title', 'Cart')

@section('assets')
  <script src="{{ mix('js/checkout.js') }}" defer></script>
@endsection

@section('content')
  <checkout-area></checkout-area>
@endsection

