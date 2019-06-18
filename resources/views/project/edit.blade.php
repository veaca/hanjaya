@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit project
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('project.update', $project->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Project Name:</label>
          <input type="text" class="form-control" name="name" value={{ $project->name }} />
        </div>
        <div class="form-group">
          <label for="price">Project Address :</label>
          <input type="text" class="form-control" name="address" value={{ $project->address }} />
        </div>
        <div class="form-group">
          <label for="quantity">Project Phone:</label>
          <input type="text" class="form-control" name="phone" value={{ $project->phone }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection