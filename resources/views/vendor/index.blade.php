@extends('layout')
@section('page_title')
    {{ "Vendor" }}
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
  <a href="{{route('vendor.create')}}" type="button" class="btn btn-success">Add vendor</a>
  <table id="tabledata" class="table table-striped table-bordered">
    <thead>
        <tr>
          <td>ID</td>
          <td>Vendor Name</td>
          <td>Vendor Address</td>
          <td>Vendor Phone</td>
          <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($vendors as $vendor)
        <tr>
            <td>{{$vendor->id}}</td>
            <td>{{$vendor->name}}</td>
            <td>{{$vendor->address}}</td>
            <td>{{$vendor->phone}}</td>
            <td><a href="{{ route('vendor.edit',$vendor->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('vendor.destroy', $vendor->id)}}" method="post">
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