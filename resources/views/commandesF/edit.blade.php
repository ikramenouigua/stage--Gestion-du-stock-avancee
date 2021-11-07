@extends('layouts.app')
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
    #table{
      border:4px solid;
      margin-left:100px;
      margin-top:50px;
    }
    #commande{
        background-image: url('/images/l.jpg');
        background-repeat: no-repeat;
        width: 1000px;
         height: 100%; background-size:1800px;
        }
   </style>
</head>
<body class="main-container"  id="commande">
 <div class="main-container">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="color:#0DB1B9;">Modifier la commande</h2>
        </div>

    </div>
</div>
<div class="pull-right">
                <a class="btn btn-primary" href="{{ route('commandec.index') }}" id="back"> Back</a>
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


</div>
<form action="{{ route('commande.update',$commandes) }}" method="POST">
        @csrf
        @method('PUT')
 <div class="row">
 <div class="form-group">
   
          
				<div class="col-md-12">
					<div class="table-wrap">
						<table name="table[]" id="table">
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
              @foreach($lignes as $product)
						    <tr class="alert" role="alert" id="{{ 'pdt'.$product->id }}">
						    	<td>
						    		<label class="checkbox-wrap checkbox-primary">
										  <input type="checkbox" name="product[]" value="{{$product->id}}" checked>
										  <span class="checkmark"></span>
										</label>
						    	</td>
						    	<td>
						    	<img class="img" src="/images/{{ $product->image_produit}}" style="width:60px;height:60px; aligne:center;">
						    	</td>
						      <td>
						        {{$product->libelle_produit}}
						      </td>
						      <td><input type="text" value="{{$product->prix_vente}}" name="vente[]" class="vente" disabled></td>

						      <td class="quantity">
					        	<div class="input-group">
                    <input type="text"  id ="qte" name="quantite_{{$product->id}}"  min="1" max="1000" value="{{$product->quantite_cmd}}"  onkeyup="myFunction({{ 'pdt'.$product->id }}, this.value)">
                       <script>
                         function myFunction(row, x) {
                           let inputTtl = row.getElementsByClassName('total')[0];
                           let inputVet = row.getElementsByClassName('vente')[0];
                        
                           inputTtl.value = x * inputVet.value;
                                         }
                              </script>
                      
				          	</div>
				          </td>
				          <td ><input type="text" id="total" value="{{$product->prix_total}}" class="total" name="total_{{$product->id}}" disabled ></td>

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

 
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        @can('commandeF-edit')
                <button type="submit" class="btn btn-primary" style="background-color:#0DB1B9;margin-left:200px;">Modifier la commande</button>
        @endcan
        </div>

</form> 
     </body>
       
 @endsection