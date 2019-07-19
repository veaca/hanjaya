@extends('layout')
@section('page_title')
    {{ "Add Vendor" }}
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
      <form method="post" action="{{ route('vendor.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Vendor Name :</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="price">Vendor Address :</label>
              <input type="text" class="form-control" name="address"/>
          </div>
          <div class="form-group">
              <label for="quantity">Vendor Phone :</label>
              <input type="text" class="form-control" name="phone"/>
          </div>
          <div class="form-group">
            <label for="npwp">NPWP :</label>
            <input type="text" class="form-control" name="npwp">
          </div>
          <div class="form-group">
            <label for="PPN">PPH :</label>
            <select class="form-control" name="pph">
              <option value="0">0%</option>
              <option value="0.5">0,5%</option>
              <option value="1">1%</option>
              <option value="2">2%</option>
              <option value="4">4%</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection