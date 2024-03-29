@extends('layout')
@section('page_title')
    {{ "Add Biaya" }}
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
      <form method="post" action="{{ route('biaya.store') }}">
      <label >Bulan :</label>        
      @csrf
              
              <div class="form-group">
                <div class="col-sm-3">
                  <select class="form-control" name="bulan" >
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">Nopember</option>
                    <option value="12">Desember</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <select class="form-control" name="tahun" >
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                    <option value="2031">2031</option>
                  </select>
                </div>
              </div>
          <br>
          <div class="form-group">
              <label for="price">Biaya Gaji :</label>
              <input type="text" class="form-control" name="gaji"/>
          </div>
          <div class="form-group">
              <label for="price">Biaya BPJS :</label>
              <input type="text" class="form-control" name="bpjs"/>
          </div>
          <div class="form-group">
              <label for="quantity">Biaya Bank :</label>
              <input type="text" class="form-control" name="bank"/>
          </div>
          <div class="form-group">
              <label for="quantity">Biaya Listrik :</label>
              <input type="text" class="form-control" name="listrik"/>
          </div>
          <div class="form-group">
              <label for="quantity">Biaya PDAM :</label>
              <input type="text" class="form-control" name="pdam"/>
          </div>
          <div class="form-group">
              <label for="quantity">Biaya ATK :</label>
              <input type="text" class="form-control" name="atk"/>
          </div>
           <div class="form-group">
              <label for="quantity">Biaya Lain :</label>
              <input type="text" class="form-control" name="biaya_lain"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection