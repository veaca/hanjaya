@extends('layout')
@section('page_title')
    {{ "Edit Project" }}
@endsection
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card">
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
          <input type="text" class="form-control" name="name" value="{{ $project->name }}" />
        </div>
        <div class="form-group">
          <label for="price">Project Info :</label>
          <input type="text" class="form-control" name="info" value="{{ $project->info }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Project Tarif:</label>
          <input type="text" class="form-control" name="tarif" value="{{ $project->tarif }}" />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection