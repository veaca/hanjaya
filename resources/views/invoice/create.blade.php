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
        <div class="form-group">
              @csrf
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
            <div>
            <div class="form-group">
            <label for="nama">Customer : </label>
              <div class="row">
              
                <div class="col-sm-4">
                  <input class="form-control" type="text" id="customer_name" value="{{$projects[0]->name}}" disabled>
                </div>
                <div class="col-sm-4">
                  <input class="form-control" type="text" id="address" value="{{$projects[0]->address}}" disabled>
                </div>
              </div>
              <label for="tarif">Tarif : </label>
              <div class="row">
              
                <div class="col-sm-4">
                  <input class="form-control" value="{{$projects[0]->tarif}}" type="text" id="tarif" disabled>
                </div>
              </div>
              <label for="qty">Kuantitas : </label>
              <div class="row">
              
                <div class="col-sm-4">

                  <input class="form-control" value="{{$projects[0]->qty}}" type="text" id="qty" disabled>
                </div>
              </div>
              <label for="ppn">PPn</label>
              <div class="row">
              
                <div class="col-sm-4">
                  <input class="form-control" type="text" id="ppn" value="{{$projects[0]->ppn}}" disabled>
                </div>
              </div>
            </div>
              <label for="info">Info :</label>
              <input type="text" class="form-control" name="info">
            </div>
            <br>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
       
      
  </div>
</div>

<script>
var nama = document.getElementById('customer_name');
var tarif = document.getElementById('tarif');
var qty = document.getElementById('qty');
var ppn = document.getElementById('ppn');
var address = document.getElementById('address');
function update()
{
  var idx = document.getElementById('projectId').selectedIndex;
  // console.log(idx);
  var project = <?php echo $projects ?>;
  nama.value = project[idx].name ;
  address.value = project[idx].address;
  tarif.value = project[idx].tarif;
  qty.value = project[idx].qty;
  ppn.value = project[idx].ppn + "%";
}
</script>
@endsection