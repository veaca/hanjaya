@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Invoice
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
      <form method="post" id="data" action="{{ route('invoice.store') }}">
          <div class="form-group">
              @csrf
             
              <label for="price">Invoice Customer :</label>
              <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Choose Customer
                </a>
                <select name='customer_id' >
                @foreach ($customers as $customer)
                  <option class="dropdown-item" value="{{$customer->id}}" >{{$customer->name}}</option>
                @endforeach
                </select>
              </div>
          </div>
          <div class="form-group">
            <label for="jenis_pajak">Persen Pajak</label>
            <input type="text" class="form-control" name=jenis_pajak>
          </div>
          <label for="quantity">Invoice Projects :</label><br>
              
              <div class="form-group" name="project_info" id="isi">
                <select id="projectId" name='project_id[0]'>
                  @foreach ($projects as $project)
                    <option class="dropdown-item" value="{{$project->id}}" >{{$project->name}}</option>
                  @endforeach
                  </select>
                <input id="kuantitas" type="text" placeholder="Kuantitas Proyek" name="quantity[0]"/>
                <br>
             <button type="submit" class="btn btn-primary">Add</button>
          </div>
      </form>
       <button type="button" id="btnAddForm" onclick="CloneForm('isi')">Add another Project</button>
       <br>
      
  </div>
</div>

<script>
  var count=1;
  function CloneForm(formName) 
  {
    var project = document.getElementById('projectId');
    var quantity = document.getElementById('kuantitas');
    console.log (project);
    var cloneProject = project.cloneNode(true);
    var cloneQuantity = quantity.cloneNode(true);
    cloneProject.name = "project_id[" + count +"]";
    cloneQuantity.name = "quantity[" + count +"]"; 
    linebreak = document.createElement("br");
    document.getElementById('isi').appendChild(cloneProject);
    document.getElementById('isi').appendChild(cloneQuantity);
    document.getElementById('isi').appendChild(linebreak);
    count +=1;
  }
</script>
@endsection