@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit laporan
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
      <form method="post" action="{{ route('laporan.update', $laporan->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Laporan Biaya Lain:</label>
          <input type="text" class="form-control" name="biaya_lain_id" value="{{ $laporan->biaya_lain_id }}" />
        </div>
        <div class="form-group">
          <label for="price">Laporan Invoice Nota :</label>
          <input type="text" class="form-control" name="invoice_nota_id" value="{{ $laporan->invoice_nota_id }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Laporan Modal:</label>
          <input type="text" class="form-control" name="modal" value="{{ $laporan->modal }}" />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection