@extends('admin.index')

@section('adminContent')

<div class="container">
  <div class="card">
    <div class="card-body">
      <div>
        <h5 class="card-title">Ring bewerken</h5>
      </div>
      <div>
        <form action="{{ route('admin.rings.update', ['ring' => $ring->id]) }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="size">Maat</label>
            <input type="text" class="form-control" id="size" name="size" placeholder="Maat" value="{{ $ring->size }}">
          </div>
          <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type">
              @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ $ring->type->id === $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="price">Prijs</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Prijs" value="{{ $ring->price }}">
          </div>
          <button type="submit" class="btn btn-primary">Bewerken</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection