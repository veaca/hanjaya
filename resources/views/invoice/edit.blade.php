@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit invoice
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
      <form method="post" action="{{ route('invoice.update', $invoice->id) }}">
        @method('PATCH')
        @csrf
          <div class="form-group">
              <label for="price">Invoice Nomor :</label>
              <input type="text" class="form-control" name="nomor"/>
          </div>
          <div class="form-group">
              <label for="price">Invoice Customer :</label>
              <input type="text" class="form-control" name="customer_id"/>
          </div>
          <!-- <div class="form-group">
              <label for="quantity">Invoice Vendor :</label>
              <input type="text" class="form-control" name="vendor_id"/>
          </div> -->
          <div class="form-group">
              <label for="quantity">Invoice Project :</label>
              <input type="text" class="form-control" name="project_id"/>
              <input type="text" class="form-control" placeholder="Kuantitas Proyek" name="quantity"/>
          </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection