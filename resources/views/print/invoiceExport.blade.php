<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    table {
        padding:0px 0px 0px 0px;
    }
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
        padding:0px 0px 0px 0px;
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
<div align="center">
<h4><strong>INVOICE</strong></h4> 	
</div>
			

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
    <div>
        <table cellspacing="0" cellpadding="0" width="100%">
            <thead>
                <tr class="bord">
                    <th style="width:7%;" class="bord">No</th>
                    <th style="width:36%;" class="bord">Item</th>
                    <th style="width:25%;" class="bord">Price</th>
                    <th style="width:12%;" class="bord">Quantity</th>
                    <th style="width:25%;" class="bord">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($projects as $project)
                <tr class="bord">
                    <td class="bord">{{ $i++ }}</td>
                    <td class="bord" style="word-break:break-all; word-wrap:break-word;">{{$project->name}}. {{$project->info}}</td>
                    <td class="bord">Rp. {{$project->tarif}},00</td>
                    <td class="bord">{{$project->quantity}}</td>
                    <td class="bord" align="center">Rp. {{$project->tarif * $project->quantity}},00</td>
                </tr>
                @endforeach
                <tr class="bord">
                    <td class="bord" colspan="4" align="center"><strong>Jumlah</strong></td>
                    <td class="bord">Rp. {{$invoice->jumlah}},00</td>
                </tr>
                <tr class="bord">
                    <td class="bord" colspan="4" align="center"><strong>Pajak </strong>{{$invoice->jenis_pajak}}%</td>
                    <td class="bord" >Rp. {{$invoice->pajak}},00</td>
                </tr>
                <tr class="bord">
                    <td class="bord" colspan="4" align="center"><strong>Total</strong></td>
                    <td class="bord" >Rp. {{$invoice->jumlah_total}},00</td>
                </tr>
            </tbody>
        </table>
 
    </div>	
    <br>
    <div>
    
    <table class="bord" width="100%" >
        <td style="text-align:left;">
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
	
    </div>
    </body>
</html>