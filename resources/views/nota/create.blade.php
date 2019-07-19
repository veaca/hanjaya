@extends('layout')
@section('page_title')
    {{ "Add Nota" }}
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
      <form method="post" action="{{ route('nota.store') }}" id="isi">
         @csrf
          <div class="form-group">
            <label for="quantity">Projects :</label><br>
              <div class="form-group" name="project_info" id="isi">
                <div class="row">
                  <div class="col-sm-4">
                    <select class="form-control" id="projectId" name='project_id'>
                      @foreach ($projects as $project)
                        <option class="dropdown-item" value="{{$project->id}}" >{{$project->nop}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            <div class="form-group">
              <label for="price">Vendor :</label>
              <select class="form-control" name='vendor_id' >
                @foreach ($vendors as $vendor)
                  <option class="dropdown-item" value="{{$vendor->id}}">{{$vendor->name}}</option>
                @endforeach
                </select>
          </div>
          
          <div class="form-group">
            <div class="row">
              <div class="col-sm-3">
                <label for="Jenis Tambahan"> Jenis Tambahan</label>
                <select class="form-control" name="jenis_tambahan" >
                  <option value="Penambahan">Penambahan</option>
                  <option value="Potongan">Potongan</option>
                </select>
              </div>
              <div class="col-sm-3">
                <label for="Jumlah Tambahan">Jumlah Tambahan</label>
                <input class="form-control" type="text" name="jumlah_tambahan">
              </div>
            </div>
          </div>
          <label for="price">Surat Jalan :</label>
          <br>
          <div class="form-group" id="rowIni" >
            <div class="row">
              <div class="col-sm-3">
                <label for="quantity">Nopol :</label>
                <input type="text" class="form-control" name="nopol">
              </div>
              <div class="col-sm-3">
                <label for="quantity">Kg :</label>
                <input type="text" class="form-control" name="kg">
              </div>
            </div>   
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>

<script>
 var count=1;
  function CloneForm(formName) {
   var row = document.createElement('div');
   row.className ="row";

   var colNopol = document.createElement('div');
   colNopol.className = "col-sm-3";
   var colCollies = document.createElement('div');
   colCollies.className = "col-sm-3";
   var colKg = document.createElement('div');
   colKg.className = "col-sm-3";
   var colOngkos = document.createElement('div');
   colOngkos.className = "col-sm-3";
    // console.log(formName);
    var nopol = document.getElementById('nopolId');
    var collies = document.getElementById('colliesId');
    var kg = document.getElementById('kgId');
    var ongkos = document.getElementById('ongkosId');
    // console.log (project);
    // var oForm = project;
    var cloneNopol = nopol.cloneNode(true);
    var cloneCollies = collies.cloneNode(true);
    var cloneKg = kg.cloneNode(true);
    var cloneOngkos = ongkos.cloneNode(true);
    // var cloneQuantity = quantity.cloneNode(true);
    cloneNopol.name = "nopol[" + count +"]";
    cloneNopol.value = "";
    cloneCollies.name = "collies[" + count +"]"; 
    cloneCollies.value = "";
    cloneKg.name = "kg[" + count +"]"; 
    cloneKg.value = "";
    cloneOngkos.name = "ongkos[" + count +"]"; 
    cloneOngkos.value = "";
    linebreak = document.createElement("br");
    colNopol.appendChild(cloneNopol);
    colCollies.appendChild(cloneCollies);
    colKg.appendChild(cloneKg);
    colOngkos.appendChild(cloneOngkos);
    row.appendChild(colNopol);
    row.appendChild(colCollies);
    row.appendChild(colKg);
    row.appendChild(colOngkos);
    document.getElementById('rowIni').appendChild(row);
    count +=1;
  }
</script>
@endsection