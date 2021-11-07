@extends('fournisseurs.Layout')
  
@section('content')
<html>
<head>
   
</head>
<body class="back" >
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <br/><br/>
                <h2 style="color:red;"> Des informations sur ce fournisseur</h2>
            </div>
            <br/><br/>
         
        </div>
    </div>
    <br/><br/>
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Identifiant du fournisseur:</strong>
                {{ $fournisseur->id}}
            </div>
        </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom du fournisseur:</strong>
                {{ $fournisseur->nom_fournisseur }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>email du fournisseur:</strong>
                {{ $fournisseur->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Téléphone du fournisseur:</strong>
                {{ $fournisseur->tel}}
            </div>
        </div>
       
   
    </body>
    </html>
@endsection