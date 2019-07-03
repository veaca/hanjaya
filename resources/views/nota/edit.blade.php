@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
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

          <select name="vendor_id" >
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
          <input type="text" class="form-control" name="asal" value={{ $nota->asal }} />
        </div>
        <div class="form-group">
          <label for="quantity">Nota Tujuan:</label>
          <input type="text" class="form-control" name="tujuan" value={{ $nota->tujuan }} />
        </div>
        <div class="form-group">
          <label for="quantity">NOP:</label>
          <input type="text" class="form-control" name="NOP" value={{ $nota->NOP }} />
        </div>
        <div class="form-group">
            <label for="Jenis Tambahan"> Jenis Tambahan</label>
            <select name="jenis_tambahan" >
              @if ($nota->jenis_tambahan == "Penambahan")
                <option value="Penambahan" selected>Penambahan</option>
              @else
                <option value="Potongan" selected>Potongan</option>
              @endif
            </select>
            <label for="Jumlah Tambahan">Jumlah Tambahan</label>
            <input type="text" name="jumlah_tambahan" value= {{$nota->jumlah_tambahan}}>
          </div>
        <script>var count=0;</script>
        @foreach ($notaDetails as $notaDetail)
        <script>
          var div = document.createElement('div');
          div.class = "form-group";
          var inputHidden = document.createElement('input');
          inputHidden.type = "hidden";
          inputHidden.name = "id["+count+"]";
          inputHidden.value = "{{$notaDetail->id}}";
          var inputNopol = document.createElement('input');
          inputNopol.name = "nopol["+count+"]";
          inputNopol.type = "text";
          inputNopol.class = "form-control";
          inputNopol.value = "{{$notaDetail->nopol}}";
          var inputCollies = document.createElement('input');
          inputCollies.name = "collies["+count+"]";
          inputCollies.type = "text";
          inputCollies.class = "form-control";
          inputCollies.value = "{{$notaDetail->collies}}";
          var inputKg = document.createElement('input');
          inputKg.name = "kg["+count+"]";
          inputKg.type = "text";
          inputKg.class = "form-control";
          inputKg.value = "{{$notaDetail->kg}}";
          var inputOngkos = document.createElement('input');
          inputOngkos.name = "ongkos["+count+"]";
          inputOngkos.type = "text";
          inputOngkos.class = "form-control";
          inputOngkos.value = "{{$notaDetail->ongkos}}";
          linebreak = document.createElement("br");
          div.appendChild(inputHidden);
          div.appendChild(inputNopol);
          div.appendChild(inputCollies);
          div.appendChild(inputKg);
          div.appendChild(inputOngkos);
          document.getElementById("data").appendChild(div);
          document.getElementById('data').appendChild(linebreak);
          count++;
        </script>
        @endforeach
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection