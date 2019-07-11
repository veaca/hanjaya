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
        <center>
        <br>
<img src="/images/logo.jpeg" alt="logo" width="200px" height="100px">
<br>
<br>
            <h4> <strong>Laporan Keuangan</strong> </h4>
        </center>
        <div>
            <table>
                <tr>
                    <td>Periode</td>
                    <td>:</td>
                    <td>{{$awalBulan}}/{{$tahun}} hingga {{$akhirBulan}}/{{$tahun}}</td>
                </tr>
            </table> 
        </div>
        <br>
        <br>
        <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Bulan</th>
                    <th>Pemasukan (Invoice)</th>
                    <th>Pengeluaran (Nota Pembayaran)</th>
                    <th>Pengeluaran (Biaya Operasional)</th>
                    <th>Hasil Akhir</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($laporans as $laporan)
                @php
                $total =0; 
                $total = $total+$laporan->laporan_total 
                @endphp
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$laporan->bulan}}</td>
                    <td>{{$laporan->laporan_invoice}}</td>
                    <td>{{$laporan->laporan_nota}}</td>
                    <td>{{$laporan->laporan_biaya_bulanan}}</td>
                    <td>{{$laporan->laporan_total}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5">Jumlah Akhir</td>
                    <td>{{$total}}</td>
                </tr>
                
            </tbody>
        </table>
        </div>
    </body>
</html>