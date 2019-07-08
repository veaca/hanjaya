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

<center>
<h4>NOTA PEMBAYARAN BIAYA TRUCKING</h4>
</center>

<div>
    <div class="column" style="text-align:left;">
        Tanggal: {{$nota->tanggal}}<br>
        Asal: {{$nota->asal}}<br>
        Tujuan: {{$nota->tujuan}}<br>
    </div>
    <div class="column" >
        Vendor: {{$vendor->name}}
        <br>
        <br>
        <br>
    </div>
    <div class="column" style="text-align:left;">
        NOP: {{$nota->NOP}}
        <br>
        <br>
        <br>
    </div>
</div>
<br>
<br>
<br>
<br>
<div>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th colspan="3">Surat Jalan</th>
                <th colspan="2">Jumlah Barang</th>
                <th rowspan="2">Ongkos</th>
                <th rowspan="2">Jumlah Ongkos</th>
            </tr>
            <tr>
                <th>No.</th>
                <th>Tgl.</th>
                <th>Nopol</th>
                <th>Collies</th>
                <th>Kg</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($notaDetails as $notaDetail)
            @php $j=1 @endphp
            <tr>
                <td>{{$i++}}</td>
                <td>{{$j++}}</td>
                <td>{{$notaDetail->date}}</td>
                <td>{{$notaDetail->nopol}}</td>
                <td>{{$notaDetail->collies}}</td>
                <td>{{$notaDetail->kg}}</td>
                <td>{{$notaDetail->ongkos}}</td>
                <td>{{$notaDetail->jumlah_ongkos}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="7">Jumlah</td>
                <td>{{$nota->jumlah_ongkos}}</td>
            </tr>
            <tr>
                <td colspan="6">Tambahan / Potongan</td>
                <td>{{$nota->jenis_tambahan}}</td>
                <td>{{$nota->jumlah_tambahan}}</td>
            </tr>
            <tr>
                <td colspan="6">Potongan PPh</td>
                <td>2.00%</td>
                <td>{{$nota->potongan_pph}}</td>
            </tr>
            <tr>
                <td colspan="6">Jumlah Dibayar</td>
                <td></td>
                <td>{{$nota->jumlah_dibayar}}</td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <div class="column">
        Diperiksa Oleh,
        <br>
        <br>
        <br>
    </div>
    <div class="column">
        Dibayar Oleh,
        <br>
        <br>
        <br>
    </div>
    <div class="column">
        Pembayaran Diterima,
        <br>
        <br>
        <br>
        MITRA SUKSES HANJAYA PT.
    </div>
</div>
    </body>
</html>