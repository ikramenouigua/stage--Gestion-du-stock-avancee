@extends('layouts.master')
@section('content')
<head>
    <style>
    #marge{
        margin-top:50px;
        margin-left:20px;
    }
    body{
        background-color:white;
    }
    label{
        margin-top:50px;
        font-size:20px;
        font:arial;
    }
    select{
        margin-top:50px;
        width:300px;
        background-color: #0DB1B9;;
        color:white;
        border-radius:50px;
        height:30px;
    }
    h1{
      color: #0DB1B9;
    }
    .btn{
        background-color: blue;
        color : white;
        border-radius :50px;
        height:40px;
    }

    </style>
    <script>
// Material Select Initialization
$(document).ready(function() {
$('.mdb-select').materialSelect();
});
</script>
</head>
<body>
<div class="main-container">
    <h1>Fiche de stocke</h1>
    <label>  Rechercher produit  </label>
   <form action="/chercher" method="GET">
    <select class="mdb-select md-form" searchable="Search here.." name="search"> 
  <option value="" disabled selected>Rchercher la référence</option>
  @foreach($products as $product)
       <option value="{{$product->id}}">{{$product->ref_produit}}</option>
    @endforeach
</select>
<input type="submit" value="rechercher" class="btn">
</form>
  <div class="row">
    <div class="col-90 col-lg-300">
       <h1>Les entrées </h1>
      <table class="table table-striped" id="marge">
        <thead>
          <tr>
            <th scope="col">Référence du produit</th>
            <th scope="col"> Libéllé du produit</th>
            <th scope="col"> Quantité commandée</th>
            <th scope="col"> Date d'entrée</th>
          </tr>
        </thead>
        <tbody>
            @foreach($commande_f as $stocke)
          <tr>
            <th scope="row">{{$stocke->id_produit}}</th>
            <td>{{$stocke->libelle_produit}}</td>
            <th scope="row">{{$stocke->quantite_cmd}}</th>
            <td>{{$stocke->date_cmd_fournisseur}}</td>
          </tr>
         @endforeach
        </tbody>
      </table>

      <h1>Les sortis </h1>
      <table class="table table-striped" id="marge">
        <thead>
          <tr>
            <th scope="col">Référence du produit</th>
            <th scope="col"> Libéllé du produit</th>
            <th scope="col"> Quantité livrée</th>
            <th scope="col"> Date sortie</th>
            <th scope="col"> Noveau stocke</th>
          </tr>
        </thead>
        <tbody>
            @foreach($commande_c as $s)
          <tr>
            <th scope="row">{{$s->id_produit}}</th>
            <td>{{$s->libelle_produit}}</td>
            <th scope="row">{{$s->quantite_cmd}}</th>
            <td>{{$s->date_cmd_client}}</td>
            <td>{{$s->quantite}}</td>
          </tr>
         @endforeach
        </tbody>
      </table>

      
    </div>
    
    

        
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
@endsection