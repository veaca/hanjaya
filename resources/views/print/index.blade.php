<!DOCTYPE html>
<html>
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


</head>

<!------ Include the above in your HEAD tag ---------->
<body>
<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order #{{$invoice->nomor}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$customer->name}}<br>
    					{{$customer->address}}<br>
    					{{$customer->phone}}
    				</address>
    			</div>
    			
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{$invoice->created_at->format('d m Y')}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
</div>	

    					<table class='table table-bordered'>
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
				<td>{{$project->name}}</td>
    			<td>Rp {{$project->tarif}}</td>
    			<td>{{$project->quantity}}</td>
    			<td>Rp {{$project->tarif * $project->quantity}}</td>
			</tr>
			@endforeach
            <tr>
                <td></td>
    			<td></td>
    			<td></td>
    			<td><strong>Jumlah</strong></td>
    			<td>Rp {{$invoice->jumlah}}</td>
    		</tr>
    		<tr>
                <td></td>
    			<td ></td>
    			<td ></td>
    			<td><strong>Pajak </strong>{{$invoice->jenis_pajak}}%</td>
    			<td >Rp {{$invoice->pajak}}</td>
    		</tr>
			<tr>
                <td></td>
    			<td ></td>
    			<td ></td>
    			<td ><strong>Total</strong></td>
    			<td >Rp {{$invoice->jumlah_total}}</td>
    		</tr>
		</tbody>
	</table>
 
</body>

</html>