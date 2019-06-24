@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Nota
  </div>
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
      <form method="post" action="{{ route('nota.store') }}">
          <div class="form-group">
              @csrf
              <label for="price">Vendor :</label>
              <input type="text" class="form-control" name="vendor"/>
          </div>
          <div class="form-group">
              <label for="quantity">Nota Asal :</label>
              <input type="text" class="form-control" name="asal"/>
          </div>
          <div class="form-group">
              <label for="quantity">Nota Tujuan :</label>
              <input type="text" class="form-control" name="tujuan"/>
          </div>
          <div class="form-group">
              <label for="quantity">Nota NOP :</label>
              <input type="text" class="form-control" name="NOP"/>
          </div>
          <div class="form-group">
              <label for="quantity">Nopol :</label>
              <input type="text" class="form-control" name="nopol"/>
          </div>
          <div class="form-group">
              <label for="quantity">Collies :</label>
              <input type="text" class="form-control" name="collies"/>
          </div>
          <div class="form-group">
              <label for="quantity">Kg :</label>
              <input type="text" class="form-control" name="kg"/>
          </div>
          <div class="form-group">
              <label for="quantity">Ongkos:</label>
              <input type="text" class="form-control" name="ongkos"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection