@extends('layout')
@section('page_title')
    {{ "Penggabungan Invoice dan Nota" }}
@endsection
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div >
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <a href="{{route('invoicenota.create')}}" type="button" class="btn btn-success">Add  invoicenota</a>
  <table id="tabledata" class="table table-striped">
    <thead>
        <tr>
          <th>ID</th>
          <th>Invoice Id</th>
          <th>Invoice Nomor</th>
          <th>Nota Id</th>
          <th>Nota Nomor</th>
          <th>Action</th>
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
            <td><a href="{{ route('invoicenota.edit',$invoiceNota->id)}}" class="btn btn-primary">Edit</a>
        
                <form action="{{ route('invoicenota.destroy', $invoiceNota->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
        
          <a href="{{ route('print.show', $invoiceNota->id)}}" type="button" class="btn btn-warning">View Receipt</a>
           <a href="{{ route('print.edit', $invoiceNota->id)}}" type="button" class="btn btn-info">Download Receipt</a></td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection