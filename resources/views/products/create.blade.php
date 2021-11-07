@extends('layouts.master')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Ajouter un noveau produit </h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
        </div>
    </div>
</div>
   
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
   
<form action="{{ route('products.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Référence:</strong>
                <input type="text" name="ref_produit" class="form-control" placeholder="Référence">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Libéllé de produit:ee</strong>
                <input type="text" name="libelle_produit" class="form-control" placeholder="Libellé">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quantite:</strong>
                <input type="text" name="quantite" class="form-control" placeholder="Quantité">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prix d'achat:</strong>
                <input type="text" name="prix_achat" class="form-control" placeholder="prix d'achat">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prix de vente:</strong>
                <input type="text" name="prix_vente" class="form-control" placeholder="prix de vente">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Unité du produit:</strong>
                <input type="text" name="unite_produit" class="form-control" placeholder="unité de produit">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Stocke minimum:</strong>
                <input type="text" name="  stocke_min" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>image:</strong>
                <input type="file" name="image_produit" class="form-control">
            </div>
        </div>
        <div class="form-group">
         <label for="title" class="control-block">Choisir une catégorie:</label>
         <select class="form-control" name="id_category">
         @foreach($categories as $categorie)
         <option value="{{ $categorie->id }}">{{ $categorie->nom_cat }}</option>
         @endforeach
          </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Ajouter un produit</button>
        </div>
    </div>
   
</form>
@endsection