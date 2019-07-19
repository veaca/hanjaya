@extends('layout')
@section('page_title')
    {{ "Edit Invoice" }}
@endsection
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<script>
 var count=0;
</script>
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
      <form  method="post" action="{{ route('invoice.update', $invoice->id) }}">
        @method('PATCH')
        @csrf
        <label for="quantity">Invoice Projects :</label><br>
              <div class="form-group" name="project_info" id="isi">
                <div class="row">
                  <div class="col-sm-4">
                    <select class="form-control" id="projectId" name='project_id'>
                      @foreach ($projects as $project)
                        @if ($project->id == $invoice->project_id)
                        <option class="dropdown-item" value="{{$project->id}} selected" >{{$project->nop}}</option>
                        @else
                        <option class="dropdown-item" value="{{$project->id}}" >{{$project->nop}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            <div>
              <label for="info">Info :</label>
              <input type="text" class="form-control" name="info" value="{{$invoice->info}}">
            </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>

@endsection