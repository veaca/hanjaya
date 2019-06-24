@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit nota
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
      <form method="post" action="{{ route('nota.update', $nota->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Vendor:</label>
          <input type="text" class="form-control" name="vendor_id" value={{ $nota->vendor_id}} />
        </div>
        <div class="form-group">
          <label for="price">Nota Asal :</label>
          <input type="text" class="form-control" name="asal" value={{ $nota->asal }} />
        </div>
        <div class="form-group">
          <label for="quantity">Nota Tujuan:</label>
          <input type="text" class="form-control" name="tujuan" value={{ $nota->tujuan }} />
        </div>
        <div class="form-group">
          <label for="quantity">NOP:</label>
          <input type="text" class="form-control" name="NOP" value={{ $nota->NOP }} />
        </div>
        <div class="form-group">
          <label for="quantity">Nopol:</label>
          <input type="text" class="form-control" name="nopol" value={{ $nota->nopol }} />
        </div>
        <div class="form-group">
          <label for="quantity">Collies:</label>
          <input type="text" class="form-control" name="collies" value={{ $nota->collies }} />
        </div>
        <div class="form-group">
          <label for="quantity">Kg:</label>
          <input type="text" class="form-control" name="kg" value={{ $nota->kg }} />
        </div>
        <div class="form-group">
          <label for="quantity">Ongkos:</label>
          <input type="text" class="form-control" name="ongkos" value={{ $nota->ongkos }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection