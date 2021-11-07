@extends('products.layout')
   
@section('content')
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="{{ asset('societe/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('societe/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{ asset('societe/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('societe/vendor/datepicker/daterangepicker.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="societe/css/main.css" rel="stylesheet" media="all">
   
</head>
<style>
    body{
        margin-left:200px;
    }
    </style>
<body>
    <div class="main-container">
        
                
                @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Il y'a certain problems avec les données entrées<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <h2 class="title">Info sur votre Entreprise</h2>
                    <form action="{{ route('entreprise.update',$entreprise->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Nom:</strong>
                    <input type="text"  name="nom" value="{{ $entreprise->nom }}" class="form-control" placeholder="libbélé" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date de creation:</strong>
                    <input type="date" value="{{$entreprise->date_creation}}" name="date_creation" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Raison sociale:</strong>
                    <input type="text"  value="{{$entreprise->raison_sociale}}" name="raison_sociale" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Adresse:</strong>
                    <input type="text" value="{{$entreprise->adresse}}" name="adresse" class="form-control" placeholder="unité">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telephone:</strong>
                    <input type="text" value="{{$entreprise->tele}}" name="tele" class="form-control" placeholder="quantite">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Site web url:</strong>
                    <input type="text" value="{{$entreprise->site_web}}" name="site_web" class="form-control" placeholder="stocke miinimum">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ICE:</strong>
                    <input  type="text" value="{{$entreprise->ICE}}" name="ICE" class="form-control" placeholder="prix d'achat">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>RC:</strong>
                    <input type="text" value="{{$entreprise->RC}}" name="RC" class="form-control" placeholder="prix_vente">
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>IF:</strong>
                    <input  type="text" value="{{$entreprise->IF}}" name="IF" class="form-control" placeholder="prix d'achat">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>CNSS:</strong>
                    <input  type="text" value="{{$entreprise->CNSS}}" class="form-control" name="CNSS" placeholder="prix d'achat">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>LOGO:</strong>
                    <input  type="file" value="{{$entreprise->logo}}" name="logo" class="form-control" placeholder="prix d'achat">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea  cols="50" rows="5" name="description" class="form-control"> {{$entreprise->description}} </textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Confirmer les modifications</button>
            </div>
                        
                    </form>
                </div>
            
       
</div>
</body>
@endsection