@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit invoice
  </div>
  <script>
 var count=0;

</script>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form id="isi" method="post" action="{{ route('invoice.update', $invoice->id) }}">
        @method('PATCH')
        @csrf
          <div class="form-group">
              <label for="price">Invoice Nomor :</label>
              <input type="text" class="form-control" name="nomor" value="{{$invoice->nomor}}" />
          </div>
          <div class="form-group">
              <label for="price">Invoice Customer :</label>
              <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Choose Customer
                </a>
                <select name='customer_id' >
                @foreach ($customers as $customer)
                  @if ($invoice->customer_id == $customer->id)
                    <option class="dropdown-item" value="{{$customer->id}}" selected >{{$customer->name}}</option>
                  @else
                    <option class="dropdown-item" value="{{$customer->id}}">{{$customer->name}}</option>
                  @endif
                @endforeach
                </select>
              </div>
          </div>
          <div class="form-group >
            <label for="quantity">Invoice Project :</label>
            <br>
            @foreach ($projects as $project)
              <script>
                function cloneForm() 
                {
                  var select = document.createElement('select');
                  select.name = "project_id[" + count +"]";
                  select.id = "projectId[" + count +"]";
                  var input = document.createElement('input');
                  input.type = "text";
                  input.name = "quantity[" + count +"]"; 
                  input.value = "{{$project->quantity}}";
                  input.placeholder = "{{$project->quantity}}";
                  var div = document.createElement('div');
                  div.class = "form-group";
                  div.appendChild(select);
                  div.appendChild(input);
                  linebreak = document.createElement("br");
                  document.getElementById('isi').appendChild(div);
                  document.getElementById('isi').appendChild(linebreak);
                }
                cloneForm();
              </script>
              @foreach ($allProjects as $allProject)
                <script>
                  function cloneOption()
                  {
                    var option = document.createElement('option')
                    option.class = "dropdown-item";
                    option.value = "{{$allProject->id}}";
                    var node = document.createTextNode("{{$allProject->name}}");
                    option.appendChild(node);
                    var select = document.getElementById('projectId[' + count+']');
                    select.appendChild(option);
                    if (option.value == {{$project->project_id}})
                    {
                      select.selectedIndex = count;
                    }
                  }
                  cloneOption();
                </script>
              @endforeach
                <script>
                  count +=1;
                </script>
            @endforeach
            <br>
          </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>

@endsection