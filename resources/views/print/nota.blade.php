@extends('layout')

@section('page_title')
    {{ "Nota" }}
@endsection
@section('button')
    <a type="button" class="btn btn-info" href="{{URL::to('exportNota', $nota->id)}}">Download</a>
@endsection
@section('content')
<style>
    td, th {
        text-align : center;
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
.col-kiri {
    float: left;
  width:25%;
  padding: 10px;
  text-align:center; 
}
.col-kanan {
    float: left;
  width:50%;
  padding: 10px;
  text-align:center; 
}
</style>

<center>
<br>
<img src="/images/logo.jpeg" alt="logo" width="100px" height="50px">
<br>
<br>
<h4> <strong>NOTA PEMBAYARAN BIAYA TRUCKING</strong> </h4>
</center>

<div class="row">
    <div class="column" style="text-align:left;">
        Tanggal: {{ \Carbon\Carbon::parse($nota->created_at)->formatLocalized('%d %B %Y')}}<br>
        Asal: {{$projects->asal}}<br>
        Tujuan: {{$projects->tujuan}}<br>
    </div>
    <div class="column" >
        Vendor: {{$vendor->name}}
        <br>
        <br>
        <br>
    </div>
    <div class="column" style="text-align:left;">
        NOP: {{$projects->nop}}
        <br>
        <br>
        <br>
    </div>
</div>
<br>
<br>
<div>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th colspan="2">Surat Jalan</th>
                <th rowspan="2">Jumlah Barang (Kg)</th>
                <th rowspan="2">Ongkos</th>
                <th rowspan="2">Jumlah Ongkos</th>
            </tr>
            <tr>
                <th>Tgl.</th>
                <th>Nopol</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($notaDetails as $notaDetail)
            <tr>
                <td>{{$i++}}</td>
                <td>{{ \Carbon\Carbon::parse($nota->tanggal)->formatLocalized('%d %B %Y')}}</td>
                <td>{{$notaDetail->nopol}}</td>
                <td>{{number_format($notaDetail->kg,0,".",".")}}</td>
                <td>Rp. {{number_format($projects->tarif_vendor,2,",",".")}}</td>
                <td>Rp. {{number_format($notaDetail->ongkos,2,",",".")}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">Tambahan / Potongan</td>
                <td>{{$nota->jenis_tambahan}}</td>
                <td>Rp. {{number_format($nota->jumlah_tambahan,2,",",".")}}</td>
            </tr>
            <tr>
                <td colspan="4">PPh</td>
                <td>{{$vendor->pph}}%</td>
                <td>Rp. {{number_format($nota->jumlah_pph,2,",",".")}}</td>
            </tr>
            <tr>
                <td colspan="4">Jumlah Dibayar</td>
                <td></td>
                <td>Rp. {{number_format($nota->ongkos_nota,2,",",".")}}</td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <div class="col-kiri" style="text-align:center;">
        Diperiksa Oleh,
        <br>
        <br>
        <br>
    </div>
    <div class="col-kiri" style="text-align:center;">
        Dibayar Oleh,
        <br>
        <br>
        <br>
    </div>
    <div class="col-kanan" style="text-align:center;">
        Pembayaran Diterima,
        <br>
        <br>
        <br>
        <br>
        <br>
        MITRA SUKSES HANJAYA PT.
    </div>
</div>

@endsection