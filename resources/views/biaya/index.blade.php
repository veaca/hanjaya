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
  <a href="{{route('biaya.create')}}" type="button" class="btn btn-success">Add Biaya</a>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Biaya Bulan</td>
          <td>Biaya Gaji</td>
          <td>Biaya BPJS</td>
          <td>Biaya Bank</td>
          <td>Biaya Listrik</td>
          <td>Biaya PDAM</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($biayas as $biaya)
        <tr>
            <td>{{$biaya->id}}</td>
            <td>{{$biaya->bulan}}</td>
            <td>{{$biaya->gaji}}</td>
            <td>{{$biaya->bpjs}}</td>
            <td>{{$biaya->bank}}</td>
            <td>{{$biaya->listrik}}</td>
            <td>{{$biaya->pdam}}</td>
            <td><a href="{{ route('biaya.edit',$biaya->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('biaya.destroy', $biaya->id)}}" method="post">
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