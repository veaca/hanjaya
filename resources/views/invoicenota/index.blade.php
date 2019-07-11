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
  <a href="{{route('invoicenota.create')}}" type="button" class="btn btn-success">Add Invoice Nota</a>
  <table id="tabledata" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th>No</th>
          <th>Invoice Nomor</th>
          <th>Nota NOP</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @php $i=1 @endphp
        @foreach($invoiceNotas as $invoiceNota)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$invoiceNota->invoice_nomor}}</td>
            <td>{{$invoiceNota->nota_nop}}</td>
            <td><a href="{{ route('invoicenota.edit',$invoiceNota->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
        
                <form action="{{ route('invoicenota.destroy', $invoiceNota->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit">Delete</button>
                </form>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection