@extends('layout')
@section('page_title')
    {{ "Invoice" }}
@endsection
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
<a href="{{route('invoice.create')}}" type="button" class="btn btn-success">Add Invoice</a>
  <table id="tabledata" class="table table-bordered">
    <thead>
        <tr>
          <th>ID</th>
          <th>Tanggal</th>
          <th>Nomor</th>
          <th>Customer</th>
          <th>Jumlah</th>
          <th>Jumlah Total</th>
          <th>Projects</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php $no=1 @endphp
        @php $i=[] @endphp
        @php $j=1 @endphp
        @foreach($invoices as $invoice)
        <tr>
        @php $i[$j++] = $invoice->id @endphp
            <td name="invoice_id" value="{{$invoice->id}}">{{$no++}}</td>
            <td>{{$invoice->tanggal}}</td>
            <td>{{$invoice->nomor}}</td>
            <td>{{$invoice->customer_name}}</td>
            <td>{{$invoice->jumlah}}</td>
            <td>{{$invoice->jumlah_total}}</td>
            <td></td>
            <td> 
            <div class="btn-group-vertical"></div>  
            <a href="{{ route('invoice.edit',$invoice->id)}}" class="btn btn-primary">Edit</a>
             <form action="{{ route('invoice.destroy', $invoice->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
            <!-- <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Project List</button></td>
            <td><a href="{{ route('printinvoice.show', $invoice->id)}}" type="button" class="btn btn-warning">View</a></td>
            <td><a href="{{ URL::to('exportInvoice', $invoice->id)}}" type="button" class="btn btn-info">Download</a></td>
            <td><a href="{{ route('invoice.edit',$invoice->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('invoice.destroy', $invoice->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td> -->
        </tr>
        @endforeach
    </tbody>
  </table>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Projects</h4>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <td>Nama</td>
                <td>Info</td>
                <td>Tarif</td>
                <td>Kuantitas</td>
              </tr>
            </thead>
            <tbody>
            <script>
              function modalData(count)
              {
                var invoiceId =  document.getElementsByName("invoice_id")[0].getAttribute("value");
                count+=1;
                return invoiceId;
              }
            </script>
            @php $k=1 @endphp
            @foreach($projects as $project)
              <tr>
                <td>{{$project->project_name}}</td>
                <td>{{$project->project_info}}</td>
                <td>{{$project->project_tarif}}</td>
                <td>{{$project->quantity}}</td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


 
<div>


<script>
  var count=1;
  function createModal()
  {
    var modal = document.createElement('div');
    modal.id = "myModal" + count;
    modal.class = "modal fade";
    modal.role = "dialog";

    var modalDialog = document.createElement('div');
    modalDialog.class = "modal-dialog";

    var modalContent = document.createElement('div');
    modalContent.class = "modal-content";

    var modalHeader = document.createElement('div');
    modalHeader.class = "modal-header";

    var buttonClose = document.createElement('button');
    buttonClose.type = "button";
    buttonClose.class = "close";
    buttonClose.data-dismiss = "modal";

    var modalTitle = document.createElement('h4');
    modalTitle.class = "modal-title";
    var title = document.createTextNode('Projects');
    modalHeader.appendChild(buttonClose);
    modalHeader.appendChild(title);

    modalContent.appendChild(modalHeader);

    var modalBody = document.createElement('div');
    modalBody.class = "modal-body";

    var table = document.createElement('table');
    table.class = "table table-striped";
    
    var tHead = document.createElement('thead');
    var trHead = document.createElement('tr');    
    var thNama = document.createElement('th');
    var nama = document.createTextNode('Nama');
    thNama.appendChild(nama);
    var thInfo = document.createElement('th');
    var info = document.createTextNode('Info');
    thInfo.appendChild(info);
    var thTarif = document.createElement('th');
    var tarif = document.createTextNode('Tarif');
    thTarif.appendChild(tarif);
    var thKuantitas = document.createElement('th');
    var kuantitas = document.createTextNode('Kuantitas');
    thKuantitas.appendChild(kuantitas);

    trHead.appendChild(thNama);
    trHead.appendChild(thInfo);
    trHead.appendChild(thTarif);
    trHead.appendChild(thKuantitas);

    tHead.appendChild(trHead);

    table.appendChild(tHead);

    var tBody = document.createElement('tbody');
    
    var trBody = document.createElement('tr');
    var tdProjectName = document.createElement('td');
    var projectName = document.createTextNode({{$project->project_name}});
    tdProjectName.appendChild(projectName);
    var tdProjectInfo = document.createElement('td');
    var projectInfo = document.createTextNode({{$project->project_info}});
    tdProjectInfo.appendChild(projectInfo);
    var tdProjectTarif = document.createElement('td');
    var projectTarif = document.createTextNode({{$project->project_tarif}});
    tdProjectTarif.appendChild(projectTarif);
    var tdProjectQuantity = document.createElement('td');
    var projectQuantity = document.createTextNode({{$project->quantity}});
    tdProjectQuantity.appendChild(projectQuantity);

    trBody.appendChild(tdProjectName);
    trBody.appendChild(tdProjectInfo);
    trBody.appendChild(tdProjectTarif);
    trBody.appendChild(tdProjectQuantity);

    tBody.appendChild(trBody);

    table.appendChild(tBody);

    modalBody.appendChild(table);
    modalContent.appendChild(modalBody);
    
    modalDialog.appendChild(modalContent);




    var 
  }
</script>
@endsection