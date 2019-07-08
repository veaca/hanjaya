@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card">
  <div class="card-header">
    Edit nota
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
      <form method="post" action="{{ route('nota.update', $nota->id) }}" id="data">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Vendor:</label>
          <select class="form-control" name="vendor_id" >
            @foreach ($vendors as $vendor)
              @if ($nota->vendor_id == $vendor->id)
                <option value="{{$vendor->id}}" selected>{{$vendor->name}}</option>
              @else
                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
              @endif
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="price">Nota Asal :</label>
          <input type="text" class="form-control" name="asal" value="{{ $nota->asal }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Nota Tujuan:</label>
          <input type="text" class="form-control" name="tujuan" value="{{ $nota->tujuan }}" />
        </div>
        <div class="form-group">
          <label for="quantity">NOP:</label>
          <input type="text" class="form-control" name="NOP" value="{{ $nota->NOP }}" />
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-3">
              <label for="Jenis Tambahan"> Jenis Tambahan</label>
              <select class="form-control" name="jenis_tambahan" >
                @if ($nota->jenis_tambahan == "Penambahan")
                  <option value="Penambahan" selected>Penambahan</option>
                @else
                  <option value="Potongan" selected>Potongan</option>
                @endif
              </select>
            </div>
            <div class="col-sm-3">
              <label for="Jumlah Tambahan">Jumlah Tambahan</label>
              <input class="form-control" type="text" name="jumlah_tambahan" value= "{{$nota->jumlah_tambahan}}">
            </div>
          </div>
        </div>
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
             <script>var count=0;</script>
        @foreach ($notaDetails as $notaDetail)
        <script>
          var rowLabel = document.createElement('div');
          rowLabel.className = "row";
          var labelNopolSm = document.createElement('div');
          labelNopolSm.className = "col-sm-3";
          var labelColliesSm = document.createElement('div');
          labelColliesSm.className = "col-sm-3";
          var labelKgSm = document.createElement('div');
          labelKgSm.className = "col-sm-3";
          var labelOngkosSm = document.createElement('div');
          labelOngkosSm.className = "col-sm-3";
          var labelNopol = document.createElement('label');
          var nopolLabel = document.createTextNode('Nopol :');
          labelNopol.appendChild(nopolLabel);
          var labelCollies = document.createElement('label');
          var colliesLabel  = document.createTextNode('Collies :');
          labelCollies.appendChild(colliesLabel);
          var labelKg = document.createElement('label');
          var kgLabel  = document.createTextNode('Kg :');
          labelKg.appendChild(kgLabel);
          var labelOngkos = document.createElement('label');
          var ongkosLabel  = document.createTextNode('Ongkos :');
          labelOngkos.appendChild(ongkosLabel);

          // labelNopolSm.appendChild(labelNopol);
          // labelColliesSm.appendChild(labelCollies);
          // labelKgSm.appendChild(labelKg);
          // labelOngkosSm.appendChild(labelOngkos);
          // rowLabel.appendChild(labelNopolSm);
          // rowLabel.appendChild(labelCollieSm);
          // rowLabel.appendChild(labelKgSm);
          // rowLabel.appendChild(labelOngkosSm);

          var div = document.createElement('div');
          div.className = "form-group";
          var inputHidden = document.createElement('input');
          inputHidden.type = "hidden";
          inputHidden.name = "id["+count+"]";
          inputHidden.value = "{{$notaDetail->id}}";

          var rowInput = document.createElement('div');
          rowInput.className = "row";
          var inputNopolSm = document.createElement('div');
          inputNopolSm.className = "col-sm-3";
          var inputColliesSm = document.createElement('div');
          inputColliesSm.className = "col-sm-3";
          var inputKgSm = document.createElement('div');
          inputKgSm.className = "col-sm-3";
          var inputOngkosSm = document.createElement('div');
          inputOngkosSm.className = "col-sm-3";

          var inputNopol = document.createElement('input');
          inputNopol.name = "nopol["+count+"]";
          inputNopol.type = "text";
          inputNopol.className = "form-control";
          inputNopol.value = "{{$notaDetail->nopol}}";
          var inputCollies = document.createElement('input');
          inputCollies.name = "collies["+count+"]";
          inputCollies.type = "text";
          inputCollies.className = "form-control";
          inputCollies.value = "{{$notaDetail->collies}}";
          var inputKg = document.createElement('input');
          inputKg.name = "kg["+count+"]";
          inputKg.type = "text";
          inputKg.className = "form-control";
          inputKg.value = "{{$notaDetail->kg}}";
          var inputOngkos = document.createElement('input');
          inputOngkos.name = "ongkos["+count+"]";
          inputOngkos.type = "text";
          inputOngkos.className = "form-control";
          inputOngkos.value = "{{$notaDetail->ongkos}}";
          linebreak = document.createElement("br");

          inputNopolSm.appendChild(inputNopol);
          inputColliesSm.appendChild(inputCollies);
          inputKgSm.appendChild(inputKg);
          inputOngkosSm.appendChild(inputOngkos);
          rowInput.appendChild(inputNopolSm);
          rowInput.appendChild(inputColliesSm);
          rowInput.appendChild(inputKgSm);
          rowInput.appendChild(inputOngkosSm);

          // div.appendChild(rowLabel);
          // div.appendChild(rowInput);

          // div.appendChild(inputHidden);
          // div.appendChild(inputNopol);
          // div.appendChild(inputCollies);
          // div.appendChild(inputKg);
          // div.appendChild(inputOngkos);
          document.getElementById("rowIni").appendChild(rowInput);
          // document.getElementById('data').appendChild(linebreak);
          count++;
        </script>
       
        @endforeach
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection