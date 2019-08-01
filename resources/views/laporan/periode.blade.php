@extends('layout')
@section('page_title')
    {{ "Laporan" }}
@endsection
@section('content')
<form method="post" action="{{ URL::to('exportLaporan') }}">
    <div>
    @csrf
    <label for="periode">Pilih Periode Laporan:</label>
    <select name="awal" id="bulanAwal" onclick="set();">
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
    <select name="tahun_awal">
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
    <select name="akhir" id="bulanAkhir">
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
    <select name="tahun_akhir">
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