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
<div>
    <table class='table table-bordered'>
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

@endsection