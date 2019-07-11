@extends('layout')
@section('page_title')
    {{ "Edit Gabungan Invoice dan Nota" }}
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
      <form method="post" action="{{ route('invoicenota.update', $invoiceNota->id) }}">
      @method('PATCH')
        @csrf
          <div class="form-group">
              
              <label for="name">Pilih Invoice:</label>
              <select class="form-control" name="invoice_id" >
                @foreach ($invoices as $invoice)
                    @if ($invoice->id == $invoiceNota->invoice_id)
                        <option value="{{$invoice->id}}" selected>{{$invoice->nomor}}</option>
                    @else
                        <option value="{{$invoice->id}}">{{$invoice->nomor}}</option>
                    @endif
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="price">Pilih Nota:</label>
              <select class="form-control" name="nota_id" >
                @foreach ($notas as $nota)
                @if ($nota->id == $invoiceNota->nota_id)
                <option value="{{$nota->id}}" selected>{{$nota->NOP}}</option>
                @else
                <option value="{{$nota->id}}">{{$nota->NOP}}</option>
                @endif
                @endforeach
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection