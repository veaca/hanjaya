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
                    <select class="form-control" id="projectId" name='project_id' onclick=update()>
                      @foreach ($projects as $project)
                        <option class="dropdown-item" value="{{$project->id}}" >{{$project->nop}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              
          </div>
          <div class="form-group">
                <label for="asal">Asal :</label>
                <div class="">
                  <input type="text" id="asal" class="form-control" value="{{$projects[0]->asal}}" disabled>
                </div>
              <label for="tujuan">Tujuan :</label>
                <div class="">
                  <input type="text" id="tujuan" class="form-control" value="{{$projects[0]->tujuan}}" disabled>
                </div>
              <label for="tarif">Tarif Vendor</label>
                <div class="">
                  <input type="text" id="tarif" class="form-control" value="{{$projects[0]->tarif_vendor}}" disabled>
                </div>
              </div>
            <div class="form-group">
              <label for="price">Vendor :</label>
              <select class="form-control" name='vendor_id' id="vendorId" onclick=updateVendor()>
                @foreach ($vendors as $vendor)
                  <option class="dropdown-item" value="{{$vendor->id}}">{{$vendor->name}}</option>
                @endforeach
                </select>
                <label for="PPh">PPh :</label>
                <div class="">
                  <input type="text" id="pph" class="form-control" value="{{$vendors[0]->pph}}" disabled>
                </div>
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
                <input type="text" class="form-control" name="nopol[0]">
              </div>
              <div class="col-sm-3">
                <label for="quantity">Kg :</label>
                <input type="text" class="form-control" name="kg[0]">
              </div>
            </div>   
          </div>
          
          <button id="btnAdd" type="button" class="btn" onclick="add()">+</button>
          <button id="btnDel" type="button" class="btn" onclick="del()">-</button>
          <br>
          <br>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>

<script>
var asal = document.getElementById('asal');
var tarif = document.getElementById('tarif');
var tujuan = document.getElementById('tujuan');
var pph = document.getElementById('pph');
function update()
{
  var idx = document.getElementById('projectId').selectedIndex;
  
  // console.log(idx);
  var project = <?php echo $projects ?>;
  
  asal.value = project[idx].asal ;
  tujuan.value = project[idx].tujuan;
  tarif.value = project[idx].tarif_vendor;
  
}

function updateVendor()
{
var vendorId = document.getElementById('vendorId').selectedIndex;
var vendor = <?php echo $vendors ?>;
pph.value = vendor[vendorId].pph +"%";
}
var idx = 1;
function add()
{
  if(idx > 5)
  {
    return document.getElementById('btnAdd').disabled = true;
  }
  else 
  {
    document.getElementById('btnAdd').disabled = false;
  }
  var getDiv = document.getElementById('rowIni');
  var row = document.createElement('div');
  row.className = "row";
  var colNopol = document.createElement('div');
  colNopol.className = "col-sm-3";
  var inputNopol = document.createElement('input');
  inputNopol.type = 'text';
  inputNopol.className = 'form-control';
  inputNopol.name = 'nopol[' + idx +']';
  colNopol.appendChild(inputNopol);
  var colKg = document.createElement('div');
  colKg.className = "col-sm-3"; 
  var inputKg = document.createElement('input');
  inputKg.type = 'text';
  inputKg.className = 'form-control';
  inputKg.name = 'kg['+idx+']';
  var br = document.createElement('br');
  colKg.appendChild(inputKg);
  row.appendChild(colNopol);
  row.appendChild(colKg);
  // getDiv.appendChild(br);
  getDiv.appendChild(row);
  
  idx++;
  // console.log (idx);
  if (idx <= 1){
    document.getElementById('btnDel').disabled = true;
  }
  else 
  {
    document.getElementById('btnDel').disabled = false;
  }
}

function del()
{
  if (idx <= 1){
    return document.getElementById('btnDel').disabled = true;
  }
  else 
  {
    document.getElementById('btnDel').disabled = false;
  }
  var getDiv = document.getElementById('rowIni');
  // console.log (getDiv);
  getDiv.removeChild(getDiv.lastChild);
  // console.log(idx);
  if (idx == 6)
  {
    document.getElementById('btnAdd').disabled = false;
    // console.log('masi');
  }
  idx--;

  // console.log(idx);
}
</script>
@endsection