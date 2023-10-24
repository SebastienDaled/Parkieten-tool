@extends('admin.index')

@section('adminContent')

<div class="container">
  <div class="card">
    <div class="card-body">
      <div>
        <h5 class="card-title">Ring toevoegen</h5>
      </div>
      <div>
        <form action="{{ route('admin.rings.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="size">Maat</label>
            <input type="text" class="form-control" id="size" name="size" placeholder="Maat">
          </div>
          <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type">
              @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="price">Prijs</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Prijs">
          </div>
          <button type="submit" class="btn btn-primary">Toevoegen</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection