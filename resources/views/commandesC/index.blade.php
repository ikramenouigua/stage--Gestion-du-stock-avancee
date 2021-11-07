@extends('layouts.master')
 @section('content')
 <head>
     <script>
       function calcPrice(){
       // $quantite = form2.get_parent_class('quantity').value;
        
        form1.total.value = 10;
       }

     </script>
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
<body style="background-color : white;" >
 <div class="main-container">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Commandes Client</h2>
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
   
        </div>
        
        <form action="{{route('commandec.categoryc')}}" method="POST">
         @csrf
         <label for="title" class="labelSelect"  style="margin-left:390px;">Catégorie:</label>
            <select  name="nom_cat" id="nom_cat" style="width:180px;">
             @foreach($categories as $category)
             <option value="{{ $category->id }}">{{ $category->nom_cat}}</option>
             @endforeach
             </select>
             <input type="submit" value="Go" style="background-color:#0DB1B9;color:white;border-radius:40px;">
          </form>

         
    </div>
</div>
<form action="{{ route('commandec.store') }}" method="POST">
    @csrf
    <div class="row">
 <div class="form-group">
 <label for="title" class="labelSelect"  style="margin-left:400px;">Client:</label>
            <select  name="client" id="client" style="width:200px;margin-left:47px;">
             @foreach($client as $c)
             <option value="{{$c->id}}" selected>{{ $c->nom}}</option>
             @endforeach
             </select>
				<div class="col-md-12">
					<h3 class="h5 mb-4 text-center" style="text-weight:bold;margin-left:200px;">Choisir produits</h3>
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
				          <td ><input type="text" class="total" name="total" disabled></td>

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
       
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>


        
     
    
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
             @can('creer commandeC')
                <button type="submit" class="btn btn-primary" id="btn-client">Ajouter la commande</button>
                @endcan
        </div>

</form>
<br/><br/>
     <table class="table table-bordered">
         <tr>
             <th>Référence</th>
             <th>Total des produits</th>
             <th>Date de commande </th>
             <th>Prix total</th>
             <th width="520px">Action</th>
         </tr>
         @foreach ($commandes as $commande)
         <tr>
             <td>{{ $commande->reference_commande }}</td>
             <td>{{ $commande->total_produits }}</td>
             <td>{{ $commande->date_cmd_client }}</td>
             <td>{{$commande->prix_total}}</td>
             <td>
                <form action="{{ route('commandec.destroy',$commande->reference_commande) }}" method="POST">
   
                <a class="btn btn-info" href="{{ route('commandec.show',$commande->reference_commande) }}"><i class="fas fa-eye"></i></a>
                @can('modifier commandeC')
                   <a class="btn btn-primary" href="{{ route('commandec.edit',$commande->reference_commande) }}"><i class="fas fa-edit"></i></a>
                @endcan
                    @can('devisPDF  commandeC')
                <a class="btn btn-info" href="{{ route('commandec.devipdf',$commande->reference_commande) }}">Devi</a>
                     @endcan
                  
   
                    @csrf
                    @method('DELETE')
                    @can('supprimer commandeC')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    @endcan
                </form>
            </td>
         </tr>
         @endforeach
     </table>
     </body>
       
 @endsection