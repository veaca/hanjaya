<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        td, th {
            text-align : center;
        }
    </style>
    </head>
    <body>
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
</style>

<div align="center">
<img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/images/logo.jpeg';?>" alt="logo" width="150px" height="75px">
</div>
<br>
<div align="center">
<h4><strong>NOTA PEMBAYARAN BIAYA TRUCKING</strong></h4> 	
</div>
@php setlocale (LC_TIME, 'INDONESIA') @endphp
<div>
    <div class="column" style="text-align:left;">
        Tanggal:{{ \Carbon\Carbon::parse($nota->created_at)->formatLocalized('%d %B %Y')}}<br>
        Asal: {{$nota->asal}}<br>
        Tujuan: {{$nota->tujuan}} <br>
        
    </div>
    <div class="column" >
        Vendor: {{$vendor->name}}
        <br>
        <br>
        
    </div>
    <div class="column" style="text-align:center;">
        NOP: {{$nota->NOP}}
        <br>
        <br>
        
    </div>
</div>
<br>
<br>
<br>
<br>
<div>
    <table class="table-bordered" cellspacing="0" cellpadding="0" width="100%">
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th colspan="2">Surat Jalan</th>
                <th colspan="2">Jumlah Barang</th>
                <th rowspan="2">Ongkos</th>
                <th rowspan="2">Jumlah Ongkos</th>
            </tr>
            <tr>
                <th>Tgl.</th>
                <th>Nopol</th>
                <th>Collies</th>
                <th>Kg</th>
            </tr>
        </thead>
        <tbody>
           @php $i=1 @endphp
            @php $totCollies=0 @endphp
            @php $totKg=0 @endphp
            @foreach ($notaDetails as $notaDetail)
            @php $j=1  @endphp
            @php $totCollies = $totCollies + $notaDetail->collies @endphp
            @php $totKg = $totKg + $notaDetail->kg @endphp
            <tr>
                <td>{{$i++}}</td>
                <td>{{ \Carbon\Carbon::parse($notaDetail->created_at)->formatLocalized('%d %B %Y')}}</td>
                <td>{{$notaDetail->nopol}}</td>
                <td>{{number_format($notaDetail->collies,0,".",".")}}</td>
                <td>{{number_format($notaDetail->kg,0,".",".")}}</td>
                <td>Rp. {{number_format($notaDetail->ongkos,2,",",".")}}</td>
                <td>Rp. {{number_format($notaDetail->jumlah_ongkos,2,",",".")}}</td>
            </tr>
            @endforeach
            <tr>
                 <td colspan="3">Jumlah</td>
                <td>{{number_format($totCollies,0,".",".")}}</td>
                <td>{{number_format($totKg,0,".",".")}}</td>
                <td>-</td>
                <td>Rp. {{number_format($nota->jumlah_ongkos,2,",",".")}}</td>
            </tr>
            <tr>
                <td colspan="5">Tambahan / Potongan</td>
                <td>{{$nota->jenis_tambahan}}</td>
                <td>Rp. {{number_format($nota->jumlah_tambahan,2,",",".")}}</td>
            </tr>
            <tr>
                <td colspan="5">Potongan PPh</td>
                <td>2%</td>
                <td>Rp. {{number_format($nota->potongan_pph,2,",",".")}}</td>
            </tr>
            <tr>
                <td colspan="5">Jumlah Dibayar</td>
                <td></td>
                <td>Rp. {{number_format($nota->jumlah_dibayar,2,",",".")}}</td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <div class="column" style="text-align:left;">
        Diperiksa Oleh,
        <br>
        <br>
        <br>
    </div>
    <div class="column" style="text-align:left;">
        Dibayar Oleh,
        <br>
        <br>
        <br>
    </div>
    <div class="column" style="text-align:left;">
        Pembayaran Diterima,
        <br>
        <br>
        <br>
        <br>
        <br>
        MITRA SUKSES HANJAYA PT.
    </div>
</div>
    </body>
</html>