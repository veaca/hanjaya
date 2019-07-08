@extends('layout')

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
    <label for="">Tambah Laporan</label>
      <form method="post" action="{{ route('invoicenota.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Pilih Invoice:</label>
              <select class="form-control" name="invoice_id" >
                @foreach ($invoices as $invoice)
                <option value="{{$invoice->id}}">{{$invoice->nomor}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="price">Pilih Nota:</label>
              <select class="form-control" name="nota_id" >
                @foreach ($notas as $nota)
                <option value="{{$nota->id}}">{{$nota->NOP}}</option>
                @endforeach
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection