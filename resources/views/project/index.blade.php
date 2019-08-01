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
  @if ($message = Session::get('error'))

<div class="alert alert-danger alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

        <strong>{{ $message }}</strong>

</div>

@endif
  <div >
    <a href="{{route('project.create')}}" type="button" class="btn btn-success">Add Project</a>
  </div>
  <br>
  <div >
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
          <th>Ongkos Nota</th>
          <th>Nilai Project</th>
          <th>Biaya Lain</th>
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
            <td>Rp. {{number_format($project->tarif,2,",",".")}}</td>
            <td>{{number_format($project->qty,0,".",".")}}</td>
            <td>Rp. {{number_format($project->tarif_vendor,2,",",".")}}</td>
            <td>Rp. {{number_format($project->ongkos_nota,2,",",".")}}</td>
            <td>Rp. {{number_format($project->nilai_project,2,",",".")}}</td>
            <td>Rp. {{number_format($project->biaya_lain,2,",",".")}}</td>
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
  </div>
  
<div>
@endsection