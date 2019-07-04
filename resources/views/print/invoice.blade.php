<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        td, th {
            text-align : center;
        }
    </style>
</head>
<body>
	<center>
		<h4>Invoice</h4><br> 		
	</center>
    <br>

    <div>
        <table>
            <tbody>
                <tr>
                    <td style="text-align:left;">Nomor</td>
                    <td>:</td>
                    <td style="text-align:left;">{{$invoice->nomor}}</td>
                </tr>
                <tr>
                    <td style="text-align:left;">Tanggal</td>
                    <td>:</td>
                    <td style="text-align:left;" >{{$invoice->created_at->format('d m Y')}}</td>
                </tr>
                <tr>
                    <td style="text-align:left;">Kepada</td>
                    <td>:</td>
                    <td style="text-align:left;">{{$customer->name}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align:left;">{{$customer->address}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align:left;">{{$customer->phone}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <div>
        <table class='table table-bordered' style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Totals</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($projects as $project)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$project->name}}. {{$project->info}}</td>
                    <td>Rp {{$project->tarif}}</td>
                    <td>{{$project->quantity}}</td>
                    <td align="center">Rp {{$project->tarif * $project->quantity}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" align="center"><strong>Jumlah</strong></td>
                    <td>Rp {{$invoice->jumlah}}</td>
                </tr>
                <tr>
                    <td colspan="4" align="center"><strong>Pajak </strong>{{$invoice->jenis_pajak}}%</td>
                    <td >Rp {{$invoice->pajak}}</td>
                </tr>
                <tr>
                    <td colspan="4" align="center"><strong>Total</strong></td>
                    <td >Rp {{$invoice->jumlah_total}}</td>
                </tr>
            </tbody>
        </table>
 
    </div>	
    <table class='table table-bordered' >
        <td style="text-align:left;">
        Pembayaran melalui transfer ke rekening kami : <br>
        Bank : Mandiri cabang Sampit <br>
        Nama : PT. HANJAYA KARYA LININUSA <br>
        Acc. No : 159-00-0198847-5 <br>
        </td>
        <td align="center">
        PT. Hanjaya Karya Lininusa
        <br>
        <br>
        <br>
        <br>
        Marayanto D Pohan 
        </td>
    </table>		
	
</body>
</html>