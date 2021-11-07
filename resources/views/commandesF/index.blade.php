@extends('layouts.master')
 @section('content')
 <head>
 <style>
  .vente{
    background-color:rgba(0, 0, 0, 0);
    color:white;
    border: none;
    outline:none;
    height:30px;
    color:black;
  
}
.total{
  background-color:rgba(0, 0, 0, 0);
    color:white;
    border: none;
    outline:none;
    height:30px;
    color:black; }
    #qte{
      height:30px;
      margin-top:20px;
    }
   </style>
</head>
<body style="background-color : white;">
 <div class="main-container">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="color:#0DB1B9;">Commande Expédition</h2>
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

<div class="main-container">
  
        
         <form action="{{route('commande.category')}}" method="POST">
         @csrf
         <label for="title" class="labelSelect"  style="margin-left:130px;">Catégorie:</label>
            <select  name="nom_cat" id="nom_cat">
             @foreach($categories as $category)
             <option value="{{ $category->id }}">{{ $category->nom_cat}}</option>
             @endforeach
             </select>
             <input type="submit" value="Go" style="background-color:#0DB1B9;color:white;border-radius:40px;">
          </form>

         
    </div>
</div>
<form action="{{ route('commande.store') }}" method="POST">
    @csrf
 <div class="row">
 <div class="form-group">
   <label for="title" class="labelSelect" style="margin-left:450px;">Fournisseur:</label>
         <select  name="id_fournisseur" style="width:200px;" >
         @foreach($commandes_F as $commande_F)
         <option value="{{ $commande_F->id }}">{{ $commande_F->nom_fournisseur }}</option>
         @endforeach
          </select>
          
				<div class="col-md-12">
					<h3 style="text-weight:bold;margin-left:750px;">Choisir produits</h3>
					<div class="table-wrap">
						<table class="table" name="table[]">
						  <thead class="thead-primary">
						    <tr>
						    	<th>&nbsp;</th>
						    	<th>&nbsp;</th>
						    	<th>Produit</th>
						      <th>Prix</th>
						      <th>Quantité</th>
						      <th>prix total</th>
						      <th>&nbsp;</th>
						    </tr>
						  </thead>
						  <tbody>
              @foreach($products as $product)
						    <tr class="alert" role="alert" id="{{ 'pdt'.$product->id }}">
						    	<td>
						    		<label class="checkbox-wrap checkbox-primary">
										  <input type="checkbox" name="product[]" value="{{$product->id}}">
										  <span class="checkmark"></span>
										</label>
						    	</td>
						    	<td>
						    	<img class="img" src="{{ asset('/storage/images/products/' . $product->image_produit) }}" style="width:60px;height:60px; aligne:center;">
						    	</td>
						      <td>
						        {{$product->libelle_produit}}
						      </td>
						      <td><input type="text" value="{{$product->prix_vente}}" name="vente[]" class="vente" disabled></td>

						      <td class="quantity">
					        	<div class="input-group">
				             	<input type="text"  id ="qte" name="quantite_{{$product->id}}"  min="1" max="1000"   onkeyup="myFunction({{ 'pdt'.$product->id }}, this.value)">
                       <script>
                         function myFunction(row, x) {
                           let inputTtl = row.getElementsByClassName('total')[0];
                           let inputVet = row.getElementsByClassName('vente')[0];
                        
                           inputTtl.value = x * inputVet.value;
                                         }
                              </script>
				          	</div>
				          </td>
				          <td ><input type="text" id="total" class="total" name="total_{{$product->id}}" disabled></td>

						      <td>
                 
						      	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				            	<span aria-hidden="true"><i class="fa fa-close"></i></span>
				          	</button>
				        	</td>
						    </tr>
							@endforeach
						  </tbod>
						</table>
        
					</div>
				</div>
			</div>
		</div>
	</section>

  
       
   
   <!-- <div class="form-group">
         <label for="title" class="control-block">Ajouter les articles:</label>
         <select class="selectpicker" multiple data-live-search="true" name="id_produit[]">
         @foreach($products as $product)
         <option value="{{ $product->id }}">
         {{ $product->id}} *** {{ $product->libelle_produit }}</option>
         @endforeach
          </select>
        </div> -->
       
   
     
    
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        @can('creer commandeF')
                <button type="submit" class="btn btn-primary" style="background-color:#0DB1B9;margin-left:200px;">Ajouter la commande</button>
        @endcan
        </div>

</form>
<br/><br/>
     <table class="table table-bordered" id="table">
         <tr>
             <th>Référence</th>
             <th>Total des produits</th>
             <th>Date de commande </th>
             <th>Prix total</th>
             <th width="380px">Action</th>
         </tr>
         @foreach ($commandes as $commande)
         <tr>
             <td>{{ $commande->reference_commande }}</td>
             <td>{{ $commande->total_produits }}</td>
             <td>{{ $commande->date_cmd_fournisseur }}</td>
             <td>{{$commande->prix_total}}</td>
             <td>
                <form action="{{ route('commande.destroy',$commande->reference_commande) }}" method="POST">
   
                <a class="btn btn-info" href="{{ route('commande.show',$commande->reference_commande) }}"><i class="fas fa-eye"></i></a>
                @can('modifier commandeF')
                   <a class="btn btn-primary" href="{{ route('commande.edit',$commande->reference_commande) }}"><i class="fas fa-edit"></i></a>
                @endcan
                    @csrf
                    @method('DELETE')
                    @can('supprimer commandeF')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    @endcan
                </form>
            </td>
         </tr>
         @endforeach
     </table>
     </body>
       
 @endsection