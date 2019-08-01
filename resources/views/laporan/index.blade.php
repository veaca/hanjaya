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
  <div>
    <a href="{{route('laporan.create')}}" type="button" class="btn btn-success">Create Laporan</a>
    <td><a href="{{ URL::to('periodeLaporan')}}" type="button" class="btn btn-info">View Receipt</a></td>
  </div>
  <br>
  
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
            <td>Rp. {{number_format($laporan->laporan_biaya_bulanan,2,",",".")}}</td>
            <td>Rp. {{number_format($laporan->laporan_invoice,2,",",".")}}</td>
            <td>Rp. {{number_format($laporan->laporan_nota,2,",",".")}}</td>
            <td>Rp. {{number_format($laporan->laporan_total,2,",",".")}}</td>
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