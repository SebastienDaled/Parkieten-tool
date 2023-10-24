@extends('admin.index')

@section('adminContent')

<div class="container mt-2">
  @if (session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
@endif
  <div class="card">
    <div class="card-body">
      <h3>Bestellingen</h3>
      <p>Selecteer de datum van wanner tot wanneer je de bestellingen wilt exporteren</p>
      {{-- filter van-tot een bepaalde tijd --}}
      <form action="{{ route("admin.exports.export")}}">
        @csrf
        <div class="row">
          <div class="col">
            <label for="van">van</label>
            <input type="date" name="van" class="form-control" placeholder="Van">
          </div>
          <div class="col">
            <label for="tot">tot</label>
            <input type="date" name="tot" class="form-control" placeholder="Tot">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary">export</button>
          </div>
        </div>
    </div>
  </div>
</div>

@endsection
