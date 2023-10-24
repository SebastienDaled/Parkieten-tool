@extends('home')

{{-- add css --}}
@section('css')
 @vite('resources/css/order.css')
@endsection


@section('content')

<div class="container card">
  <div class="row">
      <div class="col-md-12">
          <h2>Order Items</h2>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="size-filter" class="form-label">Filter by Size:</label>
              <select class="form-select" id="size-filter">
                  <option value="">All Sizes</option>
                  @php
                      $processedSizes = [];
                  @endphp
                  @foreach ($rings as $ring)
                      @if (!in_array($ring->size, $processedSizes))
                          <option value="{{ $ring->size }}">{{ $ring->size }}mm</option>
                          {{ $processedSizes[] = $ring->size }}
                      @endif
                  @endforeach
              </select>
          </div>
          
          <div class="col-md-6">
              <label for="type-filter" class="form-label">Filter by Type:</label>
              <select class="form-select" id="type-filter">
                  <option value="">All Types</option>
                  @php
                      $processedTypes = [];
                  @endphp
                  @foreach ($rings as $ring)
                      @if (!in_array($ring->type->name, $processedTypes))
                          <option value="{{ $ring->type->name }}">{{ $ring->type->name }}</option>
                          {{ $processedTypes[] = $ring->type->name }}
                      @endif
                  @endforeach
              </select>
          </div>
                  
          </div>
          <div class="container mt-4">
            <div class="row border-bottom">
                <div class="col">
                    <h5>Size</h5>
                </div>
                <div class="col">
                    <h5>Type</h5>
                </div>
                <div class="col">
                    <h5>Prijs/stuk</h5>
                </div>
                <div class="col-sm-1">
                    <h5>Aantal</h5>
                </div>
                <div class="col">
                    <h5>Totaal</h5>
                </div>
                <div class="col">
                    <h5>Winkelmandje</h5>
                </div>
            </div>
        
            {{-- Loop through the filtered items and display them --}}
            <div>
                @foreach ($rings as $index => $ring)
                   <form action="{{ route('addToCart') }}" method="POST" >
                    @csrf
                    <div class="row ring-item pt-1 pb-1 {{ $index % 2 === 0 ? 'even-ring' : 'odd-ring' }}" data-size="{{ $ring->size }}" data-type="{{ $ring->type->name }}">
                        <div class="col">{{ $ring->size }}mm</div>
                        <div class="col">{{ $ring->type->name }}</div>
                        <div class="col price">€{{ $ring->price }}</div>
                        <div class="col-sm-1">
                            @if ($ring->type->id === 1)
                            <input type="hidden" name="id" value="{{$ring->id}}">
                            <input type="hidden" name="price" value="{{$ring->price}}">
                            <input type="hidden" name="size" value="{{$ring->size}}">
                            <input type="hidden" name="size" value="{{$ring->type->name}}">
                            <input type="number" class="form-control ring-amount amount" name="quantity" value="0" min="1" max="20" data-price="{{ $ring->price }}">

                            @else
                            <input type="hidden" name="id" value="{{$ring->id}}">
                            <input type="hidden" name="price" value="{{$ring->price}}">
                            <input type="hidden" name="size" value="{{$ring->size}}">
                            <input type="hidden" name="type" value="{{$ring->type->name}}">
                              <input type="number" class="form-control ring-amount amount" name="quantity" value="0" min="10" max="100" step="5" data-price="{{ $ring->price }}">
                            @endif

                        </div>
                        <div class="col totalPrice">€<span class="ring-total">0</span></div>
                        <div class="col">
                            <button class="btn btn-success ring-add bg-green" data-id="{{ $ring->id }}">Toevoegen</button>
                        </div>
                    </div>
                   </form>
                @endforeach
            </div>
        </div>
        
        
      </div>
  </div>
</div>


{{-- <div class="container">
  <h2>Payment for Bird Rings</h2>
  <div class="row">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">Bird Ring Details</h5>
          
              <div class="row">
                  @foreach ($rings as $ring)
                  <div class="col-sm-3 mb-5 mb-sm-4">
                      <div class="card">
                          <div class="card-body">
                              <p class="card-text">{{ $ring->size }}mm </p>
                              <p class="card-text">€{{ $ring->price }}</p>
                          </div>
                      </div>
                  </div>
              @endforeach
              </div>
          </div>
      </div>
  </div>
</div>   --}}
@endsection

@section('scripts')
@vite(['resources/js/filter.js'])
@endsection