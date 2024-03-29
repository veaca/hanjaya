@extends('layout')
@section('page_title')
    {{ "Edit Project" }}
@endsection
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card">
  <div class="card-body">
  @if ($message = Session::get('error'))

<div class="alert alert-danger alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

        <strong>{{ $message }}</strong>

</div>

@endif
      <form method="post" action="{{ route('project.update', $project->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">NOP :</label>
              <input type="text" class="form-control" name="nop" value="{{$project->nop}}" />
          </div>
          <div class="form-group">
              <label for="price">Pilih Customer :</label>
              <select name="customer_id" class="form-control" onclick=update() id="customer_id">
                @foreach ($customers as $customer)
                @if ($customer->id == $project->customer_id)
                <option value="{{$customer->id}}" selected>{{$customer->name}}</option>
                @else 
                <option value="{{$customer->id}}" >{{$customer->name}}</option>
                @endif
                @endforeach 
              </select>
          </div>
          
          <div class="form-group">
              <label for="price">Alamat :</label>
              <input type="text" class="form-control" id="address" value="{{$project->address}}" disabled/>
          </div>
          <div class="form-group">
              <label for="price">SPK / DO :</label>
              <input type="text" class="form-control" name="spk" value="{{$project->spk}}"/>
          </div>
          <div class="form-group">
              <label for="quantity">Asal Pengiriman :</label>
              <input class="form-control" type="text"   name="asal" value="{{$project->asal}}"/>
          </div>
          <div class="form-group">
              <label for="quantity">Tujuan Pengiriman :</label>
              <input class="form-control" type="text"   name="tujuan" value="{{$project->tujuan}}"/>
          </div>     
          <div class="form-group">
            <label for="quantity">Tarif Project :</label>
            <input type="text" class="form-control" name="tarif" value="{{$project->tarif}}">
          </div>
          <div class="form-group">
            <label for="quantity">Kuantitas :</label>
            <input type="text" class="form-control" name="qty" value="{{$project->qty}}">
          </div>
          <div class="form-group">
            <label for="quantity">Tarif Vendor :</label>
            <input type="text" class="form-control" name="tarif_vendor" value="{{$project->tarif_vendor}}">
          </div>
          <div class="form-group">
            <label for="quantity">Biaya Lain :</label>
            <input type="text" class="form-control" name="biaya_lain" value="{{$project->biaya_lain}}">
          </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>


<script>
var address = document.getElementById('address');
function update()
{
  var idx = document.getElementById('customer_id').selectedIndex;
  var customer = <?php echo $customers ?>;
  address.value = customer[idx].address;
}
</script>
@endsection