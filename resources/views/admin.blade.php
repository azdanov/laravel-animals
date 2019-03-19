@extends('layouts.app')

@section('title', 'Admin')

@section('assets')
  <script src="{{ mix('js/admin.js') }}" defer></script>
@endsection

@section('content')
  <admin-area></admin-area>
@endsection
