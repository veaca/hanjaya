@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit biaya
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
      <form method="post" action="{{ route('biaya.update', $biaya->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Biaya Bulan:</label>
          <input type="text" class="form-control" name="bulan" value="{{ $biaya->bulan }}" />
        </div>
        <div class="form-group">
          <label for="price">Biaya Gaji :</label>
          <input type="text" class="form-control" name="gaji" value="{{ $biaya->gaji }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Biaya BPJS:</label>
          <input type="text" class="form-control" name="bpjs" value="{{ $biaya->bpjs }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Biaya Bank:</label>
          <input type="text" class="form-control" name="bank" value="{{ $biaya->bank }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Biaya Listrik:</label>
          <input type="text" class="form-control" name="listrik" value="{{ $biaya->listrik }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Biaya PDAM:</label>
          <input type="text" class="form-control" name="pdam" value="{{ $biaya->pdam }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Biaya Lain:</label>
          <input type="text" class="form-control" name="biaya_lain" value="{{ $biaya->biaya_lain }}" />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection