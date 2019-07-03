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
  <a href="{{route('invoice.create')}}" type="button" class="btn btn-success">Add Invoice</a>
  <table class="table table-bordered">
    <thead>
        <tr>
          <td>ID</td>
          <td>Tanggal</td>
          <td>Nomor</td>
          <td>Customer</td>
          <td>Jumlah</td>
          <td>Persen Pajak</td>
          <td>Jumlah Pajak</td>
          <td>Jumlah Total</td>
          <td>Projects</td>
          <td colspan="4">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td name="invoice_id" value="{{$invoice->id}}">{{$invoice->id}}</td>
            <td>{{$invoice->tanggal}}</td>
            <td>{{$invoice->nomor}}</td>
            <td>{{$invoice->customer_name}}</td>
            <td>{{$invoice->jumlah}}</td>
            <td>{{$invoice->jenis_pajak}}</td>
            <td>{{$invoice->pajak}}</td>
            <td>{{$invoice->jumlah_total}}</td>
            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Project List</button></td>
            <td><a href="{{ route('printinvoice.show', $invoice->id)}}" type="button" class="btn btn-warning">View</a></td>
            <td><a href="{{ URL::to('exportInvoice', $invoice->id)}}" type="button" class="btn btn-info">Download</a></td>
            <td><a href="{{ route('invoice.edit',$invoice->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('invoice.destroy', $invoice->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Projects</h4>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <td>Nama</td>
                <td>Info</td>
                <td>Tarif</td>
                <td>Kuantitas</td>
              </tr>
            </thead>
            <tbody>
            <script>
              function modalData(count)
              {
                var invoiceId =  document.getElementsByName("invoice_id")[0].getAttribute("value");
                count+=1;
                return invoiceId;
              }
            </script>
            @foreach($projects as $project)
              <tr>
                <?php 
                if( 1  == $project->invoice_id)
                {
                echo "<td>{{$project->project_name}}</td>";
                echo "<td>{{$project->project_info}}</td>";
                echo "<td>{{$project->project_tarif}}</td>";
                echo "<td>{{$project->quantity}}</td>";
                }
                ?>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<div>
@endsection