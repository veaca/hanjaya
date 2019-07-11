@extends('layout')
@section('page_title')
    {{ "Customer" }}
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
  <a href="{{route('customer.create')}}" type="button" class="btn btn-success m-5">Add Customer</a>
  <table id="tabledata" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Telephone</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
    </thead>
    <tbody>
      @php $i=1 @endphp
        @foreach($customers as $customer)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->address}}</td>
            <td>{{$customer->phone}}</td>
            <td><a href="{{ route('customer.edit',$customer->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
              <form action="{{ route('customer.destroy', $customer->id)}}" method="post">
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