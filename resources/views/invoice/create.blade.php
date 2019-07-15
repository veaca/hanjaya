@extends('layout')
@section('page_title')
    {{ "Add Invoice" }}
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
      <form method="post" id="data" action="{{ route('invoice.store') }}">
      <label for="price">Invoice Customer :</label>    
        <div class="form-group">
              @csrf
                <label for="customer">Pilih Customer</label>
                <select class="form-control" name='customer_id' >
                @foreach ($customers as $customer)
                  <option class="dropdown-item" value="{{$customer->id}}" >{{$customer->name}}</option>
                @endforeach
                </select>
          </div>
          <div class="form-group">
            <label for="jenis_pajak">Persen Pajak</label>
            <input type="text" class="form-control" name="jenis_pajak">
          </div>
          <label for="quantity">Invoice Projects :</label><br>
              <div class="form-group" name="project_info" id="isi">
                <div class="row">
                  <div class="col-sm-4">
                    <select class="form-control" id="projectId" name='project_id[0]'>
                      @foreach ($projects as $project)
                        <option class="dropdown-item" value="{{$project->id}}" >{{$project->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-4">
                  <input class="form-control" id="kuantitas" type="text" placeholder="Kuantitas Proyek" name="quantity[0]"/>
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-default" id="btnAddForm" onclick="CloneForm('isi')">+</button>
       <br>
       <br>
             <button type="submit" class="btn btn-primary">Add</button>
             <br>
          
      </form>
       
      
  </div>
</div>

<script>
  var count=1;
  var counter= 3;
  function CloneForm(formName) 
  {
    var project = document.getElementById('projectId');
    var quantity = document.getElementById('kuantitas');
    console.log (project);
    var cloneProject = project.cloneNode(true);
    var cloneQuantity = quantity.cloneNode(true);
    cloneProject.name = "project_id[" + count +"]";
    cloneProject.value ="";
    cloneQuantity.name = "quantity[" + count +"]"; 
    cloneQuantity.value = "";
    var linebreak = document.createElement("br");
    var colSm4 = document.createElement('div');
    colSm4.className = "col-sm-4";
    colSm4.appendChild(cloneProject);
    var colSm8 = document.createElement('div');
    colSm8.className ="col-sm-4";
    colSm8.appendChild(cloneQuantity);
    var row = document.createElement('div');
    row.className = "row";
    row.appendChild(colSm4);
    row.appendChild(colSm8)
    document.getElementById('isi').appendChild(row);
    console.log(count);
    // document.getElementById('isi').appendChild(cloneProject);
    // document.getElementById('isi').appendChild(cloneQuantity);
    // document.getElementById('isi').appendChild(linebreak);
    count +=1;
  }

  function removeForm(id)
  {
    counter = counter+count;
    console.log(counter);
    if (counter>=3)
    {
      if (counter >= 3)
      {
        counter -=1;
      var div = document.getElementById(id);
      div.removeChild(div.childNodes[counter]);
    // console.log(div.childNodes);
      }
    
    
    }
    
  }
</script>
@endsection