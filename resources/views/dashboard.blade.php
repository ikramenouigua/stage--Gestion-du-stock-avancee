@extends('layouts.master')
 @section('content')
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>stockex</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="">
	<link rel="icon" type="image/png" sizes="32x32" href="">
	<link rel="icon" type="image/png" sizes="16x16" href="">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
      <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<style>
	#count{
      color:#0DB1B9;
	  font-weight:bold;
	  margin-left:20px;
	  width:100px;
	  height:100px;
	}
	.commande{
        color: #000;
       
        background-repeat: no-repeat;
        width: 100%;
        height: 100%; background-size:1600px;
        }
	</style>

	</head>
	<body class="commande">

	<div class="main-container">
		 <!-- Main content -->
		 <br/><br/><br/>
		 <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$commande_clients}}</h3>

                <p>Ventes</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              @can('affiche ventes')
              <a href="{{ route('show_vente') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              
                <h3>{{$commande_fournisseurs}}</h3>

                <p>Achats</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              @can('affiche achats')
              <a href="{{ route('show_achat') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$clients}}</h3>

                <p>Clients</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              @can('affiche clients')
              <a href="{{ route('show_clients') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$fac}}</h3>

                <p>Factures</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              @can('affiche factures')
              <a href="{{ route('show_facture') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
		
      
  
        
			<br/><br/><br/><br/><br/>
			
			
			
			<br/><br/><br/><br/><br/><br/>
		<!--	<div class="footer-wrap pd-20 mb-20 card-box">
				stockex - tous droits réservés
			</div> -->
		</div>
	</div>
  <!-- Just before the closing body tag is best --><script src="https://cdn.zingchart.com/zingchart.min.js"></script><script>  zingchart.render({    id: 'myChart',    data: {      type: 'line',      series: [        { values: [54,23,34,23,43] },        { values: [10,15,16,20,40] }      ]    }  });</script></body>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard.js"></script>

    @yield('content')

</body>

</html>
@endsection