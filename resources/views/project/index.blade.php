@extends('layout')
@section('page_title')
    {{ "Project" }}
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
  <a href="{{route('project.create')}}" type="button" class="btn btn-success">Add project</a>
  <table id="tabledata" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th>ID</th>
          <th>Project Name</th>
          <th>Project Info</th>
          <th>Project Tarif</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td>{{$project->id}}</td>
            <td>{{$project->name}}</td>
            <td>{{$project->info}}</td>
            <td>{{$project->tarif}}</td>
            <td><a href="{{ route('project.edit',$project->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('project.destroy', $project->id)}}" method="post">
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