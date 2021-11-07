@extends('layouts.master')
 @section('content')

 <div class="main-container">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Commande Expédition</h2>
        </div>
		<br/><br/>
       
    </div>
</div>
<form action="{{ route('commande.store') }}" method="POST">
    @csrf
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
   
<div class="row">
				<div class="col-md-12">
					<h3 class="h5 mb-4 text-center">Choisir produits</h3>
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
						    <tr class="alert" role="alert">
						    	<td>
						    		<label class="checkbox-wrap checkbox-primary">
										  <input type="checkbox" name="product[]" value="{{$product->id}}">
										  <span class="checkmark"></span>
										</label>
						    	</td>
						    	<td>
						    	<img class="img" src="/images/{{ $product->image_produit}}" style="width:60px;height:60px; aligne:center;">
						    	</td>
						      <td>
						        {{$product->libelle_produit}}
						      </td>
						      <td>{{$product->prix_vente}}</td>
						      <td class="quantity">
					        	<div class="input-group">
				             	<input type="text" name="quantite[]" class="quantity form-control input-number"  min="1" max="100">
				          	</div>
				          </td>
				          <td>{{$product->prix_vente}}</td>
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

  
        <div class="form-group">
         <label for="title" class="labelSelect">Fournisseur:</label>
         <select class="selectFourni" name="id_fournisseur">
         @foreach($commandes_F as $commande_F)
         <option value="{{ $commande_F->id }}">{{ $commande_F->id}} *** {{ $commande_F->nom_fournisseur }}</option>
         @endforeach
          </select>
        </div>
    </div>
   
   <!-- <div class="form-group">
         <label for="title" class="control-block">Ajouter les articles:</label>
         <select class="selectpicker" multiple data-live-search="true" name="id_produit[]">
         @foreach($products as $product)
         <option value="{{ $product->id }}">
         {{ $product->id}} *** {{ $product->libelle_produit }}</option>
         @endforeach
          </select>
        </div> -->
       
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>


        
     
    
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Ajouter la commande</button>
        </div>

</form>
<br/><br/>
     <table class="table table-bordered">
         <tr>
             <th>Référence</th>
             <th>Total des produits</th>
             <th>Date de commande </th>
             <th>Prix total</th>
             <th width="280px">Action</th>
         </tr>
         @foreach ($commandes as $commande)
         <tr>
             <td>{{ $commande->reference_commande }}</td>
             <td>{{ $commande->quantite_cmd }}</td>
             <td>{{ $commande->date_cmd_fournisseur }}</td>
             <td>{{$commande->prix_total}}</td>
             <td>
                <form action="" method="POST">
   
                <a class="btn btn-info" href="{{ route('commande.show',$commande->reference_commande) }}">Show</a>
    
                    <a class="btn btn-primary" href="">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
         </tr>
         @endforeach
     </table>
     
       
 @endsection