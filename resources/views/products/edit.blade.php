@extends('products.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier un produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('products.update',$product->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $product->id }}" class="form-control" placeholder="libbélé" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Libéllé du produit:</strong>
                    <input type="text" name="libelle_produit" value="{{ $product->libelle_produit }}" class="form-control" placeholder="libbélé">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Référence du produit:</strong>
                    <input type="text" name="ref_produit" value="{{ $product->ref_produit }}" class="form-control" placeholder="libbélé">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>unité du produit:</strong>
                    <input type="text" name="unite_produit" value="{{ $product->unite_produit }}" class="form-control" placeholder="unité">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Quantité:</strong>
                    <input type="text" name="quantite_produit" value="{{ $product->quantite_produit }}" class="form-control" placeholder="quantite">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Stocke minimum:</strong>
                    <input type="text" name="stocke_min" value="{{ $product->stocke_min }}" class="form-control" placeholder="stocke miinimum">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Prix d'achat:</strong>
                    <input type="text" name="prix_achat" value="{{ $product->prix_achat }}" class="form-control" placeholder="prix d'achat">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Prix de vente:</strong>
                    <input type="text" name="prix_vente" value="{{ $product->prix_vente }}" class="form-control" placeholder="prix_vente">
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
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>image :</strong>
                    <input type="file" name="image_produit" value="{{ $product->image_produit }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Confirmer les modifications</button>
            </div>
        </div>
   
    </form>
@endsection
