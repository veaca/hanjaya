@extends('layout')
@section('page_title')
    {{ "Invoice" }}
@endsection
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
<a href="{{route('invoice.create')}}" type="button" class="btn btn-success">Add Invoice</a>
<br>
  <table id="invoice" class="table table-bordered">
    <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Nomor</th>
          <th>Customer</th>
          <th>Address</th>
          <th>NOP</th>
          <th>Tarif</th>
          <th>Kuantitas</th>
          <th>Nilai PPN</th>
          <th>Nilai Akhir</th>
          <th>Info</th>
          <th>View</th>
          <th>Edit</th>
          <th>Delete</th>
          
        </tr>
    </thead>
    <tbody>
        @php $no=1 @endphp
        @php $i=[] @endphp
        @php $j=1 @endphp
        @php $modalCount =0 @endphp
        @foreach($invoices as $invoice)
        <tr>
        @php $i[$j++] = $invoice->id @endphp
            <td name="invoice_id" value="{{$invoice->id}}">{{$invoice->id}}</td>
            <td>{{$invoice->tanggal}}</td>
            <td>{{$invoice->nomor}}</td>
            <td>{{$invoice->name}}</td>
            <td>{{$invoice->address}}</td>
            <td>{{$invoice->nop}}</td>
            <td>{{$invoice->tarif}}</td>
            <td>{{$invoice->qty}}</td>
            <td>{{$invoice->jumlah_ppn}}</td>
            <td>{{$invoice->jumlah_invoice}}</td>
            <td>{{$invoice->info}}</td>
            <td><a href="{{ URL::to('viewInvoice', $invoice->id)}}" type="button" class="btn btn-warning">View</a></td>
            <td> 
              <a href="{{ route('invoice.edit',$invoice->id)}}" class="btn btn-primary">Edit</a></td>
            <td><form action="{{ route('invoice.destroy', $invoice->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
            
            
        </tr>
        @endforeach
    </tbody>
  </table>
  


 
<div>

@endsection