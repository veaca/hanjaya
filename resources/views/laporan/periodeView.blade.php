@extends('layout2')
@section('page_title')
    {{ "Laporan" }}
@endsection
@section('button')
    <a type="button" class="btn btn-info" href="{{URL('downloadLaporan/'.$awalBulan.'/'.$akhirBulan.'/'. $awalTahun.'/'.$akhirTahun)}}">Download</a>
@endsection
@section('content')
<script>
    var awal = <?php echo $awalBulan ?>;
    var akhir = <?php echo $akhirBulan ?>;
    var awaltahun = <?php echo $awalTahun ?>;
    var akhirtahun = <?php echo $akhirTahun ?>;
    // console.log(awalTahun);
    // console.log(akhirTahun);
    if (awal < 10)
    {
        awal = "0"+awal;
    }
    if (akhir < 10)
    {
        akhir = "0"+akhir;
    }
function selectElement()
{
    // console.log(awal);
    // console.log(akhir);
    var bulanAwal = document.getElementById('bulanAwal');
    var bulanAkhir = document.getElementById('bulanAkhir');
    var akhirTahun = document.getElementById('akhirTahun');
    var awalTahun = document.getElementById('awalTahun');
    bulanAwal.value = awal;
    bulanAkhir.value = akhir;
    awalTahun.value = awaltahun;
    akhirTahun.value = akhirtahun;
}

</script>
<style  onload="selectElement()">

    .table-bordered, .bord {
        text-align : center;
        border: black solid 1px !important;
    }
    /* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
  text-align:center;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>

<form method="post" action="{{ URL::to('exportLaporan') }}">
    <div>
    @csrf
    <label for="periode">Pilih Periode Laporan:</label>
    <select name="awal" id="bulanAwal" onclick="set();" >
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
    <select name="awal_tahun" id="awalTahun" >
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
    -
    <select name="akhir" id="bulanAkhir" >
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
    <select name="akhir_tahun" id="akhirTahun" >
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
    <button type="submit" class="btn btn-primary">View</button>
</form>
<div>
<center>
<br>
<img src="/images/logo.jpeg" alt="logo" width="200px" height="100px">
<br>
<br>
            <h4>Laporan Keuangan</h4>
        </center>
        <div>
            <table>
                <tr>
                    <td>Periode</td>
                    <td>:</td>
                    <td>{{$awalBulan}}/{{$awalTahun}} hingga {{$akhirBulan}}/{{$akhirTahun}}</td>
                </tr>
            </table> 
        </div>
        <br>
        <br>
        <div>
        <table class="table table-bordered bord">
            <thead class="bord">
                <tr class="bord">
                    <th class="bord">No.</th>
                    <th class="bord">Bulan</th>
                    <th class="bord">Tahun</th>
                    <th  class="bord">Piutang</th>
                    <th class="bord">Hutang</th>
                    <th class="bord">Pengeluaran (Biaya Operasional)</th>
                    <th class="bord">Hasil Akhir</th>
                </tr>
            </thead>
            <tbody class="bord">
                @php $i=1 @endphp
                @php $total=0 @endphp
                @foreach ($laporans as $laporan)
                @php
                 
                $total = $total+$laporan->laporan_total 
                @endphp
                <tr class="bord">
                    <td class="bord">{{$i++}}</td>
                    <td class="bord">{{$laporan->bulan}}</td>
                    <td class="bord">{{$laporan->tahun}}</td>
                    <td class="bord">Rp. {{number_format($laporan->laporan_invoice,2,",",".")}}</td>
                    <td class="bord">Rp. {{number_format($laporan->laporan_nota,2,",",".")}}</td>
                    <td class="bord">Rp. {{number_format($laporan->laporan_biaya_bulanan,2,",",".")}}</td>
                    <td class="bord">Rp. {{number_format($laporan->laporan_total,2,",",".")}}</td>
                </tr>
                @endforeach
                <tr class="bord">
                    <td class="bord" colspan="5">Jumlah Akhir</td>
                    <td class="bord">Rp. {{number_format($total,2,",",".")}}</td>
                </tr>
                
            </tbody>
        </table>
        </div>
</div>
<script>

function set(){
    var bulanAwal = document.getElementById('bulanAwal').value;
    var bulanAkhir = document.getElementById('bulanAkhir').getElementsByTagName("option");
    for (i=0 ; i<12 ;i++){
        bulanAkhir[i].disabled = false;
    }
    
    for (i = bulanAwal-2 ; i>=0 ; i--){
        bulanAkhir[i].disabled=true;
    }
}

</script>
@endsection