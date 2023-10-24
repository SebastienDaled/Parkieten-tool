@extends('admin.index')

@section('adminContent')

{{-- it needs to show each user and i then need to click on it for a detail page of that user i also need to be able to add a user --}}
<div class="container">
  @if (session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
@endif
  <div class="card">
    <div class="card-body">
      <div>
        <h5 class="card-title">Gebruikers</h5>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Gebruiker toevoegen</a>
      </div>
      <div>
        @foreach ($users as $user)
          <div class="card mb-2">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="card-title">{{ $user->name }}</h5>
                <h6 class="card-text">{{$user->lidnummer}}</h6>
                <p class="card-text">{{ $user->email }}</p>
              </div>
              {{-- edit --}}
              <div class="btn-group">
                <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-success">Bewerk</a>
              {{-- show --}}
                <a href="{{ route('admin.users.show', ['user' => $user->id]) }}" class="btn btn-warning">Bekijk</a>
              </div>
            </div>
          </div>
            
        @endforeach
      </div>
      
    </div>
  </div>
</div>

@endsection
