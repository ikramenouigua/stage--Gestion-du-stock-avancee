@extends('layouts.master')
 @section('content')
 <head>
     <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" type="text/css" href="css/util.css">
	 <link rel="stylesheet" type="text/css" href="css/main.css">
 </head>
<body style="background-color : white;">
 <div class="main-container">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2  style="color:#0DB1B9;">Liste des avoires de fournisseurs</h2>
        </div>
    </div>
</div>

<div class="main-container">
<!--<div style="margin-top:2%;">
<p>Rechercher</p><input type="text" name="search"></div> -->

 <!-- Search Widget -->
 
         <form action="{{ route('commande.search') }}" method="GET">
            {{ csrf_field() }}
            <div>
                <div class="form-group">
						<div class="form-wrapper">
                        <input type="text" class="form-control" placeholder="Search for..." name="search" required/>
						</div>
						<div class="form-wrapper">
                        <input type="submit" value="Go" style="background-color:black; color:white; width:100px; border-radius:40px;height:30px"/>
						</div>
					</div>
        </form> 
        <div class="form-group">
						<div class="form-wrapper">
                          
							<label for="">L'identifiant</label>
							<input type="text" class="form-control" value="{{$identifiant}}">
						</div>
						<div class="form-wrapper">
							<label for="">Numéro de commande</label>
							<input type="text" class="form-control" name="email" value="{{$numero_commande}}">
                            
						</div>
					</div>

                    <div class="form-group">
						<div class="form-wrapper">
							<label for="">Nom de fournisseur</label>
							<input type="text" class="form-control" value="{{$nom_fournisseur}}">
						</div>
						<div class="form-wrapper">
							<label for="">Date d'avoire</label>
							<input type="text" class="form-control" name="email" value="{{$date_avoire}}">
						</div>
					</div>
     <table class="cont_div">
         <tr>
             <th>Numéro d'avoire</th>
             <th>Référence du produit</th>
             <th>Libéllé de produit</th>
             <th>Quantité</th>
         </tr>
         @foreach ($avoires as $a)
         <tr>
       
		</td>
            <td>{{ $a->id_avoire}}</td>
             <td>{{ $a->ref_produit}}</td>
             <td>{{ $a->libelle_produit }}</td>
             <td>{{ $a->quantite }}</td>
            
         </tr>
         @endforeach
       
     </table>
     <br/<<br/>
   
        <br/<<br/<br/>
     
        </body>
 @endsection