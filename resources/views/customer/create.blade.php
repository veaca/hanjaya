@extends('layout')
@section('page_title')
    {{ "Add Customer" }}
@endsection
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card">
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('customer.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Customer Name :</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="price">Customer Address :</label>
              <input type="text" class="form-control" name="address"/>
          </div>
          <div class="form-group">
              <label for="quantity">Customer Phone :</label>
              <input type="text" class="form-control" name="phone"/>
          </div>
          <div class="form-group">
            <label for="npwp">NPWP :</label>
            <input type="text" class="form-control" name="npwp">
          </div>
          <div class="form-group">
            <label for="PPN">PPN :</label>
            <input type="text" class="form-control" name="ppn">
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection