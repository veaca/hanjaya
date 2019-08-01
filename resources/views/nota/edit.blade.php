@extends('layout')
@section('page_title')
    {{ "Edit Nota" }}
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
      <form method="post" action="{{ route('nota.update', $nota->id) }}" id="data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="quantity">Projects :</label><br>
              <div class="form-group" name="project_info" id="isi">
                <div class="row">
                  <div class="col-sm-4">
                    <select class="form-control" id="projectId" name='project_id' onclick=update()>
                      @foreach ($projects as $project)
                      @if ($project->id == $nota->project_id)
                        <option class="dropdown-item" value="{{$project->id}}" selected >{{$project->nop}}</option>
                      @else
                        <option class="dropdown-item" value="{{$project->id}}" >{{$project->nop}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
               <label for="asal">Asal :</label>
                <div class="">
                  <input type="text" id="asal" class="form-control" value="{{$nota->asal}}" disabled>
                </div>
              <label for="tujuan">Tujuan :</label>
                <div class="">
                  <input type="text" id="tujuan" class="form-control" value="{{$nota->tujuan}}" disabled>
                </div>
              <label for="tarif">Tarif Vendor</label>
                <div class="">
                  <input type="text" id="tarif" class="form-control" value="{{$nota->tarif_vendor}}" disabled>
                </div>
              </div>
            <div class="form-group">
              <label for="price">Vendor :</label>
              <select class="form-control" id="vendorId" name='vendor_id' onclick=updateVendor()>
                @foreach ($vendors as $vendor)
                @if ($vendor->id == $nota->vendor_id)
                  <option class="dropdown-item" value="{{$vendor->id}}" selected>{{$vendor->name}}</option>
                @else 
                  <option class="dropdown-item" value="{{$vendor->id}}">{{$vendor->name}}</option>
                @endif
                @endforeach
                </select>
                 <label for="PPh">PPh :</label>
                <div >
                  <input type="text" id="pph" value="{{$nota->pph}}" class="form-control" disabled>
                </div>
          </div>
          
          <div class="form-group">
            <div class="row">
              <div class="col-sm-3">
                <label for="Jenis Tambahan"> Jenis Tambahan</label>
                <select class="form-control" name="jenis_tambahan" >
                @if ($nota->jenis_tambahan == "Penambahan")
                  <option value="Penambahan" selected>Penambahan</option>
                  <option value="Potongan">Potongan</option>
                @else 
                  <option value="Penambahan" >Penambahan</option>
                  <option value="Potongan" selected>Potongan</option>
                @endif
                </select>
              </div>
              <div class="col-sm-3">
                <label for="Jumlah Tambahan">Jumlah Tambahan</label>
                <input class="form-control" type="text" name="jumlah_tambahan" value="{{$nota->jumlah_tambahan}}">
              </div>
            </div>
          </div>
          <label for="price">Surat Jalan :</label>
          <br>
          <div class="form-group" id="rowIni" >
            <div class="row">
              <div class="col-sm-3">
                <label for="quantity">Nopol :</label>
              </div>
              <div class="col-sm-3">
                <label for="quantity">Kg :</label>
              </div>
            </div>   
            
          </div>
          <button id="btnAdd" type="button" class="btn" onclick="add()">+</button>
          <button id="btnDel" type="button" class="btn" onclick="del()">-</button>
          <br>
          <br>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
<script>var idx=0;</script>
            @foreach ($notaDetails as $notaDetail)
            <script>
              
              function create()
              {
                var nopol = "<?php echo($notaDetail->nopol) ?>";
                console.log (nopol);
                var getDiv = document.getElementById('rowIni');
                var row = document.createElement('div');
                row.className = "row";
                var colNopol = document.createElement('div');
                colNopol.className = "col-sm-3";
                var inputNopol = document.createElement('input');
                inputNopol.type = 'text';
                inputNopol.className = 'form-control';
                inputNopol.name = 'nopol[' + idx +']';
                inputNopol.value = nopol;
                colNopol.appendChild(inputNopol);
                var colKg = document.createElement('div');
                colKg.className = "col-sm-3"; 
                var inputKg = document.createElement('input');
                inputKg.type = 'text';
                inputKg.className = 'form-control';
                inputKg.name = 'kg['+idx+']';
                inputKg.value = {{$notaDetail->kg}};
                var br = document.createElement('br');
                colKg.appendChild(inputKg);
                row.appendChild(colNopol);
                row.appendChild(colKg);
                
                getDiv.appendChild(row);
                // getDiv.appendChild(br);
                idx++;
              }
              create();
            </script>
            @endforeach
<script>
var asal = document.getElementById('asal');
var tarif = document.getElementById('tarif');
var tujuan = document.getElementById('tujuan');
var pph = document.getElementById('pph');
function update()
{
  var idxi = document.getElementById('projectId').selectedIndex;
  
  // console.log(idx);
  var project = <?php echo $projects ?>;
  
  asal.value = project[idxi].asal ;
  tujuan.value = project[idxi].tujuan;
  tarif.value = project[idxi].tarif_vendor;
  
}

function updateVendor()
{
var vendorId = document.getElementById('vendorId').selectedIndex;
var vendor = <?php echo $vendors ?>;
pph.value = vendor[vendorId].pph +"%";
}
var nodes = (3*idx) + 4;

var counter;
function add()
{
  var row = document.getElementById('rowIni');
  var nodes = document.getElementById('rowIni').childNodes;
  if (document.getElementById('btnDel').disabled == true)
  {
    // console.log ('sini');
    counter = 1;
    document.getElementById('btnDel').disabled=false;
  }
  else {
    var name = row.lastElementChild.lastChild.firstChild.getAttribute('name');
    counter = name.charAt(3);
  counter = parseInt(counter);
  // console.log(name);
  // console.log(nodes);
  // console.log(counter);
  
  counter = counter + 1;
  
  }
  
  
  var getDiv = document.getElementById('rowIni');
  var row = document.createElement('div');
  row.className = "row";
  var colNopol = document.createElement('div');
  colNopol.className = "col-sm-3";
  var inputNopol = document.createElement('input');
  inputNopol.type = 'text';
  inputNopol.className = 'form-control';
  inputNopol.name = 'nopol[' + counter +']';
  colNopol.appendChild(inputNopol);
  var colKg = document.createElement('div');
  colKg.className = "col-sm-3"; 
  var inputKg = document.createElement('input');
  inputKg.type = 'text';
  inputKg.className = 'form-control';
  inputKg.name = 'kg['+counter+']';
  var br = document.createElement('br');
  colKg.appendChild(inputKg);
  row.appendChild(colNopol);
  row.appendChild(colKg);
  // getDiv.appendChild(br);
  getDiv.appendChild(row);
  if (counter > 4)
  {
    return document.getElementById('btnAdd').disabled=true;
  }
}

function del()
{
  if (document.getElementById('btnAdd').disabled == true)
  {
    document.getElementById('btnAdd').disabled = false;
  }
  var count = document.getElementById('rowIni').childElementCount;
  var row = document.getElementById('rowIni');
  console.log(row);
  if (row.lastElementChild.lastChild.firstChild.getAttribute('name').charAt(3) == "0")
  {
    // console.log ('sini');
    // counter = 1;
    return document.getElementById('btnDel').disabled=true;
  }
  // console.log(count);
  // console.log(row.lastElementChild);
  row.removeChild(row.lastElementChild);
  
  // for (var i=1 ; i<=3 ; i++)
  // {
  //   row.removeChild(row.childNodes[nodes]);
  //   nodes--;
  // }
  if (nodes <=7)
  {
    document.getElementById('btnDel').disabled = true;
  }
}
</script>
@endsection