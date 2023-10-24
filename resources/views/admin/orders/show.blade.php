@extends('admin.index')

@section('adminContent')

<div class="container">
    <div class="card">
        <div class="card-body">
            <a href="{{ route("admin.orders")}}" class="btn btn-primary mb-4">< terug</a>

            <h3>Order ID: {{$order->id}} </h3>
            <p class="mb-4">Gebruiker: {{$order->user->name}}</p>
            <p class="mb-4">Status: {{$order->status}}</p>
            <p class="mb-4">Totaal: {{$order->total_price}}</p>
            <p class="mb-4">Datum: {{$order->created_at}}</p>
            <p class="mb-5">Soort: {{$order->payment_data}}</p>

            <div class="mb-5">
                <p>Opmerking:</p>
                @if ($order->remarks == null)
                <p class="font-italic mb-0">Geen opmerking</p>
                @else
                <p class="font-italic mb-0">{{$order->remarks}}</p>
                @endif
            </div>

            <div class="mb-5">
                <p>Admin opmerking:</p>
                @if ($order->admin_remarks == null)
                <p class="font-italic mb-0">Geen opmerking</p>
                @else
                <p class="font-italic mb-0">{{$order->admin_remarks}}</p>
                @endif
            </div>

            <p>Geupdated om: {{$order->updated_at}}</p>
            <p>Verzendkosten: {{$order->shipping_cost}}</p>
            <h4 class="mt-4">Producten:</h4>
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Ring size (mm)</th>
                  <th scope="col">Ring type</th>
                  <th scope="col">Price</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach($order->orderItems as $orderItem)
                <tr>
                  @foreach ($rings as $ring)
                    @if ($ring->id == $orderItem->ring_id)
                      <td>{{ $ring->size }}</td>
                      <td>{{ $ring->type->name }}</td>
                    @endif
                  @endforeach
                  <td>{{ $orderItem->price }}</td>
                  <td>{{ $orderItem->amount }}</td>
                  <td>{{ $orderItem->price * $orderItem->amount }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            

        </div>
    </div>
</div>

@endsection
