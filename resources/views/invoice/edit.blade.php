@extends('layout')
@section('page_title')
    {{ "Edit Invoice" }}
@endsection
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<script>
 var count=0;
</script>
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
      <form  method="post" action="{{ route('invoice.update', $invoice->id) }}">
        @method('PATCH')
        @csrf
        <label for="quantity">Invoice Projects :</label><br>
              <div class="form-group" name="project_info" id="isi">
                <div class="row">
                  <div class="col-sm-4">
                    <select class="form-control" id="projectId" name='project_id' onclick=update()>
                      @foreach ($projects as $project)
                        @if ($project->id == $invoice->project_id)
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
            <label for="nama">Customer : </label>
              <div class="row">
              
                <div class="col-sm-4">
                  <input class="form-control" type="text" id="customer_name" value="{{$invoice->name}}" disabled>
                </div>
                <div class="col-sm-4">
                  <input class="form-control" type="text" id="address" value="{{$invoice->address}}" disabled>
                </div>
              </div>
              <label for="tarif">Tarif : </label>
              <div class="row">
              
                <div class="col-sm-4">
                  <input class="form-control" type="text" id="tarif" value="{{$invoice->tarif}}" disabled>
                </div>
              </div>
              <label for="qty">Kuantitas : </label>
              <div class="row">
              
                <div class="col-sm-4">
                  <input class="form-control" type="text" id="qty" value="{{$invoice->qty}}" disabled>
                </div>
              </div>
              <label for="ppn">PPn</label>
              <div class="row">
              
                <div class="col-sm-4">
                  <input class="form-control" type="text" id="ppn" value="{{$invoice->ppn}}" disabled>
                </div>
              </div>
            </div>
            <div>
              <label for="info">Info :</label>
              <input type="text" class="form-control" name="info" value="{{$invoice->info}}">
            </div>
        <button type="submit" class="btn btn-primary">Update</button>
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
  ppn.value = project[idx].ppn +"%";
}
</script>
@endsection