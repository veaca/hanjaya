@extends('layout')
@section('page_title')
    {{ "Laporan" }}
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
  <a href="{{route('laporan.create')}}" type="button" class="btn btn-success">Create Laporan</a>
  <td><a href="{{ URL::to('periodeLaporan')}}" type="button" class="btn btn-info">View Receipt</a></td>
  <table id="laporan" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th>No</th>
          <th>Bulan</th>
          <th>Tahun</th>
          <th>Total Biaya Lain</th>
          <th>Piutang</th>
          <th>Hutang</th>
          <th>Total Bulan Ini</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
    </thead>
    <tbody>
      @php $i=1 @endphp
        @foreach($laporans as $laporan)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$laporan->bulan}}</td>
            <td>{{$laporan->tahun}}</td>
            <td>{{$laporan->laporan_biaya_bulanan}}</td>
            <td>{{$laporan->laporan_invoice}}</td>
            <td>{{$laporan->laporan_nota}}</td>
            <td>{{$laporan->laporan_total}}</td>
            <td><a href="{{ route('laporan.edit',$laporan->id)}}" class="btn btn-primary">Update</a></td>
            <td>
                <form action="{{ route('laporan.destroy', $laporan->id)}}" method="post">
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