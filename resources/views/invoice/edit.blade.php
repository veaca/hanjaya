@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
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
      <form  method="post" action="{{ route('invoice.update', $invoice->id) }}">
        @method('PATCH')
        @csrf
        <label for="price">Invoice Customer :</label>
          <div class="form-group">
                <label for="customer">Pilih Customer</label>
                <select class="form-control" name='customer_id' >
                @foreach ($customers as $customer)
                  @if ($invoice->customer_id == $customer->id)
                    <option class="dropdown-item" value="{{$customer->id}}" selected >{{$customer->name}}</option>
                  @else
                    <option class="dropdown-item" value="{{$customer->id}}">{{$customer->name}}</option>
                  @endif
                @endforeach
                </select>
          </div>
          <div class="form-group" >
            <label for="quantity">Invoice Project :</label>
            <div class="form-group" id="isi">

            </div>
            @foreach ($projects as $project)
              <script>
                function cloneForm() 
                {
                  var row = document.createElement('div');
                  row.className = "row";
                  var colSm4 = document.createElement('div');
                  colSm4.className = "col-sm-4";
                  var colSm8 = document.createElement('div');
                  colSm8.className = "col-sm-4";
                  var select = document.createElement('select');
                  select.name = "project_id[" + count +"]";
                  select.id = "projectId[" + count +"]";
                  select.className = "form-control";
                  var input = document.createElement('input');
                  input.type = "text";
                  input.name = "quantity[" + count +"]"; 
                  input.value = "{{$project->quantity}}";
                  input.className = "form-control";
                  input.placeholder = "{{$project->quantity}}";
                  var div = document.createElement('div');
                  div.class = "form-group";
                  colSm4.appendChild(select);
                  colSm8.appendChild(input);
                  row.appendChild(colSm4);
                  row.appendChild(colSm8);
                  document.getElementById('isi').appendChild(row);
                  // document.getElementById('isi').appendChild(linebreak);
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
                    //   console.log(option.value + " ");
                    // console.log({{$project->project_id}});
                    // console.log("\n");
                      select.selectedIndex = option.value-1;
                    }
                  }
                  cloneOption();
                </script>
              @endforeach
                <script>
                  count +=1;
                </script>
            @endforeach
          </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>

@endsection