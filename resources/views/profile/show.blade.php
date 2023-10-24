@extends('layouts.app')

@section('content')
<div class="container">
  <h2>User Profile</h2>
  <div class="row">
      <div class="mt-4 mb-4">
        <img src="{{ asset('storage/' . $user['avatar']) }}" alt="Profile Picture" class="profile-picture">
      </div>
      <div class="col-md-6">
          <div class="card">
              <div class="card-body">
                  <form action="{{ route('updateProfile') }}" method="POST">
                    @csrf
                    {{-- <p class="card-text"><h4>ID: {{ $user->id }}</h4></p> --}}
                    <div class="form-group mt-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="lidnummer">lidnummer</label>
                        <input type="text" name="lidnummer" id="lidnummer" class="form-control" value="{{ $user->lidnummer }}" disabled>
                    </div>
                    {{-- birthdate as a input --}}
                    <div class="form-group mt-3">
                        <label for="birthdate">Geboortedatum</label>
                        <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ $user->birthdate }}" disabled>
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone">tel</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="street">street</label>
                        <input type="text" name="street" id="street" class="form-control" value="{{ $user->address_street }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="nr">nummer</label>
                        <input type="text" name="nr" id="nr" class="form-control" value="{{ $user->address_nr }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="zipcode">postcode</label>
                        <input type="text" name="zipcode" id="zipcode" class="form-control" value="{{ $user->address_zipcode }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="city">stad</label>
                        <input type="text" name="city" id="city" class="form-control" value="{{ $user->address_city }}">
                    </div>


                    <button type="submit" class="btn btn-primary mt-4">Update Profile</button>
                  </form>
              </div>
          </div>
      </div>
      <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lidmaatschapsstatus</h4>
    
                @if ($userStatus->status == "actief")
                    <p class="card-text">Status: <span class="bg-success px-3 rounded-4 text-white">{{ $userStatus->status }}</span></p>
                @else
                    <p class="card-text">Status: <span class="bg-danger px-3 rounded-4 text-white">{{ $userStatus->status }}</span></p>
                @endif
    
                @if ($userStatus->updated_at != null)
                    <p class="card-text">Laatste betaling: {{ $userStatus->updated_at }}</p>
                @endif
    
                <p class="card-text">
                    Betaling geldig tot:
                    @if ($userStatus->date == null)
                        <span>Je moet nog voor de eerste keer je lidgeld betalen</span>
                    @else
                        {{ $userStatus->date }}
                    @endif
                </p>
    
                @php
                    $today = date("Y-m-d");
                @endphp
    
                <form action="{{ route('payment') }}" method="GET">
                    @if ($userStatus->date == null || $userStatus->date < $today)
                        <button type="submit" class="btn btn-primary mt-4">Betaal lidmaatschap</button>
                    @else
                        <button type="submit" class="btn btn-outline-primary mt-4" disabled>Lidmaatschap is betaald</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    
  </div>
</div>
@endsection
