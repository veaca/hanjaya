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
<center>
<br>
<img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/images/logo.jpeg';?>" alt="logo" width="200px" height="100px">
<br>
<br>
		<h4><strong>Invoice</strong></h4><br> 		
	</center>
    <div>
        <table>
            <tbody>
                <tr>
                    <td style="text-align:left;">Nomor</td>
                    <td></td>
                    <td>:</td>
                    <td></td>
                    <td style="text-align:left;">{{$invoice->nomor}}</td>
                </tr>
                <tr>
                    <td style="text-align:left;">Tanggal</td>
                    <td></td>
                    <td>:</td>
                    <td></td>
                    <td style="text-align:left;" >{{$invoice->created_at->format('j F Y')}}</td>
                </tr>
                <tr>
                    <td style="text-align:left;">Kepada</td>
                    <td></td>
                    <td>:</td>
                    <td></td>
                    <td style="text-align:left;">{{$customer->name}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:left;">{{$customer->address}}</td>
                </tr>
                <tr>
                <td></td>
                <td></td>
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
            <thead class="bord">
                <tr class="bord">
                    <th class="bord">No</th>
                    <th class="bord">Item</th>
                    <th class="bord">Price</th>
                    <th class="bord">Quantity</th>
                    <th class="bord">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($projects as $project)
                <tr class="bord">
                    <td class="bord">{{ $i++ }}</td>
                    <td class="bord">{{$project->name}}. {{$project->info}}</td>
                    <td class="bord">Rp. {{$project->tarif}}</td>
                    <td class="bord">{{$project->quantity}}</td>
                    <td class="bord" align="center">Rp. {{$project->tarif * $project->quantity}}</td>
                </tr>
                @endforeach
                <tr class="bord">
                    <td class="bord" colspan="4" align="center"><strong>Jumlah</strong></td>
                    <td class="bord">Rp {{$invoice->jumlah}}</td>
                </tr>
                <tr class="bord">
                    <td class="bord" colspan="4" align="center"><strong>Pajak </strong>{{$invoice->jenis_pajak}}%</td>
                    <td class="bord" >Rp {{$invoice->pajak}}</td>
                </tr>
                <tr class="bord">
                    <td class="bord" colspan="4" align="center"><strong>Total</strong></td>
                    <td class="bord" >Rp {{$invoice->jumlah_total}}</td>
                </tr>
            </tbody>
        </table>
 
    </div>	
    <table class='table table-bordered bord' >
        <td class="bord" style="text-align:left;">
        Pembayaran melalui transfer ke rekening kami : <br>
        Bank : Mandiri cabang Sampit <br>
        Nama : PT. HANJAYA KARYA LININUSA <br>
        Acc. No : 159-00-0198847-5 <br>
        </td>
        <td class="bord" align="center">
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