
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
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/designe.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
 
 
  <style>
	 
.notification-box {
  position: fixed;
  z-index: 99;
  top: 30px;
  right: 30px;
  width: 50px;
  height: 50px;
  text-align: center;
  margin-right:1042px;
}

.notification-bell * {
  display: block;
  margin: 0 auto;
  background-color: black;
  box-shadow: 0px 0px 15px #fff;
}
.bell-top {
  width: 6px;
  height: 6px;
  border-radius: 3px 3px 0 0;
}
.bell-middle {
  width: 25px;
  height: 25px;
  margin-top: -1px;
  border-radius: 12.5px 12.5px 0 0;
}
.bell-bottom {
  position: relative;
  z-index: 0;
  width: 32px;
  height: 2px;
}


.bell-rad {
  width: 8px;
  height: 4px;
  margin-top: 2px;
  border-radius: 0 0 4px 4px;
 
}
.notification-count {
  position: absolute;
  z-index: 1;
  top: -6px;
  right: -6px;
  width: 25px;
  height: 25px;
  line-height: 30px;
  font-size: 18px;
  border-radius: 50%;
  background-color: #ff4927;
  color: #fff;
 
}
@keyframes bell {
  0% { transform: rotate(0); }
  10% { transform: rotate(30deg); }
  20% { transform: rotate(0); }
  80% { transform: rotate(0); }
  90% { transform: rotate(-30deg); }
  100% { transform: rotate(0); }
}
@keyframes rad {
  0% { transform: translateX(0); }
  10% { transform: translateX(6px); }
  20% { transform: translateX(0); }
  80% { transform: translateX(0); }
  90% { transform: translateX(-6px); }
  100% { transform: translateX(0); }
}
@keyframes zoom {
  0% { opacity: 0; transform: scale(0); }
  10% { opacity: 1; transform: scale(1); }
  50% { opacity: 1; }
  51% { opacity: 0; }
  100% { opacity: 0; }
}
@keyframes moon-moving {
  0% {
    transform: translate(-200%, 600%);
  }
  100% {
    transform: translate(800%, -200%);
  }
}
  </style>

	<!-- Global site tag (gtag.js) - Google Analytics -->

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				
			</div>
		</div>
		<div class="my-moon"></div>
  <div class="notification-box">
  <a href="{{ route('notif') }}"> <span class="notification-count">{{$notif}}</span></a>
    <div class="notification-bell">

      <span class="bell-top"></span>
      <span class="bell-middle"></span>
      <span class="bell-bottom"></span>
      <span class="bell-rad"></span>
    </div>
  </div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i><img src="vendors/images/para.png">
					</a>
				</div>
			</div>
			
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="vendors/images/photo1.jpg" alt="">
						</span>
						<span class="user-name">{{ Auth::user()->type }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="{{route('profile-user')}}"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
						<a class="dropdown-item" href="{{ route('signout') }}"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.html">
				<span style="color:#0DB1B9; text-wight:bold;font-size:40px;">
				NaiStore </span>
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
                <li>   
						<a href="acceuil" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"><img src="vendors/images/ho.png"/></span><span class="mtext">Acceuil</span>
						</a>
					</li>
					<li class="dropdown">   
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit2"><i class="far fa-chart-bar"></i></span><span class="mtext">Rapport</span>
						</a>
						<ul class="submenu">
						@can('rapport vente')
							<li><a href="{{ route('show_rapport') }}">Vente</a></li>
						@endcan
							@can('rapport achat')
							<li><a href="{{ route('show_rapport_achat') }}">Achat</a></li>
							@endcan
							@can('rapport client')
							<li><a href="{{ route('show_rapport_client') }}">Clients</a></li>
							@endcan
							
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit2"><img src="vendors/images/catalogue.png"/></span><span class="mtext">Catalogue</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('categories.index') }}">Categories</a></li>
							<li><a href="{{ route('products.index') }}">Produits</a></li>
							<li><a href="liste-products">Liste de produits</a></li>
							<li><a href="{{ route('caracteristiques.index') }}">Caractéristiques</a></li>
							<li><a href="/stocke">Stocke</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"><img src="vendors/images/compte.png"></span><span class="mtext">Comptes</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('fournisseur.index') }}">Fournisseurs</a></li>
							<li><a href="{{ route('clients.index') }}">Clients</a></li>
							<li><a href="liste-clients">Liste du clients</a></li>
							
							
						</ul>
					</li>
                    <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library">
							<img src="vendors/images/ach.png"></span><span class="mtext">Achats</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('commande.index') }}">Bon de Commande Expédition</a></li>
							<li><a href="liste">Liste bon commande</a></li>
							<li><a href="{{ route('facturefournisseur.index') }}">Bon de Livraison / Facture Fournisseur</a></li>
							<li><a href="avoiref">Avoires</a></li><li>
							<a href="listef">Liste des avoires</a></li>
                    
						</ul>
					</li>
                   
                  
                    <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"><img src="vendors/images/vendre.png"></span><span class="mtext">Ventes</span>
						</a>
						<ul class="submenu">
							
				            <li><a href="{{ route('commandec.index') }}">Bon de Commande</a></li>
							<li><a href="listeBCommande">Liste bon commande du client</a></li>
                            <li><a href="{{route('bondelivraison.index')}}">Bon de Livraison</a></li>
							<li><a href="{{route('factureclient.index')}}">Facture</a></li>
							<li><a href="{{route('devis')}}">Devis</a></li>
							<li><a href="{{route('bondelivraison.liste')}}">Détails de bonde de livraison</a></li>
							<li><a href="avoirec">Avoirs</a></li>
							<a href="listec">Liste des avoires</a></li>


						</ul>
					</li>   
                  
					
                    <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"><img src="vendors/images/utilisateur.png"></span><span class="mtext">Utilisateurs</span>
						</a>
						<ul class="submenu">
							<li><a href="users">Utilisateurs</a></li>
                            </ul>
					</li>		
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"><img src="vendors/images/utilisateur.png"></span><span class="mtext">Roles</span>
						</a>
						<ul class="submenu">
							<li><a href="roles">Roles</a></li>
							<li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                            </ul>
					</li>		
					<li  class="dropdown">
						<a href="javascript:;" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"><img src="vendors/images/para.png"></span><span class="mtext">Paramètres</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('setting.index') }}">Paramètre commande</a></li>
							<li><a href="{{ route('entreprise.index') }}">Entreprise</a></li>
							<li><a href="{{ route('taxe.index') }}">Taxe</a></li>
							<li><a href="{{ route('livraison.index') }}">Livraison</a></li>
							<li><a href="{{ route('paiement.index') }}">Paiement</a></li>
                            </ul>
					</li>			
				</ul>
			</div>
		</div>
	</div>
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