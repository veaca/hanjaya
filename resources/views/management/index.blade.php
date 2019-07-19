@extends('layout')
@section('page_title')
    {{ "Management" }}
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
  <a href="{{route('management.create')}}" type="button" class="btn btn-success m-5">Add User</a>
  <table id="user" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th>No</th>
          <th>User</th>
          <th>Email</th>
          <th>Role</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
    </thead>
    <tbody>
      @php $i=1 @endphp
        @foreach($managements as $management)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$management->name}}</td>
            <td>{{$management->email}}</td>
            <td>{{$management->role}}</td>
            <td><a href="{{ route('management.edit',$management->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
              <form action="{{ route('management.destroy', $management->id)}}" method="post">
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