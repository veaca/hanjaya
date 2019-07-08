@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card">
  <div class="card-header">
    Add Nota
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
      <form method="post" action="{{ route('nota.store') }}" id="isi">
          <div class="form-group">
              @csrf
              <label for="price">Vendor :</label>
              <select class="form-control" name='vendor' >
                @foreach ($vendors as $vendor)
                  <option class="dropdown-item" value="{{$vendor->id}}">{{$vendor->name}}</option>
                @endforeach
                </select>
          </div>
          <div class="form-group">
              <label for="quantity">Asal Pengiriman :</label>
              <input class="form-control" type="text"   name="asal"/>
          </div>
          <div class="form-group">
              <label for="quantity">Tujuan Pengiriman :</label>
              <input class="form-control" type="text"   name="tujuan"/>
          </div>
          <div class="form-group">
              <label for="quantity">Nomor Nota / NOP :</label>
              <input class="form-control" type="text"   name="NOP"/>
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
              </div>
              <div class="col-sm-3">
                <label for="quantity">Collies :</label>
              </div>
              <div class="col-sm-3">
                <label for="quantity">Kg :</label>
              </div>
              <div class="col-sm-3">
                <label for="quantity">Ongkos:</label>
              </div>
            </div>   
            <div class="row">
              <div class="col-sm-3">
                <input class="form-control" id="nopolId" type="text"   name="nopol[0]"/>
              </div>
              <div class="col-sm-3">
                <input class="form-control" id="colliesId" type="text"   name="collies[0]"/>
              </div>
              <div class="col-sm-3">
                <input class="form-control" id="kgId" type="text"   name="kg[0]"/>
              </div>
              <div class="col-sm-3">
                <input class="form-control" id="ongkosId" type="text"   name="ongkos[0]"/>
              </div>
            </div>
          </div>
          <button type="button" id="btnAddForm" onclick="CloneForm('isi')">Add another Project</button>
          <br>
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
    cloneCollies.name = "collies[" + count +"]"; 
    cloneKg.name = "kg[" + count +"]"; 
    cloneOngkos.name = "ongkos[" + count +"]"; 
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
    // document.getElementById('isi').appendChild(cloneNopol);
    // document.getElementById('isi').appendChild(cloneCollies);
    // document.getElementById('isi').appendChild(cloneKg);
    // document.getElementById('isi').appendChild(cloneOngkos);
    // document.getElementById('isi').appendChild(linebreak);
    // document.getElementById('data').appendChild(linebreak);
    count +=1;
  }
</script>
@endsection