@extends('admin.index')

@section('adminContent')

<div class="container mt-2">
  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Naam</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Wachtwoord</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="mb-3">
          <label for="lidnummer" class="form-label">lidnummer</label>
          <input type="lidnummer" name="lidnummer" id="lidnummer" class="form-control">
        </div>
        
        <div class="mb-3">
          <label for="role" class="form-label">Rol</label>
          <select name="role" id="role" class="form-control">
            @foreach ($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Tel</label>
          <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
        </div>
        <div class="mb-3">
          <label for="birthdate" class="form-label">Geboortedatum</label>
          <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ old('birthdate') }}">
        </div>
        <div class="mb-3">
          <label for="street" class="form-label">Straat</label>
          <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}">
        </div>
        <div class="mb-3">
          <label for="nr" class="form-label">Nr</label>
          <input type="text" name="nr" id="nr" class="form-control" value="{{ old('nr') }}">
        </div>
        <div class="mb-3">
          <label for="zipcode" class="form-label">Postcode</label>
          <input type="text" name="zipcode" id="zipcode" class="form-control" value="{{ old('zipcode') }}">
        </div>
        <div class="mb-3">
          <label for="city" class="form-label">Stad</label>
          <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
        </div>
    
        <button type="submit" class="btn btn-primary mt-4">Maak gebruiker</button>
      </form>
    </div>
  </div>
</div>

@endsection
