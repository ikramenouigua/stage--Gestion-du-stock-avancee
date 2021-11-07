@extends('layouts.master')

 
@section('content')
<body style="background-color:white;">
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
   
<form action="{{ route('products.store') }}" method="POST"  enctype="multipart/form-data">
    @csrf
     <div class="main-container">
     <h1 style="color:#0DB1B9;">Les produits</h1>
     <br/>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Référence:</strong>
                <input type="text" name="ref_produit" class="form-control" placeholder="Référence">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Libéllé de produit:</strong>
                <input type="text" name="libelle_produit" class="form-control" placeholder="Libellé">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea name="description" class="form-control" cols="10" rows="10"></textarea>
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
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
         <label for="title" class="control-block">Choisir une catégorie:</label>
         <select class="form-control" name="id_category">
         @foreach($categories as $categorie)
         <option value="{{ $categorie->id }}">{{ $categorie->nom_cat }}</option>
         @endforeach
          </select>
        </div>
</div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" id="btn-color">Ajouter un produit</button>
        </div>
    </div>
   
</form>

<br/><br/>
    <table class="table table-bordered" id="table">
        <tr>
            <th>Référence</th>
            <th>Libéllé du produit</th>
            <th>Quantité</th>
            <th width="380px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->libelle_produit }}</td>
            <td>{{ $product->quantite }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}"><i class="fas fa-eye"></i>
                    </a>
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}"><i class="fas fa-edit"></i></a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-info"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
      </body>
@endsection