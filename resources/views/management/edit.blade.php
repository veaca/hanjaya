@extends('layout')
@section('page_title')
    {{ "Edit User" }}
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
      <form method="post" action="{{ route('management.update', $user->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Username:</label>
          <input type="text" class="form-control" name="name" value="{{ $user->name }}"  />
        </div>
        <div class="form-group">
          <label for="price">Email:</label>
          <input type="text" class="form-control" name="email" value="{{ $user->email }}" />
        </div>
        <div class="form-group row">
                            <label for="role" class="col-md-1 col-form-label text-md-right">Role</label>
                        <div class="col-md-3">
                                <select name="role" class="form-control" >
                                  @if ($user->role == 'admin')
                                    <option value="admin" selected>Admin</option>
                                    <option value="staf">Staf</option>
                                  @else
                                  <option value="admin" >Admin</option>
                                    <option value="staf" selected>Staf</option>
                                  @endif
                                </select>
                            </div>
                        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection