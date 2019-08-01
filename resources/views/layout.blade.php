<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hanjaya</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/addons/bootstrap.min.css">

  <link rel="stylesheet" href="/addons/dataTables.bootstrap.min.css" >
  
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/adminlte/css/skins/_all-skins.min.css">
  <script src="/addons/jquery.min.js"></script>
  
  @yield('link')
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="/addons/fonts.css">
   
    <style>

      .table-bordered,th, thead, tbody, tr, td {
        border: black solid 1px !important;
        text-align:center;
      }
      
    </style>
</head>
  @if (Auth::check() && Auth::user()->role =='admin' )
      @include ('admin')
  @else 
      @include ('user')
  @endif

<script>
 var biaya = $('#biaya').DataTable( {       
        scrollX:        true,
        autoWidth : false,
        "aoColumns": [
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": false}, 
      {"bSearchable": false}
    ] 
    } );

var customer = $('#customer').DataTable( {       
        scrollX:        true,
        autoWidth : false,
        "aoColumns": [
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true}, 
      {"bSearchable": true}, 
      {"bSearchable": false}, 
      {"bSearchable": false}
    ] 
    } );

    var vendor = $('#vendor').DataTable( {       
        scrollX:        true,
        autoWidth : false,
        "aoColumns": [
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true}, 
      {"bSearchable": true}, 
      {"bSearchable": false}, 
      {"bSearchable": false}
    ] 
    } );

     var project = $('#project').DataTable( {       
        scrollX:        true,
        autoWidth : false,
        "aoColumns": [
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true}, 
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": false}, 
      {"bSearchable": false}
    ] 
    } );

     var invoice = $('#invoice').DataTable( {       
        scrollX:        true,
        autoWidth : false,
        "aoColumns": [
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": false}, 
      {"bSearchable": false},
      {"bSearchable": false}
    ] 
    } );

     var nota = $('#nota').DataTable( {       
        scrollX:        true,
        autoWidth : false,
        "aoColumns": [
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": false},
      {"bSearchable": false}, 
      {"bSearchable": false}
    ] 
    } );
    var invonota = $('#invonota').DataTable( {       
        scrollX:        true,
        autoWidth : false,
        "aoColumns": [
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": false}, 
      {"bSearchable": false}
    ] 
    } );

    var laporan = $('#laporan').DataTable( {       
        scrollX:        true,
        autoWidth : false,
        "aoColumns": [
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": false}, 
      {"bSearchable": false}
    ] 
    } );

    var user = $('#user').DataTable( {       
        scrollX:        true,
        autoWidth : false,
        "aoColumns": [
      {"bSearchable": true}, 
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": true},
      {"bSearchable": false}, 
      {"bSearchable": false}
    ] 
    } );
</script>

</html>
