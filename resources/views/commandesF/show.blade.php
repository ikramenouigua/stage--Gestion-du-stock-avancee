@extends('commandesF.layout')
  
@section('content')

<body class="commande">
      
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="titre2"> Détails de la commande</h2>
                <br/><br/>
            </div>
           
    <table id="dtVerticalScrollExample" cellspacing="0"
  width="100%" style=" color :black;
      border : 2px solid black;">
    <tr>
    <th class="th-sm">Référnce produit 
      </th>
      <th class="th-sm">le nom de fournisseur
      </th>
      <th class="th-sm">lébéllé de produit 
      </th>
      <th class="th-sm">Quantité commandée 
      </th>
      <th class="th-sm">prix de vente 
      </th>
      <th class="th-sm">prix total du produit
      </th>
    </tr>

  @foreach($lignes as $ligne)
  <tr>
      <td>{{$ligne->id_produit}}</td>
      <td>{{$name}}</td>
      <td>{{$ligne->libelle_produit}}</td>
      <td>{{$ligne->quantite_cmd}}</td>
      <td>{{$ligne->prix_vente}}</td>
      <td>{{$ligne->prix_vente * $ligne->quantite_cmd}}</td>
    </tr>
    @endforeach
</table>
<br/><br/> 
<h1 style="color:white;">le prix total est : {{$totalprice}} DH</h1>
<br/><br/> 
                <button type="button" class="btn btn-primary">
                <a class="btn btn-primary" href="{{ route('commande.createpdf',$ligne->id_commande_fourni) }}">Export to PDF</a>
            
        </div>
        <br/><br/>
        
</body>
@endsection