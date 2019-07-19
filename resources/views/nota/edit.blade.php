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
                    <select class="form-control" id="projectId" name='project_id'>
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
              <label for="price">Vendor :</label>
              <select class="form-control" name='vendor_id' >
                @foreach ($vendors as $vendor)
                @if ($vendor->id == $nota->vendor_id)
                  <option class="dropdown-item" value="{{$vendor->id}}" selected>{{$vendor->name}}</option>
                @else 
                  <option class="dropdown-item" value="{{$vendor->id}}">{{$vendor->name}}</option>
                @endif
                @endforeach
                </select>
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
                <input type="text" class="form-control" name="nopol" value="{{$nota->nopol}}"> 
              </div>
              <div class="col-sm-3">
                <label for="quantity">Kg :</label>
                <input type="text" class="form-control" name="kg" value="{{$nota->kg}}">
              </div>
            </div>   
          </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection