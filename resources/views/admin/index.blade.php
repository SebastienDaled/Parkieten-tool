@extends('layouts.app')

@section('content')
{{--  een top navigatie  --}}
<div class="container">
  <h1>Admin</h1>
  <div class="card">
    <nav class="navbar navbar-expand-lg navbar-light">
      <ul class="navbar-nav me-auto">
        @foreach ($navItems as $item)
          <li class="nav-item">
            <a class="nav-link" href="{{ route($item["route"]) }}">{{$item["name"]}}</a>
          </li>
        @endforeach
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.users') }}">Gebruikers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.exports') }}">exports</a>
        </li> --}}
      </ul>
    </nav>
  </div>
</div>

@yield('adminContent')

@endsection
