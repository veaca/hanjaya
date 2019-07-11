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

<div>
    <div class="column" style="text-align:left;">
        Tanggal: {{$nota->created_at->format('n/d/Y')}}<br>
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
                <td>{{$notaDetail->created_at->format('n/d/Y')}}</td>
                <td>{{$notaDetail->nopol}}</td>
                <td>{{$notaDetail->collies}}</td>
                <td>{{$notaDetail->kg}}</td>
                <td>Rp. {{$notaDetail->ongkos}},00</td>
                <td>Rp. {{$notaDetail->jumlah_ongkos}},00</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3">Jumlah</td>
                <td>{{$totCollies}}</td>
                <td>{{$totKg}}</td>
                <td>-</td>
                <td>Rp. {{$nota->jumlah_ongkos}},00</td>
            </tr>
            <tr>
                <td colspan="5">Tambahan / Potongan</td>
                <td>{{$nota->jenis_tambahan}}</td>
                <td>Rp. {{$nota->jumlah_tambahan}},00</td>
            </tr>
            <tr>
                <td colspan="5">Potongan PPh</td>
                <td>2.00%</td>
                <td>Rp. {{$nota->potongan_pph}},00</td>
            </tr>
            <tr>
                <td colspan="5">Jumlah Dibayar</td>
                <td></td>
                <td>Rp. {{$nota->jumlah_dibayar}},00</td>
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