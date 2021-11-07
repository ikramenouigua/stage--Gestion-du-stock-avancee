@extends('layouts.master')
@section('content')
<!DOCTYPE html>
<html>
  <head>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
      }
      h1 {
      position: absolute;
      margin-top: 1px;
      font-size: 32px;
      color: black;
      z-index: 2;
      }
      h2 {
      font-weight: 400;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
      }
      form {
      width: 100%;
      padding: 20px;
      border-radius: 6px;
      background: #fff;
      box-shadow: 0 0 20px 0 #095484; 
      }
      .banner {
      position: relative;
      height: 210px;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      }
      .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.4); 
      position: absolute;
      width: 100%;
      height: 100%;
      }
      input, select {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      margin-top:20px;
      }
      select {
        margin-top:20px;
      width: 70%;
      padding: 7px 0;
      background: transparent;
      }
      .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder, a {
      color: #095484;
      }
      .item input:hover, .item select:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 6px 0 #095484;
      color: #095484;
      }
      .item {
      position: relative;
      margin: 50px 0;
      }
     
     
      .item i {
      right: 2%;
      top: 30px;
      z-index: 1;
      }
     
      label{
        
        width:20px;
      }
      #liste{
        background-color:#0DB1B9;
        border : black 2px;
      }

     
     
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background: #095484;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background: #0666a3;
      }
      @media (min-width: 568px) {
      .name-item, .city-item {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .name-item input, .city-item input {
      width: calc(50% - 20px);
      }
      .city-item select {
      width: calc(50% - 8px);
      }
      #table{
         background-color:black;
      }
      #qte{
        margin-top:50px;
      }
      #button {
       transition-duration: 0.4s;
       width:100px;
       background-color:pink;
       }

       #button:hover {
       background-color: blue; /* Green */
      color: white;
    
             }
      }
    </style>
  </head>
  <body>
    <div class="main-container">
    <div >
          <h1  style="color:#0DB1B9;">Bonde de Livraison</h1>
        </div>
    <form action="{{route('commandec.categorybl')}}" method="POST">
    @csrf
    <label for="title" class="labelSelect"  style="margin-left:390px;">Catégorie:</label>
       <select  name="nom_cat" id="nom_cat" style="width:180px; margin-left:60px;">
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->nom_cat}}</option>
        @endforeach
        </select>
        <input type="submit" value="Go" style="background-color:#0DB1B9;color:white;border-radius:40px;width:80px;">
     </form>

      <form action="{{route('bondelivraison.store')}}" method="POST">
        @csrf
       
        
        <div class="item">
          <p>Date de bonde livraison</p>
          <input type="date" name="date_bl" style="width:738px;"/>
        </div>
       
        <div class="item">
          <p>nom du client</p>
         
          <select name="id_client">
          @foreach($clients as $client)
            <option value="{{$client->id}}">{{$client->nom}}</option>
            @endforeach
            </select>
        </div>
        <div class="item">
          <p>Numéro de commande</p>
          <select name="numero_commande">
          @foreach($commandes as $commande)
            <option value="{{$commande->id}}">{{$commande->reference_commande}}</option>
            @endforeach
            </select>
        </div>
       
        <div class="item">
          <p>Etat de facture</p>
          <select name="etat_facture">
            <option>payé</option>
            <option>non payé</option>
            </select>
        </div>
        <div class="item">
          <p>Mode de payement</p>
          <select name="mode_payement">
            <option>Carte</option>
            <option>Espèse</option>
            </select>
        </div>
        
        <div class="item">
          <p>conditionnement</p>
          <select name="conditionnement">
            <option>sac</option>
            </select>
        </div>
        <div class="main-container">
   
   </div>
   
  
    
</div>
</div>
<div class="main-container">
        <h2>les produits</h2>
        <br/>
			
						<table  name="table[]" id="liste">
						  <thead class="thead-primary">
						    <tr>
						    	<th >&nbsp;</th>
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
						    		<label class="checkbox-wrap checkbox-primary" style="width:100px;">
										  <input type="checkbox" name="product[]" value="{{$product->id}}">
										</label>
						    	</td>
						    	<td style="width:100px;">
						    	<img class="img" src="{{ asset('/storage/images/products/' . $product->image_produit) }}" style="width:60px;height:60px; aligne:center;">
						    	</td>
						      <td>
						        {{$product->libelle_produit}}
						      </td>
						      <td><input type="text" value="{{$product->prix_vente}}" name="vente[]" id="vente" disabled style="border:none;"> </td>

						      <td class="quantity">
					        	<div class="input-group">
				             	<input type="text"  id ="qte" name="quantite_{{$product->id}}"  min="1" max="1000"   onkeyup="myFunction(this.value)">
                       <script>
                         function myFunction(x) {
                        //var x = document.getElementById("quantite_").value;
                        //var y = document.getElementById("vente").value;
                        var z = document.getElementById("total");
                        var y = document.getElementById('vente').value
                         z.value = x * y;
                                         }
                              </script>
				          	</div>
				          </td>
				          <td ><input type="text" id="total" name="total" disabled style="border:none;"></td>
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
            <input type="submit" value="Enregistrer" id="button"  style="background-color:#0DB1B9; color:white;">
					</div>
				</div>
            
       
              </form>
    </div>
  </body>

</html>
@endsection