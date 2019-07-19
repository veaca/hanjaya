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
  <table id="nota" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th>No</th>
          <th>Tanggal Dibuat</th>
          <th>NOP</th>
          <th>Vendor</th>
          <th>Asal</th>
          <th>Tujuan</th>
          <th>Tarif Vendor</th>
          <th>Kg</th>
          <th>Potongan PPh</th>
          <th>Ongkos Nota</th>
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
            <td>{{$nota->tanggal}}</td>
            <td>{{$nota->nop}}</td>
            <td>{{$nota->vendor_name}}</td>
            <td>{{$nota->asal}}</td>
            <td>{{$nota->tujuan}}</td>
            <td>{{$nota->tarif_vendor}}</td>
            <td>{{$nota->kg}}</td>
            <td>{{$nota->jumlah_pph}}</td>
            <td>{{$nota->ongkos_nota}}</td>
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
 
  </div>
@endsection