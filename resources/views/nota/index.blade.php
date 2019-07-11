@extends('layout')
@section('page_title')
    {{ "Nota" }}
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
  
  <a href="{{route('nota.create')}}" type="button" class="btn btn-success">Add nota</a>
  <br>
  <table id="tabledata" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th>No</th>
          <th>Vendor</th>
          <th>Tanggal Dibuat</th>
          <th >Asal</th>
          <th>Tujuan</th>
          <th>NOP</th>
          <th>Jumlah Dibayar</th>
          <th>View</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @php $i=1 @endphp
        @foreach($notas as $nota)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$nota->vendor_name}}</td>
            <td>{{$nota->tanggal}}</td>
            <td>{{$nota->asal}}</td>
            <td>{{$nota->tujuan}}</td>
            <td>{{$nota->NOP}}</td>
            <td>{{$nota->jumlah_dibayar}}</td>
            <td><a href="{{ URL::to('viewNota', $nota->id)}}" type="button" class="btn btn-warning">View</a></td>
            <td><a href="{{ route('nota.edit', $nota->id)}}" type="button" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('nota.destroy', $nota->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit">Delete</button>
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