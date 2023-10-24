@extends('home')

@section('content')

<div class="container bg-white card">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">Order History</h2>
            
            @foreach($orders as $order)
                <div class="card mt-3">
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Order Total</th>
                                <th>Order Status</th>
                                {{-- <th>Order Details</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                    <tr>
                        <td>{{ $order['id'] }}</td>
                        <td>{{ $order['created_at'] }}</td>
                        <td>{{ $order['total_price'] }}</td>
                        <td>{{ $order['status'] }}</td>
                        {{-- <td><a href="{{ route('orderDetails', ['id' => $order['id']]) }}">View</a></td> --}}
                    </tr>
                    {{-- this is the detail of the order so it need to be displayed smaller under the order --}}
                    
                    <table class="table table-striped">
                        <h5>ringen:</h5>
                        <thead>
                            <tr>
                                
                                <th>Size</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Total</th>
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
            
            @endforeach
            
        </div>
    </div>
</div>

@endsection