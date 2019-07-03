@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <a href="{{route('invoicenota.create')}}" type="button" class="btn btn-success">Add  invoicenota</a>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Invoice Id</td>
          <td>Invoice Nomor</td>
          <td>Nota Id</td>
          <td>Nota Nomor</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($invoiceNotas as $invoiceNota)
        <tr>
            <td>{{$invoiceNota->id}}</td>
            <td>{{$invoiceNota->invoice_id}}</td>
            <td>{{$invoiceNota->invoice_nomor}}</td>
            <td>{{$invoiceNota->nota_id}}</td>
            <td>{{$invoiceNota->nota_nop}}</td>
            <td><a href="{{ route('invoicenota.edit',$invoiceNota->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('invoicenota.destroy', $invoiceNota->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
            <td><a href="{{ route('print.show', $invoiceNota->id)}}" type="button" class="btn btn-warning">View Receipt</a></td>
            <td><a href="{{ route('print.edit', $invoiceNota->id)}}" type="button" class="btn btn-info">Download Receipt</a></td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection