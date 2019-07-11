@extends('layout')
@section('page_title')
    {{ "Biaya Lain" }}
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
  <a href="{{route('biaya.create')}}" type="button" class="btn btn-success">Add Biaya</a>
  <table id="tabledata" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th>No</th>
          <th>Bulan</th>
          <th>Tahun</th>
          <th>Biaya Gaji</th>
          <th>Biaya BPJS</th>
          <th>Biaya Bank</th>
          <th>Biaya Listrik</th>
          <th>Biaya PDAM</th>
          <th>Biaya Lain</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
    </thead>
    <tbody>
      @php $i=1 @endphp
        @foreach($biayas as $biaya)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$biaya->bulan}}</td>
            <td>{{$biaya->tahun}}</td>
            <td>{{$biaya->gaji}}</td>
            <td>{{$biaya->bpjs}}</td>
            <td>{{$biaya->bank}}</td>
            <td>{{$biaya->listrik}}</td>
            <td>{{$biaya->pdam}}</td>
            <td>{{$biaya->biaya_lain}}</td>
            <td><a href="{{ route('biaya.edit',$biaya->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
            
                <form action="{{ route('biaya.destroy', $biaya->id)}}" method="post">
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