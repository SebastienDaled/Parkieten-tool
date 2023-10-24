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
        <h5 class="card-title">Ringen</h5>
        <a href="{{ route('admin.rings.create') }}" class="btn btn-primary">Ring toevoegen</a>
      </div>
      <div>
        @foreach ($rings as $index => $ring)
                   <form action="{{ route('addToCart') }}" method="POST" >
                    @csrf
                    <div class="row ring-item pt-1 pb-1 {{ $index % 2 === 0 ? 'even-ring' : 'odd-ring' }}" data-size="{{ $ring->size }}" data-type="{{ $ring->type->name }}">
                        <div class="col">{{ $ring->size }}mm</div>
                        <div class="col">{{ $ring->type->name }}</div>
                        <div class="col price">€{{ $ring->price }}</div>
                        
                        {{-- edit button en delete button --}}
                        <div class="col">
                            <div class="btn-group">
                                <a href="{{ route('admin.rings.edit', ['ring' => $ring->id]) }}" class="btn btn-success">Bewerk</a>
                                <a href="{{ route('admin.rings.delete', ['ring' => $ring->id]) }}" class="btn btn-danger">Verwijder</a>
                            </div>
                        </div>
                      
            
                    </div>
                   </form>
                @endforeach
      </div>
      
    </div>
  </div>
</div>

@endsection
