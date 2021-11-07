@extends('categories.Layout')
  
@section('content')
<html>
<head>
   
</head>
<body class="back" >
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <br/><br/>
                <h2 id="titre-h2"> Des informations sur la Categorie</h2>
            </div>
            <br/><br/>
         
        </div>
    </div>
    <br/><br/>
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Identificateur du catégorie:</strong>
                {{ $category->id }}
            </div>
        </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom du catégorie:</strong>
                {{ $category->nom_cat }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description du catégorie:</strong>
                {{ $category->description }}
            </div>
        </div>
       
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <img src="{{ asset('/storage/images/categories/' . $category->image_cat) }}" style="width:150px; height:150px;border-radius:50px; margin-left:100px;">
            </div>
        </div>
    </body>
    </html>
@endsection