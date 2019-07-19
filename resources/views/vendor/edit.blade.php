@extends('layout')
@section('page_title')
    {{ "Edit Vendor" }}
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
      <form method="post" action="{{ route('vendor.update', $vendor->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Vendor Name:</label>
          <input type="text" class="form-control" name="name" value="{{ $vendor->name }}" />
        </div>
        <div class="form-group">
          <label for="price">Vendor Address :</label>
          <input type="text" class="form-control" name="address" value="{{ $vendor->address }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Vendor Phone:</label>
          <input type="text" class="form-control" name="phone" value="{{ $vendor->phone }}" />
        </div>
        <div class="form-group">
            <label for="npwp">NPWP :</label>
            <input type="text" class="form-control" name="npwp" value="{{$vendor->npwp}}">
          </div>
          <div class="form-group">
            <label for="PPN">PPH :</label>
            <select class="form-control" name="pph">
            @if ($vendor->pph == "0")
              <option value="0" selected>0%</option>
              @else
              <option value="0">0%</option>
            @endif
            @if ($vendor->pph == "0.5")
              <option value="0.5" selected>0,5%</option>
              @else
              <option value="0.5">0.5%</option>
            @endif
            @if ($vendor->pph == "0")
              <option value="1" selected>1%</option>
              @else
              <option value="1">1%</option>
            @endif
            @if ($vendor->pph == "0")
              <option value="2" selected>2%</option>
              @else
              <option value="2">2%</option>
            @endif
            @if ($vendor->pph == "0")
              <option value="4" selected>4%</option>
              @else
              <<option value="4">4%</option>
            @endif
            </select>
          </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection