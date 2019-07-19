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
  <table id="project" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th>No</th>
          <th>NOP</th>
          <th>Customer</th>
          <th>SPK</th>
          <th>Asal</th>
          <th>Tujuan</th>
          <th>Tarif Project</th>
          <th>Kuantitas</th>
          <th>Tarif Vendor</th>
          <th>Nilai Project</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @php $i=1 @endphp
        @foreach($projects as $project)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$project->nop}}</td>
            <td>{{$project->name}}</td>
            <td>{{$project->spk}}</td>
            <td>{{$project->asal}}</td>
            <td>{{$project->tujuan}}</td>
            <td>{{$project->tarif}}</td>
            <td>{{$project->qty}}</td>
            <td>{{$project->tarif_vendor}}</td>
            <td>{{$project->nilai_project}}</td>
            <td><a href="{{ route('project.edit',$project->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
              <form action="{{ route('project.destroy', $project->id)}}" method="post">
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