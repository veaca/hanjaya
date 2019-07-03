@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
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
              <select name='vendor' >
                @foreach ($vendors as $vendor)
                  <option class="dropdown-item" value="{{$vendor->id}}">{{$vendor->name}}</option>
                @endforeach
                </select>
          </div>
          <div class="form-group">
              <label for="quantity">Nota Asal :</label>
              <input type="text"   name="asal"/>
          </div>
          <div class="form-group">
              <label for="quantity">Nota Tujuan :</label>
              <input type="text"   name="tujuan"/>
          </div>
          <div class="form-group">
              <label for="quantity">Nota NOP :</label>
              <input type="text"   name="NOP"/>
          </div>
          <div class="form-group">
            <label for="Jenis Tambahan"> Jenis Tambahan</label>
            <select name="jenis_tambahan" >
              <option value="Penambahan">Penambahan</option>
              <option value="Potongan">Potongan</option>
            </select>
            <label for="Jumlah Tambahan">Jumlah Tambahan</label>
            <input type="text" name="jumlah_tambahan">
          </div>
          <label for="price">Surat Jalan :</label>
          <br>
          <label for="quantity">Nopol :</label>
          <label for="quantity">Collies :</label>
          <label for="quantity">Kg :</label>
          <label for="quantity">Ongkos:</label>
          <br>
              <input id="nopolId" type="text"   name="nopol[0]"/>
              <input id="colliesId" type="text"   name="collies[0]"/>
              <input id="kgId" type="text"   name="kg[0]"/>
              <input id="ongkosId" type="text"   name="ongkos[0]"/>
              <br>

          <button type="submit" class="btn btn-primary">Add</button>
      </form>
      <button type="button" id="btnAddForm" onclick="CloneForm('isi')">Add another Project</button>
       <br>
       
  </div>
</div>

<script>
 var count=1;
  function CloneForm(formName) {
   
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
    document.getElementById('isi').appendChild(cloneNopol);
    document.getElementById('isi').appendChild(cloneCollies);
    document.getElementById('isi').appendChild(cloneKg);
    document.getElementById('isi').appendChild(cloneOngkos);
    document.getElementById('isi').appendChild(linebreak);
    // document.getElementById('data').appendChild(linebreak);
    count +=1;
  }
</script>
@endsection