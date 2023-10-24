@extends('home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
              
              <div id="cart">
                  <div class="card">
                      <div class="card-header">Cart</div>
                      <div class="card-body">
                          <div class="row">
                              <div class="col-md-12">
                                  <table class="table table-striped" id="cartTable">
                                      <thead>
                                          <tr>
                                              <th>Size</th>
                                              <th>Type</th>
                                              <th>Price</th>
                                              <th>Amount</th>
                                              <th>Total</th>
                                              <th></th>
                                          </tr>
                                      </thead>
                                      {{-- get them from the sessionstorage --}}
                                      <tbody>
                                       
                                          {{-- {{$cartItems}} --}}
                                          @if (Cart::count() > 0)
                                            
                                          @foreach ($cartItems as $cartItem)
                                          <form action="{{route('deleteFromCart')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="rowId" value="{{ $cartItem->rowId }}">
                                            <tr>
                                              <td>{{ $cartItem->name['size'] }}</td>
                                              <td>{{ $cartItem->name['type'] }}</td>
                                              <td>{{ $cartItem->price }}</td>
                                              <td>{{ $cartItem->qty }}</td>
                                              <td>{{ $cartItem->qty * $cartItem->price }}</td>
                                              <td><button class="btn btn-danger">Remove</button></td>
                                            </tr>
                                          </form>
                                        @endforeach

                                          @else

                                          <tr>
                                            <td colspan="6">No items in cart</td>
                                          </tr>
                                          @endif
                                      </tbody>
                                  </table>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12 text-end">
                                  <h4>Total: <span id="cartTotal">{{ $total }}</span></h4>
                              </div>
                          </div>
                          

                          <div class="row">
                              <div class="col-md-12 text-end">
                                <form action="{{ route('checkout') }}" method="POST">
                                    @csrf
                                    @if (Cart::count() > 0)
                                        <div class="row text-start">
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shipping_option" id="shipping_option1" value="2.50" required {{ old('shipping_option') == '2.50' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="shipping_option1">
                                                        Gewone verzending: €2,50
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shipping_option" id="shipping_option2" value="10.00" {{ old('shipping_option') == '10.00' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="shipping_option2">
                                                        Aangetekende en verzekerde verzending: €10,00
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary" id="checkout">Checkout</button>
                                </form>
                                
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

        </div>
    </div>
</div>
@endsection