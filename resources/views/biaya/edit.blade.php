@extends('layout')
@section('page_title')
    {{ "Edit Biaya" }}
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
      <form method="post" action="{{ route('biaya.update', $biaya->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
        <label >Bulan :</label>    
          <div class="row">
          
            <div class="col-sm-3">
                  <select class="form-control" name="bulan" id="select_bulan">
                    <option id="bulan1" value="01">Januari</option>
                    <option id="bulan2" value="02">Februari</option>
                    <option id="bulan3" value="03">Maret</option>
                    <option id="bulan4" value="04">April</option>
                    <option id="bulan5" value="05">Mei</option>
                    <option id="bulan6" value="06">Juni</option>
                    <option id="bulan7" value="07">Juli</option>
                    <option id="bulan8" value="08">Agustus</option>
                    <option id="bulan9" value="09">September</option>
                    <option id="bulan10" value="10">Oktober</option>
                    <option id="bulan11" value="11">Nopember</option>
                    <option id="bulan12" value="12">Desember</option>
                    @if ($biaya->bulan == '01')
                    <script>document.getElementById('bulan1').selected = 'selected'</script>
                    @elseif ($biaya->bulan == '02')
                    <script>document.getElementById('bulan2').selected = 'selected'</script>
                    @elseif ($biaya->bulan == '03')
                    <script>document.getElementById('bulan3').selected = 'selected'</script>
                    @elseif ($biaya->bulan == '04')
                    <script>document.getElementById('bulan4').selected = 'selected'</script>
                    @elseif ($biaya->bulan == '05')
                    <script>document.getElementById('bulan5').selected = 'selected'</script>
                    @elseif ($biaya->bulan == '06')
                    <script>document.getElementById('bulan6').selected = 'selected'</script>
                    @elseif ($biaya->bulan == '07')
                    <script>document.getElementById('bulan7').selected = 'selected'</script>
                    @elseif ($biaya->bulan == '08')
                    <script>document.getElementById('bulan8').selected = 'selected'</script>
                    @elseif ($biaya->bulan == '09')
                    <script>document.getElementById('bulan9').selected = 'selected'</script>
                    @elseif ($biaya->bulan == '10')
                    <script>document.getElementById('bulan10').selected = 'selected'</script>
                    @elseif ($biaya->bulan == '11')
                    <script>document.getElementById('bulan11').selected = 'selected'</script>
                    @elseif ($biaya->bulan == '12')
                    <script>document.getElementById('bulan12').selected = 'selected'</script>
                    @endif
                  </select>
                </div>
                <div class="col-sm-3">
                  <select class="form-control" name="tahun" id="select_tahun">
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
                    @if ($biaya->tahun == '2019')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2019;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2020')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2020;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2021')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2021;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2022')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2022;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2023')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2023;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2024')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2024;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2025')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2025;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2026')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2026;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2027')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2027;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2028')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2028;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2029')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2029;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2030')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2030;
                    select.selected = "selected";
                    </script>
                    @elseif ($biaya->tahun == '2031')
                    <script>
                    var select = document.getElementById('select_tahun').value = 2031;
                    select.selected = "selected";
                    </script>
                    @endif
                  </select>
                </div>
          </div>        
        </div>
        <div class="form-group">
          <label for="price">Biaya Gaji :</label>
          <input type="text" class="form-control" name="gaji" value="{{ $biaya->gaji }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Biaya BPJS:</label>
          <input type="text" class="form-control" name="bpjs" value="{{ $biaya->bpjs }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Biaya Bank:</label>
          <input type="text" class="form-control" name="bank" value="{{ $biaya->bank }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Biaya Listrik:</label>
          <input type="text" class="form-control" name="listrik" value="{{ $biaya->listrik }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Biaya PDAM:</label>
          <input type="text" class="form-control" name="pdam" value="{{ $biaya->pdam }}" />
        </div>
        <div class="form-group">
          <label for="quantity">Biaya Lain:</label>
          <input type="text" class="form-control" name="biaya_lain" value="{{ $biaya->biaya_lain }}" />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection