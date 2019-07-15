@extends('layout2')

@section('page_title')
    {{ "Invoice" }}
@endsection
@section('button')
    <a type="button" class="btn btn-info" href="{{URL::to('exportInvoice', $invoice->id)}}">Download</a>
@endsection
@section('content')

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
<img src="/images/logo.jpeg" alt="logo" width="100px" height="50px">
<br>
<br>
		<h4> <strong>Invoice</strong>  </h4><br> 		
	</center>
    <div>
        <table id="tabledata">
            <tbody>
                <tr>
                    <td style="text-align:left;">Nomor</td>
                    <td></td>
                    <td>:</td>
                    <td> </td>
                    <td style="text-align:left;">{{$invoice->nomor}}</td>
                </tr>
                <tr>
                    <td style="text-align:left;">Tanggal</td>
                    <td> </td>
                    <td>:</td>
                    <td> </td>
                    <td style="text-align:left;" >{{ \Carbon\Carbon::parse($invoice->created_at)->formatLocalized('%d %B %Y')}}</td>
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
                    <th class="bord">Totals</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($projects as $project)
                <tr class="bord">
                    <td class="bord">{{ $i++ }}</td>
                    <td class="bord">{{$project->name}}. {{$project->info}}</td>
                    <td class="bord">Rp. {{number_format($project->tarif,2,",",".")}}</td>
                    <td class="bord">{{number_format($project->quantity,0,".",".")}}</td>
                    <td class="bord" align="center">Rp. {{number_format($project->tarif * $project->quantity,2,",",".")}}</td>
                </tr>
                @endforeach
                <tr class="bord">
                    <td class="bord" colspan="4" align="center"><strong>Jumlah</strong></td>
                    <td class="bord">Rp. {{number_format($invoice->jumlah,2,",",".")}}</td>
                </tr>
                <tr class="bord">
                    <td class="bord" colspan="4" align="center"><strong>Pajak </strong>{{$invoice->jenis_pajak}}%</td>
                    <td class="bord" >Rp. {{number_format($invoice->pajak,2,",",".")}}</td>
                </tr>
                <tr class="bord">
                    <td class="bord" colspan="4" align="center"><strong>Total</strong></td>
                    <td class="bord" >Rp. {{number_format($invoice->jumlah_total,2,",",".")}}</td>
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
	
<script>
var table = $('#tabledata').dataTable( {
  columnDefs: [
    { width: 30%, targets: 1 }
  ]
} );
</script>
@endsection