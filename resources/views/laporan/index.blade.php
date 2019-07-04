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
  <a href="{{route('laporan.create')}}" type="button" class="btn btn-success">Add Laporan</a>
  <td><a href="{{ URL::to('periodeLaporan')}}" type="button" class="btn btn-info">Download Receipt</a></td>
  <table id="tabledata" class="table table-striped">
    <thead>
        <tr>
          <th>ID</th>
          <th>Bulan</th>
          <th>Tahun</th>
          <th>Total Biaya Lain</th>
          <th>Total Invoice</th>
          <th>Total Nota</th>
          <th>Total Bulan Ini</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporans as $laporan)
        <tr>
            <td>{{$laporan->id}}</td>
            <td>{{$laporan->bulan}}</td>
            <td>{{$laporan->tahun}}</td>
            <td>{{$laporan->laporan_biaya_bulanan}}</td>
            <td>{{$laporan->laporan_invoice}}</td>
            <td>{{$laporan->laporan_nota}}</td>
            <td>{{$laporan->laporan_total}}</td>
            <td><a href="{{ route('laporan.edit',$laporan->id)}}" class="btn btn-primary">Update</a>
                <form action="{{ route('laporan.destroy', $laporan->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
            
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection