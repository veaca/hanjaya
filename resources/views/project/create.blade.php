@extends('layout')
@section('page_title')
    {{ "Add Project" }}
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
      <form method="post" action="{{ route('project.store') }}">
          <div class="form-group">
              @csrf
            <label for="name">NOP :</label>
              <input type="text" class="form-control" name="nop"/>
          </div>
          <div class="form-group">
              <label for="price">Pilih Customer :</label>
              <select name="customer_id" class="form-control" onclick=update() id="customer_id">
                @foreach ($customers as $customer)
                <option value="{{$customer->id}}">{{$customer->name}}</option>
                @endforeach 
              </select>
          </div>
          <div class="form-group">
              <label for="price">Alamat :</label>
              <input type="text" class="form-control" id="address" disabled value="{{$customers[0]->address}}" />
          </div>
          <div class="form-group">
              <label for="price">SPK / DO :</label>
              <input type="text" class="form-control" name="spk"/>
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
            <label for="quantity">Tarif Project :</label>
            <input type="text" class="form-control" name="tarif">
          </div>
          <div class="form-group">
            <label for="quantity">Kuantitas :</label>
            <input type="text" class="form-control" name="qty">
          </div>
          <div class="form-group">
            <label for="quantity">Tarif Vendor :</label>
            <input type="text" class="form-control" name="tarif_vendor">
          </div>
          <div class="form-group">
            <label for="biaya lain">Biaya Lain :</label>
            <input type="text" class="form-control" name="biaya_lain">
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
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