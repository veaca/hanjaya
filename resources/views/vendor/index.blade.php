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
  <div>
    <a href="{{route('vendor.create')}}" type="button" class="btn btn-success">Add vendor</a>
  </div>
  <br>
  <div>
    <table id="vendor" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Telephone</th>
          <th>NPWP</th>
          <th>PPh</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @php $i=1 @endphp
        @foreach($vendors as $vendor)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$vendor->name}}</td>
            <td>{{$vendor->address}}</td>
            <td>{{$vendor->phone}}</td>
            <td>{{$vendor->npwp}}</td>
            <td>{{$vendor->pph}}</td>
            <td><a href="{{ route('vendor.edit',$vendor->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
              <form action="{{ route('vendor.destroy', $vendor->id)}}" method="post">
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
  
<div>
@endsection