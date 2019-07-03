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
  
  <a href="{{route('nota.create')}}" type="button" class="btn btn-success">Add nota</a>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Vendor</td>
          <td>Nota Tanggal</td>
          <td>Nota Asal</td>
          <td>Nota Tujuan</td>
          <td>NOP</td>
          <td>Surat Jalan</td>
          <td colspan="2">Tambahan</td>
          <td>PPh</td>
          <td>Jumlah Dibayar</td>
          <td colspan="4">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($notas as $nota)
        <tr>
            <td>{{$nota->id}}</td>
            <td>{{$nota->vendor_name}}</td>
            <td>{{$nota->tanggal}}</td>
            <td>{{$nota->asal}}</td>
            <td>{{$nota->tujuan}}</td>
            <td>{{$nota->NOP}}</td>
            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Surat Jalan</button></td>
            <td>{{$nota->jenis_tambahan}}</td>
            <td>{{$nota->jumlah_tambahan}}</td>
            <td>{{$nota->potongan_pph}}</td>
            <td>{{$nota->jumlah_dibayar}}</td>
            <td><a href="{{ route('printinvoice.show', $nota->id)}}" type="button" class="btn btn-warning">View</a></td>
            <td><a href="{{ URL::to('exportNota', $nota->id)}}" type="button" class="btn btn-info">Download</a></td>
            <td><a href="{{ route('nota.edit',$nota->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('nota.destroy', $nota->id)}}" method="post">
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
          <h4 class="modal-title">Surat Jalan</h4>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <td>Tanggal</td>
                <td>Nopol</td>
                <td>Collies</td>
                <td>Kg</td>
                <td>Ongkos</td>
              </tr>
            </thead>
            <tbody>
            @foreach ($notaDetails as $notaDetail)
              <tr>
                <td>{{$notaDetail->date}}</td>
                <td>{{$notaDetail->nopol}}</td>
                <td>{{$notaDetail->collies}}</td>
                <td>{{$notaDetail->kg}}</td>
                <td>{{$notaDetail->ongkos}}</td>
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