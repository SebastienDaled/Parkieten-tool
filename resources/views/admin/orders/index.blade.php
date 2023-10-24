@extends('admin.index')

@section('adminContent')

{{-- alle orders displayen --}}
<div class="container">
  @if (session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
@endif
  <div class="card">
    <div class="card-body">
      <div>
        <h5 class="card-title">Oders</h5>
      </div>
      <div>
        <table class="table table-striped mt-4">
          <thead>
              <tr>
                  <th>Order ID</th>
                  <th>gebruiker</th>
                  <th>Status</th>
                  <th>Totaal</th>
                  <th>Datum</th>
                  <th>Soort</th>
                  <th>Opmerking</th>
                  <th>Admin opmerking</th>
                  <th>geupdated om</th>
                  <th>Verzendkosten</th>
              </tr>
          </thead>
          @foreach ($orders as $order)
                {{-- de orders moeten gedisplayed worden --}}
                {{-- show id, user_id, user_name, status, total,price, payement_data, remarks, admin_remarks, created at, updtaed_at, shipping_cost --}}
                
          <tbody>
              <tr>
                  <td>{{ $order['id'] }}</td>
                  <td>{{ $order->user->name }}</td>
                  <td>{{ $order['status'] }}</td>
                  <td>{{ $order['total_price'] }}</td>
                  <td>{{ $order['created_at'] }}</td>
                  <td>{{ $order['payment_data'] }}</td>
                  <td>{{ $order['remarks'] }}</td>
                  <td>{{ $order['admin_remarks'] }}</td>
                  <td>{{ $order['updated_at'] }}</td>
                  <td>{{ $order['shipping_cost'] }}</td>
                  {{-- <td><a href="{{ route('orderDetails', ['id' => $order['id']]) }}">View</a></td> --}}
                  {{-- maak een bekijk, delete, bewerk--}}
                  <td>
                      <div class="btn-group">
                          <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class="btn btn-warning">Bekijk</a>
                          <a href="{{ route('admin.orders.edit', ['order' => $order->id]) }}" class="btn btn-success">Bewerk</a>
                          <a href="{{ route('admin.orders.delete', ['order' => $order->id]) }}" class="btn btn-danger">Verwijder</a>
                      </div>
                  </td>
              </tr>
          </tbody>
              
          @endforeach
      </div>
      
    </div>
  </div>
</div>



@endsection