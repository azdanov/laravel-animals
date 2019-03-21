@extends('layouts.app')

@section('title', 'User')

@section('assets')
  <script src="{{ mix('js/user.js') }}" defer></script>
@endsection

@section('content')
  <user-area></user-area>
@endsection

