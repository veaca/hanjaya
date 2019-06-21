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
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Invoice Tanggal</td>
          <td>Invoice Nomor</td>
          <td>Invoice Customer</td>
          <td>Invoice Projects</td>
          <td>Invoice Jumlah</td>
          <td>Invoice Pajak</td>
          <td>Invoice Jumlah Total</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td>{{$invoice->id}}</td>
            <td>{{$invoice->tanggal}}</td>
            <td>{{$invoice->nomor}}</td>
            <td>{{$invoice->customer_id}}</td>
            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Project List</button></td>
            
            <td>{{$invoice->jumlah}}</td>
            <td>{{$invoice->pajak}}</td>
            <td>{{$invoice->jumlah_total}}</td>
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
                        <tr>
                          <td>{{$invoice->project_name}}</td>
                          <td>{{$invoice->project_info}}</td>
                          <td>{{$invoice->project_tarif}}</td>
                          <td>{{$invoice->quantity}}</td>
                        </tr>
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