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
  <a href="{{route('customer.create')}}" type="button" class="btn btn-success">Add Customer</a>
  <table id="tabledata" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th>ID</th>
          <th>Customer Name</th>
          <th>Customer Address</th>
          <th>Customer Phone</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->address}}</td>
            <td>{{$customer->phone}}</td>
            <td><a href="{{ route('customer.edit',$customer->id)}}" class="btn btn-primary">Edit</a>
            
                <form action="{{ route('customer.destroy', $customer->id)}}" method="post">
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