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
          <td>Nota Tanggal</td>
          <td>Nota Asal</td>
          <td>Nota Tujuan</td>
          <td>NOP</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($notas as $nota)
        <tr>
            <td>{{$nota->id}}</td>
            <td>{{$nota->tanggal}}</td>
            <td>{{$nota->asal}}</td>
            <td>{{$nota->tujuan}}</td>
            <td>{{$nota->NOP}}</td>
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
<div>
@endsection