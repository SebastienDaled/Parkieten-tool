@extends('admin.index')

@section('adminContent')

{{-- edit order --}}
<div class="container">
  <div class="card">
    <div class="card-body">
      <div>
        <h5 class="card-title">Bewerk order</h5>
      </div>
      <div>
        <form action="{{ route('admin.orders.update', ['order' => $order->id]) }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
              @if ($order->status == 'pending')
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }} @selected(true)>pending</option>
                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>paid</option>
                <option value="besteld" {{ $order->status == 'besteld' ? 'selected' : '' }}>besteld</option>
                <option value="verzonden" {{ $order->status == 'verzonden' ? 'selected' : '' }}>verzonden</option>

              @elseif ($order->status == 'paid')
                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }} @selected(true)>paid</option>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>pending</option>
                <option value="besteld" {{ $order->status == 'besteld' ? 'selected' : '' }}>besteld</option>
                <option value="verzonden" {{ $order->status == 'verzonden' ? 'selected' : '' }}>verzonden</option>

              @elseif ($order->status == 'besteld')
                <option value="besteld" {{ $order->status == 'besteld' ? 'selected' : '' }} @selected(true)>besteld</option>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>pending</option>
                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>paid</option>
                <option value="verzonden" {{ $order->status == 'verzonden' ? 'selected' : '' }}>verzonden</option>

              @elseif ($order->status == 'verzonden')
                <option value="verzonden" {{ $order->status == 'verzonden' ? 'selected' : '' }} @selected(true)>verzonden</option>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>pending</option>
                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>paid</option>
                <option value="besteld" {{ $order->status == 'besteld' ? 'selected' : '' }}>besteld</option>
              
              @endif
              
            </select>
          </div>
          <div class="form-group mt-2">
            <label for="admin_remarks">Admin opmerking</label>
            <textarea type="textarea" class="form-control" name="admin_remarks" id="admin_remarks" value="{{ $order->admin_remarks }}" cols="30" rows="5" placeholder="Max 500 tekens"></textarea>
          </div>
          <button type="submit" class="btn btn-primary mt-4">Bewerk</button>
        </form>
      </div>
    </div>
  </div>

@endsection